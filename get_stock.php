<?php
include 'database.php';

$sql = "SELECT blood_type, stock FROM blood_stock";
$result = $conn->query($sql);

$stockData = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $stockData[] = $row;
    }
}

echo json_encode($stockData);
$conn->close();
?>
