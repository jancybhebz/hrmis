<?
/* 
File Name: ReportPSBody.php (class folder)
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
require('../hrmis/class/ReportPersonnelSex.php');

class ReportPSBody extends General
{
	var $objRprt;
	var $intCounter = 0;

	function printFemale($t_strEmpName)
	{
		$InterLigne = 7;
		$Percentage = 19; 
		$Height = 10;
			
		$this->objRprt->SetFont(Arial,'B',10);
		$this->objRprt->Cell(150,6,$t_strEmpName,0,0,C);
		$this->objRprt->Ln(6);
	}
	
	function printFemaleHeader()
	{
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont(Arial,'B',12);
		$this->objRprt->SetFillColor(150,150,150);
		$this->objRprt->Cell(150,8,"FEMALE",0,0,C,1);
		$this->objRprt->Ln(10);
	}
	
	function printMale($t_strEmpName)
	{
		$InterLigne = 7;
		$Percentage = 19; 
		$Height = 10;
			
		$this->objRprt->SetFont(Arial,'B',10);
		$this->objRprt->Cell(150,6,$t_strEmpName,0,0,C);
		$this->objRprt->Ln(6);
	}
	
	function printMaleHeader()
	{
		$this->objRprt->Ln(10);
		$this->objRprt->SetFillColor(150,150,150);
		$this->objRprt->SetFont(Arial,'B',12);
		$this->objRprt->Cell(150,8,"MALE",0,0,C,1);
		$this->objRprt->Ln(10);
	}
	
	function totalFemale($t_intCounter)
	{
		$this->objRprt->Ln(6);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->SetFont(Arial,'B',10);	
		$this->objRprt->Cell(150,6,'Total Female: '.$t_intCounter ,0,0,C,1);
		$this->objRprt->Ln(6);
	
	}
	
	function totalMale($t_intCounter)
	{
		$this->objRprt->Ln(6);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->SetFont(Arial,'B',10);	
		$this->objRprt->Cell(150,6,'Total Male:  '.$t_intCounter ,0,0,C,1);
		$this->objRprt->Ln(6);
	
	}
	
	
	
	function generateReport()
	{
		$this->objRprt = new ReportPersonnelSex;
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(25);
		$this->objRprt->SetRightMargin(25);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on",35);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		$objEmpGenderFemale = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname,tblEmpPersonal.firstname,
											tblEmpPersonal.middlename,tblEmpPersonal.sex,tblEmpPosition.statusOfAppointment
									 FROM tblEmpPersonal 
									 INNER JOIN tblEmpPosition
									 	ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									 WHERE tblEmpPersonal.sex = 'F'
									 ORDER BY tblEmpPersonal.surname asc,tblEmpPersonal.firstname asc, tblEmpPersonal.middlename asc");
		$intCounter =0;
		$this->printFemaleHeader();
		while($arrEmpGenderFemale = mysql_fetch_array($objEmpGenderFemale))
		{
			$strEmpNum = $arrEmpGenderFemale['empNumber'];
			$strEmpName = $arrEmpGenderFemale['surname']. ",  ".$arrEmpGenderFemale['firstname']. " ".$arrEmpGenderFemale['middlename'];
			$strSex = $arrEmpGenderFemale['sex'];
			$strStatusOfAppointment = $arrEmpGenderFemale['statusOfAppointment'];
			
			if($strStatusOfAppointment == 'In-Service')
			{
				$intCounter++;
				$this->printFemale($strEmpName);
			}
		
		}
		$this->totalFemale($intCounter);
		
		$objEmpGenderMale= mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname,tblEmpPersonal.firstname,
											tblEmpPersonal.middlename,tblEmpPersonal.sex,tblEmpPosition.statusOfAppointment
									 FROM tblEmpPersonal 
									 INNER JOIN tblEmpPosition
									 	ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									 WHERE tblEmpPersonal.sex = 'M'
									 ORDER BY tblEmpPersonal.surname asc,tblEmpPersonal.firstname asc, tblEmpPersonal.middlename asc");
		$intCounter =0;
		$this->printMaleHeader();
		while($arrEmpGenderMale = mysql_fetch_array($objEmpGenderMale))
		{
			$strEmpNum = $arrEmpGenderMale['empNumber'];
			$strEmpName = $arrEmpGenderMale['surname']. ",  ".$arrEmpGenderMale['firstname']. " ".$arrEmpGenderMale['middlename'];
			$strSex = $arrEmpGenderMale['sex'];
			$strStatusOfAppointment = $arrEmpGenderMale['statusOfAppointment'];
			
			if($strStatusOfAppointment == 'In-Service')
			{
				$intCounter++;
				$this->printMale($strEmpName);
			}
		}
		$this->totalMale($intCounter);
		
		
		
		
		
		$this->objRprt->Output();
	}
				

}  // End Class

?>