<?
/* 
File Name: ReportMonthlySeparation.php
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
Date of Revision: May 16, 2004
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

class ReportCSCPlantillaCasualApp extends FPDF 
{

	var $strTitle;
	var $intPageNo;
	var $strMonthName, $intYear;
	var $strSgntryName, $strSgntryTitle;

	//Page header
	function ReportCSCPlantillaCasualApp()
	{
		$this->FPDF('P', 'mm', 'Letter');
	}
	
	function Header()
	{
		$this->SetFont(Arial,'B',8);
		$this->Cell(0,0,"CS Form No.________",0,0,L);
		$this->Ln(4);
		$this->Cell(0,0,"(Revised 1998)",0,0,L);
		$this->Ln(5);
		$this->SetFont(Arial,'B',10);
		$this->Cell(0,0,"REPUBLIC OF THE PHILIPPINES",0,0,C);
		$this->Ln(5);
		$this->Cell(0,0,$this->agencyName,0,0,C);
		$this->Ln(5);
		$this->Cell(0,0,$this->agencyAdd,0,0,C);
		$this->Ln(13);
		$this->SetFont(Arial,'B',12);
		$this->Cell(0,0,"PLANTILLA OF CASUAL APPOINTMENT",0,0,C);
		$this->Ln(10);
		
		$this->SetFont(Arial,'',8);
		$this->Cell(143,0,'                     ' . ' ',0,0,L);
		$this->Cell(290,0,'Source of Funds:                 ' . '' . $_SESSION['sesFundsSource'],0,0,L);
		$this->Ln(4);
		$this->Cell(143,0,'Department/Division: ' . ' ' . $_SESSION['sesDivision'],0,0,L);
		$this->Cell(290,0,'Date Prepared by HRMO:    ' . '' . date("F d, Y"),0,0,L);
		$this->Ln(4);
		
		
		$Title = 15;
		$this->SetFont(Arial,'B',8);
		$this->Cell(50,$Title,"Name of Appointee/s",LTR,0,C);
		$this->Cell(35,$Title,"Position",LTR,0,C);
		$this->Cell(10,$Title,"Level",LTR,0,C);
		$this->Cell(15,$Title,"SG",LTR,0,C);
		$this->Cell(20,$Title,"Daily",LTR,0,C);
		$this->Cell(20,$Title,"Period of",LTR,0,C);
		$this->Cell(20,$Title,"Employment",LTR,0,C);
		$this->Cell(40,$Title,"If Renewal(incl. Date",LTR,0,C);
		$this->Ln(5);
		$this->Cell(50,$Title," ",LBR,0,C);
		$this->Cell(35,$Title," ",LBR,0,C);
		$this->Cell(10,$Title," ",LBR,0,C);
		$this->Cell(15,$Title," ",LBR,0,C);
		$this->Cell(20,$Title,"Wage/Salary",LBR,0,C);
		$this->Cell(20,$Title,"From",LBR,0,C);
		$this->Cell(20,$Title,"To",LBR,0,C);
		$this->Cell(40,$Title,"of Previous Employment)",LBR,0,C);
		$this->Ln(15);

	 }
	
	//Page footers
	function Footer() 
	{
		$this->SetY(-85);   // gray total
		$this->SetFont(Arial,'',8);
		$this->Cell(0,0,"           The above named personnel are hereby hired/appointed as casuals at the rate of compensation stated opposite their/his name(s) for the",0,0,L);
		$this->Ln(5);
		$this->Cell(0,0,"period indicated. It is understood that such employment will cease automatically at the end of the period stated unless renewed. Any of all of them",0,0,L);
		$this->Ln(5);
		$this->Cell(0,0,"may be laid-off anytime before the expiration of the employment period when their services are no longer needed or funds are no longer available",0,0,L);
		$this->Ln(5);
		$this->Cell(0,0,"or the projects has been completed/finished or their performance are below par.",0,0,L);
		$this->Ln(4);
		$this->SetFont(Arial,'B',10);
		$this->Cell(0,0,"_____________________________________________________________________________________________",0,0,L);
		$this->Ln(5);
		$this->Cell(0,0,"     CERTIFICATION                                        RECOMMENDING APPROVAL                            CSC ACTION",0,0,L);		
		$this->Ln(5);
		$this->SetFont(Arial,'',8);
		$this->Cell(187,0,'________________Approved',0,0,R);
		$this->Ln(5);
		$this->Cell(187,0,'_____________Disapproved',0,0,R);
		$this->Ln(4);
		$this->Cell(30,0,'       This is to certify that all requirements',0,0,L);
		$this->Ln(4);
		$this->Cell(30,0,'and supporting papers pursuant to CSC',0,0,L);
		$this->Ln(4);
		$this->Cell(80,0,'MC No.________,s. have been complied with,',0,0,L);
		$this->Cell(37,0,$_SESSION['sesAppointAuthority'],0,0,C); //session Appointing Authority
		$this->Cell(18);
		$this->Cell(65,0,$_SESSION['sesHeadCSCOfficer'],0,0,C);  //session Head CSC Field Officer
		$this->Ln(4);
		$this->Cell(80,0, 'in order.',0,0,L);
		$this->SetFont(Arial,'B',8);
		$this->Cell(50,0,"    Appointing Authority",0,0,L);
		$this->Cell(18);
		$this->Cell(45,0,"    Head CSC Field Officer",0,0,L);
		$this->Ln(7);
		$this->setSignatory("Personnel");
		$this->Ln(3);
		$this->Cell(50,0,                            $this->strSgntryName,0,0,C);
		$this->Ln(2);
		$this->Cell(40,0,"              ______________________",0,0,C);   //hrmo signatory
		$this->Cell(40);
		$this->Cell(40,0,"________________________",0,0,C);                 //date issued
		$this->Cell(28);
		$this->Cell(45,0,"________________________",0,0,L);                 //date signed
		$this->Ln(4);
		
		$this->SetFont(Arial,'B',8);
		$this->Cell(70,0,"                     HRMO",0,0,L);
		$this->Cell(70,0,"                          Date Issued",0,0,L);
		$this->Cell(20);
		$this->Cell(30,0,"Date Signed",0,0,L);
		
		$this->Ln(5);
		$curDate = date("F  d, Y");
		$this->SetFont(Arial,'',8);
		$this->Cell(50,0,                $curDate,0,0,C);
		$this->Ln(2);
		$this->Cell(40,0,"              ________________________",0,0,C);
		$this->Ln(3);
		$this->SetFont(Arial,'B',8);
		$this->Cell(70,0,"                      Date",0,0,L);
		
	}

	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
	}
	
	
	function setMonthYear($t_strMonthName, $t_intYear)
	{
		$this->strMonthName = strtoupper($t_strMonthName);
		$this->intYear = $t_intYear;
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
	
	function setDivisionName($t_strDivisionName, $t_strProjectName )
	{
		$this->strDivisionName = $t_strDivisionName;
		$this->strProjectName  = $t_strProjectName;
	}
	
}   //end class

?>