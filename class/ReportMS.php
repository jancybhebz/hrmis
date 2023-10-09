<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportMSalary.php');

class ReportMS extends General
{
	var $objRprt;
	function printBody($t_intCounter, $t_empName, $t_amount)
	{
//repeat
		$this->objRprt->SetFont('Arial','',9);		
		$this->objRprt->Cell(15,5,$t_intCounter, 0, 0, 'L');
		$this->objRprt->Cell(60,5,$t_empName, 0, 0, 'L');
		$this->objRprt->Cell(0,5, number_format($t_amount, 2,'.',','), 0, 0, 'R');
		$this->objRprt->Ln(5);
//repeat
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportMSalary('P','mm', 'Letter');
		
		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);		
		$this->objRprt->SetAutoPageBreak("on", 70);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		$this->objRprt->AddPage(); 
		
		$objEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									  tblEmpPersonal.firstname, tblEmpIncome.incomeAmount
									  
								FROM tblEmpPersonal
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
									INNER JOIN tblEmpPosition
										ON tblEmpIncome.empNumber = tblEmpPosition.empNumber
									WHERE tblEmpIncome.incomeCode = 'MS'
										AND tblEmpPosition.statusOfAppointment = 'In-Service'
										AND tblEmpIncome.incomeMonth = '".$_SESSION['sesCshrMonth']."'
										AND tblEmpIncome.incomeYear = '".$_SESSION['sesCshrYear']."'
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname");
								
		$objLastRecord = mysql_query("SELECT tblEmpPersonal.empNumber
									  FROM tblEmpPersonal
										INNER JOIN tblEmpIncome
											ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
										INNER JOIN tblEmpPosition
											ON tblEmpIncome.empNumber = tblEmpPosition.empNumber
										WHERE tblEmpIncome.incomeCode = 'MS'
										    AND tblEmpPosition.statusOfAppointment = 'In-Service'
											AND tblEmpIncome.incomeMonth = '".$_SESSION['sesCshrMonth']."'
											AND tblEmpIncome.incomeYear = '".$_SESSION['sesCshrYear']."'
										ORDER BY tblEmpPersonal.surname desc, tblEmpPersonal.firstname desc");
										
										
	
		$intFlag = 0;
		$intMSPageTotal = 0;									
		$intMSGrandTotal = 0;
		$intCounter = 0;
		
		$arrLastRecord = mysql_fetch_array($objLastRecord);
		
		while ($arrEmp = mysql_fetch_array($objEmp))
		{ 									
		  $intCounter++;
		  $strName = $arrEmp['surname'].", ".$arrEmp['firstname'];
		  
		  $intMSPageTotal  = $intMSPageTotal + $arrEmp['incomeAmount'];
		  $intMSGrandTotal = $intMSGrandTotal + $arrEmp['incomeAmount'];
		  
		  if($arrLastRecord['empNumber'] == $arrEmp['empNumber'])
			{
				$this->objRprt->setGrandTotal($intMSGrandTotal);
				$this->objRprt->setPageTotal($intMSPageTotal);
			}
			
		 $this->printBody($intCounter, $strName, $arrEmp['incomeAmount']);						
		 
		 }							
		$this->objRprt->Output(); 
											
	}
}
?>