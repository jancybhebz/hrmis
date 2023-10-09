<?
/* 
File Name: ReportCapabilityBuilding.php (class folder)
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


class ReportCapabilityBuilding extends FPDF
{

	var $strTitle;
	var $intPageNo;
	var $strMonthName, $intYear;
	
	//  Page Header
	function ReportCapabilityBuilding()
	{
		$this->FPDF('L', 'mm', 'Legal');
	}
	function Header()
	{
		$InterLigne = 7;
		
		$this->SetFont(Arial,'',11);
		$this->Cell(0,6,"SCIENCE AND TECHNOLOGY INFORMATION INSTITUTE",0,0,C);
		$this->Ln(5);
		
		$this->SetFont(Arial,'B',11);
		$this->Cell(0,6,"CAPABILITY BUILDING: NON-FORMAL TRAINING OF DOST STAFF",0,0,C);
		$this->Ln(5);
		
		$this->SetFont(Arial,'',9);
		$this->Cell(0,6,"For the month of May 2004",0,0,C);
		$this->Ln(10);
		
		$this->SetFont(Arial,'',8);
		$this->Cell(260,6,"Prepared by :",0,0,R);
		$this->Ln(5);
		$this->SetFont(Arial,'',8);
		$this->Cell(260,6,"Designation :",0,0,R);
		$this->Ln(5);
		$this->SetFont(Arial,'',8);
		$this->Cell(260,6,"Date            :",0,0,R);
		$this->Ln(8);
		
		$this->SetFont(Arial,B,9);
		$this->Cell(20,$InterLigne,"Type of",0,0,C);
		$this->SetFont(Arial,B,9);
		$this->Cell(50,$InterLigne,"Title of Activity",0,0,C);
		$this->SetFont(Arial,B,9);
		$this->Cell(50,$InterLigne,"Subject Matter",0,0,C);
		$this->SetFont(Arial,B,9);
		$this->Cell(30,$InterLigne,"Venue/Date",0,0,C);
		$this->SetFont(Arial,B,9);
		$this->Cell(40,$InterLigne,"Organizing",0,0,C);
		$this->SetFont(Arial,B,9);
		$this->Cell(60,$InterLigne,"Name of Personnel",0,0,C);
		$this->SetFont(Arial,B,9);
		$this->Cell(30,$InterLigne,"Division/",0,0,C);
		$this->SetFont(Arial,B,9);
		$this->Cell(30,$InterLigne,"Cost of",0,0,C);
		$this->SetFont(Arial,B,9);
		$this->Cell(30,$InterLigne,"Source of",0,0,C);
		$this->Ln(5);

		$this->SetFont(Arial,B,9);
		$this->Cell(20,$InterLigne,"Activity",0,0,C);
		$this->Cell(50,$InterLigne," ",0,0,C);
		$this->Cell(50,$InterLigne," ",0,0,C);
		$this->Cell(30,$InterLigne," ",0,0,C);
		$this->Cell(40,$InterLigne,"Group",0,0,C);
		$this->Cell(60,$InterLigne,"Involved",0,0,C);
		$this->Cell(30,$InterLigne,"Dept.",0,0,C);
		$this->Cell(30,$InterLigne,"Training",0,0,C);
		$this->Cell(30,$InterLigne,"Funds",0,0,C);
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

	
}  //  End Class

?>