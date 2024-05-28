<?php
require_once "conection.php";
if (isset($_GET['v'])){
$delet=$_GET['v'];
$deletoffre= mysqli_query($conn,"DELETE FROM `recruteur` WHERE `id_recruteure`='$delet'");
header("location:admin.php");
die;
}

?>