<?
require("../hrmis/class/General.php");
require("../hrmis/class/Constant.php");
require('../hrmis/class/ReportPR.php');
require('../hrmis/class/ReportPT.php');
require('../hrmis/class/ReportGSISLR.php');
require('../hrmis/class/ReportGSISPC.php');
require('../hrmis/class/ReportPHP.php');
require('../hrmis/class/ReportPAGIBIGLR.php');
require('../hrmis/class/ReportRemittanceBody.php');
require('../hrmis/class/EmpReportRemittanceBody.php');
require('../hrmis/class/ReportBCG.php');
require('../hrmis/class/ReportHP.php');
require('../hrmis/class/ReportSALA.php');
require('../hrmis/class/ReportTA.php');
require('../hrmis/class/ReportPERAAC.php');
require('../hrmis/class/ReportMS.php');
require('../hrmis/class/ReportRATA.php');
require('../hrmis/class/ReportAB.php');
require('../hrmis/class/ReportPS.php');
require('../hrmis/class/ReportPSAC.php');
require('../hrmis/class/ReportGPBody.php');		//  General Payroll 
require('../hrmis/class/ReportW2Body.php');		//  W2 
require('../hrmis/class/ReportDROrginal.php');		//  Deduction Register


class ReportGeneral extends General
{

	function printPreview($t_strReport, $t_strSubReport)
	{	
		if($t_strReport == 'PR')
		{
			$objRprt = new ReportPR;
		}
		elseif($t_strReport == 'PT')
		{
			$objRprt = new ReportPT;
		}
		elseif($t_strReport == 'GSISLR')
		{
			$objRprt = new ReportGSISLR;
		}
		elseif($t_strReport == 'GSISPC')
		{
			$objRprt = new ReportGSISPC;
		}
		elseif($t_strReport == 'PHR')
		{
			$objRprt = new ReportPHP;
		}
		elseif($t_strReport == 'PAGIBIGLR')
		{		
			$objRprt = new ReportPAGIBIGLR;
		}
		elseif($t_strReport == 'RMTNC')
		{
			$objRprt = new ReportRemittanceBody;
		}
		elseif($t_strReport == 'ERMTN')
		{
			$objRprt = new EmpReportRemittanceBody;
		}
		elseif($t_strReport == 'PS')
		{
			$objRprt = new ReportPS;
		}
		elseif($t_strReport == 'PSAC')
		{
			$objRprt = new ReportPSAC;
		}
		elseif($t_strReport == 'BCG')
		{
			$objRprt = new ReportBCG;
		}
		elseif($t_strSubReport == 'HP')
		{
			$objRprt = new ReportHP;
		}
		elseif($t_strReport == 'DR')
		{
		    $objRprt = new ReportDROriginal;
		}
		elseif($t_strSubReport == 'SALA')
		{	
			$objRprt = new ReportSALA;
		}
		elseif($t_strSubReport == 'TA')
		{
				$objRprt = new ReportTA;
		}
		elseif($t_strSubReport == 'PERAAC')
		{
			$objRprt = new ReportPERAAC;
		}
		elseif($t_strSubReport == 'MS')
		{
			$objRprt = new ReportMS;
		}
		elseif($t_strSubReport == 'RATA')
		{	
			$objRprt = new ReportRATA;
		}
		elseif($t_strSubReport == 'AB')
		{
			$objRprt = new ReportAB;
		}
		elseif($t_strReport == 'GP')
		{
			$objRprt = new ReportGPBody;
		}
		elseif($t_strReport == 'W2')
		{
			$objRprt = new ReportW2Body;
		}
		
		
		$objRprt->generateReport();
		
	}	//  end function
	
}	//  end class
?>
