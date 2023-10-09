<?
session_start();
session_register('grandSalary');
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportHPay.php');

class ReportHP extends General
{
	var $objRprt;
	function printBody($t_strName, $t_curActualSalary, $t_curHPay)
	{
		$this->objRprt->SetFont('Arial','',9);		
		$this->objRprt->Cell(50,5,$t_strName, 0, 0, 'L');
		$this->objRprt->Cell(27,5,number_format($t_curActualSalary, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(26,5,'0.00', 0, 0, 'R');
		$this->objRprt->Cell(25,5,number_format($t_curHPay, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(9,5,' ', 0, 0, 'R');
		$this->objRprt->SetFont('Arial','U',10);
		$this->objRprt->Cell(5,5,'                                      ', 0, 1, 'L');
		
	}
	
	function generateReport()
	{
		$objSum = mysql_query("SELECT SUM(actualSalary) as grandSalary FROM tblEmpPosition
									INNER JOIN tblEmpPersonal
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode");
		
		$arrSum = mysql_fetch_array($objSum);
		$_SESSION['grandSalary'] = $arrSum['grandSalary'];
		$this->objRprt = new ReportHPay('P','mm', 'Letter');
		
		$intWorkDays = $this->getMonthWorkDays($_SESSION['sesCshrYear'], $_SESSION['sesCshrMonth']);
		$this->objRprt->setWorkDays($intWorkDays);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear']);
		
		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);		
		$this->objRprt->SetAutoPageBreak("on", 90);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();

		$objEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblDivision.divisionName, 
										tblEmpPosition.actualSalary, tblEmpIncome.incomeAmount
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpIncome.incomeCode = 'HP'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'
									AND tblEmpIncome.incomeMonth = '".$_SESSION['sesCshrMonth']."'
									AND tblEmpIncome.incomeYear = '".$_SESSION['sesCshrYear']."'																																																
								ORDER BY tblEmpPosition.divisionCode, 
										tblEmpPersonal.surname, tblEmpPersonal.firstname");

		$intNumRows = mysql_num_rows($objEmp);
		$objLastRcrd = mysql_query("SELECT tblEmpPersonal.empNumber
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpIncome.incomeCode = 'HP'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'
									AND tblEmpIncome.incomeMonth = '".$_SESSION['sesCshrMonth']."'
									AND tblEmpIncome.incomeYear = '".$_SESSION['sesCshrYear']."'																																						
								ORDER BY tblEmpPosition.divisionCode desc, 
										tblEmpPersonal.surname desc, tblEmpPersonal.firstname desc");
		
		$intCounter = 0;
		$intFlag = 0;
		$intPageTotal = 0;
		$intGrandTotal =0;
		$intPageHPayTotal = 0;
		$intPageHPayGrandTotal = 0;
		$arrLastRcrd = mysql_fetch_array($objLastRcrd);
		
		while($arrEmp = mysql_fetch_array($objEmp))
		{
			$intCounter++;
			$curHPay = $arrEmp['incomeAmount'];
			
			$intHPayPageTotal = $intHPayPageTotal + $curHPay;
			$intPageHPayGrandTotal = $intPageHPayGrandTotal + $curHPay; 
			
			$intPageTotal = $intPageTotal + $arrEmp['actualSalary'];
			$intGrandTotal = $intGrandTotal + $arrEmp['actualSalary'];
						
			$strName = $arrEmp['surname'].", ".$arrEmp['firstname'];
			
			if($intFlag == 0)
			{
				$strDivisionName = $arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName']);
				$intFlag = 1;
				$this->objRprt->AddPage();
			}
			elseif($strDivisionName != $arrEmp['divisionName'])
			{
				$intHPayPageTotal = $intHPayPageTotal - $curHPay;
				$intPageTotal = $intPageTotal - $arrEmp['actualSalary'];

				$this->objRprt->setPageTotal($intPageTotal, $intHPayPageTotal);
				$intPageTotal = $arrEmp['actualSalary'];
				$intHPayPageTotal = $curHPay;
				
				$strDivisionName = $arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName']);
				$this->objRprt->AddPage();
			}

			//if($arrLastRcrd['empNumber'] == $arrEmp['empNumber'])
			if($intCounter == $intNumRows)
			{
				$this->objRprt->setGrandTotal($intPageHPayGrandTotal,$intGrandTotal);
				$this->objRprt->setPageTotal($intPageTotal, $intHPayPageTotal);
			}
			$this->printBody($strName, $arrEmp['actualSalary'], $curHPay);				
		}

		$this->objRprt->Output();		
	}
	
	function getMonthWorkDays($t_intYear, $t_intMonth)
	{
		$dtmDate = $this->combineDate($t_intYear, $t_intMonth, "1");
		$intClndrDay = date('t', strtotime($dtmDate));
		$intTotalSatSun = 0;
		
		for($intCount=1; $intCount <= $intClndrDay; $intCount++)
		{
			$dtmDate = $this->combineDate($t_intYear, $t_intMonth, $intCount);

			$strDay = date('D', strtotime($dtmDate));
			
			if($strDay == "Sat" || $strDay == "Sun")
			{
				$intTotalSatSun++;
			}
		}
		
		return $intClndrDay - $intTotalSatSun;
	}
}
?>