<?php 
require_once 'config.php';



// Assuming you have established a database connection

// Get the bus number and date from the AJAX request
//$busNumber = $_POST['busNumber'];
$busNumber = $_POST['busNumber'];
$date = $_POST['date'];
// Prepare the SQL query to fetch seat information based on the bus number and date
$sql = "SELECT seat_number, status FROM seats WHERE bus_number = '$busNumber' AND date = '$date'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Create an array to store the seat data
$seats = array();

// Fetch rows from the result set
while ($row = mysqli_fetch_assoc($result)) {
    $seat = array(
        'seat_number' => $row['seat_number'],
        'status' => $row['status']
    );

    // Add the seat data to the array
    $seats[] = $seat;
}

// Close the database connection
mysqli_close($conn);

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($seats);



?>