<?php 
/* 
File Name: Studyleave.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view study leave and reporting days to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 10, 2003
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
class StudyLeave
{

var $strStudyLeave;
var $intReportingDays;

   function studyLeave() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addStudyLeave($t_strStudyLeave, $t_intReportingDays, $Submit) //Add study leave and reporting days
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblStudyLeave (studyLeave, reportingDays) VALUES ('$t_strStudyLeave', '$t_intReportingDays')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Study leave and reporting days not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return; 
	     } 
	  }
	}
	
	function editStudyLeave($t_strStudyLeave, $t_intReportingDays, $Submit, $t_strOldStudyLeave) //Add study leave and reporting days
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblStudyLeave WHERE studyLeave='$t_strStudyLeave' and reportingDays='$t_intReportingDays'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strStudyLeave=$row['studyLeave'];
			   $t_intReportingDays=$row['reportingDays'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblStudyLeave SET studyLeave='$t_strStudyLeave', reportingDays='$t_intReportingDays' WHERE studyLeave='$t_strOldStudyLeave'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Study leave and reporting days not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteStudyLeave($t_strStudyLeave, $t_intReportingDays, $Submit) //Delete study leave and reporting days
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblStudyLeave WHERE studyLeave='$t_strStudyLeave'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewStudyLeave($t_strStudyLeave, $t_intReportingDays) //View list of studyleave and reporting days
    {
	     $viewResults = mysql_query("SELECT * FROM tblStudyLeave");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {	
			 $t_strStudyLeave=$row["studyLeave"];
			 $t_intReportingDays=$row["reportingDays"];
			 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr>";
			 echo "<td colspan=\"4\" class=\"border\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			 echo "<tr><td width=\"32%\" class=\"title\">STUDY LEAVE</td>";
			 echo "<td width=\"37%\" class=\"title\">REPORTING DAYS</td><td width=\"31%\">&nbsp;</td>";
			 echo "</tr></table></td></tr>";
			 do 
			 {
				$t_strStudyLeave=$row["studyLeave"];
				$t_intReportingDays=$row["reportingDays"];
				echo "<tr><td width=\"32%\" class=\"border\">" . $row['studyLeave'] . "</td>";
				echo "<td width=\"37%\" class=\"border\">" . $row['reportingDays'] . "</td>";
				echo "<td width=\"16%\" class=\"border\">";
				echo "<a href=\"Studyleave.php?t_strStudyLeave=$t_strStudyLeave&t_intReportingDays=$t_intReportingDays&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"15%\" class=\"border\">";
				echo "<a href=\"Studyleave.php?t_strStudyLeave=$t_strStudyLeave&t_intReportingDays=$t_intReportingDays&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
				echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td></tr>";
				echo "</table>"; 
		 }
	}
}
?> 