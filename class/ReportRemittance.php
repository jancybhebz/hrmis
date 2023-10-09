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

class ReportRemittance extends FPDF
{
	var $strTitle;
	var $intPageNo;
	var $blnGrandTotal = 0;
	var $strMonthName, $intYear;
	var $curPageTotal, $curPageGrandTotal;
	var $strSgntryName, $strSgntryTitle;
	
	//Page header
	function ReportRemittance()
	{
		$this->FPDF('P', 'mm', 'A4');
	}
	function Header()
	{	
		$this->SetFont('Arial','B',11);
		$this->Cell(0, 5, 'Republic of the Philippines', 0, 0, 'C');
		$this->Ln(5);
		$this->Cell(0, 5, 'Science and Technology Information Institue', 0, 0, 'C');
		$this->Ln(5);
		$this->Cell(0, 5, 'Bicutan Taguig, Metro Manila', 0, 0, 'C');
		$this->Ln(10);
		$this->SetFont('Arial','B',12);
		$this->Cell(0,5,'REMITTANCE FOR '.$this->strTitle, 0, 0, 'C');
		$this->Ln(7);
		$this->SetFont('Arial','',12);
		$this->Cell(0,2,'For the month of '.$this->strMonthName.' '.$this->intYear, 0, 0, 'C');		
		$this->Ln(5);

		$this->intPageNo = $this->PageNo();
		
		$this->SetFont('Arial','',9);
		$this->Cell(0,5,'Sheet '.$this->intPageNo.' of {nb}', 0, 1, 'R');
		$this->Ln(7);
				
		$this->SetFont('Arial','B',9);
		$this->SetFillColor(200,200,200);
		$this->Cell(10,5,'#', 0, 0, 'L',1);
		$this->Cell(120,5,'Employee Name', 0, 0, 'L',1);
		$this->Cell(0,5,'Amount', 0, 0, 'R',1);
		$this->Ln(7);		
	}
	
	//Page footer
	function Footer()
	{
		$this->SetY(-55);		
		$this->SetFont('Arial','B',9);
		$this->SetFillColor(200,200,200);
		$this->Cell(110,5,'Page Total:', 0, 0, 'R',1);
		$this->Cell(0,5, number_format($this->curPageTotal, 2,".",","), 0, 1, 'R', 1);

		if($this->blnGrandTotal)
		{
			$this->SetFillColor(150,150,150);
			$this->Cell(110,5,'Grand Total:', 0, 0, 'R',1);
			$this->Cell(0,5, number_format($this->curPageGrandTotal, 2,".",","), 0, 1, 'R', 1);
		}

					
		$this->Ln(5);
		$this->SetFont('Arial','',10);
		$this->Cell(130, 5, 'Certified correct:', 0, 1, 'R');
		$this->Ln(10);
		$this->Cell(110);
		$this->setSignatory("Accountant");
		$this->Cell(0, 5, strtoupper($this->strSgntryName), 0, 1, 'C');
		$this->Cell(110);		
		$this->Cell(0, 5, $this->strSgntryTitle, 0, 0, 'C');
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
	
	function setGrandTotal($t_intPageGrandTotal)
	{
		$this->blnGrandTotal = 1;
		$this->curPageGrandTotal = $t_intPageGrandTotal;
	}
	
	function setMonthYear($t_strMonthName, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
	}
		
	function setPageTotal($t_curPageTotal)
	{
		$this->curPageTotal = $t_curPageTotal;
	}
}
?>