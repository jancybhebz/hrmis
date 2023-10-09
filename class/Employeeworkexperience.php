<?php 
/* 
File Name: Employeeworkexperience.php (class folder)
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
Date of Revision: March 22, 2004 (Version 2.0.0)
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
class Employeeworkexperience extends General
{

	function employeeWorkExperience() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   	
	function viewServiceRecords($txtSearch, $optField, $p, $t_dtmServiceFromDate, $t_dtmServiceToDate, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_strEmpNumber) //View list of service records
    {
	     $viewResults = mysql_query("SELECT * FROM tblServiceRecord WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
		     $t_strEmpNumber=$row['empNumber'];
			 $t_dtmServiceFromDate=$row['serviceFromDate'];
			 $t_dtmServiceToDate=$row['serviceToDate'];
			 $t_strPositionCode=$row['positionCode'];
			 $t_strAppointmentCode=$row['appointmentCode'];
			 $t_strStationAgency=$row['stationAgency'];
			 $t_intSalary=$row['salary'];
			 echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"alterrow\"><td colspan=\"8\">WORK EXPERIENCE (Include private employment)</td></tr>";
             echo "<tr class=\"alterrow\"><td colspan=\"2\">Inclusive Dates</td>";
             echo "<td rowspan=\"2\">Position Title</td><td rowspan=\"2\">Department / Agency / Office</td>";
             echo "<td rowspan=\"2\">Monthly Salary</td><td width=\"12%\" rowspan=\"2\">Status of Appointment</td></tr>";
             echo "<tr class=\"alterrow\"><td width=\"10%\">From</td>";
             echo "<td width=\"11%\">To </td></tr>";
             echo "<tr><td colspan=\"8\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strEmpNumber=$row['empNumber'];
				$t_dtmServiceFromDate=$row['serviceFromDate'];
				$t_dtmServiceToDate=$row['serviceToDate'];
				$t_strPositionCode=$row['positionCode'];
				$t_strAppointmentCode=$row['appointmentCode'];
				$t_strStationAgency=$row['stationAgency'];
				$t_intSalary=$row['salary'];
				echo "<tr class=\"border\"><td>" . $row['serviceFromDate'] . "</td>";
				echo "<td>" . $row['serviceToDate'] . "</td>";
				echo "<td width=\"11%\">" . $row['positionCode'] . "</td>";
				echo "<td width=\"33%\">" . $row['stationAgency'] . "</td>";
				echo "<td width=\"10%\">" . $row['salary'] . "</td>";
				echo "<td>" . $row['appointmentCode'] . "</td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"8\">&nbsp;</td></tr>";
				echo "</table>";
			}
	} 
		
}
?>