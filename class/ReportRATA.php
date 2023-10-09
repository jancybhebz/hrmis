<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportRATAllowance.php');

class ReportRATA extends General
{
	var $objRprt;
	function printBody($t_strEmpNum,$t_strName,$t_intTAAmount, $t_intRAAmount, $t_intEmpRATANet)
	{
//repeat
		$this->objRprt->SetFont('Arial','',9);		
		$this->objRprt->Cell(15,5,$t_strEmpNum, 0, 0, 'L');
		$this->objRprt->Cell(50,5,$t_strName, 0, 0, 'L');
		$this->objRprt->Cell(23,5,number_format($t_intTAAmount, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(26,5,number_format($t_intRAAmount, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(30,5,number_format($t_intEmpRATANet, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(4,5,' ', 0, 0, 'R');
		$this->objRprt->SetFont('Arial','U',15);
		$this->objRprt->Cell(0,5,'                 ', 0, 1, 'L');
//		$this->objRprt->Ln(2);
//repeat
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportRATAllowance('P','mm', 'Letter');

		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);		
		$this->objRprt->SetAutoPageBreak("on", 90);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		$this->objRprt->AddPage();

		$objEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblEmpIncome.incomeAmount
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpIncome.incomeCode = 'RRA'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'
									AND incomeMonth = '".$_SESSION['sesCshrMonth']."'
									AND incomeYear = '".$_SESSION['sesCshrYear']."'
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname");

		$objLastRcrd = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblEmpIncome.incomeAmount
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpIncome.incomeCode = 'RRA'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'
									AND incomeMonth = '".$_SESSION['sesCshrMonth']."'
									AND incomeYear = '".$_SESSION['sesCshrYear']."'
								ORDER BY tblEmpPersonal.surname desc, tblEmpPersonal.firstname desc");
		
		$arrLastRcrd = mysql_fetch_array($objLastRcrd);
		
		$intFlag = 0;
		$intPageCounter = 0;
		$intEmpRATANet = 0;
		$intRAPageTotal = 0;
		$intTAPageTotal = 0;
		$intRATAPageTotal = 0;
		
		$intRAGrandTotal = 0;
		$intTAGrandTotal = 0;
		$intRATAGrandTotal = 0;
		
			
		
		while($arrEmp = mysql_fetch_array($objEmp))
		{
			$intPageCounter++;
			$strEmpNum = $arrEmp['empNumber'];
			$strName = $arrEmp['surname'].", ".$arrEmp['firstname'];
			$intRAAmount = $arrEmp['incomeAmount'];
			

			$objTA = mysql_query("SELECT incomeAmount FROM tblEmpIncome 
											WHERE empNumber= '$strEmpNum'
												AND incomeMonth = '".$_SESSION['sesCshrMonth']."'
												AND incomeYear = '".$_SESSION['sesCshrYear']."'
												AND incomeCode = 'RTA'");
			$arrTA = mysql_fetch_array($objTA);
			$intTAAmount = $arrTA['incomeAmount'];
			
			$intEmpRATANet =  $intRAAmount + $intTAAmount;

			$intRAPageTotal = $intRAPageTotal + $intRAAmount;
			$intTAPageTotal = $intTAPageTotal + $intTAAmount;
			$intRATAPageTotal = $intRATAPageTotal + $intEmpRATANet;
			
			$intRAGrandTotal = $intRAGrandTotal + $intRAAmount;
			$intTAGrandTotal = $intTAGrandTotal + $intTAAmount;
			$intRATAGrandTotal = $intRATAGrandTotal + $intEmpRATANet;
			
			$this->printBody($strEmpNum,$strName, $intTAAmount, $intRAAmount, $intEmpRATANet);
			$this->objRprt->setPageTotal($intTAPageTotal, $intRAPageTotal, $intRATAPageTotal);

			if($intPageCounter == 16)
			{
				$intRAPageTotal= 0;
				$intTAPageTotal = 0;
				$intRATAPageTotal= 0;
				$this->objRprt->AddPage();
				$intPageCounter = 0;
			}
			
			if($arrLastRcrd['empNumber'] == $arrEmp['empNumber'])
			{
				$this->objRprt->setPageTotal($intTAPageTotal, $intRAPageTotal, $intRATAPageTotal);
				$this->objRprt->setGrandTotal($intTAGrandTotal, $intRAGrandTotal, $intRATAGrandTotal);
			}
							
		}

		$this->objRprt->Output();		
	}
	
}
?>