<?php 
/* 
File Name: EmpTrvlOrdr.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employee's travel order.
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
require("../hrmis/class/General.php");
class EmpTrvlOrdr extends General
{

	function empTrvlOrdr() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}

	function addRequest($t_strEmpNumber, $t_strRequestCode, $t_strDest, $t_intYearFrom, $t_intMonthFrom, $t_intDayFrom, $t_intYearTo, $t_intMonthTo, $t_intDayTo, $t_strPurpose, $t_strFund, $t_strTranspo, $t_blnPerdiem, $t_strRequestStatus)   //Add employee privilege leave request
   	{
		 $dtmDateNow = date("Y-m-d");
		 $t_dtmFrom = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $t_intDayFrom);
		 $t_dtmTo = $this->combineDate($t_intYearTo, $t_intMonthTo, $t_intDayTo);
		 $t_strRequestDetails = "$t_strDest;$t_dtmFrom;$t_dtmTo;$t_strPurpose;$t_strFund;$t_strTranspo;$t_blnPerdiem;";
		 $results = "INSERT INTO tblEmpRequest 
		 				(empNumber, requestCode, requestDate, requestDetails, requestStatus) 
					VALUES  ('$t_strEmpNumber', '$t_strRequestCode', '$dtmDateNow', '$t_strRequestDetails', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
		 if(!$results) 
		 { 
			echo "<b>Employee travel order request not added:</b> ", mysql_error(); 
			exit; 
		 } 
		 if($results) 
		 { 
			return 1; 
		 } 
	}		
}
?>