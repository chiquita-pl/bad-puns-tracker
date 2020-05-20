<?php
echo 'Hello' . PHP_EOL;
$mysqli = new mysqli("docker_mysql_1", "bpcuser", "temppass123");
echo'This is server info: ' . $mysqli->server_info . PHP_EOL;

try {
	$db = new PDO('mysql:dbname=bac_puns_counter;host=127.0.0.1', 'bpcuser', 'temppass123');
	echo var_dump($mysqli->query('SELECT user FROM mysql.user'));
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}
