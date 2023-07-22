<!DOCTYPE html>
<html>
<head>
  <title>Seat Allocation</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
  <!-- Include Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <style>
    .seat[data-seat-number^="A"]::before {
      content: "\f007"; /* Font Awesome icon code for seat icon */
      font-family: "Font Awesome 5 Free";
    }

    .seat[data-seat-number^="B"]::before {
      content: "\f0c0"; /* Font Awesome icon code for bed icon */
      font-family: "Font Awesome 5 Free";
    }

    .seat {
        width: 50%;
      margin-bottom: 30px;
    }
 
    .row-label {
      margin-bottom: 10px;
      display: flex;
      justify-content: center;
    }

    .selected {
      background-color: #007bff;
      color: #fff;
    }
    #s{
        color: white;
        background-color: #007bff;
    }
    #b{
        color: white;
        background-color: green;
    }
    .seat-group {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 10px;
}

    
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Seat Allocation</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">

  <div class="row">
    <div class="col-lg-6 offset-lg-3">
    <div class="row">
      <span style="font-family:'Courier New', Courier, monospace; margin-bottom:20px;">Busno :<span id="busno"></span> <span id="sseat" style="margin-left:70px;">Time:
    <?php 
     require_once('config.php');

     $busno =$_GET['busNo'];
     $date = $_GET['date'];
     $query = "select departure_date ,departure_time from bus_details where bus_number ='$busno' and departure_date = '$date'";
     $r = mysqli_query($conn,$query);
     $time = $r->fetch_assoc();
    $dt = $time['departure_date'].' '.$time['departure_time'];
    echo $dt;
     ?>
     </span></span>
      <span style="font-family:'Courier New', Courier, monospace; margin-bottom:20px;">SeatNo :<span id="selects"></span> <span id="fromto" style="margin-left:70px;"></span></span>
     
     </div>
    <div class="row-label">
      <div class="d-flex justify-content-center">
        <button class="btn btn-outline-danger mx-2" onclick="toggleSelection(this)">Booked</button>
        <button class="btn btn-outline-success mx-2" onclick="toggleSelection(this)" id="b">Available</button>
        <button class="btn btn-outline-primary mx-2" onclick="toggleSelection(this)" id="s">Selected</button>
      </div>
    </div>
    <hr>
        
      <div class="seat-map">
        <div class="row">
            
        <div class="col-sm-4 offset-sm-2">
    <div class="row-label">A</div>
    <hr>
    <div class="seat-group" id="seatGroupA">
        <!-- Seat buttons for row A will be appended here -->
    </div>
</div>

        <div class="col-sm-4 offset-sm-2">
            <div class="row-label">B</div>
            <hr>
            <div class="seat-group" id="seatGroupB">
                <!-- Seat buttons for row A will be appended here -->
            </div>
        </div>

      
        </div>
      
      </div>
    </div>
    <div class="row">
    <div class="col-lg-6 offset-lg-3 d-flex justify-content-center">
      <button class="btn btn-primary" onclick="booking()">Book Now</button>
    </div>
  

  </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

<script>

function getQueryParamValue(param) {
      const params = new URLSearchParams(window.location.search);
      return params.get(param);
    }

    // Get the query parameters
    const busNo = getQueryParamValue('busNo');
    
   
    const src = getQueryParamValue('src');
    const des = getQueryParamValue('des');
    const date = getQueryParamValue('date');
    var texts = 'From : '+src+ '  To : '+des;
    $('#busno').text(busNo);
    $('#busno').text(busNo);
    $('#fromto').text(texts);


var busNumberElement = document.getElementById('busno');
var busNumber = busNumberElement.textContent.split(':')[0].trim();


var selectedSeats = []; 

function toggleSelection(button) {
  var seatNumber = button.textContent; 

  // Check if the seat is already selected
  var index = selectedSeats.indexOf(seatNumber);

  if (index === -1) {
    // Seat not selected, add it to the array
    selectedSeats.push(seatNumber);
    button.classList.add("selected");

    

  } else {
    // Seat already selected, remove it from the array
    selectedSeats.splice(index, 1);
    button.classList.remove("selected");
  }
// Display the selected seat values in the console

  updateSelectedSeats();

}

function booking(){

    if(selectedSeats != undefined){
   

            $.ajax({
            url: 'bquery.php', 
            type: 'POST',
            data: {
                seatNumber: selectedSeats ,
                action:'booked',
                busNumber:busNumber
            },
            success: function(response) {
              const responseObject = JSON.parse(response);
            if(responseObject.status == 'success'){


              window.location.href = `ticket.php?busNo=${encodeURIComponent(busNumber)}&src=${encodeURIComponent(src)}&des=${encodeURIComponent(des)}&date=${encodeURIComponent(date)}`;

            }
      
            },
            error: function(xhr, status, error) {
                // Handle the error response from the server
                console.log('Error inserting booking:', error);
            }
            });


    }
}


function updateSelectedSeats() {
  var selectedSeatsElement = document.getElementById("selects");
  selectedSeatsElement.innerHTML = "";

  for (var i = 0; i < selectedSeats.length; i++) {
    var seatElement = document.createElement("span");
    seatElement.textContent =  selectedSeats[i];
    seatElement.classList.add("mx-1");
    selectedSeatsElement.appendChild(seatElement);
  }
}

$.ajax({
      url: 'query.php', 
      type: 'POST',
      data: {
        busNumber: busNo, 
        date: date 
      },
      success: function(response) {
        // Handle the response from the server
        var seats = response;
        var seatGroupA = document.getElementById('seatGroupA');
        var seatGroupB = document.getElementById('seatGroupB');

for (var i = 0; i < seats.length; i++) {
    var seat = seats[i];

    
    var buttonClass = (seat.status === 'available') ? 'btn btn-outline-success' : 'btn btn-outline-warning';
    var button = document.createElement('button');
    button.textContent = seat.seat_number;
    button.className = 'seat ' + buttonClass;
    button.onclick = function() {
        toggleSelection(this);
    };
  
   
            if (seat.seat_number.startsWith('A')) {
            if (seat.status == 'booked') {
            button.disabled = true;
            }
            seatGroupA.appendChild(button);
        } else if (seat.seat_number.startsWith('B')) {
            if (seat.status == 'booked') {
            button.disabled = true;
            }
            seatGroupB.appendChild(button);
        
            }
}
      },
      error: function(xhr, status, error) {
      
        console.log('AJAX request failed:', error);
      }
    });
</script>


</body>
</html>
