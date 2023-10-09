<?
session_start();
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/EmpReportRemittance.php');

class EmpReportRemittanceBody extends General
{
	var $objRprt;
	var $strDeduct;
	
	function printBody($t_intCounter, $t_strName, $t_intDeduct)
	{	
		$this->SetFont('Arial','',13);
		$this->Cell(50,2,'January', 0, 0, 'L');
		$this->Cell(50,2,'31807', 0, 0, 'L');
		$this->Cell(50,2,'2004-09-16', 0, 0, 'L');
		$this->Cell(50,2,'1,350.50', 0, 0, 'L');
		$this->Ln(5);
		
	}
	
	/*function printYear()
	{
		$this->SetFont('Arial','B',11);
		$this->Cell(0,5,'Year  :', 0, 0, 'L');
		$this->Cell(30,5,'2003', 0, 0, 'L');
		$this->Ln(10);
		$this->SetFont('Arial','B',11);
		$this->Cell(30,5,'Month', 0, 0, 'L');
		$this->Cell(30,5,'OR No.', 0, 0, 'L');
		$this->Cell(30,5,'OR Date.', 0, 0, 'L');
		$this->Cell(30,5,'Amount', 0, 0, 'L');
	}*/
	
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
		$this->objRprt->AddPage();
		
	//start of all employees per section and per division
		  if($_SESSION['sesCshrEmpNmbr']== "All Employees") 
		  	{
				if($_SESSION['sesEmpSelect'] == "Per Division")
					{
						echo "1";
						$strQuery =  " tblEmpPosition.divisionCode = '".$_SESSION['sesDivSec']."'";
						$strOrder =  " tblEmpPosition.divisionCode asc ";
					}
				/*elseif($_SESSION['sesEmpSelect'] == "Per Section")
					{
						echo "2";
						$strQuery =  " tblEmpPosition.sectionCode = '".$_SESSION['sesDivSec']."'";
						$strOrder =  " tblEmpPosition.sectionCode asc ";
					}*/
		   		
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
									  WHERE tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									  	AND".$strQuery.  
									  	"AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
									  ORDER BY" .$strOrder.
									  			",tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
												tblEmpPersonal.middlename asc,tblEmpDeductRemit.deductYear desc");							
				
				
				/*$objEmpLastRcrd = mysql_query("SELECT tblEmpPersonal.empNumber
									  FROM tblEmpPersonal 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpDeductRemit
											ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber	
									  WHERE tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									  	AND".$strQuery.  
									  	"AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
									  ORDER BY" .$strOrder.
									  			",tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
												tblEmpPersonal.middlename asc,tblEmpDeductRemit.deductYear desc");*/							
				
				
				}
			//end of all employees
			//start of per employee
			elseif($_SESSION['sesCshrEmpNmbr']!= "All Employees")	  
				{
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
									  WHERE tblEmpPersonal.empNumber = '".$_SESSION['sesCshrEmpNmbr']."' 
									  	AND tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									  	AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
									  ORDER BY tblEmpDeductRemit.deductYear desc ");	
				}
			//all employees
			elseif(($_SESSION["empPerSelect"]) == "All Employees")
				{
					
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
									  WHERE  tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									  	AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
									  ORDER BY  tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
									  			tblEmpPersonal.middlename asc,tblEmpDeductRemit.deductYear desc ");
					
					/*$objEmpLastRcrd =  mysql_query("SELECT tblEmpPersonal.empNumber
									  FROM tblEmpPersonal 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpDeductRemit
											ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber	
									  WHERE  tblEmpDeductRemit.deductionCode = '".$_SESSION['sesCshrSubReportCode']."'
									  	AND tblEmpDeductRemit.deductYear BETWEEN '".$_SESSION['sesCshrYear']."' 
									  	AND '".$_SESSION['sesCshrYear1']."'
									  ORDER BY  tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
									  			tblEmpPersonal.middlename asc,tblEmpDeductRemit.deductYear desc ");*/
				
				}
			
	
		//$arrLastRcrd = mysql_fetch_array($objEmpLastRcrd);
		$intFlag = 0;
		$intEmpYearTotal = 0;
		$intEmpGrandTotal = 0;
	
		
		
		while($arrEmp = mysql_fetch_array($objEmp))
		{
			$intEmpYearTotal = $intEmpYearTotal + $arrEmp['deductAmount'];
			$intEmpGrandTotal = $intEmpGrandTotal + $arrEmp['deductAmount'];
			
			$strEmpNum =  $arrEmp['empNumber'];
			$strMidName = $arrEmp['middlename'];
			$strMiddleName = substr($strMidName,0,1);
			$strEmpName = $arrEmp['surname'].", ".$arrEmp['firstname']." ".$strMiddleName. ".";
			$strDeductMonth = $this->intToMonthFull($arrEmp['deductMonth']);														
			$strORNUmber = $arrEmp['orNumber'];	
			$strORDate = $arrEmp['orDate'];											
			
					
			if($intFlag == 0)
			{
				$strDeductYear = $arrEmp['deductYear'];
				$this->objRprt->setYear($strDeductYear);
				$this->objRprt->setEmpName($strEmpName);
				$intFlag =1;
			}
			elseif($strDeductYear!=$arrEmp['deductYear'])
			{
				$intEmpYearTotal = $intEmpYearTotal - $arrEmp['deductAmount'];
				$intEmpGrandTotal = $intEmpGrandTotal - $arrEmp['deductAmount'];
				$this->objRprt->setEmpYearTotal($intEmpYearTotal);
				$intEmpYearTotal = $arrEmp['deductAmount'];
				$strDeductYear = $arrEmp['deductYear'];
			}
			elseif($strEmpNum!= $arrEmp['empNumber'])
			{
				$this->objRprt->setEmpYearTotal($intEmpYearTotal);
				$this->objRprt->setEmpGrandTotal($intEmpGrandTotal);
				$this->objRprt->AddPage();
			}
				
		  $this->printBody($strDeductMonth, $strORNUmber,$strORDate,$arrEmp['deductAmount']);				
		}
		$this->objRprt->Output();		
	}
}
?>