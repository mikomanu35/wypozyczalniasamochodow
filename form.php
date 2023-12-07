<?php
session_start();
include_once 'db.php';
if(isset($_POST['submit']))
{
     $username = $_POST['username'];
     $password = $_POST['password1'];
     $usertype = 'user';
     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
     
     $sql = "INSERT INTO users (username,password,user_type)
     VALUES ('$username','$hashedPassword','$usertype')";
     try{
		 if (mysqli_query($conn, $sql)) {
        $_SESSION['error'] = "Pomyślnie zajerestrowano!";
		header('Location:rejestracja.php');
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
	 }catch(Exception $e){
		$_SESSION['error'] = "Istnieja taki login";
		header('Location: rejestracja.php');
	}
		$sql = "SET @count = 0";
	mysqli_query($conn, $sql);

	$sql = "UPDATE users SET user_id = @count:= @count + 1";
	mysqli_query($conn, $sql);

	$sql = "ALTER TABLE users AUTO_INCREMENT = 1";
	mysqli_query($conn, $sql);
     mysqli_close($conn);
}
?>