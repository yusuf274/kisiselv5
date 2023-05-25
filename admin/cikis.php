
<?php




include_once "fonksiyon/baglan.php";
include_once "fonksiyon/giris.php";

$yonetim = new yonetim;
$yonetim->konrolet("cot");

$cookid=$_COOKIE["adminbilgi"];
setcookie("adminbilgi",$cookid, time() - 5);

header("Location:index.php");

?>