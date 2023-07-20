<?php
 require_once '../pdo.php';

try {
    

   
    $sql = "SELECT bd.bus_number AS bus_number,
    CONCAT(bd.departure_date, ' ', bd.departure_time) AS datetime,
    bd.source AS source,
    bd.destination AS destination,
    (COUNT(*) - COALESCE(SUM(CASE WHEN s.status = 'booked' THEN 1 ELSE 0 END), 0)) AS available
    FROM bus_details bd
    LEFT JOIN seats s ON bd.bus_number = s.bus_number
    AND bd.departure_date = s.date
    WHERE bd.departure_date = ? 
    AND bd.source = ? 
    AND bd.destination = ? 
    GROUP BY bd.id, bd.bus_number, bd.departure_date, bd.departure_time, bd.source, bd.destination ";

    $stmt = $pdo->prepare($sql);

    $date = $_POST['date'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];


    $stmt->bindParam(1, $date, PDO::PARAM_STR);
    $stmt->bindParam(2, $source, PDO::PARAM_STR);
    $stmt->bindParam(3, $destination, PDO::PARAM_STR);

    $stmt->execute();

  
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


    header('Content-Type: application/json');
    echo json_encode($data);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
