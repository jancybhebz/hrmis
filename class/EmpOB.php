<?php 
/* 
File Name: EmpOB.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employee's official business.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco, Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: May 31, 2004
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
class OB extends General
{

	function ob() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function addEmpOB($t_strEmpNumber, $t_strRequestCode, $t_strOBRequest, $t_dtmOBDateFromMonth, $t_dtmOBDateFromDay, $t_dtmOBDateFromYear, $t_dtmOBDateToMonth, $t_dtmOBDateToDay, $t_dtmOBDateToYear, $t_dtmTimeFromHrs, $t_dtmTimeFromMin, $t_dtmTimeFromSec, $t_dtmTimeToHrs, $t_dtmTimeToMin, $t_dtmTimeToSec, $t_strOBPlace, $t_strOBPurpose, $t_dtmTimeFromAMPM, $t_dtmTimeToAMPM, $t_strRequestStatus)   //Edit employee OB
   	{
		 $dtmDateNow = date("Y-m-d");
		 $t_strRequestCode = "OB";	 
		 $t_strRequestStatus = "Filed Request"; 
		 $t_dtmOBDateFrom = $this->combineDate($t_dtmOBDateFromYear, $t_dtmOBDateFromMonth, $t_dtmOBDateFromDay);
		 $t_dtmOBDateTo = $this->combineDate($t_dtmOBDateToYear, $t_dtmOBDateToMonth, $t_dtmOBDateToDay);
		 $t_dtmTimeFrom = $this->combineHrMnSc($t_dtmTimeFromHrs, $t_dtmTimeFromMin, $t_dtmTimeFromSec);
		 $t_dtmTimeFrom = $this->combineTime($t_dtmTimeFrom, $t_dtmTimeFromAMPM);
		 $t_dtmTimeTo = $this->combineHrMnSc($t_dtmTimeToHrs, $t_dtmTimeToMin, $t_dtmTimeToSec);
		 $t_dtmTimeTo = $this->combineTime($t_dtmTimeTo, $t_dtmTimeToAMPM);
		 
		 $t_strRequestDetails = "$t_strOBRequest;"."$t_dtmOBDateFrom;"."$t_dtmOBDateTo;"."$t_dtmTimeFrom;"."$t_dtmTimeTo;"."$t_strOBPlace;"."$t_strOBPurpose;";
		 $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDate, requestDetails, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strRequestCode', '$dtmDateNow', '$t_strRequestDetails', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
		 if(!$results) 
		 { 
			echo "<b>Employee Personal Data not added:</b> ", mysql_error(); 
			exit; 
		 } 
		 if($results) 
		 { 
			return 1; 
		 } 
	}	

}
?>