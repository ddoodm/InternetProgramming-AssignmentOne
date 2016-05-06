<?php

// Site-wide dependencies
require_once("stdinc.php");

class Flight
{
	private $flight;

	public function __construct($sqli, $route_no)
	{
		$query = "SELECT * FROM flights WHERE route_no=$route_no;";
		$result = $sqli->query($query);

		// Print errors
		if($sqli->errno)
		{ echo $sqli->error . " --IN QUERY-- " . $query;  exit(); }
		$this->flight = $result->fetch_object();
	}

	public function get_from_city()
	{
		return $this->flight->from_city;
	}

	public function get_to_city()
	{
		return $this->flight->to_city;
	}

	public function get_price()
	{
		return $this->flight->price;
	}

	// Currency format string
	public function get_price_formatted()
	{
		setlocale(LC_MONETARY, Constants::$LOCALE);
		return money_format('$%i', $this->flight->price);
	}
}
?>