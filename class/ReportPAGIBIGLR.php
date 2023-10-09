<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/ReportPAGIBIGLRemmitance.php');

class ReportPAGIBIGLR extends General
{
	var $objRprt;
	var $intCounter = 0;
	
	function printBody($t_intCountr, $t_strfname, $t_strVcherNum, $t_strVcherDate, $t_strPromNoteNmbr, $t_strPromNoteDate, $t_intAmntGranted, $t_intDeductAmnt, $t_strDeductStartDate,$t_strDeductEndDate)
	{
		$this->objRprt->SetFont('Arial','',10);
		$this->objRprt->Cell(9,5,$t_intCountr, 1, 0, 'L');
		$this->objRprt->Cell(65,5,$t_strfname, 1, 0, 'L');
		$this->objRprt->Cell(35,5,$t_strVcherNum, 1, 0, 'L');
		$this->objRprt->Cell(30,5,$t_strVcherDate, 1, 0, 'C');
		$this->objRprt->Cell(30,5,$t_strPromNoteNmbr, 1, 0, 'C');
		$this->objRprt->Cell(30,5,$t_strPromNoteDate, 1, 0, 'C');
		$this->objRprt->Cell(30,5,number_format($t_intAmntGranted, 2, '.',','), 1, 0, 'R');
		$this->objRprt->Cell(30,5,number_format($t_intDeductAmnt, 2, '.',','), 1, 0, 'R');
		$this->objRprt->Cell(30,5,$t_strDeductStartDate, 1, 0, 'C');
		$this->objRprt->Cell(30,5,$t_strDeductEndDate, 1, 1, 'C');	
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportPAGIBIGLRemmitance('L','mm', 'Legal');
		
		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on", 50);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		$this->objRprt->AddPage();
		
		
		$objRemittance = mysql_query ("SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename,
											  tblEmpDeduction.deductionCode, tblEmpDeduction.voucherNmbr, tblEmpDeduction.voucherDate, 
											  tblEmpDeduction.promNoteNumber, tblEmpDeduction.promNoteDate,
											  tblEmpDeduction.amountGranted, tblEmpDeduction.deductStartDate,
											  tblEmpDeduction.deductEndDate, tblEmpDeductRemit.deductAmount, tblEmpDeductRemit.deductionCode,
											  tblEmpDeductRemit.deductionCode,tblEmpDeductRemit.deductMonth, tblEmpDeductRemit.deductYear
									   FROM tblEmpPersonal
									   	INNER JOIN tblEmpDeduction
											ON tblEmpPersonal.empNumber = tblEmpDeduction.empNumber
										INNER JOIN tblEmpDeductRemit
											ON tblEmpDeduction.empNumber = tblEmpDeductRemit.empNumber
										INNER JOIN tblEmpPosition
											ON tblEmpDeductRemit.empNumber = tblEmpPosition.empNumber
										WHERE (tblEmpDeductRemit.deductionCode = 'PAGIBIGL'
											  OR tblEmpDeduction.deductionCode = 'PAGIBIGL')
											AND tblEmpPosition.statusOfAppointment = 'In-Service'
											AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
											AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."' 
										ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename");
		
		/*$objRemittance = mysql_query ("SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, 
													  tblEmpPersonal.middlename,tblEmpDeductRemit.deductAmount
									   FROM tblEmpPersonal
										INNER JOIN tblEmpDeductRemit
											ON tblEmpPersonal.empNumber =tblEmpDeductRemit.empNumber
										WHERE tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
											AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'
											AND tblEmpDeductRemit.deductionCode = 'PAGIBIGL'
										ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename");	*/							
		
		/*$objRemittance = mysql_query("SELECT  DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									  tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
									  tblEmpDeduction.deductionCode, tblEmpDeduction.voucherNmbr, 
									  tblEmpDeduction.voucherDate, tblEmpDeduction.promNoteNumber, 
									  tblEmpDeduction.promNoteDate, tblEmpDeduction.amountGranted, 
									  tblEmpDeduction.deductStartDate, tblEmpDeduction.deductEndDate
									  FROM tblEmpPersonal
											INNER  JOIN tblEmpDeduction 
											ON tblEmpPersonal.empNumber = tblEmpDeduction.empNumber
									  WHERE tblEmpDeduction.deductionCode =  'PAGIBIGL'
									  ORDER  BY tblEmpPersonal.surname, tblEmpPersonal.firstname, 
									  tblEmpPersonal.middlename");*/
		
		
		
		$intTotalNumRows = mysql_num_rows($objRemittance);
									
		$intPageCounter = 0;
		$intPageTotalMonthlyAmort = 0;
		$intGrandTotalMonthlyAmort = 0;
	
					
		while ($arrRemittance = mysql_fetch_array($objRemittance))
		{
			$this->intCounter++;
			$intPageCounter++;
			$strEmpNumber = $arrRemittance['empNumber'];
			$strfullname =  $arrRemittance['surname'].", ".$arrRemittance['firstname']." ".$arrRemittance['middlename'];
			$intDeductAmount = $arrRemittance['deductAmount'];
			$strVoucherNum = $arrRemittance['voucherNmbr'];
			$strVoucherDate = $arrRemittance['voucherDate'];
			$strpromNoteNumber = $arrRemittance['promNoteNumber'];
			$strpromNoteDate = $arrRemittance['promNoteDate'];
			$intAmountGranted = $arrRemittance['amountGranted'];
			$strDeductStartDate = $arrRemittance['deductStartDate'];
			$strDeductEndDate = $arrRemittance['deductEndDate'];
			
			
			
			
			
			$intPageTotalMonthlyAmort  = $intPageTotalMonthlyAmort  + $intDeductAmount;
			$intGrandTotalMonthlyAmort = $intGrandTotalMonthlyAmort + $intDeductAmount;
			
			
			
			$this->printBody($this->intCounter, $strfullname, $strVoucherNum, $strVoucherDate, $strpromNoteNumber, $strpromNoteDate,$intAmountGranted, $intDeductAmount, $strDeductStartDate,$strDeductEndDate);
			$this->objRprt->setPageTotal($intPageTotalMonthlyAmort);
			
			if ($intPageCounter == 20)
			{
				$intPageTotalMonthlyAmort = 0;
				$this->objRprt->AddPage();
				$intPageCounter = 0;
			}

			if ($this->intCounter == $intTotalNumRows)
			{		
				$this->objRprt->setPageTotal($intPageTotalMonthlyAmort);
				$this->objRprt->setGrandTotal($intGrandTotalMonthlyAmort);
			}	
		}
		$this->objRprt->Output();	
	}
}
?>