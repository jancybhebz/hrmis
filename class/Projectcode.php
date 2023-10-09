<?php 
/* 
File Name: Projectcode.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view project code and description to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 09, 2003
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

class Project
{

//Educational Level:

var $strProjectCode;
var $strProjectDesc;


   function project() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addProjectCode($strEmpNmbr, $t_strProjectCode, $t_strProjectDesc, $Submit) //Add project code and description
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblProject (projectCode, projectDesc) VALUES ('$t_strProjectCode', '$t_strProjectDesc')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Project code and description not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editProjectCode($strEmpNmbr, $t_strProjectCode, $t_strProjectDesc, $Submit, $t_strOldProjectCode) //Add project code and description
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblProject WHERE projectCode='$t_strProjectCode' and projectDesc='$t_strProjectDesc'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strProjectCode=$row['t_strProjectCode'];
			   $t_strProjectDesc=$row['t_strProjectDesc'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblProject SET projectCode='$t_strProjectCode', projectDesc='$t_strProjectDesc' WHERE projectCode='$t_strOldProjectCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Project code and description not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return; 
			 } 
	} 
} 

	function deleteProjectCode($strEmpNmbr, $t_strProjectCode, $t_strProjectDesc, $Submit) //Delete project code and description
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblProject WHERE projectCode='$t_strProjectCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	} 
	
	function viewProjectCode($strEmpNmbr, $t_strProjectCode, $t_strProjectDesc) //View list of project code and type
    {
	     $viewResults = mysql_query("SELECT * FROM tblProject");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {	
			 $t_strProjectCode=$row["projectCode"];
			 $t_strProjectDesc=$row["projectDesc"];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\">";
			 echo "<td width=\"32%\">PROJECT CODE</td>";
			 echo "<td width=\"42%\">PROJECT DESCRIPTION</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strProjectCode=$row["projectCode"];
				$t_strProjectDesc=$row["projectDesc"];
				echo "<tr class=\"border\">";
				echo "<td>" . $row["projectCode"] . "</td>";
				echo "<td>" . $row["projectDesc"] . "</td>";
				echo "<td width=\"13%\"><a href=\"Projectcode.php?strEmpNmbr=$strEmpNmbr&t_strProjectCode=$t_strProjectCode&t_strProjectDesc=$t_strProjectDesc&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"13%\"><a href=\"Projectcode.php?strEmpNmbr=$strEmpNmbr&t_strProjectCode=$t_strProjectCode&t_strProjectDesc=$t_strProjectDesc&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
			 	echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";
		 }
	} 
} 
?> 