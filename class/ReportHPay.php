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

class ReportHPay extends FPDF
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
		$this->Cell(0,5,'PAYROLL REGISTER FOR HAZARD PAY', 0, 1, 'C');
		$this->Ln(1);
		$this->Cell(0,5,'For REGULAR Employees - '.$this->intWorkDays.' Working Days', 0, 1, 'C');
		$this->Ln(1);
		$this->Cell(0,5,'For the month of '.$this->strMonthName.' '.$this->intYear, 0, 1, 'C');
		$this->Ln(5);
		
		$this->intPageNo = $this->PageNo();
		
		$this->SetFont('Arial','',9);
		$this->Cell(0,5,'Sheet '.$this->intPageNo.' of {nb}', 0, 1, 'R');		
		$this->SetFont('Arial','',9);
		$this->Cell(25,2,'Project Name: ', 0, 0, 'L');
		$this->SetFont('Arial','B',9);
		$this->Cell(0,2,' AI.A.1', 0, 0, 'L');
		$this->Ln(5);

		$this->SetFont('Arial','',9);
		$this->Cell(25,2,'Divsion Name: ', 0, 0, 'L');
		$this->SetFont('Arial','B',9);
		$this->Cell(0,2,$this->strDivisionName, 0, 0, 'L');
		$this->Ln(7);
						
		$this->SetFont('Arial','B',9);
		$this->SetFillColor(200,200,200);
		$this->Cell(50,5,'EMPLOYEE NAME', 0, 0, 'L',1);
		$this->Cell(40,5,'MONTHLY SALARY', 0, 0, 'C',1);
		$this->Cell(20,5,'ABSENCE', 0, 0, 'C',1);
		$this->Cell(30,5,'HAZARD PAY', 0, 0, 'C',1);
		$this->Cell(40,5,'SIGNATURE', 0, 0, 'C',1);		
		$this->Ln(7);
	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-90);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',9);
		$this->Cell(50,5,'Page Total', 0, 0, 'R',1);
		$this->Cell(27,5,number_format($this->curPageTotal, 2,".",","), 0, 0, 'R',1);		
		$this->Cell(26,5,'', 0, 0, 'R',1);
		$this->Cell(25,5,number_format($this->curHPayPageTotal, 2,".",","), 0, 0, 'R',1);
		$this->Cell(0, 5, '', 0, 1, 'R', 1);
		
		if($this->blnGrandTotal)
		{
			$this->SetFillColor(150,150,150);
			$this->SetFont('Arial','B',9);
			$this->Cell(50,5,'Grand Total', 0, 0, 'R',1);
			$this->Cell(27,5,number_format($this->intGrandTotal, 2,".",","), 0, 0, 'R',1);		
			$this->Cell(26,5,'', 0, 0, 'R',1);
			$this->Cell(25,5,number_format($this->intHPayGrandTotal, 2,".",","), 0, 0, 'R',1);
			$this->Cell(0, 5, '', 0, 1, 'R', 1);		
		}
		$this->Ln(10);
			
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

		$this->setSignatory("Personnel");
		$this->SetFont('Arial','B',9);
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
	
	function setDivisionName($t_strDivisionName)
	{
		$this->strDivisionName = $t_strDivisionName;
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