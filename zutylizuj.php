<?php 
session_start();



?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta charset="UTF-8">
        <title>Utylizacja leku</title>
    </head>
    <body style="background-color: #eee; ">


<?php



$servername = "***";
$username="***";
$password="***";
$dbname="***";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if (!$conn) {
    die("Connection failed:".mysqli_connect_error());
}




$nazwa_leku=$_GET["nazwa"];
$uzytkownik=$_SESSION["current_user"];
$idleku=$_GET['ajdi'];
$idleku_apteczne=$_GET['ajdi_apteczne'];
$typoperacji="Utylizacja";



$result1=mysqli_query($conn,"SELECT apteczka_ID FROM users WHERE user_id='$uzytkownik'");
$rzedy=mysqli_num_rows($result1);
            
            if($rzedy==1) {
                
                $record = mysqli_fetch_assoc($result1);
                $id_apt= $record['apteczka_ID'];

            }
            else {
                echo "Blad";
            }



$result2=mysqli_query($conn,"SELECT ilosc FROM leki WHERE `lek_id`='$idleku_apteczne'");
$rzedy=mysqli_num_rows($result2);

            
            if($rzedy==1) {
                
                $record = mysqli_fetch_assoc($result2);
                $ilosc_leku= $record['ilosc'];
                echo $ilosc_leku;

            }
            else {
                echo "Blad nooo";
            }


$sqli="INSERT INTO `historia_operacji` (`operacja_id`,`user_id`,`typ_operacji`,`ilosc`,`lek_id`,`apteczka_id`,`data_operacji`) VALUES (NULL,'".$uzytkownik."', '".$typoperacji."','".$ilosc_leku."', '".$idleku."', '".$id_apt."',CURDATE())";


if  (mysqli_query($conn,$sqli)) {
   


} else {
echo "Błąd : " . $sqli . "<br>" . mysqli_error($conn);

}




$sql="DELETE FROM `leki` WHERE `lek_id`=".$idleku_apteczne;
            $eresult=mysqli_query($conn,$esql);

if  (mysqli_query($conn,$sql)) {
    echo '
    <section class="vh-100" style="background-color: #eee;">
<div class="container h-100">
<div class="row d-flex justify-content-center align-items-center h-100">
<div class="col-lg-12 col-xl-11">
<div class="card text-black" style="border-radius: 25px;">
<div class="card-body p-md-5">
<div class="row justify-content-center">
<div class="col-md-8 col-lg-6 col-xl-4 order-2 order-lg-1">
    <p class="text-center h5 fw-bold mb-5 mx-1 mx-md-4 mt-4">Zutylizowano pomyślnie! </p>
    </p></div></div>
    <div class="row d-flex justify-content-center align-items-center h-100"> <a href="./apteka_wyswietl_leki.php">
    <button type="submit" class="btn btn-secondary">Wyświetl apteczkę</button>
     </a>
     </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</section> ';

        
    

} else {
        echo "Błąd : " . $sql . "<br>" . mysqli_error($conn);

}



?>


 </body>
</html>