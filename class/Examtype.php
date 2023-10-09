<?php 
/* 
File Name: Examtype.php (class folder)
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
class ExamCode
{

var $strExamCode;
var $strExamDesc;

   function examCode() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addExamCode($strEmpNmbr, $t_strExamCode, $t_strExamDesc, $t_strExamType, $Submit) //Add exam code and description
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblExamType (examCode, examDesc, examType) VALUES ('$t_strExamCode', '$t_strExamDesc', '$t_strExamType')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Exam Code and Type not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editExamCode($strEmpNmbr, $t_strExamCode, $t_strExamDesc, $t_strExamType, $Submit, $t_strOldExamCode) //Add exam code and description
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblExamType WHERE examCode='$t_strExamCode' and examDesc='$t_strExamDesc'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strExamCode=$row['examCode'];
			   $t_strExamDesc=$row['examDesc'];
			   $t_strExamType=$row['examType'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblExamType SET examCode='$t_strExamCode', examDesc='$t_strExamDesc', examType='$t_strExamType' WHERE examCode='$t_strOldExamCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Exam code and description not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteExamCode($strEmpNmbr, $t_strExamCode, $t_strExamDesc, $t_strExamType, $Submit) //Delete exam code and description
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblExamType WHERE examCode='$t_strExamCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewExamCode($strEmpNmbr, $t_strExamCode, $t_strExamDesc, $t_strExamType) //View list of exam code and description
    {
	     $viewResults = mysql_query("SELECT * FROM tblExamType");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {
			 $t_strExamCode=$row["examCode"];
			 $t_strExamDesc=$row["examDesc"];
			 $t_strExamType=$row['examType'];
			 echo "<table width=\"95%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\">";
			 echo "<td width=\"25%\">EXAM CODE</td>";
			 echo "<td width=\"38%\">EXAM DESCRIPTION</td>";
			 echo "<td width=\"16%\">EXAM TYPE</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"5\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strExamCode=$row["examCode"];
				$t_strExamDesc=$row["examDesc"];
			 	$t_strExamType=$row['examType'];
				echo "<tr class=\"border\">";
				echo "<td>" . $row['examCode'] . "</td>";
				echo "<td>" . $row['examDesc'] . "</td>";
				echo "<td>" . $row['examType'] . "</td>";
				echo "<td width=\"10%\"><a href=\"Examtype.php?strEmpNmbr=$strEmpNmbr&t_strExamCode=$t_strExamCode&t_strExamDesc=$t_strExamDesc&t_strExamType=$t_strExamType&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"10%\"><a href=\"Examtype.php?strEmpNmbr=$strEmpNmbr&t_strExamCode=$t_strExamCode&t_strExamDesc=$t_strExamDesc&t_strExamType=$t_strExamType&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
			 	echo "<tr><td colspan=\"5\">&nbsp;</td></tr></table>";
		 }
	}
		
}	//  end of class 
?> 