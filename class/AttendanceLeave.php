<?
/* 
File Name: AttendanceLeave.php 
----------------------------------------------------------------------
Purpose of this file: 
Class attendance leave
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: August 19, 2004
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

require_once("../hrmis/class/General.php");
include_once("../hrmis/class/Constant.php");
class AttendanceLeave extends General
{
	var $intPrintDTR = 0;
	var $dtmLateHours = 0;
	var $dtmUndHours = 0;
	var $strNmbrDays;
	var $intWorkTime;
	var $intDaysAbs = 0;
//-------------------- count the SL and VL left ---------------------------------------------
	function getLeftSLVL($t_strMonth, $t_strYear, $t_strEmpNmbr, $t_strLeaveCode)
	{   
		//because the hours are more than the filed
		$objBlnc = mysql_query("SELECT vlBalance, slBalance 
									FROM tblEmpLeaveBalance 
									WHERE periodMonth = '$t_strMonth'
										AND periodYear = '$t_strYear'
										AND empNumber = '$t_strEmpNmbr'");
		if(mysql_num_rows($objBlnc))
		{
			$arrBlnc = mysql_fetch_array($objBlnc);
			if($t_strLeaveCode == VACLEAVE)
			{
				return $arrBlnc['vlBalance'];
			}
			elseif($t_strLeaveCode == SICKLEAVE)
			{
				return $arrBlnc['slBalance'];
			}
		}
		else
		{
			$arrMonthYear = $this->getPreMonth($t_strMonth, $t_strYear);
			$intMonth = $arrMonthYear["month"];
			$intYear = $arrMonthYear["year"];
	
			$objBalance = mysql_query("SELECT vlBalance, slBalance 
												FROM tblEmpLeaveBalance 
												WHERE periodMonth = '$intMonth'
													AND periodYear = '$intYear'
													AND empNumber = '$t_strEmpNmbr'");
			if(mysql_num_rows($objBalance))
			{
				$arrBalance = mysql_fetch_array($objBalance);
				$dtmLngvty = $this->getEmpLngvty($t_strEmpNmbr);
				$dtmLastDayOfMonthYear = $this->lastDayOfMonthYear($t_strYear, $t_strMonth);
				$intWorkMonths = $this->dateDiffInMonths($dtmLngvty, $dtmLastDayOfMonthYear);
	
				if($t_strLeaveCode == VACLEAVE)
				{
					$intBlnc = $arrBalance['vlBalance'] + MONTH_EARNED;
					if($intWorkMonths >= 6)
					{
						$intVL = $this->getMonthSLVL($t_strMonth, $t_strYear, $t_strEmpNmbr, VACLEAVE);
						$intHVL = $this->getMonthSLVL($t_strMonth, $t_strYear, $t_strEmpNmbr, HVACLEAVE);
						$intVL = $intVL + ($intHVL * 0.5);
						$intAbsUnd = $this->getMonthAbsUnd($t_strMonth, $t_strYear, $t_strEmpNmbr, $intVL);
						$intBlnc = $intBlnc - $intAbsUnd;
					}
				}
				elseif($t_strLeaveCode == SICKLEAVE)
				{
					$intBlnc = $arrBalance['slBalance'] + MONTH_EARNED;
					if($intWorkMonths >= 6)
					{
						$intSL = $this->getMonthSLVL($t_strMonth, $t_strYear, $t_strEmpNmbr, SICKLEAVE);
						$intHSL = $this->getMonthSLVL($t_strMonth, $t_strYear, $t_strEmpNmbr, HSICKLEAVE);
						$intSL = $intSL + ($intHSL * 0.5);
						$intBlnc = $intBlnc - $intSL;
					}
				}	
				return $intBlnc;
			}
		}	
	}
	
	function getMonthSLVL($t_strMonth, $t_strYear, $t_strEmpNmbr, $t_strLeaveCode)
	{
		$strMonthYear = $this->combineMonthYear($t_strYear, $t_strMonth);
		$objVL = mysql_query("SELECT remarks FROM tblEmpDTR
								WHERE remarks = '$t_strLeaveCode' 
									AND empNumber = '$t_strEmpNmbr'  
									AND dtrDate LIKE '$strMonthYear%'");

		return mysql_num_rows($objVL);
	}
	
	function setDisregardLeaveFiled($t_strMonth, $t_strYear, $t_strEmpNmbr='')
	{
		$strSQL = "SELECT DISTINCT empNumber 
					FROM tblEmpLeaveBalance";
		if(strlen($t_strEmpNmbr) != 0)
		{
			$strSQL = $strSQL." WHERE empNumber = '$t_strEmpNmbr'";
		}
		
		$objEmpLB = mysql_query($strSQL);
		$strMonthYear = $this->combineMonthYear($t_strYear, $t_strMonth);
		
		while($arrEmpLB = mysql_fetch_array($objEmpLB))
		{
			$objVL = mysql_query("SELECT * FROM tblEmpDTR
									WHERE (remarks = '".VACLEAVE."' OR remarks='".HVACLEAVE."'
											OR remarks = '".SICKLEAVE."' OR remarks='".HSICKLEAVE."')
										AND empNumber = '".$arrEmpLB["empNumber"]."'  
										AND dtrDate LIKE '$strMonthYear%'");
	
			while($arrLeave = mysql_fetch_array($objVL))
			{
				$intHours = $this->getWrkHrPrDay($arrEmpLB["empNumber"], "", 0, $arrLeave);
				
				if(strlen($intHours) == 0)
				{
					$intHours = 0;
				}
				
				if(substr($arrLeave["remarks"],0,1) == "H")
				{
					if($intHours >= 5 || 4 > $intHours)   //more than 5 hours working will disregard the filed
					{   //half day leave or if less than 4 hours will disregard the half day leave 
						
						mysql_query("UPDATE tblEmpDTR SET remarks='', otherInfo=''
									WHERE empNumber = '".$arrEmpLB["empNumber"]."'  
										AND dtrDate = '".$arrLeave["dtrDate"]."'");
					}
				}
				else
				{
					$objScheme = mysql_query("SELECT tblAttendanceScheme.wrkhrLeave FROM tblEmpPosition 
												INNER JOIN tblAttendanceScheme
													ON tblEmpPosition.schemeCode = tblAttendanceScheme.schemeCode
												WHERE tblEmpPosition.empNumber = '".$arrEmpLB["empNumber"]."'");
					$arrScheme = mysql_fetch_array($objScheme);
					
					if($intHours >= ($arrScheme["wrkhrLeave"] + 1))
					{
						mysql_query("UPDATE tblEmpDTR SET remarks='', otherInfo=''
									WHERE empNumber = '".$arrEmpLB["empNumber"]."'  
										AND dtrDate = '".$arrLeave["dtrDate"]."'");					
					}
				}
			}
		}
	}
	
	function getEmpLngvty($t_strEmpNmbr)
	{
		$objLngvty = mysql_query("SELECT firstDayGov FROM tblEmpPosition
							WHERE empNumber = '$t_strEmpNmbr'");

		while($arrLngvty = mysql_fetch_array($objLngvty))
		{	
			$dtmLngvty = $arrLngvty['firstDayGov'];
		}	
		
		return $dtmLngvty;
	}


//---------------------------------- override leave -----------------------------------------------------------------------------------------------------------------------------------------------	
	function leave($t_strEmpNmbr, $t_strLeaveCode, $t_strSpecificLeave, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_strReason, $t_strLeaveDay)
	{   //adds leave to tblEmpLeave
		$strDateFrom = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $t_intDayFrom);
		$strDateTo = $this->combineDate($t_intYearTo, $t_intMonthTo, $t_intDayTo);
		$dtmDateNow = date("Y-m-d");
		mysql_query("INSERT INTO tblEmpLeave (dateFiled, empNumber, leaveCode, specificLeave, 
						reason, leaveFrom, leaveTo,  
						certifyHR, approveChief,  remarks)
					VALUES ('$dtmDateNow','$t_strEmpNmbr', '$t_strLeaveCode', '$t_strSpecificLeave', 
							'$t_strReason','$strDateFrom', '$strDateTo', 
							'Y', 'Y', '')");
		
		$intNewID = mysql_insert_id();
						
		$t_intDayFrom = intval($t_intDayFrom);
		$t_intDayTo = intval($t_intDayTo);
		for($intCounter = $t_intDayFrom; $intCounter <= $t_intDayTo; $intCounter++)
		{
			$strDate = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $intCounter);				
			
			$strDayName = date('l', strtotime($strDate));
			
			$blnHoliday = $this->checkIfHoliday($t_intMonthFrom, $t_intYearFrom, $intCounter);
			
			if($strDayName != "Sunday" && $strDayName != "Saturday" && $blnHoliday == 0)
			{
				$objDay = mysql_query("SELECT * FROM tblEmpDTR 
										WHERE empNumber = '$t_strEmpNmbr' 
											AND dtrDate = '$strDate'");
		
				$strSql = $this->sqlLeaveDTR($intNewID, $objDay, $t_strEmpNmbr, $strDate, $t_strLeaveCode, $t_strLeaveDay);
				mysql_query($strSql);
			}
		}	
	}
	
	function overrideLeave($t_strEmpNmbr, $t_strLeaveCode, $t_strSpecificLeave, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_strReason, $t_strLeaveDay)
	{
		$this->leave($t_strEmpNmbr, $t_strLeaveCode, $t_strSpecificLeave, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_strReason, $t_strLeaveDay);
		
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

		$this->updateEmpOB($t_strEmpNmbr, $t_intYearFrom, $t_intMonthFrom, $_SESSION['arrDay']);
//		$this->removeUnusedOBRecord();
		$strPage = "DTR.php?a=a".$this->varstr;
		header("Location: $strPage");										
	}
	
	function sqlLeaveDTR($t_intNewID, $t_objDay, $t_strEmpNmbr, $t_strDate, $t_strLeaveCode, $t_strLeaveDay)
	{
		if($t_strLeaveDay == HALFDAY)
		{
			$t_strLeaveCode = HALFDAY.$t_strLeaveCode;
		}
		
		if(!mysql_num_rows($t_objDay))
		{			
			return "INSERT INTO tblEmpDTR (empNumber, inAM, outAM, inPM, outPM, inOT, outOT, dtrDate, remarks, otherInfo)
					VALUES ('$t_strEmpNmbr', '', '', '', '', '', '', '$t_strDate', '$t_strLeaveCode', '$t_intNewID')";		
		}
		elseif($t_strLeaveDay != HALFDAY)
		{		
			return "UPDATE tblEmpDTR SET remarks = '$t_strLeaveCode', inAM = '', outAM = '',
						inPM = '', outPM = '', inOT = '', outOT ='', otherInfo='$t_intNewID'
						WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$t_strDate'";		
		}
		elseif($t_strLeaveDay == HALFDAY)
		{		
			return "UPDATE tblEmpDTR SET remarks = '$t_strLeaveCode', otherInfo='$t_intNewID'
						WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$t_strDate'";		
		}				
	}
//-------------------------- leave type combo box	------------------------------------------
	function comboLeaveType($t_strLeave, $t_strEmpNmbr='', $t_intMonth, $t_intYear)
	{   //construction of SQL stmt quering values in leave combobox application
		$strSQL = "SELECT * FROM tblLeave";
		if(strlen($t_strEmpNmbr) != 0)
		{
			$strGender = $this->getEmpGender($t_strEmpNmbr);
			
			$arrLeaveCode = array(1=>FORCELEAVE, 2=>PRIVLEAVE, 3=>MATLEAVE, 4=>PATLEAVE);
	
			$intFlag=0;   //flag sa first where clause para malagyan ng "where" ung susunod eh "and"
	
			for($intCount=1; $intCount<=4; $intCount++)
			{
				$strLeaveSQL = $this->countLeave($t_strEmpNmbr, $arrLeaveCode[$intCount], $t_intMonth, $t_intYear);
				
				if ($strLeaveSQL)
				{
					if ($intFlag == 0)
					{
						$intFlag = $intFlag + 1;
						$strSQL = $strSQL." WHERE ".$strLeaveSQL;
					}
					else
					{
						$strSQL = $strSQL." AND ".$strLeaveSQL;
					}
				}
			}
		}
		
		if($intFlag == 0)
		{
			$strSQL = $strSQL." WHERE";
		}
		else
		{
			$strSQL = $strSQL." AND";
		}
		
		if($strGender == 'M')
		{
			$strSQL = $strSQL." leaveCode != '".MATLEAVE."' AND ";
		}
		else
		{
			$strSQL = $strSQL." leaveCode != '".PATLEAVE."' AND ";
		}

		$strSQL = $strSQL." leaveCode != '".ABSENT."' ORDER BY leaveType";
	
		$objLeaveType = mysql_query($strSQL);
		
		while($arrLeave = mysql_fetch_array($objLeaveType))   //the value of combobox leave
		{
			$strLeaveType = $arrLeave["leaveType"];
			$strLeaveCode = $arrLeave["leaveCode"];
			
			if($t_strLeave == $strLeaveCode)
			{
				echo "<option value='$strLeaveCode' selected>$strLeaveType</option>";				
			}
			else
			{
				echo "<option value='$strLeaveCode'>$strLeaveType</option>";
			}
		}
	}
	
	function countLeave($t_strEmpNmbr, $t_strLeaveCode, $t_intMonth, $t_intYear)  //counts the employee's leave from tblEmpDTR
	{
		$objLeaveDays = mysql_query("SELECT numOfDays FROM tblLeave 
										WHERE leaveCode='$t_strLeaveCode'");
		$arrLeaveDays = mysql_fetch_array($objLeaveDays);
		
		$objCountLeave = mysql_query("SELECT COUNT(*) as count FROM tblEmpDTR 
								WHERE remarks = '".$t_strLeaveCode."'
								AND empNumber = '$t_strEmpNmbr'
								AND dtrDate LIKE '$t_intYear%'");
								
		$objCountLeave = mysql_fetch_array($objCountLeave);

		if($t_strLeaveCode == FORCELEAVE)
		{
			$intVL = $this->getLeftSLVL($t_intMonth, $t_intYear, $t_strEmpNmbr, VACLEAVE);

			if($intVL < 10)   //kapg less than 10 ang VL mo d ka pede mag force leave
			{
				return "leaveCode != '".$t_strLeaveCode."'";
			}
			elseif($objCountLeave["count"] >= $arrLeaveDays["numOfDays"])
			{
				return "leaveCode != '".$t_strLeaveCode."'";
			}
		}
		else
		{
			if ($objCountLeave["count"] >= $arrLeaveDays["numOfDays"])  //kpg more than sa
			{   //number of days na ang leave mo d na pede lumabas sa combo box un leave na un!
				return "leaveCode != '".$t_strLeaveCode."'";   //trap na ba!
			}
			else
			{
				return "";
			}
		}
	}
	
	function getEmpGender($t_strEmpNmbr)
	{
		$objEmpGender = mysql_query("SELECT sex FROM tblEmpPersonal WHERE empNumber='$t_strEmpNmbr'");
		$arrGender = mysql_fetch_array($objEmpGender);
		return $arrGender["sex"];
	}
//--------------------------------- check if empty combobox--------------------------------------------
	function checkSpecificLeave($t_strLeaveCode)
	{
		$objSpecifyLeave = mysql_query("SELECT * FROM tblSpecificLeave 
								WHERE leaveCode = '$t_strLeaveCode'
								ORDER BY specifyLeave");
		return mysql_num_rows($objSpecifyLeave);
	}
//--------------------------------- combo specify leave ------------------------------------------------	
	function comboSpecifyLeave($t_strComboName, $t_strSpecificLeave, $t_strLeaveCode, $t_strOnChange='')
	{    //get the sub option of leave filed like: VL local, abroad etc.
		if ($t_strLeaveCode)
		{
			$objSpecifyLeave = mysql_query("SELECT * FROM tblSpecificLeave 
											WHERE leaveCode = '$t_strLeaveCode'
											ORDER BY specifyLeave");
			if(mysql_num_rows($objSpecifyLeave))
			{
//				echo "<select name=$t_strComboName onChange=$t_strOnChange>";
				while($arrSpecificLeave = mysql_fetch_array($objSpecifyLeave))
				{
					$strSpecificLeave = $arrSpecificLeave["specifyLeave"];
					
					if($t_strSpecificLeave == $strSpecificLeave || $t_strSpecificLeave == '')
					{
						echo "<option value='$strSpecificLeave' selected>$strSpecificLeave</option>";				
					}
					else
					{
						echo "<option value='$strSpecificLeave'>$strSpecificLeave</option>";
					}
				}
//				echo "</select>";
			}
		}
	}
//---------------------------- update employee leave tblEmpLeave----------------------------------------	
	function empLeave($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_intDay)
	{
		$intDay = $t_intDay;
		$strDate = $this->combineDate($t_intYear, $t_intMonth, $intDay);
		$objEmpLeave = mysql_query("SELECT * FROM tblEmpLeave 
						WHERE empNumber='$t_strEmpNmbr'
							AND leaveFrom <= '$strDate'
							AND leaveTo >= '$strDate'");

		while($arrEmpLeave = mysql_fetch_array($objEmpLeave))
		{			
			$dtmLeaveFrom = $arrEmpLeave['leaveFrom'];
			$dtmLeaveTo = $arrEmpLeave['leaveTo'];
			$strRqstID = $arrEmpLeave['requestID'];				
			$strLeaveCode = $arrEmpLeave['leaveCode'];
			$strSpfcLeave = $arrEmpLeave['specificLeave'];
			$strReason = $arrEmpLeave['reason'];
			$blnCrtfyHR = $arrEmpLeave['certifyHR'];
			$blnAprvChief = $arrEmpLeave['approveChief'];
			$strRsnDsprv = $arrEmpLeave['reasonDisapprove'];
		}
		
		if($dtmLeaveFrom == $strDate)   //kapg override nya ay equal sa leaveFrom date
		{   //eg: leaveFrom: 2003-09-15 leaveTo: 2003-09-19, override na date is 2003-09-15
			//result nya ay: leaveFrom: 2003-09-16, leaveTo: 2003-09-19
			$intDay = $intDay + 1;
			$strDate = $this->combineDate($t_intYear, $t_intMonth, $intDay);
			if($strDate >  $dtmLeaveTo)
			{
				mysql_query("DELETE FROM tblEmpLeave
							WHERE empNumber='$t_strEmpNmbr'
								AND leaveFrom = '$dtmLeaveFrom'
								AND leaveTo = '$dtmLeaveTo'");				
			}
			else
			{
				mysql_query("UPDATE tblEmpLeave 
							SET leaveFrom = '$strDate'
							WHERE empNumber='$t_strEmpNmbr'
								AND leaveFrom = '$dtmLeaveFrom'
								AND leaveTo = '$dtmLeaveTo'");				
			}
		}
		else if($dtmLeaveTo == $strDate)   //kapg override nya ay equal sa leaveTo date
		{   //eg: leaveFrom: 2003-09-15 leaveTo: 2003-09-19, override na date is 2003-09-19
			//result nya ay: leaveFrom: 2003-09-15, leaveTo: 2003-09-18
			$intDay = $intDay - 1;
			$strDate = $this->combineDate($t_intYear, $t_intMonth, $intDay);
			mysql_query("UPDATE tblEmpLeave 
						SET leaveTo = '$strDate'
						WHERE empNumber='$t_strEmpNmbr'
							AND leaveFrom = '$dtmLeaveFrom'
							AND leaveTo = '$dtmLeaveTo'");				
		}
		else if($dtmLeaveFrom <= $strDate && $dtmLeaveTo >= $strDate)  //if the strDate is within eg: leaveFrom: 2003-09-15 leaveTo: 2003-09-19, override date: 2003-09-17
		{   //the result must be 2 fields first result: leaveFrom=2003-09-15, leaveTo=2003-09-16 second result is: leaveFrom=2003-09-18, leaveTo=2003-09-19
			$intDayTo = $intDay - 1;   
			$strDateTo = $this->combineDate($t_intYear, $t_intMonth, $intDayTo);
			mysql_query("UPDATE tblEmpLeave 
						SET leaveTo = '$strDateTo'
						WHERE empNumber='$t_strEmpNmbr'
							AND leaveFrom = '$dtmLeaveFrom'
							AND leaveTo = '$dtmLeaveTo'");								
			
			$intDayFrom = $intDay + 1;
			$strDateFrom = $this->combineDate($t_intYear, $t_intMonth, $intDayFrom);
			mysql_query("INSERT INTO tblEmpLeave (empNumber, requestID, leaveCode,
							specificLeave, reason, leaveFrom, leaveTo,  
							certifyHR, approveChief,  reasonDisapprove)
						VALUES ('$t_strEmpNmbr', '$strRqstID', '$strLeaveCode', 
							'$strSpfcLeave', '$strReason', '$strDateFrom', '$dtmLeaveTo', 
							'$blnCrtfyHR', '$blnAprvChief', '$strRsnDsprv')");
		}
	}
	
	function updateEmpLeave($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_arrDay)
	{
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $intDay=>$value)
			{
				$this->empLeave($t_strEmpNmbr, $t_intYear, $t_intMonth, $intDay);
			}
		}	
	}
//------------------------------- absents in Attendance Summary ---------------------------------
	function daysAbsent($t_strMonth, $t_strYear, $t_strEmpNmbr)
	{
		$this->strNmbrDays = "";
		$strMonthYear = $this->combineMonthYear($t_strYear, $t_strMonth);
		$objDaysAbs = mysql_query("SELECT tblEmpDTR.remarks, tblEmpDTR.dtrDate FROM tblEmpDTR 
									INNER JOIN tblLeave
										ON tblEmpDTR.remarks = tblLeave.leaveCode
									WHERE tblEmpDTR.empNumber = '$t_strEmpNmbr'  
											AND tblEmpDTR.dtrDate LIKE '$strMonthYear%' 
										ORDER BY dtrDate");

		while($arrDaysAbs = mysql_fetch_array($objDaysAbs))
		{
			$this->strNmbrDays = $this->strNmbrDays.substr($arrDaysAbs['dtrDate'], -2)." ";   //adds days
			$this->intDaysAbs = $this->intDaysAbs + 1;   //of absent add number of days
		}	
		
		return $this->strNmbrDays;			
	}
	
	function getTotalAbs()
	{
		return $this->intDaysAbs;
	}
//----------------------------------- remove unneccesary record from tblEmpLeave --------------------
	function removeUnusedLeaveRecord()
	{   //remove the unused leave record from tblEmpLeave
		$objUsedLeave = mysql_query("SELECT DISTINCT tblEmpLeave.leaveID 
									FROM tblEmpLeave 
										INNER  JOIN tblEmpDTR ON tblEmpLeave.leaveID = tblEmpDTR.otherInfo 
									ORDER  BY tblEmpLeave.leaveID ASC");
		if(mysql_num_rows($objUsedLeave))
		{
			$strSQL = "DELETE FROM tblEmpLeave WHERE ";
			$intAnd = 0;
			while($arrUsedLeave = mysql_fetch_array($objUsedLeave))
			{
				if($intAnd)
				{
					$strSQL = $strSQL." AND ";
				}
				
				$strSQL = $strSQL."leaveID != ".$arrUsedLeave["leaveID"];
				$intAnd = 1;
			}
		}
		else
		{
			$strSQL = "DELETE FROM tblEmpLeave";
		}
		mysql_query($strSQL);
	}

//------------------ Absent for contructuals without pay------------------------------------------------	
	function findDTRDate($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_intDay)
	{  //checks if the YYYY-MM-DD selected is present in your tblEmpDTR
		$strDate = $this->combineDate($t_intYear, $t_intMonth, $t_intDay);
		
		$objDay = mysql_query("SELECT * FROM tblEmpDTR 
								WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$strDate'");
		
		$strSql = $this->sqlAbsent($objDay, $t_strEmpNmbr, $strDate);
		mysql_query($strSql);	
	}
	
	function overrideAbsent($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_arrDay)
	{   //overrides Absent in Override.php
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $intDay=>$value)
			{
				$this->findDTRDate($t_strEmpNmbr, $t_intMonth, $t_intYear, $intDay);
			}
		}
		$strPage = "DTR.php?a=a".$this->varstr;
		header("Location: $strPage");		
	}
	
	function sqlAbsent($t_objDay, $t_strEmpNmbr, $t_strDate)
	{   //if the YYYY-MM-DD is present in tblEmpDTR, update SQL is executed else insert SQL
		if(!mysql_num_rows($t_objDay))
		{
			return "INSERT INTO tblEmpDTR (empNumber, dtrDate, remarks)
							VALUES ('$t_strEmpNmbr', '$t_strDate', '".ABSENT."')";
		}
		else
		{
			return "UPDATE tblEmpDTR SET remarks = '".ABSENT."' 
					WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$t_strDate'";
		}
	}
//----------------------------- End Absent for contructuals without pay ------------------------

	function getMonthAbsUnd($t_intMonth, $t_intYear, $t_strEmpNmbr, $t_intVL, $t_strUndView='1')
	{
		$arrLateUnd = $this->getLateUndPrMonth($t_strEmpNmbr, $t_intMonth, $t_intYear);
		
		if($t_strUndView)
		{
			$intFL = $this->getMonthFL($t_intMonth, $t_intYear, $t_strEmpNmbr);
		}
		else
		{
			$intFL = 0;
		}
		
		$intHrsLateUnd = $arrLateUnd["compute"];
		$intHrsLateUnd = $intHrsLateUnd / WORKHOURS;
		$intHrsHlfday = $arrLateUnd["half count"] * 0.5;
		
		$intAbsUndLateHlf = $t_intVL + $intHrsLateUnd + $intFL + $intHrsHlfday;
		
		return number_format($intAbsUndLateHlf, 3,".","");
	}
	
	function getMonthFL($t_intMonth, $t_intYear, $t_strEmpNmbr)
	{
		$intFiledFL = $this->getMonthSLVL($t_intMonth, $t_intYear, $t_strEmpNmbr, FORCELEAVE);
		$intHFL = $this->getMonthSLVL($t_intMonth, $t_intYear, $t_strEmpNmbr, HFORCELEAVE);
		$intFiledFL = $intFiledFL + ($intHFL * 0.5);
		
		if($t_intMonth == 12)
		{
			$objBalance = mysql_query("SELECT vlBalance FROM tblEmpLeaveBalance
										WHERE periodYear = '$t_intYear'
											AND periodMonth = '11'
											AND empNumber = '$t_strEmpNmbr'");
			$arrBalance = mysql_fetch_array($objBalance);
			if($arrBalance['vlBalance'] > VL_AVAIL_FL)
			{
				return 5;
			}
			else
			{
				return $intFiledFL;
			}
		}
		elseif($t_intMonth < 12)
		{
			return $intFiledFL;
		}
	}

	function getPreMonth($t_intMonth, $t_intYear)
	{
		if($t_intMonth == 1)
		{
			$t_intYear = $t_intYear - 1;
			$t_intMonth = TWELVEMONTHS;
		}
		elseif($t_intMonth > 1)
		{
			$t_intMonth = $t_intMonth - 1;
		}
		
		$arrMonthYear = array("month"=>$t_intMonth, "year"=>$t_intYear);
		
		return $arrMonthYear;
	}
	
	function getNextMonth($t_intMonth, $t_intYear)
	{
		if($t_intMonth == 12)
		{
			$t_intYear = $t_intYear + 1;
			$t_intMonth = 1;
		}
		elseif($t_intMonth > 12)
		{
			$t_intMonth = $t_intMonth + 1;
		}
		
		$arrMonthYear = array("month"=>$t_intMonth, "year"=>$t_intYear);
		
		return $arrMonthYear;
	}
	
	function dateDiffInMonths($t_dtmFrom, $t_dtmTo)
	{
		$intYearFrom = $this->epochDate('Y', $t_dtmFrom);   //get the year from
		$intYearTo = $this->epochDate('Y', $t_dtmTo);   //get the year to
		
		$intMonthFrom = $this->epochDate('n', $t_dtmFrom);    //get the month from
		$intMonthTo = $this->epochDate('n', $t_dtmTo);  //get the month to
		
		$intYearDiff = $intYearTo - $intYearFrom;   //get the year difference
		
		if($intYearDiff > 1)   //if morethan 1 year
		{
			$intYearMul = $intYearDiff--;   // get the year diff minus 1
			$intMonths = $intYearMul * 12;   //multiply in 12
			
			$intMonthsRem = 12 - $intMonthFrom;   //get the month from and minus on 12
			$intMonthsRem += $intMonthTo;  //add the month to
			
			$intMonths += $intMonthsRem;  //add to the multipled months
			return $intMonths;
		}
		elseif($intYearDiff == 1)
		{
			$intMonths = 12 - $intMonthFrom;
			$intMonths += $intMonthTo;

			return $intMonths;			
		}
		elseif($intYearDiff == 0)
		{
			$intMonths = $intMonthTo - $intMonthFrom;
			
			return $intMonths;			
		}
	}
	
//------------  all blank fields are considered vacation leave on leave balance update ----------
	function makeAllBlank($t_strEmpNmbr, $t_intMonth, $t_intYear)
	{
		$strSQL = "SELECT DISTINCT empNumber 
					FROM tblEmpLeaveBalance";
		if(strlen($t_strEmpNmbr) != 0)
		{
			$strSQL = $strSQL." WHERE empNumber = '$t_strEmpNmbr'";
		}
		$dtmDate = $this->combineDate($t_intYear, $t_intMonth, "01");

		$intDays = date("t", strtotime($dtmDate));
				
		for($intCtr = 1; $intCtr <= $intDays; $intCtr++)
		{
			$dtmDtrDate = $this->combineDate($t_intYear, $t_intMonth, $intCtr);
			
			$objEmp = mysql_query($strSQL);
			
			while($arrEmp = mysql_fetch_array($objEmp))
			{
				$strDay = date('D', strtotime($dtmDtrDate));
				
				$blnHoliday = $this->checkIfHoliday($t_intMonth, $t_intYear, $intCtr);
								
				if($strDay != 'Sat' && $strDay != 'Sun' && $blnHoliday == 0)
				{
					$objEmpDTR = mysql_query("SELECT remarks 
												FROM tblEmpDTR
													WHERE empNumber='".$arrEmp['empNumber']."'
														AND dtrDate='$dtmDtrDate'");
					if(mysql_num_rows($objEmpDTR) == 0)
					{
						mysql_query("INSERT INTO tblEmpDTR (empNumber, dtrDate, remarks, otherInfo)
										VALUES('".$arrEmp['empNumber']."', '$dtmDtrDate', '".VACLEAVE."', 'blank')");
					}
				}
			}   //end while
		}   //end for
	}   //end function
//------------------------------- less than or equal to minimum hour turns to leave -----------------
	function lessHourLeave($t_strEmpNmbr, $t_intMonth, $t_intYear)
	{
		$dtmMonthYear = $this->combineMonthYear($t_intYear, $t_intMonth);
		$objEmpDTR = mysql_query("SELECT dtrDate FROM tblEmpDTR 
									WHERE empNumber='$t_strEmpNmbr'
									AND dtrDate LIKE '$dtmMonthYear%'
									AND remarks =''");
		
		$objWrkHr = mysql_query("SELECT tblAttendanceScheme.wrkhrLeave FROM tblAttendanceScheme 
									INNER JOIN tblEmpPosition 
										ON tblAttendanceScheme.schemeCode = tblEmpPosition.schemeCode
									WHERE tblEmpPosition.empNumber = '$t_strEmpNmbr'");
		$arrWrkHr = mysql_fetch_array($objWrkHr);
		
		while($arrEmpDTR = mysql_fetch_array($objEmpDTR))
		{
			$blnHoliday = 0;
			$strDayName = date("D", strtotime($arrEmpDTR["dtrDate"]));
			$blnHoliday = $this->checkIfHoliday(date("n", strtotime($arrEmpDTR["dtrDate"])), date("Y", strtotime($arrEmpDTR["dtrDate"])), date("j", strtotime($arrEmpDTR["dtrDate"])));
				
			if($strDayName != "Sun" || $strDayName != "Sat" || $blnHoliday == 0)
			{
				$intHours = $this->getWrkHrPrDay($t_strEmpNmbr, $arrEmpDTR["dtrDate"], 0);
				
				if(strlen($intHours) == 0)
				{
					$intHours = 0;
				}
										
				if($intHours <= $arrWrkHr["wrkhrLeave"])
				{	
					mysql_query("UPDATE tblEmpDTR SET inAM='00:00:00', outAM='00:00:00', 
													inPM='00:00:00', outPM='00:00:00', 
													remarks='VL', otherInfo='blank' 
									WHERE empNumber='$t_strEmpNmbr'
										AND dtrDate='".$arrEmpDTR["dtrDate"]."'");
				}
			}
		}
	}
	
//------------------------------- Monetization ----------------------------------------------------
	function lastestMonthOnLB($t_strEmpNmbr)
	{
		$objBlnc = mysql_query("SELECT periodYear, periodMonth, vlBalance, slBalance 
							FROM tblEmpLeaveBalance 
							WHERE empNumber = '$t_strEmpNmbr'
							ORDER BY periodYear desc, periodMonth desc");
		$arrBlnc = mysql_fetch_array($objBlnc);
		return $arrBlnc;
	}
	
	function monetization($t_strEmpNmbr, $t_intMonetizeVL, $t_intMonetizeSL, $t_intMonetizeMonth, $t_intMonetizeYear)
	{
		$objMonetize = mysql_query("SELECT empNumber FROM tblEmpMonetization 
									WHERE empNumber='$t_strEmpNmbr' 
										AND monetizeYear ='$t_intMonetizeYear'");
		if(mysql_num_rows($objMonetize))
		{
			mysql_query("UPDATE tblEmpMonetization SET vlMonetize = '$t_intMonetizeVL', 
							slMonetize = '$t_intMonetizeSL', monetizeMonth = '$t_intMonetizeMonth'
						WHERE empNumber='$t_strEmpNmbr' 
							AND monetizeYear ='$t_intMonetizeYear'");
		}
		else
		{
			mysql_query("INSERT INTO tblEmpMonetization 
							VALUES('$t_strEmpNmbr', '$t_intMonetizeVL', '$t_intMonetizeSL', '$t_intMonetizeMonth', '$t_intMonetizeYear')");
		}
		
		$this->updateLeaveBalance($t_intMonetizeMonth, $t_intMonetizeYear, $t_strEmpNmbr);
		return "The leave balance has been updated.";
	}
	
	function latestMonetize($t_strEmpNmbr, $t_intYear)
	{
		$objMonetize = mysql_query("SELECT * FROM tblEmpMonetization 
									WHERE monetizeYear='$t_intYear' 
										AND empNumber='$t_strEmpNmbr'");
		$arrMonetize = mysql_fetch_array($objMonetize);
		return $arrMonetize;
	}

//------------------------------- Terminal Leave ----------------------------------------------------

	function terminalLeave($t_strEmpNmbr, $t_intMonetizeMonth, $t_intMonetizeYear)
	{
		mysql_query("UPDATE tblEmpLeaveBalance 
						SET vlBalance='0.00', slBalance='0.00'
					WHERE empNumber='$t_strEmpNmbr' 
						AND periodYear='$t_intMonetizeYear'
						AND periodMonth='$t_intMonetizeMonth'");		
	}

//------------------------------- accumulated leave --------------------------------
	function accmltLeave($t_strEmpNmbr, $t_intYear, $t_strLeaveCode)
	{
			$objLeaveDays = mysql_query("SELECT numOfDays FROM tblLeave 
											WHERE leaveCode='$t_strLeaveCode'");
			$arrLeaveDays = mysql_fetch_array($objLeaveDays);
			
			$objCntLeave = mysql_query("SELECT dtrDate as countLeave FROM tblEmpDTR 
									WHERE remarks = '$t_strLeaveCode'
									AND empNumber = '$t_strEmpNmbr'
									AND dtrDate LIKE '$t_intYear%'");
			$intCntLeave = mysql_num_rows($objCntLeave);

			$strLeaveCode = "H".$t_strLeaveCode;
			$objCntHlfLeave = mysql_query("SELECT dtrDate as countLeave FROM tblEmpDTR 
									WHERE remarks = '$strLeaveCode'
									AND empNumber = '$t_strEmpNmbr'
									AND dtrDate LIKE '$t_intYear%'");
			$intCntHlfLeave = mysql_num_rows($objCntHlfLeave);
			
			$intCntLeave = $intCntLeave + ($intCntHlfLeave * 0.5);
			$intLeaveLeft = intval($arrLeaveDays["numOfDays"]) - $intCntLeave;
			
			return $intLeaveLeft;
	}
//------------------------------------------ halfday leave counter --------------------------------------
	function hlfLeaveCtr($t_strEmpNmbr, $t_intMonth, $t_intYear)
	{
		$dtmMonthYear = $this->combineMonthYear($t_intYear, $t_intMonth);
		
		$objEmpLeave = mysql_query("SELECT dtrDate FROM tblEmpDTR 
										WHERE dtrDate LIKE '$dtmMonthYear%'
											AND empNumber = '$t_strEmpNmbr'
											AND (remarks = 'HSL' OR remarks = 'HVL'
													OR remarks = 'HPL' OR remarks = 'HFL')");
		$intHlfCtr = mysql_num_rows($objEmpLeave);
		return $intHlfCtr * 0.5;
	}
//------------------------------------------ wholeday leave counter --------------------------------------
	function whlLeaveCtr($t_strEmpNmbr, $t_intMonth, $t_intYear)
	{
		$intWhlCtr = 0;
		$dtmMonthYear = $this->combineMonthYear($t_intYear, $t_intMonth);
		
		$objLeave = mysql_query("SELECT leaveCode FROM tblLeave");
		
		while($arrLeave = mysql_fetch_array($objLeave))
		{
			$objEmpLeave = mysql_query("SELECT dtrDate FROM tblEmpDTR 
											WHERE dtrDate LIKE '$dtmMonthYear%'
												AND empNumber = '$t_strEmpNmbr'
												AND remarks = '".$arrLeave["leaveCode"]."'");
			$intEmpLeave = mysql_num_rows($objEmpLeave);
			$intWhlCtr += $intEmpLeave;
		}
		
		return $intWhlCtr;
	}

}
?>