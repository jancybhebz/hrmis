<?php 
/* 
File Name: Personalduties.php (class folder)
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
Date of Revision: June 21, 2004 (Version 2.0.0)
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
class Personalduties extends General
{

	function personalDuties() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}

	function addDuties($strEmpNmbr, $t_strEmpNumber, $t_intPercentWork, $t_strDuties, $Submit)   //Add employee duties and responsibilities
   {
      if ($Submit == 'ADD')
	  {
	     $objEmpDuties = "INSERT INTO tblEmpDuties(empNumber, percentWork, duties) VALUES ('$t_strEmpNumber', '$t_intPercentWork', '$t_strDuties')";
		 mysql_query($objEmpDuties) or die (mysql_error());
	     if(!$objEmpDuties) 
	     { 
            echo "<b>Employee duties and responsibilities not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($objEmpDuties) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
		function editDuties($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strEmpNumber, $t_intPercentWork, $t_strDuties, $Submit, $t_strOldDuties)   //Edit employee duties and responsibilities
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpDuties WHERE percentWork = '$t_intPercentWork' AND duties = '$t_strDuties' ");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
		     $t_strEmpNumber = $row['empNumber'];
			 $t_intPercentWork = $row['percentWork'];
			 $t_strDuties = $row['duties'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblEmpDuties SET empNumber='$t_strEmpNumber', percentWork = '$t_intPercentWork', duties = '$t_strDuties' WHERE empNumber='$t_strEmpNumber' AND duties = '$t_strOldDuties'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee duties and responsibilities not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
		function deleteDuties($strEmpNmbr, $t_strEmpNumber, $t_intPercentWork, $t_strDuties, $Submit)   //Delete employee duties and responsibilities
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpDuties WHERE percentWork='$t_intPercentWork' AND duties = '$t_strDuties'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewDuties($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_intPercentWork, $t_strDuties, $t_strEmpNumber)   //view employee duties and responsibilities
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpDuties WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
		     $t_strEmpNumber = $row['empNumber'];
			 $t_intPercentWork = $row['percentWork'];
			 $t_strDuties = $row['duties'];
			 echo "<table width=\"95%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"alterrow\">";
             echo "<td colspan=\"8\">EMPLOYEE DUTIES AND RESPONSIBILITIES</td></tr>";
             echo "<tr class=\"alterrow\"><td>Percent of Working Time</td><td>Duties and Responsibilities</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
             echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
			 do 
			 {
				 $t_strEmpNumber = $row['empNumber'];
				 $t_intPercentWork = $row['percentWork'];
				 $t_strDuties = $row['duties'];
				 echo "<tr class=\"border\"><td width=\"23%\">" . $row['percentWork'] . "</td>";
				 echo "<td width=\"38%\">" . $row['duties'] . "</td>";
				 echo "<td width=\"6%\"><a href=\"Personalduties.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strEmpNumber=$t_strEmpNumber&t_intPercentWork=$t_intPercentWork&t_strDuties=$t_strDuties&Submit=Edit\">Edit</a></td>";
				 echo "<td width=\"7%\"><a href=\"Personalduties.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strEmpNumber=$t_strEmpNumber&t_intPercentWork=$t_intPercentWork&t_strDuties=$t_strDuties&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";
			}
	} 
}
?>