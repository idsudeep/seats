<!DOCTYPE html>
<html>
<head>
  <title>Schedule Bus</title>
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
    <div class="d-flex justify-content-center">
    <p style="font-family: 'Courier New', Courier, monospace; margin-top:25px;"> Welcome to Admin Pannel </p>
        </div>
     </div>
    <hr>
 
    
    <div class="col-sm-8 offset-lg-2">
    <h5 style="font-family: 'Courier New', Courier, monospace; margin-top:25px;" id="response"> </h5>
     <div class="col-lg-8 offset-lg-2 d-flex justify-content-center">
        <p style="font-family: 'Courier New', Courier, monospace; color:#007bff"> Prepare Bus Schedule</p>
     </div>
    <form id="scheduleForm">
  <div class="form-group">
    <label for="busNo">Bus Number:</label>
    <input type="text" class="form-control" id="busNo" name="busNo" required>
  </div>
  <div class="form-group">
    <label for="source">Source:</label>
    <input type="text" id="source" list="sourceOptions" class="form-control">
    <datalist id="sourceOptions">

</datalist>
<datalist id="destinationOptions">

</datalist>
  </div>
  <div class="form-group">
    <label for="destination">Destination:</label>
    <input type="text" id="destination" list="destinationOptions" class="form-control">
  </div>
  <div class="form-group">
    <label for="departureDate">Departure Date:</label>
    <input type="date" class="form-control" id="departureDate" name="departureDate" required>
  </div>
  <div class="form-group">
    <label for="departureTime">Departure Time:</label>
    <input type="time" class="form-control" id="departureTime" name="departureTime" required>
  </div>
</form>

<div class="row">
    <div class="col-lg-6 offset-lg-3 d-flex justify-content-center">
      <button class="btn btn-outline-primary" id="updateSchedule" style="margin-top: 25px;">Update</button>
    </div>
  </div>
    </div>


      
    </div>
 
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>




</body>
</html>



<script>

const places = [
  { name: 'Place A', value: 'A' },
  { name: 'Place B', value: 'B' },
  { name: 'Place C', value: 'C' },
  { name: 'Place D', value: 'D' },
  { name: 'Place E', value: 'E' }
];


const sourceInput = document.getElementById('source');
const destinationInput = document.getElementById('destination');

places.forEach(place => {
  const option = document.createElement('option');
  option.value = place.value;
  option.textContent = place.name;
  
  
  document.getElementById('sourceOptions').appendChild(option.cloneNode(true));
  document.getElementById('destinationOptions').appendChild(option);
});

// Event listener to ensure source and destination values are different
sourceInput.addEventListener('input', () => {
  const selectedSource = sourceInput.value;
  const selectedDestination = destinationInput.value;
  
  if (selectedDestination === selectedSource) {
    destinationInput.value = '';
  }
});

destinationInput.addEventListener('input', () => {
  const selectedSource = sourceInput.value;
  const selectedDestination = destinationInput.value;
  
  if (selectedSource === selectedDestination) {
    sourceInput.value = '';
  }
});


$(document).ready(function() {
  $('#updateSchedule').click(function() {

    const source = $('#source').val();
    const destination = $('#destination').val();

    // Serialize the form data into an array
    var formData = $('#scheduleForm').serializeArray();
    
    var formDataObj = {};

    formData.forEach(function(input) {
      formDataObj[input.name] = input.value;
    });

    formDataObj['src'] = source;
    formDataObj['des'] = destination;

    var isEmpty = Object.values(formDataObj).some(function(value) {
  return value.trim() === '';
});

if (isEmpty) {
  $('#response').empty();
  var t= 'Some values are empty';
  $('#response').text(t).css({'color':'red','font-size':'14px','float':'right'});
  setTimeout(function(){
   
    $('#response').empty();
  },3000)
  
} else {
 
  $.ajax({
      url: 'req/schedule.php',
      type: 'POST',
      data: formDataObj,
      success: function(response) {
        
       $('#response') = empty();
        $('#response').text(response);
        setTimeout(function(){
        
          $('#response').empty();

        },6000)
      },
      error: function(xhr, status, error) {
     
        console.log('AJAX request failed:', error);
      }
    });
}
   
  });
});


</script>

