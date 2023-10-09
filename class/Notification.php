<?php 
/* 
File Name: Notification.php (class folder)
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
Date of Revision: January 07, 2004
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
class Notification extends General
{

var $strDivisionCode;
var $strDivisionName;
var $strProjectCode;
var $strDivisionHead;
var $strDivisionHeadTitle;

   function notification() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
	function viewBirthday($t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strBirthday) //View list of employee birthday
    {
	     $var="-".date("m")."-";
		 $viewResults = mysql_query("SELECT surname,firstname,middlename,birthday FROM tblEmpPersonal WHERE birthday LIKE '%$var%'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No birthday celebrators for this month!";
		 } else {
		    //$t_strSurname=$row['surname'];
			//$t_strFirstname=$row['firstname'];
			//$t_strMiddlename=$row['middlename'];
			//$t_strBirthday=$row['birthday'];
			echo "<table width=\"80%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			echo "<tr class=\"alterrow\"><td colspan=\"2\">CELEBRATORS</td>";
			echo "<td width=\"28%\">DATE OF BIRTH</td></tr>";
			echo "<tr class=\"title\">";
			echo "<td colspan=\"2\">&nbsp;</td>";
			echo "<td>&nbsp;</td></tr>";
			do 
			{
			   $t_strSurname=$row['surname'];
			   $t_strFirstname=$row['firstname'];
			   $t_strMiddlename=$row['middlename'];
			   $t_strBirthday=$row['birthday'];
			   echo "<tr class=\"alterrow\">";
			   echo "<td width=\"20%\"><div align=\"right\">";
			   echo "<img src=\"images/giftbox.gif\" width=\"16\" height=\"16\"></div></td>";
			   echo "<td width=\"52%\"><div align=\"justify\">" . $row['surname'] . "," . "&nbsp;" . $row['firstname'] ."</div></td>";
			   echo "<td><div align=\"center\">" . $row['birthday'] . "</div></td>";
			   echo "</tr><tr class=\"title\"><td colspan=\"2\">&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</table>";
        }
	}

	function viewOBRequest($t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestCode, $t_strRequestID, $t_strRequestDetails, $t_strRequestStatus, $t_strRequestDate) //View list of employee OB request
    {
	     //$viewResults = mysql_query("SELECT tblEmpRequest.empNumber, tblEmpRequest.requestStatus, tblEmpRequest.requestID, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename, tblDivision.divisionCode, tblDivision.divisionHead FROM tblEmpRequest LEFT JOIN tblEmpPersonal tblEmpPersonal ON tblEmpPersonal.empNumber=tblEmpPersonal.empNumber INNER JOIN tblDivision ON tblDivision.divisionCode=tblDivision.divisionCode WHERE tblEmpPersonal.empNumber=tblEmpRequest.empNumber ");
		 $strOB='OB';
		 $viewResults = mysql_query("SELECT * FROM tblEmpRequest LEFT JOIN tblEmpPersonal ON tblEmpPersonal.empNumber=tblEmpRequest.empNumber WHERE tblEmpRequest.requestCode='$strOB' ");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No employee Official Business request!";
		 } else {
			 do{
				 $t_strEmpNumber=$row['empNumber'];
				 $t_strSurname=$row['surname'];
				 $t_strFirstname=$row['firstname'];
				 $t_strMiddlename=$row['middlename'];
				 $t_strRequestCode=$row['requestCode'];
				 $t_strRequestID=$row['requestID'];
				 $t_strRequestDetails=$row['requestDetails'];
				 $t_strRequestStatus=$row['requestStatus'];
				 $t_strRequestDate=$row['requestDate'];
				 echo "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 	 echo "<form name=\"frmOBRequest\" method=\"post\" action=\"<? $PHP_SELF; ?>\">";
			 	 echo "<tr><td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				 echo "<tr><td width=\"22%\">Request ID :</td><td width=\"31%\">" . $row['requestID'] . "</td>";
				 echo "<td width=\"18%\">Time From :</td><td width=\"29%\">" . $row['requestTimeFrom'] . "</td></tr>";
				 echo "<tr><td>Employee Number :</td><td>" . $row['empNumber'] . "</td><td>Time To :</td><td>" . $row['requestTimeTo'] . "</td></tr>";
				 echo "<tr><td>Employee Name :</td><td>" . $row['surname'] . ",&nbsp;" . $row['firstname'] . " " . $row['middlename'] . "</td><td>Request Status : </td><td>" . $row['requestStatus'] . "</td></tr>";
				 echo "<tr><td>Date Requested :</td><td>" . $row['statusDate'] . "</td><td>Division :</td><td>" . $row['divisionCode'] . "</td></tr>";
				 echo "<tr><td>Date From :</td><td>" . $row['requestDetails'] . "</td><td>Date Approved :</td><td>" . $row['approvedDate'] . "</td></tr>";
				 echo "<tr><td>Date To :</td><td>" . $row['requestDetails'] . "</td><td>Approved By :</td><td>" . $row['divisionHead'] . "</td></tr></table></td></tr>";
				 echo "<tr><td><div align=\"right\"><input type=\"submit\" name=\"Submit\" value=\"Certify\"></div></td>";
				 echo "</tr>";
				 echo "<tr><td><hr></td></tr>";
				 echo "</form></table>";
			 }  while ($row=mysql_fetch_array($viewResults));
        }
	}

	function certifyOBRequest($t_strEmpNumber, $t_strRequestID, $t_strOBDateFrom, $t_strOBDateTo, $t_strOBTimeFrom, $t_strOBTimeTo, $t_strOBPlace, $t_strPurpose, $t_strOfficial, $t_strApproveChief, $t_strApproveHR)   //Certify Employees OB request
	{
	if ($Submit == 'Certify')
	  {
	     $results = "INSERT INTO tblEmpOB (empNumber, requestID, obDateFrom, obDateTo, obTimeFrom, obTimeTo,  obPlace, purpose, official, approveChief, approveHR) VALUES ('$t_strEmpNumber', '$t_strRequestID', '$t_strOBDateFrom', '$t_strOBDateTo', '$t_strOBTimeFrom', '$t_strOBTimeTo', '$t_strOBPlace', '$t_strPurpose', '$t_strOfficial', '$t_strApproveChief', '$t_strApproveHR')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee OB request not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}

	function viewLeaveRequest($t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestCode, $t_strRequestID, $t_strRequestDetails, $t_strRequestStatus, $t_strRequestDate) //View list of employee leave request
    {
	     //$viewResults = mysql_query("SELECT tblEmpRequest.empNumber, tblEmpRequest.requestStatus, tblEmpRequest.requestID, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename, tblDivision.divisionCode, tblDivision.divisionHead FROM tblEmpRequest LEFT JOIN tblEmpPersonal tblEmpPersonal ON tblEmpPersonal.empNumber=tblEmpPersonal.empNumber INNER JOIN tblDivision ON tblDivision.divisionCode=tblDivision.divisionCode WHERE tblEmpPersonal.empNumber=tblEmpRequest.empNumber ");
		 $strLeave='Leave';
		 $viewResults = mysql_query("SELECT * FROM tblEmpRequest LEFT JOIN tblEmpPersonal ON tblEmpPersonal.empNumber=tblEmpRequest.empNumber WHERE tblEmpRequest.requestCode='$strLeave' ");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No employee leave request!";
		 } else {
			 do{
				 $t_strEmpNumber=$row['empNumber'];
				 $t_strSurname=$row['surname'];
				 $t_strFirstname=$row['firstname'];
				 $t_strMiddlename=$row['middlename'];
				 $t_strRequestCode=$row['requestCode'];
				 $t_strRequestID=$row['requestID'];
				 $t_strRequestDetails=$row['requestDetails'];
				 $t_strRequestStatus=$row['requestStatus'];
				 $t_strRequestDate=$row['requestDate'];
				 echo "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 	 echo "<form name=\"frmOBRequest\" method=\"post\" action=\"<? echo $PHP_SELF; ?>\">";
			 	 echo "<tr><td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				 echo "<tr><td width=\"22%\">Request ID :</td><td width=\"31%\">" . $row['requestID'] . "</td>";
				 echo "<td width=\"18%\">Time From :</td><td width=\"29%\">" . $row['requestTimeFrom'] . "</td></tr>";
				 echo "<tr><td>Employee Number :</td><td>" . $row['empNumber'] . "</td><td>Time To :</td><td>" . $row['requestTimeTo'] . "</td></tr>";
				 echo "<tr><td>Employee Name :</td><td>" . $row['surname'] . ",&nbsp;" . $row['firstname'] . " " . $row['middlename'] . "</td><td>Request Status : </td><td>" . $row['requestStatus'] . "</td></tr>";
				 echo "<tr><td>Date Requested :</td><td>" . $row['statusDate'] . "</td><td>Division :</td><td>" . $row['divisionCode'] . "</td></tr>";
				 echo "<tr><td>Date From :</td><td>" . $row['requestDetails'] . "</td><td>Date Approved :</td><td>" . $row['approvedDate'] . "</td></tr>";
				 echo "<tr><td>Date To :</td><td>" . $row['requestDetails'] . "</td><td>Approved By :</td><td>" . $row['divisionHead'] . "</td></tr></table></td></tr>";
				 echo "<tr><td><div align=\"right\"><input type=\"submit\" name=\"Submit\" value=\"Certify\"></div></td>";
				 echo "</tr>";
				 echo "<tr><td><hr></td></tr>";
				 echo "</form></table>";
			 }  while ($row=mysql_fetch_array($viewResults));
        }
	}

	function viewFinishContract($t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strContractEndDate) //View list of employee/s finish contract
    {
		 $Year=date("Y")."-".date("m")."-";
		 $viewResults = mysql_query("SELECT * FROM tblEmpPosition LEFT JOIN tblEmpPersonal ON tblEmpPosition.empNumber=tblEmpPersonal.empNumber WHERE tblEmpPosition.contractEndDate LIKE '%$Year%'"); 
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No employee finish contract as of this month!";
		 } else {
			echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
            echo "<tr class=\"alterrow\"><td width=\"24%\">Number</td>";
            echo "<td width=\"54%\">Name</td><td width=\"22%\">Separation Date</td></tr>";
            echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			do 
			{
			   $t_strSurname=$row['surname'];
			   $t_strFirstname=$row['firstname'];
			   $t_strMiddlename=$row['middlename'];
			   $t_strBirthday=$row['birthday'];
            echo "<tr class=\"alterrow\"><td>" . $row['empNumber'] . "</td>";
			echo "<td><div align=\"justify\">" . $row['surname'] . ",&nbsp; " . $row['firstname'] . " ". $row['middlename'] . "</td></div>";
            echo "<td>" . $row['contractEndDate'] . "</td></tr>";
            echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</table>";
        }
	}

	function viewApprovedLeaveRequest($strEmpNmbr, $t_strRequestID, $t_strRequestCode, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestDetails) //View list of employee/s request (Leaverequest.php)
    {
		 $t_strRequestStatus = "Approved";
		 $viewResults = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'Leave' AND tblEmpRequest.requestStatus = '$t_strRequestStatus' "); 
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
				$t_strParticulars = explode(";", $t_strRequestDetails);
				echo "<tr class=\"alterrow\"><td>" . $row['requestID'] . "</td>";
				echo "<td>" . $row['requestCode'] . "</td>";
				echo "<td><div align=\"justify\">" . $row['firstname'] . "  " . $row['surname'] . "</div></td>";
				echo "<td><a  href=\"Chiefnotifyleave.php?strEmpNmbr=$strEmpNmbr&t_strEmpNumber=$t_strEmpNumber&t_strRequestID=$t_strRequestID&t_strRequestCode=$t_strRequestCode&t_strFirstname=$t_strFirstname&t_strSurname=$t_strSurname&t_strTypeOfLeave=$t_strParticulars[0]&t_strSpecificLeave=$t_strParticulars[1]&t_dtmDateFrom=$t_strParticulars[2]&t_dtmDateTo=$t_strParticulars[3]&Submit=View\">View Details</a></td>";
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</form></table>";
        }
	}

	function viewApprovedOBRequest($strEmpNmbr, $t_strRequestID, $t_strRequestCode, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestDetails, $t_dtmStatusDate, $t_strRemarks) //View list of employee/s request (ChiefnotifyOB.php)
    {
		 $t_strRequestStatus = "Approved";
		 $viewResults = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'OB' AND tblEmpRequest.requestStatus = '$t_strRequestStatus' ");
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
			$t_dtmStatusDate=$row['statusDate'];
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
				$t_strParticulars = explode(";", $t_strRequestDetails);
				$t_dtmStatusDate=$row['statusDate'];
				$t_strRemarks=$row['remarks'];
				echo "<tr class=\"alterrow\"><td>" . $row['requestID'] . "</td>";
				echo "<td>" . $row['requestCode'] . "</td>";
				echo "<td><div align=\"justify\">" . $row['firstname'] . "  " . $row['surname'] . "</div></td>";
				echo "<td><a  href=\"OBrequest.php?strEmpNmbr=$strEmpNmbr&t_strEmpNumber=$t_strEmpNumber&t_strRequestID=$t_strRequestID&t_strRequestCode=$t_strRequestCode&t_strFirstname=$t_strFirstname&t_strSurname=$t_strSurname&t_strOfficialBusiness=$t_strParticulars[0]&t_dtmDateFrom=$t_strParticulars[1]&t_dtmDateTo=$t_strParticulars[2]&t_dtmTimeFrom=$t_strParticulars[3]&t_dtmTimeTo=$t_strParticulars[4]&t_strOBPlace=$t_strParticulars[5]&t_strOBPurpose=$t_strParticulars[6]&t_dtmStatusDate=$t_dtmStatusDate&t_strRemarks=$t_strRemarks&Submit=View\">View Details</a></td>";
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</form></table>";
        }
	}

	function getQuote($day) 
	{ 
		$date=date('j');
		$result = mysql_query("SELECT * FROM tblDailyQuote WHERE day = '$date' ");
		$row=mysql_fetch_array($result);
		$t_dtmDay = $row['day'];
		$t_strDailyQuote = $row['quote'];
		$quote[1] = "\"When I am surrounded by troubles, you keep me safe, 
					You oppose my angry enemies and save me by your power.\" <br><br>
					Psalm 138:7 <br>"; 
		$quote[2] = "$t_strDailyQuote";
		$quote[3] = "$t_strDailyQuote"; 
		$quote[4] = "$t_strDailyQuote"; 
		$quote[5] = "$t_strDailyQuote"; 
		$quote[6] = "$t_strDailyQuote";
		$quote[7] = "$t_strDailyQuote"; 
		$quote[8] = "$t_strDailyQuote";
		$quote[9] = "$t_strDailyQuote";
		$quote[10] = "$t_strDailyQuote";
		$quote[11] = "$t_strDailyQuote";
		$quote[12] = "$t_strDailyQuote";
		$quote[13] = "$t_strDailyQuote";
		$quote[14] = "$t_strDailyQuote";
		$quote[15] = "$t_strDailyQuote"; 
		$quote[16] =  "$t_strDailyQuote";
		$quote[17] = "$t_strDailyQuote";
		$quote[18] = "$t_strDailyQuote";
		$quote[19] = "$t_strDailyQuote";
		$quote[20] = "$t_strDailyQuote";
		$quote[21] = "$t_strDailyQuote";
		$quote[22] = "$t_strDailyQuote";
		$quote[23] = "$t_strDailyQuote";
		$quote[24] = "$t_strDailyQuote";
		$quote[25] = "$t_strDailyQuote";
		$quote[26] = "$t_strDailyQuote";
		$quote[27] = "$t_strDailyQuote";
		$quote[28] = "$t_strDailyQuote";
		$quote[29] = "$t_strDailyQuote";
		$quote[30] = "$t_strDailyQuote";
		$quote[31] = "$t_strDailyQuote";
		return "$quote[$day] <br><br>"; 
	  } 

	function dailyQuote() { 
	$day = date("j"); 
	echo $this->getQuote($day); 
	} 

}
?> 