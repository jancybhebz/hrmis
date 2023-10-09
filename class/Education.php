<?php 
/* 
File Name: Education.php (class folder)
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
Date of Revision: November 17, 2003
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
class Education extends General
{

	function Education() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function addEducation($t_strEmpNumber, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_strUnits, $t_strSchoolFromMonth, $t_strSchoolFromDay, $t_strSchoolFromYear, $t_strSchoolToMonth, $t_strSchoolToDay, $t_strSchoolToYear, $t_strHonors, $Submit)   //Add employee educational attainment
   {
      if ($Submit == 'ADD')
	  {
 		 $t_strSchoolFromDate = $this->combineDate($t_strSchoolFromYear, $t_strSchoolFromMonth, $t_strSchoolFromDay);
 		 $t_strSchoolToDate = $this->combineDate($t_strSchoolToYear, $t_strSchoolToMonth, $t_strSchoolToDay);
	     $results = "INSERT INTO tblEmpSchool (empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strLevelCode', '$t_strSchoolName', '$t_strCourse', '$t_strUnits', '$t_strSchoolFromDate', '$t_strSchoolToDate', '$t_strHonors')";
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
	
	function editEducation($t_strEmpNumber, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_strUnits, $t_strSchoolFromMonth, $t_strSchoolFromDay, $t_strSchoolFromYear, $t_strSchoolToMonth, $t_strSchoolToDay, $t_strSchoolToYear, $t_strHonors, $Submit, $t_strOldSchoolName, $t_strOldLevelCode, $t_strOldSchoolFromMonth, $t_strOldSchoolFromDay, $t_strOldSchoolFromYear, $t_strOldSchoolToMonth, $t_strOldSchoolToDay, $t_strOldSchoolToYear)   //Edit employee educational attainment
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
			   $t_strUnits=$row['units'];
			   $t_strHonors=$row['honors'];
			   $t_strSchoolFromDate=$row['schoolFromDate'];
			   $t_strSchoolToDate=$row['schoolToDate'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
 		 	 $t_strSchoolFromDate = $this->combineDate($t_strSchoolFromYear, $t_strSchoolFromMonth, $t_strSchoolFromDay);
 		 	 $t_strSchoolToDate = $this->combineDate($t_strSchoolToYear, $t_strSchoolToMonth, $t_strSchoolToDay);
			 $updateResults = "UPDATE tblEmpSchool SET empNumber='$t_strEmpNumber', levelCode='$t_strLevelCode', schoolName='$t_strSchoolName', course='$t_strCourse', units='$t_strUnits', honors='$t_strHonors', schoolFromDate='$t_strSchoolFromDate', schoolToDate='$t_strSchoolToDate' WHERE  schoolName='$t_strOldSchoolName' AND levelCode='$t_strOldLevelCode'";
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
	
		function deleteEducation($t_strEmpNumber, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_strUnits, $t_strSchoolFromMonth, $t_strSchoolFromDay, $t_strSchoolFromYear, $t_strSchoolToMonth, $t_strSchoolToDay, $t_strSchoolToYear, $t_strHonors, $Submit) //Delete employee educational attainment
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpSchool WHERE schoolName='$t_strSchoolName' AND units='$t_strUnits' AND honors='$t_strHonors'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewEducation($txtSearch, $optField, $p, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_strUnits, $t_strSchoolFromMonth, $t_strSchoolFromDay, $t_strSchoolFromYear, $t_strSchoolToMonth, $t_strSchoolToDay, $t_strSchoolToYear, $t_strHonors, $t_strEmpNumber) //View list of employee educational attainment
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpSchool WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strLevelCode=$row['levelCode'];
			   $t_strSchoolName=$row['schoolName'];
			   $t_strCourse=$row['course'];
			   $t_strUnits=$row['units'];
			   $t_strHonors=$row['honors'];
			   $t_strSchoolFromDate=$row['schoolFromDate'];
			   $t_strSchoolToDate=$row['schoolToDate'];
			 echo "<table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"title\"><td width=\"32%\" class=\"border\">School Name</td>";
			 echo "<td width=\"28%\" class=\"border\">Course</td>";
			 echo "<td width=\"22%\" class=\"border\">Units</td>";
			 echo "<td width=\"8%\" class=\"border\">&nbsp;</td>";
			 echo "<td width=\"10%\" class=\"border\">&nbsp;</td></tr>";
			 do 
			 {
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strLevelCode=$row['levelCode'];
			   $t_strSchoolName=$row['schoolName'];
			   $t_strCourse=$row['course'];
			   $t_strUnits=$row['units'];
			   $t_strHonors=$row['honors'];
			   $t_strSchoolFromDate=$row['schoolFromDate'];
			   $t_strSchoolToDate=$row['schoolToDate'];
				echo "<tr class=\"border\"><td class=\"border\">" . $row['schoolName'] . "</td>";
				echo "<td class=\"border\">" . $row['course'] . "</td>";
				echo "<td class=\"border\">" . $row['units'] . "</td>";
				echo "<td class=\"border\"><a href=\"Education.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strLevelCode=$t_strLevelCode&t_strSchoolName=$t_strSchoolName&t_strCourse=$t_strCourse&t_strUnits=$t_strUnits&t_strHonors=$t_strHonors&t_strSchoolFromDate=$t_strSchoolFromDate&t_strSchoolToDate=$t_strSchoolToDate&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>"; 
				echo "<td class=\"border\"><a href=\"Education.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strLevelCode=$t_strLevelCode&t_strSchoolName=$t_strSchoolName&t_strCourse=$t_strCourse&t_strUnits=$t_strUnits&t_strHonors=$t_strHonors&t_strSchoolFromDate=$t_strSchoolFromDate&t_strSchoolToDate=$t_strSchoolToDate&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr class=\"border\"><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
				echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
				echo "<td class=\"border\">&nbsp;</td></tr></table>";        
			}
	} 
		
}
?>