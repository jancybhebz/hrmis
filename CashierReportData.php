<?
session_start();
session_register('sesCshrReportCode');
session_register('sesCshrSubReportCode');
session_register('sesCshrMonth');
session_register('sesCshrYear');
session_register('sesCshrYear1');
session_register('sesCshrEmpNmbr');
session_register('sesCshrPeriod');
session_register('sesEmpSelect');
session_register('sesDivSec');
session_register('sesEmpNmbr');

$_SESSION['sesCshrReportCode'] = $strCshrReport;
$_SESSION['sesCshrSubReportCode'] = $strCshrSubReport;
$_SESSION['sesCshrMonth'] = $intCshrMonth;
$_SESSION['sesCshrYear'] = $intCshrYear;
$_SESSION['sesCshrYear1'] = $intCshrYear1;
$_SESSION['sesCshrEmpNmbr'] = $strCshrEmpNmbr;
$_SESSION['sesCshrPeriod'] = $intPeriod;
$_SESSION['sesEmpSelect'] = $strEmpSelect;
$_SESSION['sesDivSec'] = $strDivSec;
$_SESSION['sesEmpNmbr'] = $strEmpNmbr;

header("Location: PrintCashierReport.php?strCshrReport=$strCshrReport&strCshrSubReport=$strCshrSubReport");
?>