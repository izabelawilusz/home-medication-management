<?php 
session_start();


?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta charset="UTF-8">
        <title>Historia operacji</title>
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
  
  <br>
  <br>
  <br>
  <br>
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
          <div class="row justify-content-center align-items-center">
          <p  class="text-center h4 fw-bold mb-5 mx-1 mx-md-4 mt-4">Wygeneruj raport kosztów</p>
</div>


<!-- FORM -->
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="form-group d-flex flex-row align-items-center mb-4">
        
        <div class=" col-1">
        <label class="form-label" for="date_from">Od</label>
        </div>
        <div class=" col-3">
       <input type="date" id="date_from" name="date_from"><br>
        </div>
            

       <div class=" col-1">
        <label class="form-label" for="date_to">Do</label>
        </div>
        <div class=" col-3">
       <input type="date" id="date_to" name="date_to"><br>
        </div>




<div class="form-group d-flex flex-row align-items-center mb-4">
<div class=" col-5">
    <label for="typ_operacji">Typ operacji</label>
</div>
<div class=" col-5">
      <select name="typ_operacji" >
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

            $result2 = "SELECT DISTINCT typ_operacji FROM historia_operacji WHERE `apteczka_ID`='$id_apt'";
            echo $result;
            // be sure do define $connection to be your database connection, or just change it in this code to match your configuration settings
            $runquery = mysqli_query($conn,$result2);

            while($row = mysqli_fetch_assoc($runquery)){
            // this will cycle through the array
            $val = $row['typ_operacji'];
            
            echo '<option value="' . $val . '">' . $val . '</option>';
            
                }

    ?>
</select></div></div>

<div class="row justify-content-center align-items-center">
<div class="col px-4 mx-2">


            <div class="btn-group mr-2" role="btn-group mr-2" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2 " role="group" aria-label="First group">
        <input type="submit" class="btn btn-secondary" value="Wyświetl" name="submit">
        </div>
        </div>
            </div>
       

</div></div>
</form>


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

if (isset($_POST['submit'])){

    // Jeśli dane w formularzu zostaną uzupełnione i zatwierdzone, szukanie odbywa się po datach i nazwie użytkownika
				
$date_from=date('Y-m-d',strtotime($_POST['date_from']));
$date_to=date('Y-m-d',strtotime($_POST['date_to']));
$operacja=$_POST["typ_operacji"];



$query = "SELECT historia_operacji.typ_operacji, dostepne_leki.Nazwa_leku, historia_operacji.ilosc, dostepne_leki.cena_leku, historia_operacji.user_id,  historia_operacji.data_operacji, users.user_fullname FROM historia_operacji INNER JOIN dostepne_leki ON dostepne_leki.ID_leku=historia_operacji.lek_id INNER JOIN users ON users.user_id=historia_operacji.user_id WHERE historia_operacji.apteczka_id='$id_apt' AND historia_operacji.typ_operacji='$operacja' AND `data_operacji` >= '$date_from' AND `data_operacji` <= '$date_to'  ORDER BY `historia_operacji`.`data_operacji` DESC";

$result = mysqli_query($conn,$query);



?>

<table class="table table-bordered table-sm text-center" style="background-color: white">
    <thead>
    <tr style="background-color: #C4BDB8"><th>Nazwa leku</th><th>Operacja</th><th>Ilość</th><th>Cena [1 szt.]</th><th>Data operacji</th></tr>



    <?php


if (mysqli_num_rows($result)>0) {
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr><td>".$row["typ_operacji"]."</td><td>".$row["Nazwa_leku"]."</td><td>".$row["ilosc"]."</td><td>".$row["cena_leku"]."</td><td>".$row["data_operacji"]."</td></tr>";
        $sum += ($row['ilosc']*$row['cena_leku']);

        if($row["typ_operacji"]=='Zazycie')
        {
            $naglowek='Koszt leków zażytych';
        }  
        if($row["typ_operacji"]=='Dodanie leku')
        {
           $naglowek= 'Koszt leków zakupionych' ;
        } 
        if($row["typ_operacji"]=='Utylizacja')
        {
            $naglowek='Koszt leków zutylizowanych';
        } 
         
    }

    echo '<p class="h7 py-3">'.$naglowek.' w okresie od: '.$date_from.' do '.$date_to.' :<b> '.$sum.' zł</b> </p>';
} else {
    echo "Brak elementów. <br> ";
}


    // mysqli_close($conn);
echo "</table>";

} else 



{
    // Jeśli nie wprowadzone i nie zatwierdzone są: daty i nazwa użytkownika po których się szuka to wyswietl cala historie zazyc wszystkich uzytkownikow

$query = "SELECT  historia_operacji.typ_operacji, dostepne_leki.Nazwa_leku, historia_operacji.ilosc, dostepne_leki.cena_leku, historia_operacji.user_id,  historia_operacji.data_operacji, users.user_fullname FROM historia_operacji INNER JOIN dostepne_leki ON dostepne_leki.ID_leku=historia_operacji.lek_id INNER JOIN users ON users.user_id=historia_operacji.user_id WHERE historia_operacji.apteczka_id='$id_apt'  ORDER BY `historia_operacji`.`data_operacji` DESC";

$result = mysqli_query($conn,$query);



?>

<table class="table table-bordered table-sm text-center" style="background-color: white">
    <thead>
    <tr style="background-color: #C4BDB8"><th>Operacja</th><th>Nazwa leku</th><th>Ilość</th><th>Cena [1 szt.]</th><th>Data operacji</th></tr>



    <?php


if (mysqli_num_rows($result)>0) {
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr><td>".$row["typ_operacji"]."</td><td>".$row["Nazwa_leku"]."</td><td>".$row["ilosc"]."</td><td>".$row["cena_leku"]."</td><td>".$row["data_operacji"]."</td></tr>";
        
    }
} else {
    echo "Nie posiadasz jeszcze żadnej historii operacji. <br> Aby zażyć lub zutylizować lek przejdź do twojej apteczki: <a href='./apteka_wyswietl_leki.php'>Twoja apteczka</a><br>";
}

    // mysqli_close($conn);
echo "</table>";
}
?>

</thead>
<tbody>

  </div>
  
</div>
</div>


</body>
</html>