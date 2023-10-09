<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/ReportPHPremium.php');

class ReportPHP extends General
{
	var $objRprt;
	
	function printBody($t_intCounter,$t_strName,$t_strGSISNum,$t_strPosition,$t_intActualSalary,$t_intPShareAmount,$t_intEmpShareAmount,$t_intEmpPEShare)
	{
		$this->objRprt->SetFont('Arial','',10);
		$this->objRprt->Cell(5,5,$t_intCounter, 1, 0, 'L');
		$this->objRprt->Cell(65,5,"  ".$t_strName, 1, 0, 'L');
		$this->objRprt->Cell(40,5,$t_strGSISNum, 1, 0, 'L');
		$this->objRprt->Cell(50,5,$t_strPosition, 1, 0, 'L');
		$this->objRprt->Cell(40,5,number_format($t_intActualSalary, 2, '.',','), 1, 0, 'R');
		$this->objRprt->Cell(40,5,number_format($t_intPShareAmount, 2, '.',','), 1, 0, 'R');
		$this->objRprt->Cell(40,5,number_format($t_intEmpShareAmount, 2, '.',','), 1, 0, 'R');		
		$this->objRprt->Cell(35,5,number_format($t_intEmpPEShare, 2, '.',','), 1, 1, 'R');				
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportPHPremium('L','mm', 'Legal');
		
		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		

		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on", 60);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		$this->objRprt->AddPage();
		
		
		/*$objEmp = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblEmpPersonal.gsisNumber,
										tblPosition.positionAbb,tblEmpPosition.actualSalary,
										tblEmpDeductRemit.deductAmount, tblEmpAgencyShare.shareAmount,
										tblEmpDeductRemit.deductionCode,tblEmpDeductRemit.deductMonth,
										tblEmpDeductRemit.deductYear
								 FROM tblEmpPersonal
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblPosition
										 	ON tblEmpPosition.positionCode = tblPosition.positionCode
										INNER JOIN tblEmpDeductRemit
											ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber 
										INNER JOIN tblEmpAgencyShare
											ON tblEmpDeductRemit.empNumber = tblEmpAgencyShare.empNumber
										INNER JOIN tblDeduction
											ON tblEmpAgencyShare.deductionCode = tblDeduction.deductionCode	
								   WHERE tblEmpDeductRemit.deductionCode = 'PHP'
								   		AND tblEmpAgencyShare.deductionCode ='PHP'
										AND tblDeduction.deductionCode = 'PHP'
								   		AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
										AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'
								    ORDER BY tblEmpPersonal.empNumber, tblEmpPersonal.surname,tblEmpPersonal.firstname");*/

     $objEmp = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblEmpPersonal.gsisNumber,
										tblEmpPosition.positionCode,tblPosition.positionAbb,
										tblEmpPosition.actualSalary, tblEmpDeductRemit.deductAmount,
										tblEmpDeductRemit.deductionCode,tblEmpDeductRemit.deductMonth, 
										tblEmpDeductRemit.deductYear, tblDeduction.deductionCode	 
							 FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblPosition
									 	ON tblEmpPosition.positionCode = tblPosition.positionCode
								INNER JOIN tblEmpDeductRemit
										ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber 
								INNER JOIN tblDeduction
											ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode	
						     WHERE tblEmpDeductRemit.deductionCode = 'PHP'
										AND tblDeduction.deductionCode = 'PHP'
										AND tblEmpPosition.statusOfAppointment = 'In-Service'
								   		AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
										AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'
							 ORDER BY tblEmpPersonal.empNumber, tblEmpPersonal.surname,tblEmpPersonal.firstname");

 
 		$intNumRows = mysql_num_rows($objEmp);
									
		$intCounter = 0;
		$intPageCounter = 0;
		
		$intPSGrandTotal = 0;
		$intESPageTotal = 0;
		$intPESharePageTotal = 0;
		
		$intPSGrandTotal =0 ;
		$intESGrandTotal = 0;
		$intPEShareGrandTotal =0;
		
			
		while($arrEmp = mysql_fetch_array($objEmp))
		{
			$intCounter++;
			$intPageCounter++;
			$strEmpNum = $arrEmp['empNumber'];
			$strName = $arrEmp['surname'].", ".$arrEmp['firstname'];
			$strGSISNum = $arrEmp['gsisNumber'];
			$strPosition = $arrEmp['positionAbb'];
			$intActualSalary = $arrEmp['actualSalary'];
			$intPShareAmount = $arrEmp['deductAmount'];
			
			
			$objEmployerShare = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpAgencyShare.deductionCode,
													tblEmpAgencyShare.deductMonth, tblEmpAgencyShare.deductYear,
													 tblEmpAgencyShare.shareAmount, tblDeduction.deductionCode
											 FROM tblEmpPersonal
											 	INNER JOIN tblEmpAgencyShare
											 		ON tblEmpPersonal.empNumber = tblEmpAgencyShare.empNumber		
											 	INNER JOIN tblEmpPosition
													ON tblEmpAgencyShare.empNumber = tblEmpPosition.empNumber	
												INNER JOIN tblDeduction
													ON tblEmpPosition.empNumber = tblDeduction.deductionCode	
											 WHERE tblEmpPersonal.empNumber = '$strEmpNum'
											       AND tblEmpAgencyShare.deductionCode = 'PHP'
												   AND tblDeduction.deductionCode = 'PHP'
												   AND tblEmpPosition.statusOfAppointment = 'In-Service'
												   AND tblEmpAgencyShare.deductMonth = '".$_SESSION['sesCshrMonth']."'
												   AND tblEmpAgencyShare.deductYear = '".$_SESSION['sesCshrYear']."' ");
												   
			$arrEmployerShare = mysql_fetch_array($objEmployerShare);			
			
			
			$intEmpShareAmount = $arrEmployerShare['shareAmount'];
						
			$intEmpPEShare = $intPShareAmount + $intEmpShareAmount;
			
			$intPSPageTotal = $intPSPageTotal + $intPShareAmount;
			$intESPageTotal = $intESPageTotal + $intEmpShareAmount;
			$intPESharePageTotal = $intPESharePageTotal + $intEmpPEShare; 
			
			$intPSGrandTotal = $intPSGrandTotal + $intPShareAmount;
			$intESGrandTotal = $intESGrandTotal + $intEmpShareAmount;
			$intPEShareGrandTotal = $intPEShareGrandTotal + $intEmpPEShare;
			
			$this->printBody($intCounter, $strName, $strGSISNum, $strPosition, $intActualSalary, $intPShareAmount, $intEmpShareAmount, $intEmpPEShare);	
			$this->objRprt->setPageTotal($intPSPageTotal, $intESPageTotal,$intPESharePageTotal);
			
			if($intCounter == $intNumRows)
			{ 
				$this->objRprt->setPageTotal($intPSPageTotal, $intESPageTotal , $intPESharePageTotal);
				$this->objRprt->setGrandTotal($intPSGrandTotal, $intESGrandTotal, $intPEShareGrandTotal);
					
			}
			
			if($intPageCounter == 17)
			{
				$intPSPageTotal = 0;
				$intESPageTotal = 0;
				$intPESharePageTotal = 0;
				$this->objRprt->AddPage();
				$intPageCounter = 0;
			}
		}
										
		$this->objRprt->Output();	
	}
}
?>