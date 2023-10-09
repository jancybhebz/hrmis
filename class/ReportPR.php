<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportPayroll.php');

class ReportPR extends General
{
	var $objRprt;
	var $intDeduct, $intNetPay;
	function printBody($t_intCounter, $t_arrEmpInfo, $t_arrAgency)
	{
		$this->objRprt->SetFont('Arial','',9);
		
		$strName = $t_arrEmpInfo["surname"].", ".$t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["middlename"];
//repeat		
		$this->objRprt->Cell(10,5, $t_intCounter, 0, 0, 'L');
		$this->objRprt->Cell(70,5, $strName, 0, 0, 'L');
		$this->objRprt->Cell(40,5, $t_arrEmpInfo["positionAbb"], 0, 0, 'L');
		$this->objRprt->Cell(40,5,$t_arrEmpInfo["empNumber"], 0, 0, 'L');
		$this->objRprt->Cell(40,5,number_format($t_arrEmpInfo["actualSalary"], 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(40,5,number_format($t_arrEmpInfo["actualSalary"]/2, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(40,5,number_format($this->intDeduct/2, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(30,5,number_format($this->$intNetPay, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Ln(5);
//repeat
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
		$this->objRprt = new ReportPayroll('L','mm', 'Legal');

		$intWorkDays = $this->getMonthWorkDays($_SESSION['sesCshrYear'], $_SESSION['sesCshrMonth']);
		$this->objRprt->setWorkDays($intWorkDays);

		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear'], $_SESSION['sesCshrPeriod']);

		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);		
		$this->objRprt->SetAutoPageBreak("on", 85);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();

		$objAgency = mysql_query("SELECT salarySchedule FROM tblAgency");
		$arrAgency = mysql_fetch_array($objAgency);

		
		$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
				tblEmpPersonal.firstname, tblEmpPersonal.middlename,
				tblAppointment.header, tblAppointment.leaveEntitled,
				tblAppointment.appointmentCode, tblDivision.divisionName, 
				tblDivision.projectCode, tblPosition.positionAbb,
				tblEmpPosition.actualSalary
			FROM tblEmpPersonal 
			INNER JOIN tblEmpPosition 
				ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
			INNER JOIN tblAppointment
				ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
			INNER JOIN tblEmpIncome 
				ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
			INNER JOIN tblDivision
				ON tblEmpPosition.divisionCode = tblDivision.divisionCode
			INNER JOIN tblPosition
				ON tblEmpPosition.positionCode = tblPosition.positionCode
			
			ORDER BY tblEmpPosition.divisionCode, tblEmpPersonal.surname, tblEmpPersonal.firstname";
	
		$objEmp = mysql_query($strSQL);
	
		$objEmpLastRcrd = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber							
					FROM tblEmpPersonal 
					INNER JOIN tblEmpPosition 
						ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
					INNER JOIN tblAppointment
						ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
					INNER JOIN tblEmpIncome 
						ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
					INNER JOIN tblDivision
						ON tblEmpPosition.divisionCode = tblDivision.divisionCode						
					ORDER BY tblEmpPosition.divisionCode desc, tblEmpPersonal.surname desc, tblEmpPersonal.firstname desc");	

		$intFlag = 0;
		$intPageMSTotal = 0;
		$intPageEPTotal = 0;
		$intPageDTotal = 0;
		$intPageNPTotal = 0;
		$intPageMSGrandTotal = 0;
		$intPageEPGrandTotal = 0;
		$intPageDGrandTotal = 0;
		$intPageNPGrandTotal = 0;

		$intCounter = 0;

		$arrLastRcrd = mysql_fetch_array($objEmpLastRcrd);
		
		while($arrEmp = mysql_fetch_array($objEmp))
		{
			$objDeduct = mysql_query("SELECT SUM(deductAmount) as empDeductAmount
										FROM tblEmpDeductRemit
									WHERE empNumber = '".$arrEmp["empNumber"]."' 
										AND deductYear = '".$_SESSION['sesCshrYear']."'
										AND deductMonth = '".$_SESSION['sesCshrMonth']."'");
										
			$arrDeduct = mysql_fetch_array($objDeduct);						
			$this->intDeduct = $arrDeduct['empDeductAmount'];
			$this->$intNetPay = $this->getNetPay($arrEmp["actualSalary"], $arrDeduct['empDeductAmount']);
		
			$intCounter++;
			$intPageMSTotal = $intPageMSTotal + $arrEmp['actualSalary'];
			$intPageEPTotal = $intPageEPTotal + ($arrEmp['actualSalary'] / 2);
			$intPageDTotal = $intPageDTotal + ($arrDeduct['empDeductAmount'] / 2);
			$intPageNPTotal = $intPageNPTotal + $this->$intNetPay;			
//------------ set the grand total
			$intPageMSGrandTotal = $intPageMSGrandTotal + $arrEmp['actualSalary'];
			$intPageEPGrandTotal = $intPageEPGrandTotal + ($arrEmp['actualSalary'] / 2);
			$intPageDGrandTotal = $intPageDGrandTotal + ($arrDeduct['empDeductAmount'] / 2);
			$intPageNPGrandTotal = $intPageNPGrandTotal + $this->$intNetPay;			
//-------------------

			$strName = $arrEmp['surname'].", ".$arrEmp['firstname'];

			if($intFlag == 0)
			{
				$strDivisionName = $arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'], $arrEmp['projectCode']);
				$intFlag = 1;
				$this->objRprt->AddPage();
			}
			elseif($strDivisionName != $arrEmp['divisionName'])
			{
				$intCounter = 1;
				$intPageMSTotal = $intPageMSTotal - $arrEmp['actualSalary'];
				$intPageEPTotal = $intPageEPTotal - ($arrEmp['actualSalary'] / 2);
				$intPageDTotal = $intPageDTotal - ($arrDeduct['empDeductAmount'] / 2);				
				$intPageNPTotal = $intPageNPTotal - $this->$intNetPay;

				$this->objRprt->setPageTotal($intPageMSTotal, $intPageEPTotal, $intPageDTotal, $intPageNPTotal);
				$intPageMSTotal = $arrEmp['actualSalary'];
				$intPageEPTotal = $arrEmp['actualSalary'] / 2;				
				$intPageDTotal = $arrDeduct['empDeductAmount'] / 2;
				$intPageNPTotal = $this->$intNetPay;
				
				$strDivisionName = $arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'], $arrEmp['projectCode']);
				$this->objRprt->AddPage();
			}

			if($arrLastRcrd['empNumber'] == $arrEmp['empNumber'])
			{
				$this->objRprt->setGrandTotal($intPageMSGrandTotal, $intPageEPGrandTotal, $intPageDGrandTotal, $intPageNPGrandTotal);
				$this->objRprt->setPageTotal($intPageMSTotal, $intPageEPTotal, $intPageDTotal, $intPageNPTotal);
			}
			$this->printBody($intCounter, $arrEmp, $arrAgency);
		}
					
		$this->objRprt->Output();		
	}

	function getMonthWorkDays($t_intYear, $t_intMonth)
	{
		$dtmDate = $this->combineDate($t_intYear, $t_intMonth, "1");
		$intClndrDay = date('t', strtotime($dtmDate));		
		return $intClndrDay;
	}	
	
	function getNetPay($t_intSalary, $t_intDeduct)
	{
		$t_intDeduct = $t_intDeduct / 2;
		$t_intSalary = $t_intSalary / 2;		
		return $t_intSalary - $t_intDeduct;
	}
}
?>