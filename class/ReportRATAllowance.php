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
Author: Brian Jill DG. Sarandi
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
 ----------------------------------------------------------------------
*/

define('FPDF_FONTPATH','../hrmis/class/font/');
require_once('../hrmis/class/fpdf.php');

class ReportRATAllowance extends FPDF
{
	//Page header
	var $intPageNo;
	var $blnGrandTotal = 0;
	var $strMonthName, $intMonth;
	var $strDivisionName;
	var $curRAPageTotal, $curTAPageTotal, $curRATAPageTotal;
	var $curRAGrandTotal, $curTAGrandTotal, $curRATAGrandTotal;
	var $strSgntryName, $strSgntryTitle;
	var $agencyName, $agencyAdd, $agencyNum;

	function Header()
	{	
		$this->SetFont('Arial','B',10);
		$this->Cell(0,4,'Republic of the Philippines', 0, 1, 'C');
		$this->Cell(0,4,$this->agencyName, 0, 1, 'C');
		$this->Cell(0,4,$this->agencyAdd, 0, 1, 'C');
		$this->Ln(5);	
		$this->SetFont('Arial','',11);
		$this->Cell(0,5,'PAYROLL REGISTER FOR COMMUTABLE TRANSPORTATION AND REPRESENTATION ALLOWANCE', 0, 1, 'C');
		$this->Ln(1);
		$this->Cell(0,5,'For the month of  '.$this->strMonthName.' '.$this->intYear, 0, 1, 'C');
		$this->Ln(5);

		$this->intPageNo = $this->PageNo();
		
		$this->SetFont('Arial','',9);
		$this->Cell(0,5,'Sheet '.$this->intPageNo.' of {nb}', 0, 1, 'R');
		$this->Ln(7);
						
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(200,200,200);
		$this->Cell(15,5,'EMP #', 0, 0, 'L',1);
		$this->Cell(50,5,'EMPLOYEE NAME', 0, 0, 'L',1);
		$this->Cell(30,5,'TRANSPORTATION', 0, 0, 'C',1);
		$this->Cell(30,5,'REPRESENTATION', 0, 0, 'C',1);
		$this->Cell(28,5,'NET', 0, 0, 'C',1);
		$this->Cell(0,5,'SIGNATURE', 0, 1, 'L',1);
		
		$this->Cell(65,5,'', 0, 0, 'L',1);
		$this->Cell(30,5,'ALLOWANCE', 0, 0, 'C',1);
		$this->Cell(30,5,'ALLOWANCE', 0, 0, 'C',1);
		$this->Cell(0,5,'', 0, 0, 'C',1);
		$this->Ln(7);
	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-90);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',9);
		$this->Cell(65,5,'PAGE TOTAL:', 0, 0, 'R',1);
		$this->Cell(23,5,number_format($this->curTAPageTotal, 2, '.',','), 0, 0, 'R',1);
		$this->Cell(26,5,number_format($this->curRAGrandTotal, 2, '.',','), 0, 0, 'R',1);
		$this->Cell(30,5,number_format($this->curRATAPageTotal, 2, '.',','), 0, 0, 'R',1);
		$this->Cell(0,5,'', 0, 1, 'L',1);
		$this->Ln(1);
			
		if($this->blnGrandTotal)
		{	
			$this->SetFont('Arial','B',9);
			$this->Cell(65,5,'GRAND TOTAL:', 0, 0, 'R',1);
			$this->Cell(23,5,number_format($this->curTAGrandTotal, 2, '.',','), 0, 0, 'R',1);
			$this->Cell(26,5,number_format($this->curRAPageTotal, 2, '.',','), 0, 0, 'R',1);
			$this->Cell(30,5,number_format($this->curRATAGrandTotal, 2, '.',','), 0, 0, 'R',1);
			$this->Cell(0,5,'', 0, 1, 'L',1);
		}	
		$this->Ln(5);
		
		
		$this->SetFont('Arial','',8);
		$this->Cell(60,5,'CERTIFIED: Service duty rendered as stated.:', 0, 0, 'L');
		$this->Cell(20);
		$this->Cell(30,5,'Approved for payment:', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'                                                            ', 0, 0, 'L');
		$this->Ln(7);

		$this->SetFont('Arial','U',11);
		$this->Cell(80);
		$this->Cell(0,5,'                                                      (P                             ', 0, 0, 'L');
		$this->Ln(10);

		$this->SetFont('Arial','B',9);
		$this->setSignatory("Personnel");		
		$this->Cell(60, 5, strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Cell(40);
		$this->setSignatory("Director");
		$this->Cell(0, 5, strtoupper($this->strSgntryName), 0, 0, 'L');
		$this->Ln(4);

		$this->setSignatory("Personnel");
		$this->Cell(60, 5, $this->strSgntryTitle, 0, 0, 'C');
		$this->Cell(50);
		$this->setSignatory("Director");
		$this->Cell(0, 5, $this->strSgntryTitle, 0, 0, 'L');
		$this->Ln(7);

		$this->SetFont('Arial','',8);
		$this->Cell(80,5,'CERTIFIED: Supporting documents complete', 0, 0, 'L');
		$this->Cell(70,5,'CERTIFIED: Each employee whose name appears', 0, 0, 'L');
		$this->SetFont('Arial','',8);
		$this->Cell(15,5,'ALOBS No.', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'       ', 0, 0, 'R');
		$this->Ln(3);

		$this->SetFont('Arial','',8);
		$this->Cell(80,5,'and proper and cash', 0, 0, 'L');
		$this->Cell(70,5,'above has been paid the amount indicated opposite', 0, 0, 'L');
		$this->SetFont('Arial','',8);
		$this->Cell(15,5,'Date', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'       ', 0, 0, 'R');
		$this->Ln(3);
		
		$this->Cell(80);
		$this->SetFont('Arial','',8);
		$this->Cell(70,5,'on his/her name.', 0, 0, 'L');		
		$this->Cell(15,5,'JEV No.', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'       ', 0, 0, 'R');
		$this->Ln(5);

		$this->Cell(150);
		$this->SetFont('Arial','',8);
		$this->Cell(15,5,'Date', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'       ', 0, 0, 'R');
		$this->Ln(5);
		
		$this->SetFont('Arial','B',9);
		$this->setSignatory("Accountant");
		$this->Cell(60, 5, strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Cell(25);
		$this->setSignatory("Cashier");
		$this->Cell(50, 5, strtoupper($this->strSgntryName), 0, 0, 'L');
		$this->Cell(0, 5, 'Date', 0, 0, 'L');
		$this->Ln(4);
		
		$this->SetFont('Arial','B',9);
		$this->setSignatory("Accountant");
		$this->Cell(60, 5, $this->strSgntryTitle, 0, 0, 'C');
		$this->Cell(35);
		$this->setSignatory("Cashier");
		$this->Cell(50, 5, $this->strSgntryTitle, 0, 0, 'L');
		
		$this->Ln(7);
	}
	
	
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
	
	function setGrandTotal($t_curRAGrandTotal, $t_curTAGrandTotal, $t_curRATAGrandTotal)
	{
		$this->blnGrandTotal = 1;
		$this->curRAGrandTotal = $t_curRAGrandTotal;
		$this->curTAGrandTotal = $t_curTAGrandTotal;
		$this->curRATAGrandTotal = $t_curRATAGrandTotal;
	}
	
	function setMonthYear($t_strMonthName, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
	}
	
	function setPageTotal($t_curRAPageTotal, $t_curTAPageTotal, $t_curRATAPageTotal)
	{
		$this->curRAPageTotal = $t_curRAPageTotal;
		$this->curTAPageTotal = $t_curTAPageTotal;
		$this->curRATAPageTotal = $t_curRATAPageTotal;				
	}
	
	function setWorkDays($t_intWorkDays)
	{
		$this->intWorkDays = $t_intWorkDays;
	}	
}
?>