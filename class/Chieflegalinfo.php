<?php 
/* 
File Name: Emplegalinfo.php (class folder)
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
class Legalinfo extends General
{

	function legalInfo() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function addLegalInfo($t_strEmpNumber, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strCrimeCase, $t_strDetailsOffense, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strAdminOffense, $t_strAdminOffenseParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $Submit)   //Add employee legal information
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblEmpPersonal (empNumber, relatedThird, relatedFourth, relatedDegreeParticulars, adminCase, crimeCase, detailsOffense, violateLaw, violateLawParticulars, adminOffense, adminOffenseParticulars, forcedResign, forcedResignParticulars, candidate, candidateParticulars) VALUES ('$t_strEmpNumber', '$t_strRelatedThird', '$t_strRelatedFourth', '$t_strRelatedDegreeParticulars', '$t_strAdminCase', '$t_strCrimeCase', '$t_strDetailsOffense', '$t_strViolateLaw', '$t_strViolateLawParticulars', '$t_strAdminOffense', '$t_strAdminOffenseParticulars', '$t_strForcedResign', '$t_strForcedResignParticulars', '$t_strCandidate', '$t_strCandidateParticulars')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee legal information not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editLegalInfo($txtSearch, $optField, $p, $t_strEmpNumber, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strCrimeCase, $t_strDetailsOffense, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strAdminOffense, $t_strAdminOffenseParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $Submit, $t_strOldRelatedThird, $t_strOldRelatedFourth, $t_strOldRelatedDegreeParticulars, $t_strOldAdminCase, $t_strOldCrimeCase, $t_strOldDetailsOffense, $t_strOldViolateLaw, $t_strOldViolateLawParticulars, $t_strOldAdminOffense, $t_strOldAdminOffenseParticulars, $t_strOldForcedResign, $t_strOldForcedResignParticulars, $t_strOldCandidate, $t_strOldCandidateParticulars)   //Edit employee legal information
	{
      if ($Submit == 'EDIT')
	 {
	     $results = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strEmpNumber=$row['empNumber'];
			   $t_strRelatedThird=$row['relatedThird'];
			   $t_strRelatedFourth=$row['relatedFourth'];
			   $t_strRelatedDegreeParticulars=$row['relatedDegreeParticulars'];
			   $t_strAdminCase=$row['adminCase'];
			   $t_strCrimeCase=$row['crimeCase'];
			   $t_strDetailsOffense=$row['detailsOffense'];
			   $t_strViolateLaw=$row['violateLaw'];
			   $t_strViolateLawParticulars=$row['violateLawParticulars'];
			   $t_strAdminOffense=$row['adminOffense'];
			   $t_strAdminOffenseParticulars=$row['adminOffenseParticulars'];
			   $t_strForcedResign=$row['forcedResign'];
			   $t_strForcedResignParticulars=$row['forcedResignParticulars'];
			   $t_strCandidate=$row['candidate'];
			   $t_strCandidateParticulars=$row['candidateParticulars'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblEmpPersonal SET empNumber='$t_strEmpNumber', relatedThird='$t_strRelatedThird', relatedFourth='$t_strRelatedFourth', relatedDegreeParticulars='$t_strRelatedDegreeParticulars', adminCase='$t_strAdminCase', crimeCase='$t_strCrimeCase', detailsOffense='$t_strDetailsOffense', violateLaw='$t_strViolateLaw',  violateLawParticulars='$t_strViolateLawParticulars', adminOffense='$t_strAdminOffense', adminOffenseParticulars='$t_strAdminOffenseParticulars', forcedResign='$t_strForcedResign', forcedResignParticulars='$t_strForcedResignParticulars', candidate='$t_strCandidate', candidateParticulars='$t_strCandidateParticulars' WHERE relatedDegreeParticulars='$t_strOldRelatedDegreeParticulars'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee legal information not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
	}

	function viewLegalInfo($txtSearch, $optField, $p, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strCrimeCase, $t_strDetailsOffense, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strAdminOffense, $t_strAdminOffenseParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strEmpNumber)   //view employee Legal Information
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
			   $t_strEmpNumber=$row['empNumber'];
			   $t_strRelatedThird=$row['relatedThird'];
			   $t_strRelatedFourth=$row['relatedFourth'];
			   $t_strRelatedDegreeParticulars=$row['relatedDegreeParticulars'];
			   $t_strAdminCase=$row['adminCase'];
			   $t_strCrimeCase=$row['crimeCase'];
			   $t_strDetailsOffense=$row['detailsOffense'];
			   $t_strViolateLaw=$row['violateLaw'];
			   $t_strViolateLawParticulars=$row['violateLawParticulars'];
			   $t_strAdminOffense=$row['adminOffense'];
			   $t_strAdminOffenseParticulars=$row['adminOffenseParticulars'];
			   $t_strForcedResign=$row['forcedResign'];
			   $t_strForcedResignParticulars=$row['forcedResignParticulars'];
			   $t_strCandidate=$row['candidate'];
			   $t_strCandidateParticulars=$row['candidateParticulars'];
				echo "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
				echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
				echo "<tr><td height=\"14\" class=\"paragraph\">Related Third :</td><td width=\"70%\">" . $row["relatedThird"] . "</td></tr>";
				echo "<tr><td height=\"14\" class=\"paragraph\">Related Fourth :</td><td>" . $row["relatedFourth"] . "</td></tr>";
				echo "<tr><td width=\"30%\" class=\"paragraph\"> Particulars : </td><td>" . $row["relatedDegreeParticulars"] . "</td></tr>";
				echo "<tr><td class=\"paragraph\">Administrative Case : </td><td>" . $row["adminCase"] . "</td></tr>";
				echo "<tr><td height=\"14\" class=\"paragraph\">Criminal Case :</td><td>" . $row["crimeCase"] . "</td></tr>";
				echo "<tr><td class=\"paragraph\">Details of Offense : </td><td>" . $row["detailsOffense"] . "</td></tr>";
				echo "<tr><td class=\"paragraph\">Violation Of Law : </td><td>" . $row["violateLaw"] . "</td></tr>";
				echo "<tr><td height=\"13\" class=\"paragraph\"> Particulars : </td><td>" . $row["violateLawParticulars"] . "</td></tr>";
				echo "<tr><td class=\"paragraph\">Administrative Offense : </td><td>" . $row["adminOffense"] . "</td></tr>";
				echo "<tr><td class=\"paragraph\"> Particulars : </td><td>" . $row["adminOffenseParticulars"] . "</td></tr>";
				echo "<tr><td class=\"paragraph\">Forced to Resign :</td><td>" . $row["forcedResign"] . "</td></tr>";
				echo "<tr><td class=\"paragraph\">Particulars : </td><td>" . $row["forcedResignParticulars"] . "</td></tr>";
				echo "<tr><td class=\"paragraph\">Candidate (National/Local) :</td><td>" . $row["candidate"] . "</td></tr>";
				echo "<tr><td class=\"paragraph\"> Particulars :</td><td>" . $row["candidateParticulars"] . "</td></tr>";
				echo "<tr><td colspan=\"2\">&nbsp;</td></tr><tr><td colspan=\"2\"><div align=\"center\" class=\"title\">";
			  // echo "<a href=\"Legalinfo.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strEmpNumber=$t_strEmpNumber&t_strRelatedThird=$t_strRelatedThird&t_strRelatedFourth=$t_strRelatedFourth&t_strRelatedDegreeParticulars=$t_strRelatedDegreeParticulars&t_strAdminCase=$t_strAdminCase&t_strCrimeCase=$t_strCrimeCase&t_strDetailsOffense=$t_strDetailsOffense&t_strViolateLaw=$t_strViolateLaw&t_strViolateLawParticulars=$t_strViolateLawParticulars&t_strAdminOffense=$t_strAdminOffense&t_strAdminOffenseParticulars=$t_strAdminOffenseParticulars&t_strForcedResign=$t_strForcedResign&t_strForcedResignParticulars=$t_strForcedResignParticulars&t_strCandidate=$t_strCandidate&t_strCandidateParticulars=$t_strCandidateParticulars&Submit=EDIT\">EDIT</a>&nbsp;&nbsp;";
			   echo "</div></td></tr></table>&nbsp;";
		 }	
	} 

}
?>