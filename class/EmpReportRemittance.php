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
session_start();
define('FPDF_FONTPATH','../hrmis/class/font/');
require_once('../hrmis/class/fpdf.php');

class EmpReportRemittance extends FPDF
{
	var $strTitle;
	var $intPageNo;
	var $blnGrandTotal = 0;
	var $strMonthName, $intYear;
	var $curPageTotal, $curPageGrandTotal;
	var $strSgntryName, $strSgntryTitle;
	
	//Page header
	function EmpReportRemittance()
	{
		$this->FPDF('P', 'mm', 'A4');
	}
	function Header()
	{	
		$this->SetFont('Arial','B',12);
		$this->Cell(0,5,'REMITTANCE FOR '.$this->strTitle, 0, 1, 'C');
		$this->Ln(10);
		
		$this->intPageNo = $this->PageNo();
		
		$this->SetFont('Arial','',9);
		$this->Cell(0,5,'Page '.$this->intPageNo.' of {nb}', 0, 1, 'R');
		$this->Ln(7);
		
		$this->SetFont('Arial','',11);
		$this->Cell(40,2,'Office Name    :', 0, 0, 'L');
		$this->SetFont('Arial','UB',11);
		$this->Cell(150,2,'SCIENCE AND TECHNOLOGY INFORMATION INSTITUTE', 0, 0, 'L');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Cell(40,2,'Office Address  :', 0, 0, 'L');
		$this->SetFont('Arial','UB',11);		
		$this->Cell(150,2,'DOST Compound, Gen. Santos Ave., Bicutan, Taguig, Metro Manila', 0, 0, 'L');		
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Cell(40,2,'Office Tel. No.  :', 0, 0, 'L');
		$this->SetFont('Arial','UB',11);		
		$this->Cell(150,2,'837-2191', 0, 0, 'L');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Cell(40,2,'Employee Name   :', 0, 0, 'L');
		$this->SetFont('Arial','B',12);		
		$this->Cell(150,2,strtoupper($this->strEmpName), 0, 0, 'L');
		$this->Ln(15);
		
		
		
		$this->SetFont('Arial','B',13);
		$this->Cell(40,2,'Month', 0, 0, 'L');
		$this->Cell(40,2,'Year', 0, 0, 'L');
		$this->Cell(40,2,'OR No.', 0, 0, 'L');
		$this->Cell(40,2,'  OR Date', 0, 0, 'L');
		$this->Cell(40,2,'Amount', 0, 0, 'L');
		$this->Ln(3);
		$this->Cell(200,2,'_______________________________________________________________________', 0, 0, 'L');
		$this->Ln(5);
		
		
				
			
	}
	
	//Page footer
	function Footer()
	{
		$this->SetY(-75);		
		$this->SetFont('Arial','B',11);
		$this->SetFillColor(200,200,200);
		$this->Cell(40,5," ", 0, 0, 'L',1);
		$this->Cell(40,5," ", 0, 0, 'L',1);
		$this->Cell(10,5," ", 0, 0, 'L',1);
		$this->Cell(65,5,'Page Total:', 0, 0, 'L',1);
		$this->Cell(20,5,number_format($this->curPageTotal, 2,".",","), 0, 1, 'R',1);
		

		if($this->blnGrandTotal)
		{
			$this->SetFillColor(150,150,150);
			$this->Cell(40,5," ", 0, 0, 'L',1);
			$this->Cell(40,5," ", 0, 0, 'L',1);
			$this->Cell(10,5," ", 0, 0, 'L',1);
			$this->Cell(65,5,'Grand Total:', 0, 0, 'L',1);
			$this->Cell(20,5, number_format($this->curGrandTotal, 2,".",","), 0, 0, 'R',1);
		
		}

					
		$this->Ln(10);
		$this->SetFont('Arial','',10);
		$this->Cell(130, 5, 'Certified correct:', 0, 1, 'R');
		$this->Ln(10);
		$this->Cell(110);
		$this->setSignatory("Accountant");
		$this->Cell(0, 5, strtoupper($this->strSgntryName), 0, 1, 'C');
		$this->Cell(110);		
		$this->Cell(0, 5, $this->strSgntryTitle, 0, 0, 'C');
	}
	
	function setYear($t_intYear)
	{
		$this->strYear = $t_intYear; 
	
	}
	
	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
	}
	
	function setReportTitle($t_strTitle)
	{
		$this->strTitle = $t_strTitle;
	}
	
	function setEmpName($t_empName)
	{
		$this->strEmpName = $t_empName;
	}
	
	function setGrandTotal($t_intEmpGrandTotal)
	{
		$this->blnGrandTotal = 1;
		$this->curGrandTotal = $t_intEmpGrandTotal;
	}
	
	
		
	function setPageTotal($t_intEmpYearTotal)
	{
		$this->curPageTotal = $t_intEmpYearTotal;
	}
}
?>