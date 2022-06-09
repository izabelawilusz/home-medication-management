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
                            
                        </ul>
                        <ul class="navbar-nav navbar-right">
                        <li class="nav-item">
                                <a class="nav-link text-light" href="./apteka_rejestracja_x.php">Zarejestruj się</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="./apteka_logowanie.php">Zaloguj</a>
                            </li>
                        </ul>
                            
                                                        </div>
                </div>
            </nav>
</div>

   
  </header>

</div>

  <br>
  <br>
  <br>
  <br>
 
 

  <div class="container-fluid h-custom ">


    <div class="row d-flex justify-content-center align-items-center h-100 pb-5 mb-10" >

    <!-- <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="./image.jpg" class="img-fluid rounded-circle border" alt="Image">
      </div> -->
      
      <div class="col-md-10 col-lg-7 col-xl-5 offset-xl-1">
      
      <div class="card text-black text-center" style="border-radius: 25px;">
    <div class="card-body p-md-5">

 

<div class="row justify-content-center align-items-center">
    <h4 class="card-subtitle mb-5 ">Wybierz czy chcesz stworzyć nową apteczkę czy współtworzyć juz istniejącą! </h4>
    
    <p class="card-text"></p>
</div>


    <div class="row justify-content-center align-items-center pt-3">
    <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="apteka_rejestracja1.php">
        <button type="submit" class="btn btn-secondary">Nowa apteczka</button>
        </a>
  </div>
  <div class="btn-group mr-2" role="group" aria-label="Second group">
        <a href="apteka_rejestracja2.php">
        <button type="submit" class="btn btn-secondary">Istniejąca apteczka</button>
        </a>
</div>
  
</div>

          
          
                </div>
                </div>
                </div>
                </div>


</body>
</html>