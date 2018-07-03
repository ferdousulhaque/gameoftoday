<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Ecom Site with Buy from RobiPay</title>

    <!-- Bootstrap core CSS -->
    <link href="eComPage/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="eComPage/css/heroic-features.css" rel="stylesheet">

  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Shohoj Dokan</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3">Your Balance is: <?php include('balance.php'); ?></h1>
        
        <!-- <a href="#" class="btn btn-primary btn-lg">Refresh</a> -->
      </header>

      <!-- Page Features -->
      <div class="row text-center">

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="http://placehold.it/500x325" alt="">
            <div class="card-body">
              <h4 class="card-title">Product 01</h4>
              <p class="card-text">Buy the product 01</p>
            </div>
            <div class="card-footer">
              <a href="http://lara.local/gameoftoday/charger_50.php" class="btn btn-primary">Buy Now</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="http://placehold.it/500x325" alt="">
            <div class="card-body">
              <h4 class="card-title">Product 02</h4>
              <p class="card-text">Buy the product 02</p>
            </div>
            <div class="card-footer">
              <a href="http://lara.local/gameoftoday/charger_100.php" class="btn btn-primary">Buy Now</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="http://placehold.it/500x325" alt="">
            <div class="card-body">
              <h4 class="card-title">Product 03</h4>
              <p class="card-text">Buy the product 03</p>
            </div>
            <div class="card-footer">
              <a href="http://lara.local/gameoftoday/charger_150.php" class="btn btn-primary">Buy Now</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="http://placehold.it/500x325" alt="">
            <div class="card-body">
              <h4 class="card-title">Product 04</h4>
              <p class="card-text">Buy the product 04</p>
            </div>
            <div class="card-footer">
              <a href="http://lara.local/gameoftoday/charger_1000.php" class="btn btn-primary">Buy Now</a>
            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="eComPage/vendor/jquery/jquery.min.js"></script>
    <script src="eComPage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
