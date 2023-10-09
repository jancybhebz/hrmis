<?php 
/* 
File Name: TOrequest.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view leave code & type to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco and Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: November 05, 2004
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
require("../hrmis/class/FileOB.php");
class TOrequest extends Attendance
{

   function toRequest() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
	function viewApprovedTORequest($strEmpNmbr, $t_strRequestID, $t_strRequestCode, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestDetails, $t_dtmStatusDate, $t_strRemarks) //View list of employee/s request (TOrequest.php)
    {
		 $viewResults = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestDate, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'TO' AND tblEmpRequest.requestStatus LIKE 'Approved'");
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
			$t_dtmRequestDate=$row['requestDate'];			
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
//				print_r($row);
//				echo "<br><br>";
				$t_strRequestID=$row['requestID'];
				$t_strRequestCode=$row['requestCode'];
				$t_strEmpNumber=$row['empNumber'];
				$t_strSurname=$row['surname'];
				$t_strFirstname=$row['firstname'];
				$t_strMiddlename=$row['middlename'];
				$t_strRequestDetails=$row['requestDetails'];
				$t_strTORequestDetails = explode(";", $t_strRequestDetails);
				$t_strRequestStatus=$row['requestStatus'];
				$t_dtmRequestDate=$row['requestDate'];				
				$t_dtmStatusDate=$row['statusDate'];
				$t_strRemarks=$row['remarks'];
				echo "<tr class=\"alterrow\"><td>" . $row['requestID'] . "</td>";
				echo "<td>" . $row['requestCode'] . "</td>";
				echo "<td><div align=\"justify\">" . $row['firstname'] . "  " . $row['surname'] . "</div></td>";
				echo "<td><a  href=\"TOrequest.php?strEmpNmbr=$strEmpNmbr&t_dtmRequestDate=$t_dtmRequestDate&t_strEmpNumber=$t_strEmpNumber&t_strRequestID=$t_strRequestID&t_strRequestCode=$t_strRequestCode&t_strFirstname=$t_strFirstname&t_strSurname=$t_strSurname&t_strOfficialBusiness=$t_strTORequestDetails[0]&t_dtmDateFrom=$t_strTORequestDetails[1]&t_dtmDateTo=$t_strTORequestDetails[2]&t_strTOPurpose=$t_strTORequestDetails[3]&t_dtmStatusDate=$t_dtmStatusDate&t_strRequestStatus=$t_strRequestStatus&t_strRemarks=$t_strRemarks&Submit=View\">View Details</a></td>";
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</form></table>";
        }
	}
	
	function certifyTORequest($t_strEmpNumber, $t_dtmTODateFrom, $t_dtmTODateTo, $t_strRequestID, $t_strRequestStatus, $t_strRemarks, $t_strSignatory, $Submit, $t_blnRemove=0)   // to certify ob request from approved chief module (OBrequest.php)
	{
		if ($Submit == 'Certify')
		{ 
			$intMonth = date("m", strtotime($t_dtmTODateFrom));
			$intYear = date("Y", strtotime($t_dtmTODateFrom));
			$intDayFrom = date("d", strtotime($t_dtmTODateFrom));
			$intDayTo = date("d", strtotime($t_dtmTODateTo));
			
			$arrDate = array();
			for($intCtr = $intDayFrom; $intCtr <= $intDayTo; $intCtr++)
			{
				$arrDay = array($intCtr=>$intCtr);
				$arrDate = array_merge($arrDate, $arrDay);
			}
		 	
			$this->trapHolidayWeekend($intMonth, $intYear, $arrDate, 0);
			$this->trapCmpltTime($t_strEmpNumber, $intMonth, $intYear, $arrDate, "TO", 0);
			//echo $_SESSION['ovrdErrMsg'];
			if(strlen($_SESSION['ovrdErrMsg']) == 0)
			{ 
				$arrOvrrdMsg = $this->warningMsgOvrrd($t_strEmpNumber, $intYear, $intMonth, $arrDate);
				if(is_array($arrOvrrdMsg) && $t_blnRemove != 1)
				{
					$arrReturn = array("submit"=>"conflict", "id"=>$t_strRequestID);
					$arrReturn = array_merge($arrReturn, $arrOvrrdMsg);
					return $arrReturn;
				}
				else
				{
					 $updateResults = "UPDATE tblEmpRequest SET requestStatus='$t_strRequestStatus', remarks = '$t_strRemarks', signatory='$t_strSignatory' WHERE requestID = '$t_strRequestID' ";
					 $modifyResults = mysql_query($updateResults);
					 if(!$modifyResults) 
					 { 
						echo "<b>Request Status not modify:</b> ", mysql_error(); 
						exit; 
					 } 
					 if($modifyResults) 
					 { 
						return 1; 
					 } 

				}
			 }
			 else
			 {
			 	$arrReturn = array("submit"=>"disapproved", "id"=>$t_strRequestID);
			 	return $arrReturn;
			 } 
		} 
		elseif ($Submit == 'disapproved')
		{
			$updateResults = "UPDATE tblEmpRequest SET requestStatus='Disapproved', remarks='".$_SESSION['ovrdErrMsg']."' WHERE requestID = '$t_strRequestID' ";
			$modifyResults = mysql_query($updateResults);
			
			$arrReturn = array();
		 	return $arrReturn;
		}
	}
	
   function addEmpTO($t_strEmpNumber, $t_strRequestID, $t_dtmTODateFrom, $t_dtmTODateTo, $t_strPurpose, $t_strOfficial, $t_strApproveChief, $t_strApproveHR, $t_dtmRequestDate, $Submit)   //Add ob (tblEmpTO) that was certified by the HR
   {
      if ($Submit == 'Certify')
	  {
	     $results = "INSERT INTO tblEmpTravelOrder (empNumber, requestID, dateFiled, toDateFrom, toDateTo, purpose, official, approveChief, approveHR) VALUES ('$t_strEmpNumber', '$t_strRequestID', '$t_dtmRequestDate','$t_dtmTODateFrom', '$t_dtmTODateTo', '$t_strPurpose', '$t_strOfficial', '$t_strApproveChief', '$t_strApproveHR')";
		 mysql_query($results) or die (mysql_error());
//-------------------------- code koto! code koto! baje----------------------------------------		 
		 $intNewID = mysql_insert_id();
		 $objFileOB = new FileOB;
		 $objFileOB->checkEmpDay($intNewID, $t_strEmpNumber, $t_dtmTODateFrom, $t_dtmTODateTo, $t_strOfficial);
//------------------------------- end ng code ko baje -----------------------------------------		 		 
	     if(!$results) 
	     { 
            echo "<b>Employee TO not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function viewBirthday($t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strBirthday) //View list of employee birthday
    {
	     $var="-".date("m")."-";
		 $viewResults = mysql_query("SELECT surname,firstname,middlename,birthday FROM tblEmpPersonal WHERE birthday LIKE '%$var%'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No birthday celebrators for this month!";
		 } else {
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
            echo "<td width=\"54%\">Name</td><td width=\"22%\">Contract End Date</td></tr>";
            echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			do 
			{
			   $t_strSurname=$row['surname'];
			   $t_strFirstname=$row['firstname'];
			   $t_strMiddlename=$row['middlename'];
			   $t_strBirthday=$row['birthday'];
            echo "<tr class=\"alterrow\"><td>" . $row['empNumber'] . "</td>";
			echo "<td>" . $row['surname'] . ",&nbsp; " . $row['firstname'] . " ". $row['middlename'] . "</td>";
            echo "<td>" . $row['contractEndDate'] . "</td></tr>";
            echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</table>";
        }
	}

}
?> 