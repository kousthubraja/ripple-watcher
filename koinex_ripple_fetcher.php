<?php
	//$json_content = file_get_contents("https://koinex.in/api/ticker");
	$json_content = '{"prices":{"BTC":"1182000.0","ETH":"88500.0","XRP":"194.5","BCH":"187000.0","LTC":"20250.0","MIOTA":243.11,"OMG":1593.25,"GNT":69.43},"stats":{"ETH":{"last_traded_price":"88500.0","lowest_ask":"88500.0","highest_bid":"88156.0","min_24hrs":"75000.0","max_24hrs":"100000.0","vol_24hrs":"12083.363"},"BTC":{"last_traded_price":"1182000.0","lowest_ask":"1182999.98","highest_bid":"1182003.0","min_24hrs":"1065000.0","max_24hrs":"1362000.0","vol_24hrs":"332.1687"},"LTC":{"last_traded_price":"20250.0","lowest_ask":"20250.0","highest_bid":"20202.0","min_24hrs":"17900.0","max_24hrs":"20948.0","vol_24hrs":"10193.87"},"XRP":{"last_traded_price":"194.4","lowest_ask":"194.5","highest_bid":"194.4","min_24hrs":"140.0","max_24hrs":"223.0","vol_24hrs":"14958192.5"},"BCH":{"last_traded_price":"187000.0","lowest_ask":"187000.0","highest_bid":"186805.0","min_24hrs":"157000.0","max_24hrs":"198000.0","vol_24hrs":"681.444"}}}';
	
	$all_prices = json_decode($json_content);
	
	$stats = $all_prices->stats;
	$xrp_stats = $stats->XRP;
	
	$price = $xrp_stats->last_traded_price;
	
	echo ($price);
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "secdb";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";


	
	$insert_query = "INSERT INTO `secdb`.`ripple` (`intime`, `price`, `ask`, `bid`, `max24`, `min24`, `volume`) VALUES (CURRENT_TIME(), '$price', '$xrp_stats->lowest_ask', '$xrp_stats->highest_bid', '$xrp_stats->max_24hrs', '$xrp_stats->min_24hrs', '$xrp_stats->vol_24hrs');";
	echo($insert_query);
	
	if ($conn->query($insert_query) === TRUE) {
		echo "Added new price";
	} else {
		echo "Error: " . $insert_query . "<br>" . $conn->error;
	}
	
	mail("kousthub.raja@gmail.com","Ripple Alert!",$price);
		
?>