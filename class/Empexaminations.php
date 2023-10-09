<?php 
/* 
File Name: Empexaminations.php (class folder)
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
Date of Revision: December 19, 2003
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
class Examinations extends General
{

	function Examinations() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}

	function addEmployeeExam($t_strEmpNumber, $t_strExamCode, $t_strExamMonth, $t_strExamDay, $t_strExamYear, $t_intExamRating, $t_strExamPlace, $Submit)   //Add employee exmination
   {
      if ($Submit == 'ADD')
	  {
 		 $t_strExamDate = $this->combineDate($t_strExamYear, $t_strExamMonth, $t_strExamDay);
	     $results = "INSERT INTO tblEmpExam (empNumber, examCode, examDate, examRating, examPlace) VALUES ('$t_strEmpNumber', '$t_strExamCode', '$t_strExamDate', '$t_intExamRating', '$t_strExamPlace')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee Examination not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
		function editEmployeeExam($t_strExamCode, $t_strExamMonth, $t_strExamDay, $t_strExamYear, $t_intExamRating, $t_strExamPlace, $Submit, $t_strEmpNumber, $t_strOldExamCode, $t_strOldExamMonth, $t_strOldExamDay, $t_strOldExamYear) //edit employee examinations
    {
      if ($Submit == 'Edit')
	  {
	    // $t_strOldExamDate = $this->combineDate($t_strExamYear, $t_strExamMonth, $t_strExamDay);
	     $results = mysql_query("SELECT * FROM tblEmpExam WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
		     $t_strEmpNumber=$row['empNumber'];
			 $t_strExamCode=$row['examCode'];
			 $t_strExamDate=$row['examDate'];
			 $t_intExamRating=$row['examRating'];
			 $t_strExamPlace=$row['examPlace'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
		     $t_strExamDate = $this->combineDate($t_strExamYear, $t_strExamMonth, $t_strExamDay);
			 $updateResults = "UPDATE tblEmpExam SET empNumber='$t_strEmpNumber', examCode='$t_strExamCode', examDate='$t_strExamDate', examRating='$t_intExamRating', examPlace='$t_strExamPlace' WHERE examCode='$t_strOldExamCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee examination not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
		function deleteEmployeeExam($t_strEmpNumber, $t_strExamCode, $t_strExamDate, $t_intExamRating, $t_strExamPlace, $Submit) //Delete employee examination
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpExam WHERE empNumber='$t_strEmpNumber' AND examCode='$t_strExamCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewEmployeeExam($txtSearch, $optField, $p, $t_strExamCode, $t_strExamDate, $t_intExamRating, $t_strExamPlace, $t_strEmpNumber)   //view list of employee's exmination
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpExam INNER JOIN tblExamType ON tblEmpExam.examCode=tblExamType.examCode WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
		     $t_strEmpNumber=$row['empNumber'];
			 $t_strExamCode=$row['examCode'];
			 $t_strExamDate=$row['examDate'];
			 $t_intExamRating=$row['examRating'];
			 $t_strExamPlace=$row['examPlace'];
			 echo "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"title\"><td width=\"24%\" height=\"18\" class=\"border\">EXAM NAME</td>";
			 echo "<td width=\"22%\" class=\"border\">EXAM PLACE</td>";
			 echo "<td width=\"21%\" class=\"border\">EXAM RATING</td>";
			 echo "<td width=\"15%\" class=\"border\">EXAM DATE</td>";
			 //echo "<td width=\"9%\" class=\"border\">&nbsp;</td>";
			 //echo "<td width=\"9%\" class=\"border\">&nbsp;</td></tr>";
			 do 
			 {
		      	$t_strEmpNumber=$row['empNumber'];
			 	$t_strExamCode=$row['examCode'];
			 	$t_strExamDate=$row['examDate'];
			 	$t_intExamRating=$row['examRating'];
			 	$t_strExamPlace=$row['examPlace'];
				echo "<tr class=\"border\"><td class=\"border\">" . $row['examDesc'] . "</td>";
				echo "<td class=\"border\">" . $row['examPlace'] . "</td>";
				echo "<td class=\"border\">" . $row['examRating'] . "</td>";
				echo "<td class=\"border\">" . $row['examDate'] . "</td>";
				//echo "<td class=\"border\"><a href=\"Examinations.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strExamCode=$t_strExamCode&t_strExamDate=$t_strExamDate&t_strExamPlace=$t_strExamPlace&t_intExamRating=$t_intExamRating&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>"; 
				//echo "<td class=\"border\"><a href=\"Examinations.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strExamCode=$t_strExamCode&t_strExamDate=$t_strExamDate&t_strExamPlace=$t_strExamPlace&t_intExamRating=$t_intExamRating&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr class=\"border\"><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			//	echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
				echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td></tr></table>";
			}
	} 
}
?>