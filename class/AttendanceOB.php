<?
/* 
File Name: AttendanceOB.php 
----------------------------------------------------------------------
Purpose of this file: 
Class attendance official business
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

require("../hrmis/class/AttendanceTime.php");
class AttendanceOB extends AttendanceTime
{
//----------------------------- override OB-----------------------------------------------------
	function officialBusiness($t_strEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_dtmTimeFrom, $t_strTimeFrom, $t_dtmTimeTo, $t_strTimeTo, $t_strPlace, $t_strPurpose, $t_strOB)
	{   //add OB to tblEmpOB
		$strDateFrom = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $t_intDayFrom);
		$strDateTo = $this->combineDate($t_intYearTo, $t_intMonthTo, $t_intDayTo);
		$strTimeFrom = $this->combineTime($t_dtmTimeFrom, $t_strTimeFrom);
		$strTimeTo = $this->combineTime($t_dtmTimeTo, $t_strTimeTo);
		$dtmDateNow = date("Y-m-d");
		
		mysql_query("INSERT INTO tblEmpOB (dateFiled, empNumber, obDateFrom, obDateTo, 
						obTimeFrom, obTimeTo, obPlace, purpose, 
						official, approveChief, approveHR)
					VALUES ('$dtmDateNow','$t_strEmpNmbr', '$strDateFrom', '$strDateTo', 
							'$strTimeFrom', '$strTimeTo', '$t_strPlace', 
							'$t_strPurpose', '$t_strOB', 'Y', 'Y')");   //inserts in tblEmpOB

		$intNewID = mysql_insert_id();   // gets the obID and saves it in the tblEmpDTR otherInfo
		$strRemarks = $this->obCode($t_strOB);   //gets the OB code and puts it in tblEmpDTR remarks
		$t_intDayFrom = intval($t_intDayFrom);   //converts to integer
		$t_intDayTo = intval($t_intDayTo);
		for($intCounter = $t_intDayFrom; $intCounter <= $t_intDayTo; $intCounter++)
		{
			$strDate = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $intCounter);				
			$strDayName = date('l', strtotime($strDate));   //gets the day name: sunday, monday etc.
			
			$blnHoliday = $this->checkIfHoliday($t_intMonthFrom, $t_intYearFrom, $intCounter);
			if($strDayName != "Sunday" && $strDayName != "Saturday" && $blnHoliday == 0)   //not sunday, not saturday and NOT HOLIDAY dapat
			{
				$objDay = mysql_query("SELECT * FROM tblEmpDTR 
										WHERE empNumber = '$t_strEmpNmbr' 
											AND dtrDate = '$strDate'");   //checks if YYYY-MM-DD exist in tblEmpDTR
				
				$strSql = $this->sqlOBDTR($intNewID, $objDay, $t_strEmpNmbr, $strDate, $strRemarks, $t_strTimeFrom, $t_strTimeTo, $strTimeFrom, $strTimeTo);
				mysql_query($strSql);
			}
		}	
	}
	function overrideOB($t_strEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_dtmTimeFrom, $t_strTimeFrom, $t_dtmTimeTo, $t_strTimeTo, $t_strPlace, $t_strPurpose, $t_strOB)
	{   //from Override.php
		$this->officialBusiness($t_strEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_dtmTimeFrom, $t_strTimeFrom, $t_dtmTimeTo, $t_strTimeTo, $t_strPlace, $t_strPurpose, $t_strOB);
		
		$arrLastLB = $this->getLastRcrdFrmLeaveBlnc();
	
		if($arrLastLB['periodMonth'] == $t_intMonthFrom && $arrLastLB['periodYear'] == $t_intYearFrom)
		{
			$this->updateLeaveBalance($t_intMonthFrom, $t_intYearFrom, $t_strEmpNmbr);   //update the leave balance
		}
		elseif($arrLastLB['periodMonth'] == $t_intMonthTo && $arrLastLB['periodYear'] == $t_intYearTo)
		{
			$this->updateLeaveBalance($t_intMonthTo, $t_intYearTo, $t_strEmpNmbr);   //update the leave balance
		}
		elseif (($arrLastLB['periodMonth'] > $t_intMonthFrom && $arrLastLB['periodYear'] >= $t_intYearFrom) || ($arrLastLB['periodMonth'] > $t_intMonthTo && $arrLastLB['periodYear'] >= $t_intYearTo))
		{
			$objLB = mysql_query("SELECT * FROM tblEmpLeaveBalance WHERE empNumber='$t_strEmpNmbr' ORDER BY periodYear, periodMonth");
			$arrLB = mysql_fetch_array($objLB);
			$this->addEmpLeaveBalance($t_strEmpNmbr, $arrLB["periodYear"], $arrLB["periodMonth"], $arrLB["vlEarned"], $arrLB["vlBalance"], $arrLB["vlAbsUndWPay"], $arrLB["vlAbsUndWoPay"], $arrLB["slBalance"], $arrLB["slAbsUndWPay"], $arrLB["slAbsUndWoPay"]);
		}

		$this->updateEmpLeave($t_strEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $_SESSION['arrDay']);
//		$this->removeUnusedLeaveRecord();
		$strPage = "DTR.php?a=a".$this->varstr;
		header("Location: $strPage");
	}
	
	function obCode($t_strOfficial)
	{   //determines if the OB is official or not and puts it at tblEmpDTR remarks.
		if ($t_strOfficial == 'N')
		{
			return "QB";	
		}
		else
		{
			return "OB";
		}		
	}
	
	function sqlOBDTR($t_intNewID, $t_objDay, $t_strEmpNmbr, $t_strDate, $t_strRemarks, $t_strFromAMPM, $t_strToAMPM, $t_strTimeFrom, $t_strTimeTo)
	{   //returns the proper SQL if YYYY-MM-DD exists in tblEmpDTR
		$dtmDiff =  strtotime($t_strTimeTo) - strtotime($t_strTimeFrom);
		$intHour = floor($dtmDiff/60/60);
		$intOfficeWorkHour = WORKHOURS + 1;   //office hours is 9 hours

			if(!mysql_num_rows($t_objDay))   //if YYYY-MM-DD is not exist
			{				
				$strSQL = "INSERT INTO tblEmpDTR (empNumber, dtrDate, remarks, otherInfo, ";	
				
				if ($t_strFromAMPM == AM)
				{
					$strSQL = $strSQL."inAM, ";
				}
				else
				{
					$strSQL = $strSQL."inPM, ";
				}
	
				if ($intHour < $intOfficeWorkHour && $t_strFromAMPM == AM)
				{
					$strSQL = $strSQL."outAM) VALUES ( ";
				}
				else
				{
					$strSQL = $strSQL."outPM) VALUES ( ";
				}
				
				$strSQL = $strSQL."'$t_strEmpNmbr', '$t_strDate', '$t_strRemarks', '$t_intNewID', '$t_strTimeFrom', '$t_strTimeTo')";
				
				return $strSQL;
				
			}
			else   //if the date exist in tblEmpDTR, it must be update
			{
				$strSQL = "UPDATE tblEmpDTR SET remarks = '$t_strRemarks', otherInfo = '$t_intNewID', ";
	
				if ($t_strFromAMPM == AM)
				{
					$strSQL = $strSQL."inAM = '$t_strTimeFrom', ";
				}
				else
				{
					$strSQL = $strSQL."inPM = '$t_strTimeFrom', ";
				}
	
				if ($intHour < $intOfficeWorkHour && $t_strFromAMPM == AM)
				{
					$strSQL = $strSQL."outAM = '$t_strTimeTo' ";
				}
				else
				{
					$strSQL = $strSQL."outPM = '$t_strTimeTo' ";
				}
				
				$strSQL = $strSQL."WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$t_strDate'";
	
				return $strSQL;

			}
	}
//------------------------------ update OB tblEmpOB------------------------------------------------	
	function empOfficialBusiness($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_intDay)
	{
		$intDay = $t_intDay;
		$strDate = $this->combineDate($t_intYear, $t_intMonth, $intDay);
		$objEmpOB = mysql_query("SELECT * FROM tblEmpOB 
						WHERE empNumber='$t_strEmpNmbr'
							AND obDateFrom <= '$strDate'
							AND obDateTo >= '$strDate'");

		while($arrEmpOB = mysql_fetch_array($objEmpOB))
		{			
			$strRqstID = $arrEmpOB['requestID'];
			$dtmDateFrom = $arrEmpOB['obDateFrom'];
			$dtmDateTo = $arrEmpOB['obDateTo'];				
			$dtmTimeFrom = $arrEmpOB['obTimeFrom'];
			$dtmTimeTo = $arrEmpOB['obTimeTo'];
			$strPlace = $arrEmpOB['obPlace'];
			$strPurpose = $arrEmpOB['purpose'];
			$strOfficial = $arrEmpOB['official'];
			$blnAprvHR = $arrEmpOB['approveHR'];
			$blnAprvChief = $arrEmpOB['approveChief'];
		}
		
		if($dtmDateFrom == $strDate)   //kapg override nya ay equal sa leaveFrom date
		{   //eg: leaveFrom: 2003-09-15 leaveTo: 2003-09-19, override na date is 2003-09-15
			//result nya ay: leaveFrom: 2003-09-16, leaveTo: 2003-09-19
			$intDay = $intDay + 1;
			$strDate = $this->combineDate($t_intYear, $t_intMonth, $intDay);				
			if($strDate > $dtmDateTo)
			{
				mysql_query("DELETE FROM tblEmpOB 
								WHERE empNumber='$t_strEmpNmbr'
									AND obDateFrom = '$dtmDateFrom'
									AND obDateTo = '$dtmDateTo'");
			}
			else
			{
				mysql_query("UPDATE tblEmpOB 
							SET obDateFrom = '$strDate'
							WHERE empNumber='$t_strEmpNmbr'
								AND obDateFrom = '$dtmDateFrom'
								AND obDateTo = '$dtmDateTo'");				
			}
		}
		else if($dtmDateTo == $strDate)   //kapg override nya ay equal sa leaveTo date
		{   //eg: leaveFrom: 2003-09-15 leaveTo: 2003-09-19, override na date is 2003-09-19
			//result nya ay: leaveFrom: 2003-09-15, leaveTo: 2003-09-18				
			$intDay = $intDay - 1;
			$strDate = $this->combineDate($t_intYear, $t_intMonth, $intDay);
			mysql_query("UPDATE tblEmpOB
						SET obDateTo = '$strDate'
						WHERE empNumber='$t_strEmpNmbr'
							AND obDateFrom = '$dtmDateFrom'
							AND obDateTo = '$dtmDateTo'");				
		}
		else if($dtmDateFrom <= $strDate && $dtmDateTo >= $strDate)  //if the strDate is within eg: leaveFrom: 2003-09-15 leaveTo: 2003-09-19, override date: 2003-09-17
		{   //the result must be 2 fields first result: leaveFrom=2003-09-15, leaveTo=2003-09-16 second result is: leaveFrom=2003-09-18, leaveTo=2003-09-19
			$intDayTo = $intDay - 1;   
			$strDateTo = $this->combineDate($t_intYear, $t_intMonth, $intDayTo);
			mysql_query("UPDATE tblEmpOB 
						SET obDateTo = '$strDateTo'
						WHERE empNumber='$t_strEmpNmbr'
							AND obDateFrom = '$dtmDateFrom'
							AND obDateTo = '$dtmDateTo'");								
			
			$intDayFrom = $intDay + 1;
			$strDateFrom = $this->combineDate($t_intYear, $t_intMonth, $intDayFrom);
			mysql_query("INSERT INTO tblEmpOB (empNumber, requestID, obDateFrom, 
							obDateTo, obTimeFrom, obTimeTo, obPlace, 
							purpose, official, approveChief, approveHR)
						VALUES ('$t_strEmpNmbr', '$strRqstID', '$strDateFrom', 
							'$dtmDateTo', '$dtmTimeFrom', '$dtmTimeTo', '$strPlace', 
							'$strPurpose', '$strOfficial', '$blnAprvChief', '$blnAprvHR')");
		}		
	}

	function updateEmpOB($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_arrDay)
	{
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $intDay=>$value)
			{
				$this->empOfficialBusiness($t_strEmpNmbr, $t_intYear, $t_intMonth, $intDay);
			}
		}	
	}
//-------------------------------------- remove unused records ------------------------------------	
	function removeUnusedOBRecord()
	{   //remove the unused OB record from tblEmpOB
		$objUsedOB = mysql_query("SELECT DISTINCT tblEmpOB.obID 
									FROM tblEmpOB 
										INNER  JOIN tblEmpDTR ON tblEmpOB.obID = tblEmpDTR.otherInfo 
									ORDER  BY tblEmpOB.obID ASC");
		if(mysql_num_rows($objUsedOB))
		{
			$strSQL = "DELETE FROM tblEmpOB WHERE ";
			$intAnd = 0;
			while($arrUsedOB = mysql_fetch_array($objUsedOB))
			{
				if($intAnd)
				{
					$strSQL = $strSQL." AND ";
				}
				
				$strSQL = $strSQL."obID != ".$arrUsedOB["obID"];
				$intAnd = 1;
			}
		}
		else
		{
			$strSQL = "DELETE FROM tblEmpOB";
		}
		mysql_query($strSQL);
	}
//--------------------------------------- override many employee OB	----------------------------------------
	function setEmpOB($t_arrEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_dtmTimeFrom, $t_strTimeFrom, $t_dtmTimeTo, $t_strTimeTo, $t_strPlace, $t_strPurpose, $t_strOB)
	{
		foreach($t_arrEmpNmbr as $key=>$strEmpNmbr)   //get nya from chkbox ng mga employees 
		{
			$this->officialBusiness($strEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_dtmTimeFrom, $t_strTimeFrom, $t_dtmTimeTo, $t_strTimeTo, $t_strPlace, $t_strPurpose, $t_strOB);

			$this->empLeave($strEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $intCount);
		}

		$arrLastLB = $this->getLastRcrdFrmLeaveBlnc();
		if($arrLastLB['periodMonth'] == $t_intMonthFrom && $arrLastLB['periodYear'] == $t_intYearFrom)
		{
			$this->updateLeaveBalance($t_intMonthFrom, $t_intYearFrom);   //update the leave balance 
		}
		elseif($arrLastLB['periodMonth'] == $t_intMonthTo && $arrLastLB['periodYear'] == $t_intYearTo)
		{
			$this->updateLeaveBalance($t_intMonthTo, $t_intYearTo);   //update the leave balance 
		}

	    return "The daily time record has been successfully updated";
	}
}
?>