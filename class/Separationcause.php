<?php 
/* 
File Name: Separationcause.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view separation cause to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 24, 2003
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
class Separationcause
{

var $strSeparationCause;

   function separationCause() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addSeparationCause($strEmpNmbr, $t_strSeparationCause, $Submit) //Add Separation Cause
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblSeparationCause (separationCause) VALUES ('$t_strSeparationCause')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Separation Cause not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editSeparationCause($strEmpNmbr, $t_strSeparationCause, $Submit, $t_strOldSeparationCause) //Add separation cause
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblSeparationCause WHERE separationCause='$t_strSeparationCause'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strSeparationCause=$row['separationCause'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
			 $updateResults = "UPDATE tblSeparationCause SET separationCause='$t_strSeparationCause' WHERE separationCause='$t_strOldSeparationCause'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Separation Cause not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			if($modifyResults) 
			 { 
			 echo "<meta http-equiv=\"refresh\" content=\"0; url=Separationcause.php?strEmpNmbr=$strEmpNmbr\">";
			    return 1;
			 }  
	} 
} 

	function deleteSeparationCause($strEmpNmbr, $t_strSeparationCause, $Submit) //Delete separation cause
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblSeparationCause WHERE separationCause='$t_strSeparationCause'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	} 
	
	function viewSeparationCause($strEmpNmbr, $t_strSeparationCause) //View list of separation cause
    {
	     $viewResults = mysql_query("SELECT * FROM tblSeparationCause");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
			 $t_strSeparationCause=$row["separationCause"];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\">";
			 echo "<td width=\"72%\">SEPARATION CAUSE</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strSeparationCause=$row["separationCause"];
				echo "<tr class=\"border\">";
				echo "<td>" . $row["separationCause"] . "</td>";
				echo "<td width=\"14%\"><a href=\"Separationcause.php?strEmpNmbr=$strEmpNmbr&t_strSeparationCause=$t_strSeparationCause&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"14%\"><a href=\"Separationcause.php?strEmpNmbr=$strEmpNmbr&t_strSeparationCause=$t_strSeparationCause&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"3\">&nbsp;</td></tr></table>";
         }
	} 
} 
?> 