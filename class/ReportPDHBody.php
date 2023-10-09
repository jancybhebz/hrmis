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
require('../hrmis/class/ReportPersonnelDateHired.php');

class ReportPDHBody extends General
{
	var $objRprt;
	var $intCounter = 0;

	// Body
	function printBody($t_intCounter,$t_strEmpName,$t_strFirstDayAgency)
	{
		$InterLigne = 7;
		$Percentage = 19; 
		$Height = 10;
		
		$strCmbineName = $t_intCounter. ".  ".$t_strEmpName;
		$this->objRprt->SetFont(Arial,'',10);
		$this->objRprt->Cell(90,5,$strCmbineName,1,0,L);
		$this->objRprt->Cell(90,5,$t_strFirstDayAgency,1,0,C);
		$this->objRprt->Ln(5);
		
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportPersonnelDateHired;
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesDay'], $_SESSION['sesYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(18);
		$this->objRprt->SetRightMargin(15);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on",25);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		$objEmpDateHired = mysql_query("SELECT tblEmpPersonal.empNumber,tblEmpPersonal.surname, tblEmpPersonal.firstname,
											   tblEmpPersonal.middlename,tblEmpPosition.statusOfAppointment,
											   tblEmpPosition.firstDayAgency
										FROM tblEmpPersonal
											INNER JOIN tblEmpPosition
												ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										ORDER BY tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
											   tblEmpPersonal.middlename asc");
		$intCounter = 0;
		while($arrEmpDateHired = mysql_fetch_array($objEmpDateHired))
		{
			$strEmpNum = $arrEmpDateHired['empNumber'];
			$strMidName = $arrEmpDateHired['middlename'];
			$strMiddleName = substr($strMidName, 0,1);
			$strEmpName = $arrEmpDateHired['surname']. ",  ".$arrEmpDateHired['firstname']. " ".$strMiddleName.".";
			$strStatusOfAppointment = $arrEmpDateHired['statusOfAppointment'];
			$strFirstDayAgency = $arrEmpDateHired['firstDayAgency'];		
			
			if($strStatusOfAppointment  == 'In-Service')
			{
				$intCounter++;
				$this->printBody($intCounter,$strEmpName,$strFirstDayAgency);		
			}
		
		}
		$this->objRprt->Output();
	}
				

}  // End Class

?>