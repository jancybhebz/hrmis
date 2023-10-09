<?php 
/* 
File Name: Specifyleave.php (class folder)
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
class SpecifyLeave
{

var $strSpecifyLeave;

   function specifyLeave() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addSpecifyLeave($t_strLeaveCode, $t_strSpecifyLeave, $Submit) //Add specify leave and reporting days
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
	
	function editSpecifyLeave($t_strLeaveCode, $t_strSpecifyLeave, $Submit, $t_strOldSpecifyLeave) //Add specific leave
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblSpecificLeave WHERE leaveCode='$t_strLeaveCode' and specifyLeave='$t_strSpecifyLeave'");
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
			 $updateResults = "UPDATE tblSpecificLeave SET leaveCode='$t_strLeaveCode', specifyLeave='$t_strSpecifyLeave' WHERE leaveCode='$t_strLeaveCode' and specifyLeave='$t_strOldSpecifyLeave'";
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

	function deleteSpecifyLeave($t_strLeaveCode, $t_strSpecifyLeave, $Submit) //Delete specific leave
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblSpecificLeave WHERE leaveCode='$t_strLeaveCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewSpecifyLeave($t_strLeaveCode, $t_strSpecifyLeave) //View list of specific leave
    {
	     $viewResults = mysql_query("SELECT * FROM tblSpecificLeave");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {	
			 $t_strLeaveCode=$row['leaveCode'];
			 $t_strSpecifyLeave=$row['specifyLeave'];
			 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr>";
			 echo "<td colspan=\"4\" class=\"border\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			 echo "<tr><td width=\"32%\" class=\"title\">LEAVE CODE</td>";
			 echo "<td width=\"37%\" class=\"title\">SPECIFIC LEAVE</td><td width=\"31%\">&nbsp;</td>";
			 echo "</tr></table></td></tr>";
			 do 
			 {
				$t_strLeaveCode=$row['leaveCode'];
			    $t_strSpecifyLeave=$row['specifyLeave'];
				echo "<tr><td width=\"32%\" class=\"border\">" . $row['leaveCode'] . "</td>";
				echo "<td width=\"37%\" class=\"border\">" . $row['specifyLeave'] . "</td>";
				echo "<td width=\"16%\" class=\"border\">";
				echo "<a href=\"Specifyleave.php?t_strLeaveCode=$t_strLeaveCode&t_strSpecifyLeave=$t_strSpecifyLeave&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"15%\" class=\"border\">";
				echo "<a href=\"Specifyleave.php?t_strLeaveCode=$t_strLeaveCode&t_strSpecifyLeave=$t_strSpecifyLeave&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
				echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td></tr>";
				echo "</table>"; 
		 }
	}
}
?> 