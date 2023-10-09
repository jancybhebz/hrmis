<?php 
/* 
File Name: Employeeexaminations.php (class folder)
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
class Employeeexaminations extends General
{

	function employeeExaminations() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}

	function viewExamination($txtSearch, $optField, $p, $t_strExamCode, $t_dtmExamDate, $t_intExamRating, $t_strExamPlace,  $t_strLicenseNumber, $t_dtmDateRelease, $t_strEmpNumber)   //view list of employee's exmination
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
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"8\">&nbsp;</td></tr></table>";
			}
	} 
}
?>