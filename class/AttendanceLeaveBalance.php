<?
/* 
File Name: AttendanceLeaveBalance.php 
----------------------------------------------------------------------
Purpose of this file: 
Class attendance leave balance
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

require("../hrmis/class/AttendanceUndertime.php");
include_once("../hrmis/class/Constant.php");
class AttendanceLeaveBalance extends AttendanceUndertime
{
//--------------------- view leave balance leavebalance.php-------------------------
	function viewLeaveBalance($t_strMonth, $t_strYear, $t_strEmpNmbr)
	{
		$objEmpLeaveBal = mysql_query("SELECT * FROM tblEmpLeaveBalance 
										WHERE periodMonth = '$t_strMonth'
										AND periodYear = '$t_strYear'
										AND empNumber = '$t_strEmpNmbr'");
		while($arrEmpLeaveBal = mysql_fetch_array($objEmpLeaveBal))
		{
			return $arrEmpLeaveBal;
		}
	}
	
	function checkEmpLB($t_strEmpNmbr)
	{
		$objEmpLB = mysql_query("SELECT empNumber FROM tblEmpLeaveBalance WHERE empNumber='$t_strEmpNmbr'");
		if(mysql_num_rows($objEmpLB) == 0)
		{
			return 1;   //to view the add start leave balance in Leavebalance.php
		}
		else
		{
			return 0;
		}
	}
	
	function viewScreen($t_strEmpNmbr)
	{
		$intEmp = $this->checkEmpLB($t_strEmpNmbr);
		if($intEmp)
		{
			return "SSLB";
		}
		else
		{
			return "LLBM";
		}
	}
//------------------------------- add new starting leave balance -------------------------------------------
	function getEmpAge($t_strEmpNmbr)
	{
		$objBirthday = mysql_query("SELECT birthday FROM tblEmpPersonal WHERE empNumber='$t_strEmpNmbr'");
		$arrBirthday = mysql_fetch_array($objBirthday);

		$dtmAge = strtotime("now") - strtotime($arrBirthday["birthday"]);
		
		return floor($dtmAge/365/60/60/24);
	}
	
	function getEmpEarned($t_strEmpNmbr, $t_intWOP=0)
	{
		$dtmLngvty = $this->getEmpLngvty($t_strEmpNmbr);
		$arrLBStartDate = $this->getLBMonthYear($t_strEmpNmbr);
		
		$dtmLBStartDate = $this->combineDate($arrLBStartDate["lbStartYear"], $arrLBStartDate["lbStartMonth"], "01");
		
		$intAge = $this->getEmpAge($t_strEmpNmbr);

		if ($intAge < 65)		
		{
			if($dtmLngvty <= $dtmLBStartDate)
			{
				$intEarned = MONTH_EARNED - (0.042 * number_format($t_intWOP,3,".",""));
				
				return number_format($intEarned,3,".","");
			}
			else
			{
				$intTotalDays = date('t', strtotime($dtmLngvty));
				$intLngvtyDay = epochDate('j', $dtmLngvty);
				
				$intWorkDays = ($intTotalDays - $intLngvtyDay) + 1;
				
				$intEarned = 0.042 * $intWorkDays;
				return number_format($intEarned,3,".","");
			}
		}
		else
		{
			return 0;
		}
		
	}
	
	function addEmpLeaveBalance($t_strEmpNmbr, $t_intYear, $t_intMonth, $t_intEarned, $t_intVLBlnc, $t_intVLAbsUndWP, $t_intVLAbsUndWOP, $t_intSLBlnc, $t_intSLAbsUndWP, $t_intSLAbsUndWOP)
	{
		mysql_query("DELETE FROM tblEmpLeaveBalance WHERE empNumber = '$t_strEmpNmbr'");
		mysql_query("INSERT INTO tblEmpLeaveBalance 
						(empNumber, periodMonth, periodYear, 
						vlEarned, vlAbsUndWPay, vlAbsUndWoPay, vlBalance,
						slEarned, slAbsUndWPay, slAbsUndWoPay, slBalance)
					VALUES ('$t_strEmpNmbr', '$t_intMonth', '$t_intYear', 
					'$t_intEarned', '$t_intVLAbsUndWP', '$t_intVLAbsUndWOP', '$t_intVLBlnc', 
					'$t_intEarned', '$t_intSLAbsUndWP', '$t_intSLAbsUndWOP', '$t_intSLBlnc')");	

		$arrLastLB = $this->getLastRcrdFrmLeaveBlnc();
		
		if($arrLastLB['periodMonth'] != 0 && $arrLastLB['periodYear'] != 0)
		{
			$intMonthStart = $t_intMonth;
			$intMonthEnd = $arrLastLB['periodMonth'];
			$intYearStart = $t_intYear;
			$intYearEnd = $arrLastLB['periodYear'];
			
			for($intYearCtr = $intYearStart; $intYearCtr <= $intYearEnd; $intYearCtr++)
			{
				if($intYearCtr == $intYearStart)
				{
					$intForLoopMonthStart = $intMonthStart;	
				}
				else
				{
					$intForLoopMonthStart = 1;	
				}
				
				if($intYearCtr == $intYearEnd)
				{
					$intForLoopMonthEnd = $intMonthEnd;
				}
				else
				{
					$intForLoopMonthEnd = 12;
				}
				
				for($intMonthCtr = $intForLoopMonthStart; $intMonthCtr <= $intForLoopMonthEnd; $intMonthCtr++)
				{
					$this->updateLeaveBalance($intMonthCtr, $intYearCtr, $t_strEmpNmbr);
				}
			}
		}
	}
//-------------------------------- leave balance force leave------------------------------------------------------	
	function lessForceLeave($t_intMonth, $t_intVLBalance)
	{
		if (($t_intVLBalance > 10) && $t_intMonth == 12)
		{
			return $t_intVLBalance - 5;
		}
		else
		{
			return $t_intVLBalance;
		}
	}
//-------------------------------- update leave balance------------------------------------------------------
	function updateLeaveBalance($t_intMonth, $t_intYear, $t_strEmpNmbr='')
	{
		
		$arrMonthYear = $this->getPreMonth($t_intMonth, $t_intYear);
		$intMonth = $arrMonthYear["month"];
		$intYear = $arrMonthYear["year"];
		
		$strSQL = "SELECT empNumber, vlBalance, slBalance 
											FROM tblEmpLeaveBalance 
											WHERE periodMonth = '$intMonth'
												AND periodYear = '$intYear'";
		if(strlen($t_strEmpNmbr) != 0)
		{
			$strSQL = $strSQL." AND empNumber = '$t_strEmpNmbr'";
		}
		
		$objExistLeaveBal = mysql_query($strSQL);

		while($arrExistLeaveBal = mysql_fetch_array($objExistLeaveBal))
		{
			//make all blank entries VL
			$objDTRSwitch = mysql_query("SELECT dtrSwitch FROM tblEmpPosition WHERE empNumber='".$arrExistLeaveBal["empNumber"]."'");
			$arrDTRSwitch = mysql_fetch_array($objDTRSwitch);
			
			if ($arrDTRSwitch["dtrSwitch"] == "Y")
			{
				$this->makeAllBlank($arrExistLeaveBal["empNumber"], $t_intMonth, $t_intYear);  //make all blank dates VL
			}
			
			//make less than or equal workhours VL
			$this->lessHourLeave($arrExistLeaveBal["empNumber"], $t_intMonth, $t_intYear);
			
			//disregards the filed leave with appropriate time-in-out
			$this->setDisregardLeaveFiled($t_intMonth, $t_intYear, $arrExistLeaveBal["empNumber"]);
		
			$strEmpNmbr = $arrExistLeaveBal["empNumber"];
			$intVlPreBalance = $arrExistLeaveBal['vlBalance'];
			$intSlPreBalance = $arrExistLeaveBal['slBalance'];					

			$intVL = $this->getMonthSLVL($t_intMonth, $t_intYear, $strEmpNmbr, VACLEAVE);
			$intHVL = $this->getMonthSLVL($t_intMonth, $t_intYear, $strEmpNmbr, HVACLEAVE);
			$intVL = $intVL + ($intHVL * 0.5);
			
			$intSL = $this->getMonthSLVL($t_intMonth, $t_intYear, $strEmpNmbr, SICKLEAVE);
			$intHSL = $this->getMonthSLVL($t_intMonth, $t_intYear, $strEmpNmbr, HSICKLEAVE);
			$intSL = $intSL + ($intHSL * 0.5);
			
			$intAbsUnd = $this->getMonthAbsUnd($t_intMonth, $t_intYear, $strEmpNmbr, $intVL);
			
			//THE monetized leave if zero...
			$intMonetizeVL = $this->getMonetize($t_intMonth, $t_intYear, $strEmpNmbr, VACLEAVE);
			$intMonetizeSL = $this->getMonetize($t_intMonth, $t_intYear, $strEmpNmbr, SICKLEAVE);
			
			//$intEarned = MONTH_EARNED;

			$intVlBalance = $intVlPreBalance - $intMonetizeVL;
			$intSlBalance = $intSlPreBalance - $intMonetizeSL;

			$dtmLngvty = $this->getEmpLngvty($arrExistLeaveBal["empNumber"]);
			$dtmLastDayOfMonthYear = $this->lastDayOfMonthYear($t_intYear, $t_intMonth);
			$intWorkMonths = $this->dateDiffInMonths($dtmLngvty, $dtmLastDayOfMonthYear);
			
			if($intWorkMonths >= 6)   //more than or equal to 6 months pede nang mag leave with pay
			{			
				$arrVLBalance = $this->computeAbsUndWPWOP($intVlBalance, $intAbsUnd);
				$arrSLBalance = $this->computeAbsUndWPWOP($intSlBalance, $intSL);
				
				$arrSLWOPToVLBlnc = $this->lessSLAbsUndWOPToVLBlnc($arrVLBalance["Balance"], $arrSLBalance["AbsUndWOP"], $arrVLBalance["AbsUndWP"]);
	
				$intVLAbsUndWP =  $arrSLWOPToVLBlnc['VLAbsUndWP'];   //VL absent undertime late with pay
				$intVLAbsUndWOP = $arrVLBalance['AbsUndWOP'];   //VL absent undertime late without pay
				$intVLBalance = $arrSLWOPToVLBlnc['VLBalance'];
	
				$intSLAbsUndWP = $arrSLBalance['AbsUndWP'];   //SL absent undertime late with pay
				$intSLAbsUndWOP = $arrSLWOPToVLBlnc['SLAbsUndWOP'];   //SL absent undertime late without pay
				$intSLBalance = $arrSLBalance['Balance'];
			}
			elseif($intWorkMonths < 6)   //6 less than leave without pay
			{
				$intVLAbsUndWP = 0;   //VL absent undertime late with pay
				$intVLAbsUndWOP = $intAbsUnd;   //VL absent undertime late minus lahat sa withoutpay
				$intVLBalance = $intVlBalance;
	
				$intSLAbsUndWP = 0;   //SL absent undertime late with pay
				$intSLAbsUndWOP = $intSL;   //SL absent undertime late minus lahat sa withoutpay
				$intSLBalance = $intSlBalance;			
			}
			
			$intVLEarned = $this->getEmpEarned($strEmpNmbr, $intVLAbsUndWOP);
			$intVLBalance = $intVLEarned + $intVLBalance;
			$intVLBalance = $this->lessForceLeave($t_intMonth, $intVLBalance);  //force leave
			//$intSLEarned = $this->getEmpEarned($strEmpNmbr, $intSLAbsUndWOP);
			$intSLEarned = $intVLEarned;
			$intSLBalance = $intSLEarned + $intSLBalance;
			 
			$objLeaveBalance = mysql_query("SELECT empNumber 
											FROM tblEmpLeaveBalance 
											WHERE periodMonth = '$t_intMonth'
													AND periodYear = '$t_intYear' 
													AND empNumber = '$strEmpNmbr'");
						
			if(mysql_num_rows($objLeaveBalance) === 0)
			{
				$strVLSQL = "'$intVLEarned', '$intVLAbsUndWP', '$intVlPreBalance', '$intVLBalance', '$intVLAbsUndWOP', ";
				$strSLSQL = "'$intSLEarned', '$intSLAbsUndWP', '$intSlPreBalance', '$intSLBalance', '$intSLAbsUndWOP')";
				$strSQL = "INSERT INTO tblEmpLeaveBalance (empNumber, periodMonth, periodYear, 
								vlEarned, vlAbsUndWPay, vlPreBalance, vlBalance, vlAbsUndWoPay,
								slEarned, slAbsUndWPay, slPreBalance, slBalance, slAbsUndWoPay)
							 VALUES ('$strEmpNmbr', '$t_intMonth', '$t_intYear', ";
				mysql_query($strSQL.$strVLSQL.$strSLSQL);
			}
			else
			{			
				$strVLSQL = "vlEarned = '$intVLEarned', vlAbsUndWPay = '$intVLAbsUndWP', 
							vlPreBalance = '$intVlPreBalance', vlBalance = '$intVLBalance', 
							vlAbsUndWoPay = '$intVLAbsUndWOP', ";
				
				$strSLSQL = "slEarned = '$intSLEarned', slAbsUndWPay = '$intSLAbsUndWP', 
							slPreBalance = '$intSlPreBalance', slBalance = '$intSLBalance', 
							slAbsUndWoPay = '$intSLAbsUndWOP' ";
				
				$strSQL1 = "UPDATE tblEmpLeaveBalance 
							SET ";
				$strSQL2 = " WHERE empNumber = '$strEmpNmbr' 
								AND periodMonth = '$t_intMonth'	
								AND periodYear = '$t_intYear'";

				mysql_query($strSQL1.$strVLSQL.$strSLSQL.$strSQL2);			
 			}   //end of else
		}   //end of while
	}

//---------------------------------------- get monetize leave --------------------------------------
	function getMonetize($t_intMonth, $t_intYear, $t_strEmpNmbr, $t_strLeave)
	{
		$objMonetize = mysql_query("SELECT vlMonetize, slMonetize 
										FROM tblEmpMonetization
										WHERE empNumber = '$t_strEmpNmbr'
											AND monetizeMonth = '$t_intMonth'
											AND monetizeYear = '$t_intYear'");
		if(mysql_num_rows($objMonetize) == 0)
		{
			return 0;
		}
		else
		{
			$arrMonetize = mysql_fetch_array($objMonetize);
			if ($t_strLeave == VACLEAVE)
			{
				return $arrMonetize["vlMonetize"];
			}
			elseif ($t_strLeave == SICKLEAVE)
			{
				return $arrMonetize["slMonetize"];
			}
		}
	}
//---------------------------------- get Leave Blance stat date ------------------------------------	
	function getLBMonthYear($t_strEmpNmbr)
	{
		$dtmLngvty = $this->getEmpLngvty($t_strEmpNmbr);   //longevity
				
		$objDateLB = mysql_query("SELECT lbStartMonth, lbStartYear FROM tblAgency");
		$arrDateLB = mysql_fetch_array($objDateLB);

		$intStartLBDay = $this->lastDayOfMonthYear($arrDateLB['lbStartYear'], $arrDateLB['lbStartMonth']);
		$dtmStartLBDate = $this->combineDate($arrDateLB['lbStartYear'], $arrDateLB['lbStartMonth'], $intStartLBDay);
		
		if($dtmLngvty > $dtmStartLBDate)
		{   //less than the Leave Balance Start date
			$intStartLBMonth = epochDate('n', $dtmLngvty); 
			$intStartLBYear = epochDate('Y', $dtmLngvty);
			$arrDateLB = array("lbStartMonth"=>$intStartLBMonth, "lbStartYear"=>$intStartLBYear);
		}
		return $arrDateLB;
	}

	function getLastRcrdFrmLeaveBlnc()
	{
		$objLastLB = mysql_query("SELECT periodMonth, periodYear 
									FROM tblEmpLeaveBalance
									ORDER BY periodYear desc, periodMonth desc");
		if(mysql_num_rows($objLastLB))
		{
			$arrLastLB = mysql_fetch_array($objLastLB);
		}
		else
		{
			$arrLastLB = array("periodMonth"=>0, "periodYear"=>0);
		}
		return $arrLastLB;
	}
	
	function getEmpLBFirstEntry($t_strEmpNmbr)
	{
		$objEmpLB = mysql_query("SELECT * FROM tblEmpLeaveBalance
									WHERE empNumber='$t_strEmpNmbr'
									ORDER BY periodYear, periodMonth");
		if(mysql_num_rows($objEmpLB))
		{
			$arrEmpLB = mysql_fetch_array($objEmpLB);
		}
		
		return $arrEmpLB;
	}
	
	function viewEmpLB($t_strEmpNmbr, $t_strLeaveCode)
	{
		$objEmpLB = mysql_query("SELECT * FROM tblEmpLeaveBalance
									WHERE empNumber='$t_strEmpNmbr'
									ORDER BY periodYear, periodMonth");
		if(mysql_num_rows($objEmpLB))
		{
			$strSL = "";
			$strVL = "";
			while($arrEmpLB = mysql_fetch_array($objEmpLB))
			{
				$strLBMonth = $this->intToMonthName($arrEmpLB["periodMonth"]);
				
				$strSL = $strSL."<tr bgcolor='#80bfff' class='paragraph'>";
				$strSL = $strSL."<td bgcolor='#80bfff'>".$strLBMonth." ".$arrEmpLB["periodYear"]."</td>";
				$strSL = $strSL."<td bgcolor='#80bfff'>".$arrEmpLB["slEarned"]."</td>";
				$strSL = $strSL."<td bgcolor='#80bfff'>".$arrEmpLB["slAbsUndWPay"]."</td>";
				$strSL = $strSL."<td bgcolor='#80bfff'>".$arrEmpLB["slBalance"]."</td>";
				$strSL = $strSL."<td bgcolor='#80bfff'>".$arrEmpLB["slPreBalance"]."</td>";
				$strSL = $strSL."<td bgcolor='#80bfff'>".$arrEmpLB["slAbsUndWoPay"]."</td>";
				$strSL = $strSL."</tr>";
				
				$strVL = $strVL."<tr bgcolor='#80bfff' class='paragraph'>";
				$strVL = $strVL."<td bgcolor='#80bfff'>".$strLBMonth." ".$arrEmpLB["periodYear"]."</td>";
				$strVL = $strVL."<td bgcolor='#80bfff'>".$arrEmpLB["vlEarned"]."</td>";
				$strVL = $strVL."<td bgcolor='#80bfff'>".$arrEmpLB["vlAbsUndWPay"]."</td>";
				$strVL = $strVL."<td bgcolor='#80bfff'>".$arrEmpLB["vlBalance"]."</td>";
				$strVL = $strVL."<td bgcolor='#80bfff'>".$arrEmpLB["vlPreBalance"]."</td>";
				$strVL = $strVL."<td bgcolor='#80bfff'>".$arrEmpLB["vlAbsUndWoPay"]."</td>";
				$strVL = $strVL."</tr>";				
			}
			
			if($t_strLeaveCode == 'SL')
			{
				return $strSL;
			}
			elseif($t_strLeaveCode == 'VL')
			{
				return $strVL;
			}
		}
	}
	
	function computeAbsUndWPWOP($t_intBalance, $t_intAbsUnd)
	{
		if($t_intBalance < $t_intAbsUnd)
		{
			$intResult = $t_intAbsUnd - $t_intBalance;
			
			$intResultInteger = intval($intResult);
			
			if($intResultInteger < $intResult)
			{
				$intAbsUndWOP = intval($intResult) + 1;
			}
			elseif($intResultInteger == $intResult)
			{
				$intAbsUndWOP = $intResult;
			}
			
			$intAbsUndWP = $t_intAbsUnd - $intAbsUndWOP;
		}
		elseif($t_intBalance >= $t_intAbsUnd)
		{
			$intAbsUndWP = $t_intAbsUnd;
			$intAbsUndWOP = 0;
		}
		
		$intBalance = $t_intBalance - $intAbsUndWP;
		
		$arrLB = array("Balance"=>$intBalance, "AbsUndWP"=>$intAbsUndWP, "AbsUndWOP"=>$intAbsUndWOP);
		return $arrLB;
	}
	
	function lessSLAbsUndWOPToVLBlnc($t_intVLBalance, $t_intSLAbsUndWOP, $t_intVLAbsUndWP)
	{   //eg: VLBalance: 4.500 SLAbsUndWOP: 3 VLBalance: 1.500 SLAbsUndWOP: 3 
		if($t_intSLAbsUndWOP <= $t_intVLBalance) 
		{   //eg: VLBalance: 4.500 SLAbsUndWOP: 3
			$intVLBalance = $t_intVLBalance - $t_intSLAbsUndWOP;   // balance = 4.500 - 3
			$intVLAbsUndWP = $t_intVLAbsUndWP + $t_intSLAbsUndWOP;    //(VLWP) 6 = (VLWP) 3 + (SLWOP) 3
			$intSLAbsUndWOP = 0;   //SLWOP: 0
		}
		elseif($t_intVLBalance >= 1)
		{   //VLBalance: 1.500 SLAbsUndWOP: 3
			$intSLAbsUndWOP = $t_intSLAbsUndWOP - intval($t_intVLBalance);   // (SLWOP)2 = 3 - 1
			$intVLBalance = $t_intSLAbsUndWOP - $intSLAbsUndWOP;   //(VLBalance) 1 = 3 - 2
			$intVLAbsUndWP = $t_intVLAbsUndWP + $intVLBalance;   //(VLWP) 4 = (VLWP) 3 + 1
			$intVLBalance = $t_intVLBalance - $intVLBalance; //VLBalance(.500) = 1.500 - 1;
		}
		else
		{
			$intVLBalance = $t_intVLBalance;
			$intSLAbsUndWOP = $t_intSLAbsUndWOP;
			$intVLAbsUndWP = $t_intVLAbsUndWP;
		}
		$arrSLWOPToVLBlnc = array("VLBalance"=>$intVLBalance, "SLAbsUndWOP"=>$intSLAbsUndWOP, "VLAbsUndWP"=>$intVLAbsUndWP);
		return $arrSLWOPToVLBlnc;
	}

	function getNextMonth($t_intMonth, $t_intYear)
	{
		if($t_intMonth < 12)
		{
			$intNxtMonth = $t_intMonth + 1;
			$intNxtYear = $t_intYear;
		}
		elseif($t_intMonth == 12)
		{
			$intNxtMonth = 1;
			$intNxtYear = $t_intYear + 1;
		}
		$arrNxtMonth = array("month"=>$intNxtMonth, "year"=>$intNxtYear);
		return $arrNxtMonth;
	}
	
	function viewAllRecentLeaveBalance($t_intPage, $t_intCurrPage)
	{
		$arrLastLB = $this->getLastRcrdFrmLeaveBlnc();
		$intMonth = $arrLastLB['periodMonth'];
		$intYear = $arrLastLB['periodYear'];
		
		$strSQL = "SELECT tblEmpLeaveBalance.*, tblEmpPersonal.surname, tblEmpPersonal.firstname
									FROM tblEmpLeaveBalance 
									INNER JOIN tblEmpPersonal
										ON tblEmpLeaveBalance.empNumber = tblEmpPersonal.empNumber	
									WHERE tblEmpLeaveBalance.periodMonth = '$intMonth'
										AND tblEmpLeaveBalance.periodYear = '$intYear'
									ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";

		$objAllLB = mysql_query($strSQL);
		$intTotalRecord = mysql_num_rows($objAllLB);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objAllLB = mysql_query($strSQL);
		
		if(mysql_num_rows($objAllLB))
		{
			while($arrAllLB = mysql_fetch_array($objAllLB))
			{
				echo "<tr bgcolor='#80bfff'>";
				echo "<td>".$arrAllLB['surname'].", ".$arrAllLB['firstname']."</td>";
				echo "<td class='paragraph'>".$arrAllLB['vlEarned']."</td>";				
				echo "<td class='paragraph'>".$arrAllLB['vlAbsUndWPay']."</td>";
				echo "<td class='paragraph'>".$arrAllLB['vlBalance']."</td>";
				echo "<td class='paragraph'>".$arrAllLB['vlAbsUndWoPay']."</td>";
				echo "<td class='paragraph'>".$arrAllLB['slAbsUndWPay']."</td>";
				echo "<td class='paragraph'>".$arrAllLB['slBalance']."</td>";
				echo "<td class='paragraph'>".$arrAllLB['slAbsUndWoPay']."</td>";																				
				echo "</tr>";
			}
		}
		
	}
//----------------------------------- Particulars on Leave Balance -------------------------------------
	
	function particulars($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_strOthInfo, $t_intVLWP, $t_intSLWP, $t_intUndWP)
	{
		$dtmDTRDate = $this->combineMonthYear($t_intYear, $t_intMonth);
		
		$objDTR = mysql_query("SELECT * FROM tblEmpDTR 
								WHERE dtrDate LIKE '$dtmDTRDate%' 
									AND empNumber = '$t_strEmpNmbr'
									AND otherInfo = '$t_strOthInfo'
									AND (remarks = '".VACLEAVE."' OR remarks = '".SICKLEAVE."' 
											OR remarks = '".FORCELEAVE."' OR remarks = '".HVACLEAVE."' 
											OR remarks = '".HSICKLEAVE."' OR remarks = '".HFORCELEAVE."')
								ORDER BY dtrDate");
								
		$intDTR = mysql_num_rows($objDTR);
		if($intDTR != 0)
		{
			$strVlAbsUndWOP = 0;
			$strVlAbsUndWP = 0;
			$strSlAbsUndWOP = 0;
			$strSlAbsUndWP = 0;

			$intFlag = 0;
			while($arrDTR = mysql_fetch_array($objDTR))
			{
				if($intFlag == 0)
				{
					$intDayStart = date("d", strtotime($arrDTR["dtrDate"]));
					$strRemarks = $arrDTR["remarks"];
					$intFlag = 1;
				}
				else
				{
					$intDayEnd = date("d", strtotime($arrDTR["dtrDate"]));
				}
			}
			
			if(strlen($intDayEnd) == 0)
			{
				$strDay = $intDayStart;
			}
			else
			{
				$strDay = $intDayStart."-".$intDayEnd;
			}
			
			if($strRemarks == SICKLEAVE || $strRemarks == HSICKLEAVE)
			{
				if($strRemarks == HSICKLEAVE)
				{
					$intDTR = $intDTR * 0.5;
				}
				$intPrtclr = 1;				
				$strParticular = "$intDTR($strRemarks) ".$strDay;
				
				$arrPrtclrWPWOP = $this->particularWPWOP($t_intSLWP, $intDTR);
				
				$strSlAbsUndWP = $arrPrtclrWPWOP["WP"];
				$strSlAbsUndWOP = $arrPrtclrWPWOP["WOP"];
			}
			elseif($strRemarks == VACLEAVE || $strRemarks == FORCELEAVE || $strRemarks == HVACLEAVE || $strRemarks == HFORCELEAVE)
			{
				if($strRemarks == HVACLEAVE || $strRemarks == HFORCELEAVE)
				{
					$intDTR = $intDTR * 0.5;
				} 
				$intPrtclr = 1;			
				$strParticular = "$intDTR($strRemarks) ".$strDay;
				
				$arrPrtclrWPWOP = $this->particularWPWOP($t_intVLWP, $intDTR, $t_intUndWP);

				$strVlAbsUndWP = $arrPrtclrWPWOP["WP"];
				$strVlAbsUndWOP = $arrPrtclrWPWOP["WOP"];
			}
			else
			{
				$intPrtclr = 0;
			}

			if($intPrtclr)
			{
				$arrPrtclr = array("particular"=>$strParticular, "vlAbsUndWP"=>$strVlAbsUndWP, "vlAbsUndWOP"=>$strVlAbsUndWOP, "slAbsUndWP"=>$strSlAbsUndWP, "slAbsUndWOP"=>$strSlAbsUndWOP);
			}
			else
			{
				$arrPrtclr = array();
			}
		}
		else
		{
			$arrPrtclr = array();
		}
		return $arrPrtclr;
	}
	
	function particularWPWOP($t_intWP, $t_intAbs='0', $t_intUnd='0')
	{	/* distributing points from withpay and without pay*/
		$intAbsWOP = 0;
		$intAbsWP = 0;
		
		$intUndWP = $t_intWP - $t_intUnd;
		
		if(number_format($intUndWP) >= number_format($t_intAbs))   //find the rounding decimal functions
		{
			$intAbsWP = $t_intAbs;
		}
		elseif($t_intWP == 0)
		{
			$intAbsWOP = $t_intAbs;
		}
		else
		{	
			$intResult = $t_intAbs - $intUndWP;

			$intResultInteger = intval($intResult);
			
			if($intResultInteger < $intResult)
			{
				$intAbsWOP = intval($intResult) + 1;
			}
			elseif($intResultInteger == $intResult)
			{
				$intAbsWOP = $intResult;
			}
			
			if($t_intAbs > 0)
			{
				$intAbsWP = $t_intAbs - $intAbsWOP;
			}
		}
		
		$arrAbsPrtclr = array("WP"=>$intAbsWP, "WOP"=>$intAbsWOP);
		return $arrAbsPrtclr;
	}
//----------------------------------------- Approved For in Application Leave Form -------------------------
	function ApprovedFor($t_strEmpNmbr, $t_dtmLeave)
	{   /* This function is for the selection of approved for in the Application Leave form*/
		
		$intMonth = date("m", strtotime($t_dtmLeave));
		$intYear = date("Y", strtotime($t_dtmLeave));
		
		$objLB = mysql_query("SELECT * FROM tblEmpLeaveBalance 
								WHERE periodMonth='$intMonth' 
									AND periodYear='$intYear'
									AND empNumber='$t_strEmpNmbr'");   //check if the month exist in tblEmpLeaveBalance
		
		if(mysql_num_rows($objLB))
		{
			$arrEmpLB = mysql_fetch_array($objLB);
			//get the otherInfo, check how many days filed in one application leave form
			$objOth = mysql_query("SELECT otherInfo FROM tblEmpDTR
										WHERE dtrDate = '$t_dtmLeave' 
										AND empNumber = '$t_strEmpNmbr'");
			$arrOthInfo	= mysql_fetch_array($objOth);
			
			//get the undertime
			$intUnd = $this->getMonthAbsUnd($arrEmpLB["periodMonth"], $arrEmpLB["periodYear"], $t_strEmpNmbr, 0, 0);
			
			if($intUnd != 0)
			{
				$arrPrtclrWPWOP = $this->particularWPWOP($arrEmpLB["vlAbsUndWPay"], $intAbs, $intUnd);
			}

			$arrPrtclr = $this->particulars($t_strEmpNmbr, $arrEmpLB["periodMonth"], $arrEmpLB["periodYear"], $arrOthInfo["otherInfo"], $arrEmpLB["vlAbsUndWPay"], $arrEmpLB["slAbsUndWPay"], $arrPrtclrWPWOP["WP"]);
			
			if($arrPrtclr["vlAbsUndWP"] > 0 || $arrPrtclr["slAbsUndWP"] > 0)
			{
				return "WP";
			}
			elseif($arrPrtclr["vlAbsUndWOP"] > 0 || $arrPrtclr["slAbsUndWOP"] > 0)
			{
				return "WOP";
			}
			else
			{
				return "OTH";
			}
		}
	}
	
//----------------------------------------------------------------------------------------------------------
}
?>