<?
/* 
File Name: ReportPPBody.php (class folder)
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
require('../hrmis/class/ReportPersonnelPlantilla.php');

class ReportPPBody extends General
{
	var $objRprt;
	var $intCounter = 0;
	var $strDivName = " ";

	// Body
	function printBody($t_intCounter, $t_strName, $t_strSex, $t_strBirthday, $t_intTin, $t_strPositionDesc, $t_strItemNumber, $t_strAuthorizeSalary, $t_strActualSalary, $t_strStepNumber, $t_strSalaryGradeNumber, $t_strAppointmentCode, $t_strPositionDate, $t_strFirstDayAgency, $t_strExamType, $t_strWorkNature) 
	{
		$InterLigne = 4;

		$t_strNameCmbne = $t_intCounter."."."   ".$t_strName;

		//  body first column
		$this->objRprt->SetFont(Arial,'B',7);
		$this->objRprt->Cell(40,$InterLigne,$t_strItemNumber,L,0,L);		//  Item Number
		$this->objRprt->Cell(45,$InterLigne,$t_strPositionDesc . ' - ' . $t_strSalaryGradeNumber,L,0,L);				//  Position Title and Salary Grade
		$this->objRprt->Cell(20,$InterLigne,$t_strAuthorizeSalary,LR,0,L);	//  Annual Salary - Authorized
		$this->objRprt->Cell(20,$InterLigne,$t_strActualSalary,LR,0,L);		//  Annual Salary - Actual
		$this->objRprt->Cell(5,$InterLigne,$t_strStepNumber,L,0,L);			//  Step
		$this->objRprt->Cell(10,$InterLigne,$_SESSION['sesAreaCode'],LR,0,C);						//  Area - Code
		$this->objRprt->Cell(10,$InterLigne,$_SESSION['sesAreaType'],LR,0,C);						//  Area - Type
		$this->objRprt->Cell(5,$InterLigne,$t_strWorkNature,L,0,L);			//  LVL
		$this->objRprt->Cell(25,$InterLigne,$_SESSION['sesAttribution'],L,0,C);						//  P/P/A/ Attribution
		//  Second Column
		$this->objRprt->Cell(50,$InterLigne,$t_strNameCmbne,L,0,L);			//  Name of Incumbent
		$this->objRprt->Cell(5,$InterLigne,$t_strSex,L,0,C);				//  Sex
		$this->objRprt->Cell(20,$InterLigne,$t_strBirthday,L,0,C);			//  Date of Birth
		$this->objRprt->Cell(20,$InterLigne,$t_intTin,L,0,C);				//  TIN
		$this->objRprt->Cell(20,$InterLigne,$t_strFirstDayAgency,L,0,C);	//  Date of Original Appointment
		$this->objRprt->Cell(20,$InterLigne,$t_strPositionDate,L,0,C);		//  Date of Last Promotion
		$this->objRprt->Cell(10,$InterLigne,$t_strAppointmentCode,L,0,C);	//  Status
		$this->objRprt->Cell(25,$InterLigne,$t_strExamType,LR,0,L);			//  Civil Service Eligibility
		$this->objRprt->Ln(4);

	}
	
	function printDivisionName($t_intDivisionCount, $t_strDivName)
	{
		$InterLigne = 4;

		//  body first column division name
		$this->objRprt->Cell(40,$InterLigne,'',L,0,L);				//  Item Number
		$this->objRprt->Cell(45,$InterLigne,'',L,0,C);				//  Position Title and Salary Grade
		$this->objRprt->Cell(20,$InterLigne,'',LR,0,C);				//  Annual Salary - Authorized
		$this->objRprt->Cell(20,$InterLigne,'',LR,0,C);				//  Annual Salary - Authorized
		$this->objRprt->Cell(5,$InterLigne,'',L,0,C);				//  Step
		$this->objRprt->Cell(10,$InterLigne,'',LR,0,C);				//  Area - Code
		$this->objRprt->Cell(10,$InterLigne,'',LR,0,C);				//  Area - Code
		$this->objRprt->Cell(5,$InterLigne,'',L,0,C);				//  LVL
		$this->objRprt->Cell(25,$InterLigne,'',L,0,C);				//  P/P/A/ Attribution
		//  Second Column
		$this->objRprt->Cell(50,$InterLigne,'',L,0,C);				//  Name of Incumbent
		$this->objRprt->Cell(5,$InterLigne,'',L,0,C);				//  Sex
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  Date of Birth
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  TIN
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  Date of Original Appointment
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  Date of Last Promotion
		$this->objRprt->Cell(10,$InterLigne,'',L,0,C);				//  Status
		$this->objRprt->Cell(25,$InterLigne,'',LR,0,C);				//  Civil Service Eligibility
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(40,$InterLigne,$t_intDivisionCount . '.' . '  ' . strtoupper($t_strDivName),L,0,L);		//  Item Number
		$this->objRprt->Cell(45,$InterLigne,'',L,0,C);				//  Position Title and Salary Grade
		$this->objRprt->Cell(20,$InterLigne,'',LR,0,C);				//  Annual Salary - Authorized
		$this->objRprt->Cell(20,$InterLigne,'',LR,0,C);				//  Annual Salary - Authorized
		$this->objRprt->Cell(5,$InterLigne,'',L,0,C);				//  Step
		$this->objRprt->Cell(10,$InterLigne,'',LR,0,C);				//  Area - Code
		$this->objRprt->Cell(10,$InterLigne,'',LR,0,C);				//  Area - Code
		$this->objRprt->Cell(5,$InterLigne,'',L,0,C);				//  LVL
		$this->objRprt->Cell(25,$InterLigne,'',L,0,C);				//  P/P/A/ Attribution
		//  Second Column
		$this->objRprt->Cell(50,$InterLigne,'',L,0,C);				//  Name of Incumbent
		$this->objRprt->Cell(5,$InterLigne,'',L,0,C);				//  Sex
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  Date of Birth
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  TIN
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  Date of Original Appointment
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  Date of Last Promotion
		$this->objRprt->Cell(10,$InterLigne,'',L,0,C);				//  Status
		$this->objRprt->Cell(25,$InterLigne,'',LR,0,C);				//  Civil Service Eligibility
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(40,$InterLigne,'',L,0,L);				//  Item Number
		$this->objRprt->Cell(45,$InterLigne,'',L,0,C);				//  Position Title and Salary Grade
		$this->objRprt->Cell(20,$InterLigne,'',LR,0,C);				//  Annual Salary - Authorized
		$this->objRprt->Cell(20,$InterLigne,'',LR,0,C);				//  Annual Salary - Authorized
		$this->objRprt->Cell(5,$InterLigne,'',L,0,C);				//  Step
		$this->objRprt->Cell(10,$InterLigne,'',LR,0,C);				//  Area - Code
		$this->objRprt->Cell(10,$InterLigne,'',LR,0,C);				//  Area - Code
		$this->objRprt->Cell(5,$InterLigne,'',L,0,C);				//  LVL
		$this->objRprt->Cell(25,$InterLigne,'',L,0,C);				//  P/P/A/ Attribution
		//  Second Column
		$this->objRprt->Cell(50,$InterLigne,'',L,0,C);				//  Name of Incumbent
		$this->objRprt->Cell(5,$InterLigne,'',L,0,C);				//  Sex
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  Date of Birth
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  TIN
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  Date of Original Appointment
		$this->objRprt->Cell(20,$InterLigne,'',L,0,C);				//  Date of Last Promotion
		$this->objRprt->Cell(10,$InterLigne,'',L,0,C);				//  Status
		$this->objRprt->Cell(25,$InterLigne,'',LR,0,C);				//  Civil Service Eligibility
		$this->objRprt->Ln(2);

	 }	//  end of function print division name
	
	function generateReport()
	{
		$this->objRprt = new ReportPersonnelPlantilla;
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesDay'], $_SESSION['sesYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(3);
		$this->objRprt->SetRightMargin(0);
		$this->objRprt->SetTopMargin(10);
		$this->objRprt->SetAutoPageBreak("on",30);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		$objExamType = mysql_query("SELECT tblExamType.examCode, 
											tblExamType.examDesc
										FROM tblExamType 
										ORDER BY tblExamType.examCode, tblExamType.examDesc asc");
		$arrExamType = mysql_fetch_array($objExamType);
		$t_strExamCode = $arrExamType['examCode'];
		$t_strExamDesc = $arrExamType['examDesc'];
		
		$objDivision = mysql_query("SELECT tblDivision.divisionCode, tblDivision.divisionName
											  FROM tblDivision
								  ORDER BY tblDivision.divisionCode,tblDivision.divisionName asc");
	
		$intDivisionCount = 0;
		while($arrDivision = mysql_fetch_array($objDivision))
		{
			$intDivisionCount++;
			$strDivCode = $arrDivision['divisionCode'];
			$strDivName = $arrDivision['divisionName'];
			
						
			$objPersonnel = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname,
			 								tblEmpPersonal.firstname, tblEmpPersonal.middlename,
											tblEmpPersonal.sex, tblEmpPersonal.birthday,
											tblEmpPosition.divisionCode, tblDivision.divisionName,
											tblEmpPosition.positionCode, tblPosition.positionDesc,
											tblEmpPosition.salaryGradeNumber, tblEmpPosition.itemNumber,
											tblEmpPosition.authorizeSalary, tblEmpPosition.actualSalary,
											tblEmpPosition.stepNumber, tblEmpPosition.positionDate,
											tblEmpPosition.appointmentCode, tblEmpPosition.firstDayAgency,
											tblEmpPosition.statusOfAppointment, tblEmpPersonal.tin, 
											tblEmpExam.examCode, tblEmpPosition.nature,
											tblExamType.examDesc, tblExamType.examType
										 FROM tblEmpPersonal
										 	INNER JOIN tblEmpPosition
												ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
											INNER JOIN tblPosition
												ON tblEmpPosition.positionCode = tblPosition.positionCode
											INNER JOIN tblDivision
												ON tblEmpPosition.divisionCode = tblDivision.divisionCode
										 	INNER JOIN tblEmpExam
												ON tblEmpPersonal.empNumber = tblEmpExam.empNumber
											INNER JOIN tblExamType
												ON tblEmpExam.examCode = tblExamType.examCode
										 WHERE tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
										 	AND tblDivision.divisionCode ='$strDivCode'
											AND tblEmpExam.examCode = tblExamType.examCode
										 ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname,
										 	tblEmpPersonal.middlename asc, tblEmpExam.examCode desc");
			
			$this->printDivisionName($intDivisionCount, $strDivName);
			
			$intCounter = 0;		
			while($arrPersonnel = mysql_fetch_array($objPersonnel))
			{
				$strEmpNum = $arrPersonnel['empNumber'];
				$strMN =  $arrPersonnel['middlename'];
				$strMiddleName = substr($strMN, 0,1);
				$strName = $arrPersonnel['surname']. "," .$arrPersonnel['firstname']. " ".$strMiddleName. ".";
				$strSex = $arrPersonnel['sex'];
				$intTin = $arrPersonnel['tin'];
				$strBirthday = $arrPersonnel['birthday'];
				$strDivisionCode = $arrPersonnel['divisionCode'];
				$strPositionCode = $arrPersonnel['positionCode'];
				$strPositionDesc = $arrPersonnel['positionDesc'];
				$strDivisionDesc = $arrPersonnel['divisionName'];
				$strAppointmentStatus = $arrPersonnel['statusOfAppointment'];
				$strItemNumber = $arrPersonnel['itemNumber'];
				$strAuthorizeSalary = $arrPersonnel['authorizeSalary'];
				$strActualSalary = $arrPersonnel['actualSalary'];
				$strStepNumber = $arrPersonnel['stepNumber'];
				$strSalaryGradeNumber = $arrPersonnel['salaryGradeNumber'];
				$strAppointmentCode = $arrPersonnel['appointmentCode'];
				$strPositionDate = $arrPersonnel['positionDate'];
				$strFirstDayAgency = $arrPersonnel['firstDayAgency'];
				$strExamCode = $arrPersonnel['examCode'];
				$strExamDesc = $arrPersonnel['examDesc'];
				$strExamType = $arrPersonnel['examType'];
				$strNature = $arrPersonnel['nature'];
				$strWorkNature = substr($strNature,0,1);
				
				if ($strAppointmentStatus == 'In-Service' && $strDivisionCode != "" && $strExamDesc != 'Civil Service Subprofessional' && $strExamType != 'None')
				{
					$intCounter ++;
					$this->printBody($intCounter, $strName, $strSex, $strBirthday, $intTin, $strPositionDesc, $strItemNumber, $strAuthorizeSalary, $strActualSalary, $strStepNumber, $strSalaryGradeNumber, $strAppointmentCode, $strPositionDate, $strFirstDayAgency, $strExamType, $strWorkNature);
					
				}	
			}
				
		 }
		 $this->objRprt->Output();
	    }
		
}  // End Class
?>