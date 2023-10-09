<?
/* 
File Name: ReportPersonnelResigned.php (class folder)
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
Date of Revision: July 23, 2004 (Version 2.0.0)
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

class ReportPersonnelResigned extends FPDF
{
	
	var $strTitle;
	var $intPageNo;
	var $strMonthName, $intYear;

	//  Page Header
	function ReportPersonnelResigned()
	{
		$this->FPDF('P', 'mm', 'A4');
	}

	function Header()
	{	
		$this->SetFont('Arial','B',10);
		$this->Cell(0,6,'Republic of the Philippines', 0, 0, 'C');
		$this->Ln(5);
		$this->Cell(0,6,'Department of Science and Technology', 0, 0, 'C');
		$this->Ln(5);
		$this->Cell(0,6,$this->agencyName, 0, 0, 'C');		
		$this->Ln(10);
		$this->SetFont('Arial','',10);
		$this->Cell(0,6,'List of employees by Date Resigned', 0, 0, 'C');
		$this->Ln(5);
		$this->Cell(0,6,'AS OF' . " ' " . date("Y") , 0, 0, 'C');
		$this->Ln(10);
		
		$this->SetFont(Arial,'B',11);
		$this->SetFillColor(200,200,200);
		$this->Cell(90,10,"",LTR,0,C,1);
		$this->Cell(90,10,"",LTR,0,C,1);
		$this->Ln(5);
		
		$this->Cell(90,10,"NAME",LBR,0,C,1);
		$this->Cell(90,10,"DATE RESIGNED",LBR,0,C,1);
		$this->Ln(10);
				
	}
	
	function footer()
	{
		$this->intPageNo = $this->PageNo();
		$this->SetFont('Arial','',9);
		$this->Ln(10);
		$this->Cell(0,5,'Page '.$this->intPageNo.' of {nb}', 0, 1, 'R');
	}
	
		
	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
	}
	
	
	function setMonthYear($t_strMonthName, $t_strDay, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
		$this->strDay = $t_strDay;
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

	
} //end of class
	
?>