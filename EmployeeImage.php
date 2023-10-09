<?
require("../hrmis/class/LoginDTR.php");
$objLogin = new LoginDTR;
$strImage = $objLogin->getPicture($strEmpNmbr);
echo $strImage;
?>