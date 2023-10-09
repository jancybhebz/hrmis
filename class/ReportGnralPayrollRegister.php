<?
/* 
File Name: ReportGnralPayrollRegister.php
----------------------------------------------------------------------
Purpose of this file: 
Class General
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl Samoy Dy Tioco, Joan C. Gamboa
----------------------------------------------------------------------
Date of Revision: August 12, 2004
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

class ReportGnralPayrollRegister extends FPDF
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


	function ReportGnralPayrollRegister()
	{
		$this->FPDF('L','mm','Legal');
	}

	//Page header
	function Header()
	{	
		$interLigne = 5;
		$this->SetFont(Arial,B,12);
		$this->Cell(0,10,'GENERAL PAYROLL',0,0,C);
		$this->SetFont(Arial,B,12);
		$this->Ln(5);	
		$this->Cell(0,10,$this->agencyName,0,0,C);
		$this->Ln(10);	

		$this->intPageNo = $this->PageNo();
		$this->SetFont(Arial,'',8);
		$this->Cell(0,10,'Page: ' . $this->intPageNo,0,0,R);
		$this->Ln(10);	
		$this->SetFont(Arial,'I',10);
		$this->Cell(0,5,'We hereby acknowledge to have received from STII the sums herein specified opposite our respective names, being in full compensation for our services for the period August 1 - 30, 2004.',0,0,C);
		$this->Ln(5);	
		$this->Cell(20,5,'Furthermore, we certify that we have incurred our RATA and Transportation Allowances for the same period. ' ,0,0);
		$this->Ln(7);	
		$this->SetFont(Arial,'',10);
		$this->Cell(45,10,'NO',LTR,0,L);
		$this->Cell(60,10,'N A M E',LTR,0,L);
		$this->Cell(65,10,'S A L A R Y  E A R N E D',LTR,0,C);
		$this->Cell(75,10,'D E D U C T I O N S',LTR,0,C);
		$this->Cell(75,10,'N E T  P A Y',LTR,0,C);
		$this->Ln(8);
					
		$this->SetFont(Arial,'',9);
		$this->Cell(45,$interLigne,'STAT/TYPE',LR,0,L);
		$this->Cell(60,$interLigne,'POSITION',LR,0,L);
		$this->Cell(35,$interLigne,'BASIC RATE',L,0,L);
		$this->Cell(30,$interLigne,'PAY',R,0,L);
		$this->Cell(25,$interLigne,'GSIS',L,0,L);
		$this->Cell(25,$interLigne,'PAG-IBIG',0,0,L);
		$this->Cell(25,$interLigne," ",R,0,L);
		$this->Cell(75,$interLigne,'01-15',LR,0,L);
		$this->Ln(5);
					
		$this->SetFont(Arial,'',9);
		$this->Cell(45,$interLigne,'SAL. GRADE',LR,0,L);
		$this->Cell(60,$interLigne,' ',LR,0,L);
		$this->Cell(35,$interLigne,'BASIC 2',L,0,L);
		$this->Cell(30,$interLigne," ",R,0,L);
		$this->Cell(25,$interLigne,"W/TAX",L,0,L);
		$this->Cell(25,$interLigne,"OALI (01)",0,0,L);
		$this->Cell(25,$interLigne,"OTHERS",R,0,L);
		$this->Cell(75,$interLigne,'16 TO 30/31',LR,0,L);
		$this->Ln(5);			

		$this->SetFont(Arial,'',9);
		$this->Cell(45,$interLigne,"",LR,0,L);
		$this->Cell(60,$interLigne,"",LR,0,L);
		$this->Cell(35,$interLigne,"PERA",L,0,L);
		$this->Cell(30,$interLigne,"PERA/2",R,0,L);
		$this->Cell(25,$interLigne,"MEDICARE",L,0,L);
		$this->Cell(25,$interLigne,"SAL. LOAN",0,0,L);
		$this->Cell(25,$interLigne,"",R,0,L);
		$this->Cell(75,$interLigne,"",LR,0,L);
		$this->Ln(5);			

		$this->SetFont(Arial,'',9);
		$this->Cell(45,$interLigne,"",LR,0,L);
		$this->Cell(60,$interLigne,"",LR,0,L);
		$this->Cell(35,$interLigne,"A.C.",L,0,L);
		$this->Cell(30,$interLigne,"A.C./2",R,0,L);
		$this->Cell(25,$interLigne,"",L,0,L);
		$this->Cell(25,$interLigne,"",0,0,L);
		$this->Cell(25,$interLigne,"",R,0,L);
		$this->Cell(75,$interLigne,"",LR,0,L);
		$this->Ln(5);			

		$this->SetFont(Arial,'',9);
		$this->Cell(45,$interLigne,"",LR,0,L);
		$this->Cell(60,$interLigne,"",LR,0,L);
		$this->Cell(35,$interLigne,"T.A.",L,0,L);
		$this->Cell(30,$interLigne,"TA/2",R,0,L);
		$this->Cell(25,$interLigne,"",L,0,L);
		$this->Cell(25,$interLigne,"",0,0,L);
		$this->Cell(25,$interLigne,"",R,0,L);
		$this->Cell(75,$interLigne,"",LR,0,L);
		$this->Ln(5);			

		$this->SetFont(Arial,'',9);
		$this->Cell(45,$interLigne,"",LR,0,L);
		$this->Cell(60,$interLigne,"",LR,0,L);
		$this->Cell(35,$interLigne,"STAB. ALL.",L,0,L);
		$this->Cell(30,$interLigne,"S.A./2",R,0,L);
		$this->Cell(25,$interLigne,"",L,0,L);
		$this->Cell(25,$interLigne,"",0,0,L);
		$this->Cell(25,$interLigne,"",R,0,L);
		$this->Cell(75,$interLigne,"",LR,0,L);
		$this->Ln(5);
					
		$this->SetFont(Arial,'',9);
		$this->Cell(45,$interLigne,"",LBR,0,L);
		$this->Cell(60,$interLigne,"",LBR,0,L);
		$this->Cell(35,$interLigne,"R.A.",LB,0,L);
		$this->Cell(30,$interLigne,"RA/2",BR,0,L);
		$this->Cell(25,$interLigne,"",LB,0,L);
		$this->Cell(25,$interLigne,"",B,0,L);
		$this->Cell(25,$interLigne,"",BR,0,L);
		$this->Cell(75,$interLigne,"",LBR,0,L);
		$this->Ln(10);			
	}	
	
	//Page footer
	function Footer()
	{
	
		$this->Cell(45,$interLigne,"",0,0,L);			
		$this->Cell(60,$interLigne,"PER DIVISION TOTALS:",0,0,L);
		$this->Cell(35,$interLigne,"96,219.00",0,0,C);
		$this->Cell(30,$interLigne,"25,630.00",R,0,C);
		$this->Cell(25,$interLigne,"8,659.71",0,0,C);
		$this->Cell(25,$interLigne,"700.00",0,0,C);
		$this->Cell(25,$interLigne,"15,501.89",R,0,C);
		$this->Cell(35,$interLigne,"29130.00",0,0,C);
		$this->Cell(40,$interLigne,"",0,0);
		$this->Ln(2);
		
		$this->Cell(320,10,"",T,0);
		$this->Ln(5);
		$this->SetFont(Arial,'',7);
		$this->Cell(30,5,'LEGEND: AL=Allicance Loan / ' ,0,0,L);
		$this->Ln(10);	
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

	function setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum)
	{
		$objOfficeInfo = mysql_query("SELECT tblAgency.agencyName, tblAgency.address, tblAgency.telephone
									  FROM tblAgency");
		$arrOfficeInfo = mysql_fetch_array($objOfficeInfo);
		$strAgencyName = $arrOfficeInfo['agencyName'];
		$t_strAgencyName = strtoupper($strAgencyName);
		$this->agencyName = $t_strAgencyName;
		$this->agencyAdd = $arrOfficeInfo['address'];
		$this->agencyNum = $arrOfficeInfo['telephone'];
	}	


}	// end class
?>