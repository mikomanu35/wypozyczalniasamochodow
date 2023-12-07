<!DOCTYPE html>
<?php
session_start();

if(isset($_SESSION['logon']) && $_SESSION['logon'] == True){
  header('Location: panel.php');
  exit();
}

?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Wypożyczalnia</title>
  </head>

  <body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">
    <!--  NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
      <div class="container">
        <img style="width:65px" src="imgs/tlo.jpg" a href="index.html">
        <a class="navbar-brand" a href="index.html">Wypożyczalnia samochodów</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a  style="text-align:center" class="nav-link" href="index.html">Strona główna</a>
            </li>
            <li class="nav-item">
              <a style="text-align:center" class="nav-link" href="samochody.php">Samochody</a>
            </li>
          
          <a style="text-align:center" href="rejestracja.php" class="btn btn-brand ms-lg-3">Zaloguj się</a>
        </ul>
        </div>
      </div>
    </nav>
    <!--linki-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!--  CONTENT -->

    
<section id="contact">
      <div class="container">
         
            <div>
              <h1>Zaloguj sie!</h1>
            </div>
            <form action="login.php" method="post">
  <div class="form-group">
     <label>Login</label>
     <input type="text" placeholder="Login" style="background-color:white" name="username" class="form-control" required>
  </div>
  <div class="form-group">
     <label>Password</label>
     <input type="password" style="background-color:white" name="password" class="form-control" placeholder="Hasło" required>
  </div>
       <input type="submit" style="text-align:right" name="submit" value="Zaloguj!">
 </form>
             <div>
              <h1>Zarejestruj sie!</h1>
            </div>
            <form action="form.php" method="post">
  <div class="form-group">
     <label>Login</label>
     <input type="text" placeholder="Login" style="background-color:white" name="username" class="form-control" required>
  </div>
  <div class="form-group">
     <label>Password</label>
     <input type="password" style="background-color:white" name="password1" class="form-control" placeholder="Hasło" required>
  </div>
       <input type="submit" style="text-align:right" name="submit" value="Zajerestruj sie!">
 </form>
 

  <?php

    if(isset($_SESSION['error'])){
      echo '<span style="color: red; font-weight: bold;">'.$_SESSION['error'].'</span>';
      unset($_SESSION['error']);
    }
  ?>
        </div>
      </div>
    </section>
<br></br>

          <!-- Divider-->
          <hr class="my-4" />
          
        </div>
      </div>
    </div>

    <!--  FOOTER -->
    <footer>
      <div class="footer-top text-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
              <h4 class="navbar-brand">Wypożycz swój samochód marzeń!</h4>
              
                <p><i class="bx bxs-envelope"></i> Mikołaj Radwan Mikołaj Sarkowicz</p>
                <p><i class="bx bxs-phone-call"></i> +48 123456789</p>
              

              <div class="col-auto social-icons">
                <a href="https://www.facebook.com/profile.php?id=100005153190237"><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/radwanmikolaj/"><i class="bx bxl-instagram"></i></a>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom text-center">
        <p class="mb-0">Copyright@2022. All rights Reserved</p>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>