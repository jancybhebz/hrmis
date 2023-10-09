<?
/* 
File Name: ReportMSBody.php (class folder)
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
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportCSCPlantillaCasualApp.php');

class ReportCSCPCABody extends General
{
	var $objRprt;
	var $intCounter = 0;
	

	function printBody($t_intCounter, $t_strEmpNum, $t_strEmpName, $t_strPositionDesc, $t_strAppointmentDesc, $t_strSGNumber, $t_strPositionDate, $t_strEndOfContract, $t_strWorkNature, $t_intActualSalary, $t_strDivisionCode, $t_strFirstDayAgency)
	{
		$Title = 5;
		$t_strNumName = $t_intCounter. "." ."     ".$t_strEmpName;
		$this->objRprt->SetFont(Arial,'',6);
		$this->objRprt->Cell(50,$Title,$t_strNumName,1,0,L);					//  Name of Appointee/s
		$this->objRprt->Cell(35,$Title,$t_strPositionDesc,1,0,L);				//  Position
		$this->objRprt->Cell(10,$Title,"-",1,0,C); 								//  Level
		$this->objRprt->Cell(15,$Title,$t_strSGNumber,1,0,C);					//  SG
		$this->objRprt->Cell(20,$Title,$t_intActualSalary . '/mo.',1,0,C);		//  Daily Wage/Salary
		$this->objRprt->Cell(20,$Title,$t_strPositionDate,1,0,C);				//  Period of (From)
		$this->objRprt->Cell(20,$Title,$t_strEndOfContract,1,0,C);				//  Employment (To)
		//$dtmDate = date("Y-mm-dd");
		//$dtmCurrentYear = substr($dtmDate,0,3)
		//$dtmCurrentDate = $dtmCurrentYear . 'mm-dd'
		$t_strPreviousYear = substr($t_strFirstDayAgency,0,4);
		$t_strPreviousMonth = substr($t_strFirstDayAgency,5,6);
		$t_strPreviousDay = substr($t_strFirstDayAgency,8,9);
	    $dtmCurrentDate = $t_strPreviousYear . $t_strPreviousMonth . $t_strPreviousDay;
		
		if ($t_strFirstDayAgency == $dtmCurrentDate) 
		{
		$this->objRprt->Cell(40,$Title,$t_strFirstDayAgency,1,0,C);				//  If Renewal
		$this->objRprt->Ln(5);
		} else {
		$this->objRprt->Cell(40,$Title,"-",1,0,C);				//  If Renewal
		$this->objRprt->Ln(5);		
		}
		
	}
	  

	function generateReport()
	{
		$this->objRprt = new ReportCSCPlantillaCasualApp;
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(3);
		$this->objRprt->SetRightMargin(10);
		$this->objRprt->SetTopMargin(10);
		$this->objRprt->SetAutoPageBreak("on", 50);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
	
		$objQuery = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.positionCode, tblEmpPosition.actualSalary,
									tblPosition.positionDesc, tblEmpPosition.appointmentCode, 
									tblAppointment.appointmentDesc, tblEmpPosition.salaryGradeNumber,
									tblEmpPosition.statusOfAppointment, tblEmpPosition.positionDate, 
									tblEmpPosition.contractEndDate, tblEmpPosition.personnelAction,
									tblEmpPosition.nature, tblDivision.divisionCode,
									tblEmpPosition.firstDayAgency
							     FROM tblEmpPersonal
								  	INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblPosition
										ON tblEmpPosition.positionCode = tblPosition.positionCode
									INNER JOIN tblAppointment
										ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								 WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
								 	AND tblEmpPosition.appointmentCode = 'Cas'
							     ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname,
								 		tblEmpPersonal.middlename ASC");
								 
		$intPageCounter = 0;						 
		while($arrQuery = mysql_fetch_array($objQuery))
		 {
			$strEmpNum = $arrQuery['empNumber'];
			$strMiddleName = $arrQuery['middlename'];
			$strMiddleInitial = substr($strMiddleName, 0,1);
			$strEmpName = $arrQuery['surname'].", " .$arrQuery['firstname']." " .$strMiddleInitial. ".";
			$strPositionCode = $arrQuery['positionCode'];
			$strPositionDesc = $arrQuery['positionDesc'];
			$strAppointmentDesc = $arrQuery['appointmentDesc'];
			$strDivisionCode = $arrQuery['divisionCode'];
			$strSGNumber = "1";
			$strStatusOfAppointment = $arrQuery['statusOfAppointment']; 
			$strPositionDate = $arrQuery['positionDate'];
			$strPersonnelAction = $arrQuery['personnelAction'];
			$strContractEndDate = $arrQuery['contractEndDate'];
			$strFirstDayAgency = $arrQuery['firstDayAgency'];
			$strPositionDateEx = explode ('-', $strPositionDate);
			$arrPositionYr = $strPositionDateEx[0];
			$arrPositionMonth = $strPositionDateEx[1];
			$arrPositionDay = $strPositionDateEx[2];
			$intActualSalary = $arrQuery['actualSalary'];
			$strNature = $arrQuery['nature'];
			$strWorkNature = substr($strNature,0,1);
			$sesYear = $_SESSION['sesYear'];
			$sesMonth = $_SESSION['sesMonth'];
			$sesDivision = $_SESSION['sesDivision'];
			$strEndOfContract = date("Y-12-31");
					
			if ($strStatusOfAppointment == 'In-Service' && $strDivisionCode == $sesDivision)
			//&&($arrPositionYr == $sesYear) &&($arrPositionMonth == $sesMonth))
			{
				
				$intCounter++;
				$intPageCounter++;
				$this->printBody($intCounter, $strEmpNum, $strEmpName, $strPositionDesc,$strAppointmentDesc, $strSGNumber, $strPositionDate, $strEndOfContract, $strWorkNature, $intActualSalary, $strDivisionCode, $strFirstDayAgency);
				
				if ($intPageCounter == 6)		
				{
					$this->objRprt->AddPage();
					$intPageCounter = 0;
				}
			}
		  }
		 
		 $this->objRprt->Output();
	  }
				

}  // End Class

?>