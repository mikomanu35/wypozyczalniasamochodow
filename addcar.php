<?php
session_start();
include_once 'db.php';

if(isset($_POST['submit'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $availability = "Dostepne";
    $value = $_POST['values'];

    $free_id_sql = "SELECT MIN(t1.car_id + 1) AS free_id
                    FROM cars AS t1
                    LEFT JOIN cars AS t2 ON t1.car_id + 1 = t2.car_id
                    WHERE t2.car_id IS NULL";

    $result = mysqli_query($conn, $free_id_sql);
    $row = mysqli_fetch_assoc($result);
    $free_id = $row['free_id'];

    if (!$free_id) {
        
        $max_id_sql = "SELECT MAX(car_id) AS max_id FROM cars";
        $result = mysqli_query($conn, $max_id_sql);
        $row = mysqli_fetch_assoc($result);
        $free_id = $row['max_id'] + 1;
    }

    $sql = "INSERT INTO cars (car_id, brand, model, year, availability, car_value, pricefor1day)
            VALUES ('$free_id', '$brand', '$model', '$year', '$availability', 
            (SELECT car_value FROM price WHERE pricefor1day = '$value'), '$value')";

    if (mysqli_query($conn, $sql)) {
         $_SESSION['error']="Auto zostało dodane do bazy danych!";
        header('Location:paneladmin.php');
    } else {
         $_SESSION['error']= "Error: " . $sql . ":-" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>