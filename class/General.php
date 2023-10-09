<?
/* 
File Name: General.php
----------------------------------------------------------------------
Purpose of this file: 
Class General
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: October 8, 2003
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
require("../hrmis/class/Paging.php");
class General extends Paging
{
	var $strFile;
	var $strFileVariables;
	var $intTotalRecord;	
	
	function general()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection		
	}
	
	function checkGetEmpNmbr($t_strModule, $t_strSearch, $t_strField='', $t_strMonth='', $t_strYear='', $t_intPage='', $t_intCurrPage='', $t_strLetter='', $t_strDivision='')
	{   //for search
		
		if(strlen($t_strDivision) != 0)
		{
			$strAND = " AND tblEmpPosition.divisionCode = '$t_strDivision' ";
		}
		else
		{
			$strAND = "";
		}

		
		if($t_strModule == "Attendance" || $t_strModule == "Compensation" || $t_strModule == "Chief" || $t_strModule == "Cashier")
		{
			if(strlen($t_strYear) == 0 && strlen($t_strMonth) == 0)
			{
				$t_strYear = date('Y');
				$t_strMonth = date('n');
			}
			$dtmQueryDate = $this->lastDayOfMonthYear($t_strYear, $t_strMonth);
			//$dtmQueryDate = $this->combineDate($t_strYear, $t_strMonth, $intTotalMonthDay);

			if(strlen($t_strLetter) != 0)   //selected from the letters
			{
				$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
							tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
							tblEmpPosition.divisionCode, tblEmpPosition.appointmentCode,
							tblEmpPosition.positionCode,
							tblDivision.divisionName, tblDivision.divisionHead, 
							tblDivision.divisionHeadTitle, tblAppointment.leaveEntitled 
						FROM tblEmpPersonal 
						LEFT JOIN tblEmpPosition 
							ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
							INNER JOIN tblDivision
								ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
						WHERE tblEmpPersonal.surname LIKE '$t_strLetter%' 
							AND tblEmpPosition.longevityDate <= '$dtmQueryDate' ".$strAND.
					" ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";			
			}		
			elseif($t_strField == "empNmbr")
			{   //search by employee number
				$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
							tblEmpPersonal.firstname, tblEmpPersonal.middlename,
							tblEmpPosition.divisionCode, tblEmpPosition.appointmentCode,
							tblEmpPosition.positionCode,
							tblDivision.divisionName, tblDivision.divisionHead, 
							tblDivision.divisionHeadTitle, tblAppointment.leaveEntitled 
						FROM tblEmpPersonal 
						LEFT JOIN tblEmpPosition 
							ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
							INNER JOIN tblDivision
								ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
						WHERE tblEmpPersonal.empNumber LIKE '%$t_strSearch%' 
							AND tblEmpPosition.longevityDate <= '$dtmQueryDate' ".$strAND.
					" ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
			}
			else
			{   //search by employee name
				$t_strSearch = strtr($t_strSearch,' ','%');
				$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
							tblEmpPersonal.firstname, tblEmpPersonal.middlename,
							tblEmpPosition.divisionCode, tblEmpPosition.appointmentCode,
							tblEmpPosition.positionCode,
							tblDivision.divisionName, tblDivision.divisionHead, 
							tblDivision.divisionHeadTitle, tblAppointment.leaveEntitled												  
						FROM tblEmpPersonal 
						LEFT JOIN tblEmpPosition 
							ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
							INNER JOIN tblDivision
								ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode												
						WHERE tblEmpPosition.longevityDate <= '$dtmQueryDate' 
							AND (CONCAT(tblEmpPersonal.surname, ' ', tblEmpPersonal.firstname) LIKE '$t_strSearch' OR 
							CONCAT(tblEmpPersonal.firstname, ' ', tblEmpPersonal.surname) LIKE '$t_strSearch' OR 
							tblEmpPersonal.middlename LIKE '$t_strSearch' OR
							tblEmpPersonal.surname LIKE '$t_strSearch' OR
							tblEmpPersonal.firstname LIKE '$t_strSearch') ".$strAND.
					" ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";			
			}
		}  //if strMonth and strYear is not zero
		elseif($t_strModule == "201")
		{
			if(strlen($t_strLetter) != 0)   //selected from the letters
			{
				$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
							tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
							tblEmpPosition.divisionCode, tblEmpPosition.appointmentCode,
							tblDivision.divisionName, tblDivision.divisionHead, 
							tblDivision.divisionHeadTitle, tblAppointment.leaveEntitled,
							tblEmpPosition.positionCode 
						FROM tblEmpPersonal 
						LEFT JOIN tblEmpPosition 
							ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
							INNER JOIN tblDivision
								ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
						WHERE tblEmpPersonal.surname LIKE '$t_strLetter%' 
						ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";			
			}
			elseif($t_strField == "empNmbr")
			{   //search by employee number
				$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
							tblEmpPersonal.firstname, tblEmpPosition.appointmentCode,
							tblEmpPersonal.middlename, tblEmpPosition.divisionCode, 
							tblDivision.divisionName, tblDivision.divisionHead, 
							tblDivision.divisionHeadTitle, tblAppointment.leaveEntitled, 
							tblEmpPosition.positionCode
						FROM tblEmpPersonal 
						LEFT JOIN tblEmpPosition 
							ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
							LEFT JOIN tblDivision
								ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								LEFT JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode												
						WHERE tblEmpPersonal.empNumber LIKE '%$t_strSearch%' 
						ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
			}
			else
			{   //search by employee name
				$t_strSearch = strtr($t_strSearch,' ','%');
				$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
							tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
							tblEmpPosition.divisionCode, tblDivision.divisionName, 
							tblDivision.divisionHead, tblDivision.divisionHeadTitle,
							tblAppointment.leaveEntitled, tblEmpPosition.positionCode,
							tblEmpPosition.appointmentCode
						FROM tblEmpPersonal 
						LEFT JOIN tblEmpPosition 
							ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
							LEFT JOIN tblDivision
								ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								LEFT JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode																							
						WHERE CONCAT(tblEmpPersonal.surname, ' ', tblEmpPersonal.firstname) LIKE '$t_strSearch' OR 
							CONCAT(tblEmpPersonal.firstname, ' ', tblEmpPersonal.surname) LIKE '$t_strSearch' OR 
							tblEmpPersonal.middlename LIKE '$t_strSearch' OR
							tblEmpPersonal.surname LIKE '$t_strSearch' OR
							tblEmpPersonal.firstname LIKE '$t_strSearch'
						ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";			
			}		
		}
		elseif($t_strModule == "Employee")
		{
			$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname,
						tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
						tblEmpPersonal.weight, tblEmpPersonal.residentialAddress,
						tblEmpPersonal.zipCode1, tblEmpPersonal.telephone1,
						tblEmpPersonal.permanentAddress, tblEmpPersonal.zipCode2,
						tblEmpPersonal.telephone2, tblEmpPersonal.email,
						tblEmpPersonal.mobile, tblEmpPersonal.spouse,
						tblEmpPersonal.spouseWork, tblEmpPersonal.spouseBusName,
						tblEmpPersonal.spouseBusAddress, tblEmpPersonal.spouseTelephone,
						tblEmpPosition.divisionCode, tblDivision.divisionName,
						tblDivision.divisionHead, tblDivision.divisionHeadTitle,
						tblAppointment.leaveEntitled, tblEmpPosition.positionCode
					FROM tblEmpPersonal 
					LEFT JOIN tblEmpPosition 
						ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
						LEFT JOIN tblDivision
							ON tblEmpPosition.divisionCode = tblDivision.divisionCode
							LEFT JOIN tblAppointment
								ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode												
					WHERE tblEmpPersonal.empNumber = '$t_strSearch' 
					ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		$objRecordset = mysql_query($strSQL);
		
		if ($t_strModule != "Employee")
		{
			$this->$intTotalRecord = mysql_num_rows($objRecordset);
			$this->output = "";
			$this->set($t_intPage, $this->$intTotalRecord, $t_intCurrPage);
			$strSQL = "$strSQL LIMIT ".$this->limit();
			$objRecordset = mysql_query($strSQL);
	
			if(!mysql_num_rows($objRecordset))   //username is invalid
			{
				$t_strSearch = strtr($t_strSearch,'%',' ');
				if(strlen($t_strSearch) != 0)
				{
					
					if($t_strModule == "Attendance")
					{					
						$strNoMatch ="SearchNoMatch.php?a=a".$this->varstr;
					}
					elseif($t_strModule == "Chief")
					{
						$strNoMatch ="ChiefNoMatch.php?a=a".$this->varstr;
					}
					elseif($t_strModule == "201")
					{					
						$strNoMatch ="Personalsearch.php?a=a".$this->varstr;
					}
					elseif($t_strModule == "Compensation")
					{
						$strNoMatch ="CSearchemployee.php?a=a".$this->varstr;
					}
					elseif($t_strModule == "Cashier")
					{
						$strNoMatch ="CPersonnelsearch.php?a=a".$this->varstr;
					}
						header("Location: $strNoMatch");
					
				}
			}
			else
			{
				while($arrEmpPersonal = mysql_fetch_array($objRecordset))
				{			
					return $arrEmpPersonal;
				}			
			}
		}
		else
		{
			$arrEmpPersonal = mysql_fetch_array($objRecordset);
			return $arrEmpPersonal;
		}
	}

	function getEmpInfo($t_strEmpNmbr)
	{
		$objEmpInfo = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
											tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
											tblEmpPosition.divisionCode, tblDivision.divisionName, 
											tblDivision.divisionHead, tblDivision.divisionHeadTitle 
									FROM tblEmpPersonal 
									LEFT JOIN tblEmpPosition 
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'");
		while($arrEmpInfo = mysql_fetch_array($objEmpInfo))
		{
			return $arrEmpInfo;
		}					
	}
	
	function intToMonthName($t_intMonth)
	{
		$arrMonths = array(1=>"Jan", 2=>"Feb", 3=>"Mar", 
						4=>"Apr", 5=>"May", 6=>"Jun", 
						7=>"Jul", 8=>"Aug", 9=>"Sep", 
						10=>"Oct", 11=>"Nov", 12=>"Dec");
		return $arrMonths[$t_intMonth];
	}

	function intToMonthFull($t_intMonth)
	{
		$arrMonths = array(1=>"January", 2=>"February", 3=>"March", 
						4=>"April", 5=>"May", 6=>"June", 
						7=>"July", 8=>"August", 9=>"September", 
						10=>"October", 11=>"November", 12=>"December");
		return $arrMonths[$t_intMonth];
	}
	
	function comboDay($t_intDay='')
	{
		if(strlen($t_intDay) == 0)
		{
			$t_intDay = date('j');
		}
		for ($intCounter=1; $intCounter <= 31; $intCounter++)
		{
			if($intCounter == $t_intDay)
			{
				echo "<option value='$intCounter' selected>$intCounter</option>";
			}
			else
			{
				echo "<option value='$intCounter'>$intCounter</option>";
			}
		}

	}
	
	function comboMonth($t_intMonth='')
	{
		if(strlen($t_intMonth) == 0)   //if no month, the default value is the current month
		{
			$t_intMonth = date('n');
		}
		for($intCounter=1; $intCounter<=12; $intCounter++)
		{
			$strMonthName = $this->intToMonthName($intCounter);
			if($t_intMonth == $intCounter)
			{
				echo "<option value='$intCounter' selected>$strMonthName</option>";	
			}
			else
			{
				echo "<option value='$intCounter'>$strMonthName</option>";
			}											
		}
	}
	
	function comboYear($t_intYear='')
	{   
		if(strlen($t_intYear) == 0)   //if no month, the default value is the current month
		{
			$t_intYear = date('Y');
		}
		for($intCounter=2003; $intCounter<=date('Y'); $intCounter++)
		{
			if($t_intYear == $intCounter)
			{
				echo "<option value='$intCounter' selected>$intCounter</option>";	
			}
			else
			{
				echo "<option value='$intCounter'>$intCounter</option>";
			}
		}
	}
	
	function comboYearOld($t_intYear)
	{
		if(strlen($t_intYear) == 0)
		{
			$t_intYear = date('Y');
		}
		$intCounter = date('Y') - 70;
		for(; $intCounter<=date('Y'); $intCounter++)
		{
			if($t_intYear == $intCounter)
			{
				echo "<option value='$intCounter' selected>$intCounter</option>";	
			}
			else
			{
				echo "<option value='$intCounter'>$intCounter</option>";
			}
		}
	}
	
	function comboYearChildren($t_intYear)
	{
		if(strlen($t_intYear) == 0)
		{
			$t_intYear = date('Y');
		}	
		$intCounter = (date('Y') - 70) + 12;
		for(; $intCounter<=date('Y'); $intCounter++)
		{
			if($t_intYear == $intCounter)
			{
				echo "<option value='$intCounter' selected>$intCounter</option>";	
			}
			else
			{
				echo "<option value='$intCounter'>$intCounter</option>";
			}
		}
	}		
	function combineDate($t_strYear, $t_strMonth, $t_strDay)
	{
		if(strlen($t_strMonth) == 1)
		{
			$t_strMonth = "0".$t_strMonth;
		}
		elseif(strlen($t_strDay) == 1)
		{
			$t_strDay = "0".$t_strDay;
		}

		$strDate = $t_strYear."-".$t_strMonth."-".$t_strDay;
		return $strDate;
	}
	
	function combineMonthYear($t_strYear, $t_strMonth)
	{
		if($t_strMonth < 10 && strlen($t_strMonth) == 1)
		{
			$t_strMonth = "0".$t_strMonth;
		}
				
		$strMonthYear = $t_strYear."-".$t_strMonth;
		
		return $strMonthYear;	
	}
	
	function combineTime($t_strTime, $t_strAMPM)
	{
		$strTime = $t_strTime." ".$t_strAMPM;
		return $strTime;
	}
	
	function getTotalRecord()
	{
		return $this->$intTotalRecord;
	}
	
	function radioTwoOption($t_strVar, $t_strDfltVal, $t_strOptName1, $t_strOptVal1, $t_strOptName2, $t_strOptVal2, $t_strDivision, $t_strOnClick='')
	{   //variable, default value, name1, value1, name2, value2, space ("optYesNo", "", "Yes", "Y", "No", "N", "<br>", onclickfunctions)
		if($t_strDfltVal == "$t_strOptVal1" || $t_strDfltVal == "")
		{
			echo "<input name='$t_strVar' type='radio' value='$t_strOptVal1' onClick='$t_strOnClick' checked>";
		}
		else
		{
			echo "<input name='$t_strVar' type='radio' value='$t_strOptVal1' onClick='$t_strOnClick'>";
		}
		
		echo $t_strOptName1.$t_strDivision;	
	
		if($t_strDfltVal == "$t_strOptVal2")
		{
			echo "<input name='$t_strVar' type='radio' value='$t_strOptVal2' onClick='$t_strOnClick' checked>";
		}
		else
		{
			echo "<input name='$t_strVar' type='radio' value='$t_strOptVal2' onClick='$t_strOnClick'>";
		}
	
		echo $t_strOptName2;
	}
	
	function comboEmployee($t_strComboName, $t_strEmpSelect='All Employees', $t_strCategory='')
	{
		$strSQL = "";
		if($t_strEmpSelect == 'Per Division')
		{
			$strSQL = "WHERE tblEmpPosition.divisionCode = '$t_strCategory'";
		}
		else if($t_strEmpSelect == 'Per Section')
		{
			$strSQL = "WHERE tblEmpPosition.sectionCode = '$t_strCategory'";
		}		
		
		echo "<select name='$t_strComboName' size='10' multiple>";
		$objEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname 
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition 
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								".$strSQL."
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname");
		
		while($arrEmp = mysql_fetch_array($objEmp))
		{
			$strComboElements =  $arrEmp["empNumber"]." | ".$arrEmp["surname"].", ".$arrEmp["firstname"];
			echo "<option value='".$arrEmp["empNumber"]."'>$strComboElements</option>";
		}
        echo "</select>";
	}

	function comboEmpReport($t_strComboName, $t_strEmp='', $t_strRprtType, $t_strPer='', $t_strDivSec='')
	{	
		if($t_strPer == "Per Division")
		{
			$t_strPer = "tblEmpPosition.divisionCode";
		}
		elseif($t_strPer == "Per Section")
		{
			$t_strPer = "tblEmpPosition.sectionCode";
		}
		
		if(strlen($t_strPer) != 0 && strlen($t_strDivSec) != 0)
		{
			$strWhereSQL = " WHERE $t_strPer = '$t_strDivSec' ";
		}
		else
		{
			$strWhereSQL = " ";
		}
		
		$t_strFrstVl='All Employees';
		
		echo "<select name='$t_strComboName' size='5'>";
		if($t_strEmp == "")
		{
	        echo "<option selected>$t_strFrstVl</option>";
		}
		else
		{
			echo "<option>All Employees</option>";
		}

		if($t_strRprtType == "CEC")
		{
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname 
							FROM tblEmpPersonal
							INNER JOIN tblEmpPosition
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblPosition
									ON tblEmpPosition.positionCode = tblPosition.positionCode
									INNER JOIN tblAppointment
										ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode"
							.$strWhereSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		elseif($t_strRprtType == "SR")
		{
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname 
							FROM tblEmpPersonal 
							INNER JOIN tblServiceRecord 
								ON tblEmpPersonal.empNumber = tblServiceRecord.empNumber
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber"
							.$strWhereSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		elseif($t_strRprtType == "LT")
		{
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname 
							FROM tblEmpPersonal 
							INNER JOIN tblEmpTraining
								ON tblEmpPersonal.empNumber = tblEmpTraining.empNumber
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber"
							.$strWhereSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		elseif($t_strRprtType == "DTR")
		{
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname 
							FROM tblEmpPersonal 
							LEFT JOIN tblEmpPosition 
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
							INNER JOIN tblDivision
								ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								AND tblEmpPosition.dtrSwitch = 'Y' 
								AND tblEmpPosition.statusOfAppointment = 'In-Service'"
							.$strWhereSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";						
		}
		elseif($t_strRprtType == "PS" || $t_strRprtType == "PSAC")
		{
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPosition.statusOfAppointment
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
								INNER JOIN tblEmpIncome 
									ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber"
								.$strWhereSQL.
								"WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
								 ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		elseif($t_strRprtType == "LB" || $t_strRprtType == "LWOP" || $t_strRprtType == "TR" || $t_strRprtType == "AL" || $t_strRprtType == "EAS")
		{
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblEmpLeaveBalance
									ON tblEmpPersonal.empNumber = tblEmpLeaveBalance.empNumber"
								.$strWhereSQL.	
								"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
/*		elseif($t_strRprtType == "EAS")
		{
			$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
							tblEmpPersonal.firstname
						FROM tblEmpPersonal
						INNER JOIN tblEmpPosition
							ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber"
						.$strWhereSQL.
						"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}*/
		elseif($t_strRprtType == "CDR")
		{
			$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
					tblEmpPersonal.firstname
				FROM tblEmpPersonal
				INNER JOIN tblEmpPosition
					ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
					INNER JOIN tblPosition
						ON tblEmpPosition.positionCode = tblPosition.positionCode
						INNER JOIN tblDivision
							ON tblEmpPosition.divisionCode = tblDivision.divisionCode
							INNER JOIN tblEmpDuties
								ON tblEmpDuties.empNumber = tblEmpPosition.empNumber"
				.$strWhereSQL.
				"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		elseif($t_strRprtType == "MCR" || $t_strRprtType == "HPR")
		{
				$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname 
							FROM tblEmpPersonal 
							INNER JOIN tblEmpPosition 
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
							INNER JOIN tblEmpDTR 
								ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber"
								.$strWhereSQL;	
				$objLeave = mysql_query("SELECT leaveCode FROM tblLeave");

				while($arrLeave = mysql_fetch_array($objLeave))
				{
					if($intFlag == 0)
					{
						$strStmt = " AND (";
						$intFlag = 1;
					}
					else
					{
						$strStmt = " OR ";
					}
					$strCndtn = "tblEmpDTR.remarks = '".$arrLeave["leaveCode"]."'";
					
					$strSQL = $strSQL.$strStmt.$strCndtn;
				}
				
				$strSQL = $strSQL.") ".$strAndSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";										
						
		}
		else					
		{
				$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname
							FROM tblEmpPersonal
							INNER JOIN tblEmpPosition
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblPosition
									ON tblEmpPosition.positionCode = tblPosition.positionCode
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode"
							.$strWhereSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		
		}
		
		$objEmp = mysql_query($strSQL);
		
		while($arrEmp = mysql_fetch_array($objEmp))
		{
			$strComboElements =  $arrEmp["surname"].", ".$arrEmp["firstname"];
			if($arrEmp["empNumber"] == $t_strEmp)
			{
				echo "<option value='".$arrEmp["empNumber"]."' selected>$strComboElements</option>";	
			}
			else
			{
				echo "<option value='".$arrEmp["empNumber"]."'>$strComboElements</option>";
			}
		}
        echo "</select>";
	}

	
	function gender($t_strComboName, $t_strGender='')
	{
		echo "<select name='$t_strComboName' size='1'>";

		if($t_strGender == "" || $t_strGender == "F")
		{
	        echo "<option value='F' selected>Female</option>";
		}
		else
		{
			echo "<option value='F'>Female</option>";
		}
		
		if($t_strGender == "M")
		{
	        echo "<option value='M' selected>Male</option>";
		}
		else
		{
			echo "<option value='M'>Male</option>";
		}
		echo "</select>";	
	}
	
	function civilStatus($t_strComboName, $t_strCivil='')
	{
		echo "<select name='$t_strComboName' size='1'>";
		
		$arrCivil = array(1=>'Married', 2=>'Separated', 3=>'Single', 4=>'Widowed');
		
		if ($t_strCivil=='')
		{
			$t_strCivil="Single";
		}
		
		for($intCounter=1; $intCounter<=4; $intCounter++)
		{
			if($t_strCivil == $arrCivil[$intCounter])
			{
				echo "<option value='$arrCivil[$intCounter]' selected>$arrCivil[$intCounter]</option>";
			}
			else
			{
				echo "<option value='$arrCivil[$intCounter]'>$arrCivil[$intCounter]</option>";
			}
		}		
		echo "</select>";
	}
	
	function comboMonday($t_strComboName, $t_intMonth, $t_intYear, $t_intDay='')
	{
		echo "<select name='$t_strComboName' size='1'>";
		
		if($t_intMonth == date("n") && $t_intYear == date("Y"))
		{
			$intDay = date("j");	
		}
		else
		{
			$intDate = $this->combineDate($t_intYear, $t_intMonth, "01");
			$intDay = date("t",strtotime($intDate));
		}
		
		for($intCount=1; $intCount<=$intDay; $intCount++)
		{
			$intDate = $this->combineDate($t_intYear, $t_intMonth, $intCount);
			$strDayName = date("l", strtotime($intDate));
			if($strDayName == "Monday")
			{
				if ($t_intDay == $intCount)
				{
					print "<option value='$intCount' selected>$intCount</option>";
				}
				else
				{
					print "<option value='$intCount'>$intCount</option>";
				}
			}
		}
		echo "</select>";
	}
	
	function comboHour($t_strComboName, $t_intHour='')
	{
		echo "<select name='$t_strComboName' size='1'>";
		for($intCount=0; $intCount<=12; $intCount++)
		{
			if(strlen($intCount) == 1)
			{
				$intHour = "0".$intCount;
			}
			else
			{
				$intHour = $intCount;
			}
			if($t_intHour == $intHour)
			{
				print "<option value='$intHour' selected>$intHour</option>";
			}
			else
			{
				print "<option value='$intHour'>$intHour</option>";
			}
		}
		echo "</select>";
	}

	function comboHourBlank($t_strComboName, $t_intHour='')
	{
		echo "<select name='$t_strComboName' size='1'>";
		print "<option value=''></option>";
		for($intCount=0; $intCount<=12; $intCount++)
		{
			if(strlen($intCount) == 1)
			{
				$intHour = "0".$intCount;
			}
			else
			{
				$intHour = $intCount;
			}
			if($t_intHour == $intHour)
			{
				print "<option value='$intHour' selected>$intHour</option>";
			}
			else
			{
				print "<option value='$intHour'>$intHour</option>";
			}
		}
		echo "</select>";
	}

	function comboMinSec($t_strComboName, $t_intMinSec='')
	{
		echo "<select name='$t_strComboName' size='1'>";
		for($intCount=0; $intCount<=59; $intCount++)
		{
			if(strlen($intCount) == 1)
			{
				$intMinSec = "0".$intCount;
			}
			else
			{
				$intMinSec = $intCount;
			}
			if($intMinSec == $t_intMinSec)
			{
				print "<option value='$intMinSec' selected>$intMinSec</option>";
			}
			else
			{
				print "<option value='$intMinSec'>$intMinSec</option>";
			}
		}
		echo "</select>";
	}

	function comboMinSecBlank($t_strComboName, $t_intMinSec='')
	{
		echo "<select name='$t_strComboName' size='1'>";
		print "<option value=''></option>";
		for($intCount=0; $intCount<=59; $intCount++)
		{
			if(strlen($intCount) == 1)
			{
				$intMinSec = "0".$intCount;
			}
			else
			{
				$intMinSec = $intCount;
			}
			if($intMinSec == $t_intMinSec)
			{
				print "<option value='$intMinSec' selected>$intMinSec</option>";
			}
			else
			{
				print "<option value='$intMinSec'>$intMinSec</option>";
			}
		}
		echo "</select>";
	}
	
	function combineHrMnSc($t_strHour, $t_strMin, $t_strSec)
	{
		$strTime = $t_strHour.":".$t_strMin.":".$t_strSec;
		
		return $strTime;
	}
	
	function alterArrow($t_strValue, $t_strCompare)
	{
	   if($t_strValue == $t_strCompare)
	   {
	   		echo "<img src='images/indicator1.jpg' border='0'>";
	   }
	   else
	   {
	   		echo "<img src='images/indicator2.jpg' border='0'>";	   
	   }
	}
	
	function comboAMPM($t_strComboName, $t_intAMPM='PM')
	{
		echo "<select name='$t_strComboName'>";
		if($t_intAMPM == 'AM')
		{
			echo "<option value='AM' selected>AM</option>";
		}
		else
		{
			echo "<option value='AM'>AM</option>";
		}

		if($t_intAMPM == 'PM')
		{
			echo "<option value='PM' selected>PM</option>";
		}
		else
		{
			echo "<option value='PM'>PM</option>";
		}
										 
		echo "</select>";
	}

	function comboAMPMBlank($t_strComboName, $t_intAMPM='')
	{
		echo "<select name='$t_strComboName'>";
		echo "<option value=''></option>";
		if($t_intAMPM == 'AM')
		{
			echo "<option value='AM' selected>AM</option>";
		}
		else
		{
			echo "<option value='AM'>AM</option>";
		}

		if($t_intAMPM == 'PM')
		{
			echo "<option value='PM' selected>PM</option>";
		}
		else
		{
			echo "<option value='PM'>PM</option>";
		}
										 
		echo "</select>";
	}

	
	function comboReportType($t_strComboName, $t_intModule, $t_strRprtType='', $t_strOnChange, $t_strDfltValue)
	{
		$objRprtType = mysql_query("SELECT reportCode, reportDesc
									FROM tblReportType
									WHERE reportModule LIKE '%$t_intModule%' 
										AND reportType = '$t_strRprtType'
									ORDER BY reportDesc");
		echo "<select name='$t_strComboName' onChange='$t_strOnChange'>";
		
		while($arrRprtType = mysql_fetch_array($objRprtType))
		{
			$strRprtCode = $arrRprtType["reportCode"];
			$strRprtDesc = $arrRprtType["reportDesc"];
			
			if($t_strDfltValue == $strRprtCode && strlen($t_strDfltValue) != 0)
			{
				echo "<option value='$strRprtCode' selected>$strRprtDesc</option>";
			}

			else
			{
				echo "<option value='$strRprtCode'>$strRprtDesc</option>";
			}
		}
		echo "</select>";
	}
	
	function comboDeductionType($t_strComboName, $t_strOnChange, $t_strDfltValue)
	{
		$objDdctnType = mysql_query("SELECT deductionCode, deductionDesc
									FROM tblDeduction
									ORDER BY deductionDesc");
		echo "<select name='$t_strComboName' onChange='$t_strOnChange'>";
		
		while($arrDdctnType = mysql_fetch_array($objDdctnType))
		{
			$strDdctnCode = $arrDdctnType["deductionCode"];
			$strDdctnDesc = $arrDdctnType["deductionDesc"];
			
			if($t_strDfltValue == $strDdctnCode && strlen($t_strDfltValue) != 0)
			{
				echo "<option value='$strDdctnCode' selected>$strDdctnDesc</option>";
			}

			else
			{
				echo "<option value='$strDdctnCode'>$strDdctnDesc</option>";
			}
		}
		echo "</select>";
	}
	
	function navigateEmployee($t_strMonth, $t_strYear, $t_strLink='', $t_strDivision='')
	{
		if($t_strLink == '')
		{
			$t_strLink = $_SERVER['PHP_SELF'];
		}
		
		if(strlen($t_strDivision) != 0)
		{
			$strAND = " AND tblEmpPosition.divisionCode = '$t_strDivision' ";
		}
		else
		{
			$strAND = "";
		}


		$intMonth = $this->monthForSearch($t_strMonth);
		$intYear = $this->yearForSearch($t_strYear);
		$arrAlphabet = array( 1=>'A', 2=>'B', 3=>'C', 4=>'D', 5=>'E', 6=>'F', 7=>'G', 
					8=>'H', 9=>'I', 10=>'J', 11=>'K', 12=>'L', 13=>'M', 14=>'N', 15=>'O', 
					16=>'P', 17=>'Q', 18=>'R', 19=>'S', 20=>'T', 21=>'U', 22=>'V', 
					23=>'W', 24=>'X', 25=>'Y', 26=>'Z');
		
		foreach($arrAlphabet as $intKey=>$strLetter)
		{
			$dtmQueryDate = $this->combineDate($intYear, $intMonth, "01");   //neded for longevity
			$intTotalMonthDay = date('t' ,strtotime($dtmQueryDate));
			$dtmQueryDate = $this->combineDate($intYear, $intMonth, $intTotalMonthDay);   //neded for longevity
			
			$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
						tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
						tblEmpPosition.divisionCode, tblDivision.divisionName, 
						tblDivision.divisionHead, tblDivision.divisionHeadTitle,
						tblAppointment.leaveEntitled 
					FROM tblEmpPersonal 
					LEFT JOIN tblEmpPosition 
						ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
						INNER JOIN tblDivision
							ON tblEmpPosition.divisionCode = tblDivision.divisionCode
							INNER JOIN tblAppointment
								ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
					WHERE tblEmpPersonal.surname LIKE '$strLetter%' 
						AND tblEmpPosition.longevityDate <= '$dtmQueryDate' ".$strAND.
					" ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";	
			
			$objEmp = mysql_query($strSQL);
			
			if(mysql_num_rows($objEmp) == 0)
			{
				echo $strLetter."&nbsp;";
			}
			else
			{
				echo "<a href='".$t_strLink."?a=a&".$this->varstr."&strLetter=$strLetter' onMouseOver='statusBar(); return true;' onClick='statusBar();' onMouseUp='statusBar();' onFocus='statusBar();'>".$strLetter."</a>&nbsp;";
			}
		}		
	}
	
	function monthForSearch($t_intMonth)
	{
		if(strlen($t_intMonth) != 0)
		{
			return $t_intMonth;
		}
		else
		{
			return date('n');
		}
	}

	function yearForSearch($t_intYear)
	{
		if(strlen($t_intYear) != 0)
		{
			return $t_intYear;
		}
		else
		{
			return date('Y');
		}
	}

	function lastDayOfMonthYear($t_intYear, $t_intMonth)
	{
		$dtmDummy = $this->combineDate($t_intYear, $t_intMonth, "01");
		
		$intDays = date('t', strtotime($dtmDummy));
		
		$dtmLastDay = $this->combineDate($t_intYear, $t_intMonth, $intDays);
		
		return $dtmLastDay;
	}
	
	function trapButton($t_strSearch, $t_strLetter, $t_strErrLink, $t_strBckLink)
	{
		if((strlen($t_strSearch) == 0 || strlen($t_strSearch) == 1) && strlen($t_strLetter) == 0)
		{
			$strNoMatch = $t_strErrLink."?intError=1&strBckLink=$t_strBckLink".$this->varstr;
			header("Location: $strNoMatch");			
		}
	}
	
	function getDateToday()
	{
		return date('Y,n,j,G,').intval(date('i')).','.intval(date('s'));
	}
	
	function getDayName($t_intMonth, $t_intYear, $t_intDay)
	{
		$intDate = $this->combineDate($t_intYear, $t_intMonth, $t_intDay);
		return date('l', $intDate);
	}
	
	function checkIfHoliday($t_intMonth, $t_intYear, $t_intDay)
	{
		$intDate = $this->combineDate($t_intYear, $t_intMonth, $t_intDay);
		$objHoliday = mysql_query("SELECT holidayDate FROM tblHolidayYear
									WHERE holidayDate='$intDate'");
		return mysql_num_rows($objHoliday);
	}
	
	function comboDivision($t_strComboName, $t_strDfltValue, $t_strOnChange='')
	{
		echo "<select name='$t_strComboName' size='1' onChange='$t_strOnChange'>";
		$objDivision = mysql_query("SELECT divisionCode FROM tblDivision ORDER BY divisionCode");

		echo "<option value='' selected>&nbsp;</option>";

		while($arrDivision = mysql_fetch_array($objDivision))
		{
			if($t_strDfltValue == $arrDivision["divisionCode"])
			{
				echo "<option value='".$arrDivision["divisionCode"]."' selected>".$arrDivision["divisionCode"]."</option>";
			}
			else
			{
				echo "<option value='".$arrDivision["divisionCode"]."'>".$arrDivision["divisionCode"]."</option>";
			}
		}
        echo "</select>";	
	}

	function comboSection($t_strComboName, $t_strDfltValue, $t_strOnChange='')
	{
		echo "<select name='$t_strComboName' size='1' onChange='$t_strOnChange'>";
		$objSection = mysql_query("SELECT * FROM tblSection ORDER BY sectionName");
		
		while($arrSection = mysql_fetch_array($objSection))
		{
			if($t_strDfltValue == $arrSection["sectionCode"])
			{
				echo "<option value='".$arrSection["sectionCode"]."' selected>".$arrSection["sectionName"]."</option>";
			}
			else
			{
				echo "<option value='".$arrSection["sectionCode"]."'>".$arrSection["sectionName"]."</option>";
			}
		}
        echo "</select>";	
	}

	function getChiefDivision($t_strEmpNmbr)
	{
		$objDivision = mysql_query("SELECT divisionCode FROM tblEmpPosition
										WHERE empNumber='$t_strEmpNmbr'");
		$arrDivision = mysql_fetch_array($objDivision);
		return $arrDivision["divisionCode"];
	}	
	
	function positionCode($t_strEmpNumber, $t_strItemNumber)   //  Position Code
	{
		if (strlen($t_strEmpNumber) == 0)
		{
		$t_strEmpNumber = $this->strEmpNumber;
		}
		
		if (strlen($t_strItemNumber) == 0)
		{
		$t_strItemNumber = $this->strItemNumber;
		}
		
		$objPositionCode = mysql_query("SELECT positionCode FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objPositionCode);
		return $row["positionCode"];
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
				
		$objPositionCode = mysql_query("SELECT authorizeSalary FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objPositionCode);
		return $row["authorizeSalary"];
		
	}
	
	function authorizeSalaryYear($t_strItemNumber)		//  Authorize Salary per year
	{

		if (strlen($t_strItemNumber) == 0)
		{
			$t_strItemNumber = $this->strItemNumber;
		}
				
		$objAuthorizeSalary = mysql_query("SELECT authorizeSalaryYear FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objAuthorizeSalary);
		$intAuthSalaryYear = $row['authorizeSalaryYear'];
		$t_intAuthSalaryYear = $intAuthSalaryYear;
		return $t_intAuthSalaryYear;
		
	}
	
	function comboItemNumber($t_strItemNumber)
	{
	
		$objItemNumber = mysql_query ("SELECT * FROM tblPlantilla");
		if ($row = mysql_fetch_array($objItemNumber)) 
		{
			do {
				if ($row["itemNumber"])
				{
				print "<OPTION VALUE=\"".($row["itemNumber"])."\" selected>".($row["itemNumber"])."\r";
				}
			print "<OPTION VALUE=\"".($row["itemNumber"])."\">".($row["itemNumber"])."\r";
			} while($row = mysql_fetch_array($objItemNumber));
		} else {
			print "no results!";
		}
	}

	function epochDate($t_strDateCode, $t_dtmDate)
	{
		$arrExpldDate = explode("-", $t_dtmDate);
		if ($t_strDateCode == "Y")
		{
			return $arrExpldDate[0];
		}
		elseif($t_strDateCode == "n")
		{
			return intval($arrExpldDate[1]);
		}
		elseif($t_strDateCode == "j")
		{
			return intval($arrExpldDate[2]);		
		}
	}	
}
?>