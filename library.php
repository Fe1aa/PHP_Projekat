<?php 
  session_start();

  if(!isset($_SESSION["id"])) {
    header("Location: sign_up.php?location=Library");
    exit();
  }

  require_once("config.php");

  $user_id = $_SESSION["id"];

  $gamesSql = "SELECT games.* FROM games JOIN user_games ON games.id = user_games.game_id WHERE user_games.user_id=:user_id";

  $stmt = $conn->prepare($gamesSql); $stmt->bindParam(":user_id", $user_id);
$stmt->execute(); $games = $stmt->fetchAll(PDO::FETCH_ASSOC); $cartCount = 0; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="images/Nexus_Logo.ico" type="image/x-icon">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Library</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid px-5">
          <a class="navbar-brand me-4" href="index.php">
            <img src="images/Nexus_Logo.jpg" alt="Logo" height="50" />
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon" style="filter: invert(1)"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a
                  class="nav-link fs-5 me-3"
                  aria-current="page"
                  href="index.php"
                  >Store</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link fs-5 me-3" href="#">Browse</a>
              </li>
            </ul>
            <form class="d-flex mx-lg-auto my-2 my-lg-0 w-50" role="search">
              <input
                class="form-control white-text shadow-none input"
                type="search"
                placeholder="Search games..."
                aria-label="Search"
              />
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
              <?php if(isset($_SESSION['username'])): ?>
              <li class="nav-item">
                <a class="nav-link fs-5 ms-lg-3 active" href="Library.php"
                  >Library</a
                >
              </li>
              <div class="nav-item">
                <a
                  href="#"
                  class="nav-link fs-5 ms-lg-3 position-relative"
                  aria-label="cart"
                >
                  <i class="bi bi-cart3"></i>
                  <?php if($cartCount > 0): ?>
                  <span
                    class="position-absolute top-100 start-100 translate-middle badge rounded-pill primary-accent-bg"
                    ><?= $cartCount ?></span
                  >
                  <?php endif ?>
                </a>
              </div>
              <?php else: ?>
              <li class="nav-item">
                <a class="nav-link fs-5 ms-lg-3" href="sign_up.php">Sign up</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fs-5 ms-lg-3" href="log_in.php">Log in</a>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div class="container py-5 min-vh-100">
        <div class="row g-4">
          <?php foreach($games as $game): ?>
            <div class="col-12 col-md-6 col-lg-3">
              <div class="card card-bg rounded shadow-sm h-100">
                <img src="images/<?= $game["image"] ?>" alt="<?= $game["title"] ?>" class="w-100 object-fit-cover d-block rounded-top ratio-16x9">
                <div class="d-flex align-items-center p-3 gap-3">
                  <a href="#" class="btn btn-crimson"><i class="bi bi-play-fill fs-4"></i></a>
                  <h5 class="card-title white-text"><?= $game["title"] ?></h5>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </main>
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
          <img
            src="images/Nexus_Logo.jpg"
            alt="Logo"
            class="me-2"
            width="50"
            height="50"
          />
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
