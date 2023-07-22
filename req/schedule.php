
<?php 
require('../pdo.php');
$busNo = $_POST['busNo'];
$source = $_POST['src'];
$destination = $_POST['des'];
$departureDate = $_POST['departureDate'];
$departureTime = $_POST['departureTime'];


try {

    try {

      $query = "SELECT departure_date FROM bus_details ORDER BY departure_date DESC LIMIT 1";
      $stmt = $pdo->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if(!$result){
        $mostRecentDepartureDate = $departureDate ;
      }else{
          $mostRecentDepartureDate = $result['departure_date'];
      }
      
   
 
        // Check if a bus already exists for the given departure date
        $existingBusQuery = $pdo->prepare("SELECT COUNT(*) FROM bus_details WHERE departure_date = :departureDate AND bus_number = :busNo");
        $existingBusQuery->bindParam(':departureDate', $departureDate, PDO::PARAM_STR);
        $existingBusQuery->bindParam(':busNo', $busNo, PDO::PARAM_STR);
        $existingBusQuery->execute();

        
        $existingBusCount = $existingBusQuery->fetchColumn();
 

 $today = new DateTime($mostRecentDepartureDate);     
  $previousDate = new DateTime($departureDate);
  $interval = $today->diff($previousDate);
  $daysDifference = $interval->days;
 

        if ($existingBusCount > 0) {
            // A bus already exists for the selected departure date and bus number
            // Handle this situation by displaying an error message to the user or redirecting back to the form page
            echo "A bus already exists for the selected departure date and bus number.";
        }
        else if($daysDifference <= 2 and $daysDifference >=1) {
          echo "The selected departure date must be at least 2 days ahead of the current date.";
        } else {     
          
          
            // Insert the new bus record into the table
            $insertQuery = $pdo->prepare("INSERT INTO bus_details (bus_number, source, destination, departure_date, departure_time) VALUES (:busNo, :source, :destination, :departureDate, :departureTime)");
            $insertQuery->bindParam(':busNo', $busNo, PDO::PARAM_STR);
            $insertQuery->bindParam(':source', $source, PDO::PARAM_STR);
            $insertQuery->bindParam(':destination', $destination, PDO::PARAM_STR);
            $insertQuery->bindParam(':departureDate', $departureDate, PDO::PARAM_STR);
            $insertQuery->bindParam(':departureTime', $departureTime, PDO::PARAM_STR);
            $insertQuery->execute();

 $seatNumber = ['A1', 'B1', 'A2', 'B2', 'A3', 'B3', 'A4', 'B4', 'A5', 'B5', 'A6', 'B6', 'A7', 'B7', 'A8', 'B8'];
  $status = 'available';
 $stmt = $pdo->prepare("INSERT INTO seats (bus_number, seat_number, date, status) VALUES (:busNo, :seatNumber, :departureDate ,:status)");
 $stmt->bindParam(':busNo', $busNo, PDO::PARAM_STR);
 $stmt->bindParam(':status', $status, PDO::PARAM_STR);
 $stmt->bindParam(':departureDate', $departureDate, PDO::PARAM_STR);
 foreach ($seatNumber as $seat) {

   $stmt->bindParam(':seatNumber', $seat, PDO::PARAM_STR);
  
   $stmt->execute();}

            // Success! The bus record was inserted successfully
            echo "Bus record inserted successfully.";
        }


    } catch (PDOException $innerException) {
        // Handle the inner exception
        echo 'Inner Exception: ' . $innerException->getMessage();
    }

    // Other code in the outer try block (if any)

} catch (PDOException $outerException) {
    // Handle the outer exception
    echo 'Outer Exception: ' . $outerException->getMessage();
} catch (Exception $genericException) {
    // Handle any other generic exception that might occur
    echo 'Generic Exception: ' . $genericException->getMessage();
}


?>