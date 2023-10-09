<?
/* 
File Name: ReportPersonnelEducation.php (class folder)
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
Date of Revision: May 26, 2004
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

class ReportPersonnelEducation extends FPDF
{
	
	var $strTitle;
	var $intPageNo;
	var $strMonthName, $intYear;

	//  Page Header
	function ReportPersonnelEducation()
	{
		$this->FPDF('L', 'mm', 'Legal');
	}

	function Header()
	{	
		$this->SetFont('Arial','B',10);
		$this->Cell(0,0,'Department of Science and Technology', 0, 0, 'C');
		$this->Ln(3);
		$this->Cell(0,2,$this->agencyName, 0, 0, 'C');		
		$this->Ln(10);
		$this->Cell(0,2,'EDUCATIONAL ATTAINMENT', 0, 0, 'C');
		$this->Ln(4);
		$this->Cell(0,2,'AS OF' . " " . date("Y"), 0, 0, 'C');
		$this->Ln(5);
		
		$this->SetFont(Arial,'B',11);
		$this->SetFillColor(150,150,150);
		$this->Cell(70,10,"",LTR,0,C,1);
		$this->Cell(80,10,"",LTR,0,C,1);
		$this->Cell(90,10,"",LTR,0,C,1);
		$this->Cell(85,10,"",LTR,0,C,1);
		$this->Ln(5);		
		$this->Cell(70,10,"EMPLOYE NAME",LBR,0,C,1);
		$this->Cell(80,10,"POSITION TITLE",LBR,0,C,1);
		$this->Cell(90,10,"HIGHEST EDUCATIONAL ATTAINMENT",LBR,0,C,1);
		$this->Cell(85,10,"OTHER COURSE/DEGREE OBTAIN",LBR,0,C,1);
		$this->Ln(10);
				
	}
	
	
	function setMonthYear($t_strMonthName, $t_intDay, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
		$this->intDay = $t_intDay;
	}
	
	function setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum)
	{

		$objOfficeInfo = mysql_query("SELECT tblAgency.agencyName, tblAgency.address, tblAgency.telephone
									  FROM tblAgency");
		$arrOfficeInfo = mysql_fetch_array($objOfficeInfo);
		$strAgencyName = $arrOfficeInfo['agencyName'];
		$this->agencyName = strtoupper($strAgencyName);
		$this->agencyAdd = $arrOfficeInfo['address'];
		$this->agencyNum = $arrOfficeInfo['telephone'];

	}	

	
} //end of class
	
?>