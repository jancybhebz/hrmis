<?
/* 
File Name: AttendanceCompensation.php
----------------------------------------------------------------------
Purpose of this file: 
Class attendance
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
require_once("../hrmis/class/Attendance.php");
define('WORKTIME', 28800);  // 8 HOURS, 28800 in seconds
class AttendanceCompensation extends Attendance
{
	var $intWorkTime;
	
	function AttendanceCompensation()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection	
	}
	
	function getMonthHoliday($t_intMonth, $t_intYear)
	{
		$arrMonthYear = $this->getPreMonth($t_intMonth, $t_intYear);
		$dtmMonthYear = $this->combineMonthYear($arrMonthYear["year"], $arrMonthYear["month"]);
		
		$objMonthHoliday = mysql_query("SELECT holidayDate 
										FROM tblHolidayYear 
										WHERE holidayDate LIKE '$dtmMonthYear%'");
		if(mysql_num_rows($objMonthHoliday))
		{
			$intHoliday = 0;
			while($arrHoliday = mysql_fetch_array($objMonthHoliday))
			{
				$strHolidayName = date('D', $arrHoliday['holidayDate']);
			}
			
			if($strHolidayName != "Sun" ||$strHolidayName != "Sat")
			{
				$intHoliday++;
			}
		}
		else
		{
			$intHoliday = 0;
		}
		return $intHoliday;
	}
		
	function getWeekdays($t_intMonth, $t_intYear)
	{
		$arrMonthYear = $this->getPreMonth($t_intMonth, $t_intYear);
		
		$dtmDate = $this->combineDate($arrMonthYear["year"], $arrMonthYear["month"], "01");
		$intMonthDays = date('t', strtotime($dtmDate));

		$intSatSunCntr = 0;
		for($intCount=1; $intCount <= $intMonthDays; $intCount++)
		{
			$dtmWeekDate = $this->combineDate($arrMonthYear["year"], $arrMonthYear["month"], $intCount);
			$strDayName = date('D', strtotime($dtmWeekDate));
			
			if($strDayName == "Sun" || $strDayName == "Sat")
			{
				$intSatSunCntr++;
			}
		}
		
		$intDays = $intMonthDays - $intSatSunCntr;
		return $intDays;
	}

	function getEmpAbsent($t_strEmpNmbr, $t_intMonth, $t_intYear)
	{
		$dtmMonthYear = $this->combineMonthYear($t_intYear, $t_intMonth);
		$objAbsent = mysql_query("SELECT dtrDate FROM tblEmpDTR
									WHERE empNumber='$t_strEmpNmbr'
										AND dtrDate LIKE '$dtmMonthYear%' 
										AND remarks = '".ABSENT."'");
		$intAbsent = mysql_num_rows($objAbsent);
		return $intAbsent;
	}
	
	function getOvertime($t_strEmpNmbr, $t_intMonth, $t_intYear)
	{
		$arrMonthYear = $this->getPreMonth($t_intMonth, $t_intYear);
		$dtmMonthYear = $this->combineMonthYear($arrMonthYear["year"], $arrMonthYear["month"]);

		$objOvrtm = mysql_query("SELECT dtrDate, inOT, outOT FROM tblEmpDTR 
									WHERE inOT != '".NULLDATE."' 
										AND outOT != '".NULLDATE."'
										AND empNumber = '$t_strEmpNmbr'
										AND dtrDate LIKE '$dtmMonthYear%'");
		if(mysql_num_rows($objOvrtm))
		{
			$intOvrtm = 0;
			while($arrOvrtm = mysql_fetch_array($objOvrtm))
			{
				if($arrOvrtm['outOT'] < MIDNIGHT)
				{
					$dtmOvrtm = strtotime($arrOvrtm['outOT']) - strtotime($arrOvrtm['inOT']);
				}
				$intOvrtm += $dtmOvrtm;
			}
			$intOvrtm = $intOvrtm/60/60;
			return $intOvrtm;
		}
		else
		{
			return 0;
		}
	}

	function getWithoutPay($t_strEmpNmbr, $t_blnLeaveEntitled, $t_intMonth, $t_intYear)
	{
		$arrMonthYear = $this->getPreMonth($t_intMonth, $t_intYear);
		$t_intMonth = $arrMonthYear["month"];
		$t_intYear = $arrMonthYear["year"];
		if($t_blnLeaveEntitled == 'Y')
		{
			$objLeaveWOP = mysql_query("SELECT vlAbsUndWoPay, slAbsUndWoPay 
										FROM tblEmpLeaveBalance 
										WHERE empNumber = '$t_strEmpNmbr' AND
											periodMonth = '$t_intMonth' AND
											periodYear = '$t_intYear'");
			if(mysql_num_rows($objLeaveWOP))
			{
				$arrWOP = mysql_fetch_array($objLeaveWOP);
				$intWOP = $arrWOP['vlAbsUndWoPay'] + $arrWOP['slAbsUndWoPay'];
			}
			else
			{
				$intWOP = 0;
			}
		}
		elseif($t_blnLeaveEntitled == 'N')
		{
			$intAbsent = $this->getEmpAbsent($t_strEmpNmbr, $t_intMonth, $t_intYear);
			$arrLateUnd = $this->getLateUndPrMonth($t_strEmpNmbr, $t_intMonth, $t_intYear);
			
			$intWOP = $intAbsent + $arrLateUnd["compute"];
			$intWOP = number_format($intWOP, 2, ".", "");
		}
		return $intWOP;
	}

	function getPaymentBasis($t_strAppnmntCode, $t_intMonth, $t_intYear)
	{
		$arrMonthYear = $this->getPreMonth($t_intMonth, $t_intYear);
		$objAppnmnt = mysql_query("SELECT paymentBasis 
									FROM tblAppointment 
									WHERE appointmentCode='$t_strAppnmntCode'");
		$arrAppnmt = mysql_fetch_array($objAppnmnt);
		
		$dtmDate = $this->combineDate($arrMonthYear["year"], $arrMonthYear["month"], "01");
		$intMonthDays = date('t', strtotime($dtmDate));
		
		if($arrAppnmt['paymentBasis'] == CALENDAR_DAYS)
		{
			$intDays = $intMonthDays;
		}
		elseif($arrAppnmt['paymentBasis'] == WEEKDAYS)
		{
			$intDays = $this->getWeekdays($arrMonthYear["month"], $arrMonthYear["year"]);
		}
		
		return $intDays;
	}
	
	function getWoPay($t_strEmpNmbr, $t_blnLeaveEntitled, $t_intMonth, $t_intYear)
	{
		$intWOP = $this->getWithoutPay($t_strEmpNmbr, $t_blnLeaveEntitled, $t_intMonth, $t_intYear);
		if ($intWOP > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	function getPayrollLeave($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_strLeaveCode)
	{
		$arrMonthYear = $this->getPreMonth($t_intMonth, $t_intYear);
		$t_intMonth = $arrMonthYear["month"];
		$t_intYear = $arrMonthYear["year"];
		
		$strMonthYear = $this->combineMonthYear($t_intYear, $t_intMonth);
		$objLeaveCode = mysql_query("SELECT remarks FROM tblEmpDTR
								WHERE remarks = '$t_strLeaveCode' 
									AND empNumber = '$t_strEmpNmbr'  
									AND dtrDate LIKE '$strMonthYear%'");
									
		if(mysql_num_rows($objLeaveCode))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	function getLateUndAbsHlfYear($t_strEmpNmbr, $t_intYear)
	{
		$intLateUndAbsHlf = 0;
		
		for($intMonth = 1; $intMonth <= 12; $intMonth++)
		{
			$arrDTR = $this->getEmpDTR($t_strEmpNmbr, $intMonth, $t_intYear);
			$arrLateUnd = $this->getLateUndPrMonth($t_strEmpNmbr, $intMonth, $t_intYear, $arrDTR);
			$intLateUndAbsHlf = $intLateUndAbsHlf + $arrLateUnd["compute"] + $arrLateUnd["absent count"] + ($arrLateUnd["halfday count"] * 0.5);
		}
		return $intLateUndAbsHlf;
	}
}
?>