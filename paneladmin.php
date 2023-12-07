<!DOCTYPE html>
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
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
  </head>

  <body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">
    <!--  NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
      <div class="container">
        <img style="width:65px" src="imgs/tlo.jpg" a href="paneladmin.php">
        <a class="navbar-brand" a href="paneladmin.php">Wypożyczalnia</a>
        <?php
session_start();

if(isset($_SESSION['logon']) && $_SESSION['logon'] == True){
  echo '<h1>Hello, '.$_SESSION['username'].'</h1><br/><a href="logout.php">Wyloguj się</a>';
}
else{
  $_SESSION['error'] = "Proszę się zalogować!";
  header('Location: rejestracja.php');
  exit();
}
?>
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
              <a  style="text-align:center" class="nav-link" href="zamowienia.php">Zamówienia</a>
            </li>
        </ul>
        </div>
      </div>
    </nav>
    <!--linki-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!--  CONTENT -->

    <!-- Main Content-->
    <div class="container px-4 px-lg-5 content-posts">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7"> 
          <!-- Post preview-->

		<h2>Lista Samochodów</h2>

<?php
require_once('db.php'); // Plik z połączeniem do bazy danych

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Marka</th><th>Model</th><th>Rok Produkcji</th><th>Dostępność</th><th>CenaZaDzien</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['car_id'] . "</td>";
        echo "<td>" . $row['brand'] . "</td>";
        echo "<td>" . $row['model'] . "</td>";
        echo "<td>" . $row['year'] . "</td>";
        echo "<td>" . $row['availability'] . "</td>";
		echo "<td>" . $row['pricefor1day'] . "</td>";
		echo "<td><form action='deletecar.php' method='post'><input type='hidden' name='id' value='" . $row['car_id'] . "'>
		<input type='submit' name='delete_car' value='Usuń'></form></td>";
        echo "</tr>";
		
    }
	

    echo "</table>";
} else {
    echo "Brak rekordów w tabeli.";
}

$conn->close();
?>
  <?php

    if(isset($_SESSION['error'])){
      echo '<span style="color: red; font-weight: bold;">'.$_SESSION['error'].'</span>';
      unset($_SESSION['error']);
    }
  ?>

		</div>
      </div>
    </div>
	<h3>Dodaj samochód</h3>
	<form action="addcar.php" method="post">
  <div class="form-group">
     <label>Brand</label>
     <input type="text" style="background-color:white" name="brand" class="form-control" placeholder="Brand" required>
  </div>
  <div class="form-group">
     <label>Model</label>
     <input type="text" style="background-color:white" name="model" class="form-control" placeholder="Model" required>
  </div>
    <div class="form-group">
     <label>year</label>
     <input type="text" style="background-color:white" name="year" class="form-control" placeholder="Year" required>
  </div>
 
      <div class="form-group">
     <label>Wartosc auta</label>
     <select name="values" id="cena">
  <option value="">--Please choose an option--</option>
  <option value=200>niski</option>
  <option value=300>sredni</option>
  <option value=500>wysoki</option>
</select>
  </div>


       <input type="submit" style="text-align:right" name="submit" value="Dodaj">
 </form>
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