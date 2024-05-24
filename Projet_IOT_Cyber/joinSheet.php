<?php
include ("Include/ConfigFile.php");

if (isset($_POST["joinName"])){
    $joinName=QuoteStr($_POST["joinName"]);
    
    $sql="select Name from sheet where Name = ".QuoteStr($_POST["joinName"]);
    $sql2="select ID from sheet where Name = ".QuoteStr($_POST["joinName"]);
    $base_name=QuoteStr(GetSQLValue($sql));
    $sheet_id=GetSQLValue($sql2);
    echo $sheet_id;
    if($joinName == $base_name){
        header("location:sheet.php?sheet_id=".$sheet_id);

    }else{
        echo "The Sheet doesn't exists ";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoinSheet</title>
    <link rel="stylesheet" href="css/joinSheet.css">

</head>
<body>
<div class="container">
    <form method="POST">
        <h1>Join a Sheet</h1>
        <div>
            <input type="text" name="joinName" id="joinName" placeholder="Name of the Sheet">
        </div>
        <div class="button-container">
            <button id="joinButton" type="submit">Join</button>
            <button id="back" type="button" onClick="location.href='userChoice.php'">Back</button>
        </div>
    </form>
</div>
</body>
</html>