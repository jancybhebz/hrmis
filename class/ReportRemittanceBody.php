<?
session_start();
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/ReportRemittance.php');

class ReportRemittanceBody extends General
{
	var $objRprt;
	var $strDeduct;
	function printBody($t_intCounter, $t_strName, $t_intDeduct)
	{	
		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell(10,5, $t_intCounter, 0, 0, 'L');
		$this->objRprt->Cell(120,5, $t_strName, 0, 0, 'L');
		$this->objRprt->Cell(0,5, number_format($t_intDeduct, 2,".",","), 0, 1, 'R');
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportRemittance();

		$objDeductName = mysql_query("SELECT deductionDesc FROM tblDeduction 
										WHERE deductionCode = '".$_SESSION['sesCshrSubReportCode']."'");  
		$arrDeductName = mysql_fetch_array($objDeductName);   //retrieving the deduction name		
		
		$this->objRprt->setReportTitle($arrDeductName['deductionDesc']);   //setting the deduction name
				
		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear']);

		
		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(20);
		$this->objRprt->SetAutoPageBreak("on", 55);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();


		$objEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblEmpDeductRemit.deductAmount
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblEmpDeductRemit
										ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber	
								WHERE deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									AND deductMonth = '".$_SESSION['sesCshrMonth']."'
									AND deductYear = '".$_SESSION['sesCshrYear']."'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname");

		$objLastRcrd = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblEmpDeductRemit.deductAmount
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblEmpDeductRemit
										ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber	
								WHERE deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									AND deductMonth = '".$_SESSION['sesCshrMonth']."'
									AND deductYear = '".$_SESSION['sesCshrYear']."'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'								
								ORDER BY tblEmpPersonal.surname desc, tblEmpPersonal.firstname desc");

											
		$intFlag = 0;
		$intPageTotal = 0;
		$intPageGrandTotal = 0;
		$intCounter = 0;
		$arrLastRcrd = mysql_fetch_array($objLastRcrd);
		
		while($arrEmp = mysql_fetch_array($objEmp))
		{
			$intCounter = $intCounter + 1;		
			$intPageTotal = $intPageTotal + $arrEmp['deductAmount'];
			$intPageGrandTotal = $intPageGrandTotal + $arrEmp['deductAmount'];
			
			$strName = $arrEmp['surname'].", ".$arrEmp['firstname'];						

			$this->objRprt->setPageTotal($intPageTotal);

			if($arrLastRcrd['empNumber'] == $arrEmp['empNumber'])
			{
				$this->objRprt->setGrandTotal($intPageGrandTotal);
				$this->objRprt->setPageTotal($intPageTotal);
			}
			$this->printBody($intCounter, $strName, $arrEmp['deductAmount']);				
		}
		$this->objRprt->Output();		
	}
}
?>