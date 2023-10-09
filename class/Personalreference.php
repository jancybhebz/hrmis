<?php 
/* 
File Name: Personalreference.php (class folder)
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
Date of Revision: March 05, 2004 (Version 2.0.0)
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
class Personalreference extends General
{

	function personalReference() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   	
	function addReference($t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $Submit)   //Add employee reference
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblEmpReference (empNumber, refName, refAddress, refTelephone) VALUES ('$t_strEmpNumber', '$t_strRefName', '$t_strRefAddress', '$t_intRefTelephone')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee character reference not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editReference($txtSearch, $t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $Submit, $t_strOldRefName, $t_strOldEmpNumber) //edit employee reference
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpReference WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strRefName=$row['refName'];
			   $t_strRefAddress=$row['refAddress'];
			   $t_intRefTelephone=$row['refTelephone'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblEmpReference SET empNumber='$t_strEmpNumber', refName='$t_strRefName', refAddress='$t_strRefAddress', refTelephone='$t_intRefTelephone' WHERE  refName='$t_strOldRefName'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee reference not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
		function deleteReference($t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $Submit) //Delete employee reference
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpReference WHERE refName='$t_strRefName' AND refAddress='$t_strRefAddress' AND refTelephone='$t_intRefTelephone'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewReference($txtSearch, $optField, $p, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $t_strEmpNumber) //View list of reference
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpReference WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo " ";
		 } else {
		     $t_strEmpNumber=$row['empNumber'];
			 $t_strRefName=$row['refName'];
			 $t_strRefAddress=$row['refAddress'];
			 $t_intRefTelephone=$row['refTelephone'];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr><td class=\"alterrow\" colspan=\"5\">REFERENCES (Persons not related by consanguinity or affinity to applicant/appointee)</td></tr>";
             echo "<tr class=\"alterrow\"><td width=\"28%\">Name of Reference</td>";
             echo "<td width=\"36%\">Address</td><td>Telephone</td><td colspan=\"2\">&nbsp;</td></tr>";
             echo "<tr><td colspan=\"5\">&nbsp;</td></tr>";
			 do 
			 {
		        $t_strEmpNumber=$row['empNumber'];
			    $t_strRefName=$row['refName'];
			    $t_strRefAddress=$row['refAddress'];
			    $t_intRefTelephone=$row['refTelephone'];
             echo "<tr class=\"border\"><td>" . $row['refName'] . "</td>";
             echo "<td>" . $row['refAddress'] . "</td>";
             echo "<td width=\"17%\">" . $row['refTelephone'] . "</td>";
             echo "<td width=\"9%\"><a href=\"Personalreference.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strRefName=$t_strRefName&t_strRefAddress=$t_strRefAddress&t_intRefTelephone=$t_intRefTelephone&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
             echo "<td width=\"10%\"><a href=\"Personalreference.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strRefName=$t_strRefName&t_strRefAddress=$t_strRefAddress&t_intRefTelephone=$t_intRefTelephone&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"5\">&nbsp;</td></tr></table>";
			}
	} 
}
?>