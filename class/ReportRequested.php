<?
require('../hrmis/class/ReportOB.php');
require('../hrmis/class/ReportTO.php');
require('../hrmis/class/ReportLeave.php');
require('../hrmis/class/ReportMTU.php');

class ReportRequested
{
	function printPreview()
	{	
		if($_SESSION['sesRprt'] == 'OB')
		{
			$objRprt = new ReportOB;
		}
		elseif($_SESSION['sesRprt']  == 'TO')
		{
			$objRprt = new ReportTO;
		}
		elseif($_SESSION['sesRprt']  == 'LV')
		{
			$objRprt = new ReportLeave;
		}
		elseif($_SESSION['sesRprt']  == 'MTU')
		{
			$objRprt = new ReportMTU;
		}
		$objRprt->generateReport();
	}
}
?>