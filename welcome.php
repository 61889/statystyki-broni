<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html{  font: 14px sans-serif; text-align: center; background: linear-gradient(to top, rgba(48, 207, 208, 1), rgba(51, 8, 103, 1));}
        .wrapper{ width: 40%; padding: 20px; background:#F6F6F6; border-radius: 10px;}
        .container{display: flex; justify-content: center; align-items: center;}
        .row{ display: flex;justify-content: center; align-items: center; margin: auto;}
        
    </style>
</head>



<body>
<div class= "container">
    <div class= "wrapper">  
    <h1>Jesteś zalogowany jako: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset hasła</a>
        <a href="logout.php" class="btn btn-danger ml-3">Wyloguj się</a>
    </p>  
    </div>
</div>

<div class="p-3 mb-2 text-white h1 fw-bold">Poniżej zostały przedstawione statystyki wybranych broni w grze Battlefield 2044</div>

<div class="sec">
<div class="p-3 mb-2 bg-dark text-white h5 fw-bold">SECONDARY</div>
<div class="row">
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/w.png">
        <img src="img/w.png" alt="w" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">MP28</p></figcaption>
      </a>
    </div>
  </div>
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/q.png">
        <img src="img/q.png" alt="q" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">M44</p></figcaption>
      </a>
    </div>
  </div>
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/e.png">
        <img src="img/e.png" alt="e" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">G57</p></figcaption>
      </a>
    </div>
  </div>
  
</div>

<div class="smg">
<div class="p-3 mb-2 bg-dark text-white h5 fw-bold">SMG</div>
<div class="row">
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/smg1.png">
        <img src="img/smg1.png" alt="smg1" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">MP28</p></figcaption>
      </a>
    </div>
  </div>
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/smg2.png">
        <img src="img/smg2.png" alt="smg2" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">M44</p></figcaption>
      </a>
    </div>
  </div>
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/smg3.png">
        <img src="img/smg3.png" alt="smg3" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">G57</p></figcaption>
      </a>
    </div>
  </div>
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/smg4.png">
        <img src="img/smg4.png" alt="smg4" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">G57</p></figcaption>
      </a>
    </div>
  </div>
  
</div>
</div>


<div class="ass">
<div class="p-3 mb-2 bg-dark text-white h5 fw-bold">ASSAULT</div>
<div class="row">
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/AS1.png">
        <img src="img/AS1.png" alt="AS1" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">AC-42</p></figcaption>
      </a>
    </div>
  </div>
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/AS2.png">
        <img src="img/AS2.png" alt="AS2" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">SFAR-M GL</p></figcaption>
      </a>
    </div>
  </div>
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/AS3.png">
        <img src="img/AS3.png" alt="AS3" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">AK-24</p></figcaption>
      </a>
    </div>
  </div>
  <div class="col-md-6">
    <div class="thumbnail">
      <a href="img/AS4.png">
        <img src="img/AS4.png" alt="AS4" style="width:100%">
        <figcaption class="figure-caption text-center"><p class="text-white bg-dark h5">M5A3</p></figcaption>
      </a>
    </div>
  </div>
</div>
</div>

<div class="p-3 mb-2 bg-dark text-white h5 fw-bold">w61889</div>


</body>
</html>