<?php 
/* 
File Name: Personaleducation.php (class folder)
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
class Personaleducation extends General
{

	function personalEducation() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function addEducation($strEmpNmbr, $t_strEmpNumber, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_intUnits, $t_dtmSchoolFromMonth, $t_dtmSchoolFromDay, $t_dtmSchoolFromYear, $t_dtmSchoolToMonth, $t_dtmSchoolToDay, $t_dtmSchoolToYear, $t_strHonors, $Submit)   //Add employee educational attainment
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmSchoolFromDate = $this->combineDate($t_dtmSchoolFromYear, $t_dtmSchoolFromMonth, $t_dtmSchoolFromDay);
 		 $t_dtmSchoolToDate = $this->combineDate($t_dtmSchoolToYear, $t_dtmSchoolToMonth, $t_dtmSchoolToDay);
		 if ($t_strLevelCode == 'CLG' || $t_strLevelCode == 'MA/MS' || $t_strLevelCode == 'Ph.D.') 
		 {
		
			 if ($t_strHonors != "") {
			 $results = "INSERT INTO tblEmpSchool (empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strLevelCode', '$t_strSchoolName', '$t_strCourse', '$t_intUnits', '$t_dtmSchoolFromDate', '$t_dtmSchoolToDate', '$t_strHonors')";
			 } else {
			 $t_strHonors = "none";
			 $results = "INSERT INTO tblEmpSchool (empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strLevelCode', '$t_strSchoolName', '$t_strCourse', '$t_intUnits', '$t_dtmSchoolFromDate', '$t_dtmSchoolToDate', '$t_strHonors')";
			}
		
		} else {
			 if ($t_strHonors != "") {
			 $results = "INSERT INTO tblEmpSchool (empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strLevelCode', '$t_strSchoolName', '$t_strCourse', '$t_intUnits', '$t_dtmSchoolFromDate', '$t_dtmSchoolToDate', '$t_strHonors')";
			 } else {
			 $t_strHonors = "none";
			 $results = "INSERT INTO tblEmpSchool (empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strLevelCode', '$t_strSchoolName', '$t_strCourse', '$t_intUnits', '$t_dtmSchoolFromDate', '$t_dtmSchoolToDate', '$t_strHonors')";
			}
		
		
		}
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee educational attainment not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editEducation($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strEmpNumber, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_intUnits, $t_dtmSchoolFromMonth, $t_dtmSchoolFromDay, $t_dtmSchoolFromYear, $t_dtmSchoolToMonth, $t_dtmSchoolToDay, $t_dtmSchoolToYear, $t_strHonors, $Submit, $t_strOldSchoolName, $t_strOldLevelCode, $t_dtmOldSchoolFromMonth, $t_dtmOldSchoolFromDay, $t_dtmOldSchoolFromYear, $t_dtmOldSchoolToMonth, $t_dtmOldSchoolToDay, $t_dtmOldSchoolToYear)   //Edit employee educational attainment
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpSchool WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strLevelCode=$row['levelCode'];
			   $t_strSchoolName=$row['schoolName'];
			   $t_strCourse=$row['course'];
			   $t_intUnits=$row['units'];
			   $t_strHonors=$row['honors'];
			   $t_dtmSchoolFromDate=$row['schoolFromDate'];
			   $t_dtmSchoolToDate=$row['schoolToDate'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
 		 	 $t_dtmSchoolFromDate = $this->combineDate($t_dtmSchoolFromYear, $t_dtmSchoolFromMonth, $t_dtmSchoolFromDay);
 		 	 $t_dtmSchoolToDate = $this->combineDate($t_dtmSchoolToYear, $t_dtmSchoolToMonth, $t_dtmSchoolToDay);
			 $updateResults = "UPDATE tblEmpSchool SET empNumber='$t_strEmpNumber', levelCode='$t_strLevelCode', schoolName='$t_strSchoolName', course='$t_strCourse', units='$t_intUnits', honors='$t_strHonors', schoolFromDate='$t_dtmSchoolFromDate', schoolToDate='$t_dtmSchoolToDate' WHERE  empNumber = '$t_strEmpNumber' AND levelCode='$t_strLevelCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee educational attainment not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
		function deleteEducation($strEmpNmbr, $t_strEmpNumber, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_intUnits, $t_dtmSchoolFromMonth, $t_dtmSchoolFromDay, $t_dtmSchoolFromYear, $t_dtmSchoolToMonth, $t_dtmSchoolToDay, $t_dtmSchoolToYear, $t_strHonors, $Submit) //Delete employee educational attainment
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpSchool WHERE schoolName='$t_strSchoolName' AND units='$t_intUnits' AND honors='$t_strHonors'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewEducation($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_intUnits, $t_dtmSchoolFromMonth, $t_dtmSchoolFromDay, $t_dtmSchoolFromYear, $t_dtmSchoolToMonth, $t_dtmSchoolToDay, $t_dtmSchoolToYear, $t_strHonors, $t_strEmpNumber) //View list of employee educational attainment
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpSchool WHERE empNumber='$t_strEmpNumber' ORDER BY schoolFromDate ASC");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strLevelCode=$row['levelCode'];
			   $t_strLevel = $row['level'];
			   $t_strSchoolName=$row['schoolName'];
			   $t_strCourse=$row['course'];
			   $t_intUnits=$row['units'];
			   $t_strHonors=$row['honors'];
			   $t_dtmSchoolFromDate=$row['schoolFromDate'];
			   $t_dtmSchoolToDate=$row['schoolToDate'];
			 echo "<table width=\"99%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr><td colspan=\"9\" class=\"alterrow\">EDUCATIONAL ATTAINMENT</td></tr>";
             echo "<tr class=\"alterrow\"><td width=\"5%\">Level</td><td width=\"24%\">Name of</td>";
             echo "<td width=\"20%\">Degree/</td><td width=\"8%\">Units</td><td width=\"11%\">Honors</td>";
             echo "<td colspan=\"2\">Inclusive Dates</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
             echo "<tr class=\"alterrow\"><td>Code</td><td>School</td><td>Course</td><td>Earned</td>";
             echo "<td>Received</td><td width=\"10%\">From</td><td>To</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
             echo "<tr><td colspan=\"9\">&nbsp;</td></tr>";
			 do 
			 {
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strLevelCode=$row['levelCode'];
			   $t_strLevel = $row['level'];
			   $t_strSchoolName=$row['schoolName'];
			   $t_strCourse=$row['course'];
			   $t_intUnits=$row['units'];
			   $t_strHonors=$row['honors'];
			   $t_dtmSchoolFromDate=$row['schoolFromDate'];
			   $t_dtmSchoolToDate=$row['schoolToDate'];
             echo "<tr class=\"border\"><td>" . $row['levelCode'] . "</td>";
             echo "<td>" . $row['schoolName'] . "</td>";
             echo "<td>" . $row['course'] . "</td>";
             echo "<td>" . $row['units'] . "</td>";
             echo "<td>" . $row['honors'] . "</td>";
             echo "<td>" . $row['schoolFromDate'] . "</td>";
             echo "<td width=\"10%\">" . $row['schoolToDate'] . "</td>";
             echo "<td width=\"6%\"><a href=\"Personaleducation.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strLevelCode=$t_strLevelCode&t_strLevel=$t_strLevel&t_strSchoolName=$t_strSchoolName&t_strCourse=$t_strCourse&t_intUnits=$t_intUnits&t_strHonors=$t_strHonors&t_dtmSchoolFromDate=$t_dtmSchoolFromDate&t_dtmSchoolToDate=$t_dtmSchoolToDate&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
             echo "<td width=\"6%\"><a href=\"Personaleducation.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strLevelCode=$t_strLevelCode&t_strLevel=$t_strLevel&t_strSchoolName=$t_strSchoolName&t_strCourse=$t_strCourse&t_intUnits=$t_intUnits&t_strHonors=$t_strHonors&t_dtmSchoolFromDate=$t_dtmSchoolFromDate&t_dtmSchoolToDate=$t_dtmSchoolToDate&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"9\">&nbsp;</td></tr></table>";
			}
	} 
		
}
?>