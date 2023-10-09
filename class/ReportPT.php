<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/ReportProject.php');

class ReportPT extends General
{
	var $objRprt;
	var $intTotalDeductAmountPeriod;
	var $intNetPayPeriod;
	
	
	function printBody($t_strDeductCode, $t_intDeductAmountPeriod)
	{	
		$this->objRprt->SetFont('Arial','',10);
		$this->objRprt->Cell(70,5,$t_strDeductCode,0, 0, 'L');
		$this->objRprt->Cell(50,5,number_format($t_intDeductAmountPeriod, 2, '.',','), 0, 1, 'R');
	}

	function payrollDetails($t_intCounter, $t_intTotalEarnedPeriod)
	{
		if($t_intCounter == 1)
		{
			$this->objRprt->SetFont('Arial','',10);
			$this->objRprt->Cell(40);
			$this->objRprt->Cell(100,5,'Earned for Period ............', 0, 0, 'L');
			$this->objRprt->Cell(30,5,number_format($t_intTotalEarnedPeriod, 2, '.',','), 0, 0, 'R');		
			$this->objRprt->Cell(10);				
	    }
		elseif($t_intCounter == 2)
		{
			$this->objRprt->SetFont('Arial','',10);		
			$this->objRprt->Cell(40);
			$this->objRprt->Cell(100,5,'Total Deductions ............', 0, 0, 'L');
			$this->objRprt->Cell(30,5,number_format($this->intTotalDeductAmountPeriod, 2, '.',','), 0, 0, 'R');		
			$this->objRprt->Cell(10);				
		}
		
		elseif($t_intCounter == 3)
		{
			$this->objRprt->SetFont('Arial','',10);		
			$this->objRprt->Cell(40);
			$this->objRprt->Cell(100,5,'Net Pay .....................', 0, 0, 'L');
			$this->objRprt->Cell(30,5,number_format($this->intNetPayPeriod, 2, '.',','), 0, 0, 'R');		
			$this->objRprt->Cell(10);	
		}
		
		else
		{
			$this->objRprt->Cell(180);
			
		}
	 }
	
		
	function generateReport()
	{

		$this->objRprt = new ReportProject('L','mm', 'Legal');
		
		$intWorkDays = $this->getMonthWorkDays($_SESSION['sesCshrYear'], $_SESSION['sesCshrMonth']);
		$this->objRprt->setWorkDays($intWorkDays);
	
		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear'], $_SESSION['sesCshrPeriod']);

		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on", 55);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		
		$objAgency = mysql_query("SELECT salarySchedule FROM tblAgency");
		$arrAgency = mysql_fetch_array($objAgency);
		
		$objProjectCode = mysql_query("SELECT DISTINCT projectCode 
											FROM tblDivision
											ORDER BY projectCode asc");
		
			
		while ($arrProjectCode = mysql_fetch_array($objProjectCode)) //payroll deatils
		{
			$strProjectCode = $arrProjectCode['projectCode'];
									
				$objTotalEarned = mysql_query("SELECT SUM(actualSalary) as grandSalary FROM tblEmpPosition
											   INNER JOIN tblEmpPersonal
												  ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
											   INNER JOIN tblDivision
												ON tblEmpPosition.divisionCode = tblDivision.divisionCode
										       WHERE tblDivision.projectCode = '$strProjectCode'
											   		AND tblEmpPosition.statusOfAppointment = 'In-Service'");
			
				$arrTotalEarned= mysql_fetch_array($objTotalEarned);
				$intTotalEarned = $arrTotalEarned['grandSalary'];
			
				$objDeductionCode = mysql_query("SELECT DISTINCT tblEmpDeductRemit.deductionCode
											 	FROM tblEmpDeductRemit
											 	INNER JOIN tblEmpPosition
											 		ON tblEmpPosition.empNumber = tblEmpDeductRemit.empNumber
											 	INNER JOIN tblDivision
											 		ON tblEmpPosition.divisionCode = tblDivision.divisionCode
											 	WHERE tblDivision.projectCode = '$strProjectCode'
													AND tblEmpPosition.statusOfAppointment = 'In-Service'
											 		AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
													AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'
											 	ORDER BY tblEmpDeductRemit.deductionCode");
												
		    
			
				$objLastDeductionCode = mysql_query("SELECT DISTINCT tblEmpDeductRemit.deductionCode, tblEmpDeductRemit.deductAmount
											 	FROM tblEmpDeductRemit
											 	INNER JOIN tblEmpPosition
											 		ON tblEmpPosition.empNumber = tblEmpDeductRemit.empNumber
											 	INNER JOIN tblDivision
											 		ON tblEmpPosition.divisionCode = tblDivision.divisionCode
											 	WHERE tblDivision.projectCode = '$strProjectCode'
											 		AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
													AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'
											 	ORDER BY tblEmpDeductRemit.deductionCode desc");
												
												
														  
			$arrLastDeductionCode = mysql_fetch_array($objLastDeductionCode);
			$strLastDeductionCode = $arrLastDeductionCode['deductionCode'];
			
			$this->objRprt->setProjectName($strProjectCode);
			$this->objRprt->AddPage();
		
			$intCounter=0;
			$intFlag =0;
			$this->intNetPayPeriod = 0;
			$this->intTotalDeductAmountPeriod = 0;
			
			while($arrDeductCode = mysql_fetch_array($objDeductionCode)) 
			{
				$strDeductCode = $arrDeductCode['deductionCode'];
				$objDdctAmnt = mysql_query("SELECT SUM(deductAmount) as totalDeductAmount
													FROM tblEmpDeductRemit
												INNER JOIN tblEmpPosition
													ON tblEmpDeductRemit.empNumber = tblEmpPosition.empNumber
												INNER JOIN tblDivision
													ON tblEmpPosition.divisionCode = tblDivision.divisionCode	
											 	WHERE tblDivision.projectCode = '$strProjectCode'   
													AND tblEmpDeductRemit.deductionCode = '$strDeductCode'
													AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
													AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'");

				$arrDdctAmnt = mysql_fetch_array($objDdctAmnt);
				$intDdctAmnt = $arrDdctAmnt['totalDeductAmount'];
				
				$intDdctAmntPrd = $intDdctAmnt / 2;
   			    $intTotalEarnedPeriod = $intTotalEarned / 2;
				
				
				$this->intTotalDeductAmountPeriod = $this->intTotalDeductAmountPeriod + $intDdctAmntPrd ;
				$this->intNetPayPeriod = $intTotalEarnedPeriod - $this->intTotalDeductAmountPeriod;
			}
			
			$objDeductionCode = mysql_query("SELECT DISTINCT tblEmpDeductRemit.deductionCode
											 	FROM tblEmpDeductRemit
											 	INNER JOIN tblEmpPosition
											 		ON tblEmpPosition.empNumber = tblEmpDeductRemit.empNumber
											 	INNER JOIN tblDivision
											 		ON tblEmpPosition.divisionCode = tblDivision.divisionCode
											 WHERE tblDivision.projectCode = '$strProjectCode'
											 	AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
												AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'
											 ORDER BY tblEmpDeductRemit.deductionCode");
		
		
			
			$intTotalDeductAmountPeriod = 0;								 	
		
		
			while($arrDeductCode = mysql_fetch_array($objDeductionCode)) //deduction details
			{
				$intCounter++;
				
				$strDeductCode = $arrDeductCode['deductionCode'];
				$objDeductAmount = mysql_query("SELECT SUM(deductAmount) as totalDeductAmount
													FROM tblEmpDeductRemit
												INNER JOIN tblEmpPosition
													ON tblEmpDeductRemit.empNumber = tblEmpPosition.empNumber
												INNER JOIN tblDivision
													ON tblEmpPosition.divisionCode = tblDivision.divisionCode	
											 	WHERE tblDivision.projectCode = '$strProjectCode'   
													AND tblEmpDeductRemit.deductionCode = '$strDeductCode'
													AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
													AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'");
			
				$arrDeductAmount = mysql_fetch_array($objDeductAmount);
				$intDeductAmount = $arrDeductAmount['totalDeductAmount'];
				
				$intDeductAmountPeriod = $intDeductAmount / 2;
   			    $intTotalEarnedPeriod = $intTotalEarned / 2;
				
				
				$intTotalDeductAmountPeriod = $intTotalDeductAmountPeriod + $intDeductAmountPeriod ;

			
				if ($strLastDeductionCode == $strDeductCode)
				{
					$this->objRprt->setProjectTotal($intTotalDeductAmountPeriod);
				}
				
				$this->payrollDetails($intCounter, $intTotalEarnedPeriod);
				$this->printBody($strDeductCode, $intDeductAmountPeriod);
				
			 }				 
		 }
		 $this->objRprt->Output();				
	 }
	 
	
	
	
	
	
	function getMonthWorkDays($t_intYear, $t_intMonth)
	{
		$dtmDate = $this->combineDate($t_intYear, $t_intMonth, "1");
		$intClndrDay = date('t', strtotime($dtmDate));		
		return $intClndrDay;
	}	
	
	
}
?>