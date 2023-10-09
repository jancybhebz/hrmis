<?
/* 
File Name: ReportLongevityPay.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employees information to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: May 25, 2004
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
require_once("../hrmis/class/fpdf.php");

class ReportLongevityPay extends FPDF
{
	
	var $strTitle;
	var $intPageNo;
	var $strMonthName, $intYear;
	var $blnGrandTotal = 0;
	var $curLOAPageTotal;
	var $curLOAGrandTotal;
	var $agencyName;
	var $strSgntryName;
	var $strSgntryTitle;
	var $strDivisionName;
	

	//  Page Header
	function ReportLongevityPay()
	{
		$this->FPDF('L', 'mm', 'Legal');
	}

	function Header()
	{	
		$this->SetFont('Arial','',9);
		$this->Cell(0,0,$this->agencyName, 0, 0, 'C');
		$this->Ln(4);
		$this->SetFont('Arial','B',12);
		$this->Cell(0,2,'LONGEVITY PAY for the Month of  ' .$this->strMonthName , 0, 0, 'C');		
		$this->SetFont('Arial','',9);
		$this->Ln(5);
		$this->Cell(0,2,'PER R.A. 8439(MAGNA CARTA FOR S&T PERSONNEL)', 0, 0, 'C');
		$this->Ln(5);
		$this->Cell(0,2,'(BASED ON NEW SALARY SCHEDULE PURSUANT TO NBC 474 IMPLEMENTING RA 9137)', 0, 0, 'C');
		$this->Ln(2);
		
		$this->SetFont('Arial','',5);
		$this->Cell(330,0,'Fn:  x|\s&t_longevity_pay',0,0,'R');
		$this->Ln(2);

		$this->SetFont(Arial,'',10);
		$this->Cell(50,10," ",'LTR',0,C);
		$this->Cell(30,10," ",'LTR',0,C);
		$this->Cell(10,10," ",'LTR',0,C);
		$this->Cell(25,10,"PRESENT",'LTR',0,C);
		$this->Cell(40,10," ",'LTR',0,C);
		$this->Cell(10,10,"No.",'LTR',0,C);
		$this->SetFont(Arial,'',11);
		$this->Cell(152,9,"CONTINOUS & MERITORIOUS GOVERNMENT SERVICE",'LTR',0,C);
		$this->SetFont(Arial,'',10);
		$this->Cell(25,10,"MONTHLY",'LTR',0,C);
		$this->Ln(5);
		
		$this->SetFont(Arial,'',10);
		$this->Cell(50,10,"",0,0,C);
		$this->Cell(30,10," ",0,0,C);
		$this->Cell(10,10," ",0,0,C);
		$this->Cell(25,10,"MONTHLY",0,0,C);
		$this->Cell(40,10,"PERIOD ",0,0,C);
		$this->Cell(10,10,"OF",0,0,C);
		$this->SetFont(Arial,'',9);
		$this->Cell(151,7,"(5% OF MONTHLY SALARY FOR EVERY 5 YRS.) W/ VERY SATISFACTORY PERFORMANCE RATING",0,0,C);
		$this->SetFont(Arial,'',10);
		$this->Cell(25,10,"LONGEVITY",0,0,C);
		$this->Ln(5);

		$this->SetFont(Arial,'',10);
		$this->Cell(50,10,"NAME",'LBR',0,C);
		$this->Cell(30,10,"POSITION",'LBR',0,C);
		$this->Cell(10,10,"SG",'LBR',0,C);
		$this->Cell(25,10,"SALARY",'LBR',0,C);
		$this->Cell(40,10,"COVERED",'LBR',0,C);
		$this->Cell(10,10,"Yrs.",'LBR',0,C);
		
		$Percentage = 19; 
		$Height = 10;
		$this->SetFont(Arial,'',11);
		$this->Cell($Percentage,$Height,"5%",1,0,C);
		$this->Cell($Percentage,$Height,"10%",1,0,C);
		$this->Cell($Percentage,$Height,"15%",1,0,C);
		$this->Cell($Percentage,$Height,"20%",1,0,C);
		$this->Cell($Percentage,$Height,"25%",1,0,C);
		$this->Cell($Percentage,$Height,"30%",1,0,C);
		$this->Cell($Percentage,$Height,"35%",1,0,C);
		$this->Cell($Percentage,$Height,"40%",1,0,C);
		$this->Cell(25,10,"PAY",'LBR',0,C);
		$this->Ln(10);
		
		$this->SetFont(Arial,'',10);
		$this->Cell(50,10,"[1]",0,0,C);
		$this->Cell(30,10,"[2]",0,0,C);
		$this->Cell(10,10,"[3]",0,0,C);
		$this->Cell(25,10,"[4]",0,0,C);
		$this->Cell(40,10,"[5]",0,0,C);
		$this->Cell(10,10,"[6]",0,0,C);
		$this->Cell($Percentage,10,"[7]",0,0,C);
		$this->Cell($Percentage,10,"[8]",0,0,C);
		$this->Cell($Percentage,10,"[9]",0,0,C);
		$this->Cell($Percentage,10,"[10]",0,0,C);
		$this->Cell($Percentage,10,"[11]",0,0,C);
		$this->Cell($Percentage,10,"[12]",0,0,C);
		$this->Cell($Percentage,10,"[13]",0,0,C);
		$this->Cell($Percentage,10,"[14]",0,0,C);
		$this->Cell(25,10,"[15]",0,0,C);
		$this->Ln(10);
		
		
	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-50);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',10);
		$this->Cell(250,5, $this->strDivisionName, 1, 0, 'L',1);
		$this->Cell(30,5,'Page Total:', 1, 0, 'R',1);
		$this->Cell(60,5,$this->curLOAPageTotal, 1, 1, 'R',1);
		
		$this->SetFillColor(150,150,150);
		$this->SetFont('Arial','B',10);
		$this->Cell(250,5,'', 1, 0, 'R',1);
		$this->Cell(30,5,'Grand Total:', 1, 0, 'R',1);
		$this->Cell(60,5,$this->curLOAGrandTotal, 1, 1, 'R',1);		
		
		$this->Ln(10);
			
		$this->SetFont('Arial','',11);
		$this->Cell(30);
		$this->Cell(130,5,'Prepared by:', 0, 0, 'L');
		$this->Cell(130,5,'Certified correct:', 0, 0, 'R');
		$this->Ln(10);

		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		
		$this->Cell(70, 5, '', 0, 0, 'C');
		$this->Cell(60);
		
		$this->Cell(70, 5,'', 0, 0, 'C');
		$this->Ln(4);
		
		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		
		$this->Cell(70, 5,$this->strSgntryName, 0, 0, 'C');
		$this->Cell(60);
		
		$this->Cell(70, 5, $this->strSgntryTitle, 0, 0, 'C');
		$this->Ln(4);
	}
	
		
	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
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
	
	function setGrandTotal($t_intLOAGrandTotal)
	{
		$this->blnGrandTotal = 1;
		$this->curLOAGrandTotal = $t_intLOAGrandTotal;
				
	}	
	
	function setPageTotal($t_intLOAPageTotal)
	{
		$this->curLOAPageTotal = $t_intLOAPageTotal;
						
	}
	
	function setMonthYear($t_strMonthName, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
	}
	
	function setDivisionName($t_strDivisionName, $t_strEmpNumber)
	{
		$this->strDivisionName = $t_strDivisionName;
	}
	

	
	
} //end of class
	
?>