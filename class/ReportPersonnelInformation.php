<?
/* 
File Name: ReportPersonnelInformation.php (class folder)
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


class ReportPersonnelInformation extends FPDF
{

	var $strTitle;
	var $intPageNo;
	var $strMonthName, $intYear;
	
	// Header
	function ReportPersonnelInformation()
	{
		$this->FPDF('L','mm','Legal');
	}
	
	function Header()
	{
		$InterLigne = 5;
		$OuterLigne = 18;
		
		$this->SetFont(Arial,'',12);
		$this->Cell(0,$InterLigne,$this->agencyName,0,0,C);
		$this->Ln(6);
		
		$this->SetFont(Arial,B,12);
		$this->Cell(0,$InterLigne,"PERSONAL INFORMATION",0,0,C);
		$this->Ln(6);
		
		$this->SetFont(Arial,'',12);
		$this->Cell(0,$InterLigne,'CY  '.$this->intYear,0,0,C);
		$this->Ln(5);
		
		$this->intPageNo = $this->PageNo();
		
		$this->SetFont('Arial','',9);
		$this->Cell(0,5,'Page '.$this->intPageNo.' of {nb}', 0, 1, 'R');
		$this->Ln(1);
		
		$this->SetFont(Arial,B,10);
		$this->Cell(50,$InterLigne,"",0,0,C);
		$this->Cell(70,$InterLigne,"",0,0,C);
		$this->Cell(70,$InterLigne,"",0,0,C);
		$this->Cell(30,$InterLigne,"",0,0,C);
		$this->Cell(40,$InterLigne,"",0,0,C);
		$this->Cell(80,$InterLigne,"",0,0,C);
		$this->Ln(5);

		$this->SetFont(Arial,B,10);
		$this->SetFillColor(200,200,200);
		$this->Cell(50,$OuterLigne,"NAME",1,0,C,1);
		$this->Cell(70,$OuterLigne,"POSITION",1,0,C,1);
		$this->Cell(70,$OuterLigne,"EDUCATIONAL",1,0,C,1);
		$this->Cell(30,$OuterLigne,"SALARY",1,0,C,1);
		$this->Cell(40,$OuterLigne,"ACTUAL",1,0,C,1);
		$this->Cell(80,$OuterLigne,"TRAINING ATTENDED",1,0,C,1);
		$this->Ln(10);

		$this->Cell(50,$InterLigne,"",0,0,C);
		$this->Cell(70,$InterLigne,"",0,0,C);
		$this->Cell(70,$InterLigne,"ATTAINMENT",0,0,C);
		$this->Cell(30,$InterLigne,"GRADE",0,0,C);
		$this->Cell(40,$InterLigne,"SALARY/MONTH",0,0,C);
		$this->Cell(80,$InterLigne,"",0,0,C);
		$this->Ln(10);
	}
	
	function setYear($t_intYear)
	{
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

}  // End class

?>