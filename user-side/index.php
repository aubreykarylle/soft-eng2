<?php
session_start();
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Puerto Princesa Traveloca</title>
    <link rel="stylesheet" href="style.css" />
    <link href="css/index.css" rel="stylesheet">
  </head>
  <body>
    <header class="header">
      <nav class="navbar">
        <h2 class="logo"><a href="#">Traveloca</a></h2>
        <ul class="links">
        <li class="nav-item">
                    <a class="nav-link active actives" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mytransient.php">Transient</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pension.php">Pension</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lodge.php">Lodge</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myabout.html">About Us</a>
                </li>
                
                <?php if (isset($_SESSION['user_data'])): ?>
                    <button id="profileButton">Profile</button>
                    <div id="profilePopup" style="display: none;">
                        <ul>
                            <li><a href="registration_form.php">Register Your Platform</a></li>
                            <li><a href="profile.php">My Profile</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm ml-3" href="login.php">Log In</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    </header>
    <section class="hero-section">
  <div class="hero">
    <h2>Welcome! to Puerto Princesa Traveloca</h2>
    <p>
      Travel and find the best place to stay in Puerto Princesa City, Palawan.
    </p>
    <div class="buttons">
      <a href="#" class="join">Learn More</a>
    </div>
  </div>

  <div class="container-fluid p-0 mt-5">
    <section id="welcome1" class="full-height section1 d-flex flex-column align-items-center justify-content-between text-white bg-light">
      <div class="carousel slide" data-ride="carousel" id="heroCarousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="assets/img/travelers.png" alt="Travelers" style="width: auto; height: 460px;">
          </div>
        </div>
      </div>
    </section>
  </div>
</section>
  <section class="hero-section">
  <div class="hero">
    <h2>Puerto Princesa City</h2>
    <p class="text-muted text-justify pt-3">
Puerto Princesa City, Palawan, the Philippines' largest city at 253,982 hectares, is known for its diverse ecosystems, including rainforests, mangroves, and coastal areas. It is divided into the East Coast, facing the Sulu Sea, and the mountainous West Coast, near the South China Sea.
A key natural attraction is the Puerto Princesa Subterranean River National Park, a UNESCO World Heritage Site since 1999, featuring an 8.2-kilometer underground river and endemic wildlife.
While rich in natural resources, the city emphasizes sustainable management to protect biodiversity, promote eco-tourism, and maintain quality of life, guided by Republic Act 7611. Conservation efforts aim to balance development with resource preservation for future generations.</p>
  </div>
  <div class="container-fluid p-0 mt-5">
    <section id="welcome1" class="full-height section1 d-flex flex-column align-items-center justify-content-between text-white bg-light">
      <div class="carousel slide" data-ride="carousel" id="heroCarousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="assets/img/ppc.jpg" alt="Travelers" style="width: auto; height: 350px;">
          </div>
        </div>
      </div>
    </section>
  </div>
  </section>
        <footer class="bg-light py-3">
            <div class="container px-4 px-lg-5">
                <div class="small text-right text-muted">Copyright &copy; 2024 - Puerto Princesa Traveloca</div>
            </div>
        </footer>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> 
    <script src="js/scripts.js" defer></script>
</body>

</html>
