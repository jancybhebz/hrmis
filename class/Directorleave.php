<?php 
/* 
File Name: Directorleave.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employee's official business.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: February 04, 2004
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
class DirectorLeave extends AttendanceUndertime
{

	function directorLeave() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function addRequest($t_strEmpNumber, $t_strLeaveType, $t_strRequestCode, $t_strRequestStatus, $t_strType, $t_dtmFromMonth, $t_dtmFromDay, $t_dtmFromYear, $t_dtmToMonth, $t_dtmToDay, $t_dtmToYear, $t_strReason, $t_dtmStatusDate)   //Add employee privilege leave request
   	{
		 $t_dtmFrom = $this->combineDate($t_dtmFromYear, $t_dtmFromMonth, $t_dtmFromDay);
		 $t_dtmTo = $this->combineDate($t_dtmToYear, $t_dtmToMonth, $t_dtmToDay);
		 $t_strRequestDetails = "$t_strLeaveType;"."$t_strType;"."$t_dtmFrom;"."$t_dtmTo;"."$t_strReason;";
		 $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestStatus, requestDetails, statusDate) VALUES  ('$t_strEmpNumber', '$t_strRequestCode', '$t_strRequestStatus', '$t_strRequestDetails', '$t_dtmStatusDate')";
		 mysql_query($results) or die (mysql_error());
		 if(!$results) 
		 { 
			echo "<b>Director privilege leave request not added:</b> ", mysql_error(); 
			exit; 
		 } 
		 if($results) 
		 { 
			return 1; 
		 } 
	}		
}
?>