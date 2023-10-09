<?php 
/* 
File Name: Personalfamily.php (class folder)
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
Date of Revision: March 10, 2004 (Version 2.0.0)
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
class Personalfamily extends General
{

	function personalFamily() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
 	
	function addChild($strEmpNmbr, $t_strEmpNumber, $t_strChildName, $t_strChildBirthMonth, $t_strChildBirthDay, $t_strChildBirthYear, $Submit)   //Add employee children information
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
	
	function editChild($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strEmpNumber, $t_strChildName, $t_strChildBirthMonth, $t_strChildBirthDay, $t_strChildBirthYear, $Submit, $t_strOldChildName, $t_strOldChildBirthMonth, $t_strOldChildBirthDay, $t_strOldChildBirthYear) //edit employee children information
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
	
	function deleteChild($strEmpNmbr, $t_strEmpNumber, $t_strChildName, $t_strChildBirthMonth, $t_strChildBirthDay, $t_strChildBirthYear, $Submit) //Delete employee children information 
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
	
	function viewChild($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strChildName, $t_strChildBirthDate, $t_strEmpNumber) //View list of employee children information
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
             echo "<td>DATE OF BIRTH</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td colspan=\"4\">&nbsp;</td></tr>";
			 do 
			 {
			    $t_strEmpNumber=$row["empNumber"];
			    $t_strChildName=$row["childName"];
			    $t_strChildBirthDate=$row["childBirthDate"];
             	echo "<tr class=\"border\"><td width=\"44%\">" . $row['childName'] . "</td>";
            	echo "<td width=\"25%\">" . $row['childBirthDate'] . "</td>";
				echo "<td width=\"16%\"><a href=\"Personalfamily.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strChildName=$t_strChildName&t_strChildBirthDate=$t_strChildBirthDate&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"15%\"><a href=\"Personalfamily.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strChildName=$t_strChildName&t_strChildBirthDate=$t_strChildBirthDate&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";
         }
	}

// -------------------------  Parent Information   ----------------------------------  //

	function editParent($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strFatherName, $t_strMotherName, $t_strParentAddress, $t_strEmpNumber, $Submit, $t_strOldFatherName, $t_strOldEmpNumber)  //edit employee parent's information
    {
      if ($Submit == 'EDIT')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {	     
		    do 
			{
			 $t_strFatherName=$row["fatherName"];
			 $t_strMotherName=$row["motherName"];
			 $t_strParentAddress=$row["parentAddress"];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){
			 $updateResults = "UPDATE tblEmpPersonal SET fatherName='$t_strFatherName', motherName='$t_strMotherName', parentAddress='$t_strParentAddress' WHERE empNumber = '$t_strEmpNumber' AND fatherName='$t_strOldFatherName'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee parent info not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}

	function viewParent($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strFatherName, $t_strMotherName, $t_strParentAddress, $t_strEmpNumber)  //View list of employee's parent information
    {
	     $viewResults = mysql_query("SELECT tblEmpPersonal.motherName, tblEmpPersonal.fatherName,
		 									tblEmpPersonal.parentAddress, tblEmpPosition.positionCode 
		 								FROM tblEmpPersonal 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										WHERE tblEmpPersonal.empNumber='$t_strEmpNumber' ");
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
             	echo "<tr><td height=\"17\" colspan=\"3\" class=\"td\"><a href=\"Personalfamily.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strFatherName=$t_strFatherName&t_strMotherName=$t_strMotherName&t_strParentAddress=$t_strParentAddress&t_strEmpNumber=$t_strEmpNumber&Submit=EDIT\">EDIT</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
			 echo "</table>";
         }
	}

//  --------------------------------------  Spouse Information    ----------------------------------  //

	function editSpouse($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSpouse, $t_strSpouseWork, $t_strSpouseBusName, $t_strSpouseBusAddress, $t_intSpouseTelephone, $t_strEmpNumber, $Submit, $t_strOldSpouse)  //edit employee's spouse information
    {
      if ($Submit == 'Add/Modify')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {	     
		    do 
			{
			 $t_strSpouse=$row["spouse"];
			 $t_strSpouseWork=$row["spouseWork"];
			 $t_strSpouseBusName=$row["spouseBusName"];
			 $t_strSpouseBusAddress=$row["spouseBusAddress"];
			 $t_intSpouseTelephone=$row["spouseTelephone"];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){
			 $updateResults = "UPDATE tblEmpPersonal SET spouse='$t_strSpouse', spouseWork='$t_strSpouseWork', spouseBusName='$t_strSpouseBusName', spouseBusAddress='$t_strSpouseBusAddress', spouseTelephone='$t_intSpouseTelephone' WHERE empNumber='$t_strEmpNumber' AND spouse='$t_strOldSpouse'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee spouse info not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}

	function viewSpouse($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSpouse, $t_strSpouseWork, $t_strSpouseBusName, $t_strSpouseBusAddress, $t_intSpouseTelephone, $t_strEmpNumber)  //View list of employee's spouse information
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
             echo "<tr><td height=\"6\" colspan=\"2\" class=\"td\"><a href=\"Personalfamily.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strSpouse=$t_strSpouse&t_strSpouseWork=$t_strSpouseWork&t_strSpouseBusName=$t_strSpouseBusName&t_strSpouseBusAddress=$t_strSpouseBusAddress&t_intSpouseTelephone=$t_intSpouseTelephone&t_strEmpNumber=$t_strEmpNumber&Submit=Add/Modify\">Add/Modify</a></td>";
             echo "</tr></table>";
		}
	}
	
}
?>