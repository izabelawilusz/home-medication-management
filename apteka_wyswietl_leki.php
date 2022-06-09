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
                                    <li class="nav-item">
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
                                </ul>                    </div>
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


  <br>
  <br>
  <br>
  <br>
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
        
      <div class="col-md-9 col-lg-6 col-xl-5">
          <div class="row justify-content-center align-items-center">
          <p class="text-center h4 fw-bold mb-5 mx-1 mx-md-4 mt-1">Twoja apteczka</p>
</div>

<?php
$servername = "***";
$username="***";
$password="***";
$dbname="***";
$conn=mysqli_connect($servername,$username,$password,$dbname);


$uzytkownik=$_SESSION["current_user"];
$result1=mysqli_query($conn,"SELECT apteczka_ID FROM users WHERE user_id='$uzytkownik'");
$rzedy=mysqli_num_rows($result1);
            
            if($rzedy==1) {
                // echo "IM HERE";
                $record = mysqli_fetch_assoc($result1);
                $id_apt= $record['apteczka_ID'];

            }
            else {
                echo "Blad";
            }



$query1= "DELETE FROM `leki` WHERE `ilosc`=0";
$result1 = mysqli_query($conn,$query1);
            

$query = "SELECT leki.lek_id,dostepne_leki.ID_leku,leki.data_waznosci, leki.ilosc, dostepne_leki.Nazwa_leku FROM leki INNER JOIN dostepne_leki ON leki.id_leku_lista=dostepne_leki.ID_leku WHERE `id_apteczki`='$id_apt'"; //You don't need a ; like you do in SQL

$result = mysqli_query($conn,$query);
//$ilosc=mysqli_num_rows($result);
//echo $ilosc;


?>

<table class="table table-bordered table-sm text-center" style="background-color: white">
    <thead>
    <tr style="background-color: #C4BDB8"><th>Nazwa leku</th><th>Ilość</th><th>Data ważności</th><th colspan="2">Operacje</th></tr>

<?php



    if (mysqli_num_rows($result)>0) {
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr><td>".$row["Nazwa_leku"]."</td><td>".$row["ilosc"]."</td><td>".$row["data_waznosci"]."</td><td><a href='./zazycie.php?ajdi=".$row["ID_leku"]."&ajdi_apteczne=".$row["lek_id"]."&nazwa=".$row["Nazwa_leku"]."&ilosc=".$row["ilosc"]."'>Zażyj</a></td><td><a href='./zutylizuj.php?ajdi=".$row["ID_leku"]."&ajdi_apteczne=".$row["lek_id"]."&nazwa=".$row["Nazwa_leku"]."'>Zutylizuj</a></td></tr>";
            
        }
    } else {
        
        echo "W twojej apteczce nie ma jeszcze żadnych leków. <a href='./apteka_dodaj_lek.php'>Dodaj lek</a>";
    
        
    }

        mysqli_close($conn);
    echo "</table>";

?>

</thead>
<tbody>

      </div>
      
    </div>
  </div>
  
  <!-- <div class="row justify-content-center align-items-center py-5">
  <a href="historia_operacji.php">
    <button type="submit" class="btn btn-secondary">Wyświetl historię operacji</button>
 </a>
</div> -->
<div class="row justify-content-center align-items-center py-5">
<div class="form-group d-flex flex-row align-items-center mb-4">
<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
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



</body>
</html>