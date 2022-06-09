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


  <br>
  <br>
  <br>
  <br>
  <div class="container-fluid h-custom">


    <div class="row d-flex justify-content-center align-items-center h-100">

  
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <div class="row justify-content-center align-items-center">
            
         
        <p class="text-center h4 fw-bold mb-5 mx-1 mx-md-4 mt-1">Leki do utylizacji</p>
        <div class="row justify-content-center align-items-center">
        

<?php
$servername = "***";
$username="***";
$password="***";
$dbname="***";
$conn=mysqli_connect($servername,$username,$password,$dbname);

$uzytkownik1=$_SESSION["current_user"];



$query="SELECT leki.lek_id,dostepne_leki.ID_leku,leki.data_waznosci, leki.ilosc, dostepne_leki.Nazwa_leku FROM leki INNER JOIN dostepne_leki ON leki.id_leku_lista=dostepne_leki.ID_leku WHERE `user_id`='$uzytkownik1' AND leki.data_waznosci <= CURDATE()"; //You don't need a ; like you do in SQ

$result = mysqli_query($conn,$query);


?>

</div>
</div>

<table class="table table-bordered table-sm text-center" style="background-color: white">
    <thead>
    <tr style="background-color: #C4BDB8"><th>Nazwa leku</th><th>Ilość</th><th>Data ważności</th><th></th></tr>

<?php



    if (mysqli_num_rows($result)>0) {
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr><td>".$row["Nazwa_leku"]."</td><td>".$row["ilosc"]."</td><td>".$row["data_waznosci"]."</td><td><a href='./zutylizuj.php?ajdi=".$row["ID_leku"]."&ajdi_apteczne=".$row["lek_id"]."&nazwa=".$row["Nazwa_leku"]."'>Zutylizuj</a></td></tr>";
            
        }
    } else {
        
        echo "brak wynikow";
        
    
        
    }

        mysqli_close($conn);
    echo "</table>";
?>

</thead>
<tbody>

      </div>
      
    </div>
  </div>


</body>
</html>