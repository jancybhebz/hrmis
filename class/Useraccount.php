<?php 
/* 
File Name: Useraccount.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view user name, password and access level.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: April 23, 2004 Version (2.0.0)
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
class Useraccount
{

var $strEmpNumber;
var $strUserName;
var $strUserPassword;
var $intUserLevel;
var $strUserPicture;

   function userAccount() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
   
   function comboEmpNumber($t_strEmpNumber)
   {
		$result = mysql_query ("SELECT tblEmpPersonal.empNumber, tblEmpPosition.statusOfAppointment 
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
									ORDER BY tblEmpPersonal.empNumber ASC");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strEmpNumber == $row["empNumber"])
			{
				print "<OPTION VALUE=\"".strtoupper($row["empNumber"])."\" selected>".strtoupper($row["empNumber"])."\r";
			}
		  print "<OPTION VALUE=\"".strtoupper($row["empNumber"])."\">".strtoupper($row["empNumber"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}

   }
	
   function addEmployeeChiefDirectorModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit)  //Add username and password (employee, chief, director modules)
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblEmpAccount (empNumber, userName, userPassword, userLevel, userPermission, accessPermission) VALUES ('$t_strEmpNumber', '$t_strUserName', '$t_strUserPassword', '$t_intUserLevel', '$t_strHRUserPermission', '$t_strAccessPermission')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>User name and password not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editEmployeeChiefDirectorModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit, $t_strOldEmpNumber) //Edit username and password (employee, chief, director modules)
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strEmpNumber=$row['empNumber'];
			   $t_strUserName=$row['userName'];
			   $t_strUserPassword=$row['userPassword'];
			   $t_intUserLevel=$row['userLevel'];
			   $t_strHRUserPermission=$row['userPermission'];
			   $t_strAccessPermission=$row['accessPermission'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
			 $updateResults = "UPDATE tblEmpAccount SET empNumber='$t_strEmpNumber', userName='$t_strUserName', userPassword='$t_strUserPassword', userLevel='$t_intUserLevel', userPermission='$t_strHRUserPermission', accessPermission='$t_strAccessPermission' WHERE empNumber = '$t_strEmpNumber'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>User account and password not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}

   function addHRAndCashierModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit)  //Add username and password (hr&cashier module)
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblEmpAccount (empNumber, userName, userPassword, userLevel, userPermission, accessPermission) VALUES ('$t_strEmpNumber', '$t_strUserName', '$t_strUserPassword', '$t_intUserLevel', '$t_strHRUserPermission', '$t_strAccessPermission')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>User name and password not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editHRAndCashierModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit, $t_strOldEmpNumber) //Edit username and password (hrandcashier modules)
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strEmpNumber=$row['empNumber'];
			   $t_strUserName=$row['userName'];
			   $t_strUserPassword=$row['userPassword'];
			   $t_intUserLevel=$row['userLevel'];
			   $t_strHRUserPermission=$row['userPermission'];
			   $t_strAccessPermission=$row['accessPermission'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
			 $updateResults = "UPDATE tblEmpAccount SET empNumber='$t_strEmpNumber', userName='$t_strUserName', userPassword='$t_strUserPassword', userLevel='$t_intUserLevel', userPermission='$t_strHRUserPermission', accessPermission='$t_strAccessPermission' WHERE empNumber = '$t_strEmpNumber'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>User account and password not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}

   function addHRModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strNotification, $t_str201, $t_strAttendance, $t_strReports, $t_strLibraries, $t_strCompensation, $t_strNotification1, $Submit)   //Add username and password (hr module)
   {
      if ($Submit == 'ADD')
	  {
		$t_strAssistant = "$t_strNotification"."$t_str201"."$t_strAttendance"
						."$t_strReports"."$t_strLibraries"."$t_strCompensation"."$t_strHROfficer";
		$t_strOfficer = "$t_strNotification1";
		$t_strAccessPermission = "$t_strAssistant" . "$t_strOfficer";
	     $results = "INSERT INTO tblEmpAccount (empNumber, userName, userPassword, userLevel, userPermission, accessPermission) VALUES ('$t_strEmpNumber', '$t_strUserName', '$t_strUserPassword', '$t_intUserLevel', '$t_strHRUserPermission', '$t_strAccessPermission')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>User name and password not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}

	function editHRModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strNotification, $t_str201, $t_strAttendance, $t_strReports, $t_strLibraries, $t_strCompensation, $t_strNotification1, $Submit, $t_strOldEmpNumber) //Edit username and password (hr module)
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strEmpNumber=$row['empNumber'];
			   $t_strUserName=$row['userName'];
			   $t_strUserPassword=$row['userPassword'];
			   $t_intUserLevel=$row['userLevel'];
			   $t_strHRUserPermission=$row['userPermission'];
			   $t_strAccessPermission=$row['accessPermission'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
	  		 $t_strHRAssistant = "$t_strNotification"."$t_str201"."$t_strAttendance"."$t_strReports"."$t_strLibraries"."$t_strCompensation";
			 $t_strHROfficer = "$t_strNotification1";
			 $t_strAccessPermission = "$t_strHRAssistant" . "$t_strHROfficer";
			 $updateResults = "UPDATE tblEmpAccount SET empNumber='$t_strEmpNumber', userName='$t_strUserName', userPassword='$t_strUserPassword', userLevel='$t_intUserLevel', userPermission='$t_strHRUserPermission', accessPermission='$t_strAccessPermission' WHERE empNumber = '$t_strEmpNumber'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>User account and password not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}

	function addCashierModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strCashierNotification, $t_strCashierCompensation, $t_strCashierUpdate, $t_strCashierReport, $t_strCashierCompensation1, $Submit)   //Add username and password (cashier module)
   {
      if ($Submit == 'ADD')
	  {
	  		 $t_strAssistant = "$t_strCashierNotification"."$t_strCashierCompensation"."$t_strCashierUpdate"."$t_strCashierReport";
			 $t_strOfficer = "$t_strCashierCompensation1";
			 $t_strAccessPermission = "$t_strAssistant" . "$t_strOfficer";
	     $results = "INSERT INTO tblEmpAccount (empNumber, userName, userPassword, userLevel, userPermission, accessPermission) VALUES ('$t_strEmpNumber', '$t_strUserName', '$t_strUserPassword', '$t_intUserLevel', '$t_strHRUserPermission', '$t_strAccessPermission')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>User name and password not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}

	function editCashierModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strCashierNotification, $t_strCashierCompensation, $t_strCashierUpdate, $t_strCashierReport, $t_strCashierCompensation1, $Submit, $t_strOldEmpNumber) //Edit username and password (cashier module)
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strEmpNumber=$row['empNumber'];
			   $t_strUserName=$row['userName'];
			   $t_strUserPassword=$row['userPassword'];
			   $t_intUserLevel=$row['userLevel'];
			   $t_strHRUserPermission=$row['userPermission'];
			   $t_strAccessPermission=$row['accessPermission'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
	  		 $t_strAssistant = "$t_strCashierNotification"."$t_strCashierCompensation"."$t_strCashierUpdate"."$t_strCashierReport";
			 $t_strOfficer="$t_strCashierCompensation1";
			 $t_strAccessPermission = "$t_strAssistant" . "$t_strOfficer";
			 $updateResults = "UPDATE tblEmpAccount SET empNumber='$t_strEmpNumber', userName='$t_strUserName', userPassword='$t_strUserPassword', userLevel='$t_intUserLevel', userPermission='$t_strHRUserPermission', accessPermission='$t_strAccessPermission' WHERE empNumber = '$t_strEmpNumber'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>User account and password not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}

	function deleteUserAccount($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit) //Delete username and password
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber' AND userName='$t_strUserName'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewUserAccount($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission) //View list of user account and password (all modules)
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpAccount");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {
			 $t_strEmpNumber=$row['empNumber'];
			 $t_strUserName=$row['userName'];
			 $t_strUserPassword=$row['userPassword'];
			 $t_intUserLevel=$row['userLevel'];
			 $t_strHRUserPermission=$row['userPermission'];
			 $t_strAccessPermission=$row['accessPermission'];
			 echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"14%\" height=\"18\">EMPLOYEE NUMBER</td>";
			 echo "<td width=\"15%\">USER NAME</td>";
			 echo "<td width=\"15%\">PASSWORD</td>";
			 echo "<td width=\"9%\">USER LEVEL</td>";
			 echo "<td width=\"19%\">USER PERMISSION</td>";
			 echo "<td width=\"12%\">ACCESS PERMISSION</td>";
			 echo "<td width=\"8%\">&nbsp;</td>";
			 echo "<td width=\"8%\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"8\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strEmpNumber=$row['empNumber'];
				$t_strUserName=$row['userName'];
				$t_strUserPassword=$row['userPassword'];
				$strlenPassword="****";
				$t_intUserLevel=$row['userLevel'];
				$t_strHRUserPermission=$row['userPermission'];
			    $t_strAccessPermission=$row['accessPermission'];
				echo "<tr class=\"border\"><td>" . $row['empNumber'] . "</td>";
				echo "<td>" . $row['userName'] . "</td>";
				echo "<td>" . $strlenPassword . "</td>";
				echo "<td>" . $row['userLevel'] . "</td>";
				echo "<td>" . $row['userPermission'] . "</td>";
			    echo "<td>" . $row['accessPermission'] . "</td>";
				echo "<td><a href=\"Useraccount.php?strEmpNmbr=$strEmpNmbr&t_strEmpNumber=$t_strEmpNumber&t_strUserName=$t_strUserName&t_strUserPassword=$t_strUserPassword&t_intUserLevel=$t_intUserLevel&t_strHRUserPermission=$t_strHRUserPermission&t_strAccessPermission=$t_strAccessPermission&Submit=Edit\">Edit</a></td>";
				echo "<td><a href=\"Useraccount.php?strEmpNmbr=$strEmpNmbr&t_strEmpNumber=$t_strEmpNumber&t_strUserName=$t_strUserName&t_strUserPassword=$t_strUserPassword&t_intUserLevel=$t_intUserLevel&t_strHRUserPermission=$t_strHRUserPermission&t_strAccessPermission=$t_strAccessPermission&Submit=Delete\">Delete</a></td></tr></tr>";		 
			 }  while ($row = mysql_fetch_array($viewResults)); 
			 	echo "<tr><td colspan=\"8\">&nbsp;</td></tr></table>";
		 }
	}
}
?> 