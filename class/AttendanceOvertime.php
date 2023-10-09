<?
/* 
File Name: AttendanceOvertime.php 
----------------------------------------------------------------------
Purpose of this file: 
Class attendance overtime
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 15, 2004
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

require("../hrmis/class/AttendanceFC.php");
class AttendanceOvertime extends AttendanceFC
{
//------------------------------------- override the overtime ---------------------------------------
	function overtime($t_strEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_dtmTimeFrom, $t_strTimeFrom, $t_dtmTimeTo, $t_strTimeTo, $t_strPurpose, $t_strOutput, $t_strDocNmbr)
	{   //adds leave to tblEmpLeave
		$strDateFrom = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $t_intDayFrom);
		$strDateTo = $this->combineDate($t_intYearTo, $t_intMonthTo, $t_intDayTo);
		$strTimeFrom = $this->combineTime($t_dtmTimeFrom, $t_strTimeFrom);
		$strTimeTo = $this->combineTime($t_dtmTimeTo, $t_strTimeTo);		
		$dtmDateNow = date("Y-m-d");

		mysql_query("INSERT INTO tblEmpOvertime (dateFiled, empNumber, otPurpose, otOutput,
							docNumber, otDateFrom, otDateTo, otTimeFrom, otTimeTo)
					VALUES ('$dtmDateNow', '$t_strEmpNmbr', '$t_strPurpose', '$t_strOutput', 
							'$t_strDocNmbr','$strDateFrom','$strDateTo', '$strTimeFrom', '$strTimeTo')");
		
		$intNewID = mysql_insert_id();
						
		$t_intDayFrom = intval($t_intDayFrom);
		$t_intDayTo = intval($t_intDayTo);
		for($intCounter = $t_intDayFrom; $intCounter <= $t_intDayTo; $intCounter++)
		{
			$strDate = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $intCounter);				
			
			$objDay = mysql_query("SELECT * FROM tblEmpDTR 
									WHERE empNumber = '$t_strEmpNmbr' 
										AND dtrDate = '$strDate'");
	
			$strSql = $this->sqlOvertimeDTR($intNewID, $objDay, $t_strEmpNmbr, $strDate, $t_strTimeFrom, $t_strTimeTo, $strTimeFrom, $strTimeTo);
			mysql_query($strSql);

		}	
	}
	
	function overrideOvertime($t_strEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_dtmTimeFrom, $t_strTimeFrom, $t_dtmTimeTo, $t_strTimeTo, $t_strPurpose, $t_strOutput, $t_strDocNmbr)
	{
		$this->overtime($t_strEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_dtmTimeFrom, $t_strTimeFrom, $t_dtmTimeTo, $t_strTimeTo, $t_strPurpose, $t_strOutput, $t_strDocNmbr);
		
		$strPage = "DTR.php?a=a".$this->varstr;
		header("Location: $strPage");										
	}
	
	function sqlOvertimeDTR($t_intNewID, $t_objDay, $t_strEmpNmbr, $t_strDate, $t_strFromAMPM, $t_strToAMPM, $t_strTimeFrom, $t_strTimeTo)
	{
		if(!mysql_num_rows($t_objDay))   //if YYYY-MM-DD is not exist
		{				
			$strSQL = "INSERT INTO tblEmpDTR (empNumber, dtrDate, remarks, otherInfo)
						VALUES('$t_strEmpNmbr', '$t_strDate', '".OVERTIME."', '$t_intNewID')";
			return $strSQL;
		}
		else   //if the date exist in tblEmpDTR, it must be update
		{
			$strSQL = "UPDATE tblEmpDTR SET remarks = '".OVERTIME."', otherInfo = '$t_intNewID'
							WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$t_strDate'";
			return $strSQL; 
		}
	}
}
?>