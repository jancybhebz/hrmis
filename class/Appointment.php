<?php 
/* 
File Name: Appointment.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view appointment code and description to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 08, 2003
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
class AppointmentStatus
{

var $strAppointmentCode;
var $strAppointmentDesc;
var $filename;

   function appointmentStatus() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addAppointmentStatus($strEmpNmbr, $t_strAppointmentCode, $t_strAppointmentDesc, $t_strHeader, $t_strLeaveEntitled, $t_strPaymentBasis, $Submit) //Add appointment code and description
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblAppointment (appointmentCode, appointmentDesc, header, leaveEntitled, paymentBasis) VALUES ('$t_strAppointmentCode', '$t_strAppointmentDesc', '$t_strHeader', '$t_strLeaveEntitled', '$t_strPaymentBasis')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Appointment code and description not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return; 
	     } 
	  }
	}
	
	function editAppointmentStatus($strEmpNmbr, $t_strAppointmentCode, $t_strAppointmentDesc, $t_strHeader, $t_strLeaveEntitled, $t_strPaymentBasis, $Submit, $t_strOldAppointmentCode) //Add appointment code and description
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblAppointment WHERE appointmentCode='$t_strAppointmentCode' and appointmentDesc='$t_strAppointmentDesc'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strAppointmentCode=$row['appointmentCode'];
			   $t_strAppointmentDesc=$row['appointmentDesc'];
			   $t_strHeader=$row['header'];
			   $t_strLeaveEntitled=$row['leaveEntitled'];
			   $t_strPaymentBasis=$row['paymentBasis'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
			 $updateResults = "UPDATE tblAppointment SET appointmentCode='$t_strAppointmentCode', appointmentDesc='$t_strAppointmentDesc', header='$t_strHeader', leaveEntitled='$t_strLeaveEntitled', paymentBasis='$t_strPaymentBasis' WHERE appointmentCode='$t_strOldAppointmentCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Appointment code and description not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			if($modifyResults) 
			 { 
			    return 1;
			 }  
	} 
} 

	function deleteAppointmentStatus($strEmpNmbr, $t_strAppointmentCode, $t_strAppointmentDesc, $t_strHeader, $t_strLeaveEntitled, $t_strPaymentBasis, $Submit) //Delete appointment code and description
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblAppointment WHERE appointmentCode='$t_strAppointmentCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	} 
	
	function viewAppointmentStatus($strEmpNmbr, $t_strAppointmentCode, $t_strAppointmentDesc, $t_strHeader, $t_strLeaveEntitled, $t_strPaymentBasis) //View list of appointment
    {
	     $viewResults = mysql_query("SELECT * FROM tblAppointment");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		} else {
			   $t_strAppointmentCode=$row['appointmentCode'];
			   $t_strAppointmentDesc=$row['appointmentDesc'];
			   $t_strHeader=$row['header'];
			   $t_strLeaveEntitled=$row['leaveEntitled'];
			   $t_strPaymentBasis=$row['paymentBasis'];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"32%\">APPOINTMENT CODE</td>";
			 echo "<td width=\"42%\">APPOINTMENT DESCRIPTION</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
			 do 
			 {
			   	$t_strAppointmentCode=$row['appointmentCode'];
			   	$t_strAppointmentDesc=$row['appointmentDesc'];
			   	$t_strHeader=$row['header'];
			   	$t_strLeaveEntitled=$row['leaveEntitled'];
			   	$t_strPaymentBasis=$row['paymentBasis'];
			 echo "<tr class=\"border\"><td>" . $row['appointmentCode'] . "</td>";
             echo "<td>" . $row['appointmentDesc'] . "</td>";
			 echo "<td width=\"13%\"><a href=\"Appointment.php?strEmpNmbr=$strEmpNmbr&t_strAppointmentCode=$t_strAppointmentCode&t_strAppointmentDesc=$t_strAppointmentDesc&t_strHeader=$t_strHeader&t_strLeaveEntitled=$t_strLeaveEntitled&t_strPaymentBasis=$t_strPaymentBasis&Submit=Edit\">Edit</a></td>";
			 echo "<td width=\"13%\"><a href=\"Appointment.php?strEmpNmbr=$strEmpNmbr&t_strAppointmentCode=$t_strAppointmentCode&t_strAppointmentDesc=$t_strAppointmentDesc&t_strHeader=$t_strHeader&t_strLeaveEntitled=$t_strLeaveEntitled&t_strPaymentBasis=$t_strPaymentBasis&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";
        }
	} 
} 
?> 