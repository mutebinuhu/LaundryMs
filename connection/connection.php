<?php 
try {
	$user = "root";
	$password = "";
	$pdo = new PDO("mysql:host=localhost;port=3306;dbname=drycleanerms", $user, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo("CONNECTED TO DB");

} catch (Exception $e) {
	echo "Failed to connect to the server : ". $e->getMessage();
}
/*create users*/
/*
$sql = "CREATE TABLE Customers (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
customer_fname VARCHAR(30) NOT NULL,
customer_lname VARCHAR(30) NOT NULL,
customer_tel VARCHAR(30) NOT NULL,
customer_email VARCHAR(50),
customer_area VARCHAR(50),

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$pdo -> exec($sql);
echo "Table created";
*/
 ?>