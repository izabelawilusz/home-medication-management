<?php 

session_start();


if(isset($_SESSION["current_user"])) {
  header("Location:start.php"); 
  exit; 
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
<title>Domowa apteczka</title>
<meta charset="UTF-8">
</head>
<body style="background-color: #eee; ">

<header>


<div class="bg-dark text-white">
<nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-dark border-bottom box-shadow">
                <div class="container-fluid">
                    <a class="navbar-brand text-light" >Apteczka </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                            <ul class="navbar-nav col-12 col-lg-auto my-2 justify-content-center my-md-0  text-small">
                                    <li class="nav-item">
                                        <a class="nav-link text-light" href="./start.php">Strona główna </i></a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav navbar-right">
                                    <li class="nav-item">
                                        <a class="nav-link text-light" href="./apteka_rejestracja_x.php">Zarejestruj się</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-light" href="./apteka_logowanie.php">Zaloguj</a>
                                    </li>
                                </ul>                    </div>
                </div>
            </nav>
</div>

   
  </header>

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  


<div class="container h-100">
<div class="row d-flex justify-content-center align-items-center h-100">
<div class="col-lg-12 col-xl-8">
<div class="card text-black" style="border-radius: 25px;">
<div class="card-body p-md-5">
<div class="row justify-content-center">
<div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

<p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Zaloguj się</p>

<form role="form" method="post" action="" autocomplete="off" >
<div class="form-group d-flex flex-row align-items-center mb-4">
      <div class= "col-5">
      <label class="form-label" for="inputEmail">E-mail </label>
    </div>
        <div class= "col-8">
        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
        </div>

      </div>

      
      <div class="form-group d-flex flex-row align-items-center mb-4">
      <div class= "col-5">
      <label class="form-label" for="inputPassword">Password </label>
        </div>
        <div class= "col-8">
          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
          
        </div>
      </div>

      <div class="row justify-content-center align-items-center">
      <div class="form-group d-flex flex-row align-items-center mb-4">
        <div class="d-flex justify-content-center mx-4 mb-2 mb-lg-4">
        <input type="submit" value="Zaloguj się" name="submit" class="btn btn-primary"/>
        </div>
        </div>
</div>
<div class="row justify-content-center align-items-center">
        <div class= "form-group d-flex flex-row align-items-center mb-4">
        Nie masz jeszcze konta?<a href="apteka_rejestracja_x.php" class="link-primary">  Zarejestruj się!</a>
        </div>
</div>
    </form>
    

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>




 

<?php


if ($_SERVER["REQUEST_METHOD"]=="POST"){

$servername = "***";
$username="***";
$password="***";
$dbname="***";

$dbconn=mysqli_connect($servername,$username,$password, $dbname);
$user_email=mysqli_real_escape_string($dbconn,$_POST["email"]);
$user_password=mysqli_real_escape_string($dbconn, $_POST["password"]);
$query="SELECT * FROM `users` WHERE `user_email`='$user_email'";
$result = mysqli_query($dbconn, $query);
$ilosc=mysqli_num_rows($result);
// echo $query;

// echo $ilosc;

if($ilosc==1) {
    // echo "IM HERE";
    $record = mysqli_fetch_assoc($result);
    // echo $record["user_id"];
    $hash=$record["user_passwordhash"];

    if(password_verify($user_password,$hash))
    {
        $_SESSION["current_user"] = $record["user_id"];


    }

    else{
      echo "Zle haslo";
    }
}

if(isset($_SESSION["current_user"])){
    // echo "Uzytkownik jest zalogowany: " .$_SESSION["current_user"];
    $_SESSION['status']="Active";
    header('Location: start.php');
    exit();
    

    

} else {
    echo "Błędne dane logowania";
    
}

}

?>
</body>
</html>