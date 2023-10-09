<?
/* 
File Name: ReportHeaderFooterMCR.php 
----------------------------------------------------------------------
Purpose of this file: 
Header footer of magna carte report
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 15, 2004
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


//define('FPDF_FONTPATH','../hrmis/class/font/');
//require('../hrmis/class/fpdf.php');

class ReportHeaderFooterMCR extends FPDF
{
	var $strAgency, $strAddress;
	var $strMonth, $intYear;
	var $strType, $strTypeName;
	var $strSignatory, $strSignatoryTitle;
	//Page header
	function Header()
	{
		$this->Ln(10);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,4,'Republic of the Philippines', 0, 1, 'C');
		$this->Cell(0,4,$this->strAgency, 0, 1, 'C');
		$this->Cell(0,4,$this->strAddress, 0, 1, 'C');
		$this->Ln(5);	
		$this->SetFont('Arial','',11);
		$this->Cell(0,5,'MAGNA CARTE ATTENDANCE SHEET', 0, 1, 'C');
		$this->Ln(1);
		$this->Cell(0,5,'For the month of '.$this->strMonth.' '.$this->intYear, 0, 1, 'C');
		$this->Ln(5);
		
		$this->intPageNo = $this->PageNo();
		
		$this->SetFont('Arial','',9);
		$this->Cell(0,5,'Page '.$this->intPageNo.' of {nb}', 0, 1, 'R');		
		
		$this->SetFont('Arial','B',10);
		$this->Cell(0,5,$this->strType." ".$this->strTypeName, 0, 1, 'L');
		$this->Ln(5);

		$this->SetFont('Arial','B',9);
		$this->SetFillColor(200,200,200);
		$this->Cell(45,5,'', 0, 0, 'C',1);
		$this->Cell(60,5,'# OF LEAVE', 0, 0, 'C',1);
		$this->Cell(75,5,'ON TRIP', 0, 1, 'C',1);

		$this->Cell(45,5,'EMPLOYEE NAME', 0, 0, 'C',1);
		$this->Cell(30,5,'HALF DAY', 0, 0, 'C',1);
		$this->Cell(30,5,'WHOLE DAY', 0, 0, 'C',1);
		$this->Cell(25,5,'PER DIEM', 0, 0, 'C',1);
		$this->Cell(25,5,'NOT PER DIEM', 0, 0, 'C',1);
		$this->Cell(25,5,'TOTAL', 0, 0, 'C',1);
		$this->Ln(7);
	}
	
	//Page footer
	function Footer()
	{
		$this->SetXY( -15, -70);
		$intY = $this->GetY();
		$intX = $this->GetX();		
		//draw a line
		$this->SetLineWidth(0.5);				
		$this->Line(15, $intY, $intX, $intY);
			
		$this->Ln(10);
		$this->SetFont('Arial','B',10);
		$this->Cell(0, 5, 'CERTIFIED CORRECT', 0, 0, 'C');

		$this->Ln(20);
		$this->SetFont('Arial','',10);
		$this->Cell(90, 5, date("l, F d, Y"), 0, 0, 'C');
		$this->SetFont('Arial','B',10);
		$this->Cell(90, 5, strtoupper($this->strSignatory), 0, 0, 'C');

		$this->Ln(5);
		$this->SetFont('Arial','',10);
		$this->Cell(90, 5, 'Date', 0, 0, 'C');
		$this->Cell(90, 5, $this->strSignatoryTitle, 0, 0, 'C');
	}
	
	function setHeader($t_strAgency, $t_strAddress, $t_strMonth, $t_intYear, $t_strType, $t_strTypeName)
	{
		$this->strAgency = $t_strAgency;
		$this->strAddress = $t_strAddress;
		$this->strMonth = $t_strMonth;
		$this->intYear = $t_intYear;
		$this->strType = $t_strType;
		$this->strTypeName = $t_strTypeName;
	}
	
	function setFooter($t_strSignatory, $t_strSignatoryTitle)
	{
		$this->strSignatory = $t_strSignatory;
		$this->strSignatoryTitle = $t_strSignatoryTitle;
	}
}
?>