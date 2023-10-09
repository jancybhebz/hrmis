<?
/* 
File Name: AttendanceFC.php 
----------------------------------------------------------------------
Purpose of this file: 
Class attendance of flag ceremony
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

require("../hrmis/class/AttendanceOB.php");
class AttendanceFC extends AttendanceOB
{
//----------------------------- override flag ceremony ----------------------------------------------
	function flagCeremony($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_intDay)
	{  //checks if the YYYY-MM-DD selected is present in your tblEmpDTR
		$strDate = $this->combineDate($t_intYear, $t_intMonth, $t_intDay);
		
		$objDay = mysql_query("SELECT * FROM tblEmpDTR 
								WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$strDate'");
		
		$strSql = $this->sqlFlagCrmny($objDay, $t_strEmpNmbr, $strDate);
		mysql_query($strSql);	
	}
	
	function overrideFlagCrmny($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_arrDay)
	{   //overrides FC in Override.php
		if(count($t_arrDay) != 0)
		{
			foreach($t_arrDay as $intDay=>$value)
			{
				$this->flagCeremony($t_strEmpNmbr, $t_intMonth, $t_intYear, $intDay);
			}
		}
		$arrLastLB = $this->getLastRcrdFrmLeaveBlnc();
	
		if($arrLastLB['periodMonth'] == $t_intMonth && $arrLastLB['periodYear'] == $t_intYear)
		{
			$this->updateLeaveBalance($t_intMonth, $t_intYear, $t_strEmpNmbr);   //update the leave balance 
		}
		elseif ($arrLastLB['periodMonth'] > $t_intMonth && $arrLastLB['periodYear'] >= $t_intYear)
		{
			$objLB = mysql_query("SELECT * FROM tblEmpLeaveBalance WHERE empNumber='$t_strEmpNmbr' ORDER BY periodYear, periodMonth");
			$arrLB = mysql_fetch_array($objLB);
			$this->addEmpLeaveBalance($t_strEmpNmbr, $arrLB["periodYear"], $arrLB["periodMonth"], $arrLB["vlEarned"], $arrLB["vlBalance"], $arrLB["vlAbsUndWPay"], $arrLB["vlAbsUndWoPay"], $arrLB["slBalance"], $arrLB["slAbsUndWPay"], $arrLB["slAbsUndWoPay"]);
		}

		$strPage = "DTR.php?a=a".$this->varstr;
		header("Location: $strPage");		
	}
	
	function sqlFlagCrmny($t_objDay, $t_strEmpNmbr, $t_strDate)
	{   //if the YYYY-MM-DD is present in tblEmpDTR, update SQL is executed else insert SQL
		if(!mysql_num_rows($t_objDay))
		{
			return "INSERT INTO tblEmpDTR (empNumber, inAM, dtrDate, remarks)
							VALUES ('$t_strEmpNmbr', '".FLAGCRMNY."', '$t_strDate', '".FLAG_CEREMONY."')";				
		}
		else
		{
			$arrEmpDTR = mysql_fetch_array($t_objDay);
			if($arrEmpDTR['inAM'] > FLAGCRMNY || $arrEmpDTR['inAM'] == NULLTIME)
			{
				return "UPDATE tblEmpDTR SET inAM = '".FLAGCRMNY."', remarks = '".FLAG_CEREMONY."' 
						WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$t_strDate'";
			}
		}
	}
//----------------------------- override many employee Flag Ceremony -----------------------------------	
	function setEmpFlagCeremony($t_intMonth, $t_intDay, $t_intYear, $t_arrEmpNmbr) //sa maramihang flag ceremeony
	{
		$intCntEmpNmbr = count($t_arrEmpNmbr);
		
		if($intCntEmpNmbr != 0)
		{
			foreach($t_arrEmpNmbr as $key=>$strEmpNmbr)   //get nya from chkbox ng mga employees 
			{
				$this->flagCeremony($strEmpNmbr, $t_intMonth, $t_intYear, $t_intDay);
			}
	
			$arrLastLB = $this->getLastRcrdFrmLeaveBlnc();
			if($arrLastLB['periodMonth'] == $t_intMonth && $arrLastLB['periodYear'] == $t_intYear)
			{
				$this->updateLeaveBalance($t_intMonth, $t_intYear);
			}
			$dtmConfirmDate = $this->combineDate($t_intYear, $t_intMonth, $t_intDay);
			$strConfirmDate = date("jS of F, Y", strtotime($dtmConfirmDate));
			return "The selected employees are considered &quot;in&quot; at exactly 8 o'clock in the morning on the $strConfirmDate";
		}
	}

	function editPrvFC()   //edits the recent flag ceremony
	{
		$objFC = mysql_query("SELECT dtrDate FROM tblEmpDTR  
								WHERE remarks = '".FLAG_CEREMONY."' 
								ORDER BY dtrDate desc");   //retrieve lahat ng FC
		if(mysql_num_rows($objFC))   //para kunin lng ang latest 
		{   //DTR date ng FC
			$arrFC = mysql_fetch_array($objFC);
			$dtmFCDate = $arrFC["dtrDate"];   //ng nakuha na ung latest FC
			$objPrvFC = mysql_query("SELECT empNumber
									FROM tblEmpDTR
									WHERE remarks = '".FLAG_CEREMONY."' 
										AND dtrDate='$dtmFCDate'");   //query ulit using the latest dtrDate

			$_SESSION['arrayEmpNmbr'] = array();   //emptying the array
			
			while($arrPrvFC = mysql_fetch_array($objPrvFC))   //lagyan ng laman ung array
			{
				$arrEmpNumber = array($arrPrvFC['empNumber']=>$arrPrvFC['empNumber']);
				
				$intArrElmt = count($_SESSION['arrayEmpNmbr']);   //check if the session array
				//has a value
				if($intArrElmt == 0)   //if no value
				{
					$_SESSION['arrayEmpNmbr'] = $arrEmpNumber;   //put the new value
				}
				else   //else
				{   //merge the existing from the new
					$_SESSION['arrayEmpNmbr'] = array_merge($_SESSION['arrayEmpNmbr'], $arrEmpNumber);
				}
			}
		}
		return $dtmFCDate;
	}
	
	function getEmpFC($t_strEmpNmbr, $t_intMonth, $t_intYear)
	{
		$t_dtmMnthYr = $this->combineMonthYear($t_intYear, $t_intMonth);
		$objEmpFC = mysql_query("SELECT remarks FROM tblEmpDTR 
									WHERE dtrDate LIKE '$t_dtmMnthYr%' 
										AND empNumber = '$t_strEmpNmbr'
										AND remarks = 'FC'");
		return mysql_num_rows($objEmpFC);
	}
}
?>