<?php

 require ('../pdo.php');
$busNo = $_POST['busNo'];
$source = $_POST['src'];
$destination = $_POST['des'];
$departureDate = $_POST['departureDate'];
$departureTime = $_POST['departureTime'];

// Check if a bus already exists for the given departure date
$existingBusQuery = $pdo->prepare("SELECT COUNT(*) FROM bus_details WHERE departure_date = :departureDate");
$existingBusQuery->bindParam(':departureDate', $departureDate, PDO::PARAM_STR);
$existingBusQuery->execute();

$existingBusCount = $existingBusQuery->fetchColumn();

if ($existingBusCount > 0) {
  // A bus already exists for the given date
  // You can handle this situation by displaying an error message to the user or redirecting back to the form page
  echo "A bus already exists for the selected departure date.";
} else {
  // Insert the new bus record into the table
  $insertQuery = $pdo->prepare("INSERT INTO bus_details (bus_number, source, destination, departure_date, departure_time) VALUES (:busNo, :source, :destination, :departureDate, :departureTime)");
  $insertQuery->bindParam(':busNo', $busNo, PDO::PARAM_STR);
  $insertQuery->bindParam(':source', $source, PDO::PARAM_STR);
  $insertQuery->bindParam(':destination', $destination, PDO::PARAM_STR);
  $insertQuery->bindParam(':departureDate', $departureDate, PDO::PARAM_STR);
  $insertQuery->bindParam(':departureTime', $departureTime, PDO::PARAM_STR);
  $insertQuery->execute();

  // Success! The bus record was inserted successfully
  echo "Bus record inserted successfully.";
}
?>
