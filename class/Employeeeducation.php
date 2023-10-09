<?php 
/* 
File Name: Employeeeducation.php (class folder)
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
class Employeeeducation extends General
{

	function employeeEducation() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function viewEducation($txtSearch, $optField, $p, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_intUnits, $t_dtmSchoolFromMonth, $t_dtmSchoolFromDay, $t_dtmSchoolFromYear, $t_dtmSchoolToMonth, $t_dtmSchoolToDay, $t_dtmSchoolToYear, $t_strHonors, $t_strEmpNumber) //View list of employee educational attainment
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpSchool WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strLevelCode=$row['levelCode'];
			   $t_strSchoolName=$row['schoolName'];
			   $t_strCourse=$row['course'];
			   $t_intUnits=$row['units'];
			   $t_strHonors=$row['honors'];
			   $t_dtmSchoolFromDate=$row['schoolFromDate'];
			   $t_dtmSchoolToDate=$row['schoolToDate'];
			 echo "<table width=\"99%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr><td colspan=\"9\" class=\"alterrow\">EDUCATIONAL ATTAINMENT</td></tr>";
             echo "<tr class=\"alterrow\"><td width=\"5%\">Level</td><td width=\"24%\">Name of</td>";
             echo "<td width=\"20%\">Degree/</td><td width=\"8%\">Units</td><td width=\"11%\">Honors</td>";
             echo "<td colspan=\"2\">Inclusive Dates</td></tr>";
             echo "<tr class=\"alterrow\"><td>Code</td><td>School</td><td>Course</td><td>Earned</td>";
             echo "<td>Received</td><td width=\"10%\">From</td><td>To</td></tr>";
             echo "<tr><td colspan=\"9\">&nbsp;</td></tr>";
			 do 
			 {
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strLevelCode=$row['levelCode'];
			   $t_strSchoolName=$row['schoolName'];
			   $t_strCourse=$row['course'];
			   $t_intUnits=$row['units'];
			   $t_strHonors=$row['honors'];
			   $t_dtmSchoolFromDate=$row['schoolFromDate'];
			   $t_dtmSchoolToDate=$row['schoolToDate'];
             echo "<tr class=\"border\"><td>" . $row['levelCode'] . "</td>";
             echo "<td>" . $row['schoolName'] . "</td>";
             echo "<td>" . $row['course'] . "</td>";
             echo "<td>" . $row['units'] . "</td>";
             echo "<td>" . $row['honors'] . "</td>";
             echo "<td>" . $row['schoolFromDate'] . "</td>";
             echo "<td width=\"10%\">" . $row['schoolToDate'] . "</td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"9\">&nbsp;</td></tr></table>";
			}
	} 
		
}
?>