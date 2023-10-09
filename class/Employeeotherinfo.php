<?php 
/* 
File Name: Employeeotherinfo.php (class folder)
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
Date of Revision: March 23, 2004 (Version 2.0.0)
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
class Employeeotherinfo extends General
{

	function employeeOtherInfo() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}


// -------------------------  Skills/Recognition/Organization Information   -------------------------- //

	function viewSkills($txtSearch, $optField, $p, $t_strSkills, $t_strNADR, $t_strMIAO, $t_strEmpNumber)  //View list of employee's other information
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber' ");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
			$t_strSkills=$row["skills"];
			$t_strNADR=$row["nadr"];
			$t_strMIAO=$row["miao"];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
             echo "<tr class=\"alterrow\"><td width=\"33%\">Special Skills / Hobbies</td>";
             echo "<td width=\"34%\">Non-Academic Distinctions / Recognition</td>";
             echo "<td width=\"33%\">Membership in Association / Organization</td></tr>";
             echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
			 do 
			 {
			 	$t_strSkills=$row["skills"];
			 	$t_strNADR=$row["nadr"];
			 	$t_strMIAO=$row["miao"];
             echo "<tr class=\"border\"><td>" . $row['skills'] . "</td>";
             echo "<td>" . $row['nadr'] . "</td>";
             echo "<td>" . $row['miao'] . "</td></tr>";
             echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "</table>";
         }
	}


 // -------------------------------  Character Reference   ----------------------------------  //
 	
	function viewReference($txtSearch, $optField, $p, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $t_strEmpNumber) //View list of reference
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpReference WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo " ";
		 } else {
		     $t_strEmpNumber=$row['empNumber'];
			 $t_strRefName=$row['refName'];
			 $t_strRefAddress=$row['refAddress'];
			 $t_intRefTelephone=$row['refTelephone'];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr><td colspan=\"5\">&nbsp;</td></tr>";
             echo "<tr class=\"alterrow\"><td width=\"28%\">Name of Reference</td>";
             echo "<td width=\"36%\">Address</td>";
             echo "<td>Telephone</td></tr>";
             echo "<tr><td colspan=\"5\">&nbsp;</td></tr>";
			 do 
			 {
		        $t_strEmpNumber=$row['empNumber'];
			    $t_strRefName=$row['refName'];
			    $t_strRefAddress=$row['refAddress'];
			    $t_intRefTelephone=$row['refTelephone'];
             echo "<tr class=\"border\"><td>" . $row['refName'] . "</td>";
             echo "<td>" . $row['refAddress'] . "</td>";
			 echo "<td width=\"17%\">" . $row['refTelephone'] . "</td>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"5\">&nbsp;</td></tr></table>";
			}
	} 

 // -------------------------------  Legal Information   ----------------------------------  //

	function viewLegalInfo($txtSearch, $optField, $p, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strAdminCaseParticulars, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strIndigenous, $t_strIndigenousParticulars, $t_strDisabled, $t_strDisabledParticulars, $t_strSoloParent, $t_strSoloParentParticulars, $t_strEmpNumber)   //view employee Legal Information
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
			   $t_strAdminCaseParticulars=$row['adminCaseParticulars'];
			   $t_strViolateLaw=$row['violateLaw'];
			   $t_strViolateLawParticulars=$row['violateLawParticulars'];
			   $t_strForcedResign=$row['forcedResign'];
			   $t_strForcedResignParticulars=$row['forcedResignParticulars'];
			   $t_strCandidate=$row['candidate'];
			   $t_strCandidateParticulars=$row['candidateParticulars'];
			   $t_strIndigenous=$row['indigenous'];
			   $t_strIndigenousParticulars=$row['indigenousParticulars'];
			   $t_strDisabled=$row['disabled'];
			   $t_strDisabledParticulars=$row['disabledParticulars'];
			   $t_strSoloParent=$row['soloParent'];
			   $t_strSoloParentParticulars=$row['soloParentParticulars'];
				echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
                echo "<tr><td width=\"29%\" height=\"91\"><table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
                echo "<tr><td><span class=\"text\">Are you related by consanguinity or affinity to any of the following appointing authority, recommending authority, chief of office/bureau/department or person who has immediate supervision over you in the office, Bureau or Dapartment where you will be appointed? </span><br> <table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
                echo "<tr><td class=\"text\">Within the third degree (for NATIONAL GOVERNMENT Employees) ? " . "<span class=\"note\">" . $row['relatedThird'] . "<br></span>";
				echo "Within the fourth degree(for LOCAL GOVERNMENT Employees) ? " . "<span class=\"note\">" . $row['relatedThird'] . " <br></span>";
                echo "If your answer is &quot;YES&quot;, give particulars <span class=\"note\">" . $row['relatedDegreeParticulars'] . "</span></td></tr></table></td></tr></table></td></tr>";
                echo "<tr><td height=\"38\" class=\"text\"><table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
                echo "<tr><td class=\"text\">Have you ever been declared guilty of any administrative offense ? " . "<span class=\"note\">" . $row['adminCase'] . "<br></span>";
                echo "If your answer is &quot;YES&quot;, give details of offense <span class=\"note\">" . $row['adminCaseParticulars'] . "</span></td></tr></table></td></tr>";
               echo "<tr><td height=\"15\" class=\"text\"> <table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
               echo "<tr><td class=\"text\">Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulations by any court or tribunal? " . "<span class=\"note\">" . $row['violateLaw'] . "<br></span>";
               echo "If your answer is &quot;YES&quot;, give details of offense <span class=\"note\">" . $row['violateLawParticulars'] . "</span></td></tr></table></td></tr>";
               echo "<tr><td> <table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
               echo "<tr><td class=\"text\">Have you ever been forced to retire/resign or dropped from employment in the public or private sector?" . "<span class=\"note\">" . $row['forcedResign'] . "<br></span>";
               echo "<p class=\"text\">If your answer is &quot;YES&quot;, give reasons <span class=\"note\">" . $row['forcedResignParticulars'] . "</span> </p></td></tr></table></td></tr>";
               echo "<tr><td height=\"16\"><table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
               echo "<tr><td class=\"text\">Have you ever been a candidate in a national or local election (except Barangay election)?";
               echo "<span class=\"note\">" . $row['candidate'] . "<br></span>";
               echo "<span class=\"text\">If your answer is &quot;YES&quot;, give date of elections and other particulars <span class=\"note\">" . $row['candidateParticulars'] . "</span></span><br></td></tr></table></td></tr>";
               echo "<tr><td><table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
               echo "<tr><td><p class=\"text\">Pursuant to (a) indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972)</p><p class=\"text\">*please answer the following items</p></td></tr></table>";
               echo "<table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
               echo "<tr><td class=\"text\">a. Are you a member of any indigenous group?" . "<span class=\"note\">" . $row['indigenous'] . "<br></span></td>";
			   echo "<td class=\"text\">If you answer is &quot;YES&quot;, please specify<br><span class=\"note\">" . $row['indigenousParticulars'] . "</span></td></tr>";
               echo "<tr><td class=\"text\">b. Are you differently abled?" . "<span class=\"note\">" . $row['disabled'] . "<br></span></td>";
			   echo "<td class=\"text\">If you answer is &quot;YES&quot;, please specify<br><span class=\"note\">" . $row['disabledParticulars'] . "</span></td></tr>";
			   echo "<tr><td class=\"text\">c. Are you a solo parent?" . "<span class=\"note\">" . $row['soloParent'] . "<br></span></td>";
			   echo "<td class=\"text\">If you answer is &quot;YES&quot;, please specify<br><span class=\"note\">" . $row['soloParentParticulars'] . "</span> </td></tr></table></td></tr>";
			   echo "<tr><td>&nbsp;</td></tr>";
               echo "</tr></table>";
		 }	
	} 

//  --------------------------------------  Pledge    ----------------------------------  //

	function viewPledge($txtSearch, $optField, $p, $t_strSignature, $t_dtmDateAccomplished, $t_strComTaxNumber, $t_strIssuedAt, $t_dtmIssuedOn, $t_strEmpNumber)  //View list of employee's pledge
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber' ");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
			 $t_strSignature=$row["signature"];
			 $t_dtmDateAccomplished=$row["dateAccomplished"];
			 $t_strComTaxNumber=$row["comTaxNumber"];
			 $t_strIssuedAt=$row["issuedAt"];
			 $t_dtmIssuedOn=$row["issuedOn"];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td width=\"29%\" class=\"paragraph\">Signature :</td>";
			 echo "<td width=\"69%\">&nbsp; " . $row['signature'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">Date Accomplished :</td>";
             echo "<td>&nbsp; <span class=\"paragraph\">" . $row['dateAccomplished'] . "</span></td></tr>";
             echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td class=\"paragraph\">Community Tax Certificate :</td>";
             echo "<td>&nbsp; " . $row['comTaxNumber'] . "</td></tr>";
			 echo "<tr><td class=\"paragraph\">Issued At :</td>";
             echo "<td>&nbsp; " . $row['issuedAt'] . "</td></tr>";
			 echo "<tr><td class=\"paragraph\">Issued On :</td>";
			 echo "<td>&nbsp; <span class=\"paragraph\">" . $row['issuedOn'] . "</span></td></tr>";
			 echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
		}
	}
	
	
}   //  End of class session
?>