<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
  <!-- Include Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* CSS styles for the profile section (same as before) */

    /* CSS styles for the ticket section */
    .ticket-card {
      max-width: 300px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .ticket-title {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .ticket-details {
      margin-top: 10px;
    }

    .ticket-details p {
      margin: 5px 0;
    }

    .ticket-details i {
      margin-right: 5px;
    }
  </style>
  <!-- Set viewport meta tag for mobile responsiveness -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Ticket</a>
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
        <li class="nav-item">
        <button class="btn btn-outline-warning" style="float:right !important">Logout</button>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-6 col-md-4">
      
        <div class="ticket-card">
        <div class="profile-actions">
          <button class="btn btn-outline-primary">Edit Profile</button>
      
        </div>
        <div class="profile-name">
          John Doe
        </div>
        <div class="profile-info">
          <p><i class="fas fa-envelope"></i> john.doe@example.com</p>
          <p><i class="fas fa-phone"></i> +1 123-456-7890</p>
          <p><i class="fas fa-map-marker-alt"></i> New York, USA</p>
        </div>
       
          <div class="ticket-title">
            Your Ticket Details
          </div>
          <div class="ticket-details">
            <p><i class="fas fa-ticket-alt"></i> Ticket Number: ABC123</p>
            <p><i class="fas fa-calendar-alt"></i> Date: 2023-07-25</p>
            <p><i class="fas fa-clock"></i> Time: 08:00 AM</p>
            <p><i class="fas fa-map-marked-alt"></i> From: A to B</p>
            <p><i class="fas fa-user"></i> seatNumber: A1 B2</p>
          </div>
          <div class="row justify-content-center">

          <button class="btn btn-outline-primary">Print</button>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<!-- Include Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

</body>
</html>
