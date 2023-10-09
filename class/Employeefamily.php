<?php 
/* 
File Name: Employeefamily.php (class folder)
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
Date of Revision: March 22, 2004 (Version 2.0.0)
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
class Employeefamily extends General
{

	function employeeFamily() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
 	
	function viewChild($txtSearch, $optField, $p, $t_strChildName, $t_strChildBirthDate, $t_strEmpNumber) //View list of employee children information
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpChild WHERE empNumber='$t_strEmpNumber' ORDER BY childBirthDate DESC");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
			 $t_strEmpNumber=$row["empNumber"];
			 $t_strChildName=$row["childName"];
			 $t_strChildBirthDate=$row["childBirthDate"];
			 echo "<table width=\"85%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr><td colspan=\"4\">&nbsp;</td></tr><tr class=\"alterrow\"><td>NAME OF CHILDREN</td>";
             echo "<td>DATE OF BIRTH</td>";
			 do 
			 {
			    $t_strEmpNumber=$row["empNumber"];
			    $t_strChildName=$row["childName"];
			    $t_strChildBirthDate=$row["childBirthDate"];
             	echo "<tr class=\"border\"><td width=\"44%\">" . $row['childName'] . "</td>";
            	echo "<td width=\"25%\">" . $row['childBirthDate'] . "</td>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
			 echo "</table>";
         }
	}

// -------------------------  Parent Information   ----------------------------------  //

	function viewParent($txtSearch, $optField, $p, $t_strFatherName, $t_strMotherName, $t_strParentAddress, $t_strEmpNumber)  //View list of employee's parent information
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber' ");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
			 $t_strFatherName=$row["fatherName"];
			 $t_strMotherName=$row["motherName"];
			 $t_strParentAddress=$row["parentAddress"];
			 echo "<table width=\"85%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
			 echo "<tr class=\"alterrow\"><td width=\"29%\">Name of Father</td>";
             echo "<td width=\"28%\">Name of Mother</td>";
             echo "<td width=\"43%\">Parent's Address</td></tr>";
             echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
			 do 
			 {
			 	$t_strFatherName=$row["fatherName"];
			 	$t_strMotherName=$row["motherName"];
			 	$t_strParentAddress=$row["parentAddress"];
             	echo "<tr class=\"border\"><td>" . $row['fatherName'] . "</td>";
             	echo "<td>" . $row['motherName'] . "</td>";
             	echo "<td>" . $row['parentAddress'] . "</td></tr>";
             	echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
			 echo "</table>";
         }
	}

//  --------------------------------------  Spouse Information    ----------------------------------  //

	function viewSpouse($txtSearch, $optField, $p, $t_strSpouse, $t_strSpouseWork, $t_strSpouseBusName, $t_strSpouseBusAddress, $t_intSpouseTelephone, $t_strEmpNumber)  //View list of employee's spouse information
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber' ");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
			 $t_strSpouse=$row["spouse"];
			 $t_strSpouseWork=$row["spouseWork"];
			 $t_strSpouseBusName=$row["spouseBusName"];
			 $t_strSpouseBusAddress=$row["spouseBusAddress"];
			 $t_intSpouseTelephone=$row["spouseTelephone"];
			 echo "<table width=\"85%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
             echo "<tr><td width=\"30%\" class=\"paragraph\">Name of Spouse :</td>";
             echo "<td width=\"70%\">&nbsp; ". $row['spouse'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">Occupation :</td>";
             echo "<td>&nbsp; ". $row['spouseWork'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">Employer/Business Name :</td>";
             echo "<td>&nbsp; ". $row['spouseBusName'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">Business Address :</td>";
             echo "<td>&nbsp; ". $row['spouseBusAddress'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">Telephone Number :</td>";
             echo "<td>&nbsp; ". $row['spouseTelephone'] . "</td></tr>";
             echo "<tr><td height=\"6\" colspan=\"2\">&nbsp;</td></tr>";
             echo "</table>";
		}
	}
	
}
?>