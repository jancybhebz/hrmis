<?
session_start();
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/EmpReportRemittance.php');

class EmpReportRemittanceBody extends General
{
	var $objRprt;
	var $strDeduct;
	var $intCounter = 0;
	
	function printBody($t_strDeductMonth, $t_strDeductYear, $t_strORNUmber,$t_strORDate,$t_intDeductAmount)
	{	
		$this->objRprt->SetFont('Arial','',11);
		$this->objRprt->Cell(40,2,$t_strDeductMonth, 0, 0, 'L');
		$this->objRprt->Cell(40,2,$t_strDeductYear, 0, 0, 'L');
		$this->objRprt->Cell(40,2, $t_strORNUmber, 0, 0, 'L');
		$this->objRprt->Cell(40,2,$t_strORDate, 0, 0, 'L');
		$this->objRprt->Cell(15,2,$t_intDeductAmount, 0, 0, 'R');
		$this->objRprt->Ln(6);
		
	}
		
	function generateReport()
	{
		$this->objRprt = new EmpReportRemittance();
		
		$objDeductName = mysql_query("SELECT deductionDesc FROM tblDeduction 
										WHERE deductionCode = '".$_SESSION['sesCshrSubReportCode']."'");  
		
		$arrDeductName = mysql_fetch_array($objDeductName);   //retrieving the deduction name		
		$this->objRprt->setReportTitle($arrDeductName['deductionDesc']);   //setting the deduction name
		
		$this->objRprt->SetLeftMargin(10);
		$this->objRprt->SetRightMargin(10);
		$this->objRprt->SetTopMargin(20);
		$this->objRprt->SetAutoPageBreak("on", 55);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$strFlag =0;
		//select per division		
    	if(($_SESSION['sesEmpSelect'] == "Per Division")&&(strlen($_SESSION['sesEmpNmbr'] == 0))) 
		 {
				
				$strFlag =1;		   		
				$objEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname,tblEmpPersonal.middlename, tblEmpDeductRemit.deductAmount,
										tblEmpDeductRemit.deductMonth,tblEmpDeductRemit.deductYear,
										tblEmpDeductRemit.orNumber,tblEmpDeductRemit.orDate,
										tblEmpPosition.divisionCode
									  FROM tblEmpPersonal 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpDeductRemit
											ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber
										INNER JOIN tblDivision
											ON tblEmpPosition.divisionCode = tblDivision.divisionCode
										INNER JOIN tblDeduction
											ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode	
									  WHERE tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									  	AND tblEmpPosition.divisionCode = '".$_SESSION['sesDivSec']."'  
									  	AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
										AND tblEmpPosition.statusOfAppointment = 'In-Service'
									  ORDER BY tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
												tblEmpPersonal.middlename asc,tblEmpDeductRemit.deductYear asc, tblEmpDeductRemit.deductMonth asc");
	
			$intTotalNumRows = mysql_num_rows($objEmp);
			
						
		 }
		 //per divison with a selected employee
		elseif(($_SESSION['sesEmpSelect'] == "Per Division")&&(strlen($_SESSION['sesEmpNmbr']!= 0))) 
		 {
		 	$strFlag = 2;	
			$objPerEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname,tblEmpPersonal.middlename, tblEmpDeductRemit.deductAmount,
										tblEmpDeductRemit.deductMonth,tblEmpDeductRemit.deductYear,
										tblEmpDeductRemit.orNumber,tblEmpDeductRemit.orDate,
										tblEmpPosition.divisionCode
									  FROM tblEmpPersonal 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpDeductRemit
											ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber
										INNER JOIN tblDivision
											ON tblEmpPosition.divisionCode = tblDivision.divisionCode
										INNER JOIN tblDeduction
											ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode	
									  WHERE tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									  	AND tblEmpPersonal.empNumber = '".$_SESSION['sesEmpNmbr']."'  
									  	AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
									  ORDER BY tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
												tblEmpPersonal.middlename asc,tblEmpDeductRemit.deductYear asc, tblEmpDeductRemit.deductMonth asc");							
		
			$intTotalNumRows = mysql_num_rows($objPerEmp);
		}
		//per section printing
		elseif(($_SESSION['sesEmpSelect'] == "Per Section")&&(strlen($_SESSION['sesEmpNmbr'] == 0)))
		{
		
				$strFlag = 3;
				$objEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname,tblEmpPersonal.middlename, tblEmpDeductRemit.deductAmount,
										tblEmpDeductRemit.deductMonth,tblEmpDeductRemit.deductYear,
										tblEmpDeductRemit.orNumber,tblEmpDeductRemit.orDate,
										tblEmpPosition.sectionCode
									  FROM tblEmpPersonal 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpDeductRemit
											ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber
										INNER JOIN tblSection
											ON tblEmpPosition.sectionCode = tblSection.sectionCode
										INNER JOIN tblDeduction
											ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode	
									  WHERE tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									  	AND tblEmpPosition.sectionCode = '".$_SESSION['sesDivSec']."'  
									  	AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
										AND tblEmpPosition.statusOfAppointment = 'In-Service'
									  ORDER BY tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
												tblEmpPersonal.middlename asc,tblEmpDeductRemit.deductYear asc, tblEmpDeductRemit.deductMonth asc");
				$intTotalNumRows = mysql_num_rows($objEmp);
		
		} 
		//per section but with a selected employee
		elseif(($_SESSION['sesEmpSelect'] == "Per Section")&&(strlen($_SESSION['sesEmpNmbr'] != 0)))
		{
				$strFlag = 4;
				$objPerEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname,tblEmpPersonal.middlename, tblEmpDeductRemit.deductAmount,
										tblEmpDeductRemit.deductMonth,tblEmpDeductRemit.deductYear,
										tblEmpDeductRemit.orNumber,tblEmpDeductRemit.orDate,
										tblEmpPosition.sectionCode
									  FROM tblEmpPersonal 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpDeductRemit
											ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber
										INNER JOIN tblSection
											ON tblEmpPosition.sectionCode = tblSection.sectionCode
										INNER JOIN tblDeduction
											ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode	
									  WHERE tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									  	AND tblEmpPersonal.empNumber = '".$_SESSION['sesEmpNmbr'] ."'  
									  	AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
									  ORDER BY tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
												tblEmpPersonal.middlename asc,tblEmpDeductRemit.deductYear asc, tblEmpDeductRemit.deductMonth asc");
		
				$intTotalNumRows = mysql_num_rows($objPerEmp);
		} 
		
		//all employees were selected 
		elseif((strlen($_SESSION['sesEmpSelect'] == 0))&&(strlen($_SESSION['sesEmpNmbr'] == 0)))
		{
			$strFlag = 5;
			$objEmp = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname,tblEmpPersonal.middlename, tblEmpDeductRemit.deductAmount,
										tblEmpDeductRemit.deductMonth,tblEmpDeductRemit.deductYear,
										tblEmpDeductRemit.orNumber,tblEmpDeductRemit.orDate,
										tblEmpPosition.sectionCode
									  FROM tblEmpPersonal 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpDeductRemit
											ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber
										INNER JOIN tblDeduction
											ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode
										WHERE tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									   	AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
										AND tblEmpPosition.statusOfAppointment = 'In-Service'
									  ORDER BY tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
												tblEmpPersonal.middlename asc,tblEmpDeductRemit.deductYear asc, tblEmpDeductRemit.deductMonth asc");
	
			$intTotalNumRows = mysql_num_rows($objEmp);
		
		}
		
		//not selected per division/section but has selected an employee from the combobox
		elseif((strlen($_SESSION['sesEmpSelect'] == 0))&&(strlen($_SESSION['sesEmpNmbr'] != 0)))
		{
			$strFlag = 6;
			$objPerEmp = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname,tblEmpPersonal.middlename, tblEmpDeductRemit.deductAmount,
										tblEmpDeductRemit.deductMonth,tblEmpDeductRemit.deductYear,
										tblEmpDeductRemit.orNumber,tblEmpDeductRemit.orDate,
										tblEmpPosition.sectionCode
									  FROM tblEmpPersonal 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpDeductRemit
											ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber
										INNER JOIN tblDeduction
											ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode
										WHERE tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									    AND tblEmpPersonal.empNumber = '".$_SESSION['sesEmpNmbr']."'	
										AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
									  ORDER BY tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
												tblEmpPersonal.middlename asc,tblEmpDeductRemit.deductYear asc, tblEmpDeductRemit.deductMonth asc");
	
			$intTotalNumRows = mysql_num_rows($objPerEmp);
		}
		
		
		
		if(($strFlag == 1)||($strFlag==3)||($strFlag==5))			
		{
			$intFlag = 0;
			$intPageTotal = 0;
			$intGrandTotal = 0;
			$intPageCount = 0;
			while($arrEmp = mysql_fetch_array($objEmp))
			{
				$this->intCounter++;
				$strDeductYear = $arrEmp['deductYear'];
				$strMidName = $arrEmp['middlename'];
				$strMiddleName = substr($strMidName,0,1);
				$strEmpName = $arrEmp['surname'].", ".$arrEmp['firstname']." ".$strMiddleName. ".";
				$strDeductMonth = $this->intToMonthFull($arrEmp['deductMonth']);														
				$strORNUmber = $arrEmp['orNumber'];	
				$strORDate = $arrEmp['orDate'];											
			
				$intPageTotal = $intPageTotal + $arrEmp['deductAmount'];
				$intGrandTotal = $intGrandTotal + $arrEmp['deductAmount'];
				
				
					
				if($intFlag == 0)
				{
					$strEmpNum =  $arrEmp['empNumber'];
					$strDeductAmount = $arrEmp['deductAmount'];
					$this->objRprt->setEmpName($strEmpName);	
					$intFlag =1;
					$this->objRprt->AddPage();			
				}
				elseif($strEmpNum!= $arrEmp['empNumber']) 
				{
					$intPageTotal = $intPageTotal - $arrEmp['deductAmount'];
					$intGrandTotal = $intGrandTotal - $arrEmp['deductAmount'];
				
					$this->objRprt->setPageTotal($intPageTotal);
					$this->objRprt->setGrandTotal($intGrandTotal);
					$intPageTotal = $arrEmp['deductAmount'];
					$intGrandTotal =  $arrEmp['deductAmount']; 

					$strEmpNum = $arrEmp['empNumber'];
					$this->objRprt->setEmpName($strEmpName);
					$this->objRprt->AddPage();
				 
				}
				elseif($strEmpNum == $arrEmp['empNumber'])
				{
					$intPageCount++;
					if($intPageCount >= 19)
					{
						
						echo $intPageCount;
						$this->objRprt->blnGrandTotal = 0;
						$intPageTotal = $intPageTotal - $arrEmp['deductAmount'];
						$this->objRprt->setPageTotal($intPageTotal);
						$intPageTotal = $arrEmp['deductAmount'];
						$this->objRprt->AddPage();
						
					 }
					$intPageCount = 0;
					if($this->intCounter == $intTotalNumRows)
					 {
						$this->objRprt->setPageTotal($intPageTotal);
						$this->objRprt->setGrandTotal($intGrandTotal);
					 }
					  
					 
				 }
				
				
		  $this->printBody($strDeductMonth, $strDeductYear, $strORNUmber, $strORDate,$arrEmp['deductAmount']);				
		
		}
		 $this->objRprt->Output();
	   } //end of if statement
	   
	   elseif(($strFlag ==2)||($strFlag==4)||($strFlag==6))
	   {
	   		
			$intFlag = 0;
			$intPageTotal = 0;
			$intGrandTotal = 0;
			$intPageCount = 0;
					
			while($arrPerEmp = mysql_fetch_array($objPerEmp))
			{
				$this->intCounter++;
				//$intPageCount++;
				$strDeductYear = $arrPerEmp['deductYear'];
				$strMidName = $arrPerEmp['middlename'];
				$strMiddleName = substr($strMidName,0,1);
				$strEmpName = $arrPerEmp['surname'].", ".$arrPerEmp['firstname']." ".$strMiddleName. ".";
				$strDeductMonth = $this->intToMonthFull($arrPerEmp['deductMonth']);														
				$strORNUmber = $arrPerEmp['orNumber'];	
				$strORDate = $arrPerEmp['orDate'];											
			
				$intPageTotal = $intPageTotal + $arrPerEmp['deductAmount'];
				$intGrandTotal = $intGrandTotal + $arrPerEmp['deductAmount'];
			
				if($intFlag == 0)
				{
					$strEmpNum =  $arrPerEmp['empNumber'];
					$this->objRprt->setEmpName($strEmpName);	
					$intFlag =1;
					$this->objRprt->AddPage();			
				}
				
				elseif($intPageCount == 19)
				{
					$intPageTotal = $intPageTotal - $arrPerEmp['deductAmount'];
					$this->objRprt->setPageTotal($intPageTotal);
					$intPageTotal = $arrPerEmp['deductAmount'];
					$this->objRprt->AddPage();
					$intPageCount= 0;
				}
				
				elseif($this->intCounter == $intTotalNumRows)
				{
					
					//$intPageTotal = $intPageTotal - $arrEmp['deductAmount'];
					//$intGrandTotal = $intGrandTotal - $arrEmp['deductAmount'];
					$this->objRprt->setPageTotal($intPageTotal);
					$this->objRprt->setGrandTotal($intGrandTotal);
				}
				$this->printBody($strDeductMonth, $strDeductYear, $strORNUmber, $strORDate,$arrPerEmp['deductAmount']);				
			
			}
	   $this->objRprt->Output();
	   
	   }//end of elseif
	}//end of the function
}//end of the class
?>
