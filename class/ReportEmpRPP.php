<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportBonus.php');

class ReportBCG extends General
{
	var $objRprt;
	
	function printBody($t_strEmpNum, $t_strPosition, $t_strName, $t_intMonthlySalary, $t_intCashGift, $t_intHalfMonthlySalary, $t_intHalfCashGift, $t_intNetHalfCFMS)
	{
//repeat
		$this->objRprt->SetFont('Arial','',10);		
		$this->objRprt->Cell(15,5,$t_strEmpNum, 0, 0, 'L');
		$this->objRprt->Cell(50,5,$t_strPosition, 0, 0, 'L');
		$this->objRprt->Cell(50,5,$t_strName, 0, 0, 'L');
		$this->objRprt->Cell(28,5,number_format($t_intMonthlySalary, 2,".",","), 0, 0, 'R');
		$this->objRprt->Cell(30,5,number_format($t_intCashGift, 2,".",","), 0, 0, 'R');
		$this->objRprt->Cell(30,5,number_format($t_intHalfMonthlySalary, 2,".",","), 0, 0, 'R');
		$this->objRprt->Cell(32,5,number_format($t_intHalfCashGift, 2,".",","), 0, 0, 'R');		
		$this->objRprt->Cell(36,5,number_format($t_intNetHalfCFMS, 2,".",","), 0, 0, 'R');
		
		$this->objRprt->SetFont('Arial','U',10);
		$this->objRprt->Cell(0,5,'                                 ', 0, 0, 'R');
		$this->objRprt->Ln(5);
//repeat
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportBonus('L','mm', 'Legal');
		
		$this->objRprt->setMonthYear($_SESSION['sesCshrYear'], $_SESSION['sesCshrPeriod']);		
		
		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);		
		$this->objRprt->SetAutoPageBreak("on", 90);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();

		$objEmp = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblDivision.divisionName,
										tblDivision.projectCode, tblEmpPosition.actualSalary, 
										tblPosition.positionAbb, tblAddIncome.fixedAmount,
										tblEmpAddIncome.addIncomeCode,tblEmpAddIncome.addIncomeYear,
										tblEmpAddIncome.addIncomeMonth
								FROM tblEmpPersonal 
									INNER JOIN tblEmpAddIncome
										ON tblEmpPersonal.empNumber = tblEmpAddIncome.empNumber
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblAddIncome
										ON tblEmpAddIncome.addIncomeCode = tblAddIncome.addIncomeCode
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblPosition
										ON tblEmpPosition.positionCode = tblPosition.positionCode
								WHERE tblEmpAddIncome.addIncomeCode = 'CG' 
									  
										AND tblEmpAddIncome.addIncomeYear = '".$_SESSION['sesCshrYear']."'
								ORDER BY tblEmpPosition.divisionCode asc, 
										tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc");

		$objLastRcrd = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber
								FROM tblEmpPersonal 
									INNER JOIN tblEmpAddIncome
										ON tblEmpPersonal.empNumber = tblEmpAddIncome.empNumber
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblAddIncome
										ON tblEmpAddIncome.addIncomeCode = tblAddIncome.addIncomeCode
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblPosition
										ON tblEmpPosition.positionCode = tblPosition.positionCode
								WHERE tblEmpAddIncome.addIncomeCode = 'CG' 
									  AND tblAddIncome.addIncomeCode = 'CG' 
										AND tblEmpAddIncome.addIncomeYear = '".$_SESSION['sesCshrYear']."'
								ORDER BY tblEmpPosition.divisionCode asc, 
										tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc");
		
		$arrLastRcrd = mysql_fetch_array($objLastRcrd);
		$intNumRows = mysql_num_rows($objEmp);
		
		$intFlag = 0;
		$intCounter = 0;
		//per employee
		$intHalfCashGift = 0; //half cash gift per employee
		$intHalfMonthlySalary = 0; //half monthly salary per employee
		$intNetHalfCGMS = 0; //netpay per employee
		
		//per page
		$intActualSalaryPageTotal = 0; //actual salary page total
		$intCashGiftPageTotal = 0; //cash gift page total
		$intHalfBonusPageTotal = 0; //half monthly salary pagetotal
		$intHalfCGPageTotal = 0;   //half cash gift page total
		$intNetHalfCGMSPageTotal = 0;  //half cash gift and half salary page total
		$intHalfBonusCGPageTotal = 0;
		
		//grand totals
		$intActualSalaryGrandTotal = 0;
		$intCashGiftGrandTotal = 0;
		$intHalfBonusGrandTotal = 0;
		$intHalfCGGrandTotal = 0;
		$intNetHalfCGMSGrandTotal = 0;
	
		while ($arrEmp = mysql_fetch_array($objEmp))
		{			
			$intCounter++;
			$strEmpNum = $arrEmp['empNumber'];
			$strPosition = $arrEmp['positionAbb'];
			$strName = $arrEmp['surname'].", ".$arrEmp['firstname'];			
			$intMonthlySalary = $arrEmp['actualSalary'];
			$intCashGift = $arrEmp['fixedAmount'];
		
		
			
			$intHalfCashGift = $intCashGift / 2;
			$intHalfMonthlySalary = $intMonthlySalary / 2;
			$intNetHalfCGMS = $intHalfCashGift + $intHalfMonthlySalary;
			
			$intActualSalaryPageTotal = $intActualSalaryPageTotal + $intMonthlySalary; //salary pagetotal
			$intCashGiftPageTotal = $intCashGiftPageTotal + $intCashGift;			   //cash gift pagetotal				
			$intHalfBonusPageTotal = $intHalfBonusPageTotal + $intHalfMonthlySalary;   //half month pagetotal
			$intHalfCGPageTotal  = $intHalfCGPageTotal + $intHalfCashGift;			   //half cashgift pagetotal
			//$intNetHalfCGMSPageTotal = $intNetHalfCGMSPageTotal + $intNetHalfCGMS;     //netpay pagetotal
			
			$intNetHalfCGMSPageTotal = $intHalfBonusPageTotal + $intHalfCGPageTotal;  
			
			//grand totals
			$intActualSalaryGrandTotal = $intActualSalaryGrandTotal + $arrEmp['actualSalary'];
			$intCashGiftGrandTotal = $intCashGiftGrandTotal + $arrEmp['fixedAmount'];
			$intHalfBonusGrandTotal = $intHalfBonusGrandTotal + $intHalfMonthlySalary;
			$intHalfCGGrandTotal = $intHalfCGGrandTotal + $intHalfCashGift;
			$intNetHalfCGMSGrandTotal = $intNetHalfCGMSGrandTotal + $intNetHalfCGMS;
			
			
			
			if($intFlag == 0)
			{
				$strDivisionName = $arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'], $arrEmp['projectCode']);
				$intFlag = 1;
				$this->objRprt->AddPage();
			}
			elseif($strDivisionName != $arrEmp['divisionName'])
			{
				
				$intActualSalaryPageTotal = $intActualSalaryPageTotal - $arrEmp['actualSalary'];
				$intCashGiftPageTotal = $intCashGiftPageTotal -  $arrEmp['fixedAmount'];			
				$intHalfBonusPageTotal = $intHalfBonusPageTotal - $intHalfMonthlySalary;
				$intHalfCGPageTotal = $intHalfCGPageTotal - $intHalfCashGift;
				$intHalfBonusCGPageTotal = $intHalfBonusPageTotal + $intHalfCGPageTotal;
				//$intNetHalfCGMSPageTotal = $intNetHalfCFMSPageTotal - $intHalfBonusCGPageTotal; 
				$intNetHalfCGMSPageTotal =  $intHalfBonusCGPageTotal; 
				//echo  $intHalfBonusCGPageTotal. "<br>";
				//echo $intNetHalfCGMSPageTotal. "<br>";
				//$intNetHalfCGMSPageTotal = $intNetHalfCFMSPageTotal - $intNetHalfCGMS; 
				//$intNetHalfCGMSPageTotal = $intNetHalfCFMSPageTotal - $intHalfMonthlySalary - $intHalfCashGift; 
                
				$this->objRprt->setPageTotal($intActualSalaryPageTotal ,$intCashGiftPageTotal, $intHalfBonusPageTotal,$intHalfCGPageTotal ,$intNetHalfCGMSPageTotal);
				
				$intActualSalaryPageTotal = $arrEmp['actualSalary'];
				$intCashGiftPageTotal = $arrEmp['fixedAmount'];
				$intHalfBonusPageTotal = $arrEmp['actualSalary'] / 2;
				$intHalfCGPageTotal = $arrEmp['fixedAmount'] / 2;
				
				$intNetHalfCGMSPageTotal = $intHalfBonusPageTotal + $intHalfCGPageTotal;
								 
				$strDivisionName = $arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'], $arrEmp['projectCode']);
				$this->objRprt->AddPage();
			}

			
			if($intCounter == $intNumRows)
			{
				$this->objRprt->setPageTotal($intActualSalaryPageTotal,$intCashGiftPageTotal,$intHalfBonusPageTotal,$intHalfCGPageTotal,$intNetHalfCGMSPageTotal);
				$this->objRprt->setGrandTotal($intActualSalaryGrandTotal, $intCashGiftGrandTotal,$intHalfBonusGrandTotal,$intHalfCGGrandTotal,$intNetHalfCGMSGrandTotal);
				
			}
			$this->printBody($strEmpNum, $strPosition, $strName, $intMonthlySalary, $intCashGift, $intHalfMonthlySalary, $intHalfCashGift, $intNetHalfCGMS);				
		}

		$this->objRprt->Output();		

	}
	
	
}

?>