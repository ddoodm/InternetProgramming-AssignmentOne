<?php

require_once("stdinc.php");
require_once("flight.php");

class Bookings implements Serializable
{
	public static $BOOKINGS_SESSION_KEY = "interprog.bookings";

	private $bookings;

	public function __construct()
	{
		$this->bookings = array();
	}

	public function add($booking)
	{
		array_push($this->bookings, $booking);
	}

    public function serialize()
    {
        return serialize($this->bookings);
    }

    public function unserialize($data)
    {
        $this->bookings = unserialize($data);
    }

    public function get_totalPrice()
    {
    	$price = 0;
    	foreach($this->bookings as $booking)
    		$price += $booking->get_totalPrice();
    	return $price;
    }

    public function get_totalPrice_formatted()
    {
    	setlocale(LC_MONETARY, Constants::$LOCALE);
		return money_format('$%i', $this->get_totalPrice());
    }

	public function __toString()
	{
		$str = "<ul class='bookingsList'>";
		foreach($this->bookings as $booking)
			$str .= "<li>" . $booking . "</li>\n";
		$str .= "</ul>";
		return $str;
	}
}

class Seat
{
	public
		$number,
		$wheelchair	= false,
		$child 		= false,
		$diet 		= false;

	public function __construct($number)
	{
		$this->number = $number;
	}
}

class Booking
{
	public $flight;
	public $seats;
	private $seatCount;

	public function __construct($flight, $seatCount)
	{
		$this->flight = $flight;
		$this->seatCount = $seatCount;

		// Build seat array
		$this->seats = array();
		for($i = 0; $i < $this->seatCount; $i++)
			array_push($this->seats, new Seat(i+1));
	}

	public function get_seatCount()
	{
		return $this->seatCount;
	}

	public function get_totalPrice()
	{
		return $this->flight->get_price() * $this->seatCount;
	}

    public function get_totalPrice_formatted()
    {
    	setlocale(LC_MONETARY, Constants::$LOCALE);
		return money_format('$%i', $this->get_totalPrice());
    }

	public function SeatPrefList($seat)
	{
		$opts = array();
		if($seat->wheelchair)	array_push($opts, "Wheelchair");
		if($seat->child)		array_push($opts, "Child");
		if($seat->diet)			array_push($opts, "Special Diet");

		if(sizeof($opts) == 0)
			return "Standard Seat";

		return implode(", ", $opts);
	}

	public function seatList()
	{
		$str = "<ul>";
		foreach($this->seats as $seat)
		{
			$str .= "<li>";
			$str .= sprintf("Seat: %s", $this->SeatPrefList($seat));
			$str .= "</li>\n";
		}
		$str .= "</ul>\n";

		return $str;
	}

	public function __toString()
	{
		return sprintf("%s to %s with %d seats.<br /><b>Cost: %s | Total: %s</b>\n%s",
			$this->flight->get_from_city(),
			$this->flight->get_to_city(),
			$this->seatCount,
			$this->flight->get_price_formatted(),
			$this->get_totalPrice_formatted(),
			$this->seatList());
	}
}

?>