<?php
ob_start();

$servername = "***";
$username="***";
$password="***";
$dbname="***";
$dbconn=mysqli_connect($servername,$username,$password,$dbname);

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



  <div class="container h-100 mt-5">
<div class="row d-flex justify-content-center align-items-center h-100">
<div class="col-lg-12 col-xl-8">
<div class="card text-black" style="border-radius: 25px;">
<div class="card-body p-md-5">
<div class="row justify-content-center">
<div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

<p class="text-center h3 fw-bold mb-5 mx-1 mx-md-4 mt-4">Zarejestruj się</p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


      <div class="form-group row">
        <label for="inputEmail" class="col-sm-6 col-form-label">Email</label>
        <div class="col-sm-12">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputUser" class="col-sm-6 col-form-label">User Name</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="inputUser" name="user" placeholder="Username">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-6 col-form-label">Password</label>
        <div class="col-sm-12">
          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
        </div>
      </div>


      <label for="apteczka">Wybierz apteczkę</label>
      <select name="apteczka" >
      <?php
            $result = "SELECT Nazwa_apteczki FROM apteczki";
            // be sure do define $connection to be your database connection, or just change it in this code to match your configuration settings
            $runquery = mysqli_query($dbconn,$result);
            while($row = mysqli_fetch_assoc($runquery)){
            // this will cycle through the array
            $val = $row['Nazwa_apteczki'];
            echo '<option value="' . $val . '">' . $val . '</option>';
                }

    ?>
</select>


<div class="row justify-content-center align-items-center pt-4">
      <div class="form-group row">
        <div class=" col-sm-10">
          <input type="submit" value="Zarejestruj się" name="submit" class="btn btn-primary"/>
        </div>
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


    <?php

$user_fullname=$user_email=$user_password=$nazwa_apteczki="";

function chgw($dane) {
    $dane=trim($dane);
    $dane= stripslashes($dane);
    $dane=htmlspecialchars($dane);
    return $dane;
}


        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            if (empty($_POST["user"])) {
                $imErr="Musisz podać imię!";   
                } else {
                    $user=chgw($_POST["user"]);
                }
                if (empty ($_POST["email"])) {
                    $mailErr= "Musisz podać email!";
                    
                }else {
                    $email=chgw($_POST["email"]);
                }
                if (empty($_POST["password"])) {
                    $passErr= "Musisz podać hasło!";
                } else {
                    $pass=chgw($_POST["password"]);
                }
                if (empty($_POST["apteczka"])) {
                    $aptErr= "Musisz wpisac!";
                } else {
                    $nazwa_apteczki=chgw($_POST["apteczka"]);
                }
              
              echo "<br>".$imErr."<br>".$mailErr."<br>".$passErr."<br>";
            
            $servername = "***";
            $username="***";
            $password="***";
            $dbname="***";

            $dbconn=mysqli_connect($servername,$username,$password, $dbname);
            $user_fullname=mysqli_real_escape_string($dbconn,$user);
            $user_email=mysqli_real_escape_string($dbconn,$email);
            $user_password=mysqli_real_escape_string($dbconn, $pass);
            
            $user_password_hash=password_hash($user_password,PASSWORD_DEFAULT);
            
        
        
                if((!empty($user_email))and(!empty($user_password))and(!empty($user_fullname))){
                    
                    $query3="SELECT * FROM `users` WHERE `user_email`='$user_email'";
                    $result3 = mysqli_query($dbconn, $query3);
                    $ilosc3=mysqli_num_rows($result3);
                    
                    if ($ilosc3==0)
                    {   $searchid = "SELECT Id_apteczki FROM apteczki WHERE Nazwa_apteczki='$nazwa_apteczki'";
            
          
                        $myresult=mysqli_query($dbconn, "SELECT Id_apteczki FROM apteczki WHERE Nazwa_apteczki='$nazwa_apteczki'");
                        $rzedy=mysqli_num_rows($myresult);
            
                        
            
                        if($rzedy==1) {
                            
                            $record = mysqli_fetch_assoc($myresult);
                            $id_apteczki= $record['Id_apteczki'];
                            $result=mysqli_query($dbconn, "INSERT INTO users ( `user_email`, `user_passwordhash`, `user_fullname`, `apteczka_ID`) VALUES ( '".$user_email."', '".$user_password_hash."','".$user_fullname."', '".$id_apteczki."')");
                                    if (!$result)
                                    {
                                      die('Error: ' . mysql_error());
                                              }
                                else {
                                    
                                    header("Location: apteka_logowanie.php");
                                }
        
                    
                    }else {
                        echo '<div class="alert alert-warning" role="alert">
                        <p class="alert-heading ">Błąd bazy. Nie istnieje taka apteczka. </p>
                        </div>';
                       
                    }
                
                }   
                 else {
                    echo '<div class="alert alert-warning" role="alert">
                    <p class="alert-heading ">Istnieje już konto o podanym mailu! </p>
                    </div>';
                    
                }

            }
            mysql_close($dbconn);

        }
            else {
               
            }
        
            ?>



</body>
</html>