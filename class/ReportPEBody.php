<?
/* 
File Name: ReportPEBody.php (class folder)
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
require('../hrmis/class/ReportPersonnelEducation.php');

class ReportPEBody extends General
{
	var $objRprt;
	var $intEducationNum = 0;

	function printBody($t_intCounter, $t_strEmpNumber, $t_strEmpName, $t_strPositionDesc, $t_strCourse)
	{
		//  body here
		$interLigne = 7;
		$this->objRprt->SetFont(Arial,'',9);
		$strNameCombine = $t_intCounter.".  ".$t_strEmpName;		
		$this->objRprt->Cell(70,$interLigne,$strNameCombine,LTR,0,L);		//  Employee Name
		$this->objRprt->Cell(80,$interLigne,$t_strPositionDesc,LTR,0,L);	//  Position Title
		$this->objRprt->Cell(90,$interLigne,$t_strCourse,LTR,0,L);			//  Highest Course

		
		$objEmpEducation = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpSchool.levelCode,
											tblEmpSchool.course,tblEducationalLevel.level
										FROM tblEmpPersonal
											INNER JOIN tblEmpSchool
												ON tblEmpPersonal.empNumber = tblEmpSchool.empNumber
											INNER JOIN tblEducationalLevel
												ON tblEmpSchool.levelCode = tblEducationalLevel.levelCode
										WHERE tblEmpSchool.empNumber ='$t_strEmpNumber'
											AND tblEmpSchool.course != '$t_strCourse'
										ORDER BY tblEducationalLevel.level asc");
		
		$totalNumRows = mysql_num_rows($objEmpEducation);				
		$intCountEmpEducation = 0;

		while($arrHighestEducAttainment = mysql_fetch_array($objEmpEducation))
		{
			$intCountEmpEducation++;
			$strCourse = $arrHighestEducAttainment['course'];
			$strLevelCode = $arrHighestEducAttainment['levelCode'];
			$strLevel = $arrHighestEducAttainment['level'];

			if ($intCountEmpEducation == 1)
			{

				$this->intEducationNum = $this->intEducationNum + 1;
				$this->objRprt->Cell(85,$interLigne," * " . $strCourse,LTR,0,L);		//  other Degree
				$this->objRprt->Cell(70,$interLigne," ",0,0,L);		//  Employee Name
				$this->objRprt->Cell(80,$interLigne," ",0,0,L);	//  Position Title
				$this->objRprt->Cell(90,$interLigne," ",0,1,L);			//  Highest Course
			} else 
			{
			
				$this->intEducationNum = $this->intEducationNum + 1;
				$this->objRprt->Cell(70,$interLigne," ",LR,0,L);					//  Employee Name
				$this->objRprt->Cell(80,$interLigne," ",LR,0,L);					//  Position Title
				$this->objRprt->Cell(90,$interLigne," ",LR,0,L);					//  Highest Course
				$this->objRprt->Cell(85,$interLigne," * " . $strCourse,LR,1,L);	//  other Degree

			}	//end if
			
			if(($intCountEmpEducation==$totalNumRows) && ($this->intEducationNum % 12)!= 0)
			{
				
				$this->objRprt->Cell(70,$interLigne," ",LBR,0,L);			//  Employee Name
				$this->objRprt->Cell(80,$interLigne," ",LBR,0,L);			//  Position Title
				$this->objRprt->Cell(90,$interLigne," ",LBR,0,L);			//  Highest Course
				$this->objRprt->Cell(85,$interLigne," ",LBR,1,L);		//  other Degree
			}

			if (($this->intEducationNum % 12)== 0)
			{
				$this->objRprt->Cell(70,$interLigne,"",LBR,0);		//  other Degree
				$this->objRprt->Cell(80,$interLigne,"",LBR,0);		//  Employee Name
				$this->objRprt->Cell(90,$interLigne,"",LBR,0);		//  Position Title
				$this->objRprt->Cell(85,$interLigne,"",LBR,0);		//  Highest Course
				$this->objRprt->AddPage();
			}

		}	//end while
		 		$this->objRprt->Ln(.25);
		
	}	//end of PrintBody
	
	
	function generateReport()
	{
		$this->objRprt = new ReportPersonnelEducation;
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesDay'], $_SESSION['sesYear']);
		$this->objRprt->setOfficeInfo($t_strOfficeName, $t_strOfficeAdd, $t_strOfficeTelNum);
		
		$this->objRprt->SetLeftMargin(18);
		$this->objRprt->SetRightMargin(15);
		$this->objRprt->SetTopMargin(10);
		$this->objRprt->SetAutoPageBreak("on",15);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		

		$objPersonnelInfo = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname,
											tblEmpPersonal.firstname, tblEmpPersonal.middlename,
											tblEmpPosition.positionCode, tblPosition.positionDesc,
											tblEmpPosition.statusOfAppointment			
										 FROM 	tblEmpPersonal
										  	INNER JOIN tblEmpPosition
										  		ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										  	INNER JOIN tblPosition
										  		ON tblEmpPosition.positionCode = tblPosition.positionCode
										  WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
										  ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname,
										  		tblEmpPersonal.middlename");
												
		$intCounter =0;
		while($arrPersonnelInfo = mysql_fetch_array($objPersonnelInfo))
		{
			$intCounter++;
			$strEmpNumber = $arrPersonnelInfo['empNumber'];
			$strMidName = $arrPersonnelInfo['middlename'];
			$strMiddleName = substr($strMidName,0,1);			
			$strEmpName = $arrPersonnelInfo['firstname']. " ".$strMiddleName. " ".$arrPersonnelInfo['surname'];
			$strPositionCode = $arrPersonnelInfo['positionCode'];
			$strPositionDesc = $arrPersonnelInfo['positionDesc'];
			$strStatusOfAppointment = $arrPersonnelInfo['statusOfAppointment'];
			
			$objHighestEducAttainment = mysql_query("SELECT tblEmpSchool.empNumber, tblEmpSchool.levelCode,
															tblEmpSchool.course,tblEducationalLevel.level
													 FROM tblEmpSchool
													 	INNER JOIN tblEducationalLevel
													 		ON tblEmpSchool.levelCode = tblEducationalLevel.levelCode
													 WHERE tblEmpSchool.empNumber ='$strEmpNumber'
													 ORDER BY tblEducationalLevel.level asc");
			
			$arrHighestEducAttainment = mysql_fetch_array($objHighestEducAttainment);
			$strCourse = $arrHighestEducAttainment['course'];
			$strLevelCode = $arrHighestEducAttainment['levelCode'];
			$strLevel = $arrHighestEducAttainment['level'];
			
			$this->printBody($intCounter, $strEmpNumber, $strEmpName, $strPositionDesc, $strCourse);
			
			
		}	
		$this->objRprt->Output();

	}	//end of function generate report()
		
		
}	//end of class
?>