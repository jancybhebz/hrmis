<?php 
/* 
File Name: Personalotherinfo.php (class folder)
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
Date of Revision: March 18, 2004 (Version 2.0.0)
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
class Personalotherinfo extends General
{

	function personalOtherInfo() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}


// -------------------------  Skills/Recognition/Organization Information   -------------------------- //

	function editSkills($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSkills, $t_strNADR, $t_strMIAO, $t_strEmpNumber, $Submit, $t_strOldSkills)  //edit employee other information
    {
      if ($Submit == 'EDIT')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {	     
		    do 
			{
			$t_strSkills=$row["skills"];
			$t_strNADR=$row["nadr"];
			$t_strMIAO=$row["miao"];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){
			 $updateResults = "UPDATE tblEmpPersonal SET empNumber= '$t_strEmpNumber', skills='$t_strSkills', nadr='$t_strNADR', MIAO='$t_strMIAO' WHERE empNumber='$t_strEmpNumber' AND skills = '$t_strOldSkills'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee other info not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}

	function viewSkills($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSkills, $t_strNADR, $t_strMIAO, $t_strEmpNumber)  //View list of employee's other information
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
             echo "<tr class=\"td\"><td colspan=\"3\"><a href=\"Personalotherinfo.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strSkills=$t_strSkills&t_strNADR=$t_strNADR&t_strMIAO=$t_strMIAO&t_strEmpNumber=$t_strEmpNumber&Submit=EDIT\">EDIT</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "</table>";
         }
	}


 // -------------------------------  Character Reference   ----------------------------------  //
 	
	function addReference($strEmpNmbr, $t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_strRefTelephone, $Submit)   //Add employee reference
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblEmpReference (empNumber, refName, refAddress, refTelephone) VALUES ('$t_strEmpNumber', '$t_strRefName', '$t_strRefAddress', '$t_strRefTelephone')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee character reference not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editReference($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $Submit, $t_strOldRefName, $t_strOldEmpNumber) //edit employee reference
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpReference WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strRefName=$row['refName'];
			   $t_strRefAddress=$row['refAddress'];
			   $t_intRefTelephone=$row['refTelephone'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblEmpReference SET empNumber='$t_strEmpNumber', refName='$t_strRefName', refAddress='$t_strRefAddress', refTelephone='$t_intRefTelephone' WHERE  refName='$t_strOldRefName'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee reference not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
		function deleteReference($strEmpNmbr, $t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $Submit) //Delete employee reference
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpReference WHERE refName='$t_strRefName' AND refAddress='$t_strRefAddress' AND refTelephone='$t_intRefTelephone'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewReference($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $t_strEmpNumber) //View list of reference
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
             echo "<td>Telephone</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
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
			 echo "<td width=\"9%\"><a href=\"Personalotherinfo.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strRefName=$t_strRefName&t_strRefAddress=$t_strRefAddress&t_intRefTelephone=$t_intRefTelephone&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
			 echo "<td width=\"10%\"><a href=\"Personalotherinfo.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strRefName=$t_strRefName&t_strRefAddress=$t_strRefAddress&t_intRefTelephone=$t_intRefTelephone&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"5\">&nbsp;</td></tr></table>";
			}
	} 

 // -------------------------------  Legal Information   ----------------------------------  //

	function editLegalInfo($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strAdminCaseParticulars, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strIndigenous, $t_strIndigenousParticulars, $t_strDisabled, $t_strDisabledParticulars, $t_strSoloParent, $t_strSoloParentParticulars, $t_strEmpNumber, $Submit, $t_strOldEmpNumber, $t_strOldRelatedThird)   //Edit employee legal information
	{
      if ($Submit == 'Modify')
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
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
			 $updateResults = "UPDATE tblEmpPersonal SET empNumber='$t_strEmpNumber', relatedThird='$t_strRelatedThird', relatedFourth='$t_strRelatedFourth', relatedDegreeParticulars='$t_strRelatedDegreeParticulars', adminCase='$t_strAdminCase', adminCaseParticulars='$t_strAdminCaseParticulars', violateLaw='$t_strViolateLaw',  violateLawParticulars='$t_strViolateLawParticulars', forcedResign='$t_strForcedResign', forcedResignParticulars='$t_strForcedResignParticulars', candidate='$t_strCandidate', candidateParticulars='$t_strCandidateParticulars', indigenous='$t_strIndigenous', indigenousParticulars='$t_strIndigenousParticulars', disabled='$t_strDisabled', disabledParticulars='$t_strDisabledParticulars', soloParent='$t_strSoloParent', soloParentParticulars='$t_strSoloParentParticulars' WHERE empNumber='$t_strEmpNumber' AND relatedThird='$t_strOldRelatedThird' ";
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

	function viewLegalInfo($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strAdminCaseParticulars, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strIndigenous, $t_strIndigenousParticulars, $t_strDisabled, $t_strDisabledParticulars, $t_strSoloParent, $t_strSoloParentParticulars, $t_strEmpNumber)   //view employee Legal Information
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
               //echo "<p class=\"text\">&nbsp;</p>";
               //echo "<tr><td><hr></td></tr>";
               echo "<tr><td height=\"16\"><table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
               echo "<tr><td class=\"text\">Have you ever been a candidate in a national or local election (except Barangay election)?";
               echo "<span class=\"note\">" . $row['candidate'] . "<br></span>";
               echo "<span class=\"text\">If your answer is &quot;YES&quot;, give date of elections and other particulars <span class=\"note\">" . $row['candidateParticulars'] . "</span></span><br></td></tr></table></td></tr>";
               //echo "<p class=\"text\">&nbsp; </p>";
               //echo "<tr><td height=\"17\"><hr></td></tr>";
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
               echo "<tr><td class=\"td\"><a href=\"Personalotherinfo.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strRelatedThird=$t_strRelatedThird&t_strRelatedFourth=$t_strRelatedFourth&t_strRelatedDegreeParticulars=$t_strRelatedDegreeParticulars&t_strAdminCase=$t_strAdminCase&t_strAdminCaseParticulars=$t_strAdminCaseParticulars&t_strViolateLaw=$t_strViolateLaw&t_strViolateLawParticulars=$t_strViolateLawParticulars&t_strForcedResign=$t_strForcedResign&t_strForcedResignParticulars=$t_strForcedResignParticulars&t_strCandidate=$t_strCandidate&t_strCandidateParticulars=$t_strCandidateParticulars&t_strIndigenous=$t_strIndigenous&t_strIndigenousParticulars=$t_strIndigenousParticulars&t_strDisabled=$t_strDisabled&t_strDisabledParticulars=$t_strDisabledParticulars&t_strSoloParent=$t_strSoloParent&t_strSoloParentParticulars=$t_strSoloParentParticulars&t_strEmpNumber=$t_strEmpNumber&Submit=Modify\">Modify</a></td></tr>";
               echo "</tr></table>";
		 }	
	} 

//  --------------------------------------  Pledge    ----------------------------------  //

	function editPledge($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSignature, $t_dtmDateAccMonth, $t_dtmDateAccDay, $t_dtmDateAccYear, $t_strComTaxNumber, $t_strIssuedAt, $t_dtmIssuedOnMonth, $t_dtmIssuedOnDay, $t_dtmIssuedOnYear, $t_strEmpNumber, $Submit, $t_strOldComTaxNumber)  //edit employee's pledge
    {
      if ($Submit == 'Add/Modify')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {	     
		    do 
			{
			 $t_strSignature=$row["signature"];
			 $t_dtmDateAccomplished=$row["dateAccomplished"];
			 $t_strComTaxNumber=$row["comTaxNumber"];
			 $t_strIssuedAt=$row["issuedAt"];
			 $t_dtmIssuedOn=$row["issuedOn"];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){
			 $t_dtmDateAccomplished = $this->combineDate($t_dtmDateAccYear, $t_dtmDateAccMonth, $t_dtmDateAccDay);
			 $t_dtmIssuedOn = $this->combineDate($t_dtmIssuedOnYear, $t_dtmIssuedOnMonth, $t_dtmIssuedOnDay);
			 $updateResults = "UPDATE tblEmpPersonal SET empNumber='$t_strEmpNumber', signature='$t_strSignature', dateAccomplished='$t_dtmDateAccomplished', comTaxNumber='$t_strComTaxNumber', issuedAt='$t_strIssuedAt', issuedOn='$t_dtmIssuedOn' WHERE empNumber='$t_strEmpNumber' AND comTaxNumber='$t_strOldComTaxNumber'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee pledge not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}

	function viewPledge($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSignature, $t_dtmDateAccomplished, $t_strComTaxNumber, $t_strIssuedAt, $t_dtmIssuedOn, $t_strEmpNumber)  //View list of employee's pledge
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
			 echo "<table width=\"85%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
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
			 echo "<tr class=\"td\"><td colspan=\"2\"><a href=\"Personalotherinfo.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strSignature=$t_strSignature&t_dtmDateAccomplished=$t_dtmDateAccomplished&t_strComTaxNumber=$t_strComTaxNumber&t_strIssuedAt=$t_strIssuedAt&t_dtmIssuedOn=$t_dtmIssuedOn&t_strEmpNumber=$t_strEmpNumber&Submit=Add/Modify\">Add/Modify</a></td></tr></table>";
		}
	}
	
	
}   //  End of class session
?>