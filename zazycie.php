<?php 
session_start();



?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta charset="UTF-8">
        <title>Zażycie leku</title>
    </head>
    <body>

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



<section class="vh-100" style="background-color: #eee;">
<div class="container h-100">
<div class="row d-flex justify-content-center align-items-center h-100">
<div class="col-lg-12 col-xl-11">
<div class="card text-black" style="border-radius: 25px;">
<div class="card-body p-md-5">
<div class="row justify-content-center">
<div class="col-md-8 col-lg-6 col-xl-4 order-2 order-lg-1">

<p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4">Zażyj</p>

<div class="row justify-content-center">

<form method="post" action="">

<!-- <form role="form" method="post" action="" autocomplete="off" > -->
    
        <div class="form-group d-flex flex-row align-items-center mb-4">
        <div class= "col-5">
        <label class="form-label" for="leknazwa">Nazwa leku </label>
        </div>
        <div class= "col-5">
        <input type="text" name="leknazwa" readonly value="<?php echo $_GET['nazwa'];?>"><br>
        </div>
        </div>

        <div class="form-group d-flex flex-row align-items-center mb-4">
        <div class= "col-5">
        <label class="form-label" for="ilosc">Ilość </label>
        </div>
        <div class= "col-5">
        <input type="number" name="ilosc" min="0" max="<?php echo $_GET['ilosc'];?>">
        </div>
        </div>


<div class="row justify-content-center mt-5">   
<div class="form-group d-flex flex-row align-items-center mb-4">
<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group mr-2" role="group" aria-label="First group">
    <button type="submit" class="btn btn-secondary">Wpisz</button>
  </div>
  <div class="btn-group mr-2" role="group" aria-label="Second group">
    <button type="reset" class="btn btn-secondary">Nie wpisuj</button>
  </div>
</div>
</div>
</div>


</form>

</div>
</div>
</div>
</div>
</div>

<div class="row justify-content-center">
<div class="form-group d-flex flex-row align-items-center py-5">
        <div class="d-flex justify-content-center">
        <a href="apteka_wyswietl_leki.php">
        <!-- <input type="submit" value="Wyświetl apteczke"> -->
        <button type="submit" class="btn btn-secondary">Wyświetl apteczkę</button>
        </a>
        </div>
        </div>
            </div>
        

</div>
</div>
</div>


</section>

<?php



            
            if ($_SERVER["REQUEST_METHOD"]=="POST") {
                    $nazwa_leku=$_POST["leknazwa"];
                    $ilosc_leku=$_POST["ilosc"];
                    
                    $uzytkownik=$_SESSION["current_user"];

                    $idleku=$_GET['ajdi'];
                    $idleku_apteczne=$_GET['ajdi_apteczne'];
                    $typoperacji="Zazycie";

                    echo "kto dopisal:".$uzytkownik;
                            
            
            
                    
            
            
            $servername = "***";
            $username="***";
            $password="***";
            $dbname="***";
            $conn=mysqli_connect($servername,$username,$password,$dbname);
            if (!$conn) {
            die("Connection failed:".mysqli_connect_error());
            }

            $esql="SELECT `ilosc` FROM `leki` WHERE `lek_id`='$idleku_apteczne'";
            $eresult=mysqli_query($conn,$esql);

        if  (mysqli_num_rows($eresult)>0) {
            while($erow=mysqli_fetch_assoc($eresult)){
                $zostalo=$erow["ilosc"]-$ilosc_leku;
            }
                    
        } else {
            echo "Błąd : " . $sqle . "<br>" . mysqli_error($conn);
    
    }
        if ($zostalo==!0){
        $sqle="UPDATE `leki` SET `ilosc`='$zostalo' WHERE `lek_id`='$idleku_apteczne'";


        if  (mysqli_query($conn,$sqle)) {
            echo "Dopisano!";
            echo $idleku;
            echo $zostalo;
            echo $nazwa_leku;


} else {
        echo "Błąd : " . $sqle . "<br>" . mysqli_error($conn);

}
        }
        else {
            $sqld="DELETE FROM `leki` WHERE `lek_id`='$idleku_apteczne'";
            $eresult=mysqli_query($conn,$sqld);

        }

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



$sqli="INSERT INTO `historia_operacji` (`operacja_id`,`user_id`,`typ_operacji`,`ilosc`,`lek_id`,`apteczka_id`,`data_operacji`) VALUES (NULL,'".$uzytkownik."', '".$typoperacji."','".$ilosc_leku."', '".$idleku."', '".$id_apt."',CURDATE())";


if  (mysqli_query($conn,$sqli)) {
    echo "Dopisano!";
  


} else {
echo "Błąd : " . $sqli . "<br>" . mysqli_error($conn);

}
}


?>