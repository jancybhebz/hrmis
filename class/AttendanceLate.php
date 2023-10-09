<?
/* 
File Name: AttendanceLate.php 
----------------------------------------------------------------------
Purpose of this file: 
Class attendance late
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

require("../hrmis/class/AttendanceLeave.php");
class AttendanceLate extends AttendanceLeave
{
	function daysLate($t_strMonth, $t_strYear, $t_strEmpNmbr)
	{   //add the days late and hours late
		$this->strNmbrDays = "";
		$strMonthYear = $this->combineMonthYear($t_strYear, $t_strMonth);
		$dtmOfficialTime = $this->getOfficialTimeIn("end", $t_strEmpNmbr);   //get the official time in
		
		$objDaysLate = mysql_query("SELECT dtrDate, inAM, inPM FROM tblEmpDTR 
										WHERE empNumber = '$t_strEmpNmbr' 
											AND inAM > '$dtmOfficialTime'
											AND inAM != '".NULLTIME."'											 
											AND dtrDate LIKE '$strMonthYear%' 
										ORDER BY dtrDate");
			
		while($arrDaysLate = mysql_fetch_array($objDaysLate))
		{
			$this->strNmbrDays = $this->strNmbrDays.substr($arrDaysLate['dtrDate'], -2).", ";  //add days late

			$dtmTimeDiff = strtotime($arrDaysLate['inAM']) - strtotime($dtmOfficialTime);   //all the late
			//get the late difference(some agaency sliding time 7-9 to 4-6 but 7:15 is late)
			$this->dtmLateHours = $this->dtmLateHours + $dtmTimeDiff;  //is added, seconds
		}
		return substr($this->strNmbrDays, 0, -2);
	}
	
	function getOfficialTimeIn($t_strMode, $t_strEmpNmbr, $t_blnLeaveCredits='1')
	{   //get official time in
		
		$objOfficialTime = mysql_query("SELECT tblAttendanceScheme.amTimeinFrom, 
											tblAttendanceScheme.amTimeinTo,
											tblAttendanceScheme.gracePeriod,
											tblAttendanceScheme.gpLeaveCredits, 
											tblAttendanceScheme.gpLate
										FROM tblAttendanceScheme
										INNER JOIN tblEmpPosition 
											ON tblAttendanceScheme.schemeCode = tblEmpPosition.schemeCode
										WHERE tblEmpPosition.empNumber = '$t_strEmpNmbr'");

		while($arrOfficialTime = mysql_fetch_array($objOfficialTime))
		{
			if($t_blnLeaveCredits)
			{
				$dtmSchmTime = $arrOfficialTime['gpLeaveCredits'];
			}
			else
			{
				$dtmSchmTime = $arrOfficialTime['gpLate'];
			}

			if($t_strMode == "begin")
			{
				return $arrOfficialTime['amTimeinFrom'];
			}
			elseif($dtmSchmTime == YES && $t_strMode == "end")
			{
				return $arrOfficialTime['amTimeinTo'];
			}
			elseif($dtmSchmTime == NO && $t_strMode == "end")
			{
				$strGrcPrd = $arrOfficialTime['gracePeriod'].substr($arrOfficialTime['amTimeinTo'], -3);
				$strGrcPrd = substr($arrOfficialTime['amTimeinTo'], 0, 3).$strGrcPrd;
				return $strGrcPrd;
			}
		}
	}
	
	function getOfficialTimeInNoon($t_strMode, $t_strEmpNmbr, $t_blnLeaveCredits='1')
	{   //get official time in
		
		$objOfficialTime = mysql_query("SELECT tblAttendanceScheme.nnTimeinFrom, 
											tblAttendanceScheme.nnTimeinTo,
											tblAttendanceScheme.gracePeriod,
											tblAttendanceScheme.gpLeaveCredits, 
											tblAttendanceScheme.gpLate
										FROM tblAttendanceScheme
										INNER JOIN tblEmpPosition 
											ON tblAttendanceScheme.schemeCode = tblEmpPosition.schemeCode
										WHERE tblEmpPosition.empNumber = '$t_strEmpNmbr'");

		while($arrOfficialTime = mysql_fetch_array($objOfficialTime))
		{
			if($t_blnLeaveCredits)
			{
				$dtmSchmTime = $arrOfficialTime['gpLeaveCredits'];
			}
			else
			{
				$dtmSchmTime = $arrOfficialTime['gpLate'];
			}

			if($t_strMode == "begin")
			{
				return $arrOfficialTime['nnTimeinFrom'];
			}
			elseif($dtmSchmTime == YES && $t_strMode == "end")
			{
				return $arrOfficialTime['nnTimeinTo'];
			}
			elseif($dtmSchmTime == NO && $t_strMode == "end")
			{
				$strGrcPrd = $arrOfficialTime['gracePeriod'].substr($arrOfficialTime['nnTimeinTo'], -3);
				$strGrcPrd = substr($arrOfficialTime['nnTimeinTo'], 0, 3).$strGrcPrd;
				return $strGrcPrd;
			}
		}
	}	
	
	function getOfficialTimeOut($t_strMode, $t_strEmpNmbr)
	{   //get official time out
		$objOfficialTime = mysql_query("SELECT tblAttendanceScheme.pmTimeoutFrom, 
											tblAttendanceScheme.pmTimeoutTo
										FROM tblAttendanceScheme
										INNER JOIN tblEmpPosition 
											ON tblAttendanceScheme.schemeCode = tblEmpPosition.schemeCode
										WHERE tblEmpPosition.empNumber = '$t_strEmpNmbr'");
		while($arrOfficialTime = mysql_fetch_array($objOfficialTime))
		{
			if($arrOfficialTime['pmTimeoutFrom'] != NULLTIME && $t_strMode == "begin")
			{
				return $arrOfficialTime['pmTimeoutFrom'];
			}
			elseif($arrOfficialTime['pmTimeoutTo'] != NULLTIME && $t_strMode == "end")
			{
				return $arrOfficialTime['pmTimeoutTo'];
			}
		}
	}
	
	function getTimeIn($t_dtmInAM, $t_dtmInPM)
	{
		if($t_dtmInAM != NULLTIME)
		{
			return $t_dtmInAM;
		}
		elseif ($t_dtmInPM != NULLTIME)
		{
			return $t_dtmInPM;
		}
	}
	
	function getTotalLate()
	{  //monthly late
		$this->dtmLateHours = $this->dtmLateHours/60/60;   //converts in hours
		$this->dtmLateHours = number_format($this->dtmLateHours, 2, ".", "");
		return $this->dtmLateHours;
	}
}
?>