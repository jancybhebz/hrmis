<?php 
/* 
File Name: EmpDTR.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To view employee daily time record.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco, Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: May 21, 2004
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
require("../hrmis/class/General.php");
include_once("../hrmis/class/Constant.php");
class EmpDTR extends General
{

	function empDTR() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function viewDTR($t_intMonth, $t_intYear, $t_strEmpNmbr)    //for DTR viewing
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

			echo "<td align='left'>&nbsp;&nbsp;$intCounter</td>";
			
			if (mysql_num_rows($objEmpDTR) != 0)
			{
				$blnTimeAM = $this->checkNullTime($strInAM, $strOutAM);
				$blnTimePM = $this->checkNullTime($strInPM, $strOutPM);
				$blnTimeOT = $this->checkNullTime($strInOT, $strOutOT);				
				$blnTime = $blnTimeAM || $blnTimePM || $blnTimeOT; 
				
				$strOutput = $this->outputTimeRecord($blnTime, $strInAM, $strOutAM, $strInPM, $strOutPM, $strInOT, $strOutOT, $strRemark, $strOther);
				echo $strOutput;
			}
			else
			{
				$strOutput = $this->outputNoTimeRecord($strDay, $dtmDTRDate);
				echo $strOutput;		
			}
            echo "</tr>";
		}
	}
	function outputTimeRecord($t_blnTime, $t_strInAM, $t_strOutAM, $t_strInPM, $t_strOutPM, $t_strInOT, $t_strOutOT, $t_strRemark, $t_strOther)
	{   //prints the time, if no time: leave or OB
		if ($t_blnTime)
		{
			if($t_strRemark != 'QB' && $t_strRemark != 'OB')
			{   //kpg hndi equal sa QB wlang babaguhin ng color...
				return "<td>$t_strInAM</td> 
						<td>$t_strOutAM</td>
						<td>$t_strInPM</td>
						<td>$t_strOutPM</td>
						<td>$t_strInOT</td>
						<td>$t_strOutOT</td>";
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
					$strTd = "<td><b>$t_strInAM</b></td>";
				}
				else
				{
					$strTd = "<td>$t_strInAM</td> ";
				}

				if($dtmTo == $t_strOutAM)
				{
					$strTd = $strTd."<td><b>$t_strOutAM</b></td>";
				}
				else
				{
					$strTd = $strTd."<td>$t_strOutAM</td> ";
				}

				if($dtmFrom == $t_strInPM)
				{
					$strTd = $strTd."<td><b>$t_strInPM</b></td>";
				}
				else
				{
					$strTd = $strTd."<td>$t_strInPM</td> ";
				}

				if($dtmTo == $t_strOutPM)
				{
					$strTd = $strTd."<td><b>$t_strOutPM</b></td>";
				}
				else
				{
					$strTd = $strTd."<td>$t_strOutPM</td> ";
				}

				$strTd = $strTd."<td>$t_strInOT</td><td>$t_strOutOT</td>";

				return $strTd;	
			}
		}
		else
		{
			$objLv = mysql_query("SELECT leaveType FROM tblLeave WHERE leaveCode='$t_strRemark'");
			$arrLv = mysql_fetch_array($objLv);
			return "<td colspan='6'>".$arrLv["leaveType"]."</td>";
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
				return "<td colspan='6'>$t_strDayName</td>";
			}	
			else
			{
				return "<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>";				
			}
		}
		else
		{			
			return "<td colspan='6'>$strHoliday</td>";				
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

}
?>