<?
/* 
File Name: ReportPIBody.php (class folder)
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
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportPersonnelInformation.php');

class ReportPIBody extends General
{
	var $objRprt;
	var $intTrainingsNum = 0;

	
	function printBody($t_intCounter,$t_strEmpNumber,$t_strEmpName,$t_strPositionDesc,$t_strCourse,$t_strSGNumber,$t_strActualSalary)
	{
		//  body here
		$this->objRprt->SetFont(Arial,'',10);
		$strNameCombine = $t_intCounter.".  ".$t_strEmpName;
		$this->objRprt->Cell(50,5,$strNameCombine,LTR,0,L);
		$this->objRprt->Cell(70,5,$t_strPositionDesc,LTR,0,L);
		$this->objRprt->Cell(70,5,$t_strCourse,LTR,0,L);
		$this->objRprt->Cell(30,5,$t_strSGNumber,LTR,0,C);
		$this->objRprt->Cell(40,5,$t_strActualSalary,LTR,0,C);
	
		
		$objTrainings = mysql_query("SELECT tblEmpPersonal.empNumber,tblEmpTraining.trainingCode,
											tblEmpTraining.trainingStartDate,tblEmpTraining.trainingEndDate,
											tblEmpTraining.trainingVenue,tblTraining.trainingTitle
									 FROM tblEmpPersonal
									 	INNER JOIN tblEmpTraining
											ON tblEmpPersonal.empNumber = tblEmpTraining.empNumber
									 	INNER JOIN tblTraining
											ON tblEmpTraining.trainingCode = tblTraining.trainingCode
									 WHERE tblEmpTraining.empNumber ='$t_strEmpNumber'
									 ORDER BY tblEmpTraining.trainingStartDate desc,tblEmpTraining.trainingEndDate desc");
	
		$totalNumRows = mysql_num_rows($objTrainings);				
		$intCountTrainings = 0;
		
		while($arrTrainings = mysql_fetch_array($objTrainings))
		{
			$intCountTrainings++;	
			$strTrainingCode = $arrTrainings['trainingCode'];
			$strTrainingStartDate = $arrTrainings['trainingStartDate'];
			$strTrainingEndDate = $arrTrainings['trainingEndDate'];
			$strTrainingVenue = $arrTrainings['trainingVenue'];
			$strTrainingTitle = $arrTrainings['trainingTitle'];
			
			$strTrainingStartYr = date("Y", strtotime($strTrainingStartDate));
			$strInToMonthFullStart = date("n", strtotime($strTrainingStartDate));
			$strTrainingStartMonth = $this->intToMonthFull($strInToMonthFullStart);
			$strTrainingStartDay = date("d", strtotime($strTrainingStartDate));
			
			$strTrainingEndtYr = date("Y", strtotime($strTrainingEndDate ));
			$strIntoMonthFullEnd =date("n", strtotime($strTrainingEndDate));
			$strTrainingEndtMonth = $this->intToMonthFull($strIntoMonthFullEnd);
			$strTrainingEndtDay =  date("d", strtotime($strTrainingEndDate));
		
			if($strTrainingStartDate == $strTrainingEndDate)
			{
				$t_strTrainingDate =$strTrainingStartMonth. " ".$strTrainingStartDay. ", ".$strTrainingStartYr;
			}
			elseif(($strTrainingStartYr == $strTrainingEndtYr)&&($strTrainingStartMonth != $strTrainingEndtMonth))
			{
				$t_strTrainingDate = $strTrainingStartMonth." ".$strTrainingStartDay." - ".$strTrainingEndtMonth." ".$strTrainingEndtDay." , ".$strTrainingEndtYr;
			
			}
			elseif($strTrainingStartYr != $strTrainingEndtYr)
			{
				$t_strTrainingDate = $strTrainingStartMonth." ".$strTrainingStartDay." , ".$strTrainingStartYr." - ".$strTrainingEndtMonth." ".$strTrainingEndtDay." , ".$strTrainingEndtYr;
			}
			elseif(($strTrainingStartMonth == $strTrainingEndtMonth)&&($strTrainingStartYr==$strTrainingEndtYr))
			{
				$t_strTrainingDate = $strTrainingStartMonth. " ".$strTrainingStartDay." - ".$strTrainingEndtDay." , ".$strTrainingEndtYr;
			}
			
	
			if ($intCountTrainings ==1)
			{
				$this->intTrainingsNum = $this->intTrainingsNum + 1;
				$this->objRprt->Cell(80,5,"* ".$strTrainingTitle,LTR,1,L);
				$this->objRprt->Cell(50,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(30,5," ",LR,0,C);
				$this->objRprt->Cell(40,5," ",LR,0,C);
			
				$this->objRprt->Cell(80,5,"  ".$t_strTrainingDate,LR,1,L);
				$this->objRprt->Cell(50,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(30,5," ",LR,0,C);
				$this->objRprt->Cell(40,5," ",LR,0,C);
				
				$this->objRprt->Cell(80,5,"  ".$strTrainingVenue,LR,1,L);
				$this->objRprt->Cell(50,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(30,5," ",LR,0,C);
				$this->objRprt->Cell(40,5," ",LR,0,C);
				$this->objRprt->Cell(80,5,"  ",LR,1,L);
			}
	
			else
			{
				$this->intTrainingsNum = $this->intTrainingsNum + 1;
				$this->objRprt->Cell(50,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(30,5," ",LR,0,C);
				$this->objRprt->Cell(40,5," ",LR,0,C);
				$this->objRprt->Cell(80,5,"* ".$strTrainingTitle,LR,1,L);
			
				$this->objRprt->Cell(50,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(30,5," ",LR,0,C);
				$this->objRprt->Cell(40,5," ",LR,0,C);
				$this->objRprt->Cell(80,5,"  ".$t_strTrainingDate,LR,1,L);
			
				$this->objRprt->Cell(50,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(30,5," ",LR,0,C);
				$this->objRprt->Cell(40,5," ",LR,0,C);
				$this->objRprt->Cell(80,5,"  ".$strTrainingVenue,LR,1,L);
				
				$this->objRprt->Cell(50,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(70,5," ",LR,0,L);
				$this->objRprt->Cell(30,5," ",LR,0,C);
				$this->objRprt->Cell(40,5," ",LR,0,C);
				$this->objRprt->Cell(80,5,"  ",LR,1,L);
			}
			
				
			if(($intCountTrainings==$totalNumRows)&&(($this->intTrainingsNum%5)!= 0))
			{
				
				$this->objRprt->Cell(50,5," ",LBR,0,L);
				$this->objRprt->Cell(70,5," ",LBR,0,L);
				$this->objRprt->Cell(70,5," ",LBR,0,L);
				$this->objRprt->Cell(30,5," ",LBR,0,C);
				$this->objRprt->Cell(40,5," ",LBR,0,C);
				$this->objRprt->Cell(80,5,"  ",LBR,1,L);
			}
			
			if (($this->intTrainingsNum%5)== 0)
			{
				$this->objRprt->Cell(50,5," ",LBR,0,L);
				$this->objRprt->Cell(70,5," ",LBR,0,L);
				$this->objRprt->Cell(70,5," ",LBR,0,L);
				$this->objRprt->Cell(30,5," ",LBR,0,C);
				$this->objRprt->Cell(40,5," ",LBR,0,C);
				$this->objRprt->Cell(80,5,"  ",LBR,1,L);
				$this->objRprt->AddPage();
				$this->objRprt->Line(10,58,350,58);
				
			}
		
			
		
			
			
		} //end of while
		
		
		//$this->objRprt->Ln(5);
			
	} //end of function


	function generateReport()
	{
		$this->objRprt = new ReportPersonnelInformation;
		$this->objRprt->setYear($_SESSION['sesYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(10);
		$this->objRprt->SetRightMargin(10);
		$this->objRprt->SetTopMargin(10);
		$this->objRprt->SetAutoPageBreak("off",25);
		
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		$objPersonnelInfo = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber,tblEmpPersonal.surname,
														tblEmpPersonal.firstname,tblEmpPersonal.middlename,
														tblEmpPosition.positionCode,tblPosition.positionDesc,
														tblEmpPosition.salaryGradeNumber,tblEmpPosition.actualSalary,
														tblEmpPosition.statusOfAppointment,tblEmpTraining.empNumber			
										  FROM 	tblEmpPersonal
										  INNER JOIN tblEmpPosition
										  	ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										  INNER JOIN tblEmpTraining
										  	ON tblEmpPersonal.empNumber = tblEmpTraining.empNumber
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
			$strMiddleName = substr($strMidName, 0,1);			
			$strEmpName = $arrPersonnelInfo['firstname']. " ".$strMiddleName. " ".$arrPersonnelInfo['surname'];
			$strPositionCode = $arrPersonnelInfo['positionCode'];
			$strPositionDesc = $arrPersonnelInfo['positionDesc'];
			$strSGNumber = $arrPersonnelInfo['salaryGradeNumber'];
			$strActualSalary = $arrPersonnelInfo['actualSalary'];
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
			$this->printBody($intCounter,$strEmpNumber,$strEmpName,$strPositionDesc,$strCourse,$strSGNumber,$strActualSalary);
			
			
		}	
		$this->objRprt->Output();
	}
				

}  // End Class

?>