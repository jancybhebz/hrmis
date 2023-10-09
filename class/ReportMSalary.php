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

class ReportMSalary extends FPDF
{
	var $intPageNo;
	var $blnGrandTotal = 0;
	var $strMonthName, $intYear;
	var $strSgntryName, $strSgntryTitle;
	var $intMSGrandTotal;
	var $curMSPageTotal;
	var $agencyName, $agencyAdd, $agencyNum;
	
	
	//Page header
	function Header()
	{	
		$this->SetFont('Arial','B',10);
		$this->Cell(0,4,'Republic of the Philippines', 0, 1, 'C');
		$this->Cell(0,4,$this->agencyName, 0, 1, 'C');
		$this->Cell(0,4,$this->agencyAdd, 0, 1, 'C');
		$this->Ln(5);	
		
		$this->SetFont('Arial','',11);
		$this->Cell(0,5,'PAYROLL REGISTER FOR MONTHLY SALARY', 0, 1, 'C');
		$this->Ln(1);
		$this->Cell(0,5,'For REGULAR Employees', 0, 1, 'C');
		$this->Ln(1);
		$this->Cell(0,5,'For the month of '.$this->strMonthName.' '.$this->intYear, 0, 1, 'C');
		$this->Ln(5);
		
		$this->intPageNo = $this->PageNo();

		$this->SetFont('Arial','',9);
		$this->Cell(0,5,'Sheet '.$this->intPageNo.' of {nb}', 0, 1, 'R');

		$this->Ln(3);								
		$this->SetFont('Arial','B',9);
		$this->SetFillColor(200,200,200);
		$this->Cell(15,5,'#', 0, 0, 'L',1);
		$this->Cell(60,5,'EMPLOYEE NAME', 0, 0, 'L',1);
		$this->Cell(0,5,'AMOUNT', 0, 0, 'R',1);

		$this->Ln(7);
	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-70);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',9);
		$this->Cell(130,5,'Page Total:', 0, 0, 'R',1);
		$this->Cell(0,5,number_format($this->curMSPageTotal, 2,".",","), 0, 1, 'R',1);
		
		$this->SetFillColor(150,150,150);
		$this->SetFont('Arial','B',9);
		$this->Cell(130,5,'Grand Total:', 0, 0, 'R',1);
		$this->Cell(0,5,number_format($this->intMSGrandTotal, 2,".",","), 0, 0, 'R',1);
		$this->Ln(10);

		$this->SetFont('Arial','',10);
		$this->Cell(100, 5, 'Prepared by:', 0, 0, 'L');		
		$this->Cell(0, 5, 'Certified correct:', 0, 1, 'L');
		$this->Ln(10);
		
		
		$this->SetFont('Arial','B',9);
		$this->setSignatory("Accountant");
		$this->Cell(70, 5,strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Cell(30);
		$this->setSignatory("Cashier");
		$this->Cell(0, 5,strtoupper($this->strSgntryName), 0, 1, 'C');

		$this->SetFont('Arial','B',9);
		$this->setSignatory("Accountant");
		$this->Cell(70, 5,$this->strSgntryTitle, 0, 0, 'C');
		$this->Cell(30);
		$this->setSignatory("Cashier");
		$this->Cell(0, 5,$this->strSgntryTitle, 0, 1, 'C');
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
	
		
	function setGrandTotal($t_intMSGrandTotal)
	{
		$this->blnGrandTotal = 1;
		$this->intMSGrandTotal = $t_intMSGrandTotal;
		
	}
	
	function setMonthYear($t_strMonthName, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
	}
	
/*	function setDivisionName($t_strDivisionName, $t_strProjectName )
	{
		$this->strDivisionName = $t_strDivisionName;
		$this->strProjectName  = $t_strProjectName;
	}*/
	
	function setPageTotal($t_curMSPageTotal)
	{
		$this->curMSPageTotal = $t_curMSPageTotal;
	}

}
?>