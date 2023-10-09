<?
/* 
File Name: General.php
----------------------------------------------------------------------
Purpose of this file: 
Class General
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Donna Gay C. Reyes
----------------------------------------------------------------------
Date of Revision: October 8, 2003
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
 ----------------------------------------------------------------------*/

session_start();
define('FPDF_FONTPATH','../hrmis/class/font/');
require_once('../hrmis/class/fpdf.php');

class ReportDeductionReg extends FPDF
{
	var $intPageNo;
	var $blnGrandTotal = 0;
	var $strMonthName, $intYear;
	var $strDivisionName;
	var $curPageTotal, $curHPayPageTotal;
	var $intHPayGrandTotal;
	var $intWorkDays;
	var $strSgntryName, $strSgntryTitle;
	//Page header
	function Header()
	{	
		$this->SetFont('Arial','B',10);
		$this->Cell(0,4,'Republic of the Philippines', 0, 1, 'C');
		$this->Cell(0,4,$this->agencyName, 0, 1, 'C');
		$this->Cell(0,4,$this->agencyAdd, 0, 1, 'C');
		$this->Ln(5);	
		$this->SetFont('Arial','',11);
		$this->Cell(0,5,'DEDUCTION REGISTER FOR REGULAR EMPLOYEES', 0, 1, 'C');
		$this->Ln(1);
		$this->Cell(0,5,'FOR PAY PERIOD '.$this->strMonthName.' '.$this->intYear, 0, 1, 'C');
		$this->Ln(5);
		
		$this->intPageNo = $this->PageNo();
		
		$this->SetFont('Arial','',9);
		$this->Cell(0,5,'Sheet '.$this->intPageNo.' of {nb}', 0, 1, 'R');		
		$this->SetFont('Arial','',9);
		$this->Cell(25,2,'Project Name: ', 0, 0, 'L');
		$this->SetFont('Arial','B',9);
		$this->Cell(0,2,$this->strProjectName, 0, 0, 'L');
		$this->Ln(5);

		$this->SetFont('Arial','',9);
		$this->Cell(25,2,'Divsion Name: ', 0, 0, 'L');
		$this->SetFont('Arial','B',9);
		$this->Cell(0,2,$this->strDivisionName, 0, 0, 'L');
		$this->Ln(7);
						
		$arrDeductCodes = array();
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
		  
		
		$this->SetFont('Arial','B',9);
		$this->SetFillColor(255,255,255);
		$this->Cell(20,5,'EMPNUM', 0, 0, 'L',1);
		$this->Cell(45,5,'EMPLOYEE NAME', 0, 0, 'L',1);
		$counter=0;
		$intFlag=0;
		for($x=0;$x<=count($arrDeductCodes);$x++)
		{
			$counter=$counter+1;
			$this->Cell(23,5,$arrDeductCodes[$x], 0, 0, 'R',1);
			
			if($counter==10)
			{
				if($intFlag==0)
				{
				  $this->Cell(30,5,"TOTAL", 0, 0, 'R',1);
				  $intFlag=1;
				}
				$this->Ln(5);
				$this->Cell(20,5,"", 0, 0, 'L',1);
				$this->Cell(45,5,"", 0, 0, 'L',1);
				$counter=0;
			}
			if($x==count($arrDeductCodes))
			{
				$this->Ln(5);
				$this->Cell(335,5,"", 'B', 0, 'L',1);
			}
		}

		$this->Ln(5);
	
	
	} //end of function header()
	
	
	
	function setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum)
	{
		$objOfficeInfo = mysql_query("SELECT tblAgency.agencyName, tblAgency.address, tblAgency.telephone
									  FROM tblAgency");
		$arrOfficeInfo = mysql_fetch_array($objOfficeInfo);
		$this->agencyName = $arrOfficeInfo['agencyName'];
		$this->agencyAdd = $arrOfficeInfo['address'];
		$this->agencyNum = $arrOfficeInfo['telephone'];
	}	

	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
	}
	
	function setGrandTotal($t_intHPayGrandTotal,$t_intGrandTotal)
	{
		$this->blnGrandTotal = 1;
		$this->intHPayGrandTotal = $t_intHPayGrandTotal;
		$this->intGrandTotal = $t_intGrandTotal;
	}
	
	function setMonthYear($t_strMonthName, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
	}
	
	function setDivisionName($t_strDivisionName, $t_strProjectName)
	{
		$this->strDivisionName = $t_strDivisionName;
		$this->strProjectName = $t_strProjectName;
	}
	
	function setPageTotal($t_curPageTotal, $t_HPayPageTotal)
	{
		$this->curPageTotal = $t_curPageTotal;
		$this->curHPayPageTotal = $t_HPayPageTotal;
	}
	
	function setWorkDays($t_intWorkDays)
	{
		$this->intWorkDays = $t_intWorkDays;
	}
	
	
}
?>