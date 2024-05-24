<?php 
    include ("Include/ConfigFile.php");

    if(isset($_POST["Username"]))
    {
        $username = Quotestr($_POST["Username"]);
        $mailadresse = Quotestr($_POST["MailAdresse"]);
        $password = QuoteStr(hash('sha256',$_POST["Password"]));
        
        $sql2="select Username from `user` where username = ".Quotestr($_POST["Username"]);
        $username_used = QuoteStr(GetSQLValue($sql2));
        if($username_used && $username_used == $username){
          echo "Username Already Used. Please Change";
        }else{
          $sql="insert into user (Username, Password, MailAdresse) values($username, $password, $mailadresse)";
        ExecuteSQL($sql);
        echo 'Succesfuly Signed In !';
        }
        
    }   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/signIn.css">
</head>
<body>
<main>
<form method="POST">
    <div class="container">
      <h1 >Sign in</h1>
      Please Register All Needed Informations
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
              <input class="input" type="login" name = "Username" id="floatingEmail"  placeholder="Username" required>
              <label for="floatingPassword"></label>
            </div>

            <button class="button" type="submit">Sign in</button>
            <button class="button" type="submit" onClick="location.href='user.php'">Back</button>
          </div>
      </div>
  </form>
</main>
</body>
</html>