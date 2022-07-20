<?php

require_once "config.php";
 

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["username"]))){
        $username_err = "Wpisz nazwe.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Nazwa może zawierać litery, cyfry, podłoge.";
    } else{
        
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = trim($_POST["username"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Ta nazwa jest zajęta.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Coś się wykrzaczyło.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Wpisz hasło.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Hasło musi mieć min 6 znaków.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Powtórz hasło.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Hasło się różni.";
        }
    }
    
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: login.php");
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html{ display: flex; justify-content: center; align-items: center; height: 100%; background: linear-gradient(to top, rgba(48, 207, 208, 1), rgba(51, 8, 103, 1)); font: 14px sans-serif;}
        .wrapper{ width: 400px; padding: 20px; background:#F6F6F6;border-radius: 10px;}
        
    </style>
</head>
<body>

    <div class="wrapper">
    <div class="text-center p-3 mb-2 h1 fw-bold"><p>Statystyki wybranych broni w</p> <p>Battlefield 2042</p></div>
        <h2>Rejestracja</h2>
        <p>Wpisz dane aby utworzyć konto.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Nazwa</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Hasło</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Powtórz hasło</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Utwórz konto">
                <input type="reset" class="btn btn-secondary ml-2" value="Wyczyść dane">
            </div>
            <p>Masz już konto? <a href="login.php">Zaloguj się</a>.</p>
        </form>
    </div>
  
</body>
</html>