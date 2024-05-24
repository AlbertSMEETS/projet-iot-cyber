<?php 
include ("Include/ConfigFile.php");

if (isset($_POST["createName"])){
    $createName=QuoteStr($_POST["createName"]);
    
    $sql="insert into sheet (Name) values($createName)";
    ExecuteSQL($sql);
    echo 'Sheet Succesfully Created !';


} 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Interaction</title>
    <link rel="stylesheet" href="css/createSheet.css">
</head>
<body>
<div class="container">
    <form method="POST">
    <h1>Create a Sheet</h1>
        <div>
            <input type="text" name="createName" id="createName" placeholder="Name of the Sheet">
        </div>
        <div class="button-container">
            <button id="createButton" type="submit">Create</button>
            <button id="back" type="button" onClick="location.href='userChoice.php'">Back</button>
        </div>
    </form>
</div>

</body>
</html>
