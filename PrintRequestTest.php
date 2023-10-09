<?
session_cache_limiter('private_no_expire'); 
require('../hrmis/class/ReportLP.php');
$objRprtRqst = new ReportLP;
$objRprtRqst->printPreview();
?>
