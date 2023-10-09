<?
/* 
File Name: AttendanceTime.php 
----------------------------------------------------------------------
Purpose of this file: 
Claa attendance time
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

require("../hrmis/class/AttendanceDTR.php");
class AttendanceTime extends AttendanceDTR
{
//--------------------------------- override time ----------------------------------------------------------------
	function dtrTime($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_intDay, $t_strInAM, $t_strOutAM, $t_strInPM, $t_strOutPM, $t_strInOT, $t_strOutOT)
	{    //finds the YYYY-MM-DD if exist if yes update SQL else insert SQL
		$strDate = $this->combineDate($t_intYear, $t_intMonth, $t_intDay); 
		$objDay = mysql_query("SELECT * FROM tblEmpDTR 
								WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$strDate'");
	
		if(!mysql_num_rows($objDay))
		{
			mysql_query("INSERT INTO tblEmpDTR (empNumber, inAM, outAM, inPM, outPM, inOT, outOT, dtrDate, remarks)
						VALUES ('$t_strEmpNmbr', '$t_strInAM', '$t_strOutAM', 
								'$t_strInPM', '$t_strOutPM', '$t_strInOT', 
								'$t_strOutOT', '$strDate', '')");		
		}
		else
		{
			mysql_query("UPDATE tblEmpDTR SET inAM = '$t_strInAM', outAM = '$t_strOutAM',
							inPM = '$t_strInPM', outPM = '$t_strOutPM',  
							inOT = '$t_strInOT', outOT = '$t_strOutOT',
							remarks = ''  							
						WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$strDate'");		
		}
	}
	
	function overrideTime($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_arrDay, $t_strInAM, $t_strOutAM, $t_strInPM, $t_strOutPM, $t_strInOT, $t_strOutOT)
	{    //overrieds time in override.php
		if(count($_SESSION['arrDay']) != 0)
		{
			foreach($_SESSION['arrDay'] as $intDay=>$value)
			{	
				$this->dtrTime($t_strEmpNmbr, $t_intMonth, $t_intYear, $intDay, $t_strInAM, $t_strOutAM, $t_strInPM, $t_strOutPM, $t_strInOT, $t_strOutOT);
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


		$this->updateEmpOB($t_strEmpNmbr, $t_intYear, $t_intMonth, $_SESSION['arrDay']);
//		$this->removeUnusedOBRecord();
		
		$this->updateEmpLeave($t_strEmpNmbr, $t_intYear, $t_intMonth, $_SESSION['arrDay']);
//		$this->removeUnusedLeaveRecord();	
				
		$strPage = "DTR.php?a=a".$this->varstr;
		header("Location: $strPage");				
	}
	
}
?>