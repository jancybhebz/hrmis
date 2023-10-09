<?php 
/* 
File Name: Chiefnotifyleave.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view leave code & type to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco, Brian Jill DG. Sarandi
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
require("../hrmis/class/Attendance.php");
class Chiefnotifyleave extends Attendance
{
	function viewLeaveRequestForApproval($strEmpNmbr, $t_strRequestID, $t_strRequestCode, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestDetails, $t_strDivisionCode) //View list of employee/s request (Chiefnotifyleave.php)
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
											AND tblEmpRequest.requestCode LIKE 'Leave' 
											AND tblEmpRequest.requestStatus = '$t_strRequestStatus' 
											AND tblEmpPosition.divisionCode = '$t_strDivisionCode'
											AND tblEmpPersonal.empNumber != '$strEmpNmbr' ");
											


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
			$t_strRequestStatus=$row['requestStatus'];
			$t_strRemarks=$row['remarks'];
		    echo "<table width=\"95%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		    echo "<form action=\"<? $PHP_SELF; ?>\" method=\"post\" name=\"frmChief\">";
		    echo "<tr class=\"alterrow\"><td width=\"14%\">Request ID</td>";
		    echo "<td width=\"19%\">Request Code</td>";
		    echo "<td width=\"42%\">Employee/s Name</td>";
		    echo "<td width=\"25%\">&nbsp;</td>";
		    echo "</tr>";
		    echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			do 
			{
				$t_strRequestID=$row['requestID'];
				$t_strRequestCode=$row['requestCode'];
				$t_strEmpNumber=$row['empNumber'];
				$t_strSurname=$row['surname'];
				$t_strFirstname=$row['firstname'];
				$t_strMiddlename=$row['middlename'];
				$t_strRequestDetails=$row['requestDetails'];
				$t_strLeaveRequestDetails = explode(";", $t_strRequestDetails);
				$t_strRequestStatus=$row['requestStatus'];
				$t_strRemarks=$row['remarks'];
				echo "<tr class=\"alterrow\"><td>" . $row['requestID'] . "</td>";
				echo "<td>" . $row['requestCode'] . "</td>";
				echo "<td><div align=\"justify\">" . $row['firstname'] . "  " . $row['surname'] . "</div></td>";
				echo "<td><a  href=\"Chiefnotifyleave.php?strEmpNmbr=$strEmpNmbr&t_strEmpNumber=$t_strEmpNumber&t_strRequestID=$t_strRequestID&t_strRequestCode=$t_strRequestCode&t_strFirstname=$t_strFirstname&t_strSurname=$t_strSurname&t_strTypeOfLeave=$t_strLeaveRequestDetails[0]&t_strSpecificLeave=$t_strLeaveRequestDetails[1]&t_dtmDateFrom=$t_strLeaveRequestDetails[2]&t_dtmDateTo=$t_strLeaveRequestDetails[3]&t_strReason=$t_strLeaveRequestDetails[4]&t_strRequestStatus=$t_strRequestStatus&t_strRemarks=$t_strRemarks&Submit=View\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">View Details</a></td>";
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</form></table>";
        }
		mysql_close();

	}

	function approvedLeaveRequest($strEmpNmbr, $t_strRequestID, $t_strRequestCode, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestDetails, $t_strRequestStatus, $t_dtmStatusDate, $t_strRemarks, $Submit, $t_strOldRequestStatus, $t_strOldRemarks)  // approved employee/s leave request (Chiefnotifyleave.php)
    {
      if ($Submit == 'View')
	  {
		 $viewResults = mysql_query("SELECT requestID, requestStatus, statusDate, remarks FROM tblEmpRequest WHERE requestID = '$t_strRequestID' AND requestStatus = '$t_strRequestStatus' AND statusDate='$t_dtmStatusDate' AND remarks = '$t_strRemarks' ");
		 if($row = mysql_fetch_array($viewResults))
		 {
		    do 
			{
			$t_strRequestID=$row['requestID'];
			$t_strRequestCode=$row['requestCode'];
			$t_strEmpNumber=$row['empNumber'];
		    $t_strSurname=$row['surname'];
			$t_strFirstname=$row['firstname'];
			$t_strMiddlename=$row['middlename'];
			$t_strRequestDetails=$row['requestDetails'];
			$t_strLeaveRequestDetails = explode(";", $t_strRequestDetails);
			$t_strRequestStatus = $row['requestStatus'];
			$t_dtmStatusDate = $row['statusDate'];
			$t_strRemarks = $row['remarks'];
			}  while($row=mysql_fetch_array($viewResults));
		}
	}
	elseif ($Submit == 'Submit'){ 
			 $updateResults = "UPDATE tblEmpRequest SET requestStatus='$t_strRequestStatus', remarks='$t_strRemarks', statusDate='$t_dtmStatusDate' WHERE requestID = '$t_strRequestID' ";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Approved leave request not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			if($modifyResults) 
			 { 
			    return 1;
			 }  
		} 
	} 
}
?> 