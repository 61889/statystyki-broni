<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 

require_once "config.php";
 

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Wpisz nowe hasło.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Hasło musi mieć min 6 znaków.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Powtórz hasło.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Hasło się różni.";
        }
    }
        
   
    if(empty($new_password_err) && empty($confirm_password_err)){
        
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            
            if(mysqli_stmt_execute($stmt)){
                
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Coś się wykrzaczyło.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Reset hasła</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html{ display: flex; justify-content: center; align-items: center; height: 100%; background: linear-gradient(to top, rgba(48, 207, 208, 1), rgba(51, 8, 103, 1)); font: 14px sans-serif;}
        .wrapper{ width: 400px; padding: 20px; background:#F6F6F6;border-radius: 10px;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset hasła</h2>
        <p>Wpisz dane poniżej aby zresetować hasło.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>Nowe hasło</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Powtórz hasło</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Zapisz">
                <a class="btn btn-link ml-2" href="welcome.php">Cofnij</a>
            </div>
        </form>
    </div>    
</body>
</html>