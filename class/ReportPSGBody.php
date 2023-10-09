<?
/* 
File Name: ReportPSGBody.php (class folder)
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
require('../hrmis/class/ReportPersonnelSalaryGrade.php');

class ReportPSGBody extends General
{
	var $objRprt;
	var $intCounter = 0;

	// Body
	function printBody($t_intCounter,$t_strEmpNumber,$t_strEmpName)
	{
		$InterLigne = 7;
		$Percentage = 19; 
		$Height = 10;
	
		$strEmpNumCmbine = $t_intCounter.".    ".$t_strEmpNumber;
		$this->objRprt->SetFont(Arial,'',10);
		$this->objRprt->Cell(70,5,$strEmpNumCmbine,1,0,L);
		$this->objRprt->Cell(110,5,$t_strEmpName,1,0,C);
		$this->objRprt->Ln(5);
	}
	
	function printSalaryGrade($t_strSalaryGrade)
	{
		$this->objRprt->SetFont(Arial,'',11);
		$this->objRprt->SetFillColor(150,150,150);
		$this->objRprt->Cell(180,10,"SALARY GRADE NUMBER :  ".$t_strSalaryGrade,1,0,C,1);
		$this->objRprt->Ln(10);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(70,6,"EMPLOYEE NUMBER",1,0,C,1);
		$this->objRprt->Cell(110,6,"EMPLOYEE NAME",1,0,C,1);
		$this->objRprt->Ln(6);
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportPersonnelSalaryGrade;
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(18);
		$this->objRprt->SetRightMargin(15);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on",25);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		$objSalaryGrade = mysql_query("SELECT DISTINCT tblSalarySched.salaryGradeNumber
									   FROM tblSalarySched
									   ORDER BY tblSalarySched.salaryGradeNumber desc");
		
		while($arrSalaryGrade = mysql_fetch_array($objSalaryGrade))
		{
			
			$strSGNumber = $arrSalaryGrade['salaryGradeNumber'];

			$objEmpSalaryGrade = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber,tblEmpPersonal.surname,tblEmpPersonal.firstname,
												tblEmpPersonal.middlename,tblEmpPosition.statusOfAppointment,
												tblEmpPosition.salaryGradeNumber
										   	  FROM tblEmpPersonal
										   			INNER JOIN tblEmpPosition
														ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
													INNER JOIN tblSalarySched
														ON tblEmpPosition.salaryGradeNumber = tblSalarySched.salaryGradeNumber
											  WHERE tblSalarySched.salaryGradeNumber ='$strSGNumber'		
										   	  ORDER BY tblEmpPersonal.surname asc,tblEmpPersonal.firstname asc,
														tblEmpPersonal.middlename asc");
														
			$totalNumRows = mysql_num_rows($objEmpSalaryGrade);											
			
			if($totalNumRows!=0)
			{
				$this->printSalaryGrade($strSGNumber);
				
			$intCounter = 0;
			while($arrEmpSalaryGrade = mysql_fetch_array($objEmpSalaryGrade))
			{
				$strEmpNumber = $arrEmpSalaryGrade['empNumber'];
				$strMidName = $arrEmpSalaryGrade['middlename'];
				$strMiddleName = substr($strMidName,0,1);
				$strEmpName = $arrEmpSalaryGrade['surname'].",  ".$arrEmpSalaryGrade['firstname']." ".$strMiddleName.".";
				$strStatusOfAppointment = $arrEmpSalaryGrade['statusOfAppointment'];
				
				if($strStatusOfAppointment =='In-Service')
				{
					$intCounter++;
					$this->printBody($intCounter,$strEmpNumber,$strEmpName);				
				}


			}
			}
		}
		
		$this->objRprt->Output();
	}
				

}  // End Class

?>