<?php
session_start();
include 'C:/xampp/htdocs/project24/partials/_signupmodal.php';
include 'C:/xampp/htdocs/project24/partials/_loginmodel.php';




echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
  <div class='container-fluid'>
    <a class='navbar-brand' href='http://localhost/project24/'>Satadiya.in</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
      <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
        <li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='/project24'>Home</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='http://localhost/project24/history.php'>About Us</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='http://localhost/project24/gallery.php'>Gallery</a>
        </li>
        
      </ul>";
      // <form class="form-inline my-2 my-lg-0 mr-2 d-flex" action="search.php">
      //     <input class="form-control mr-sm-2 mx-1" type="search" placeholder="Search" aria-label="Search">
      //     <button class="btn btn-success my-2 my-sm-0 nav-item mx-1" type="submit">Search</button>
      //   </form>

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '
        <p class="text-light my-2 mx-2 nav-item">Welcome <a href="/project24/partials/_sidebar.php">' . htmlspecialchars($_SESSION['username']) . '</a> </p>
        <a href="/project24/_logout.php" class="btn btn-outline-success mx-1" onclick="return confirm(\'Are you sure you want to logout?\')">Logout</a>';
} else {
  echo '
        <button class="btn btn-outline-success mr-2 nav-item mx-1" data-toggle="modal" data-target="#loginModal">Login</button>
        <button class="btn btn-outline-success nav-item mx-1" data-toggle="modal" data-target="#signupModal">Signup</button>';
}

echo '</div>
  </div>
</nav>';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] === "true") {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Success!</strong> you can login after Admin varify your Registation data
within a 24 hrs .
thank you !
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
} elseif (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] === "false") {
  echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
          <strong>' . htmlspecialchars($_GET['error']) . '</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

if (isset($_SESSION['update'])) {
  if ($_SESSION['update'] === "true") {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Profile updated successfully!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  } elseif ($_SESSION['update'] === "false") {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Unable to update profile.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
}
