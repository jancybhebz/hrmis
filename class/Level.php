<?php 
/* 
File Name: Level.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view level code and description to database.
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

class EducationalLevel
{

//Educational Level:

var $strLevelCode;
var $strLevelDesc;


   function educationalLevel() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addEducationalLevel($strEmpNmbr, $t_strLevelCode, $t_strLevelDesc, $Submit) //Add appointment code and description
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblEducationalLevel (levelCode, levelDesc) VALUES ('$t_strLevelCode', '$t_strLevelDesc')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Educational Level not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editEducationalLevel($strEmpNmbr, $t_strLevelCode, $t_strLevelDesc, $Submit, $t_strOldLevelCode) //Add level code and description
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEducationalLevel WHERE levelCode='$t_strLevelCode' and levelDesc='$t_strLevelDesc'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strLevelCode=$row['t_strLevelCode'];
			   $t_strLevelDesc=$row['t_strLevelDesc'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblEducationalLevel SET levelCode='$t_strLevelCode', levelDesc='$t_strLevelDesc' WHERE levelCode='$t_strOldLevelCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Educational Level not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
} 

	function deleteEducationalLevel($strEmpNmbr, $t_strLevelCode, $t_strLevelDesc, $Submit) //Delete level code and description
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEducationalLevel WHERE levelCode='$t_strLevelCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	} 
	
	function viewEducationalLevel($strEmpNmbr, $t_strLevelCode, $t_strLevelDesc) //View list of level code and type
    {
	     $viewResults = mysql_query("SELECT * FROM tblEducationalLevel");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
			 $t_strLevelCode=$row["levelCode"];
			 $t_strLevelDesc=$row["LevelDesc"];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\">";
			 echo "<td>LEVEL CODE</td><td>LEVEL DESCRIPTION</td></tr>";
			 echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
			 do 
			 {
				$t_strLevelCode=$row["levelCode"];
				$t_strLevelDesc=$row["levelDesc"];
				echo "<tr class=\"border\"><td>" . $row["levelCode"] . "</td>";
				echo "<td>" . $row["levelDesc"] . "</td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"2\">&nbsp;</td></tr></table>";
        	}
	} 
} 
?> 