<?php
	class FlightList
	{
		private $sqli_flights;

		public function __construct($sqli, $from_city, $to_city, $min_price, $max_price)
		{
			// Sanitize input
			if(isset($from_city)) $from_city = $sqli->escape_string($from_city);
			if(isset($to_city)) $to_city = $sqli->escape_string($to_city);
			if(isset($min_price)) $min_price = $sqli->escape_string($min_price);
			if(isset($max_price)) $max_price = $sqli->escape_string($max_price);

			// Filter clauses
			$filters = array();
			if(isset($from_city)) 	array_push($filters, "from_city = '$from_city'");
			if(isset($to_city)) 	array_push($filters, "to_city = '$to_city'");
			if(isset($min_price)) 	array_push($filters, "price > '$min_price'");
			if(isset($max_price)) 	array_push($filters, "price < '$max_price'");

			// Base query (no filters)
			$queryFormat = "SELECT * FROM flights WHERE 1=1 %s";

			// Insert filters into query string, if at least one filter exists
			$query = sprintf($queryFormat,
				(sizeof($filters) > 0)? "AND " . implode(' AND ', $filters) : "");

			// Make the query
			$this->sqli_flights = $sqli->query($query);

			// Print errors
			if($sqli->errno)
			{	echo $sqli->error . " --IN QUERY-- " . $query;	exit();	}
		}

		public function PrintTable()
		{
			while($row = $this->sqli_flights->fetch_object())
			{
				echo "<li>";
				echo $row->from_city . " to ";
				echo $row->to_city . " at $";
				echo $row->price . "!";
				echo "</li>";
			}
		}
	}
?>