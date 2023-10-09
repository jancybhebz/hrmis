<?
/* 
File Name: ReportPAGEBody.php (class folder)
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
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportPersonnelAge.php');

class ReportPAGEBody extends General
{
	var $objRprt;
	var $intCounter = 0;

	// Body
	function printBody($t_intCounter, $t_strEmpName,$t_age)
	{
		$InterLigne = 7;
		$Percentage = 19; 
		$Height = 10;
		
		$strNumEmpName = $t_intCounter.".    ".$t_strEmpName;
		$this->objRprt->SetFont(Arial,'B',10);
		$this->objRprt->SetFont(Arial,'',10);
		$this->objRprt->Cell(100,5,$strNumEmpName,1,0,L);
		$this->objRprt->Cell(65,5,$t_age,1,0,C);
		$this->objRprt->Ln(5);
		
	}
	
	function printHeader()
	{
		$InterLigne = 7;
		$Percentage = 19; 
		$Height = 10;
		
		$this->objRprt->SetFont(Arial,'B',11);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(100,10,"",LTR,0,C,1);
		$this->objRprt->Cell(65,10,"",LTR,0,C,1);
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(100,10,"NAME OF EMPLOYEE",LBR,0,C,1);
		$this->objRprt->Cell(65,10,"AGE",LBR,0,C,1);
		$this->objRprt->Ln(10);
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportPersonnelAge;
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesDay'], $_SESSION['sesYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(25);
		$this->objRprt->SetRightMargin(25);
		$this->objRprt->SetTopMargin(18);
		$this->objRprt->SetAutoPageBreak("on",25);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		$objEmpAge = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname,tblEmpPersonal.middlename,
										 tblEmpPersonal.birthday,tblEmpPosition.statusOfAppointment
								   FROM tblEmpPersonal
								   INNER JOIN tblEmpPosition
								   		ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								   ORDER BY tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,tblEmpPersonal.middlename asc");
		$this->printHeader();
		$intCounter =0;						   
		while($arrEmpAge = mysql_fetch_array($objEmpAge))
		{
			$strEmpNum = $arrEmpAge['empNumber'];
			$strStatusOfAppointment = $arrEmpAge['statusOfAppointment'];
			$strMidName = $arrEmpAge['middlename'];
			$strMiddleName = substr($strMidName, 0,1);
			$strEmpName = $arrEmpAge['surname']. ",  ".$arrEmpAge['firstname']. " ".$strMiddleName. ".";
			$strBirthDay = $arrEmpAge['birthday'];
			$arrBirthDayEx = explode('-',$strBirthDay);
			$arrBDYear = intval($arrBirthDayEx[0]);
			$arrBDMonth = intval($arrBirthDayEx[1]);
			$arrBDDay = intval($arrBirthDayEx[2]);

			$curDateYr = date("Y");
			$curDateMonth = date("m");
			$curDateDay = date("d");
			
			
			if($strStatusOfAppointment == 'In-Service')
			{		
				if($arrBDMonth < $curDateMonth)
				{
					$intCounter++;
					$age = $curDateYr - $arrBDYear;
									
				}			
				elseif($arrBDMonth > $curDateMonth)
				{
					$intCounter++;
					$age = ($curDateYr - $arrBDYear)-1;
				}
				elseif(($arrBDMonth == $curDateMonth)&&($arrBDDay < $curDateDay))
				{
					$intCounter++;
					$age = $curDateYr - $arrBDYear;
				}
				elseif(($arrBDMonth == $curDateMonth)&&($arrBDDay > $curDateDay))
				{
					$intCounter++;
					$age = ($curDateYr - $arrBDYear)-1;
				}
				elseif(($arrBDMonth == $curDateMonth)&&($arrBDDay == $curDateDay))
				{
					$intCounter++;
					$age = $curDateYr - $arrBDYear;
				}
			$this->printBody($intCounter,$strEmpName,$age);
			 }
	    
		 }
		$this->objRprt->Output();
	}
				

}  // End Class

?>