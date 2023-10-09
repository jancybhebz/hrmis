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
require('../hrmis/class/ReportMonthlyAccession.php');

class ReportMABody extends General
{
	var $objRprt;
	var $intCounter = 0;


	function printBody($t_intCounter, $t_strEmpNum , $t_strEmpName, $t_strBirthday, $t_strPositionDesc, $t_strAppointmentDesc, $t_strSGNumber, $t_strPersonnelAction, $t_strPositionDate)
	{
  		$this->objRprt->SetFont(Arial,'',10);
		$t_strNumName = $t_intCounter. "." ."     ".$t_strEmpName;
		$this->objRprt->Cell(70,10,$t_strNumName,1,0,L);              //  Name
		$this->objRprt->Cell(30,10,$t_strBirthday,1,0,C);             //  Date of birth
		$this->objRprt->Cell(70,10,$t_strPositionDesc,1,0,L);         //  Position Title
		$this->objRprt->Cell(40,10,$t_strAppointmentDesc,1,0,C);      //  Status of appointment
		$this->objRprt->Cell(25,10,$t_strSGNumber,1,0,C);              //  Salary Grade
		$this->objRprt->Cell(30,10,$t_strPersonnelAction,1,0,C);      //  Personnel Action
		$this->objRprt->Cell(30,10,$t_strPositionDate,1,0,C);         //  Effectivity Date Of Appointment
		$this->objRprt->Cell(30,10,' ',1,1,L);                      //  Remarks
	}
	  

	function generateReport()
	{
		$this->objRprt = new ReportMonthlyAccession;
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(10);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(10);
		$this->objRprt->SetAutoPageBreak("on", 50);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
	
		$objQuery = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPersonal.birthday, tblEmpPosition.positionCode,
									tblPosition.positionDesc, tblEmpPosition.appointmentCode, 
									tblAppointment.appointmentDesc, tblEmpPosition.salaryGradeNumber,
									tblEmpPosition.statusOfAppointment,tblEmpPosition.positionDate, 
									tblEmpPosition.contractEndDate, tblEmpPosition.personnelAction
							     FROM tblEmpPersonal
								  	INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblPosition
										ON tblEmpPosition.positionCode = tblPosition.positionCode
									INNER JOIN tblAppointment
										ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
							     ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename ASC");
								 
		$intPageCounter = 0;						 
		while($arrQuery = mysql_fetch_array($objQuery))
		 {
			$strEmpNum = $arrQuery['empNumber'];
			$strMiddleName = $arrQuery['middlename'];
			$strMiddleInitial = substr($strMiddleName, 0,1);
			$strEmpName = $arrQuery['surname'].", " .$arrQuery['firstname']." " .$strMiddleInitial. ".";
			$strBirthday = $arrQuery['birthday'];
			$strPositionCode = $arrQuery['positionCode'];
			$strPositionDesc = $arrQuery['positionDesc'];
			$strAppointmentDesc = $arrQuery['appointmentDesc'];
			$strSGNumber = $arrQuery['salaryGradeNumber'];
			$strStatusOfAppointment = $arrQuery['statusOfAppointment']; //Mode of Separation
			$strPositionDate = $arrQuery['positionDate'];
			$strPersonnelAction = $arrQuery['personnelAction'];
			$strContractEndDate = $arrQuery['contractEndDate'];
			$strPositionDateEx = explode ('-', $strPositionDate);
			$arrPositionYr = $strPositionDateEx[0];
			$arrPositionMonth = $strPositionDateEx[1];
			$arrPositionDay = $strPositionDateEx[2];
			$sesYear = $_SESSION['sesYear'];
			$sesMonth = $_SESSION['sesMonth'] ;
					
			if (($strStatusOfAppointment =='In-Service')&&($arrPositionYr == $sesYear) &&($arrPositionMonth == $sesMonth))
			{
				
				$this->intCounter++;
				$intPageCounter++;
				$this->printBody($this->intCounter,$strEmpNum ,$strEmpName, $strBirthday,$strPositionDesc,$strAppointmentDesc,$strSGNumber, $strPersonnelAction, $strPositionDate);
				
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