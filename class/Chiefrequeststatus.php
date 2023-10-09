<?php 
/* 
File Name: Chiefrequeststatus.php (class folder)
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
Date of Revision: July 26, 2004 (Version 2.0.0)
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
class Chiefrequeststatus extends General
{

   function chiefRequestStatus() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }

	function deleteChiefStatusOfRequest($strEmpNmbr, $t_strRequestID, $t_strRequestCode, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestDetails, $t_strRequestStatus, $t_strRemarks, $Submit) //Delete chief status of request
   	{
	   if ($Submit == 'Delete') 
	   {
	      $delete = "DELETE FROM tblEmpRequest WHERE empNumber = '$t_strEmpNumber' AND requestID='$t_strRequestID'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}

	function viewChiefStatusOfRequest($strEmpNmbr, $t_strRequestID, $t_strRequestCode, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestDetails, $t_strRequestStatus, $t_strRemarks) //View list of employee/s request 
    {
		 $t_strRequestStatus = "Approved";
		 $t_strRequestStatus = " ";
		 $viewResults = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.remarks, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.empNumber='$strEmpNmbr' AND tblEmpRequest.requestStatus <> '$t_strRequestStatus' AND tblEmpRequest.requestStatus <> ' ' ");
		 if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No status of your request yet!";
		 } else {
			$t_strRequestID=$row['requestID'];
			$t_strRequestCode=$row['requestCode'];
			$t_strEmpNumber=$row['empNumber'];
		    $t_strSurname=$row['surname'];
			$t_strFirstname=$row['firstname'];
			$t_strMiddlename=$row['middlename'];
			$t_strRequestStatus=$row['requestStatus'];
			$t_strRequestDetails=$row['requestDetails'];
			$t_strRemarks=$row['remarks'];
		    echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		    echo "<form action=\"<? $PHP_SELF; ?>\" method=\"post\" name=\"frmChief\">";
		    echo "<tr class=\"alterrow\"><td width=\"15%\">Request ID</td>";
		    echo "<td width=\"18%\">Request Type</td>";
		    echo "<td width=\"26%\">Request Status</td>";
		    echo "<td width=\"31%\">Remarks</td>";
		    echo "<td width=\"10%\">&nbsp;</td></tr>";
		    echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			do 
			{
				$t_strRequestID=$row['requestID'];
				$t_strRequestCode=$row['requestCode'];
				$t_strEmpNumber=$row['empNumber'];
				$t_strSurname=$row['surname'];
				$t_strFirstname=$row['firstname'];
				$t_strMiddlename=$row['middlename'];
				$t_strRequestStatus=$row['requestStatus'];
				$t_strRequestDetails=$row['requestDetails'];
				$t_strRemarks=$row['remarks'];
				$t_strParticulars = explode(";", $t_strRequestDetails);
				echo "<tr class=\"alterrow\"><td>" . $row['requestID'] . "</td>";
				echo "<td>" . $row['requestCode'] . "</td>";
				echo "<td>" . $row['requestStatus'] . "</td>";
				echo "<td>" . $row['remarks'] . "</td>";
				echo "<td><a href=\"Chiefrequeststatus.php?strEmpNmbr=$strEmpNmbr&t_strRequestID=$t_strRequestID&t_strRequestCode=$t_strRequestCode&t_strRequestStatus=$t_strRequestStatus&t_strEmpNumber=$t_strEmpNumber&t_strRemarks=$t_strRemarks&Submit=Delete\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">Delete</a></td></tr>";
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</form></table>";
        }
	}

}
?> 