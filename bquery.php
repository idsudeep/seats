
<?php

require_once 'pdo.php';

$seatNumber = $_POST['seatNumber'];
$busNumber = $_POST['busNumber'];
$action = $_POST['action'];
$personName = 'Pedro'; 
$seats = implode(',', $seatNumber);
$flag = false;
if ($action === 'booked') {
  // Update the seats table to mark the seat as booked 
  $stmt = $pdo->prepare("UPDATE seats SET status = 'booked' WHERE seat_number = :seatNumbers");

  foreach ($seatNumber as $seatNumbers) {
    $stmt->bindParam(':seatNumbers', $seatNumbers, PDO::PARAM_STR); 
    $stmt->execute();}
    if($stmt->execute()){
        $flag = true;
    }
} elseif ($action === 'cancel') {
    $stmt = $pdo->prepare("UPDATE seats SET status = 'available' WHERE seat_number = :seatNumbers");

    foreach ($seatNumber as $seatNumbers) {
      $stmt->bindParam(':seatNumbers', $seatNumbers, PDO::PARAM_STR); 
      $stmt->execute();}
}

// Record the booking in the booking table if it was a booking action
if ($action === 'booked' && $flag ==true) {

    $bookingSql = "INSERT INTO booking (seat_numbers,bus_number, person_name, booking_date) VALUES (:seatNumber,:busNumber ,:personName, NOW())";
    $bookingStmt = $pdo->prepare($bookingSql);
    $bookingStmt->bindValue(':seatNumber', $seats);
    $bookingStmt->bindValue(':personName', $personName);
    $bookingStmt->bindValue(':busNumber', $busNumber);
    $bookingStmt->execute();
  
}

// Send a response back to the AJAX request
$response = [
  'status' => 'success',
  'message' => 'Seat updated and booking recorded successfully.'
];

echo json_encode($response);
?>
