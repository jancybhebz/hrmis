<?
session_cache_limiter('none'); 
session_start();
require('../hrmis/class/ReportHRMISGeneral.php');
$objRprtGnrl = new ReportHRMISGeneral;
$objRprtGnrl->printPreview($strEmpNmbr, $strReports);
?>
