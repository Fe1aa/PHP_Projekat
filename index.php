<?php 
  session_start();
  require_once("config.php");

  $genre = $_GET["genre"] ?? null;

  if($genre) {
    $gamesSql = "SELECT * FROM games WHERE genre=:genre ORDER BY RAND() LIMIT 16";
    $stmt = $conn->prepare($gamesSql);
    $stmt->bindParam(":genre", $genre);
    $stmt->execute();
  } else {
    $gamesSql = "SELECT * FROM games ORDER BY RAND() LIMIT 16";
    $stmt = $conn->query($gamesSql);
  }
  $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $genreSql = "SELECT DISTINCT genre from games";

  $genres = $conn->query($genreSql)->fetchAll(PDO::FETCH_COLUMN);

  $cartCount = count($_SESSION['cart'] ?? []);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nexus Store</title>
    <link rel="shortcut icon" href="images/Nexus_Logo.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <!-- header -->
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
                <a class="nav-link active fs-5 me-3" aria-current="page" href="#">Store</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fs-5 me-3" href="#">Browse</a>
              </li>
            </ul>
            <form class="d-flex mx-lg-auto my-2 my-lg-0 w-50" role="search">
              <input class="form-control white-text shadow-none input" type="search" placeholder="Search games..." aria-label="Search"/>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
              <?php if(isset($_SESSION['username'])): ?>
              <li class="nav-item">
                <a class="nav-link fs-5 ms-lg-3" href="library.php">Library</a>
              </li>
              <div class="nav-item">
                <a href="#" class="nav-link fs-5 ms-lg-3 position-relative" aria-label="cart">
                  <i class="bi bi-cart3"></i>
                  <?php if($cartCount > 0): ?>
                    <span class="position-absolute top-100 start-100 translate-middle badge rounded-pill primary-accent-bg"><?= $cartCount ?></span>
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
      <div class="hero-banner py-4">
        <div class="container py-5">
          <div class="row align-items-center">
            <div class="col-lg-7">
              <span class="badge secondary-accent-bg mb-3 px-3 py-2 text-uppercase fw-bold">Featured title</span>
              <h1 class="display-4 fw-bold mb-3">Discover Brand New Worlds</h1>
              <p class="lead white-text mb-5">Explore a world of best indie game titles</p>
              <a href="#games" class="btn btn-lg btn-crimson me-4 mt-5">Browse Store</a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- /header -->
    <main>
      <div class="container py-5" id="games">
        <div class="d-flex flex-wrap gap-4 mb-5">
          <a href="index.php#games" class="btn <?= $genre ? "btn-amber" : "btn-crimson" ?>">All</a>
          <?php foreach($genres as $g): ?>
          <a href="index.php?genre=<?= urlencode($g) ?>#games" class="btn <?= $g === $genre ? "btn-crimson" : "btn-amber" ?>"><?= htmlspecialchars($g) ?></a>
          <?php endforeach; ?>
        </div>
        <div class="row g-4">
        <?php foreach($games as $game): ?>
          <div class="col-12 col-lg-6">
            <div class="card card-bg h-100 shadow-sm rounded overflow-hidden">
              <div class="row g-0 h-100">

                <div class="col-12 col-sm-4 position-relative" style="min-height: 200px;">
                  <img src="images/<?= $game["image"] ?>"
                      class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                      alt="<?= $game["title"] ?>">
                </div>

                <div class="col-12 col-sm-8 d-flex">
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title white-text"><?= $game["title"] ?></h5>
                    <p class="card-text white-text"><?= $game["description"] ?></p>
                    <div class="mb-3"><span class="badge secondary-accent-bg"><?= $game["genre"] ?></span></div>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                      <p class="fs-5 fw-bold mb-0 white-text"><?= $game["price"] ?>$</p>
                      <form action="buy.php" method="post">
                        <input type="hidden" name="game" value="<?= $game["id"] ?>">
                        <button type="submit" class="btn btn-amber" name="submit">Buy Now</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
      </div>
    </main>
    <!-- footer -->
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
      <!-- /footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>