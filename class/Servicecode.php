<?php 
/* 
File Name: Servicecode.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view service code and description to database.
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

class Service
{

//Service Code:

var $strServiceCode;
var $strServiceDesc;


   function service() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addServiceCode($strEmpNmbr, $t_strServiceCode, $t_strServiceDesc, $Submit) //Add service code and description
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblServiceCode (serviceCode, serviceDesc) VALUES ('$t_strServiceCode', '$t_strServiceDesc')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Service code and description not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editServiceCode($strEmpNmbr, $t_strServiceCode, $t_strServiceDesc, $Submit, $t_strOldServiceCode) //Add service code and description
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblServiceCode WHERE serviceCode='$t_strServiceCode' and serviceDesc='$t_strServiceDesc'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strServiceCode=$row['t_strServiceCode'];
			   $t_strServiceDesc=$row['t_strServiceDesc'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblServiceCode SET serviceCode='$t_strServiceCode', serviceDesc='$t_strServiceDesc' WHERE serviceCode='$t_strOldServiceCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Service code and description not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return; 
			 } 
	} 
} 

	function deleteServiceCode($strEmpNmbr, $t_strServiceCode, $t_strServiceDesc, $Submit) //Delete service code and description
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblServiceCode WHERE serviceCode='$t_strServiceCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	} 
	
	function viewServiceCode($strEmpNmbr, $t_strServiceCode, $t_strServiceDesc) //View list of service code and type
    {
	     $viewResults = mysql_query("SELECT * FROM tblServiceCode");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {
			 $t_strServiceCode=$row["serviceCode"];
			 $t_strServiceDesc=$row["serviceDesc"];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\">";
			 echo "<td width=\"32%\">SERVICE CODE</td>";
			 echo "<td width=\"42%\">SERVICE DESCRIPTION</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strServiceCode=$row["serviceCode"];
				$t_strServiceDesc=$row["serviceDesc"];
				echo "<tr class=\"border\">";
				echo "<td>" . $row["serviceCode"] . "</td>";
				echo "<td>" . $row["serviceDesc"] . "</td>";
				echo "<td width=\"13%\"><a href=\"Servicecode.php?strEmpNmbr=$strEmpNmbr&t_strServiceCode=$t_strServiceCode&t_strServiceDesc=$t_strServiceDesc&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"13%\"><a href=\"Servicecode.php?strEmpNmbr=$strEmpNmbr&t_strServiceCode=$t_strServiceCode&t_strServiceDesc=$t_strServiceDesc&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             	echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";
		 }
	} 
} 
?> 