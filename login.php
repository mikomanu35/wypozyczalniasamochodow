<?php
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
  if(strlen($_POST['username']) < 3 || strlen($_POST['password']) < 3){
    $_SESSION['error'] = "Dane muszą mieć więcej niż 3 znaki!";
    header('Location: rejestracja.php');
    exit();
  }
  else{
    $username = htmlentities($_POST['username'], ENT_QUOTES, "UTF-8");
    $password = $_POST['password'];

    


    try{
      $connection = new mysqli("localhost", "root", "", "wypozyczalniasamochodow");
      

      if($connection->connect_errno != 0){
        throw new Exception(mysqli_connect_errno());
      }
      else{
        if($reply = mysqli_query($connection, "SELECT * FROM users WHERE username='$username'")){
            if($reply->num_rows > 0){
                $row = $reply->fetch_assoc();
                if(password_verify($password, $row['password'])&& $username == 'admin'){
                    $_SESSION['logon'] = True;
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_id'] = $row['user_id'];

        
                    $connection->close();
                    header('Location: paneladmin.php');
                    exit();
                } else if (password_verify($password, $row['password'])){
                  $_SESSION['logon'] = True;
                  $_SESSION['username'] = $row['username'];
				  $_SESSION['user_id'] = $row['user_id'];
      
                  $connection->close();
                  header('Location: panelklient.php');
                  exit();
                }else {
                    $_SESSION['error']="Błąd logowania: Hasło nieprawidłowe.";
                    header('Location: rejestracja.php');
                    exit();
                }
            } else {
            
                $_SESSION['error']="Błąd logowania: Brak użytkownika o nazwie '$username'.";
                header('Location: rejestracja.php');
                exit();
            }
        } else {
            $_SESSION['error'] = "Błąd zapytania bazy danych!";
            error_log("Błąd logowania: Zapytanie nie powiodło się.");
            header('Location: rejestracja.php');
            exit();
        }
      }
    }
    catch(Exception $e){
      $_SESSION['error'] = "Błąd bazy danych!";
      header('Location: rejestracja.php');
      exit();
    }
  }
}
else{
  $_SESSION['error'] = "Proszę wprowadzić dane!";
  header('Location: rejestracja.php');
  exit();
}
?>
