<?
/* 
File Name: ReportPersonnelAction.php (class folder)
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
Date of Revision: May 24, 2004
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


class ReportPersonnelAction extends FPDF
{

	var $strTitle;
	var $intPageNo;
	var $strMonthName, $intYear;
	
	// Header
	function ReportPersonnelAction()
	{
		$this->FPDF('L', 'mm', 'Legal');
	}

	function Header()
	{
		$InterLigne = 6;
		$Border = 5;
		$Ligne = 50;
		
		$this->SetFont(Arial,B,11);
		$this->Cell(0,$InterLigne,"REPORT ON PERSONNEL ACTION",0,0,C);
		$this->Ln(5);

		$this->SetFont(Arial,B,10);
		$this->Cell(0,$InterLigne,"For the Month of May 2004",0,0,C);
		$this->Ln(10);
		
		$this->SetFont(Arial,B,11);
		$this->Cell(0,$InterLigne,"SCIENCE AND TECHNOLOGY INFORMATION INSTITUTE",0,0,C);
		$this->Ln(5);

		$this->SetFont(Arial,'',10);
		$this->Cell(0,$InterLigne,"General Santos Ave. DOST Compound Bicutan M.M.",0,0,C);
		$this->Ln(10);

		$this->SetFont(Arial,B,8);
		$this->Cell(32,$Border,"DATE",LTR,0,C);
		$this->Cell(30,$InterLigne,"NAME OF",LTR,0,C);
		$this->Cell(25,$InterLigne,"POSITION",LTR,0,C);
		$this->Cell(25,$InterLigne,"ITEM",LTR,0,C);
		$this->Cell(12,$InterLigne,"SALARY",LTR,0,C);
		$this->Cell(26,$Border,"APPOINTMENT",LTR,0,C);
		$this->Cell(35,$InterLigne,"PUBLISHED",LTR,0,C);
		$this->Cell(100,$InterLigne,"PERSONAL QUALIFICATION",LTR,0,C);
		$this->Cell(15,$InterLigne,"DATE",LTR,0,C);
		$this->Cell(15,$InterLigne,"PLACE",LTR,0,C);
		$this->Cell(17,$InterLigne,"ACTION",LTR,0,C);
		$this->Cell(18,$InterLigne,"DEVIATIONS",LTR,0,C);
		$this->Ln(4);

		$this->SetFont(Arial,'B',7);
		$this->Cell(15,$InterLigne,"ISSUED",LTR,0,C);
		$this->Cell(17,$InterLigne,"OF",LTR,0,C);
		$this->SetFont(Arial,B,8);
		$this->Cell(30,$InterLigne,"APPOINTEE",R,0,C);					//  name of appointee
		$this->Cell(25,$InterLigne,"TITLE",R,0,C);			//  position title
		$this->Cell(25,$InterLigne,"NO.",R,0,C);				//  item number
		$this->Cell(12,$InterLigne,"GRADE",R,0,C);				//  salary grade
		$this->SetFont(Arial,'B',7);
		$this->Cell(13,$InterLigne,"STATUS",LTR,0,C);
		$this->Cell(13,$InterLigne,"NATURE",LTR,0,C);
		$this->Cell(15,$InterLigne,"DATE",LTR,0,C);
		$this->Cell(20,$InterLigne,"WHERE",LTR,0,C);
		$this->Cell(17,$InterLigne,"EDUCATION",LTR,0,C);
		$this->Cell(17,$InterLigne,"EXPERIENCE",LTR,0,C);
		$this->Cell(14,$InterLigne,"TRAINING",LTR,0,C);
		$this->Cell(52,$InterLigne,"ELIGIBILITY",LTR,0,C);
		$this->SetFont(Arial,'B',8);
		$this->Cell(15,$InterLigne,"OF",R,0,C);
		$this->Cell(15,$InterLigne,"OF",R,0,C);
		$this->Cell(17,$InterLigne,"TAKEN BY",R,0,C);
		$this->Cell(18,$InterLigne,"NOTED/",R,0,C);
		$this->Ln(5);

		$this->SetFont(Arial,'B',7);
		$this->Cell(15,$InterLigne,"",LR,0,C);
		$this->Cell(17,5,"EFFECTIVITY",LR,0,C);
		$this->SetFont(Arial,B,8);
		$this->Cell(30,$InterLigne,"",R,0,C);					//  name of appointee
		$this->Cell(25,$InterLigne,"",R,0,C);			//  position title
		$this->Cell(25,$InterLigne,"",R,0,C);				//  item number
		$this->Cell(12,$InterLigne,"",R,0,C);				//  salary grade
		$this->SetFont(Arial,'B',7);
		$this->Cell(13,$InterLigne,"",LTR,0,C);
		$this->Cell(13,$InterLigne,"",LTR,0,C);
		$this->Cell(15,$InterLigne,"",LTR,0,C);
		$this->Cell(20,$InterLigne,"",LTR,0,C);
		$this->Cell(17,$InterLigne,"",LTR,0,C);
		$this->Cell(17,$InterLigne,"",LTR,0,C);
		$this->Cell(14,$InterLigne,"",LTR,0,C);
		$this->Cell(13,$InterLigne,"TITLE",LTR,0,C);
		$this->Cell(14,$InterLigne,"DATE",LTR,0,C);
		$this->Cell(15,$InterLigne,"PLACE",LTR,0,C);
		$this->Cell(10,$InterLigne,"RATING",LTR,0,C);
		$this->SetFont(Arial,'B',8);
		$this->Cell(15,$InterLigne,"BIRTH",R,0,C);
		$this->Cell(15,$InterLigne,"BIRTH",R,0,C);
		$this->Cell(17,$InterLigne,"RO/FO/PO",R,0,C);
		$this->Cell(18,$InterLigne,"REMARKS",R,0,C);
		$this->Ln(5);

		$this->SetFont(Arial,'B',7);
		$this->Cell(15,$InterLigne,"",LR,0,C);
		$this->Cell(17,$InterLigne,"",R,0,C);
		$this->SetFont(Arial,B,8);
		$this->Cell(30,$InterLigne,"",R,0,C);					//  name of appointee
		$this->Cell(25,$InterLigne,"",R,0,C);			//  position title
		$this->Cell(25,$InterLigne,"",R,0,C);				//  item number
		$this->Cell(12,$InterLigne,"",R,0,C);				//  salary grade
		$this->SetFont(Arial,'B',7);
		$this->Cell(13,$InterLigne,"",R,0,C);
		$this->Cell(13,$InterLigne,"",R,0,C);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(20,$InterLigne,"",R,0,C);
		$this->Cell(17,$InterLigne,"",R,0,C);
		$this->Cell(17,$InterLigne,"",R,0,C);
		$this->Cell(14,$InterLigne,"",R,0,C);
		$this->Cell(13,$InterLigne,"",R,0,C);
		$this->Cell(14,$InterLigne,"",R,0,C);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(10,$InterLigne,"",R,0,C);
		$this->SetFont(Arial,'B',8);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(17,$InterLigne,"(to be filled",R,0,C);
		$this->Cell(18,$InterLigne,"",R,0,C);
		$this->Ln(5);

		$this->SetFont(Arial,'B',7);
		$this->Cell(15,$InterLigne,"",LR,0,C);
		$this->Cell(17,$InterLigne,"",R,0,C);
		$this->SetFont(Arial,B,8);
		$this->Cell(30,$InterLigne,"",R,0,C);					//  name of appointee
		$this->Cell(25,$InterLigne,"",R,0,C);			//  position title
		$this->Cell(25,$InterLigne,"",R,0,C);				//  item number
		$this->Cell(12,$InterLigne,"",R,0,C);				//  salary grade
		$this->SetFont(Arial,'B',7);
		$this->Cell(13,$InterLigne,"",R,0,C);
		$this->Cell(13,$InterLigne,"",R,0,C);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(20,$InterLigne,"",R,0,C);
		$this->Cell(17,$InterLigne,"",R,0,C);
		$this->Cell(17,$InterLigne,"",R,0,C);
		$this->Cell(14,$InterLigne,"",R,0,C);
		$this->Cell(13,$InterLigne,"",R,0,C);
		$this->Cell(14,$InterLigne,"",R,0,C);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(10,$InterLigne,"",R,0,C);
		$this->SetFont(Arial,'B',8);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(17,$InterLigne,"by CSRO)",R,0,C);
		$this->Cell(18,$InterLigne,"",R,0,C);
		$this->Ln(5);
		
		// spaces
		$this->SetFont(Arial,'B',7);
		$this->Cell(15,$InterLigne,"",LR,0,C);
		$this->Cell(17,$InterLigne,"",R,0,C);
		$this->SetFont(Arial,B,8);
		$this->Cell(30,$InterLigne,"",R,0,C);
		$this->Cell(25,$InterLigne,"",R,0,C);
		$this->Cell(25,$InterLigne,"",R,0,C);
		$this->Cell(12,$InterLigne,"",R,0,C);
		$this->SetFont(Arial,'B',7);
		$this->Cell(13,$InterLigne,"",R,0,C);
		$this->Cell(13,$InterLigne,"",R,0,C);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(20,$InterLigne,"",R,0,C);
		$this->Cell(17,$InterLigne,"",R,0,C);
		$this->Cell(17,$InterLigne,"",R,0,C);
		$this->Cell(14,$InterLigne,"",R,0,C);
		$this->Cell(13,$InterLigne,"",R,0,C);
		$this->Cell(14,$InterLigne,"",R,0,C);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(10,$InterLigne,"",R,0,C);
		$this->SetFont(Arial,'B',8);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(15,$InterLigne,"",R,0,C);
		$this->Cell(17,$InterLigne,"",R,0,C);
		$this->Cell(18,$InterLigne,"",R,0,C);
		$this->Ln(5);

		$this->SetFont(Arial,'B',7);
		$this->Cell(15,$InterLigne,"[1]",LBR,0,C);
		$this->Cell(17,$InterLigne,"[2]",BR,0,C);
		$this->Cell(30,$InterLigne,"[3]",BR,0,C);
		$this->Cell(25,$InterLigne,"[4]",BR,0,C);
		$this->Cell(25,$InterLigne,"[5]",BR,0,C);
		$this->Cell(12,$InterLigne,"[6]",BR,0,C);
		$this->Cell(13,$InterLigne,"[7]",BR,0,C);
		$this->Cell(13,$InterLigne,"[8]",BR,0,C);
		$this->Cell(15,$InterLigne,"[9]",BR,0,C);
		$this->Cell(20,$InterLigne,"[10]",BR,0,C);
		$this->Cell(17,$InterLigne,"[11]",BR,0,C);
		$this->Cell(17,$InterLigne,"[12]",BR,0,C);
		$this->Cell(14,$InterLigne,"[13]",BR,0,C);
		$this->Cell(13,$InterLigne,"[14]",BR,0,C);
		$this->Cell(14,$InterLigne,"[15]",BR,0,C);
		$this->Cell(15,$InterLigne,"[16]",BR,0,C);
		$this->Cell(10,$InterLigne,"[17]",BR,0,C);
		$this->Cell(15,$InterLigne,"[18]",BR,0,C);
		$this->Cell(15,$InterLigne,"[19]",BR,0,C);
		$this->Cell(17,$InterLigne,"[20]",BR,0,C);
		$this->Cell(18,$InterLigne,"[21]",BR,0,C);
		$this->Ln(6);
	}
		
	//  Footer
	function Footer()
	{
		$InterLigne = 5;
		
		$this->SetFont(Arial,'B',7);
		$this->Cell(15,$InterLigne,"",LTBR,0,C);
		$this->Cell(17,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(12,$InterLigne,"",LTBR,0,C);
		$this->Cell(13,$InterLigne,"",LTBR,0,C);
		$this->Cell(13,$InterLigne,"",LTBR,0,C);
		$this->Cell(15,$InterLigne,"",LTBR,0,C);
		$this->Cell(20,$InterLigne,"",LTBR,0,C);
		$this->Cell(17,$InterLigne,"",LTBR,0,C);
		$this->Cell(17,$InterLigne,"",LTBR,0,C);
		$this->Cell(14,$InterLigne,"",LTBR,0,C);
		$this->Cell(13,$InterLigne,"",LTBR,0,C);
		$this->Cell(14,$InterLigne,"",LTBR,0,C);
		$this->Cell(15,$InterLigne,"",LTBR,0,C);
		$this->Cell(10,$InterLigne,"",LTBR,0,C);
		$this->Cell(15,$InterLigne,"",LTBR,0,C);
		$this->Cell(15,$InterLigne,"",LTBR,0,C);
		$this->Cell(17,$InterLigne,"",LTBR,0,C);
		$this->Cell(18,$InterLigne,"",LTBR,0,C);
		$this->Ln(10);

		$this->SetFont(Arial,B,10);
		$this->Cell(70,$InterLigne,"Prepared by:",0,0,C);
		$this->SetFont(Arial,B,10);
		$this->Cell(150,$InterLigne,"Review/Submitted by:",0,0,C);
		$this->SetFont(Arial,B,10);
		$this->Cell(100,$InterLigne,"Checked/Verified by:",0,0,C);
		$this->Ln(15);

		$this->SetFont(Arial,B,10);
		$this->Cell(90,$InterLigne,"Cristeta Olivar",0,0,C);		//  name of employee/processor
		$this->SetFont(Arial,B,10);
		$this->Cell(130,$InterLigne,"Bea Castillo",0,0,C);			//	name of head/HRMO
		$this->SetFont(Arial,B,10);
		$this->Cell(100,$InterLigne,"Jose L. Guerrero",0,0,C);		//	name of director
		$this->Ln(5);

		$this->SetFont(Arial,B,10);
		$this->Cell(90,$InterLigne,"HRMO III",0,0,C);
		$this->SetFont(Arial,B,10);
		$this->Cell(130,$InterLigne,"ACCOUNTANT",0,0,C);
		$this->SetFont(Arial,B,10);
		$this->Cell(100,$InterLigne,"DIRECTOR",0,0,C);
		$this->Ln(15);

		$this->SetFont(Arial,'',5);
		$this->Cell(10,$InterLigne,"IO - in order",0,0,L);
		$this->Ln(2);
		$this->Cell(10,$InterLigne,"FI - for invalidation",0,0,L);
	}
	
	function setMonthYear($t_strMonthName, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
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

}   //  End Class

?>