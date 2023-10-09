<?
/* 
File Name: AttendanceDTR.php 
----------------------------------------------------------------------
Purpose of this file: 
Class Attendance DTR 
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

require_once("../hrmis/class/AttendanceLeaveBalance.php");
include_once("../hrmis/class/Constant.php");
class AttendanceDTR extends AttendanceLeaveBalance
{	
	//leave Balance
	var $intEarned;
	var $intBalance;
	var $intDisableCheckBox = 0;
	
	function viewDTR($t_intMonth, $t_intYear, $t_strEmpNmbr, $t_blnCheckbox=1)    //for DTR viewing
	{
		$strDTRDate = $this->combineDate($t_intYear, $t_intMonth,"01");   //construct a date format YYYY-MM-DD
		$intDaysInMonth = date('t',strtotime($strDTRDate));   //get how many days in the month date('t')

		for ($intCounter=1; $intCounter <= $intDaysInMonth; $intCounter++)
		{
			$strDTRDate = $this->combineDate($t_intYear, $t_intMonth, $intCounter);
			$dtmDTRDate = date('Y-m-d',strtotime($strDTRDate));   //convert to date
			$strDay = date('l', strtotime($strDTRDate));   //day eg: Sunday, Monday
			$objEmpDTR = mysql_query("SELECT * FROM tblEmpDTR 
										WHERE empNumber = '$t_strEmpNmbr' 
										AND dtrDate = '$dtmDTRDate'");
			while($arrDTR = mysql_fetch_array($objEmpDTR))
			{
				$strInAM = $arrDTR["inAM"];
				$strOutAM = $arrDTR["outAM"];				
				$strInPM = $arrDTR["inPM"];
				$strOutPM = $arrDTR["outPM"];				
				$strInOT = $arrDTR["inOT"];
				$strOutOT = $arrDTR["outOT"];
				$strRemark = $arrDTR["remarks"];
				$strOther = $arrDTR["otherInfo"];			
			}

			$strRowBgColor = $this->alterRowBgColor($intCounter%2);
			echo $strRowBgColor;

			
			
			if (mysql_num_rows($objEmpDTR) != 0)
			{
				$blnTimeAM = $this->checkNullTime($strInAM, $strOutAM);
				$blnTimePM = $this->checkNullTime($strInPM, $strOutPM);
				$blnTimeOT = $this->checkNullTime($strInOT, $strOutOT);				
				$blnTime = $blnTimeAM || $blnTimePM || $blnTimeOT; 
				
				$strOutput = $this->outputTimeRecord($blnTime, $strInAM, $strOutAM, $strInPM, $strOutPM, $strInOT, $strOutOT, $strRemark, $strOther);
			}
			else
			{
				$strOutput = $this->outputNoTimeRecord($strDay, $dtmDTRDate);
			}
 			
			if($t_blnCheckbox)
			{
				echo "<td align='left'><input type='checkbox' name='chkDate[$intCounter]' value='$intCounter'>&nbsp;&nbsp;$intCounter</td>";
			}
			else
			{
				echo "<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;$intCounter</td>";
			}
			echo $strOutput;
            echo "</tr>";
		}   //end for
	}
	
	function outputTimeRecord($t_blnTime, $t_strInAM, $t_strOutAM, $t_strInPM, $t_strOutPM, $t_strInOT, $t_strOutOT, $t_strRemark, $t_strOther)
	{   //prints the time, if no time: leave or OB
		if ($t_blnTime)
		{
			if($t_strRemark != 'QB' && $t_strRemark != 'OB' && $t_strRemark != 'OT' && substr($t_strRemark,0,1) != 'H')
			{   //kpg hndi equal sa QB wlang babaguhin ng color...
				$this->intDisableCheckBox = 0;
				return "<td>$t_strInAM</td> 
						<td>$t_strOutAM</td>
						<td>$t_strInPM</td>
						<td>$t_strOutPM</td>
						<td>$t_strInOT</td>
						<td>$t_strOutOT</td>
						<td>$t_strRemark</td>";
				
										
			}
			elseif ($t_strRemark == 'QB' || $t_strRemark == 'OB')
			{ //equal sa Qb kasi highlight mga QB mo, bold kpg Qb
				$objQB=mysql_query("SELECT obTimeFrom, obTimeTo 
									FROM tblEmpOB 
									WHERE obID='$t_strOther'");
				
				$arrQB = mysql_fetch_array($objQB);
				$dtmFrom = date('g:i:s', strtotime($arrQB['obTimeFrom']));
				$dtmTo = date('g:i:s', strtotime($arrQB['obTimeTo']));
				
				if(strlen($dtmFrom) < 8)
				{  //kasi kpg g:i:s 9:00:00 lng lumalabas dapat 09:00:00
					$dtmFrom = "0".$dtmFrom;   //kya lagyan ko zero.
				}

				if(strlen($dtmTo) < 8)
				{  //kasi kpg g:i:s 9:00:00 lng lumalabas dapat 09:00:00
					$dtmTo = "0".$dtmTo;   //kya lagyan ko zero.
				}
				
				if($dtmFrom == $t_strInAM)
				{
					$strTd = "<td class='ob'>$t_strInAM</td>";
				}
				else
				{
					$strTd = "<td>$t_strInAM</td> ";
				}

				if($dtmTo == $t_strOutAM)
				{
					$strTd = $strTd."<td class='ob'>$t_strOutAM</td>";
				}
				else
				{
					$strTd = $strTd."<td>$t_strOutAM</td> ";
				}

				if($dtmFrom == $t_strInPM)
				{
					$strTd = $strTd."<td class='ob'>$t_strInPM</td>";
				}
				else
				{
					$strTd = $strTd."<td>$t_strInPM</td> ";
				}

				if($dtmTo == $t_strOutPM)
				{
					$strTd = $strTd."<td class='ob'>$t_strOutPM</td>";
				}
				else
				{
					$strTd = $strTd."<td>$t_strOutPM</td> ";
				}

				$strTd = $strTd."<td>$t_strInOT</td><td>$t_strOutOT</td><td class='ob'>$t_strRemark</td>";

				$this->intDisableCheckBox = 0;
				return $strTd;
			}
			elseif ($t_strRemark == 'OT')
			{ //equal sa Qb kasi highlight mga QB mo, bold kpg Qb
/*				$objQB=mysql_query("SELECT otTimeFrom, otTimeTo 
									FROM tblEmpOvertime 
									WHERE otID='$t_strOther'");
				
				$arrQB = mysql_fetch_array($objQB);
				$dtmFrom = date('g:i:s', strtotime($arrQB['otTimeFrom']));
				$dtmTo = date('g:i:s', strtotime($arrQB['otTimeTo']));
				
				if(strlen($dtmFrom) < 8)
				{  //kasi kpg g:i:s 9:00:00 lng lumalabas dapat 09:00:00
					$dtmFrom = "0".$dtmFrom;   //kya lagyan ko zero.
				}

				if(strlen($dtmTo) < 8)
				{  //kasi kpg g:i:s 9:00:00 lng lumalabas dapat 09:00:00
					$dtmTo = "0".$dtmTo;   //kya lagyan ko zero.
				}
				
				if($dtmFrom == $t_strInAM)
				{
					$strTd = "<td class='overtime'>$t_strInAM</td>";
				}
				else
				{
					$strTd = "<td>$t_strInAM</td> ";
				}

				if($dtmTo == $t_strOutAM)
				{
					$strTd = $strTd."<td class='overtime'>$t_strOutAM</td>";
				}
				else
				{
					$strTd = $strTd."<td>$t_strOutAM</td> ";
				}

				if($dtmFrom == $t_strInPM)
				{
					$strTd = $strTd."<td class='overtime'>$t_strInPM</td>";
				}
				else
				{
					$strTd = $strTd."<td>$t_strInPM</td> ";
				}

				if($dtmTo == $t_strOutPM)
				{
					$strTd = $strTd."<td class='overtime'>$t_strOutPM</td>";
				}
				else
				{
					$strTd = $strTd."<td>$t_strOutPM</td> ";
				}

				$strTd = $strTd."<td>$t_strInOT</td><td>$t_strOutOT</td>";
*/
				if($t_strInAM == NULLTIME)
				{
					$strTd = "<td>$t_strInAM</td>";
				}
				else
				{
					$strTd = "<td class='overtime'>$t_strInAM</td>";
				}
				if($t_strOutAM == NULLTIME)
				{
					$strTd = $strTd."<td>$t_strOutAM</td>";				
				}
				else
				{
					$strTd = $strTd."<td class='overtime'>$t_strOutAM</td>";				
				}
				
				if($t_strInPM == NULLTIME)
				{
					$strTd = $strTd."<td>$t_strInPM</td> ";
				}
				else
				{
					$strTd = $strTd."<td class='overtime'>$t_strInPM</td> ";
				}
				
				if($t_strOutPM == NULLTIME)
				{
					$strTd = $strTd."<td>$t_strOutPM</td>";
				}
				else
				{
					$strTd = $strTd."<td class='overtime'>$t_strOutPM</td>";
				}
				
				if($t_strInOT == NULLTIME)
				{
					$strTd = $strTd."<td>$t_strInOT</td>";
				}
				else
				{
					$strTd = $strTd."<td class='overtime'>$t_strInOT</td>";
				}
				
				if($t_strOutOT == NULLTIME)
				{
					$strTd = $strTd."<td>$t_strOutOT</td>";
				}
				else
				{
					$strTd = $strTd."<td class='overtime'>$t_strOutOT</td>";
				}
				$strTd = $strTd."<td class='overtime'>$t_strRemark</td>";								
				$this->intDisableCheckBox = 0;
				return $strTd;
			}
			elseif (substr($t_strRemark,0,1) == 'H')
			{ //equal sa Qb kasi highlight mga QB mo, bold kpg Qb
				if($t_strInAM == NULLTIME)
				{
					$strTd = "<td>$t_strInAM</td>";
				}
				else
				{
					$strTd = "<td class='leave'>$t_strInAM</td>";
				}
				
				if($t_strOutAM == NULLTIME)
				{
					$strTd = $strTd."<td>$t_strOutAM</td>";
				}
				else
				{
					$strTd = $strTd."<td class='leave'>$t_strOutAM</td>";
				}
				
				if($t_strInPM == NULLTIME)
				{
					$strTd = $strTd."<td>$t_strInPM</td> ";
				}
				else
				{
					$strTd = $strTd."<td class='leave'>$t_strInPM</td> ";
				}
				
				if($t_strOutPM == NULLTIME)
				{
					$strTd = $strTd."<td>$t_strOutPM</td>";
				}
				else
				{
					$strTd = $strTd."<td class='leave'>$t_strOutPM</td>";
				}
				$strTd = $strTd."<td>$t_strInOT</td><td>$t_strOutOT</td><td class='leave'>$t_strRemark</td>";								
				$this->intDisableCheckBox = 0;
				return $strTd;
			}
		}
		else
		{
			$objLv = mysql_query("SELECT leaveType FROM tblLeave WHERE leaveCode='$t_strRemark'");
			
			if(mysql_num_rows($objLv))
			{
				$arrLv = mysql_fetch_array($objLv);
	
				$this->intDisableCheckBox = 0;
				return "<td colspan='7'>".$arrLv["leaveType"]."</td>";
			}
			else
			{
				return "<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>$t_strRemark</td>";
			}
		}		
	}
	
	function outputNoTimeRecord($t_strDayName, $t_strDate)   
	{   //if no record of employee in selected YYYY-MM-DD in tblEmpDTR, system prints holidays or blank
		$objHoliday = mysql_query("SELECT tblHoliday.holidayName FROM tblHolidayYear
									INNER JOIN tblHoliday 
										ON tblHolidayYear.holidayCode = tblHoliday.holidayCode
									WHERE tblHolidayYear.holidayDate = '$t_strDate'");
		
		while($arrHoliday = mysql_fetch_array($objHoliday))
		{
			$strHoliday = $arrHoliday['holidayName'];
		}

		if(!mysql_num_rows($objHoliday))
		{
			if ($t_strDayName == "Sunday" || $t_strDayName == "Saturday")
			{
				$this->intDisableCheckBox = 1;
				return "<td colspan='7'>$t_strDayName</td>";
			}	
			else
			{
				$this->intDisableCheckBox = 0;
				return "<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>";				
			}
		}
		else
		{
			$this->intDisableCheckBox = 1;					
			return "<td colspan='7'>$strHoliday</td>";				
		}
	}
	
	function checkNullTime($t_dtmTimeIn, $t_dtmTimeOut)
	{   //check for null time 00:00:00
		$blnIn = $t_dtmTimeIn != NULLTIME;
		$blnOut = $t_dtmTimeOut != NULLTIME;
		return $blnIn || $blnOut;		
	}
	
	function alterRowBgColor($intOddEven)
	{   //alternate the row colors 
		if($intOddEven)
		{
			return "<tr class='alterrow'>";
		}
		else
		{
			return "<tr class='titlebar'>";
		}
	}
		
	function getDTRTime($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_arrDay)
	{   //returns the value from tblEmpDTR to Override.php
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $intDay=>$value)
			{	
				$strDate = $this->combineDate($t_intYear, $t_intMonth, $intDay);
					
				$objDay = mysql_query("SELECT * FROM tblEmpDTR 
										WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$strDate'");
			}
		
			while($arrDay = mysql_fetch_array($objDay))
			{
				return $arrDay;		
			}
		}
	}
}
?>