<?
session_start();
define('FPDF_FONTPATH','../hrmis/class/font/');
require_once("../hrmis/class/AttendanceCompensation.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/fpdf.php');

class ReportPSAC extends AttendanceCompensation
{
	var $objRprt;
	
	function empInfo($t_strEmpNmbr, $t_intMonth, $t_intYear)
	{
		$objAgency = mysql_query("SELECT salarySchedule FROM tblAgency");
		$arrAgency = mysql_fetch_array($objAgency);
		
		if(strlen($t_intMonth) != 0 && strlen($t_intYear) != 0)
		{
			$dtmQueryDate = $this->combineDate($t_intYear, $t_intMonth, '01');   //neded for longevity LB, DTR, PS
			$intTotalMonthDay = date('t' ,strtotime($dtmQueryDate));    //compare to longevity if equal or morethan
			$dtmQueryDate = $this->combineDate($t_intYear, $t_intMonth, $intTotalMonthDay);   //employee is included in the list
		}
		
		if($t_strEmpNmbr)
		{
			$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
							tblEmpPersonal.firstname, tblEmpPersonal.middlename,
							tblAppointment.header, tblAppointment.leaveEntitled,
							tblAppointment.appointmentCode
						FROM tblEmpPersonal 
						INNER JOIN tblEmpPosition 
							ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
						INNER JOIN tblAppointment
							ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
						INNER JOIN tblEmpIncome 
							ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
						WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'
							AND tblEmpPosition.longevityDate <= '$dtmQueryDate'								
						ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		else
		{
			$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
							tblEmpPersonal.firstname, tblEmpPersonal.middlename,
							tblAppointment.header, tblAppointment.leaveEntitled,
							tblAppointment.appointmentCode							
						FROM tblEmpPersonal 
						INNER JOIN tblEmpPosition 
							ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
						INNER JOIN tblAppointment
							ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
						INNER JOIN tblEmpIncome 
							ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
						WHERE tblEmpPosition.longevityDate <= '$dtmQueryDate'									
						ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		$intPyslpCntr = 0;
		$objEmpInfo = mysql_query($strSQL);
		while($arrEmpInfo = mysql_fetch_array($objEmpInfo))
		{					
			$this->bodyPS($arrEmpInfo, $t_intMonth, $t_intYear, $arrAgency);

			$intPySlpCntr = $intPySlpCntr + 1;
			if($intPySlpCntr == 2)
			{
				$this->objRprt->AddPage();
				$intPySlpCntr = 0;
			}
			
		}
	}
	
	function bodyPS($t_arrEmpInfo, $t_intMonth, $t_intYear, $t_arrAgency)
	{
		$strMonth = $this->intToMonthFull($t_intMonth);
		$strPay = $strMonth." ".$t_intYear;
		
		$strName = $t_arrEmpInfo["surname"].", ".$t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["middlename"];
		
		$objIncome = mysql_query("SELECT tblIncome.incomeAbb, tblEmpIncome.incomeAmount 
									FROM tblEmpIncome 
								INNER JOIN tblIncome
									ON tblIncome.incomeCode = tblEmpIncome.incomeCode
								WHERE tblEmpIncome.empNumber = '".$t_arrEmpInfo["empNumber"]."' 
									AND tblEmpIncome.incomeYear = '$t_intYear'
									AND tblEmpIncome.incomeMonth = '$t_intMonth'
									AND (tblEmpIncome.incomeCode = 'MS'
									OR tblEmpIncome.incomeCode = 'PERA'
									OR tblEmpIncome.incomeCode = 'AC')");

		$objDeduct = mysql_query("SELECT tblDeduction.deductionAbb, tblEmpDeductRemit.deductAmount 
									FROM tblEmpDeductRemit
								INNER JOIN tblDeduction
									ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode
								WHERE tblEmpDeductRemit.empNumber = '".$t_arrEmpInfo["empNumber"]."' 
									AND tblEmpDeductRemit.deductYear = '$t_intYear'
									AND tblEmpDeductRemit.deductMonth = '$t_intMonth'");						
		
		$this->objRprt->SetFont('Arial','B',12);
		$this->objRprt->Ln(8);
		$this->objRprt->Cell(0,10,strtoupper($t_arrEmpInfo["header"]).' PAY-SLIP FOR '.strtoupper($strPay),0,0,'C');

		$this->objRprt->Ln(8);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(30);
		$this->objRprt->Cell(15,10, "Name: ",0,0,'L');
		$this->objRprt->SetFont('Arial','',10);		
		$this->objRprt->Cell(0,10, $strName,0,0,'L');

		$this->objRprt->Ln(8);
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(30);
		$this->objRprt->Cell(0,10, "INCOME ",0,0,'L');
		$this->objRprt->Ln(8);		
		
		$intSumIncome = 0;
		while($arrIncome = mysql_fetch_array($objIncome))
		{
			$this->objRprt->Cell(35);		
			$this->objRprt->SetFont('Arial','B',8);
			$this->objRprt->Cell(35, 3, $arrIncome["incomeAbb"],0,0,'L');
			$this->objRprt->SetFont('Arial',"",8);		
			$this->objRprt->Cell(35,3, number_format($arrIncome["incomeAmount"], 2, ".", ","),0,1,"R");
			$intSumIncome = $intSumIncome + $arrIncome["incomeAmount"];
		}

		$this->objRprt->Cell(35);		
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(45, 5, "Total Income: ",0,0,'L');		
		$this->objRprt->Cell(50,5, number_format($intSumIncome, 2, ".", ","),0,0,"R");

		$this->objRprt->Ln(8);
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(30);		
		$this->objRprt->Cell(0,10, "DEDUCTION(S) ",0,0,'L');
		$this->objRprt->Ln(8);
		$intSumDeduct = 0;
		while($arrDeduct = mysql_fetch_array($objDeduct))
		{
			$this->objRprt->Cell(35);					
			$this->objRprt->SetFont('Arial','B',8);
			$this->objRprt->Cell(35, 3, $arrDeduct["deductionAbb"], 0, 0, 'L');
			$this->objRprt->SetFont('Arial',"",8);		
			$this->objRprt->Cell(35,3, number_format($arrDeduct["deductAmount"], 2, ".", ","), 0, 1, "R");
			$intSumDeduct = $intSumDeduct + $arrDeduct["deductAmount"];
		}		

//absentUndertimeLate
		$intDayAbsUndLate = $this->getWithoutPay($t_arrEmpInfo["empNumber"], $t_arrEmpInfo["leaveEntitled"], $t_intMonth, $t_intYear);		
		$intPaymentBasis = $this->getPaymentBasis($t_arrEmpInfo["appointmentCode"], $t_intMonth, $t_intYear);
		$intPerDay = $intSumIncome / $intPaymentBasis;
		$intDeductAbsUndLate = $intDayAbsUndLate * $intPerDay;
		
		$this->objRprt->Cell(35);					
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(35, 3, "Absent, Undertime and Late", 0, 0, 'L');
		$this->objRprt->SetFont('Arial',"",8);		
		$this->objRprt->Cell(35,3, number_format($intDeductAbsUndLate, 2, ".", ","), 0, 1, "R");
		$intSumDeduct = $intSumDeduct + $intDeductAbsUndLate;
//		
		$this->objRprt->Cell(35);		
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(45, 5, "Total Deduction: ",0,0,'L');
		$this->objRprt->Cell(50,5, number_format($intSumDeduct, 2, ".", ","),0,1,"R");
		
		$intNetPay = $intSumIncome-$intSumDeduct;
		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(30);
		$this->objRprt->Cell(50, 5, "NET PAY . . . . . . ",0,0,'L');
		$this->objRprt->SetFont('Arial','BU',8);		
		$this->objRprt->Cell(50,5, number_format($intNetPay, 2, ".", ","),0,1,'R');
		
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0, 5, "Pay based on Monthly Salary",0,1,'C');

		switch($t_arrAgency["salarySchedule"])
		{
			case "Monthly":
				$intPayBased = 1;
				$strDesc = " Month    ";   //example 1st Half, 2nd Half
				break;
			
			case "Bi-Monthly":
				$intPayBased = 2;
				$strDesc = " Half    ";   //example 1st Half, 2nd Half
				break;
			
			case "Weekly":
				$intPayBased = 4;
				$strDesc = " Week    ";   //example 1st Week, 2nd Week
				break;
		}

		for($intCounter=1; $intCounter<=$intPayBased; $intCounter++)
		{
			if ($intPayBased > 1)
			{
				$strDate = $this->combineDate($t_intYear, $t_intMonth, $intCounter);
				$strOrdinalSuffix = date("jS", strtotime($strDate)); 
			}
			$fltPayBasedSalary = $intNetPay/$intPayBased;
			$intPayBasedSalary = intval($intNetPay/$intPayBased);

			if($intCounter == $intPayBased)
			{   //kasi sa huling sweldo plus ung mga remaining decimals chuva
				$fltDecimal = $fltPayBasedSalary - $intPayBasedSalary;    //kuhanin ung butal na decimal
				$fltDecimal = $fltDecimal * $intPayBased;    //times mo un kng ilan per week
				$intPayBasedSalary = $intPayBasedSalary + $fltDecimal;   //plus mo sa sweldo na integer
			}
			
			$strPayBased = $strOrdinalSuffix.$strDesc.number_format($intPayBasedSalary,2,".",",");
			
			$this->objRprt->SetFont('Arial','B',8);		
			$this->objRprt->Cell(0, 3, $strPayBased, 0, 1,'C');
		}
		
		$this->objRprt->Ln(30);
	}
		
	function generateReport()
	{
		$this->objRprt = new FPDF;

		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);		
		$this->objRprt->SetAutoPageBreak("on", 15);

		$this->objRprt->Open();
		$this->objRprt->AddPage(); 
		$this->empInfo($_SESSION['sesCshrEmpNmbr'], $_SESSION['sesCshrMonth'], $_SESSION['sesCshrYear']);	
		$this->objRprt->Output();
	}
}
?>