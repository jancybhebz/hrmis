<?php 
/* 
File Name: ChiefnotifyTO.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view leave code & type to database.
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
require("../hrmis/class/Attendance.php");
class ChiefnotifyTO extends Attendance
{
	function viewRequestForApproval($strEmpNmbr, $t_strDivisionCode) //View list of employee/s request (Chiefnotifyleave.php)
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
											AND tblEmpRequest.requestCode LIKE 'TO' 
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
			$t_strRequestStatus=$ow['requestStatus'];
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
				$t_strDetails = explode(";", $t_strRequestDetails);
				echo "<tr class=\"alterrow\"><td>" . $row['requestID'] . "</td>";
				echo "<td>" . $row['requestCode'] . "</td>";
				echo "<td><div align=\"justify\">" . $row['firstname'] . "  " . $row['surname'] . "</div></td>";
				echo "<td><a  href=\"ChiefnotifyTO.php?strEmpNmbr=$strEmpNmbr&t_strEmpNumber=$t_strEmpNumber&t_strRequestID=$t_strRequestID&t_strRequestCode=$t_strRequestCode&t_strFirstname=$t_strFirstname&t_strSurname=$t_strSurname&t_strDest=$t_strDetails[0]&t_dtmDateFrom=$t_strDetails[1]&t_dtmDateTo=$t_strDetails[2]&t_strPurpose=$t_strDetails[3]&t_strFund=$t_strDetails[4]&t_strTranspo=$t_strDetails[5]&t_strPerdiem=$t_strDetails[6]&Submit=View\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">View Details</a></td>";
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</form></table>";
        }
		mysql_close();

	}

	function approvedRequest($strEmpNmbr, $t_strRequestID, $t_strRequestStatus, $t_dtmStatusDate, $t_strRemarks, $Submit)  // approved employee/s leave request (Chiefnotifyleave.php)
    {
		if ($Submit == 'Submit')
		{ 
			 $updateResults = "UPDATE tblEmpRequest SET requestStatus='$t_strRequestStatus', remarks='$t_strRemarks', statusDate='$t_dtmStatusDate' WHERE requestID = '$t_strRequestID'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Approved leave request not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			
			if($modifyResults) 
			 { 
			 	$objEmpRqst = mysql_query("SELECT empNumber, requestDetails 
											FROM tblEmpRequest 
										WHERE requestID = '$t_strRequestID'");
				$arrEmpRqst = mysql_fetch_array($objEmpRqst);
				$arrDetail = explode(";", $arrEmpRqst["requestDetails"]);
			 	$this->travel($arrEmpRqst["empNumber"], $arrDetail[0], date("Y", strtotime($arrDetail[1])), date("m", strtotime($arrDetail[1])), date("d", strtotime($arrDetail[1])), date("Y", strtotime($arrDetail[2])), date("m", strtotime($arrDetail[2])), date("d", strtotime($arrDetail[2])), $arrDetail[3], $arrDetail[4], $arrDetail[5], $arrDetail[6]);

			    return 1;
			 }  
		} 
	} 
}
?> 