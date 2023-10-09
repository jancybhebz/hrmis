<?php 
/* 
File Name: Requesttype.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view exam type & description to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: December 29, 2003
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
class RequestCode
{

var $strRequestCode;
var $strRequestDesc;

   function requestCode() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addRequestCode($strEmpNmbr, $t_strRequestCode, $t_strRequestDesc, $Submit) //Add request code and description
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblRequestType (requestCode, requestDesc) VALUES ('$t_strRequestCode', '$t_strRequestDesc')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Request Code and Type not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editRequestCode($strEmpNmbr, $t_strRequestCode, $t_strRequestDesc, $Submit, $t_strOldRequestCode) //Add Request code and description
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblRequestType WHERE requestCode='$t_strRequestCode' and requestDesc='$t_strRequestDesc'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strRequestCode=$row['requestCode'];
			   $t_strRequestDesc=$row['requestDesc'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblRequestType SET requestCode='$t_strRequestCode', requestDesc='$t_strRequestDesc' WHERE requestCode='$t_strOldRequestCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Request code and description not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteRequestCode($strEmpNmbr, $t_strRequestCode, $t_strRequestDesc, $Submit) //Delete Request code and description
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblRequestType WHERE requestCode='$t_strRequestCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewRequestCode($strEmpNmbr, $t_strRequestCode, $t_strRequestDesc) //View list of Request code and description
    {
	     $viewResults = mysql_query("SELECT * FROM tblRequestType");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {
			 $t_strRequestCode=$row["requestCode"];
			 $t_strRequestDesc=$row["requestDesc"];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\">";
			 echo "<td>REQUEST CODE</td>";
			 echo "<td>REQUEST TYPE</td></tr>";
			 echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
			 do 
			 {
				$t_strRequestCode=$row["requestCode"];
				$t_strRequestDesc=$row["requestDesc"];
				echo "<tr class=\"border\"><td>" . $row['requestCode'] . "</td>";
				echo "<td>" . $row['requestDesc'] . "</td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
			 	echo "<tr><td colspan=\"2\">&nbsp;</td></tr></table>";
		 }
	}
}
?> 