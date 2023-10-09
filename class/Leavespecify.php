<?php 
/* 
File Name: Leavespecify.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete specify leave to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 23, 2003
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
include ("../hrmis/class/General.php");
class SpecifyLeave extends General
{

var $strSpecifyLeave;

   function specifyLeave() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addSpecifyLeave($strEmpNmbr, $t_strLeaveCode, $t_strSpecifyLeave, $Submit) //Add specify leave and reporting days
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblSpecificLeave (leaveCode, specifyLeave) VALUES ('$t_strLeaveCode', '$t_strSpecifyLeave')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Specific leave not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return; 
	     } 
	  }
	}
	
	function editSpecifyLeave($strEmpNmbr, $t_strLeaveCode, $t_strSpecifyLeave, $Submit, $t_strOldSpecifyLeave) //Add specific leave
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblSpecificLeave WHERE leaveCode='$t_strLeaveCode' AND specifyLeave='$t_strSpecifyLeave'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{			  
			   $t_strLeaveCode=$row['leaveCode'];
			   $t_strSpecifyLeave=$row['specifyLeave'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblSpecificLeave SET leaveCode='$t_strLeaveCode', specifyLeave='$t_strSpecifyLeave' WHERE specifyLeave='$t_strOldSpecifyLeave'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Specific leave not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteSpecifyLeave($strEmpNmbr, $t_strLeaveCode, $t_strSpecifyLeave, $Submit) //Delete specific leave
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblSpecificLeave WHERE leaveCode='$t_strLeaveCode' AND specifyLeave = '$t_strSpecifyLeave' ";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewSpecifyLeave($strEmpNmbr, $t_strLeaveCode, $t_strSpecifyLeave) //View list of specific leave
    {
	     $viewResults = mysql_query("SELECT * FROM tblSpecificLeave");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {	
			 $t_strLeaveCode=$row['leaveCode'];
			 $t_strSpecifyLeave=$row['specifyLeave'];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\">";
			 echo "<td width=\"32%\">LEAVE CODE</td>";
			 echo "<td width=\"42%\">SPECIFIC LEAVE</td></tr>";
			 do 
			 {
				$t_strLeaveCode=$row['leaveCode'];
			    $t_strSpecifyLeave=$row['specifyLeave'];
			 echo "<tr class=\"border\"><td>" . $row['leaveCode'] . "</td>";
			 echo "<td>" . $row['specifyLeave'] . "</td>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
			 echo "</tr></table>";
		 }
	}
}
?> 