<?php 
/* 
File Name: Personalexaminations.php (class folder)
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
class Personalexaminations extends General
{

	function personalExaminations() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}

	function addExamination($strEmpNmbr, $t_strEmpNumber, $t_strExamCode, $t_dtmExamMonth, $t_dtmExamDay, $t_dtmExamYear, $t_intExamRating, $t_strExamPlace, $t_strLicenseNumber, $t_dtmDateReleaseMonth, $t_dtmDateReleaseDay, $t_dtmDateReleaseYear, $Submit)   //Add employee exmination
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmExamDate = $this->combineDate($t_dtmExamYear, $t_dtmExamMonth, $t_dtmExamDay);
 		 $t_dtmDateRelease = $this->combineDate($t_dtmDateReleaseYear, $t_dtmDateReleaseMonth, $t_dtmDateReleaseDay);
		 if ($t_strLicenseNumber == NULL || $t_strLicenseNumber == "not-applicable") 
		 {
		 $t_dtmDateRelease = "0000-00-00";
		 $t_strLicenseNumber = "not-applicable";
	     $results = "INSERT INTO tblEmpExam (empNumber, examCode, examDate, examRating, examPlace, licenseNumber, dateRelease) VALUES ('$t_strEmpNumber', '$t_strExamCode', '$t_dtmExamDate', '$t_intExamRating', '$t_strExamPlace', '$t_strLicenseNumber', '$t_dtmDateRelease')";
		 } else {
	     $results = "INSERT INTO tblEmpExam (empNumber, examCode, examDate, examRating, examPlace, licenseNumber, dateRelease) VALUES ('$t_strEmpNumber', '$t_strExamCode', '$t_dtmExamDate', '$t_intExamRating', '$t_strExamPlace', '$t_strLicenseNumber', '$t_dtmDateRelease')";		 
		 }
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee Examination information not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
		function editExamination($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strExamCode, $t_dtmExamMonth, $t_dtmExamDay, $t_dtmExamYear, $t_intExamRating, $t_strExamPlace, $t_strLicenseNumber, $t_dtmDateReleaseMonth, $t_dtmDateReleaseDay, $t_dtmDateReleaseYear, $Submit, $t_strEmpNumber, $t_strOldExamCode, $t_dtmOldExamMonth, $t_dtmOldExamDay, $t_dtmOldExamYear) //edit employee examinations
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpExam WHERE examCode = '$t_strExamCode' AND examPlace= '$t_strExamPlace' ");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
		     $t_strEmpNumber=$row['empNumber'];
			 $t_strExamCode=$row['examCode'];
			 $t_dtmExamDate=$row['examDate'];
			 $t_intExamRating=$row['examRating'];
			 $t_strExamPlace=$row['examPlace'];
			 $t_strLicenseNumber=$row['licenseNumber'];
			 $t_dtmDateRelease=$row['dateRelease'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
		     $t_dtmExamDate = $this->combineDate($t_dtmExamYear, $t_dtmExamMonth, $t_dtmExamDay);
 		 	 $t_dtmDateRelease = $this->combineDate($t_dtmDateReleaseYear, $t_dtmDateReleaseMonth, $t_dtmDateReleaseDay);

			 if ($t_strLicenseNumber == "not-applicable" || $t_strLicenseNumber == "") {
			 $t_strLicenseNumber = "not-applicable";
			 $t_dtmDateRelease = "0000-00-00";
			 $updateResults = "UPDATE tblEmpExam SET empNumber='$t_strEmpNumber', examCode='$t_strExamCode', examDate='$t_dtmExamDate', examRating='$t_intExamRating', examPlace='$t_strExamPlace', licenseNumber='$t_strLicenseNumber', dateRelease='$t_dtmDateRelease' WHERE empNumber='$t_strEmpNumber' AND examCode='$t_strOldExamCode'";
			 } else {
			 $updateResults = "UPDATE tblEmpExam SET empNumber='$t_strEmpNumber', examCode='$t_strExamCode', examDate='$t_dtmExamDate', examRating='$t_intExamRating', examPlace='$t_strExamPlace', licenseNumber='$t_strLicenseNumber', dateRelease='$t_dtmDateRelease' WHERE empNumber='$t_strEmpNumber' AND examCode='$t_strOldExamCode'";			 
			 }
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee examination information not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
		function deleteExamination($strEmpNmbr, $t_strEmpNumber, $t_strExamCode, $t_dtmExamDate, $t_intExamRating, $t_strExamPlace, $t_strLicenseNumber, $t_dtmDateRelease, $Submit) //Delete employee examination
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpExam WHERE examCode='$t_strExamCode' AND examPlace = '$t_strExamPlace'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewExamination($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strExamCode, $t_dtmExamDate, $t_intExamRating, $t_strExamPlace,  $t_strLicenseNumber, $t_dtmDateRelease, $t_strEmpNumber)   //view list of employee's exmination
    {
	     $viewResults = mysql_query("SELECT tblEmpExam.empNumber, tblEmpExam.examCode,
		 						tblEmpExam.examDate, tblEmpExam.examRating, 
								tblEmpExam.examPlace, tblEmpExam.licenseNumber,
								tblEmpExam.dateRelease, tblExamType.examCode, 
								tblExamType.examDesc 
							FROM tblEmpExam
								INNER JOIN tblExamType ON
								tblEmpExam.examCode=tblExamType.examCode
							WHERE tblEmpExam.empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
		     $t_strEmpNumber=$row['empNumber'];
			 $t_strExamCode=$row['examCode'];
			 $t_dtmExamDate=$row['examDate'];
			 $t_intExamRating=$row['examRating'];
			 $t_strExamPlace=$row['examPlace'];
			 $t_strLicenseNumber=$row['licenseNumber'];
			 $t_dtmDateRelease=$row['dateRelease'];
			 echo "<table width=\"95%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"alterrow\">";
             echo "<td colspan=\"8\">CAREER SERVICE / RA 1080 (BOARD/BAR) UNDER SPECIAL LAWS/CES/CSEE</td></tr>";
             echo "<tr class=\"alterrow\"><td>Exam Code</td><td>Place of Examination</td>";
             echo "<td>Exam Rating</td><td>Date of Examination</td><td width=\"14%\">License Number</td>";
             echo "<td width=\"12%\">Date of Release</td><td colspan=\"2\">&nbsp;</td></tr>";
             echo "<tr><td colspan=\"8\">&nbsp;</td></tr>";
			 do 
			 {
		     $t_strEmpNumber=$row['empNumber'];
			 $t_strExamCode=$row['examCode'];
			 $t_dtmExamDate=$row['examDate'];
			 $t_intExamRating=$row['examRating'];
			 $t_strExamPlace=$row['examPlace'];
			 $t_strLicenseNumber=$row['licenseNumber'];
			 $t_dtmDateRelease=$row['dateRelease'];
             echo "<tr class=\"border\"><td width=\"11%\">" . $row['examCode'] . "</td>";
             echo "<td width=\"25%\">" . $row['examPlace'] . "</td>";
             echo "<td width=\"12%\">" . $row['examRating'] . "</td>";
             echo "<td width=\"13%\">" . $row['examDate'] . "</td>";
             echo "<td>" . $row['licenseNumber'] . "</td>";
             echo "<td>" . $row['dateRelease'] . "</td>";
             echo "<td width=\"6%\"><a href=\"Personalexaminations.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strExamCode=$t_strExamCode&t_dtmExamDate=$t_dtmExamDate&t_strExamPlace=$t_strExamPlace&t_intExamRating=$t_intExamRating&t_strLicenseNumber=$t_strLicenseNumber&t_dtmDateRelease=$t_dtmDateRelease&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
             echo "<td width=\"7%\"><a href=\"Personalexaminations.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strExamCode=$t_strExamCode&t_dtmExamDate=$t_dtmExamDate&t_strExamPlace=$t_strExamPlace&t_intExamRating=$t_intExamRating&t_strLicenseNumber=$t_strLicenseNumber&t_dtmDateRelease=$t_dtmDateRelease&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"8\">&nbsp;</td></tr></table>";
			}
	} 
}
?>