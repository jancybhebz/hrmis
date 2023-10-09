<?
/* 
File Name: ReportPIBody.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employees information to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: May 24, 2004
----------------------------------------------------------------------
Copyright Notice:
Copyright (C) 2003 by the Department of Science and Technology
----------------------------------------------------------------------
LICENSE:
This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License (GPL) as published 
by the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version. This program is distributed in the 
hope that it will be useful, but WITHOUT ANY WARRANTY; without even the 
implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
See the GNU General Public License for more details.
To read the license please visit http://www.gnu.org/copyleft/gpl.html
 ----------------------------------------------------------------------
*/
session_start();
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportLongevityPay.php');

class ReportLPBody extends General
{
	var $objRprt;
	var $percent1;
	var $percent2;
	var $percent3;
	var $percent4;
	var $percent5;
	var $percent6;
	var $percent7;
	var $percent8;
	
	// Body
	function printBody($t_strEmpNum, $t_strName, $t_strIncomeAmount, $t_strSalary, $t_strPosition, $t_strSalaryGrade, $t_yearService)
	{
		$InterLigne = 7;
		$Percentage = 19; 
		$Height = 10;
		
		$this->objRprt->SetFont(Arial,'B',8);
		$this->objRprt->Cell(50,10,$t_strName,0,0,L);
		$this->objRprt->Cell(30,10,$t_strPosition,0,0,C);
		$this->objRprt->Cell(10,10,$t_strSalaryGrade,0,0,C);
		$this->objRprt->Cell(25,10,$t_strSalary,0,0,C);
		$this->objRprt->Cell(40,10,'',0,0,C);
		$this->objRprt->Cell(10,10,$t_yearService,0,0,C);
		$this->objRprt->Cell($Percentage,10,$this->percent1,0,0,C);
		$this->objRprt->Cell($Percentage,10,$this->percent2,0,0,C);
		$this->objRprt->Cell($Percentage,10,$this->percent3,0,0,C);
		$this->objRprt->Cell($Percentage,10,$this->percent4,0,0,C);
		$this->objRprt->Cell($Percentage,10,$this->percent5,0,0,C);
		$this->objRprt->Cell($Percentage,10,$this->percent6,0,0,C);
		$this->objRprt->Cell($Percentage,10,$this->percent7,0,0,C);
		$this->objRprt->Cell($Percentage,10,$this->percent8,0,0,C);
		$this->objRprt->Cell(25,10,$t_strIncomeAmount,0,0,C);
		$this->objRprt->Ln(10);
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportLongevityPay('L', 'mm', 'Legal');
		
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);

		//$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(8);
		$this->objRprt->SetRightMargin(8);
		$this->objRprt->SetTopMargin(10);
		$this->objRprt->SetAutoPageBreak("on",40);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		
		
		
		$objEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblDivision.divisionName,
										tblEmpPosition.positionCode, tblEmpPosition.salaryGradeNumber,
										tblEmpPosition.actualSalary, tblEmpPosition.longevityDate, tblEmpIncome.incomeAmount
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblEmpIncome
										ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpIncome.incomeCode = 'LOA'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'
									AND tblEmpIncome.incomeMonth = '".$_SESSION['sesMonth']."'
									AND tblEmpIncome.incomeYear = '".$_SESSION['sesYear']."'																				
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
								WHERE tblEmpIncome.incomeCode = 'LOA'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'										
									AND tblEmpIncome.incomeMonth = '".$_SESSION['sesMonth']."'
									AND tblEmpIncome.incomeYear = '".$_SESSION['sesYear']."'
								GROUP BY tblEmpPosition.divisionCode desc																				
								ORDER BY  tblEmpPosition.divisionCode desc");
		
		$intCounter = 0;
		$intFlag = 0;
		$intLOAGrandTotal = 0;
		$intLOAPageTotal = 0;

		$arrLastRcrd = mysql_fetch_array($objLastRcrd);
		$intNumRows = mysql_num_rows($objEmp);
		
		while($arrEmp = mysql_fetch_array($objEmp))
		{			
			$intCounter++;
				
			$intLOAGrandTotal = $intLOAGrandTotal + $arrEmp['incomeAmount'];		
			$intLOAPageTotal = $intLOAPageTotal + $arrEmp['incomeAmount'];

			$strEmpNmbr = $arrEmp['empNumber'];
			$strIncomeAmount = $arrEmp['incomeAmount'];
			$strName = $arrEmp['surname'].", ".$arrEmp['firstname'];
			$strSalary = $arrEmp['actualSalary'];
			$strPosition = $arrEmp['positionCode'];
			$strSalaryGrade = $arrEmp['salaryGradeNumber'];
			$strLongevityDate = $arrEmp['longevityDate'];
			if ($longevityDate == '0000-00-00') 
				{ $yearService = 0; }
			else {
				$currentdate = date ("Y m", mktime(0,0,0,date("m") ,date("d") ,date("Y")));
				$lastmonth = date ("m", mktime(0,0,0,date("m")-1 ,date("d") ,date("Y")));
				$yearService = $currentdate - $strLongevityDate; 
				}
			
			if($intFlag == 0)
			{
				$strEmpNmbr = $arrEmp['empNumber'];
				$strDivisionName = $arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'], $arrEmp['empNumber']);
				$intFlag = 1;
				$this->objRprt->AddPage();
			}
			elseif($strDivisionName != $arrEmp['divisionName'])
			{
				$intLOAPageTotal = $intLOAPageTotal - $arrEmp['incomeAmount'];
			
				$this->objRprt->setPageTotal($intLOAPageTotal);
				$intLOAPageTotal = $arrEmp['incomeAmount'];
				
				$strEmpNmbr = $arrEmp['empNumber'];
				$strDivisionName = $arrEmp['divisionName'];
				$this->objRprt->setDivisionName($arrEmp['divisionName'], $arrEmp['empNumber']);
				$this->objRprt->AddPage();
			}

			if($arrLastRcrd['empNumber'] == $arrEmp['empNumber'])
			{
				$this->objRprt->setGrandTotal($intLOAGrandTotal);
				$this->objRprt->setPageTotal($intLOAPageTotal);
				
			}
			$this->getLongevity ($arrEmp['empNumber'],$yearService, $strSalary, $num);
			$this->printBody($arrEmp['empNumber'], $strName, $strIncomeAmount, $strSalary, $strPosition, $strSalaryGrade, $yearService);				
		}
					

		$this->objRprt->Output();
	}
	
	function getLongevity ($empNumber,$yearService, $actualSalary, $num)
	{
		
		if ($yearService > 4 && $yearService < 10) 
						{			
							$this->percent1 = $actualSalary * .05;
							$this->percent2 = "";
							$this->percent3 = "";
							$this->percent4 = "";
							$this->percent5 = "";
							$this->percent6 = "";
							$this->percent7 = "";
							$this->percent8 = "";
							return $this->percent8;
							return $this->percent7;
							return $this->percent6;
							return $this->percent5;
							return $this->percent4;
							return $this->percent3;
							return $this->percent2;
							return $this->percent1;
							
										
						}
						
		elseif ($yearService > 9 && $yearService < 15) 
						{			
							$this->percent1 = $actualSalary * .05;
							$this->percent2 = $actualSalary * .1;
							$this->percent3 = "";
							$this->percent4 = "";
							$this->percent5 = "";
							$this->percent6 = "";
							$this->percent7 = "";
							$this->percent8 = "";
							return $this->percent8;
							return $this->percent7;
							return $this->percent6;
							return $this->percent5;
							return $this->percent4;
							return $this->percent3;
							return $this->percent2;
							return $this->percent1;
										
						}
		elseif ($yearService > 14 && $yearService < 20) 
						{			
							$this->percent1 = $actualSalary * .05;
							$this->percent2 = $actualSalary * .1;
							$this->percent3 = $actualSalary * .15;
							$this->percent4 = "";
							$this->percent5 = "";
							$this->percent6 = "";
							$this->percent7 = "";
							$this->percent8 = "";
							return $this->percent8;
							return $this->percent7;
							return $this->percent6;
							return $this->percent5;
							return $this->percent4;
							return $this->percent3;
							return $this->percent2;
							return $this->percent1;
										
						}
					
		elseif ($yearService > 19 && $yearService < 25) 
						{			
							$this->percent1 = $actualSalary * .05;
							$this->percent2 = $actualSalary * .1;
							$this->percent3 = $actualSalary * .15;
							$this->percent4 = $actualSalary * .2;
							$this->percent5 = "";
							$this->percent6 = "";
							$this->percent7 = "";
							$this->percent8 = "";
							return $this->percent8;
							return $this->percent7;
							return $this->percent6;
							return $this->percent5;
							return $this->percent4;
							return $this->percent3;
							return $this->percent2;
							return $this->percent1;
										
						}
						
		elseif ($yearService > 24 && $yearService < 30) 
						{			
							$this->percent1 = $actualSalary * .05;
							$this->percent2 = $actualSalary * .1;
							$this->percent3 = $actualSalary * .15;
							$this->percent4 = $actualSalary * .2;
							$this->percent5 = $actualSalary * .25;
							$this->percent6 = "";
							$this->percent7 = "";
							$this->percent8 = "";
							return $this->percent8;
							return $this->percent7;
							return $this->percent6;
							return $this->percent5;
							return $this->percent4;
							return $this->percent3;
							return $this->percent2;
							return $this->percent1;
										
						}
						
		elseif ($yearService > 29 && $yearService < 35) 
						{			
							$this->percent1 = $actualSalary * .05;
							$this->percent2 = $actualSalary * .1;
							$this->percent3 = $actualSalary * .15;
							$this->percent4 = $actualSalary * .2;
							$this->percent5 = $actualSalary * .25;
							$this->percent6 = $actualSalary * .3;
							$this->percent7 = "";
							$this->percent8 = "";
							return $this->percent8;
							return $this->percent7;
							return $this->percent6;
							return $this->percent5;
							return $this->percent4;
							return $this->percent3;
							return $this->percent2;
							return $this->percent1;
										
						}
		
		elseif ($yearService > 34 && $yearService < 40) 
						{			
							$this->percent1 = $actualSalary * .05;
							$this->percent2 = $actualSalary * .1;
							$this->percent3 = $actualSalary * .15;
							$this->percent4 = $actualSalary * .2;
							$this->percent5 = $actualSalary * .25;
							$this->percent6 = $actualSalary * .3;
							$this->percent7 = $actualSalary * .35;
							$this->percent8 = "";
							return $this->percent8;
							return $this->percent7;
							return $this->percent6;
							return $this->percent5;
							return $this->percent4;
							return $this->percent3;
							return $this->percent2;
							return $this->percent1;
										
						}
						
			elseif ($yearService > 39 && $yearService < 75) 
						{			
							$this->percent1 = $actualSalary * .05;
							$this->percent2 = $actualSalary * .1;
							$this->percent3 = $actualSalary * .15;
							$this->percent4 = $actualSalary * .2;
							$this->percent5 = $actualSalary * .25;
							$this->percent6 = $actualSalary * .3;
							$this->percent7 = $actualSalary * .35;
							$this->percent8 = $actualSalary * .40;
							return $this->percent8;
							return $this->percent7;
							return $this->percent6;
							return $this->percent5;
							return $this->percent4;
							return $this->percent3;
							return $this->percent2;
							return $this->percent1;
										
						}
	
	}
				

}  // End Class

?>