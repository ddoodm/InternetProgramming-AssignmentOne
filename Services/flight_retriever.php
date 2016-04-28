<?php

  	// Site-wide dependencies
  	require_once("../Include/stdinc.php");

  	// Connect to the database ($sqli)
  	require_once("../Include/database_connect.php");

	class FlightList
	{
		private $sqli_flights;

		public function __construct($sqli, $from_city, $to_city, $min_price, $max_price)
		{
			// Filter clauses
			$filters = array();
			if(!empty($from_city)) 	array_push($filters, "from_city LIKE '%$from_city%'");
			if(!empty($to_city)) 	array_push($filters, "to_city LIKE '%$to_city%'");
			if(!empty($min_price)) 	array_push($filters, "price >= '$min_price'");
			if(!empty($max_price)) 	array_push($filters, "price <= '$max_price'");

			// Base query (no filters)
			$queryFormat = "SELECT * FROM flights %s";

			// Insert filters into query string, if at least one filter exists
			$query = sprintf($queryFormat,
				(sizeof($filters) > 0)? "WHERE " . implode(' AND ', $filters) : "");

			// Make the query
			$this->sqli_flights = $sqli->query($query);

			// Print errors
			if($sqli->errno)
			{	echo $sqli->error . " --IN QUERY-- " . $query;	exit();	}
		}

		public function GenerateXML()
		{
			$doc = new DOMDocument('1.0');
			$doc->formatOutput = true;

			// Root node is "flights"
			$root = $doc->appendChild($doc->createElement("flights"));

			// "flight" child nodes
			while($row = $this->sqli_flights->fetch_object())
				$root->appendChild($this->GenerateXMLForRow($doc, $row));

			return $doc->saveXML();
		}

		private function GenerateXMLForRow(&$doc, $row)
		{
			$flight = $doc->createElement("flight");

			$flight->setAttribute("from_city", $row->from_city);
			$flight->setAttribute("to_city", $row->to_city);
			$flight->setAttribute("price", $row->price);

			return $flight;
		}
	}

	/*
	 * User request begins here
	 */

	// Sanitize input
	if(isset($_POST["from_city"]))	$from_city = $sqli->escape_string($_POST["from_city"]);
	if(isset($_POST["to_city"]))	$to_city = $sqli->escape_string($_POST["to_city"]);
	if(isset($_POST["min_price"])) 	$min_price = preg_replace("/[^0-9]/", "", $_POST["min_price"]);
	if(isset($_POST["max_price"])) 	$max_price = preg_replace("/[^0-9]/", "", $_POST["max_price"]);

	// Create the flight list
	$flightList = new FlightList(
		$sqli, $from_city?:null, $to_city?:null, $min_price?:null, $max_price?:null);

	// Respond with the payload
	header ("Content-Type:text/xml");
	echo $flightList->GenerateXML();
?>