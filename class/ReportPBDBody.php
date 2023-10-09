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
require('../hrmis/class/ReportPersonnelBirthDate.php');

class ReportPBDBody extends General
{
	var $objRprt;
	var $intCounter = 0;
	var $strDivName = " ";

	// Body
	function printBody($t_intCounter,$t_strBDDay,$t_strBDYear,$t_strEmpName) 
	{
		$InterLigne = 7;
		$Percentage = 19; 
		$Height = 10;

		$t_strNameCmbne = $t_intCounter."."."   ".$t_strName;
		
		$this->objRprt->SetFont(Arial,'B',10);
		$this->objRprt->Cell(14,5,$t_intCounter,1,0,L);
		$this->objRprt->Cell(21,5,$t_strBDDay,1,0,C);
		$this->objRprt->Cell(25,5,$t_strBDYear,1,0,C);
		$this->objRprt->Cell(90,5,$t_strEmpName,1,0,C);
		$this->objRprt->Ln(5);
	}
	
	function printMonth($t_intMonthCntr)
	{
		$InterLigne = 7;
		$Percentage = 19; 
		$Height = 10;
		
		$strMonthName = $this->intToMonthFull($t_intMonthCntr);
		$strMonthNameCap = strtoupper($strMonthName);
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont(Arial,'B',11);
		$this->objRprt->Cell(150,5,"",0,0,C);
		$this->objRprt->Ln(5);
		$this->objRprt->SetFillColor(150,150,150);
		$this->objRprt->Cell(150,5,$strMonthNameCap,1,0,C,1);
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont(Arial,'B',10);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(14,7,"#",1,0,L,1);
		$this->objRprt->Cell(21,7,"DAY",1,0,C,1);
		$this->objRprt->Cell(25,7,"YEAR",1,0,C,1);
		$this->objRprt->Cell(90,7,"NAME OF EMPLOYEE",1,0,C,1);
		$this->objRprt->Ln(7);
	 }
	
	function generateReport()
	{
		$this->objRprt = new ReportPersonnelBirthDate;
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(35);
		$this->objRprt->SetRightMargin(7);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on",35);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		
		
										
		for($intMonthCntr = 1; $intMonthCntr <=12; $intMonthCntr++)
		{
			
			$this->printMonth($intMonthCntr);
			$objEmpBirthday = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname,tblEmpPersonal.firstname,
											   tblEmpPersonal.middlename, tblEmpPersonal.birthday,tblEmpPosition.statusOfAppointment 
										FROM tblEmpPersonal
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										ORDER BY tblEmpPersonal.birthday asc");
			
			$intCounter = 0;
			while($arrEmpBirthDay = mysql_fetch_array($objEmpBirthday))
			{
			
			$strEmpNum = $arrEmpBirthDay['empNumber'];
			$strMidName = $arrEmpBirthDay['middlename'];
			$strMiddleName = substr($strMidName, 0,1);
			$strEmpName = $arrEmpBirthDay['surname'].",  ".$arrEmpBirthDay['firstname']. "  ".$strMiddleName.".";
			$strStatusOfAppointment = $arrEmpBirthDay['statusOfAppointment'];
			$strBirthDay = $arrEmpBirthDay['birthday'];
			$strBirthDayEx = explode('-',$strBirthDay);
			$strBDYear = intval($strBirthDayEx[0]);
			$strBDMonth = intval($strBirthDayEx[1]);
			$strBDDay = intval($strBirthDayEx[2]);
			
			if(($strStatusOfAppointment == 'In-Service')&&($strBDMonth == $intMonthCntr))
			{
				
				$intCounter++;
				$this->printBody($intCounter,$strBDDay,$strBDYear,$strEmpName);
			}		   
		   }
		 }
		  $this->objRprt->Output();
		
    }
		
		
	
				

}  // End Class

?>