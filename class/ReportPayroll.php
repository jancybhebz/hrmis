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

class ReportPayroll extends FPDF
{
	var $intPageNo;
	var $blnGrandTotal = 0;
	var $strMonthName, $intMonth, $intYear, $intPeriod;
	var $strDivisionName, $strProjectName;
	var $curPageTotal, $curEPPageTotal, $curPageDTotal, $curPageNPTotal;
	var $intPageMSGrandTotal, $intPageEPGrandTotal, $intPageDGrandTotal, $intPageNPGrandTotal;
	var $intHPayGrandTotal;
	var $intWorkDays;
	var $strSgntryName, $strSgntryTitle;

	//Page header
	function Header()
	{	
		$this->SetFont('Arial','B',14);
		$this->Cell(0,0,'GENERAL REGISTER for REGULAR EMPLOYEES', 0, 0, 'C');
		$this->Ln(7);
		$this->SetFont('Arial','B',12);
		$this->Cell(0,0,'Science and Technology Information Institue', 0, 0, 'C');
		$this->Ln(5);
		$this->SetFont('Arial','',12);
		$this->Cell(0,2,'Pay Period for '.$this->strMonthName.' '.$this->intPeriod.' '.$this->intYear, 0, 0, 'C');		
		$this->Ln(5);
		
		$this->SetFont('Arial','',11);
		$this->Cell(25,2,'Project Name: ', 0, 0, 'L');
		$this->SetFont('Arial','B',11);
		$this->Cell(240,2,' '.$this->strProjectName, 0, 0, 'L');
		$this->SetFont('Arial','',11);
		$this->Cell(6,2,'No.', 0, 0, 'L');
		$this->SetFont('Arial','U',10);		
		$this->Cell(19,2,'                           ', 0, 0, 'L');
		$this->Ln(5);

		$this->SetFont('Arial','',11);
		$this->Cell(25,2,'Divsion Name: ', 0, 0, 'L');
		$this->SetFont('Arial','B',11);
		$this->Cell(240,2," ".$this->strDivisionName, 0, 0, 'L');

		$this->intPageNo = $this->PageNo();
		$this->SetFont('Arial','',11);
		
		$this->Cell(35,2,'Sheet '.$this->intPageNo.' to {nb} Sheets', 0, 0, 'L');
		$this->Ln(5);
		
		$this->SetFont('Arial','',12);
		$this->Cell(0,5,'We acknowledge receipt of cash shown opposite our name as full compensation for services rendered for the period covered', 0, 0, 'L');
		$this->Ln(10);
				
		$this->SetFont('Arial','',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(10,5,'No.', 0, 0, 'L',1);
		$this->Cell(70,5,'EMPLOYEE NAME', 0, 0, 'L',1);
		$this->Cell(40,5,'POSITION', 0, 0, 'L',1);
		$this->Cell(40,5,'EMP No.', 0, 0, 'L',1);
		$this->Cell(40,5,'MONTHLY SALARY', 0, 0, 'C',1);
		$this->Cell(40,5,'EARNED FOR PERIOD', 0, 0, 'C',1);
		$this->Cell(40,5,'TOTAL DEDUCTION', 0, 0, 'C',1);
		$this->Cell(30,5,'NET PAY', 0, 0, 'C',1);
		$this->Ln(7);
	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-85);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',9);
		$this->Cell(160,5,'Page Total', 0, 0, 'R',1);
		$this->Cell(40,5,number_format($this->curPageTotal, 2,".",","), 0, 0, 'R',1);
		$this->Cell(40,5,number_format($this->curEPPageTotal, 2,".",","), 0, 0, 'R',1);
		$this->Cell(40,5,number_format($this->curPageDTotal, 2,".",","), 0, 0, 'R',1);
		$this->Cell(30,5,number_format($this->curPageNPTotal, 2,".",","), 0, 1, 'R',1);

		if($this->blnGrandTotal)
		{
			$this->SetFillColor(150,150,150);
			$this->SetFont('Arial','B',9);
			$this->Cell(160,5,'Project Total', 0, 0, 'R',1);
			$this->Cell(40,5,number_format($this->intPageMSGrandTotal, 2,".",","), 0, 0, 'R',1);
			$this->Cell(40,5,number_format($this->intPageEPGrandTotal, 2,".",","), 0, 0, 'R',1);
			$this->Cell(40,5,number_format($this->intPageDGrandTotal, 2,".",","), 0, 0, 'R',1);
			$this->Cell(30,5,number_format($this->intPageNPGrandTotal, 2,".",","), 0, 0, 'R',1);		
		}
		$this->Ln(10);
			
		$this->SetFont('Arial','',11);
		$this->Cell(130,5,'CERTIFIED: Service duty rendered as stated.:', 0, 0, 'L');
		$this->Cell(40,5,'Approved for payment:', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'                                                                                                                                ', 0, 0, 'L');
		$this->Ln(7);

		$this->SetFont('Arial','U',11);
		$this->Cell(130);
		$this->Cell(0,5,'                                                                     (P                                                ', 0, 0, 'L');
		$this->Ln(10);

		$this->setSignatory("Personnel");
		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		$this->Cell(70, 5, strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Cell(50);
		$this->setSignatory("Director");		
		$this->Cell(70, 5, strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Ln(4);

		$this->Cell(30);
		$this->setSignatory("Personnel");
		$this->Cell(70, 5, $this->strSgntryTitle, 0, 0, 'C');
		$this->Cell(50);
		$this->Cell(70, 5, $this->strSgntryTitle, 0, 0, 'C');
		$this->Ln(7);

		$this->SetFont('Arial','',11);
		$this->Cell(130,5,'CERTIFIED: Supporting documents complete and proper and cash', 0, 0, 'L');
		$this->Cell(120,5,'CERTIFIED: Each employee whose name appears above has been', 0, 0, 'L');
		$this->Cell(20,5,'ALOBS No.', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'                                    ', 0, 0, 'L');
		$this->Ln(5);

		$this->SetFont('Arial','',11);
		$this->Cell(50,5,'available in the amount of P', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(50,5,'                                              ', 0, 0, 'L');
		$this->SetFont('Arial','',11);
		$this->Cell(30,5,'.:', 0, 0, 'L');
		$this->Cell(120,5,'paid the amount indicated opposite on his/her name.', 0, 0, 'L');
		$this->Cell(20,5,'Date', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'                                    ', 0, 0, 'L');
		$this->Ln(5);
		
		$this->Cell(250);
		$this->SetFont('Arial','',11);
		$this->Cell(20,5,'JEV No.', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'                                    ', 0, 0, 'L');
		$this->Ln(5);

		$this->Cell(200);
		$this->SetFont('Arial','U',11);
		$this->Cell(30,5,'                              ', 0, 0, 'L');
		$this->Cell(20);
		$this->SetFont('Arial','',11);
		$this->Cell(20,5,'Date', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'                                    ', 0, 0, 'L');
		$this->Ln(5);
		
		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		$this->setSignatory("Accountant");		
		$this->Cell(70, 5, strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Cell(30);
		$this->setSignatory("Cashier");
		$this->Cell(70, 5, strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Cell(30, 5, 'Date', 0, 0, 'C');
		$this->Ln(4);
		
		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		$this->setSignatory("Accountant");
		$this->Cell(70, 5, $this->strSgntryTitle, 0, 0, 'C');
		$this->Cell(30);
		$this->setSignatory("Cashier");
		$this->Cell(70, 5, $this->strSgntryTitle, 0, 0, 'C');
		
		$this->Ln(7);
	}

	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
	}

	function setGrandTotal($t_intPageMSGrandTotal, $t_intPageEPGrandTotal, $t_intPageDGrandTotal, $t_intPageNPGrandTotal)
	{
		$this->blnGrandTotal = 1;
		$this->intPageMSGrandTotal = $t_intPageMSGrandTotal;
		$this->intPageEPGrandTotal = $t_intPageEPGrandTotal;
		$this->intPageDGrandTotal = $t_intPageDGrandTotal;
		$this->intPageNPGrandTotal = $t_intPageNPGrandTotal;
	}
	
	function setMonthYear($t_strMonthName, $t_intYear, $t_intPeriod)
	{
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
		if($t_intPeriod == 1)
		{
			$this->intPeriod = "1 - 15"; 
		}
		else if($t_intPeriod == 2)
		{
			$this->intPeriod = "15 - ".$this->intWorkDays;
		}
	}
	
	function setDivisionName($t_strDivisionName, $t_strProjectName)
	{
		$this->strDivisionName = $t_strDivisionName;
		$this->strProjectName = $t_strProjectName;
		
	}
	
	function setPageTotal($t_curPageTotal, $t_PageEPTotal, $t_intPageDTotal, $t_intPageNPTotal)
	{
		$this->curPageTotal = $t_curPageTotal;
		$this->curEPPageTotal = $t_PageEPTotal;
		$this->curPageDTotal = $t_intPageDTotal;
		$this->curPageNPTotal = $t_intPageNPTotal;		
	}
	
	function setWorkDays($t_intWorkDays)
	{
		$this->intWorkDays = $t_intWorkDays;
	}
	
}
?>