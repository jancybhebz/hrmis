<?php 
/* 
File Name: Chiefservicerecords.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employee's personal data.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: December 19, 2003
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
class Service extends General
{

	function service() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   	
	function addServiceRecords($t_strEmpNumber, $t_dtmServiceFromMonth, $t_dtmServiceFromDay, $t_dtmServiceFromYear, $t_dtmServiceToMonth, $t_dtmServiceToDay, $t_dtmServiceToYear, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_intLeaveWoPay, $t_strBranch, $t_strSeparationCause, $t_dtmSeparationMonth, $t_dtmSeparationDay, $t_dtmSeparationYear, $Submit)   //Load add service records information function
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmServiceFromDate = $this->combineDate($t_dtmServiceFromYear, $t_dtmServiceFromMonth, $t_dtmServiceFromDay);
 		 $t_dtmServiceToDate = $this->combineDate($t_dtmServiceToYear, $t_dtmServiceToMonth, $t_dtmServiceToDay);
 		 $t_dtmSeparationDate = $this->combineDate($t_dtmSeparationYear, $t_dtmSeparationMonth, $t_dtmSeparationDay);
	     $results = "INSERT INTO tblServiceRecord (empNumber, serviceFromDate, serviceToDate, positionCode, appointmentCode, stationAgency, salary, leaveWoPay, branch, separationCause, separationDate) VALUES ('$t_strEmpNumber', '$t_dtmServiceFromDate', '$t_dtmServiceToDate', '$t_strPositionCode', '$t_strAppointmentCode', '$t_strStationAgency', '$t_intSalary', '$t_intLeaveWoPay', '$t_strBranch', '$t_strSeparationCause', '$t_dtmSeparationDate')";
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
	
		function editServiceRecords($t_dtmServiceFromMonth, $t_dtmServiceFromDay, $t_dtmServiceFromYear, $t_dtmServiceToMonth, $t_dtmServiceToDay, $t_dtmServiceToYear, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_intLeaveWoPay, $t_strBranch, $t_strSeparationCause, $t_dtmSeparationMonth, $t_dtmSeparationDay, $t_dtmSeparationYear, $Submit, $t_strEmpNumber, $t_dtmOldServiceFromMonth, $t_dtmOldServiceFromDay, $t_dtmOldServiceFromYear, $t_dtmOldServiceToMonth, $t_dtmOldServiceToDay, $t_dtmOldServiceToYear, $t_strOldPositionCode, $t_dtmOldSeparationMonth, $t_dtmOldSeparationDay, $t_dtmOldSeparationYear, $t_strOldSeparationCause) //edit employee service records
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblServiceRecord WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {	     
		    do 
			{
		     $t_strEmpNumber=$row['empNumber'];
			 $t_dtmServiceFromDate=$row['serviceFromDate'];
			 $t_dtmServiceToDate=$row['serviceToDate'];
			 $t_strPositionCode=$row['positionCode'];
			 $t_strAppointmentCode=$row['appointmentCode'];
			 $t_strStationAgency=$row['stationAgency'];
			 $t_intSalary=$row['salary'];
			 $t_intLeaveWoPay=$row['leaveWoPay'];
			 $t_strBranch=$row['branch'];
			 $t_strSeparationCause=$row['separationCause'];
			 $t_dtmSeparationDate=$row['separationDate'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){
			 $t_dtmServiceFromDate = $this->combineDate($t_dtmServiceFromYear, $t_dtmServiceFromMonth, $t_dtmServiceFromDay);
			 $t_dtmServiceToDate = $this->combineDate($t_dtmServiceToYear, $t_dtmServiceToMonth, $t_dtmServiceToDay);
 		 	 $t_dtmSeparationDate = $this->combineDate($t_dtmSeparationYear, $t_dtmSeparationMonth, $t_dtmSeparationDay);
			 $updateResults = "UPDATE tblServiceRecord SET empNumber='$t_strEmpNumber', serviceFromDate='$t_dtmServiceFromDate', serviceToDate='$t_dtmServiceToDate', positionCode='$t_strPositionCode', appointmentCode='$t_strAppointmentCode', stationAgency='$t_strStationAgency', salary='$t_intSalary', leaveWoPay='$t_intLeaveWoPay', branch='$t_strBranch', separationCause='$t_strSeparationCause', separationDate='$t_dtmSeparationDate' WHERE positionCode='$t_strOldPositionCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee service records not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
		function deleteServiceRecords($txtSearch, $optField, $p, $t_dtmServiceFromDate, $t_dtmServiceToDate, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_intLeaveWoPay, $t_strBranch, $t_strSeparationCause, $t_dtmSeparationDate, $t_strEmpNumber, $Submit) //delete of service records from database
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblServiceRecord WHERE positionCode='$t_strPositionCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewServiceRecords($txtSearch, $optField, $p, $t_dtmServiceFromDate, $t_dtmServiceToDate, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_intLeaveWoPay, $t_strBranch, $t_strSeparationCause, $t_dtmSeparationDate, $t_strEmpNumber) //View list of service records
    {
	     $viewResults = mysql_query("SELECT * FROM tblServiceRecord WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
		     $t_strEmpNumber=$row['empNumber'];
			 $t_dtmServiceFromDate=$row['serviceFromDate'];
			 $t_dtmServiceToDate=$row['serviceToDate'];
			 $t_strPositionCode=$row['positionCode'];
			 $t_strAppointmentCode=$row['appointmentCode'];
			 $t_strStationAgency=$row['stationAgency'];
			 $t_intSalary=$row['salary'];
			 $t_intLeaveWoPay=$row['leaveWoPay'];
			 $t_strBranch=$row['branch'];
			 $t_strSeparationCause=$row['separationCause'];
			 $t_dtmSeparationDate=$row['separationDate'];
			 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"tblServiceRecord\">";
             echo "<tr><td><table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"title\"><td width=\"26%\" class=\"border\">SERVICE</td>";
             echo "<td width=\"52%\" class=\"border\">RECORD OF APPOINTMENT</td>";
             echo "<td width=\"22%\" class=\"border\">SEPARATION</td></tr></table>";
             echo "<table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"title\"><td width=\"13%\" class=\"border\">From</td>";
             echo "<td width=\"13%\" class=\"border\">To</td>";
			 echo "<td width=\"19%\" class=\"border\">Designation</td>";
             echo "<td width=\"18%\" class=\"border\">Status</td>";
             echo "<td width=\"15%\" class=\"border\">Salary</td>";
			 echo "<td width=\"11%\" class=\"border\">Cause</td>";
             echo "<td width=\"11%\" class=\"border\">Date</td></tr>";
             echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
             echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
             echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
             echo "<td class=\"border\">&nbsp;</td></tr></table>";
			 do 
			 {
		     	$t_strEmpNumber=$row['empNumber'];
			 	$t_dtmServiceFromDate=$row['serviceFromDate'];
			 	$t_dtmServiceToDate=$row['serviceToDate'];
			 	$t_strPositionCode=$row['positionCode'];
			 	$t_strAppointmentCode=$row['appointmentCode'];
			 	$t_strStationAgency=$row['stationAgency'];
			 	$t_intSalary=$row['salary'];
			 	$t_intLeaveWoPay=$row['leaveWoPay'];
			 	$t_strBranch=$row['branch'];
				$t_strSeparationCause=$row['separationCause'];
			 	$t_dtmSeparationDate=$row['separationDate'];
				echo "<table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
                echo "<tr><td width=\"13%\" class=\"border\">" . $row['serviceFromDate'] . "</td>";
                echo "<td width=\"13%\" class=\"border\">" . $row['serviceToDate'] . "</td>";
                echo "<td width=\"19%\" class=\"border\">" . $row['positionCode'] . "</td>";
                echo "<td width=\"18%\" class=\"border\">" . $row['appointmentCode'] . "</td>";
                echo "<td width=\"15%\" class=\"border\">" . $row['salary'] . "</td>";
                echo "<td width=\"11%\" class=\"border\">" . $row['separationCause'] . "</td>";
                //echo "<td width=\"11%\" class=\"border\"><a href=\"Servicerecords.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_dtmServiceFromDate=$t_dtmServiceFromDate&t_dtmServiceToDate=$t_dtmServiceToDate&t_strPositionCode=$t_strPositionCode&t_strAppointmentCode=$t_strAppointmentCode&t_strStationAgency=$t_strStationAgency&t_intSalary=$t_intSalary&t_intLeaveWoPay=$t_intLeaveWoPay&t_strBranch=$t_strBranch&t_strSeparationCause=$t_strSeparationCause&t_dtmSeparationDate=$t_dtmSeparationDate&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
                echo "<td width=\"11%\" class=\"border\">" . $row['separationDate'] . "</td>";
                //echo "<td width=\"11%\" class=\"border\"><a href=\"Servicerecords.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_dtmServiceFromDate=$t_dtmServiceFromDate&t_dtmServiceToDate=$t_dtmServiceToDate&t_strPositionCode=$t_strPositionCode&t_strAppointmentCode=$t_strAppointmentCode&t_strStationAgency=$t_strStationAgency&t_intSalary=$t_intSalary&t_intLeaveWoPay=$t_intLeaveWoPay&t_strBranch=$t_strBranch&t_strSeparationCause=$t_strSeparationCause&t_dtmSeparationDate=$t_dtmSeparationDate&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
                echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
                echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
                echo "<td class=\"border\">&nbsp;</td></tr></table></td></tr></table>";     
			}
	} 
		
}
?>