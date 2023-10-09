<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportSALAllowance.php');

class ReportSALA extends General
{
	var $objRprt;
	function printBody($t_strEmpNmbr, $t_strName, $t_intSA, $t_intLA, $t_intSALA)
	{
//repeat
		$this->objRprt->SetFont('Arial','',9);		
		$this->objRprt->Cell(15,5,$t_strEmpNmbr, 0, 0, 'L');
		$this->objRprt->Cell(50,5,$t_strName, 0, 0, 'L');
		$this->objRprt->Cell(25,5,number_format($t_intSA, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(20,5,number_format($t_intLA, 2, '.',','), 0, 0, 'R');		
		$this->objRprt->Cell(15,5,'4.00', 0, 0, 'R');
		$this->objRprt->Cell(25,5,number_format($t_intSALA, 2, '.',','), 0, 0, 'R');
		$this->objRprt->SetFont('Arial','U',11);
		$this->objRprt->Cell(0,5,'                       ', 0, 1, 'L');
		$this->objRprt->Ln(5);
//repeat
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportSALAllowance('P','mm', 'Letter');

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
										tblEmpPosition.actualSalary, tblEmpIncome.incomeAmount
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpIncome.incomeCode = 'SA'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'
									AND tblEmpIncome.incomeMonth = '".$_SESSION['sesCshrMonth']."'
									AND tblEmpIncome.incomeYear = '".$_SESSION['sesCshrYear']."'																				
								ORDER BY tblEmpPosition.divisionCode, 
										tblEmpPersonal.surname, tblEmpPersonal.firstname");

		$objLastRcrd = mysql_query("SELECT tblEmpPersonal.empNumber
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpIncome.incomeCode = 'SA'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'										
									AND tblEmpIncome.incomeMonth = '".$_SESSION['sesCshrMonth']."'
									AND tblEmpIncome.incomeYear = '".$_SESSION['sesCshrYear']."'																				
								ORDER BY tblEmpPosition.divisionCode desc, 
										tblEmpPersonal.surname desc, tblEmpPersonal.firstname desc");
		
		$intFlag = 0;
		$intSAGrandTotal = 0;
		$intSAPageTotal = 0;
		$intLAGrandTotal = 0;
		$intLAPageTotal = 0;
		$intSALAGrandTotal = 0;
		$intSALAPageTotal = 0;

		$arrLastRcrd = mysql_fetch_array($objLastRcrd);
		
		while($arrEmp = mysql_fetch_array($objEmp))
		{				
			$intSAGrandTotal = $intSAGrandTotal + $arrEmp['incomeAmount'];		
			$intSAPageTotal = $intSAPageTotal + $arrEmp['incomeAmount'];

			$strEmpNmbr = $arrEmp["empNumber"];
			
			$objLA = mysql_query("SELECT incomeAmount FROM tblEmpIncome 
									WHERE empNumber='$strEmpNmbr'
										AND incomeCode='LA'");
			$arrLA = mysql_fetch_array($objLA);

			$intLAGrandTotal = $intLAGrandTotal + $arrLA['incomeAmount'];		
			$intLAPageTotal = $intLAPageTotal + $arrLA['incomeAmount'];

			$intSALA = $this->computeSALA($arrEmp['incomeAmount'], $arrLA['incomeAmount']);
			$intSALAGrandTotal = $intSALAGrandTotal + $intSALA;		
			$intSALAPageTotal = $intSALAPageTotal + $intSALA;
						
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
				$intSAPageTotal = $intSAPageTotal - $arrEmp['incomeAmount'];
				$intLAPageTotal = $intLAPageTotal - $arrLA['incomeAmount'];				
				$intSALAPageTotal = $intSALAPageTotal - $intSALA;

				$this->objRprt->setPageTotal($intSAPageTotal, $intLAPageTotal, $intSALAPageTotal);
				$intSAPageTotal = $arrEmp['incomeAmount'];
				$intLAPageTotal = $arrLA['incomeAmount'];
				$intSALAPageTotal = $intSALA;
				
				$strDivisionName = $arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName']);
				$this->objRprt->AddPage();
			}

			if($arrLastRcrd['empNumber'] == $arrEmp['empNumber'])
			{
				$this->objRprt->setGrandTotal($intSAGrandTotal, $intLAGrandTotal, $intSALAGrandTotal);
				$this->objRprt->setPageTotal($intSAPageTotal, $intLAPageTotal, $intSALAPageTotal);
			}
			$this->printBody($arrEmp['empNumber'], $strName, $arrEmp['incomeAmount'], $arrLA['incomeAmount'], $intSALA);				
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
	
	function computeSALA($t_intSA, $t_intLA)
	{
		return $t_intSA + $t_intLA;
	}

}
?>