<?
/* 
File Name: ReportHeaderFooterAAR.php 
----------------------------------------------------------------------
Purpose of this file: 
Header Footer of Attendance Accumulated Report
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

class ReportHeaderFooterAAR extends FPDF
{
	var $strAgency, $strAddress;
	var $strPeriod, $intYear;
	var $strType, $strTypeName;
	var $strSignatory, $strSignatoryTitle;
	//Page header
	function Header()
	{
		$this->SetFont('Arial','B',10);
		$this->Cell(0,4,'Republic of the Philippines', 0, 1, 'C');
		$this->Cell(0,4,$this->strAgency, 0, 1, 'C');
		$this->Cell(0,4,$this->strAddress, 0, 1, 'C');
		$this->Ln(5);	
		$this->SetFont('Arial','',11);
		$this->Cell(0,5,'ATTENDANCE AND ACCUMULATED REPORT', 0, 1, 'C');
		$this->Ln(1);
		$this->intPageNo = $this->PageNo();
		$this->SetFont('Arial','',9);
		$this->Cell(0,5,'Page '.$this->intPageNo.' of {nb}', 0, 1, 'R');		
		$this->Ln(3);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,5,'Subject: Report of Attendance and Accumulated Leave Credits for the month of '.$this->strPeriod." ".$this->intYear, 0, 1, 'C');
		
		$this->SetFont('Arial','',9);
		$strPrg = "The records of Human Resource Management Unit show that for the months of ".$this->strPeriod." ".$this->intYear.
					", the division's staff had incurred tardiness/undertimes/half-days/absences and credited in their favor ".
					"the accumulated vacation leave and sick leave as follows;";
		$this->MultiCell(0,4,$strPrg, 0, "J");
		$this->Ln(2);
		
		$this->SetFont('Arial','B',10);
		$this->Cell(0,5,$this->strType." ".$this->strTypeName, 0, 1, 'L');
		$this->Ln(2);
						
		$this->SetFont('Arial','B',9);
		$this->SetFillColor(200,200,200);
		$this->Cell(50,5,'', 1, 0, 'L',1);
		for($intCtr = 0; $intCtr < 3; $intCtr++)
		{
			$this->Cell(90,5,$this->arrMonth[$intCtr], 1, 0, 'C',1);
		}
		$this->Ln(5);
		
		$this->Cell(50,5,'', 1, 0, 'C',1);
		for($intCtr = 0; $intCtr < 3; $intCtr++)
		{
			$this->Cell(30,5,'# of Days', 1, 0, 'C',1);
			$this->Cell(20,5,'# of Abs', 1, 0, 'C',1);
			$this->Cell(40,5,'Leave Credits', 1, 0, 'C',1);
		}		
		$this->Ln(5);
		
		$this->Cell(50,5,'EMPLOYEE NAME', 1, 0, 'C',1);
		for($intCtr = 0; $intCtr < 3; $intCtr++)
		{
			$this->Cell(20,5,'TR/UT', 1, 0, 'C',1);
			$this->Cell(10,5,'HD', 1, 0, 'C',1);
			$this->Cell(10,5,'VL', 1, 0, 'C',1);
			$this->Cell(10,5,'SL', 1, 0, 'C',1);
			$this->Cell(20,5,'VL', 1, 0, 'C',1);
			$this->Cell(20,5,'SL', 1, 0, 'C',1);
		}		
		$this->Ln(5);
	}
	
	//Page footer
	function Footer()
	{
		$this->SetXY( -15, -35);
			
		$this->Ln(4);
		$this->SetFont('Arial','B',10);
		$this->Cell(0, 5, 'CERTIFIED CORRECT', 0, 0, 'C');

		$this->Ln(10);
		$this->SetFont('Arial','',10);
		$this->Cell(175, 5, date("l, F d, Y"), 0, 0, 'C');
		$this->SetFont('Arial','B',10);
		$this->Cell(150, 5, strtoupper($this->strSignatory), 0, 0, 'C');

		$this->Ln(5);
		$this->SetFont('Arial','',10);
		$this->Cell(175, 5, 'Date', 0, 0, 'C');
		$this->Cell(150, 5, $this->strSignatoryTitle, 0, 0, 'C');
	}
	
	function setHeader($t_strAgency, $t_strAddress, $t_strPeriod, $t_intYear, $t_strType, $t_strTypeName)
	{
		$this->strAgency = $t_strAgency;
		$this->strAddress = $t_strAddress;
		$this->intYear = $t_intYear;
		$this->strType = $t_strType;
		$this->strTypeName = $t_strTypeName;

		if($t_strPeriod == 1)
		{
			$this->strPeriod = "January to March";
			$this->arrMonth = array(0=>"JANUARY", 1=>"FEBRUARY", 2=>"MARCH");
		}
		elseif($t_strPeriod == 2)
		{
			$this->strPeriod = "April to June";
			$this->arrMonth = array(0=>"APRIL", 1=>"MAY", 2=>"JUNE");
		}
		elseif($t_strPeriod == 3)
		{
			$this->strPeriod = "July to August";
			$this->arrMonth = array(0=>"JULY", 1=>"AUGUST", 2=>"SEPTEMBER");
		}
		elseif($t_strPeriod == 4)
		{
			$this->strPeriod = "September to December";
			$this->arrMonth = array(0=>"OCTOBER", 1=>"NOVEMBER", 2=>"DECEMBER");
		}

	}
	
	function setFooter($t_strSignatory, $t_strSignatoryTitle)
	{
		$this->strSignatory = $t_strSignatory;
		$this->strSignatoryTitle = $t_strSignatoryTitle;
	}
}
?>