<?php
include ("Include/ConfigFile.php");
$data = json_decode(file_get_contents('php://input'), true);
$sheet_id = $data['sheet_id'];
$color = $data['color'];
$pos_x = $data['pos_x'];
$pos_y = $data['pos_y'];
$user_id = $_SESSION['user_id'];

$sql="select * from pixel where pos_x = $pos_x and pos_y = $pos_y";
$pixel_exist = GetSQLValue($sql);

if($pixel_exist){
    $sql="Update Pixel Set `color`='$color', `user_id`='$user_id' where `sheet_id`='$sheet_id' and `pos_x`='$pos_x' and `pos_y`='$pos_y' ";
    echo $sql;
    ExecuteSQL($sql);
}else{
    $sql="insert INTO pixel (`sheet_id`, `color`, `pos_x`, `pos_y`,`user_id`) VALUES ($sheet_id, '$color', $pos_x, $pos_y, $user_id)";
    ExecuteSQL($sql);
}



?>
