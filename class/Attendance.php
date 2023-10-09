<?
/* 
File Name: Attendance.php 
----------------------------------------------------------------------
Purpose of this file: 
class file that includes methods of attendance
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

require("../hrmis/class/AttendanceOvertime.php");
class Attendance extends AttendanceOvertime
{
	function attendance()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection		
	}

	function getDayFromAndTo($t_arrDay)   //session of checkbox date value in Override.php
	{
		$intCounter = 1;  //counter to get the first array
		if($t_arrDay)
		{
			foreach($t_arrDay as $intDay=>$value)
			{
				if($intCounter == 1)
				{
					$_SESSION['dayFrom'] = $intDay;  // get the first 
				}   //record of the array for date from day.
				$_SESSION['dayTo'] = $intDay;
				$intCounter = $intCounter + 1;
			}
		}
	}

	function getEmpLeaveToday()
	{
		$dtmDateNow = date("Y-m-d");
		$objEmpLeave = mysql_query("SELECT tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename 
						FROM tblEmpPersonal 
					INNER JOIN tblEmpDTR 
						ON tblEmpPersonal.empNumber=tblEmpDTR.empNumber
					INNER JOIN tblLeave 
						ON tblEmpDTR.remarks = tblLeave.leaveCode
					WHERE tblEmpDTR.dtrDate = '$dtmDateNow'");
		while($arrEmpLeave = mysql_fetch_array($objEmpLeave))
		{
			$strOutput .= "<p>".$arrEmpLeave['surname'].", ".$arrEmpLeave['firstname']." ".$arrEmpLeave['middlename']."</p>";
		}
		return $strOutput;
	}

	function getEmpEarlyToday()
	{
		$dtmDateNow = date("Y-m-d");
		$objEmpEarly = mysql_query("SELECT tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, 
								tblEmpPersonal.middlename 
							FROM tblEmpPersonal 
							INNER  JOIN tblEmpDTR 
								ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber 
							INNER  JOIN tblEmpPosition 
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
							INNER  JOIN tblAttendanceScheme 
								ON tblEmpPosition.schemeCode = tblAttendanceScheme.schemeCode 
							WHERE tblEmpDTR.dtrDate =  '$dtmDateNow' 
								AND tblEmpDTR.inAM !=  '".NULLTIME."' 
								AND tblEmpDTR.inAM <= tblAttendanceScheme.amTimeinTo
							ORDER BY tblEmpDTR.inAM 
							LIMIT 0, 10");
		while($arrEmpEarly = mysql_fetch_array($objEmpEarly))
		{
			$strOutput .= "<p>".$arrEmpEarly['surname'].", ".$arrEmpEarly['firstname']." ".$arrEmpEarly['middlename']."</p>";
		}
		return $strOutput;	
	}
	function getEmpLateToday()
	{	
		$dtmDateNow = date("Y-m-d");
		$objEmpLate = mysql_query("SELECT tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, 
								tblEmpPersonal.middlename 
							FROM tblEmpPersonal 
							INNER  JOIN tblEmpDTR 
								ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber 
							INNER  JOIN tblEmpPosition 
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
							INNER  JOIN tblAttendanceScheme 
								ON tblEmpPosition.schemeCode = tblAttendanceScheme.schemeCode 
							WHERE tblEmpDTR.dtrDate =  '$dtmDateNow' 
								AND tblEmpDTR.inAM !=  '".NULLTIME."' 
								AND tblEmpDTR.inAM > tblAttendanceScheme.amTimeinTo
							ORDER BY tblEmpDTR.inAM desc
									LIMIT 0, 10");
		while($arrEmpLate = mysql_fetch_array($objEmpLate))
		{
			$strOutput .= "<p>".$arrEmpLate['surname'].", ".$arrEmpLate['firstname']." ".$arrEmpLate['middlename']."</p>";
		}
		
		$intCntLate = mysql_num_rows($objEmpLate);	
		return $strOutput;		
	}
	
	function arrayEmpCombo($t_arrEmpNmbr)   //combobox for many selection of employees
	{
		foreach($t_arrEmpNmbr as $intCount=>$strEmpNmbr)   //get the combo value
		{
			if($strEmpNmbr != 'Select Employee')  //if the value is Select Employee it means that
			{   //no employees selected
				$arrEmpNumber = array($strEmpNmbr=>$strEmpNmbr);   //put the new value to array
				$intArrElmt = count($_SESSION['arrayEmpNmbr']);   //check if the session array
				//has a value
				if($intArrElmt == 0)   //if no value
				{
					$_SESSION['arrayEmpNmbr'] = $arrEmpNumber;   //put the new value
				}
				else   //else
				{   //merge the existing from the new
					$_SESSION['arrayEmpNmbr'] = array_merge($_SESSION['arrayEmpNmbr'], $arrEmpNumber);
					$_SESSION['arrayEmpNmbr'] = array_unique($_SESSION['arrayEmpNmbr']);
				}
	
			}
		}
	}
	
	function excludedInDTR($t_arrEmpNmbr)
	{
		$strOrSQL = "";
		$strAndSQL = "";
		$intFlag = 0;
		foreach($t_arrEmpNmbr as $key=>$strEmpNmbr)   //get the combo value
		{
			if($intFlag == 0)
			{
				$strOrSQL = "empNumber='$strEmpNmbr' ";
				$strAndSQL = "empNumber != '$strEmpNmbr' ";				
				$intFlag = 1;
			}
			else
			{
				$strOrSQL = $strOrSQL."OR empNumber='$strEmpNmbr' ";
				$strAndSQL = $strAndSQL."AND empNumber != '$strEmpNmbr' ";
			}	
		}
		mysql_query("UPDATE tblEmpPosition SET dtrSwitch='N' WHERE ".$strOrSQL);
		mysql_query("UPDATE tblEmpPosition SET dtrSwitch='Y' WHERE ".$strAndSQL);
	}
	
	function retrieveExcludedInDTR()
	{
		$objExcDTR = mysql_query("SELECT empNumber 
									FROM tblEmpPosition 
									WHERE dtrSwitch = 'N'");
		while($arrExcDTR = mysql_fetch_array($objExcDTR))
		{
			$arrEmpNumber = array($arrExcDTR['empNumber']=>$arrExcDTR['empNumber']);
			
			$intArrElmt = count($_SESSION['arrayEmpNmbr']);   //check if the session array
			//has a value
			if($intArrElmt == 0)   //if no value
			{
				$_SESSION['arrayEmpNmbr'] = $arrEmpNumber;   //put the new value
			}
			else   //else
			{   //merge the existing from the new
				$_SESSION['arrayEmpNmbr'] = array_merge($_SESSION['arrayEmpNmbr'], $arrEmpNumber);
				$_SESSION['arrayEmpNmbr'] = array_unique($_SESSION['arrayEmpNmbr']);
			}
			
		}
	}
	
	//------------------------------------ trap errors from attendance ----------------------------
	
	function permitOvertime($t_strEmpNmbr, $t_strMonth, $t_strYear, $t_arrDay)
	{
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $intDay=>$value)
			{
				$dtmDate = $this->combineDate($t_strYear, $t_strMonth, $intDay);
				$objEmpOT = mysql_query("SELECT remarks FROM tblEmpDTR 
											WHERE empNumber='$t_strEmpNmbr'
												AND dtrDate='$dtmDate'
												AND remarks='OT'");
				if(mysql_num_rows($objEmpOT))
				{
					return 1;
				}
			}
			return 0; // nothing find overtime on this employee
		}
	}
	
	function trapUncheckDay($t_arrDay)
	{
		if(count($t_arrDay) == 0)
		{
			session_register('ovrdErrMsg');
			$_SESSION['ovrdErrMsg'] = "Please check the checkbox(es) of the selected day(s).";
			$strPage = "DTR.php?a=a".$this->varstr;
			header("Location: $strPage");				
		}
		else
		{
			$_SESSION['ovrdErrMsg'] = "";
		}		
	}
	
	function trapHolidayWeekend($t_strMonth, $t_strYear, $t_arrDay, $t_blnRedirect=1)
	{
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $intDay=>$value)
			{
				$blnHoliday = 0;
				$dtmDate = $this->combineDate($t_strYear, $t_strMonth, $intDay);
				$strDayName = date("D", strtotime($dtmDate));
				
				$blnHoliday = $this->checkIfHoliday($t_strMonth, $t_strYear, $intDay);
				
				if($strDayName == "Sun" || $strDayName == "Sat" || $blnHoliday != 0)
				{
					session_register('ovrdErrMsg');
					$_SESSION['ovrdErrMsg'] = "The selected day is not acceptable, beacause it is weekend or holiday.";
					if($t_blnRedirect)
					{
						$strPage = "DTR.php?a=a".$this->varstr;
						header("Location: $strPage");	
					}
				}
				else
				{
					$_SESSION['ovrdErrMsg'] = "";
				}		
			}
		}	
	}
	
	function trapAheadPresentDay($t_strMonth, $t_strYear, $t_arrDay)
	{
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $intDay=>$value)
			{
				$dtmDate = $this->combineDate($t_strYear, $t_strMonth, $intDay);
				
				$dtmDateNow = date("Y-m-d");
				
				if(strtotime($dtmDate) > strtotime($dtmDateNow))
				{
					session_register('ovrdErrMsg');
					$_SESSION['ovrdErrMsg'] = "The selected day is not acceptable, beacause it is ahead of the present day.";
					$strPage = "DTR.php?a=a".$this->varstr;
					header("Location: $strPage");					
				}
				else
				{
					$_SESSION['ovrdErrMsg'] = "";
				}						
			}
		}		
	}
	
	function trapNotMonday($t_strMonth, $t_strYear, $t_arrDay)
	{
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $intDay=>$value)
			{
				$dtmDate = $this->combineDate($t_strYear, $t_strMonth, $intDay);
				$strDayName = date("D", strtotime($dtmDate));
				
				if($strDayName != "Mon")
				{
					session_register('ovrdErrMsg');
					$_SESSION['ovrdErrMsg'] = "The selected day is not acceptable, beacause it is not monday.";
					$strPage = "DTR.php?a=a".$this->varstr;
					header("Location: $strPage");	
				}
				else
				{
					$_SESSION['ovrdErrMsg'] = "";
				}						
			}
		}		
	}
	
	function trapWeekdays($t_strMonth, $t_strYear, $t_arrDay)
	{
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $intDay=>$value)
			{
				$blnHoliday = 0;
				$dtmDate = $this->combineDate($t_strYear, $t_strMonth, $intDay);
				$strDayName = date("D", strtotime($dtmDate));
				
				$blnHoliday = $this->getDayName($t_strMonth, $t_strYear, $intDay);
				
				if($strDayName != "Sun" && $strDayName != "Sat" && $blnHoliday == 0)
				{
					session_register('ovrdErrMsg');
					$_SESSION['ovrdErrMsg'] = "The selected day is not acceptable, beacause it is weekday(s).";
					$strPage = "DTR.php?a=a".$this->varstr;
					header("Location: $strPage");	
				}
				else
				{
					$_SESSION['ovrdErrMsg'] = "";
				}		
			}
		}		
	}
	
	function trapCmpltTime($t_strEmpNmbr, $t_strMonth, $t_strYear, $t_arrDay, $t_strButton, $t_blnRedirect=1)
	{
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $value=>$intDay)
			{
				$dtmDate = $this->combineDate($t_strYear, $t_strMonth, $intDay);
				
				$strSQL = "SELECT * FROM tblEmpDTR 
							WHERE empNumber='$t_strEmpNmbr'
								AND dtrDate='$dtmDate'
								 AND ( (inAM !='".NULLTIME."' AND outAM !='".NULLTIME."'
										AND inPM !='".NULLTIME."' AND outPM !='".NULLTIME."'
										AND inOT !='".NULLTIME."' AND outOT !='".NULLTIME."')
									OR	(inAM !='".NULLTIME."' AND outPM !='".NULLTIME."'
										AND inOT !='".NULLTIME."' AND outOT !='".NULLTIME."') )";
				$objFull = mysql_query($strSQL);
				if(mysql_num_rows($objFull) && $t_strButton != 'OVERTIME' && $t_strButton != 'TIME' && $t_strButton != 'FLAG CEREMONY')
				{
					session_register('ovrdErrMsg');
					$_SESSION['ovrdErrMsg'] = "Sorry, the selected day cannot be edited.";
					
					if($t_blnRedirect)
					{
						$strPage = "DTR.php?a=a".$this->varstr;
						header("Location: $strPage");
					}
				}
				else
				{
					$strSQL = "SELECT * FROM tblEmpDTR 
								WHERE empNumber='$t_strEmpNmbr'
									AND dtrDate='$dtmDate'
									 AND ( (inAM !='".NULLTIME."' AND outAM !='".NULLTIME."'
											AND inPM !='".NULLTIME."' AND outPM !='".NULLTIME."')
										OR	(inAM !='".NULLTIME."' AND outPM !='".NULLTIME."') )";
					$objWhlDay = mysql_query($strSQL);
					if(mysql_num_rows($objWhlDay) && $t_strButton != 'OVERTIME'  && $t_strButton != 'TIME' && $t_strButton != 'FLAG CEREMONY')
					{
						session_register('ovrdErrMsg');
						$_SESSION['ovrdErrMsg'] = "Sorry, only overtime application is applicable for this date.";
						
						if($t_blnRedirect)
						{
							$strPage = "DTR.php?a=a".$this->varstr;
							header("Location: $strPage");
						}
					}
					else
					{
						$strSQL = "SELECT * FROM tblEmpDTR 
									WHERE empNumber='$t_strEmpNmbr'
										AND dtrDate='$dtmDate'
										 AND ( (inAM !='".NULLTIME."' AND outAM !='".NULLTIME."')
											OR	(inPM !='".NULLTIME."' AND outPM !='".NULLTIME."') )";
						$objWhlDay = mysql_query($strSQL);
						if(mysql_num_rows($objWhlDay) && $t_strButton != 'OB' && $t_strButton != 'LEAVE' && $t_strButton != 'TIME' && $t_strButton != 'OVERTIME' && $t_strButton != 'FLAG CEREMONY')
						{
							session_register('ovrdErrMsg');
							$_SESSION['ovrdErrMsg'] = "Only time editing, OB and leave application is applicable for this date.";

							if($t_blnRedirect)
							{
								$strPage = "DTR.php?a=a".$this->varstr;
								header("Location: $strPage");
							}
						}
						else
						{
							$_SESSION['ovrdErrMsg'] = "";
						}						
					}													
				}								
			}
		}			
	}
//--------------------------------- travel order ------------------------------------------------------	
	function travel($t_strEmpNmbr, $t_strDest, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_strPurpose, $t_strFund, $t_strTranspo, $t_blnPerdiem)
	{   //adds leave to tblEmpLeave
		$strDateFrom = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $t_intDayFrom);
		$strDateTo = $this->combineDate($t_intYearTo, $t_intMonthTo, $t_intDayTo);
		$dtmDateNow = date("Y-m-d");
		mysql_query("INSERT INTO tblEmpTravelOrder (dateFiled, empNumber, destination, purpose, 
						fund, transportation, perdiem, toDateFrom, toDateTo)
					VALUES ('$dtmDateNow','$t_strEmpNmbr', '$t_strDest', '$t_strPurpose', 
							'$t_strFund', '$t_strTranspo', '$t_blnPerdiem', '$strDateFrom', '$strDateTo')");
		
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
		
				$strSql = $this->sqlDTR($intNewID, $objDay, $t_strEmpNmbr, $strDate, TRAVELORDER);
				mysql_query($strSql);
			}
		}	
	}
	
	function travelOrder($t_strEmpNmbr, $t_strDest, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_strPurpose, $t_strFund, $t_strTranspo, $t_blnPerdiem)
	{
		$this->travel($t_strEmpNmbr, $t_strDest, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_strPurpose, $t_strFund, $t_strTranspo, $t_blnPerdiem);
		
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

		$strPage = "DTR.php?a=a".$this->varstr;
		header("Location: $strPage");										
	}
	
	function sqlDTR($t_intNewID, $t_objDay, $t_strEmpNmbr, $t_strDate, $t_strCode)
	{
		if(!mysql_num_rows($t_objDay))
		{			
			return "INSERT INTO tblEmpDTR (empNumber, inAM, outAM, inPM, outPM, inOT, outOT, dtrDate, remarks, otherInfo)
					VALUES ('$t_strEmpNmbr', '', '', '', '', '', '', '$t_strDate', '$t_strCode', '$t_intNewID')";		
		}
		else
		{		
			return "UPDATE tblEmpDTR SET remarks = '$t_strCode', inAM = '', outAM = '',
						inPM = '', outPM = '', inOT = '', outOT ='', otherInfo='$t_intNewID'
						WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$t_strDate'";		
		}			
	}
//------------------------------------------- ticket trip --------------------------------------	

	function ticket($t_strEmpNmbr, $t_strDest, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_strPurpose, $t_blnPerdiem)
	{   //adds leave to tblEmpLeave
		$strDateFrom = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $t_intDayFrom);
		$strDateTo = $this->combineDate($t_intYearTo, $t_intMonthTo, $t_intDayTo);
		$dtmDateNow = date("Y-m-d");
		mysql_query("INSERT INTO tblEmpTripTicket (dateFiled, empNumber, destination, purpose, 
						perdiem, ttDateFrom, ttDateTo)
					VALUES ('$dtmDateNow','$t_strEmpNmbr', '$t_strDest', '$t_strPurpose', 
							'$t_blnPerdiem', '$strDateFrom', '$strDateTo')");
		
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
		
				$strSql = $this->sqlDTR($intNewID, $objDay, $t_strEmpNmbr, $strDate, TRIPTICKET);
				mysql_query($strSql);
			}
		}	
	}
	
	function tripTicket($t_strEmpNmbr, $t_strDest, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_strPurpose, $t_blnPerdiem)
	{
		$this->ticket($t_strEmpNmbr, $t_strDest, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_strPurpose, $t_blnPerdiem);
		
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

		$strPage = "DTR.php?a=a".$this->varstr;
		header("Location: $strPage");										
	}

//------------------------------------------- meeting --------------------------------------	

	function meet($t_strEmpNmbr, $t_strMeeting, $t_intYear, $t_intMonth, $t_intDay)
	{   //adds leave to tblEmpLeave
		$strDate = $this->combineDate($t_intYear, $t_intMonth, $t_intDay);
		$dtmDateNow = date("Y-m-d");
		mysql_query("INSERT INTO tblEmpMeeting(dateFiled, empNumber, meetingTitle, meetingDate)
					VALUES ('$dtmDateNow','$t_strEmpNmbr', '$t_strMeeting', '$strDate')");
		
		$intNewID = mysql_insert_id();
						
		$strDayName = date('l', strtotime($strDate));
		
		$blnHoliday = $this->checkIfHoliday($t_intMonth, $t_intYear, $t_intDay);
		
		if($strDayName != "Sunday" && $strDayName != "Saturday" && $blnHoliday == 0)
		{
			$objDay = mysql_query("SELECT * FROM tblEmpDTR 
									WHERE empNumber = '$t_strEmpNmbr' 
										AND dtrDate = '$strDate'");
	
			$strSql = $this->sqlMeeting($intNewID, $objDay, $t_strEmpNmbr, $strDate, MEETING);
			mysql_query($strSql);
		}	
	}
	
	function meeting($t_strEmpNmbr, $t_strMeeting, $t_intYear, $t_intMonth, $t_intDay)
	{
		$this->meet($t_strEmpNmbr, $t_strMeeting, $t_intYear, $t_intMonth, $t_intDay);
		
		$strPage = "DTR.php?a=a".$this->varstr;
		header("Location: $strPage");										
	}

	function sqlMeeting($t_intNewID, $t_objDay, $t_strEmpNmbr, $t_strDate, $t_strCode)
	{
		if(!mysql_num_rows($t_objDay))
		{			
			return "INSERT INTO tblEmpDTR (empNumber, inAM, outAM, inPM, outPM, inOT, outOT, dtrDate, remarks, otherInfo)
					VALUES ('$t_strEmpNmbr', '', '', '', '', '', '', '$t_strDate', '$t_strCode', '$t_intNewID')";		
		}
		else
		{		
			return "UPDATE tblEmpDTR SET remarks = '$t_strCode', otherInfo='$t_intNewID'
						WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$t_strDate'";		
		}			
	}

//------------------------------------------- filed request Leave --------------------------------------	

	function filedRequestLeave($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_intPage, $t_intCurrPage)
	{
		$dtmDate = $this->combineMonthYear($t_intYear, $t_intMonth);
		$strSQL = "SELECT tblEmpLeave.dateFiled, tblLeave.leaveType, 
										tblEmpLeave.leaveFrom, tblEmpLeave.leaveTo
									FROM tblEmpLeave
									INNER JOIN tblLeave
										ON tblEmpLeave.leaveCode = tblLeave.leaveCode
									WHERE empNumber = '$t_strEmpNmbr' 
									AND (leaveFrom LIKE '$dtmDate%' OR leaveTo LIKE '$dtmDate%')
									ORDER BY dateFiled DESC";
		$objRqstLeave = mysql_query($strSQL);

		$intTotalRecord = mysql_num_rows($objRqstLeave);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objRqstLeave = mysql_query($strSQL);
		
		return $objRqstLeave;
	}

//------------------------------------------- filed request OB --------------------------------------	

	function filedRequestOB($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_intPage, $t_intCurrPage)
	{
		$dtmDate = $this->combineMonthYear($t_intYear, $t_intMonth);
		$strSQL = "SELECT *	FROM tblEmpOB
					WHERE empNumber = '$t_strEmpNmbr' 
					AND (obDateFrom LIKE '$dtmDate%' OR obDateTo LIKE '$dtmDate%')
					ORDER BY dateFiled DESC";
		$objRqstOB = mysql_query($strSQL);
		
		$intTotalRecord = mysql_num_rows($objRqstOB);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objRqstOB = mysql_query($strSQL);


		return $objRqstOB;
	}
//------------------------------------------- filed request Overtime --------------------------------------	
	function filedRequestOT($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_intPage, $t_intCurrPage)
	{
		$dtmDate = $this->combineMonthYear($t_intYear, $t_intMonth);
		$strSQL = "SELECT dateFiled, docNumber, otDateFrom, otDateTo
									FROM tblEmpOvertime
									WHERE empNumber = '$t_strEmpNmbr' 
									AND (otDateFrom LIKE '$dtmDate%' OR otDateTo LIKE '$dtmDate%')
									ORDER BY dateFiled DESC";
		$objRqstOT = mysql_query($strSQL);

		$intTotalRecord = mysql_num_rows($objRqstOT);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objRqstOT = mysql_query($strSQL);
		
		return $objRqstOT;
	}
//------------------------------------------- filed request travel order --------------------------------------	
	function filedRequestTO($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_intPage, $t_intCurrPage)
	{
		$dtmDate = $this->combineMonthYear($t_intYear, $t_intMonth);
		$strSQL = "SELECT dateFiled, destination, toDateFrom, toDateTo
									FROM tblEmpTravelOrder
									WHERE empNumber = '$t_strEmpNmbr' 
									AND (toDateFrom LIKE '$dtmDate%' OR toDateTo LIKE '$dtmDate%')
									ORDER BY dateFiled DESC";
		$objRqstTO = mysql_query($strSQL);
		
		$intTotalRecord = mysql_num_rows($objRqstTO);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objRqstTO = mysql_query($strSQL);
		
		return $objRqstTO;
	}	
//------------------------------------------- filed request travel order --------------------------------------	
	function filedRequestTT($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_intPage, $t_intCurrPage)
	{
		$dtmDate = $this->combineMonthYear($t_intYear, $t_intMonth);
		$strSQL = "SELECT dateFiled, destination, ttDateFrom, ttDateTo
									FROM tblEmpTripTicket
									WHERE empNumber = '$t_strEmpNmbr' 
									AND (ttDateFrom LIKE '$dtmDate%' OR ttDateTo LIKE '$dtmDate%')
									ORDER BY dateFiled DESC";
		$objRqstTT = mysql_query($strSQL);

		$intTotalRecord = mysql_num_rows($objRqstTT);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objRqstTT = mysql_query($strSQL);
		
		return $objRqstTT;
	}
//------------------------------------------- filed request travel order --------------------------------------	
	function filedRequestMeeting($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_intPage, $t_intCurrPage)
	{
		$dtmDate = $this->combineMonthYear($t_intYear, $t_intMonth);
		$strSQL = "SELECT dateFiled, meetingTitle, meetingDate
									FROM tblEmpMeeting
									WHERE empNumber = '$t_strEmpNmbr' 
									AND meetingDate LIKE '$dtmDate%'
									ORDER BY dateFiled DESC";
		$objRqstMeeting = mysql_query($strSQL);
		
		$intTotalRecord = mysql_num_rows($objRqstMeeting);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objRqstMeeting = mysql_query($strSQL);
		
		return $objRqstMeeting;
	}			

//------------------------------------------- Warning message on override -------------------------------------	

	function warningMsgOvrrd($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_arrDate)
	{
		if(count($t_arrDate) != 0)
		{
			foreach($t_arrDate as $key=>$intDay)
			{
				$dtmDate = $this->combineDate($t_intYear, $t_intMonth, $intDay);

				$objDTR = mysql_query("SELECT remarks FROM tblEmpDTR 
										WHERE dtrDate='$dtmDate' 
											AND empNumber='$t_strEmpNmbr'
											AND remarks != ''");
				if(mysql_num_rows($objDTR))
				{
					$arrDTR = mysql_fetch_array($objDTR);
					$objCode = mysql_query("SELECT name FROM tblAttendanceCode
												WHERE code='".$arrDTR["remarks"]."'");
					$arrCode = mysql_fetch_array($objCode);
					
					$strMessage = "This day ".date("F d, Y", strtotime($dtmDate)).", is set as ".$arrCode["name"].". If you continue to change the setting the recent value will be forfeited.";
					$arrReturn = array("message"=>$strMessage, "day"=>$intDay);
					return $arrReturn;
				}
				else
				{
					return "";
				}
			}
		}	
		else
		{
			return "";
		}
	}
//----------------------------------- remove from table before proceeding -----------------------------

	function removeFromTable($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_intDay)
	{
		$dtmDate = $this->combineDate($t_intYear, $t_intMonth, $t_intDay);
		$objDTR = mysql_query("SELECT * FROM tblEmpDTR 
								WHERE dtrDate='$dtmDate' AND empNumber='$t_strEmpNmbr'");
		$arrDTR = mysql_fetch_array($objDTR);

		if($arrDTR["remarks"] == "PTL" || $arrDTR["remarks"] == "ML" || $arrDTR["remarks"] == "STL" || $arrDTR["remarks"] == "HFL" || $arrDTR["remarks"] == "HPL" || $arrDTR["remarks"] == "HSL" || $arrDTR["remarks"] == "HVL" || $arrDTR["remarks"] == "FL" || $arrDTR["remarks"] == "PL" || $arrDTR["remarks"] == "SL" || $arrDTR["remarks"] == "VL")
		{
			if($arrDTR["otherInfo"] != "blank")
			{
				$strTable = "tblEmpLeave";
				$strField = "leaveID";
			}
		}
		elseif($arrDTR["remarks"] == "OB" || $arrDTR["remarks"] == "QB")
		{
			$strTable = "tblEmpOB";
			$strField = "obID";
			
			$objOB = mysql_query("SELECT obDateFrom, obDateTo 
									FROM tblEmpOB 
									WHERE obID ='".$arrDTR["otherInfo"]."'");
			$arrOB = mysql_fetch_array($objOB);
						
			$dtmDiff =  strtotime($arrOB["obDateTo"]) - strtotime($arrOB["obDateFrom"]);
			$intHour = floor($dtmDiff/60/60);
			
			if(date("A", strtotime($arrOB["obDateFrom"])) == AM)
			{
				 if($intHour < 9)
				 {
					$strFieldIn = "inAM";
					$strFieldOut = "outAM";
				 }
				 else
				 {
					$strFieldIn = "inAM";
					$strFieldOut = "outPM";
				 }
			}
			else
			{
				$strFieldIn = "inPM";
				$strFieldOut = "outPM";			
			}
			
			$strUpdateDTR = "UPDATE tblEmpDTR SET ".$strFieldIn."='', ".$strFieldOut."='', remarks=''
						WHERE dtrDate='$dtmDate' AND empNumber='$t_strEmpNmbr'";
	
		}
		elseif($arrDTR["remarks"] == "FC")
		{
			mysql_query("UPDATE tblEmpDTR SET inAM='', remarks='' 
							WHERE dtrDate='$dtmDate' AND empNumber='$t_strEmpNmbr'");
		}
		elseif($arrDTR["remarks"] == "OT")
		{
			$strTable = "tblEmpOvertime";
			$strField = "otID";
		}
		elseif($arrDTR["remarks"] == "TO")
		{
			$strTable = "tblEmpTravelOrder";
			$strField = "toID";
		}
		elseif($arrDTR["remarks"] == "TT")
		{
			$strTable = "tblEmpTripTicket";
			$strField = "ttID";
		}
		elseif($arrDTR["remarks"] == "MET")
		{
			$strTable = "tblEmpMeeting";
			$strField = "meetingID";
		}

		$strOthInfo = "SELECT dtrDate FROM tblEmpDTR 
								WHERE otherInfo = '".$arrDTR["otherInfo"]."' AND remarks='".$arrDTR["remarks"]."'";
		
		$objOthInfo = mysql_query($strOthInfo);
		$intOthInfo = mysql_num_rows($objOthInfo);

		if($intOthInfo == 1)
		{
//echo "delete garbage";
			$strSQL = "DELETE FROM ".$strTable." WHERE ".$strField." = '".$arrDTR["otherInfo"]."'";
			mysql_query($strSQL);
		}		
		if(strlen($strUpdateDTR) != 0)
		{
//echo "update DTR";
			mysql_query($strUpdateDTR);		//remove unnecessary data
		}
	}
}
?>