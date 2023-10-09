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

class ReportBonus extends FPDF
{
	var $strSgntryName, $strSgntryTitle;
	var $blnGrandTotal = 0;
	var $curMSalaryGrandTotal, $curCGiftGrandTotal, $curHalfBonusGrandTotal, $curHalfCGiftgrandTotal, $curNetGrandTotal;
	var $curMSalaryPageTotal, $curCGiftPageTotal, $curHalfBonusPageTotal, $curHalfCGiftPageTotal, $curNetPageTotal;
	var $strMonthName, $strMonthName;
	var	$strDivisionName, $strProjectName;
	
	//Page header
	function Header()
	{	
		$this->SetFont('Arial','B',10);
		$this->Cell(0,4,'Republic of the Philippines', 0, 1, 'C');
		$this->Cell(0,4,'Science and Technology Information Institue', 0, 1, 'C');
		$this->Cell(0,4,'Bicutan Taguig, Metro Manila', 0, 1, 'C');
		$this->Ln(1);	
		$this->SetFont('Arial','B',12);
		$this->Cell(0,5,'PAYROLL REGISTER FOR HALF BONUS AND HALF CASH GIFT FOR CY  '.$this->intYear, 0, 1, 'C');
		$this->Ln(1);
		$this->Cell(0,5,'For REGULAR Employees', 0, 0, 'C');
		$this->Ln(5);
		$this->Cell(0,5,'Period : '.$this->intPeriod, 0, 0, 'C');
		
		$this->Ln(10);
		
		$this->SetFont('Arial','',11);
		$this->Cell(27,2,'Project Name :', 0, 0, 'L');
		$this->SetFont('Arial','B',11);
		$this->Cell(240,2, $this->strProjectName, 0, 0, 'L');
		$this->SetFont('Arial','',11);
		$this->Cell(6,2,'No.', 0, 0, 'L');
		$this->SetFont('Arial','U',10);		
		$this->Cell(19,2,'                           ', 0, 0, 'L');
		$this->Ln(5);

		$this->intPageNo = $this->PageNo();
		
		$this->SetFont('Arial','',11);
		$this->Cell(27,2,'Division Name :', 0, 0, 'L');
		$this->SetFont('Arial','B',11);
		$this->Cell(240,2, $this->strDivisionName, 0, 0, 'L');
		$this->SetFont('Arial','',11);
		$this->Cell(35,2,'Sheet  '.$this->intPageNo.' of {nb}', 0, 0, 'L');
		$this->Ln(7);
						
		$this->SetFont('Arial','B',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(15,5,'EMP #', 0, 0, 'L',1);
		$this->Cell(50,5,'POSITION', 0, 0, 'L',1);
		$this->Cell(50,5,'EMPLOYEE NAME', 0, 0, 'L',1);
		$this->Cell(40,5,'MONTHLY SALARY', 0, 0, 'L',1);
		$this->Cell(30,5,'CASH GIFT', 0, 0, 'L',1);
		$this->Cell(30,5,'1/2 BONUS', 0, 0, 'L',1);
		$this->Cell(30,5,'1/2 CASH GIFT', 0, 0, 'L',1);		
		$this->Cell(35,5,'NET PAY', 0, 0, 'C',1);
		$this->Cell(0,5,'SIGNATURE', 0, 0, 'C',1);		
		$this->Ln(7);
	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-85);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',10);
		$this->Cell(98,5,'Page Total', 0, 0, 'R',1);
		$this->Cell(45,5,number_format($this->curMSalaryPageTotal, 2,".",","), 0, 0, 'R',1);		
		$this->Cell(30,5,number_format($this->curCGiftPageTotal, 2,".",","), 0, 0, 'R',1);
		$this->Cell(30,5,number_format($this->curHalfBonusPageTotal, 2,".",","), 0, 0, 'R',1);
		$this->Cell(32,5,number_format($this->curHalfCGiftPageTotal, 2,".",","), 0, 0, 'R',1);
		$this->Cell(36,5,number_format($this->curNetPageTotal, 2,".",","), 0, 0, 'R',1);
		$this->Cell(0, 5, '', 0, 1, 'R', 1);
		
		
		if($this->blnGrandTotal)
		{
			$this->SetFillColor(150,150,150);
			$this->SetFont('Arial','B',10);
			$this->Cell(98,5,'Grand Total', 0, 0, 'R',1);
			$this->Cell(45,5,number_format($this->curMSalaryGrandTotal, 2,".",","), 0, 0, 'R',1);		
			$this->Cell(30,5,number_format($this->curCGiftGrandTotal, 2,".",","), 0, 0, 'R',1);
			$this->Cell(30,5,number_format($this->curHalfBonusGrandTotal, 2,".",","), 0, 0, 'R',1);
			$this->Cell(32,5,number_format($this->curHalfCGiftgrandTotal, 2,".",","), 0, 0, 'R',1);
			$this->Cell(36,5,number_format($this->curNetGrandTotal, 2,".",","), 0, 0, 'R',1);
			$this->Cell(0, 5, '', 0, 1, 'R', 1);		
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

		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		$this->setSignatory("Personnel");
		$this->Cell(70, 5, strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Cell(50);
		$this->setSignatory("Director");
		$this->Cell(70, 5, strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Ln(4);

		$this->Cell(30);
		$this->setSignatory("Personnel");
		$this->Cell(70, 5, $this->strSgntryTitle, 0, 0, 'C');
		$this->Cell(50);
		$this->setSignatory("Director");
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
	
	function setGrandTotal($t_curMSalaryGrandTotal, $t_curCGiftGrandTotal, $t_curHalfBonusGrandTotal, $t_curHalfCGiftGrandTotal, $t_curNetGrandTotal)
	{
		$this->blnGrandTotal = 1;
		$this->curMSalaryGrandTotal = $t_curMSalaryGrandTotal;
		$this->curCGiftGrandTotal = $t_curCGiftGrandTotal;
		$this->curHalfBonusGrandTotal = $t_curHalfBonusGrandTotal;
		$this->curHalfCGiftgrandTotal = $t_curHalfCGiftGrandTotal;
		$this->curNetGrandTotal = $t_curNetGrandTotal;
	}
	
	function setPageTotal($t_curMSalaryPageTotal, $t_curCGiftPageTotal, $t_curHalfBonusPageTotal, $t_curHalfCGiftPageTotal, $t_curNetPageTotal)
	{
		$this->curMSalaryPageTotal = $t_curMSalaryPageTotal;
		$this->curCGiftPageTotal = $t_curCGiftPageTotal;
		$this->curHalfBonusPageTotal = $t_curHalfBonusPageTotal;
		$this->curHalfCGiftPageTotal = $t_curHalfCGiftPageTotal;
		$this->curNetPageTotal = $t_curNetPageTotal;
		
	}
	
	
	
	function setDivisionName($t_strDivisionName, $t_strProjectName)
	{
		$this->strDivisionName = $t_strDivisionName;
		$this->strProjectName = $t_strProjectName;
	}
	
	function setMonthYear($t_intYear, $t_intPeriod)
	{
		
		$this->intYear = $t_intYear;
		if($t_intPeriod == 1)
		{
			$this->intPeriod = "January - June"; 
		}
		else if($t_intPeriod == 2)
		{
			$this->intPeriod = "July - December";
		}
	}
	
	
	
}
?>