<?php

// Site-wide dependencies
require_once("stdinc.php");

class Flight
{
	private $route_no, $from_city, $to_city, $price;

	public function __construct($route_no, $from_city, $to_city, $price)
	{
		$this->route_no = $route_no;
		$this->from_city = $from_city;
		$this->to_city = $to_city;
		$this->price = $price;
	}

	public static function CreateFromRouteNo($sqli, $route_no)
	{
		$query = "SELECT * FROM flights WHERE route_no=$route_no;";
		$result = $sqli->query($query);

		// Print errors
		if($sqli->errno)
		{ echo $sqli->error . " --IN QUERY-- " . $query;  exit(); }
		$flightRes = $result->fetch_object();

		return new Flight($route_no, $flightRes->from_city, $flightRes->to_city, $flightRes->price);
	}

	public function get_from_city()
	{
		return $this->from_city;
	}

	public function get_to_city()
	{
		return $this->to_city;
	}

	public function get_price()
	{
		return $this->price;
	}

	// Currency format string
	public function get_price_formatted()
	{
		setlocale(LC_MONETARY, Constants::$LOCALE);
		return money_format('$%i', $this->price);
	}
}

?>