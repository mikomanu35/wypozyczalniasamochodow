<?php
session_start();
include_once 'db.php';
if(isset($_POST['submit']))
{
     $rent_car_id = $_POST['rent_id'];
	 $rent_days=$_POST['days'];
     $logged_in_user_id=$_SESSION['user_id'];
	 $sql="select availability from cars where car_id=$rent_car_id";
	 $result=  $conn->query($sql);
	 if ($row = $result->fetch_assoc()) {
	 $rent_availability=$row["availability"];
	 }
     $sql = "INSERT INTO rentals (user_id, car_id, rental_date, return_date, days_difference, total_cost)
     VALUES ($logged_in_user_id, $rent_car_id, CURDATE(), DATE_ADD(CURDATE(), INTERVAL $rent_days DAY), DATEDIFF(DATE_ADD(CURDATE(), INTERVAL $rent_days DAY), CURDATE()), 
	 (SELECT pricefor1day FROM cars WHERE car_id = $rent_car_id) * $rent_days)";
     
	try{	
		if($rent_availability=='Niedostepny'){
				$_SESSION['error'] = "Nie mozna wynajac auta bo jest juz wynajete!";
				header('Location: panelklient.php');
		}else{
			if (mysqli_query($conn, $sql)) {
				$sql="UPDATE cars SET availability='Niedostepny' WHERE car_id=$rent_car_id ";
				mysqli_query($conn, $sql);
				$sql = "SET @count = 0";
				mysqli_query($conn, $sql);

				$sql = "UPDATE rentals SET rental_id = @count:= @count + 1";
				mysqli_query($conn, $sql);

				$sql = "ALTER TABLE rentals AUTO_INCREMENT = 1";
				mysqli_query($conn, $sql);
				echo "Twoje dane zostały dodane do naszej bazy danych! Dziękujemy, spodziewaj się szybkiej odpowiedzi!";
				header('Location: panelklient.php');
			} else {
				$_SESSION['error'] = "Złe dane";
				header('Location: panelklient.php');
			}
			$_SESSION['error'] = "Wynająłes auto!";
				header('Location: panelklient.php');
		}
	}catch	(Exception $e) {
		$_SESSION['error'] = "Nie ma takiego id auta!";
		header('Location: panelklient.php');
	}
	
	

    mysqli_close($conn);	
}
?>