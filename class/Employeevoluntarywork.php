<?php 
/* 
File Name: Employeevoluntarywork.php (class folder)
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
Date of Revision: March 23, 2004 (Version 2.0.0)
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
class Employeevoluntarywork extends General
{

	function employeeVoluntaryWork() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   	
	function viewVoluntaryWork($txtSearch, $optField, $p, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay, $t_dtmVWDateFromYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay, $t_dtmVWDateToYear,  $t_intVWHours, $t_strVWPosition, $Submit, $t_strEmpNumber) //View list of employee voluntary work
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpVoluntaryWork WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
		     $t_strEmpNumber=$row['empNumber'];
			 $t_strVWName=$row['vwName'];
			 $t_strVWAddress=$row['vwAddress'];
			 $t_dtmVWDateFrom=$row['vwDateFrom'];
			 $t_dtmVWDateTo=$row['vwDateTo'];
			 $t_intVWHours=$row['vwHours'];
			 $t_strVWPosition=$row['vwPosition'];
			 echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"alterrow\">";
			 echo "<td colspan=\"8\">Voluntary Work or Involvement in Civic/Non-Governement/People/Voluntary Organization</td></tr>";
             echo "<tr class=\"alterrow\"><td rowspan=\"2\">Name</td>";
             echo "<td rowspan=\"2\">Address</td>";
			 echo "<td colspan=\"2\">Inclusive Dates</td>";
             echo "<td rowspan=\"2\">Number of Hours</td>";
             echo "<td width=\"15%\" rowspan=\"2\">Position/Nature of work</td></tr>";
             echo "<tr class=\"alterrow\"><td width=\"10%\">From</td>";
			 echo "<td width=\"10%\">To</td></tr>";
             echo "<tr><td colspan=\"8\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strEmpNumber=$row['empNumber'];
				$t_strVWName=$row['vwName'];
				$t_strVWAddress=$row['vwAddress'];
				$t_dtmVWDateFrom=$row['vwDateFrom'];
				$t_dtmVWDateTo=$row['vwDateTo'];
				$t_intVWHours=$row['vwHours'];
				$t_strVWPosition=$row['vwPosition'];
				echo "<tr class=\"border\"><td width=\"22%\">" . $row['vwName'] . "</td>";
				echo "<td width=\"23%\">" . $row['vwAddress'] . "</td>";
				echo "<td>" . $row['vwDateFrom'] . "</td>";
				echo "<td>" . $row['vwDateTo'] . "</td>";
				echo "<td width=\"8%\">" . $row['vwHours'] . "</td>";
				echo "<td>" . $row['vwPosition'] . "</td>";
			}  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"8\">&nbsp;</td></tr></table>";
			}
	} 
		
}
?>