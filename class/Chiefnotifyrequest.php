<?php 
/* 
File Name: Chiefnotifyrequest.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view leave code & type to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: January 19, 2004
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
class Chiefnotifyrequest extends General
{

   function chiefNotifyRequest() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }

	function viewEmpRequestForApproval($strEmpNmbr, $t_strRequestID, $t_strRequestCode, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestDetails, $t_strDivisionCode) //View list of employee/s request (Chiefnotifyleave.php)
    {
		 $t_strRequestStatus = "Filed Request";
		 $viewResults = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, 
		 								tblEmpRequest.requestDetails, tblEmpPersonal.empNumber, 
										tblEmpPersonal.surname, tblEmpPersonal.firstname, 
										tblEmpPersonal.middlename 
									FROM tblEmpRequest 
									INNER JOIN tblEmpPersonal 
										ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber 
									INNER JOIN tblEmpPosition 
										ON tblEmpPersonal.empNumber=tblEmpPosition.empNumber 
									WHERE tblEmpRequest.statusDate = '0000-00-00' 
										AND tblEmpRequest.requestCode <> 'Report' 
										AND tblEmpRequest.requestCode <> '201' 
										AND tblEmpRequest.requestStatus = '$t_strRequestStatus' 
										AND tblEmpPosition.divisionCode = '$t_strDivisionCode' 
										AND tblEmpPersonal.empNumber !=$strEmpNmbr");
		 
						
		 if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No employee/s Request yet!";
		 } else {
			$t_strRequestID=$row['requestID'];
			$t_strRequestCode=$row['requestCode'];
			$t_strEmpNumber=$row['empNumber'];
		    $t_strSurname=$row['surname'];
			$t_strFirstname=$row['firstname'];
			$t_strMiddlename=$row['middlename'];
			$t_strRequestDetails=$row['requestDetails'];
		    echo "<table width=\"95%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		    echo "<form action=\"<? $PHP_SELF; ?>\" method=\"post\" name=\"frmChief\">";
		    echo "<tr class=\"alterrow\"><td width=\"24%\">Request ID</td>";
		    echo "<td width=\"29%\">Request Code</td>";
		    echo "<td width=\"47%\">Employee/s Name</td>";
		    echo "</tr>";
		    echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			do 
			{
				$t_strRequestID=$row['requestID'];
				$t_strRequestCode=$row['requestCode'];
				$t_strEmpNumber=$row['empNumber'];
				$t_strSurname=$row['surname'];
				$t_strFirstname=$row['firstname'];
				$t_strMiddlename=$row['middlename'];
				$t_strRequestDetails=$row['requestDetails'];
				$t_strParticulars = explode(";", $t_strRequestDetails);
				echo "<tr class=\"alterrow\"><td>" . $row['requestID'] . "</td>";
				echo "<td>" . $row['requestCode'] . "</td>";
				echo "<td><div align=\"justify\">" . $row['firstname'] . "  " . $row['surname'] . "</div></td>";
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</form></table>";
        }
	}

}
?> 