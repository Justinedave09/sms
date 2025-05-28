<?php
// Database connection
// $conn = new mysqli('localhost', 'username', 'password', 'database_name');

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Example data (replace with your actual POST data)
require_once('../../classes/DBConnection.php');
require_once('../../../initialize.php');
$item_name = $_POST['item_name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$supplier_id = $_POST['supplier_id'];
$unit = $_POST['unit'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO stocks (item_name, quantity, price, supplier_id, unit) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iidis", $item_name, $quantity, $price, $supplier_id, $unit);

if ($stmt->execute()) {
    echo "New stock inserted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>