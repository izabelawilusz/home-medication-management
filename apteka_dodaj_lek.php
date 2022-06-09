<?php 
session_start();
// echo session_id();

if($_SESSION['status']!="Active")
{
 header("location:apteka_logowanie.php");
}


?>

<?php
$servername = "***";
$username="***";
$password="***";
$dbname="***";
$conn=mysqli_connect($servername,$username,$password,$dbname);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dodaj nowy lek</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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


 <section class="vh-100" style="background-color: #eee;">
<div class="container h-100">
<div class="row d-flex justify-content-center align-items-center h-100">
<div class="col-lg-12 col-xl-11">
<div class="card text-black" style="border-radius: 25px;">
<div class="card-body p-md-5">
<div class="row justify-content-center">
<div class="col-md-8 col-lg-6 col-xl-4 order-2 order-lg-1">

<p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4">Dodaj nowy lek</p>

<div class="row justify-content-center">

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<!-- <form role="form" method="post" action="" autocomplete="off" > -->

        <div class="form-group d-flex flex-row align-items-center mb-4">
        <div class= "col-5">
        <label for="apteka">Wybierz lek</label>
        </div>
        <div class= "col-5">
        <select name="apteka" >
    
            <?php
            $result = "SELECT Nazwa_leku FROM dostepne_leki";
            // be sure do define $connection to be your database connection, or just change it in this code to match your configuration settings
            $runquery = mysqli_query($conn,$result);
            while($row = mysqli_fetch_assoc($runquery)){
            // this will cycle through the array
            $val = $row['Nazwa_leku'];
            echo '<option value="' . $val . '">' . $val . '</option>';
                }

            ?>
        </select><br>
            </div>
        </div>
    
        
        <div class="form-group d-flex flex-row align-items-center mb-4">
        <div class= "col-5">
        <label class="form-label" for="ilosc">Ilość </label>
        </div>
        <div class= "col-5">
        <input type="number" id="ilosc" name="ilosc"><br>
        </div>
        </div>
        

     
        <div class="form-group d-flex flex-row align-items-center mb-4">
        <div class= "col-5">
        <label class="form-label" for="datawaznosci">Data ważności</label>
        </div>
        <div class= "col-5">
       <input type="date" id="datawaznosci" name="data"><br>
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
                    $nazwa_leku=$_POST["apteka"];
                    $data=$_POST["data"];
                    $ilosc=$_POST["ilosc"];
                    $uzytkownik=$_SESSION["current_user"];
                    $typoperacji="Dodanie leku";

                    echo $apteka;
                         
            
            
            $servername = "mysql.agh.edu.pl";
            $username="alekszmi";
            $password="olasz22";
            $dbname="alekszmi";
            $conn=mysqli_connect($servername,$username,$password,$dbname);
            if (!$conn) {
            die("Connection failed:".mysqli_connect_error());
            }


            

            $searchid = "SELECT ID_leku FROM dostepne_leki WHERE Nazwa_leku='$nazwa_leku'";
            $myresult=mysqli_query($conn,$searchid);
            $rzedy=mysqli_num_rows($myresult);
            
            if($rzedy==1) {
                
                $record = mysqli_fetch_assoc($myresult);
                $lek= $record['ID_leku'];

            }
            else {
                echo "Blad";
            }


            
            $uzytkownik=$_SESSION["current_user"];
            $result1=mysqli_query($conn,"SELECT apteczka_ID FROM users WHERE user_id='$uzytkownik'");
            $rzedy=mysqli_num_rows($result1);
            
            if($rzedy==1) {
               
                $record = mysqli_fetch_assoc($result1);
                $id_apt= $record['apteczka_ID'];

            }
            else {
                echo "Blad";
            }


            $sql="INSERT INTO `leki` (`lek_id`,`id_leku_lista`,`user_id`,`id_apteczki`,`data_waznosci` ,`ilosc`) VALUES (NULL,'".$lek."','".$uzytkownik."','".$id_apt."', '".$data."','".$ilosc."')";

        if  (mysqli_query($conn,$sql)) {
                    
        } else {
                echo "Błąd : " . $sql . "<br>" . mysqli_error($conn);

        }



        
        $sqli="INSERT INTO `historia_operacji` (`operacja_id`,`user_id`,`typ_operacji`,`ilosc`,`lek_id`,`apteczka_id`,`data_operacji`) VALUES (NULL,'".$uzytkownik."', '".$typoperacji."','".$ilosc."', '".$lek."', '".$id_apt."',CURDATE())";


        if  (mysqli_query($conn,$sqli)) {
        echo "Dopisano!";
  


        } else {
        echo "Błąd : " . $sqli . "<br>" . mysqli_error($conn);

        }
    }

?>

</html>