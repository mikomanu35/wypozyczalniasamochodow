<?php

session_start();
include_once 'db.php';

if (isset($_POST['id'])) {
    $car_delete = $_POST['id'];
    $car_delete = mysqli_real_escape_string($conn, $car_delete);

    $check_rentals_sql = "SELECT * FROM rentals WHERE car_id = $car_delete";
    $result = mysqli_query($conn, $check_rentals_sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Nie można usunąć - Auto jest juz wynajete!";
        header('Location: paneladmin.php');
        exit();
    }

  
    $sql = "DELETE FROM cars WHERE car_id = $car_delete";

    try {
        if (mysqli_query($conn, $sql)) {
            $_SESSION['error'] = "Dane zostały usunięte z bazy danych!";
            header('Location: paneladmin.php');
            exit();
        } else {
            $_SESSION['error'] = "Nie udało się usunąć danych z bazy danych!";
            header('Location: paneladmin.php');
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = mysqli_error($conn);
        header('Location: paneladmin.php');
        exit();
    }

    mysqli_close($conn);
}
?>
