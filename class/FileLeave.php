<?
/* 
File Name: FileLeave.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To view the employees filed leave, ob, travel order, etc.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
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
require_once("../hrmis/class/General.php");
class FileLeave extends General
{
	function checkEmpDay($t_intNewID, $t_strEmpNmbr, $t_dtmDateFrom, $t_dtmDateTo, $t_strLeaveCode)
	{
		$blnExclude = $this->checkExcludedEmp($t_strEmpNmbr);

		if($blnExclude)
		{		
			$t_intDayFrom = date("j", strtotime($t_dtmDateFrom));
			$t_intDayTo = date("j", strtotime($t_dtmDateTo));
			$t_intYearFrom = date("Y", strtotime($t_dtmDateFrom));
			$t_intMonthFrom = date("n", strtotime($t_dtmDateFrom));
			
			for($intCounter = $t_intDayFrom; $intCounter <= $t_intDayTo; $intCounter++)
			{
				$strDate = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $intCounter);				
				
				$strDayName = date('l', strtotime($strDate));
				
				if($strDayName != "Sunday" && $strDayName != "Saturday")
				{

					$objDay = mysql_query("SELECT * FROM tblEmpDTR 
											WHERE empNumber = '$t_strEmpNmbr' 
												AND dtrDate = '$strDate'");
					$intCntRow = mysql_num_rows($objDay);
					$strSql = $this->sqlLeaveDTR($t_intNewID, $intCntRow, $t_strEmpNmbr, $strDate, $t_strLeaveCode);					
					mysql_query($strSql);
				}
			}
		}		
	}
	
	function sqlLeaveDTR($t_intNewID, $t_intCntRow, $t_strEmpNmbr, $t_strDate, $t_strLeaveCode)
	{
		if($t_intCntRow == 0)
		{			
			return "INSERT INTO tblEmpDTR (empNumber, inAM, outAM, inPM, outPM, inOT, outOT, dtrDate, remarks, otherInfo)
					VALUES ('$t_strEmpNmbr', '', '', '', '', '', '', '$t_strDate', '$t_strLeaveCode', '$t_intNewID')";		
		}
		else
		{		
			return "UPDATE tblEmpDTR SET remarks = '$t_strLeaveCode', inAM = '', outAM = '',
						inPM = '', outPM = '', inOT = '', outOT ='', otherInfo='$t_intNewID'
						WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$t_strDate'";		
		}
	}
	
	function checkExcludedEmp($t_strEmpNmbr)
	{
		$objEmpExclude = mysql_query("SELECT dtrSwitch FROM tblEmpPosition 
										WHERE empNumber='$t_strEmpNmbr'");
										
		$arrEmpExclude = mysql_fetch_array($objEmpExclude);
		
		if($arrEmpExclude['dtrSwitch'] == 'Y')
		{
			return 1;
		}
		elseif($arrEmpExclude['dtrSwitch'] == 'N')
		{
			return 0;
		}
	}
}
?>