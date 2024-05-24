<?php 
    include ("Include/ConfigFile.php");
    $bMauvaisMotDePasse=$bMauvaisCompte=false;

    if(isset($_POST["disconnected"])){
        if($_POST["disconnected"]=="Disconnected"){
            $_SESSION['isConnected']=false;
        }
    }

    if(isset($_POST["Password"]))
    {

        $password_enter = QuoteStr(hash('sha256', $_POST["Password"]));
        

        $sql="select Password from `user` where MailAdresse = ".QuoteStr($_POST["MailAdresse"]);
        $sql2="select Username from `user` where MailAdresse = ".QuoteStr($_POST["MailAdresse"]);
        $hash=QuoteStr(GetSQLValue($sql));
        $username_login=QuoteStr(GetSQLValue($sql2));
        $sql3="select id from `user` where MailAdresse = ".QuoteStr($_POST["MailAdresse"]);
        $user_id = GetSQLValue($sql3);
        echo $password_enter;
        echo $hash;

        if (isset($hash))
        {
            if($hash==$password_enter)
                {
                    $_SESSION['isConnected']=true;
                    $_SESSION['login']=$username_login;
                    $_SESSION['user_id']=$user_id;
                    header('location:userChoice.php');

                }
            else
                {
                    $bMauvaisMotDePasse=true;
                }

        }
        else
            { 
                $bMauvaisCompte=true;
            }
  }

  
  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/user.css">
    <title>Document</title>
</head>
<body>
<main>
<img src="Pixel_War_logo.png" alt="">
<form method="POST">
<div class="container">
<h1 >Login</h1>
<div class="align">
    <div>
      <input class="input" type="email" name= "MailAdresse" id="floatingInput" placeholder="Email" required>
      <label for="floatingInput"></label>
    </div>
    <div>
      <input class="input" type="password" name = "Password" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword"></label>
    </div>
    <div> 
    <button class="button" type="submit" value="Login">Login
    <button class="button" type="button" value="Sign in" onClick="location.href='signIn.php'">Sign In
    </div>
</div>

  </form>
</main>
    
</body>
</html>