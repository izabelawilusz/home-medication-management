<?php 
session_start();
?>


<!DOCTYPE html>
<html>



    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta charset="UTF-8">
        <title>Twoja apteczka</title>
        
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
                            <?php
                            if(isset($_SESSION["current_user"])) {
                            
                            echo '<li class="nav-item">
                            <a class="nav-link text-light" href="./start.php">Strona główna </i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="./apteka_wyswietl_leki.php">Twoja apteczka </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="./historia_operacji.php">Historia operacji </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="./apteka_dodaj_lek.php">Dodaj lek </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="./raporty.php">Raporty </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-right">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="./logout.php">Wyloguj</a>
                        </li>
                    </ul>'; 
                            } else {
                                echo '<li class="nav-item">
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
                        </ul>'; 
                            } 
                            ?>
                                                        </div>
                </div>
            </nav>
</div>

   
  </header>


  <?php
$servername = "***";
$username="***";
$password="***";
$dbname="***";
$conn=mysqli_connect($servername,$username,$password,$dbname);

$uzytkownik1=$_SESSION["current_user"];
// echo"$uzytkownik1";


$query="SELECT leki.lek_id,dostepne_leki.ID_leku,leki.data_waznosci, leki.ilosc, dostepne_leki.Nazwa_leku FROM leki INNER JOIN dostepne_leki ON leki.id_leku_lista=dostepne_leki.ID_leku WHERE `user_id`='$uzytkownik1' AND leki.data_waznosci <= CURDATE()"; //You don't need a ; like you do in SQ

$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result)>0) {
    echo '<div class="alert alert-danger"" role="alert">
    <p class="alert-heading ">Uwaga! Masz w swojej apteczce przeterminowane leki!  <a href="./do_utylizacji.php" >  Kliknij aby zutylizować</a></p>
    </div>';
   }

    mysqli_close($conn);

?>
   
</div>

  <br>
  <br>
  <br>
  <br>
 
  <?php
    if(isset($_SESSION["current_user"])) {
        echo'

  <div class="container-fluid h-custom ">


    <div class="row d-flex justify-content-center align-items-center h-100 pb-5 mb-10" >

    <!-- <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="./image.jpg" class="img-fluid rounded-circle border" alt="Image">
      </div> -->
      
      <div class="col-md-10 col-lg-7 col-xl-5 offset-xl-1">
      
      <div class="card text-black" style="border-radius: 25px;">
    <div class="card-body p-md-5">

    <div class="row justify-content-center align-items-center">
    <h2 class="card-title pt-1 pb-2">Witaj!</h5>
</div>


<div class="row justify-content-center align-items-center">
    <h5 class="card-subtitle mb-5 text-muted">Jesteś zalogowany do swojej apteczki! </h6>
    
    <p class="card-text"></p>
</div>

    <div class="row justify-content-center align-items-center">
    <img src="./image.jpg" class="img-fluid w-50 rounded-circle border" alt="Pills">
</div>

    <div class="row justify-content-center align-items-center pt-5">
    <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="apteka_dodaj_lek.php">
        <button type="submit" class="btn btn-secondary">Dodaj nowy lek</button>
        </a>
  </div>
  <div class="btn-group mr-2" role="group" aria-label="Second group">
        <a href="historia_operacji.php">
        <button type="submit" class="btn btn-secondary">Wyświetl historię operacji</button>
        </a>
</div>
  
</div>

          
          
                </div>
                </div>
                </div>
                </div>

'; 
    }

else {
    echo'

    <div class="container-fluid h-custom ">
  
  
      <div class="row d-flex justify-content-center align-items-center h-100 pb-5 mb-10" >
  
      <!-- <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="./pills.jpg" class="img-fluid rounded-circle border" alt="Pills">
        </div> -->
        
        <div class="col-md-10 col-lg-7 col-xl-5 offset-xl-1">
        
        <div class="card text-black text-center" style="border-radius: 25px;">
      <div class="card-body p-md-5">
  
      <div class="row justify-content-center align-items-center">
      <h2 class="card-title pt-1 pb-2">Witaj!</h5>
  </div>
  
  
  <div class="row justify-content-center align-items-center">
      <h5 class="card-subtitle mb-5 text-muted">Aby móc korzystać z apteczki musisz się zalogować lub zarejestrować </h6>
      
      <p class="card-text"></p>
  </div>
  
      <div class="row justify-content-center align-items-center">
      <img src="./pills.jpg" class="img-fluid rounded border" alt="Pills">
  </div>
  
      <div class="row justify-content-center align-items-center pt-5">
      <div class="btn-group mr-2" role="group" aria-label="First group">
          <a href="apteka_logowanie.php">
          <button type="submit" class="btn btn-secondary">Zaloguj się</button>
          </a>
    </div>
    <div class="btn-group mr-2" role="group" aria-label="Second group">
          <a href="apteka_rejestracja_x.php">
          <button type="submit" class="btn btn-secondary">Zarejestruj się</button>
          </a>
  </div>
    
  </div>
  
            
            
                  </div>
                  </div>
                  </div>
                  </div>
  
  '; 
}
     ?>   


</body>
</html>