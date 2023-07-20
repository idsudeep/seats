<!DOCTYPE html>
<html>
<head>
  <title>Search Bus</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
  <!-- Include Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <style>
  

  .card{

    width: 100%;
    height:100px;
    font-family: 'Courier New', Courier, monospace;
  }
  .justify-content-end {
    justify-content: space-around !important;
}
#busList {
  max-height: 300px; /* Adjust the height as per your requirement */
  overflow-y: auto;
}
    
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Search Bus</a>
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
  <hr>
  <div class="col-sm-8 offset-lg-2">
    <h5 style="font-family: 'Courier New', Courier, monospace; margin-top:25px;" id="response"> </h5>
    <div class="col-lg-8 offset-lg-2 d-flex justify-content-center">
      <p style="font-family: 'Courier New', Courier, monospace; color:#007bff"> Booking</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-sm-5">
        <div class="form-group">
          <label for="source">Source:</label>
          <input type="text" id="source" list="sourceOptions" class="form-control" style="padding-right: 40px;">
          <datalist id="sourceOptions">
            <!-- Add your source options here -->
          </datalist>
        </div>
      </div>
      <div class="col-sm-5">
        <div class="form-group">
          <label for="destination">Destination:</label>
          <input type="text" id="destination" list="destinationOptions" class="form-control">
          <datalist id="destinationOptions">
            <!-- Add your destination options here -->
          </datalist>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-sm-5">
        <div class="form-group">
          <label for="departureDate">Departure Date:</label>
          <input type="date" class="form-control" id="departureDate" name="departureDate" required>
        </div>
      </div>
    </div>
    <div class="col-lg-8 offset-lg-2 d-flex justify-content-center">
     <button class="btn btn-outline-primary" style="margin-top: 17px; margin-bottom:14px;" id="searchbus">Search</button>
    </div>
    <div class="col-lg-8 offset-lg-2 d-flex justify-content-center">
      <p style="font-family: 'Courier New', Courier, monospace; color:#007bff" id="result_title"> </p>
    </div>
    <div class="row justify-content-center" id="busList">
      <!-- Bus data will be added here dynamically -->
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

$('#searchbus').click(function() {

const source = $('#source').val();
const destination = $('#destination').val(); 
const date = $('#departureDate').val();
var isempty = (source =='' && destination =='' && date =='')?'empty':'!empty';

if(isempty != 'empty'){
    var data = {
      date: date,      
      source: source,       
      destination: destination 
    };
    
    $.ajax({
      url: 'req/getbusls.php',
      method: 'POST',
      data: data,
      dataType: 'json',
      success: function(response) {
       
   if(response.length>0){
    function createBusCard(bus) {
      $('#bus_title').text('Bus Schedule');
    const card = document.createElement("div");
    card.className = "col-md-10 mb-1";
    card.innerHTML = `
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <span>${bus.bus_number}</span>
            <span>${bus.datetime}</span>
            
          </div>
          <div class="d-flex justify-content-end" style="color:purple;font-weight:900; ">
            <span style="padding-left:20px;">${bus.source}</span>
            <div class="d-flex justify-content-end" style="color:purple;font-weight:900; "> | </div
            <span>${bus.destination}</span>
            
          </div>
          <p class="card-text" style="color:green">Availabe: ${bus.available}</p>
        
        </div>
      </div>
    `;
    return card;
  }

  // Function to render the bus list
  function renderBusList() {
    const busListContainer = document.getElementById("busList");
    response.forEach((bus) => {
      const busCard = createBusCard(bus);
      busListContainer.appendChild(busCard);
    });
  }

  // Initial rendering of the bus list
  renderBusList();

   }else{ 

    $('#response').empty();
  var t= 'bus are not available, Please change Schedule';
  $('#response').text(t).css({'color':'red','font-size':'14px','float':'right'});
  setTimeout(function(){
   
    $('#response').empty();
  },3000)
   }

      },
      error: function(xhr, status, error) {
        // Handle errors here
        console.error(error);
      }
    });
}else{
  $('#response').empty();
  var t= 'Some values are empty';
  $('#response').text(t).css({'color':'red','font-size':'14px','float':'right'});
  setTimeout(function(){
   
    $('#response').empty();
  },3000)
}

});

</script>

