<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportPERAACompensation.php');

class ReportPERAAC extends General
{
	var $objRprt;
	function printBody($t_strEmpNo, $t_strEmpName, $t_strPERA, $t_strAC, $t_strNet)
	{
//repeat
		$this->objRprt->SetFont('Arial','',9);		
		$this->objRprt->Cell(15,5,$t_strEmpNo, 0, 0, 'L');
		$this->objRprt->Cell(61,5,$t_strEmpName, 0, 0, 'L');
		$this->objRprt->Cell(30,5,number_format($t_strPERA, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(32,5,number_format($t_strAC, 2, '.',','), 0, 0, 'R');
		$this->objRprt->Cell(32,5,number_format($t_strNet, 2, '.',',') , 0, 0, 'R');
		$this->objRprt->Ln(5);
//repeat
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportPERAACompensation('P','mm', 'Letter');
		
		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);		
		$this->objRprt->SetAutoPageBreak("on", 90);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		
		$objEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblDivision.divisionName, 
										tblDivision.projectCode, tblEmpIncome.incomeAmount		
							   FROM tblEmpPersonal
								   INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpIncome.incomeCode = 'PERA' 
										AND tblEmpPosition.statusOfAppointment = 'In-Service'
										AND tblEmpIncome.incomeMonth = '".$_SESSION['sesCshrMonth']."'
										AND tblEmpIncome.incomeYear = '".$_SESSION['sesCshrYear']."'
								ORDER BY tblEmpPosition.divisionCode asc, 
										tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc");
	
		$objLastRecord = mysql_query("SELECT tblEmpPersonal.empNumber 
									  FROM tblEmpPersonal
								      INNER JOIN tblEmpPosition
										  ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									  INNER JOIN tblDivision
										  ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									  INNER JOIN tblEmpIncome
										  ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
	   								  WHERE tblEmpIncome.incomeCode = 'PERA' 
									  	  AND tblEmpPosition.statusOfAppointment = 'In-Service'
										  AND tblEmpIncome.incomeMonth = '".$_SESSION['sesCshrMonth']."'
										  AND tblEmpIncome.incomeYear = '".$_SESSION['sesCshrYear']."'
									  ORDER BY tblEmpPosition.divisionCode asc, 
										tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc");
			
		$intNumRows = mysql_num_rows($objEmp);
										
		$intCounter = 0;
		$intFlag = 0;
		$intPERAPageTotal = 0;
		$intACPageTotal = 0;
		$intPERAGrandTotal = 0;
		$intACGrandTotal = 0;
		$intPERAACPageTotal = 0;
		$intPERAACGrandTotal = 0;
		
		$arrLastRecord = mysql_fetch_array($objLastRecord);
		
		while ($arrEmp = mysql_fetch_array($objEmp))
		{
		  $intCounter++;
		  $intPERAPageTotal  = $intPERAPageTotal + $arrEmp['incomeAmount'];
		  $intPERAGrandTotal = $intPERAGrandTotal + $arrEmp['incomeAmount'];
		  $strEmpNum = $arrEmp[empNumber];
		  
		  $objAC = mysql_query("SELECT incomeAmount FROM tblEmpIncome
		  						   WHERE empNumber = '$strEmpNum'
								   AND incomeCode = 'AC'");
		
		  $arrAC = mysql_fetch_array($objAC);
		  
		  $intACPageTotal  = $intACPageTotal + $arrAC['incomeAmount'];
		  $intACGrandTotal = $intACGrandTotal + $arrAC['incomeAmount'];
		  
		  $intPERAAC = $this->computePERAAC($arrEmp['incomeAmount'], $arrAC['incomeAmount']);
		  $intPERAACGrandTotal = $intPERAACGrandTotal + $intPERAAC;		
		  $intPERAACPageTotal = $intPERAACPageTotal + $intPERAAC;

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
				$intPERAPageTotal = $intPERAPageTotal - $arrEmp['incomeAmount'];
				$intACPageTotal = $intACPageTotal - $arrAC['incomeAmount'];				
				$intPERAACPageTotal = $intPERAACPageTotal - $intPERAAC;

				$this->objRprt->setPageTotal($intPERAPageTotal, $intACPageTotal, $intPERAACPageTotal);
				$intPERAPageTotal = $arrEmp['incomeAmount'];
				$intACPageTotal = $arrAC['incomeAmount'];
				$intPERAACPageTotal = $intPERAAC;
				
				$strDivisionName = $arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'], $arrEmp['projectCode'] );
				$this->objRprt->AddPage();
			}

			//if($arrLastRecord['empNumber'] == $arrEmp['empNumber'])
			if($intCounter == $intNumRows)
			{
				$this->objRprt->setGrandTotal($intPERAGrandTotal, $intACGrandTotal, $intPERAACGrandTotal);
				$this->objRprt->setPageTotal($intPERAPageTotal, $intACPageTotal, $intPERAACPageTotal);
			}
			$this->printBody($arrEmp['empNumber'], $strName, $arrEmp['incomeAmount'], $arrAC['incomeAmount'], $intPERAAC);				
		}

		$this->objRprt->Output();
   	  }					   
		 
		
	
	function computePERAAC($t_intPERA, $t_intAC)
	{
		return $t_intPERA + $t_intAC;
	} 
		   	
	
}
?>