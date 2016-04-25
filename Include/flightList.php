<?php
	class FlightList
	{
		private $sqli_flights;

		public function __construct($sqli, $from_city, $to_city, $min_price, $max_price)
		{
			// Sanitize input
			if(isset($from_city)) $from_city = $sqli->escape_string($from_city);
			if(isset($to_city)) $to_city = $sqli->escape_string($to_city);
			if(isset($min_price)) $min_price = preg_replace("/[^0-9]/", "", $min_price);
			if(isset($max_price)) $max_price = preg_replace("/[^0-9]/", "", $max_price);

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

		private function PrintTableHead()
		{
			echo "<thead><tr>";
			echo "<th>From</th> <th>To</th> <th>Price</th> <th>Book</th>";
			echo "</tr></thead>";
		}

		private function PrintTableRow($row)
		{
			echo "<td>$row->from_city</td>";
			echo "<td>$row->to_city</td>";
			echo "<td>\$$row->price</td>";

			// "Book" button
			echo "<td><button type='button' name='book_$row->route_no'>Book ></button></td>";
		}

		public function PrintTable()
		{
			echo "<table>";
			$this->PrintTableHead();

			echo "<tbody>";
			while($row = $this->sqli_flights->fetch_object())
			{
				echo "<tr>";
				$this->PrintTableRow($row);
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
		}
	}
?>