<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportTAllowance.php');

class ReportTA extends General
{
	var $objRprt;
	function printBody($t_strEmpno, $t_strName, $t_curTA)
	{
//repeat
		$this->objRprt->SetFont('Arial','',9);		
		$this->objRprt->Cell(30,5,$t_strEmpno, 0, 0, 'L');
		$this->objRprt->Cell(70,5,$t_strName, 0, 0, 'L');
		$this->objRprt->Cell(20,5,number_format($t_curTA, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(8,5,' ', 0, 0, 'R');
		$this->objRprt->SetFont('Arial','U',11);
		$this->objRprt->Cell(0,5,'                                    ', 0, 1, 'L');
		$this->objRprt->Ln(5);
//repeat
	}
	
	function generateReport()
	{
		$objSum = mysql_query("SELECT SUM(incomeAmount) as grandTA FROM tblEmpIncome
									INNER JOIN tblEmpPosition
										ON tblEmpPosition.empNumber = tblEmpIncome.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									WHERE tblEmpIncome.incomeCode = 'TA'");
		
		$arrSum = mysql_fetch_array($objSum);
		$_SESSION['grandSTA'] = $arrSum['grandTA'];
		$this->objRprt = new ReportTAllowance('P','mm', 'Letter');
		
		$intWorkDays = $this->getMonthWorkDays($_SESSION['sesCshrYear'], $_SESSION['sesCshrMonth']);
		$this->objRprt->setWorkDays($intWorkDays);
		
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
										tblEmpPosition.actualSalary, tblEmpPosition.hpFactor,
										tblEmpIncome.incomeAmount, tblDivision.projectCode
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpIncome.incomeCode = 'TA'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'
									AND tblEmpIncome.incomeMonth = '".$_SESSION['sesCshrMonth']."'
									AND tblEmpIncome.incomeYear = '".$_SESSION['sesCshrYear']."'
								ORDER BY tblEmpPosition.divisionCode, tblEmpPersonal.surname, tblEmpPersonal.firstname");

		$objLastRcrd = mysql_query("SELECT tblEmpPersonal.empNumber
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpIncome.incomeCode = 'TA'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'
									AND tblEmpIncome.incomeMonth = '".$_SESSION['sesCshrMonth']."'
									AND tblEmpIncome.incomeYear = '".$_SESSION['sesCshrYear']."'																				
								ORDER BY tblEmpPosition.divisionCode desc, tblEmpPersonal.surname desc, tblEmpPersonal.firstname desc");
		
		$intFlag = 0;
		$intPageTotal = 0;
		$intPageTATotal = 0;
		$intPageTAGrandTotal = 0;
		$arrLastRcrd = mysql_fetch_array($objLastRcrd);
		
		while($arrEmp = mysql_fetch_array($objEmp))
		{
			
			$curTA = $arrEmp['incomeAmount'];
			
			$intTAPageTotal = $intTAPageTotal + $curTA;
			$intPageTAGrandTotal = $intPageTAGrandTotal + $curTA; 
			
			// $intPageTotal = $intPageTotal + $arrEmp['actualSalary'];
						
			$strName = $arrEmp['surname'].", ".$arrEmp['firstname'];
			
			if($intFlag == 0)
			{
				$strDivisionName = $arrEmp['divisionName'];
				$strProjectName = $arrEmp['projectCode'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'], $arrEmp['projectCode']);
				$intFlag = 1;
				$this->objRprt->AddPage();
			}
			elseif($strDivisionName != $arrEmp['divisionName'])
			{
				$intTAPageTotal = $intTAPageTotal - $curTA;
				//$intPageTotal = $intPageTotal - $arrEmp['actualSalary'];

				$this->objRprt->setPageTotal($intTAPageTotal);
				//$intPageTotal = $arrEmp['actualSalary'];
				$intTAPageTotal = $curTA;
				
				$strDivisionName = $arrEmp['divisionName'];
				$strProjectName = $arrEmp['projectCode'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'],$arrEmp['projectCode']);
				$this->objRprt->AddPage();
			}

			if($arrLastRcrd['empNumber'] == $arrEmp['empNumber'])
			{
				$this->objRprt->setGrandTotal($intPageTAGrandTotal);
				$this->objRprt->setPageTotal($intTAPageTotal);
			}
			$this->printBody($arrEmp['empNumber'], $strName, $curTA);				
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