<?
/* 
File Name: Report.php
----------------------------------------------------------------------
Purpose of this file: 
Class General
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: June 07, 2004
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

class Report 
{
	
	function report()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection		
	}
	
	function authorizeSalary($t_strEmpNumber, $t_strItemNumber)		//  Authorize Salary
	{

		if (strlen($t_strEmpNumber) == 0)
		{
			$t_strEmpNumber = $this->strEmpNumber;
		}

		if (strlen($t_strItemNumber) == 0)
		{
			$t_strItemNumber = $this->strItemNumber;
		}
				
		$objAuthorizeSalary = mysql_query("SELECT authorizeSalary, FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objAuthorizeSalary);
		return $row["authorizeSalary"];
		
	}

	function positionDesc($t_strEmpNumber, $t_strItemNumber)   //  Position Code
	{

		if (strlen($t_strEmpNumber) == 0)
		{
			$t_strEmpNumber = $this->strEmpNumber;
		}

		if (strlen($t_strItemNumber) == 0)
		{
			$t_strItemNumber = $this->strItemNumber;
		}
				
		$objPositionDesc = mysql_query("SELECT positionDesc FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objPositionDesc);
		return $row["positionCode"];
		
	}
	
	function salaryGrade($t_strEmpNumber, $t_strItemNumber)		//  Salary Grade
	{

		if (strlen($t_strEmpNumber) == 0)
		{
			$t_strEmpNumber = $this->strEmpNumber;
		}

		if (strlen($t_strItemNumber) == 0)
		{
			$t_strItemNumber = $this->strItemNumber;
		}
				
		$objPositionCode = mysql_query("SELECT salaryGrade FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objPositionCode);
		return $row["salaryGrade"];
		
	}

	function stepNumber($t_strEmpNumber, $t_strItemNumber)		//  Step Number
	{

		if (strlen($t_strEmpNumber) == 0)
		{
			$t_strEmpNumber = $this->strEmpNumber;
		}

		if (strlen($t_strItemNumber) == 0)
		{
			$t_strItemNumber = $this->strItemNumber;
		}
				
		$objPositionCode = mysql_query("SELECT stepNumber FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objPositionCode);
		return $row["stepNumber"];
		
	}

	function comboItemNumber($t_strItemNumber)					//  Item Number Function
	{
	
		$result = mysql_query ("SELECT * FROM tblPlantilla");
		
		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strItemNumber == $row["itemNumber"])
			{
				print "<OPTION VALUE=\"".($row["itemNumber"])."\" selected>".($row["itemNumber"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["itemNumber"])."\">".($row["itemNumber"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
	
	}
		
	function comboAppointmentCode($t_strAppointmentCode)			//  Appointment Code Function
	{

		$result = mysql_query ("SELECT * FROM tblAppointment");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strAppointmentCode == $row["appointmentCode"])
			{
				print "<OPTION VALUE=\"".($row["appointmentCode"])."\" selected>".($row["appointmentDesc"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["appointmentCode"])."\">".($row["appointmentDesc"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}

	}

	function comboDivisionCode($t_strDivisionCode)				//  Division Code
	{
	
		$result = mysql_query ("SELECT * FROM tblDivision");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strDivisionCode == $row["divisionCode"])
			{
				print "<OPTION VALUE=\"".strtoupper($row["divisionCode"])."\" selected>".strtoupper($row["divisionCode"])."\r";
			}
		  print "<OPTION VALUE=\"".strtoupper($row["divisionCode"])."\">".strtoupper($row["divisionCode"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
	
	}

	function comboSectionCode($t_strSectionCode)				//  Section Code
	{
	
		$result = mysql_query ("SELECT sectionCode FROM tblSection");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strSectionCode == $row["sectionCode"])
			{
				print "<OPTION VALUE=\"".strtoupper($row["sectionCode"])."\" selected>".strtoupper($row["sectionCode"])."\r";
			}
		  print "<OPTION VALUE=\"".strtoupper($row["sectionCode"])."\">".strtoupper($row["sectionCode"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
	
	}
	
	function comboServiceCode($t_strServiceCode)				//  Service Code
	{
	
		$result = mysql_query("SELECT * FROM tblServiceCode ");	

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strServiceCode == $row["serviceCode"])
			{
				print "<OPTION VALUE=\"".($row["serviceCode"])."\" selected>".($row["serviceCode"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["serviceCode"])."\">".($row["serviceCode"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
	
	}
	
	function comboSeparationCause($t_strStatusOfAppointment)				//  Employed/Separated
	{
		$result = mysql_query ("SELECT * FROM tblSeparationCause");
		
		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strStatusOfAppointment == $row["separationCause"])
			{
				print "<OPTION VALUE=\"".($row["separationCause"])."\" selected>".($row["separationCause"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["separationCause"])."\">".($row["separationCause"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
	
	}
	
}
?>