<?
/* 
File Name: ReportOB.php 
----------------------------------------------------------------------
Purpose of this file: 
OB application slip
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

class ReportOB extends General
{
	var $objRprt;
	
	function empInfo()
	{
		$objAgency = mysql_query("SELECT agencyName, abbreviation, address, salarySchedule FROM tblAgency");
		$arrAgency = mysql_fetch_array($objAgency);
		
		$objEmpInfo = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.divisionCode, tblDivision.divisionHead, 
									tblDivision.divisionHeadTitle
									FROM tblEmpPersonal
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblDivision
											ON tblEmpPosition.divisionCode = tblDivision.divisionCode										
									WHERE tblEmpPersonal.empNumber = '".$_SESSION['sesEmpNmbr']."'");
		$arrEmpInfo = mysql_fetch_array($objEmpInfo);
		$this->objRprt->AddPage();
		$this->bodyOB($arrEmpInfo, $arrAgency);
	}
	function bodyOB($t_arrEmpInfo, $t_arrAgency)
	{
		$this->objRprt->SetFont('Arial', "B", 16);
		$this->objRprt->Cell(0, 5, strtoupper($t_arrAgency["agencyName"]), 0, 1, "C");
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, $t_arrAgency["address"], 0, 0, "C");	
		$this->objRprt->Ln(15);
		
		$this->objRprt->SetFont('Arial', "BU", 16);
		$this->objRprt->Cell(0, 5, "PASS SLIP", 0, 0, "C");
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(140, 5, "DATE:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 5, date( "m/d/Y"), 0, 0, "L");
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(30, 5, "Name:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(70, 5, $t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["surname"], 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(30, 5, "Division:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(40, 5, $t_arrEmpInfo["divisionCode"], 0, 0, "L");

		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(50, 10, "Destination:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 10, $_SESSION['sesPlc'], 0, 1, "L");

		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(50, 6, "Purpose:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->MultiCell(0, 6, $_SESSION["sesPrps"], 0, 'J', 0);

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(50, 5, "Date From:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$dtmDateFrom = $this->combineDate($_SESSION['sesYrFr'], $_SESSION['sesMnFr'], $_SESSION['sesDyFr']);
		$this->objRprt->Cell(30, 5, date("m/d/Y", strtotime($dtmDateFrom)), 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(20, 5, "Date To:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$dtmDateTo = $this->combineDate($_SESSION['sesYrTo'], $_SESSION['sesMnTo'], $_SESSION['sesDyTo']);
		$this->objRprt->Cell(40, 5, date("m/d/Y", strtotime($dtmDateTo)), 0, 0, "L");		

		$this->objRprt->Ln(7);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(50, 5, "Time From:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$dtmTimeFrom = $this->combineHrMnSc($_SESSION['sesHrFr'], $_SESSION['sesMntFr'], $_SESSION['sesScFr']);
		$dtmTimeFrom = $this->combineTime($dtmTimeFrom, $_SESSION['sesTmFr']);
		$this->objRprt->Cell(30, 5, $dtmTimeFrom, 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(20, 5, "Time To:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$dtmTimeTo = $this->combineHrMnSc($_SESSION['sesHrTo'], $_SESSION['sesMntTo'], $_SESSION['sesScTo']);
		$dtmTimeTo = $this->combineTime($dtmTimeTo, $_SESSION['sesTmTo']);	
		$this->objRprt->Cell(40, 5, $dtmTimeTo, 0, 0, "L");		

		if($_SESSION['sesOB'] == 'Y')
		{
			$strOfficial = "Yes";
		}
		else
		{
			$strOfficial = "No";
		}
		
		$this->objRprt->Ln(7);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(50, 5, "Official:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 5, $strOfficial, 0, 1, "L");
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(100, 5, "", 0, 0, "C");
		$this->objRprt->Cell(0, 5, "NOTED BY", 0, 1, "L");
		
		$arrSgntry = $this->signatory($t_arrEmpInfo["empNumber"], $t_arrEmpInfo["divisionHead"], $t_arrEmpInfo["divisionHeadTitle"]);
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrHRSgntry = mysql_fetch_array($objSgntry);

		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(85, 5, strtoupper($arrSgntry["signatory"]), 0, 0, "C");
		$this->objRprt->Cell(85, 5, strtoupper($arrHRSgntry["signatory"]), 0, 1, "C");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(85, 5, strtoupper($arrSgntry["signatoryTitle"]), 0, 0, "C");
		$this->objRprt->Cell(85, 5, strtoupper($arrHRSgntry["signatoryTitle"]), 0, 1, "C");
		
	}
	
	function signatory($t_strEmpNmbr, $t_strDivisionHead, $t_strDivisionHeadTitle)
	{
		$objDivSgntry = mysql_query("SELECT divisionHead FROM tblDivision WHERE empNumber='$t_strEmpNmbr'");
		if(mysql_num_rows($objDivSgntry))
		{
			//chief un
			$objSgntry = mysql_query("SELECT signatory, signatoryTitle FROM tblSignatory WHERE designation='Director'");
			$arrSgntry = mysql_fetch_array($objSgntry);
			return $arrSgntry;
		}
		else
		{
			$arrSgntry = array("signatory"=>$t_strDivisionHead, "signatoryTitle"=>$t_strDivisionHeadTitle);
			return $arrSgntry;
		}
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