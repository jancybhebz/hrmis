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

class ReportProject extends FPDF
{
	var $strMonthName,$intPeriod, $intYear;
	var $strProjectName;
	var $curTotalDeductions;
	var $strSgntryName, $strSgntryTitle;
	var $intWorkDays;
	

	//Page header
	function Header()
	{	
		$this->SetFont('Arial','B',11);
		$this->Cell(0, 5, 'Republic of the Philippines', 0, 0, 'C');
		$this->Ln(5);
		$this->Cell(0, 5, 'Science and Technology Information Institue', 0, 0, 'C');
		$this->Ln(5);
		$this->Cell(0, 5, 'Bicutan Taguig, Metro Manila', 0, 0, 'C');
		$this->Ln(7);
		$this->SetFont('Arial','B',12);
		$this->Cell(0,5,'PROJECT TOTALS for REGULAR EMPLOYEES', 0, 0, 'C');
		$this->Ln(7);
		$this->SetFont('Arial','',12);
		$this->Cell(0,2,'Pay Period for '.$this->strMonthName.' '.$this->intPeriod.' ,  '.$this->intYear, 0, 0, 'C');		
		$this->Ln(5);
		
		$this->SetFont('Arial','',11);
		$this->Cell(25,2,'Project Name: ', 0, 0, 'L');
		$this->SetFont('Arial','B',11);		
		$this->Cell(0,2,$this->strProjectName, 0, 0, 'L');
		$this->Ln(7);
		
		$this->SetFont('Arial','B',11);
		$this->SetFillColor(200,200,200);
		$this->Cell(40);
		$this->Cell(130,5,'PAYROLL DETAILS', 0, 0, 'C',1);
		$this->Cell(10);		
		$this->Cell(120,5,'DEDUCTIONS DETAILS', 0, 0, 'C',1);
		$this->Ln(7);				
	}
	
	//Page footer
	function Footer()
	{
		$this->SetY(-55);
		
		$this->Cell(170);
		$this->Cell(10);
		$this->SetFont('Arial','B',10);				
		$this->Cell(70,5,'Total Deductions', 0, 0, 'R');
		$this->Cell(10);
		$this->SetFillColor(200,200,200);		
		$this->Cell(40,5,number_format($this->curTotalDeductAmountperiod, 2, '.',','), 0, 0, 'R', 1);
		$this->Ln(5);
		
//		$this->objRprt->Cell(40);
//		$this->SetFont('Arial','U',10);
//		$this->objRprt->Cell(100,5,'                         ', 0, 0, 'L');
//		$this->objRprt->Cell(30,5,'92, 055.00', 0, 0, 'R');
					
		$this->Ln(10);
		$this->SetFont('Arial','',11);
		$this->Cell(75, 5, 'Certified correct:', 0, 0, 'L');
		$this->Cell(75, 5, 'Certified funds available:', 0, 0, 'L');
		$this->Cell(75, 5, 'Approved for payment:', 0, 0, 'L');
		$this->Cell(75, 5, 'Prepared by:', 0, 0, 'L');
				
		$this->Ln(15);
		$this->SetFont('Arial','B',11);
		$this->setSignatory("Personnel");
		$this->Cell(75, 5,strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->setSignatory("Accountant");
		$this->Cell(75, 5,strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->setSignatory("Director");
		$this->Cell(75, 5,strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->setSignatory("Cashier");
		$this->Cell(75, 5,strtoupper($this->strSgntryName), 0, 0, 'C');								
		
		$this->Ln(5);
		$this->SetFont('Arial','B',11);
		$this->setSignatory("Personnel");
		$this->Cell(75, 5,$this->strSgntryTitle, 0, 0, 'C');
		$this->setSignatory("Accountant");
		$this->Cell(75, 5,$this->strSgntryTitle, 0, 0, 'C');
		$this->setSignatory("Director");
		$this->Cell(75, 5,$this->strSgntryTitle, 0, 0, 'C');
		$this->setSignatory("Cashier");
		$this->Cell(75, 5,$this->strSgntryTitle, 0, 0, 'C');		
	}
	
	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
	}

	function setMonthYear($t_strMonthName, $t_intYear,$t_intPeriod)
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
	
	function setProjectName($t_strProjectName)
	{
		$this->strProjectName = $t_strProjectName;	
	}
	
	
	function setWorkDays($t_intWorkDays)
	{
		$this->intWorkDays = $t_intWorkDays;
	}
	
	function setProjectTotal($t_curTotalDeductAmountperiod)
	{
		$this->curTotalDeductAmountperiod = $t_curTotalDeductAmountperiod;
		
	}
	

	
}
?>