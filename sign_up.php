<?php
  session_start();

  if(isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="images/Nexus_Logo.ico" type="image/x-icon">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid px-5">
          <a class="navbar-brand me-4" href="#">
            <img src="images/Nexus_Logo.jpg" alt="Logo" height="50">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: invert(1)"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link fs-5 me-3" aria-current="page" href="index.php">Store</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fs-5 me-3" href="#">Browse</a>
              </li>
            </ul>
            <form class="d-flex mx-lg-auto my-2 my-lg-0 w-50" role="search">
              <input class="form-control white-text shadow-none search-input input" type="search" placeholder="Search games..." aria-label="Search"/>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
              <li class="nav-item">
                <a class="nav-link fs-5 me-3 active" href="sign_up.php">Sign up</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fs-5" href="log_in.php">Log in</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <section class="container my-5">
      <div class="row">
        <div class="col-md-6 offset-md-3 card-bg rounded-4 p-4 primary-accent-border">
          <div class="text-center">
            <h2 class="display-5 mb-4 fw-bold white-text">Sign up</h2>
          </div>
          <form action="sign_up_logic.php" method="POST">
            <div class="mb-3">
              <label for="username" class="form-label"
                >Username</label
              >
              <input
                type="text"
                class="form-control input"
                id="username"
                name="username"
                required
              />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label"
                >Email</label
              >
              <input
                type="email"
                class="form-control input"
                id="email"
                name="email"
                required
              />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label"
                >Password</label
              >
              <input
                type="password"
                class="form-control input"
                id="password"
                name="password"
                required
              />
            </div>
            <div class="mb-3">
              <label for="confirm-password" class="form-label"
                >Confirm Password</label
              >
              <input
                type="password"
                class="form-control input"
                id="confirm-password"
                name="confirm_password"
                required
              />
            </div>
            <button type="submit" name="submit" class="btn btn-crimson mt-3">Submit</button>
            <p class="white-text mt-4">Already have an account? <a href="log_in.php">Log in</a></p>
          </form>
        </div>
      </div>
    </section>

    <div class="container">
        <footer
          class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top"
        >
          <p class="col-md-4 mb-0">© 2026 Company, Inc</p>
          <a
            href="#"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-decoration-none"
            aria-label="Bootstrap"
          >
            <img src="images/Nexus_Logo.jpg" alt="Logo" class="me-2" width="50" height="50">
          </a>
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item">
              <a href="#" class="nav-link px-2 secondary-text">Home</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link px-2 secondary-text">Features</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link px-2 secondary-text">Pricing</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link px-2 secondary-text">FAQs</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link px-2 secondary-text">About</a>
            </li>
          </ul>
        </footer>
      </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
