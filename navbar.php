<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg p-3 mb-5">
  <a class="navbar-brand" href="index.php">Awaaz of Devbhoomi Charitable Trust</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <donation_form class="navbar-nav">

      <!-- Dropdown for login options -->
      <li class="nav-item dropdown">
        <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          Login Here
        </a> -->
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="login/adminLogin.php">Admin</a>
          <a class="dropdown-item" href="login/donorLogin.php">Donor</a>
          <a class="dropdown-item" href="login/volunteerLogin.php">Volunteer</a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="donation_form.html">Donation</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="gallery.php">Gallery</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="contact.php">Contact Us</a>
      </li>
  </div>
</nav>


<style>
  .navbar-brand {
    color: rgb(161, 201, 201);
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s;
    font-weight: bold;
    font-size: 1.25rem;
  }

  .navbar-nav {
    font-size: 1.0rem;
  }
</style>