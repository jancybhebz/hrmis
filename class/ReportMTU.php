<?
/* 
File Name: ReportMTU.php 
----------------------------------------------------------------------
Purpose of this file: 
memorandum for tardy and undertime
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 15, 2004
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

require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/ReportHeaderFooter.php');

class ReportMTU extends General
{
	var $objRprt;
	
	function empInfo()
	{
		$objAgency = mysql_query("SELECT agencyName, abbreviation, address, salarySchedule FROM tblAgency");
		$arrAgency = mysql_fetch_array($objAgency);

		$objEmpInfo = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename
									FROM tblEmpPersonal
									INNER JOIN tblEmpPosition 
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									WHERE tblEmpPersonal.empNumber = '".$_SESSION['sesEmpNmbr']."'
										AND tblEmpPosition.dtrSwitch='Y'");

		$arrEmpInfo = mysql_fetch_array($objEmpInfo);
		$this->objRprt->AddPage();
		$this->bodyMTU($arrEmpInfo, $arrAgency);
	}
	function bodyMTU($t_arrEmpInfo, $t_arrAgency)
	{
		$strPrgrph = "Your Daily Time Records (DTR) for ".$_SESSION['sesMnthNm']." ".$_SESSION['sesYr']
					." showed that you exceeded the allowable limit of being tardy.  Please be reminded of the "
					."CSC rules and regulations on this matter.  This would serve as your warning.";

		$arrSgntry = $this->signatory();

		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 16);
		$this->objRprt->Cell(0, 10, "MEMORANDUM", 0, 0, "L");
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(10);
		$this->objRprt->Cell(30, 7, "NAME :", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 7, $t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["surname"], 0, 1, "L");
		
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(10);
		$this->objRprt->Cell(30, 7, "FROM :", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 7, strtoupper($arrSgntry["signatoryTitle"]), 0, 1, "L");

		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(10);
		$this->objRprt->Cell(30, 7, "SUBJECT :", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 7, "TARDINESS AND UNDERTIME", 0, 1, "L");

		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(10);
		$this->objRprt->Cell(30, 7, "DATE :", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 7, date("d F Y"), 0, 1, "L");

		$this->objRprt->Ln(10);
		$this->objRprt->MultiCell(0, 7, $strPrgrph, 0, 'J', 0);
		$this->objRprt->Ln(20);

		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(100);
		$this->objRprt->Cell(0, 7, strtoupper($arrSgntry["signatory"]), 0, 1, "C");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(100);
		$this->objRprt->Cell(0, 7, strtoupper($arrSgntry["signatoryTitle"]), 0, 0, "C");
	}
	
	function signatory()
	{
		$objSgntry = mysql_query("SELECT signatory, signatoryTitle FROM tblSignatory WHERE designation='Director'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		return $arrSgntry;
	}
	
	
	function generateReport()
	{
		$this->objRprt = new ReportHeaderFooter;
		
		$this->objRprt->SetLeftMargin(15);
		$this->objRprt->SetRightMargin(15);		
		
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		$this->empInfo();
		$this->objRprt->Output();
	}
}
?>