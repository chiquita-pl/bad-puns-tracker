<?php
echo 'Hello' . PHP_EOL;
$mysqli = new mysqli("badpuns_mysql_1", "bpcuser", "temppass123");
echo'This is server info: ' . $mysqli->server_info . PHP_EOL;

try {
	$db = new PDO('mysql:dbname=bad_puns_counter;host=172.20.0.2', 'bpcuser', 'temppass123');
	foreach ($db->query('SELECT * FROM movie') as $row) {
	    echo print_r($row, 1);
	}
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}
