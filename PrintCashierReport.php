<?
session_cache_limiter('none'); 
session_start();
require('../hrmis/class/ReportGeneral.php');
$objRprtGnrl = new ReportGeneral;
$objRprtGnrl->printPreview($strCshrReport, $strCshrSubReport);
?>
