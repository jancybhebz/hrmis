<?php 
/* 
File Name: Children.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employee's personal data.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: November 06, 2003
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
require("../hrmis/class/General.php");
class Children extends General
{

	function Children() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
 	
	function addChild($t_strEmpNumber, $t_strChildName, $t_strChildBirthMonth, $t_strChildBirthDay, $t_strChildBirthYear, $Submit)   //Add employee children information
   {
      if ($Submit == 'ADD')
	  {
	     $t_strChildBirthDate = $this->combineDate($t_strChildBirthYear, $t_strChildBirthMonth, $t_strChildBirthDay);
	     $results = "INSERT INTO tblEmpChild (empNumber, childName, childBirthDate) VALUES ('$t_strEmpNumber', '$t_strChildName', '$t_strChildBirthDate')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee Personal Data not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editChild($txtSearch, $optField, $p, $t_strEmpNumber, $t_strChildName, $t_strChildBirthMonth, $t_strChildBirthDay, $t_strChildBirthYear, $Submit, $t_strOldChildName, $t_strOldChildBirthMonth, $t_strOldChildBirthDay, $t_strOldChildBirthYear) //edit employee children information
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpChild WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {	     
		    do 
			{

		       $t_strEmpNumber=$row['empNumber'];
			   $t_strChildName=$row['childName'];
			   $t_strChildBirthDate=$row['childBirthDate'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){
		
		$t_strChildBirthDate = $this->combineDate($t_strChildBirthYear, $t_strChildBirthMonth, $t_strChildBirthDay);
			 $updateResults = "UPDATE tblEmpChild SET empNumber='$t_strEmpNumber', childName='$t_strChildName', childBirthDate='$t_strChildBirthDate' WHERE childName='$t_strOldChildName'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee child info not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
	function deleteChild($t_strEmpNumber, $t_strChildName, $t_strChildBirthMonth, $t_strChildBirthDay, $t_strChildBirthYear, $Submit) //Delete employee children information 
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpChild WHERE childName='$t_strChildName'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewChild($txtSearch, $optField, $p, $t_strChildName, $t_strChildBirthDate, $t_strEmpNumber) //View list of employee children information
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpChild WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
			 $t_strEmpNumber=$row["empNumber"];
			 $t_strChildName=$row["childName"];
			 $t_strChildBirthDate=$row["childBirthDate"];
			 echo "<table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr>";
			 echo "<td colspan=\"4\" class=\"border\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			 echo "<tr><td width=\"32%\" class=\"title\">CHILD NAME</td>";
			 echo "<td width=\"37%\" class=\"title\">BIRTHDATE</td><td width=\"31%\">&nbsp;</td>";
			 echo "</tr></table></td></tr>";
			 do 
			 {
			    $t_strEmpNumber=$row["empNumber"];
			    $t_strChildName=$row["childName"];
			    $t_strChildBirthDate=$row["childBirthDate"];
				echo "<tr><td width=\"32%\" class=\"border\">" . $row['childName'] . "</td>";
				echo "<td width=\"37%\" class=\"border\">" . $row['childBirthDate'] . "</td>";
				echo "<td width=\"16%\" class=\"border\">";
				echo "<a href=\"Children.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strChildName=$t_strChildName&t_strChildBirthDate=$t_strChildBirthDate&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"15%\" class=\"border\">";
				echo "<a href=\"Children.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strChildName=$t_strChildName&t_strChildBirthDate=$t_strChildBirthDate&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
				echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td></tr>";
				echo "</table>"; 
         }
	}
	
}
?>