<?php 
/* 
File Name: Leave.php (class folder)
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
Date of Revision: October 06, 2003
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
class LeaveType
{

var $strLeaveCode;
var $strLeaveType;

   function leaveType() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addLeaveType($strEmpNmbr, $t_strLeaveCode, $t_strLeaveType, $t_intNumberOfDays, $Submit) //Add leave code and type
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblLeave (leaveCode, leaveType, numOfDays) VALUES ('$t_strLeaveCode', '$t_strLeaveType', '$t_intNumberOfDays')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Leave code and type not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editLeaveType($strEmpNmbr, $t_strLeaveCode, $t_strLeaveType, $t_intNumberOfDays, $Submit, $t_strOldLeaveCode) //Add leave code and type
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblLeave WHERE leaveCode='$t_strLeaveCode' AND numOfDays='$t_intNumberOfDays' AND leaveType='$t_strLeaveType'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strLeaveCode=$row['leaveCode'];
			   $t_strLeaveType=$row['leaveType'];
			   $t_intNumberOfDays=$row['numOfDays'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblLeave SET leaveCode='$t_strLeaveCode', leaveType='$t_strLeaveType', numOfDays='$t_intNumberOfDays' WHERE leaveCode='$t_strOldLeaveCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Leave code and type not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteLeaveType($strEmpNmbr, $t_strLeaveCode, $t_strLeaveType, $t_intNumberOfDays, $Submit) //Delete leave code and Type
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblLeave WHERE leaveCode='$t_strLeaveCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewLeaveType($strEmpNmbr, $t_strLeaveCode, $t_strLeaveType, $t_intNumberOfDays) //View list of leave code and type
    {
	     $viewResults = mysql_query("SELECT * FROM tblLeave");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {
			 $t_strLeaveCode=$row["leaveCode"];
			 $t_strLeaveType=$row["leaveType"];
			 $t_intNumberOfDays=$row['numOfDays'];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\">";
			 echo "<td width=\"16%\">LEAVE CODE</td>";
			 echo "<td width=\"53%\">LEAVE TYPE</td>";
			 echo "<td width=\"31%\">NUMBER OF DAYS</td></tr>";
			 echo "<tr><td>&nbsp;</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strLeaveCode=$row["leaveCode"];
				$t_strLeaveType=$row["leaveType"];
			   	$t_intNumberOfDays=$row['numOfDays'];
				echo "<tr class=\"border\"><td>" . $row['leaveCode'] . "</td>";
				echo "<td>" . $row['leaveType'] . "</td>";
				echo "<td>" . $row['numOfDays'] . "</td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"3\">&nbsp;</td></tr></table>";
         }
	}
}
?> 