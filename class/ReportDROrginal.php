<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportDeductionReg.php');

class ReportDROriginal extends General
{
	var $objRprt;
	
	/****print per deductions amount and total deduction amount per employee *****/
	function printBody($t_empNum,$t_empName,$t_arrDedCode)
	{
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->SetFillColor(255,255,255);
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(20,5,$t_empNum, 0, 0, 'L');
		$this->objRprt->Cell(45,5,$t_empName, 0, 0, 'L');
		$totalEmpDeductions=0;
		$counter=0;
		
		for($x=0;$x<=count($t_arrDedCode);$x++)
		{
			$objEmpDetails=mysql_query("SELECT tblEmpDeductRemit.deductAmount
											FROM tblEmpDeductRemit
										INNER JOIN tblEmpPersonal
											ON tblEmpDeductRemit.empNumber= tblEmpPersonal.empNumber
										WHERE tblEmpPersonal.empNumber='$t_empNum'
											AND tblEmpDeductRemit.deductionCode= '$t_arrDedCode[$x]'
											AND tblEmpDeductRemit.deductMonth='".$_SESSION['sesCshrMonth']."'
											AND tblEmpDeductRemit.deductYear='".$_SESSION['sesCshrYear']."'");
			
			$arrEmpDetails= mysql_fetch_array($objEmpDetails);
			$intDeductAmount=$arrEmpDetails['deductAmount'];
			if($intDeductAmount==0)
			{
				$intDeductAmount="0.00";
			}
			
			$totalEmpDeductions= $totalEmpDeductions + $intDeductAmount;
			
			$counter=$counter+1;
			if($counter==11)
			{
				$this->objRprt->Ln(5);
				$this->objRprt->Cell(20,5," ", 0, 0, 'L');
				$this->objRprt->Cell(45,5," ", 0, 0, 'L');
				$counter=1;
			}
			$this->objRprt->Cell(23,5,$intDeductAmount, 0, 0, 'R');
				
		} //end of for loop
		
		$this->objRprt->Ln(1);
		for($z=0;$z<=12;$z++)
		{
		  $this->objRprt->Cell(23,5," ", 0, 0, 'R'); 
		}
		$this->objRprt->Cell(30,5,number_format($totalEmpDeductions, 2,".",","), 0, 0, 'R');
		$this->objRprt->Ln(2);
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(306,5,"______________________________________________________________________________________________________________________________________________________________________________________________", 0, 0, 'L');
	
	} //end of function
	
	/***page total for every three employees***/	
	function setPageTotal($t_arrStoreEmp,$t_arrDedCode)
	{
		$this->objRprt->Ln(3);
		$this->objRprt->Cell(20,5," ", 0, 0, 'L');
		$this->objRprt->Cell(45,5," ", 0, 0, 'L');
		
		$cntrDedCode=0;
		$pageTotal=0;
		$pageTotalFlag=0;
		$grandPageTotal=0;
		for($x=0;$x<=count($t_arrDedCode);$x++)
		{		
			for($y=0;$y<=count($t_arrStoreEmp);$y++)
			{				
			   $objPageTotal=mysql_query("SELECT tblEmpDeductRemit.deductAmount
										   FROM tblEmpDeductRemit
										   INNER JOIN tblEmpPersonal
										   	ON tblEmpDeductRemit.empNumber=tblEmpPersonal.empNumber
										   WHERE tblEmpPersonal.empNumber='$t_arrStoreEmp[$y]'
										   	AND tblEmpDeductRemit.deductionCode='$t_arrDedCode[$x]'
											AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
												AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'");

				$arrPageTotal=mysql_fetch_array($objPageTotal);
				$intDeductAmount=$arrPageTotal['deductAmount'];
				$pageTotal=$pageTotal + $intDeductAmount;
				$grandPageTotal=$grandPageTotal + $intDeductAmount;
				if($y==count($t_arrStoreEmp))
				{
					$pageTotal=$pageTotal-$intDeductAmount;
				}
				
				
			 }
			 if($pageTotal==0)
			 {
			 	$pageTotal="0.00";
			 } 
			 
			 $cntrDedCode=$cntrDedCode+1;
			 if($cntrDedCode==11)
			 {
				$this->objRprt->Ln(5);
				$this->objRprt->Cell(20,5," ", 0, 0, 'L');
				$this->objRprt->Cell(45,5," ", 0, 0, 'L');
				$cntrDedCode=1;	
			 }
			 
			 if($pageTotalFlag==0)
			 {
				$this->objRprt->Ln(1);
				$this->objRprt->SetFont('Arial','B',9);
				$this->objRprt->Cell(65,5,"             PAGE TOTAL", 0, 0, 'L');
				$pageTotalFlag=1;
			 }
			 
			 $this->objRprt->Cell(23,5,number_format($pageTotal, 2,".",","), 0, 0, 'R'); 
			 $pageTotal=0;	
		
		} //end of outer for
		$this->objRprt->Ln(1);
		for($z=0;$z<=12;$z++)
		{
		  $this->objRprt->Cell(23,5," ", 0, 0, 'R'); 
		}
		$this->objRprt->Cell(30,5,number_format($grandPageTotal, 2,".",","), 0, 0, 'R');
		$this->objRprt->Ln(2);
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(306,5,"______________________________________________________________________________________________________________________________________________________________________________________________", 0, 0, 'L');
	} //end of function
	
	
	
	/**division totals***/
	
	function setDivTotal($t_arrDivEmp,$t_arrDeductCode)
	{
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(20,5," ", 0, 0, 'L');
		$this->objRprt->Cell(45,5," ", 0, 0, 'L');
		
		$cntrDeductCode=0;
		$divisionTotal= 0;
		$divTotalFlag=0;
		$grandDivTotal=0;
		for($x=0;$x<=count($t_arrDeductCode);$x++)
		{				
			for($y=0;$y<=count($t_arrDivEmp);$y++)
			{				
				$objDivTotal= mysql_query("SELECT tblEmpDeductRemit.deductAmount
										   FROM tblEmpDeductRemit
										   INNER JOIN tblEmpPersonal
										   	ON tblEmpDeductRemit.empNumber=tblEmpPersonal.empNumber
										   WHERE tblEmpPersonal.empNumber='$t_arrDivEmp[$y]'
										   	AND tblEmpDeductRemit.deductionCode='$t_arrDeductCode[$x]'
											AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
												AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'");

				$arrDivTotal= mysql_fetch_array($objDivTotal);
				
				$intDedAmount=$arrDivTotal['deductAmount'];
				$divisionTotal= $divisionTotal+$intDedAmount;
				$grandDivTotal=$grandDivTotal+$intDedAmount;
				/*if($y==count($t_arrDivEmp))
				{
					$divisionTotal = 0; //$divisionTotal-$intDedAmount;
				}
				*/
			 }
			 if($divisionTotal==0)
			 {
			   $divisionTotal="0.00";
			 } 
			 
			 $cntrDeductCode=$cntrDeductCode+1;
			 if($cntrDeductCode==11)
			 {
				$this->objRprt->Ln(5);
				$this->objRprt->Cell(20,5," ", 0, 0, 'L');
				$this->objRprt->Cell(45,5," ", 0, 0, 'L');
				$cntrDeductCode=1;	
			 }
			 
			  if($divTotalFlag==0)
			 {
				$this->objRprt->Ln(1);
				$this->objRprt->SetFont('Arial','B',9);
				$this->objRprt->Cell(65,5,"            DIVISION TOTAL", 0, 0, 'L');
				$divTotalFlag=1;
			 }
			 
			 $this->objRprt->Cell(23,5,number_format($divisionTotal, 2,".",","), 0, 0, 'R'); 
			 $divisionTotal= 0;	
		} //end of outer for
		$this->objRprt->Ln(1);
		for($z=0;$z<=12;$z++)
		{ 
		 $this->objRprt->Cell(23,5," ", 0, 0, 'R'); 
		}
		$this->objRprt->Cell(30,5,number_format($grandDivTotal, 2,".",","), 0, 0, 'R');
		$this->objRprt->Ln(2);
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(306,5,"______________________________________________________________________________________________________________________________________________________________________________________________", 0, 0, 'L');
	} //end of function
	
	
	/*print grand Total***********************************/
	function setGrandTotal($t_arrAllEmp,$t_arrDeductCode)
	{
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(20,5," ", 0, 0, 'L');
		$this->objRprt->Cell(45,5," ", 0, 0, 'L');
		
		$cntrDeductCode=0;
		$dedGrandTotal= 0;
		$grandTotalFlag=0;
		$grandTotal=0;
		for($x=0;$x<=count($t_arrDeductCode);$x++)
		{	
			for($y=0;$y<=count($t_arrAllEmp);$y++)
			{
						
				$objGrandTotal= mysql_query("SELECT tblEmpDeductRemit.deductAmount
										   FROM tblEmpDeductRemit
										   INNER JOIN tblEmpPersonal
										   	ON tblEmpDeductRemit.empNumber=tblEmpPersonal.empNumber
										   WHERE tblEmpPersonal.empNumber='$t_arrAllEmp[$y]'
										   	AND tblEmpDeductRemit.deductionCode='$t_arrDeductCode[$x]'
											AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
												AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'");

				$arrGrandTotal= mysql_fetch_array($objGrandTotal);
				$intDedAmount=$arrGrandTotal['deductAmount'];
				$dedGrandTotal= $dedGrandTotal + $intDedAmount;
				$grandTotal= $grandTotal+$intDedAmount;
			 }
			 if($dedGrandTotal==0)
			 {
			   $dedGrandTotal="0.00";
			 } 
			 
			 $cntrDeductCode=$cntrDeductCode+1;
			 if($cntrDeductCode==11)
			 {
				$this->objRprt->Ln(5);
				$this->objRprt->Cell(20,5," ", 0, 0, 'L');
				$this->objRprt->Cell(45,5," ", 0, 0, 'L');
				$cntrDeductCode=1;	
			 }
			 
			  if($grandTotalFlag==0)
			 {
				$this->objRprt->Ln(1);
				$this->objRprt->SetFont('Arial','B',9);
				$this->objRprt->Cell(65,5,"            GRAND TOTAL", 0, 0, 'L');
				$grandTotalFlag=1;
			 }
			 
			 $this->objRprt->Cell(23,5,number_format($dedGrandTotal, 2,".",","), 0, 0, 'R'); 
		} //end of outer for
		
		$this->objRprt->Ln(1);
		for($z=0;$z<=12;$z++)
		{
		  $this->objRprt->Cell(23,5," ", 0, 0, 'R'); 
		}
		$this->objRprt->Cell(30,5,number_format($grandTotal, 2,".",","), 0, 0, 'R');
		$this->objRprt->Ln(2);
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(306,5,"______________________________________________________________________________________________________________________________________________________________________________________________", 0, 0, 'L');
	} //end of function
	
	
	
	
	function generateReport()
	{
		$this->objRprt = new ReportDeductionReg('L','mm', 'legal');
		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		$this->objRprt->setDivisionName($t_strDivisionName, $t_strProjectName);
		
		$this->objRprt->SetLeftMargin(10);
		$this->objRprt->SetRightMargin(5);
		$this->objRprt->SetTopMargin(5);		
		$this->objRprt->SetAutoPageBreak("on", 55);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		
		$arrDeductCodes = array();
		$arrEmpNames = array();
		$arrTmpEmp=array();
		$arrDivEmp=array();
		$arrAllEmp=array();
		
		$objDeductionCode = mysql_query("SELECT deductionCode FROM tblDeduction ORDER BY  deductionAbb");

		while($arrDeductionCode = mysql_fetch_array($objDeductionCode))
    	{
	    	$strDeductionCode = $arrDeductionCode['deductionCode'];
    		//query all deductions with greater than 0 amount		
			$objColumnName = mysql_query("SELECT SUM(tblEmpDeductRemit.deductAmount) as grandTotal 
	      							  	  FROM tblEmpDeductRemit
			    					  		INNER JOIN tblEmpPersonal
								  				ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber
											INNER JOIN tblEmpPosition
												ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
											INNER JOIN tblEmpDeduction
												ON tblEmpPosition.empNumber = tblEmpDeduction.empNumber
								  			INNER JOIN tblDeduction
								  				ON tblEmpDeduction.deductionCode = tblDeduction.deductionCode
								  			WHERE tblEmpDeductRemit.deductionCode = '$strDeductionCode'
								  				AND tblEmpDeduction.deductionCode = '$strDeductionCode'
								  				AND tblDeduction.deductionCode = '$strDeductionCode'
												AND tblEmpPosition.statusOfAppointment = 'In-Service'
												AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
												AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'");
			$arrColumName = mysql_fetch_array($objColumnName);
			if($arrColumName['grandTotal'] > 0)
			{
				array_push($arrDeductCodes,$strDeductionCode);
			}
  	    } // end of while loop
		  
		 /*****query list of employees who are in-service****/
		 	
		 $objEmp = mysql_query("SELECT tblEmpPersonal.empNumber,tblEmpPersonal.surname,tblEmpPersonal.firstname,
		 							   tblEmpPersonal.middlename,tblEmpPosition.divisionCode,tblDivision.projectCode,
									   tblDivision.divisionName
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblDivision
									ON tblEmpPosition.divisionCode= tblDivision.divisionCode
								WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
									   AND tblEmpPosition.payrollSwitch ='Y'	
								ORDER BY tblEmpPosition.divisionCode asc, tblEmpPersonal.surname asc,
								  		tblEmpPersonal.firstname asc");
	
		 $totalEmpNum=mysql_num_rows($objEmp);
		 
		 $intFlag=0;
		 $counter=0;
		 $intNumEmp=0;
		 $intNumRows=0;
		 $intDivRow=0;
		 $intAllEmp=0;
		 	 
		 while($arrEmp=mysql_fetch_array($objEmp))
		 {
		 	$intNumRows++;		
			$strEmpNum=$arrEmp['empNumber'];
		 	$strMidName= substr($arrEmp['middlename'],1,1);
			$strEmpName= $arrEmp['surname'].", ".$arrEmp['firstname']." ".$strMidName.".";
			
			if($intFlag==0)
			  {	
				$strDivName=$arrEmp['divisionName'];
				$strProjectCode=$arrEmp['projectCode'];
				$strDivCode=$arrEmp['divisionCode'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'],$arrEmp['projectCode']);
				$intFlag=1;
				$arrTmpEmp[$counter]=$strEmpNum;
				$arrDivEmp[$intDivRow]=$strEmpNum;
				$arrAllEmp[$intAllEmp]=$strEmpNum;
				$intNumEmp=$intNumEmp+1;
				$this->objRprt->AddPage();
			  }
			
			elseif($strDivName==$arrEmp['divisionName'])
			{	
				$intNumEmp=$intNumEmp+1;
				$counter=$counter+1;
				$intDivRow= $intDivRow+1;
				$intAllEmp=$intAllEmp+1;
				$arrDivEmp[$intDivRow]=$strEmpNum;
				$arrAllEmp[$intAllEmp]=$strEmpNum;
				if($intNumEmp==4)
				{
					$this->objRprt->Ln(5);
					$this->setPageTotal($arrTmpEmp,$arrDeductCodes);
					unset($arrTmpEmp);
					$counter=0;
					$arrTmpEmp[$counter]=$strEmpNum;
					$intNumEmp=1;
					$this->objRprt->setDivisionName($arrEmp['divisionName'],$arrEmp['projectCode']);
					$this->objRprt->AddPage();	
				}
				else
				{		
					$arrTmpEmp[$counter]=$strEmpNum;	
				}	
			 }	
			 elseif($strDivName!=$arrEmp['divisionName'])
			 {						
				$this->setPageTotal($arrTmpEmp,$arrDeductCodes);	
				unset($arrTmpEmp);
				$this->setDivTotal($arrDivEmp,$arrDeductCodes);
				unset($arrDivEmp);
				$intAllEmp=$intAllEmp+1;
				$arrAllEmp[$intAllEmp]=$strEmpNum;
				$counter=0;
				$intNumEmp=1;
				$intDivRow=0;
				$arrTmpEmp[$counter]=$strEmpNum;
				$arrDivEmp[$intDivRow]=$strEmpNum;
				$strDivName=$arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'],$arrEmp['projectCode']);
				$this->objRprt->AddPage();
			 }		 
			$this->printBody($strEmpNum,$strEmpName,$arrDeductCodes);	
		}
		if($intNumRows==$totalEmpNum)
		 {
		 	$this->setPageTotal($arrTmpEmp,$arrDeductCodes);
			$this->setDivTotal($arrDivEmp,$arrDeductCodes);	
			$this->setGrandTotal($arrAllEmp,$arrDeductCodes);
		 }
		$this->objRprt->Output();	
	} //end of function generate report
}
?>