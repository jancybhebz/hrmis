<?
/* 
File Name: ReportLeave.php 
----------------------------------------------------------------------
Purpose of this file: 
Leave application slip
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

require_once("../hrmis/class/Attendance.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/ReportHeaderFooter.php');

class ReportLeave extends Attendance
{
	var $objRprt;
	
	function empInfo()
	{
		$objAgency = mysql_query("SELECT agencyName, abbreviation, address, salarySchedule FROM tblAgency");
		$arrAgency = mysql_fetch_array($objAgency);
		$objEmpInfo = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.divisionCode, tblEmpPosition.actualSalary,
									tblDivision.divisionHead, tblDivision.divisionHeadTitle,
									tblPosition.positionDesc
									FROM tblEmpPersonal
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblDivision
											ON tblEmpPosition.divisionCode = tblDivision.divisionCode
										INNER JOIN tblPosition
											ON tblPosition.positionCode = tblEmpPosition.positionCode
									WHERE tblEmpPersonal.empNumber = '".$_SESSION['sesEmpNmbr']."'");
		$arrEmpInfo = mysql_fetch_array($objEmpInfo);
		$this->objRprt->AddPage();
		$this->bodyLeave($arrEmpInfo, $arrAgency);
	}

	function getLeaveType($t_strLeaveCode)
	{
		$objLv = mysql_query("SELECT leaveType FROM tblLeave WHERE leaveCode='$t_strLeaveCode'");
		$arrLv = mysql_fetch_array($objLv);
		return $arrLv["leaveType"];
	}
	
	function bodyLeave($t_arrEmpInfo, $t_arrAgency)
	{
		$dtmDateFrom = $this->combineDate($_SESSION['sesYrFr'], $_SESSION['sesMnFr'], $_SESSION['sesDyFr']);
		$dtmDateTo = $this->combineDate($_SESSION['sesYrTo'], $_SESSION['sesMnTo'], $_SESSION['sesDyTo']);		
		$strLeaveType = $this->getLeaveType($_SESSION['sesLvTyp']);
		
		$dtmMonth = date("m");
		$dtmYear = date("Y");
		$arrPreMonth = $this->getPreMonth($dtmMonth, $dtmYear);
		
		$intVL = $this->getLeftSLVL($arrPreMonth["month"], $arrPreMonth["year"], $t_arrEmpInfo["empNumber"], "VL");
		if($intVL < 0)
		{
			$intVL = 0;
		}
		$intSL = $this->getLeftSLVL($arrPreMonth["month"], $arrPreMonth["year"], $t_arrEmpInfo["empNumber"], "SL");
		if($intSL < 0)
		{
			$intSL = 0;						
		}
		
		$this->objRprt->SetFont('Arial', "", 8);
		$this->objRprt->Cell(0, 4, "CSC Form No. 6", 0, 1, "L");
		$this->objRprt->Cell(0, 4, "Revised 1984", 0, 0, "L");		
		
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 14);
		$this->objRprt->Cell(0, 5, "APPLICATION FOR LEAVE", 0, 0, "C");	

		$this->objRprt->Line(15, 60, 200, 60);
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(45, 5, $t_arrAgency["abbreviation"], 0, 0, "C");
		$this->objRprt->Cell(45, 5, $t_arrEmpInfo["surname"], 0, 0, "C");
		$this->objRprt->Cell(45, 5, $t_arrEmpInfo["firstname"], 0, 0, "C");
		$this->objRprt->Cell(45, 5, $t_arrEmpInfo["middlename"], 0, 1, "C");

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(45, 5, "OFFICE/AGENCY", 0, 0, "C");
		$this->objRprt->Cell(45, 5, "NAME  (Last)", 0, 0, "C");
		$this->objRprt->Cell(45, 5, "(First)", 0, 0, "C");
		$this->objRprt->Cell(45, 5, "(Middle)", 0, 1, "C");
		$this->objRprt->Line(15, 72, 200, 72);
		
		$this->objRprt->Ln(2);
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(60, 4, date("m/d/Y"), 0, 0, "C");
		$this->objRprt->Cell(60, 4, $t_arrEmpInfo["positionDesc"], 0, 0, "C");
		$this->objRprt->Cell(60, 4, number_format($t_arrEmpInfo["actualSalary"], 2,".",","), 0, 1, "C");

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(60, 4, "DATE OF FILING", 0, 0, "C");
		$this->objRprt->Cell(60, 4, "POSITION", 0, 0, "C");
		$this->objRprt->Cell(60, 4, "SALARY (Monthly)", 0, 0, "C");
		
		$this->objRprt->Line(15, 83, 200, 83);
		$this->objRprt->Ln(6);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, "DETAILS OF APPLICATION", 0, 0, "C");	
		$this->objRprt->Line(15, 90, 200, 90);

		$this->objRprt->Ln(7);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, "Type of Leave:", 0, 0, "L");
		$this->objRprt->Cell(90, 5, "Where leave will be spent:", 0, 1, "L");

		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(90, 5, "   ".$strLeaveType, 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, "   In case of vacation leave:", 0, 1, "L");

		$this->objRprt->Cell(90);
		$this->objRprt->SetFont('Arial', "B", 9);
		if($_SESSION["sesSpcfyLv"] == "Local")
		{
			$this->objRprt->Cell(90, 5, "       (*) within the Philippines", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(90, 5, "       ( ) within the Philippines", 0, 1, "L");
		}
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, "Number of Working Days Applied For:", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 9);		
		if($_SESSION["sesSpcfyLv"] == "Abroad")
		{
			$this->objRprt->Cell(90, 5, "       (*) abroad", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(90, 5, "       ( ) abroad", 0, 1, "L");
		}

		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(90, 5, "   ".$_SESSION["sesLvDy"]." day", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(18, 5, "   Specify:", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "", 10);
		if ($_SESSION["sesLvTyp"] != "VL")
		{
			$this->objRprt->MultiCell(0, 5, "", 0, 'J', 0);
		}
		else
		{
			$this->objRprt->MultiCell(0, 5, $_SESSION['sesRsn'], 0, 'J', 0);
		}

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, "Inclusive Dates:", 0, 0, "L");
		$this->objRprt->Cell(90, 5, "   In case of sick leave:", 0, 1, "L");

		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(90, 5, "   from ".date("m/d/Y", strtotime($dtmDateFrom))." to ".date("m/d/Y", strtotime($dtmDateTo)), 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 9);
		if($_SESSION["sesSpcfyLv"] == "In-patient")
		{		
			$this->objRprt->Cell(90, 5, "      (*) In-patient", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(90, 5, "      ( ) In-patient", 0, 1, "L");
		}
		
		$this->objRprt->Cell(90);
		if($_SESSION["sesSpcfyLv"] == "Out-patient")
		{		
			$this->objRprt->Cell(90, 5, "      (*) Out-patient", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(90, 5, "      ( ) Out-patient", 0, 1, "L");
		}
		
		$this->objRprt->Cell(90);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(18, 5, "   Specify:", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "", 10);
		if ($_SESSION["sesLvTyp"] != "SL")
		{
			$this->objRprt->MultiCell(0, 5, "", 0, 'J', 0);
		}
		else
		{
			$this->objRprt->MultiCell(0, 5, $_SESSION['sesRsn'], 0, 'J', 0);
		}
		
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90);
		$this->objRprt->Cell(90, 5, "Commutations:", 0, 1, "L");
		$this->objRprt->Cell(90);
		$this->objRprt->SetFont('Arial', "B", 9);		
		$this->objRprt->Cell(25, 5, "   ( ) required", 0, 0, "L");
		$this->objRprt->Cell(45, 5, "(*) not required", 0, 1, "L");

		$this->objRprt->Ln(7);
		$this->objRprt->Cell(90);
		$this->objRprt->SetFont('Arial', "B", 10);		
		$this->objRprt->Cell(90, 5, "SIGNATURE OF APPLICANT", 0, 1, "C");

		$this->objRprt->Line(15, 170, 200, 170);
		$this->objRprt->Ln(3);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, "DETAILS OF ACTION ON APPLICATION", 0, 0, "C");	
		$this->objRprt->Line(15, 177, 200, 177);
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, "Certification of Leave Credits as of:", 0, 0, "L");
		$this->objRprt->Cell(90, 5, "Recomendations:", 0, 1, "L");		

		$this->objRprt->SetFont('Arial', "", 10);		
		$this->objRprt->Cell(90, 5, "   ".$this->intToMonthFull($arrPreMonth["month"])." ".$arrPreMonth["year"], 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 9);
		
		$this->objRprt->Cell(90, 5, "   ( ) Approval", 0, 1, "L");
		$this->objRprt->Cell(90);
		$this->objRprt->Cell(40, 5, "   ( ) Disapproval due to ", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->MultiCell(0, 5, "", 0, 'J', 0);
		
		$this->objRprt->Cell(30, 5, "Vacation", "TR", 0, "C");
		$this->objRprt->Cell(30, 5, "Sick", "TR", 0, "C");
		$this->objRprt->Cell(30, 5, "Total", "T", 1, "C");		

		$this->objRprt->Cell(30, 5, number_format($intVL,3,".",","), "BR", 0, "C");
		$this->objRprt->Cell(30, 5, number_format($intSL,3,".",","), "BR", 0, "C");
		$this->objRprt->Cell(30, 5, number_format($intVL+$intSL,3,".",","), "B", 1, "C");
		
		$arrSgntry = $this->signatory($t_arrEmpInfo["tblEmpNumber"], $t_arrEmpInfo["divisionHead"], $t_arrEmpInfo["divisionHeadTitle"]);
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrHRSgntry = mysql_fetch_array($objSgntry);

		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, strtoupper($arrHRSgntry["signatory"]), 0, 0, "C");
		$this->objRprt->Cell(90, 5, strtoupper($arrSgntry["signatory"]), 0, 1, "C");
		$this->objRprt->Cell(90, 5, "Personnel Officer", 0, 0, "C");
		$this->objRprt->Cell(90, 5, "Authorized Official", 0, 1, "C");
		
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(90, 5, "APPROVED FOR:", 0, 0, "L");
		$this->objRprt->Cell(90, 5, "DISAPPROVED DUE TO:", 0, 1, "L");

		$this->objRprt->SetFont('Arial', "B", 9);
		$this->objRprt->Cell(27, 5, "( ) Days with pay", 0, 0, "L");
		$this->objRprt->Cell(33, 5, "( ) Days without pay", 0, 0, "L");
		$this->objRprt->Cell(30, 5, "( ) Others (specify)", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "", 10);		
		$this->objRprt->MultiCell(0, 5, "", 0, 'J', 0);
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Line(80, 250, 130, 250);
		$this->objRprt->Cell(0, 5, "(Signature)", 0, 0, "C");
		$this->objRprt->Ln(7);
		$this->objRprt->Cell(0, 5, strtoupper($arrSgntry["signatory"]), 0, 1, "C");
		$this->objRprt->Cell(0, 5, "Authorized Official", 0, 1, "C");		
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