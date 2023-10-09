<?php 
/* 
File Name: Chiefprofile.php (class folder)
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
class Profile extends General
{

	function profile() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function editProfile($txtSearch, $optField, $p, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strSex, $t_strCivilStatus, $t_strMaidenName, $t_strSpouse, $t_strSpouseWork, $t_strBirthMonth, $t_strBirthDay, $t_strBirthYear, $t_strTin, $t_strCitizenship, $t_strBloodType, $t_strBirthPlace, $t_intHeight, $t_intWeight, $t_intCityNumber, $t_strCityStreet, $t_strCityBrgy, $t_strCityTown, $t_strCity, $t_intCityZipCode, $t_intProvNumber, $t_strProvStreet, $t_strProvBrgy, $t_strProvTown, $t_strProvince, $t_intProvZipCode, $t_strTelephone, $t_strMobile, $t_strEmail, $t_strFatherName, $t_strFatherBirthPlace, $t_strMotherName, $t_strMotherBirthPlace, $t_strSkills, $t_strQualifications, $t_strComTaxNumber, $t_strIssuedAt, $t_strIssuedOnMonth, $t_strIssuedOnDay, $t_strIssuedOnYear, $t_strGSISNumber, $t_strPagibigNumber, $t_strPhilHealthNumber, $t_strOplNumber1, $t_strOplNumber2, $t_strOplNumber3, $Submit, $t_strOldEmpNumber, $t_strOldSurname, $t_strOldBirthMonth, $t_strOldBirthDay, $t_strOldBirthYear, $t_strOldIssuedOnMonth, $t_strOldIssuedOnDay, $t_strOldIssuedOnYear)   //Edit employee profile
	{
      if ($Submit == 'EDIT')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			 $t_strEmpNumber=$row['empNumber'];
			 $t_strSurname=$row['surname'];
			 $t_strFirstname=$row['firstname'];
			 $t_strMiddlename=$row['middlename'];
			 $t_strSex=$row['sex'];
			 $t_strCivilStatus=$row['civilStatus'];
			 $t_strMaidenName=$row['maidenname'];
			 $t_strSpouse=$row['spouse'];
			 $t_strSpouseWork=$row['spouseWork'];
			 $t_strTin=$row['tin'];
			 $t_strCitizenship=$row['citizenship'];			 
			 $t_strBirthDate=$row['birthday'];
			 $t_strBirthPlace=$row['birthPlace'];
			 $t_strBloodType=$row['bloodType'];
			 $t_intHeight=$row['height'];
			 $t_intWeight=$row['weight'];
			 $t_intCityNumber=$row['cityNumber'];
			 $t_strCityStreet=$row['cityStreet'];
			 $t_strCityBrgy=$row['cityBrgy'];
			 $t_strCityTown=$row['cityTown'];
			 $t_strCity=$row['city'];
			 $t_intCityZipCode=$row['cityZipCode'];
			 $t_intProvNumber=$row['provNumber'];
			 $t_strProvStreet=$row['provStreet'];
			 $t_strProvBrgy=$row['provBrgy'];
			 $t_strProvTown=$row['provTown'];
			 $t_strProvince=$row['province'];
			 $t_intProvZipCode=$row['provZipCode'];
			 $t_strTelephone=$row['telephone'];
			 $t_strMobile=$row['mobile'];
			 $t_strEmail=$row['email'];
			 $t_strFatherName=$row['fatherName'];
			 $t_strFatherBirthPlace=$row['fatherBirthPlace'];
			 $t_strMotherName=$row['motherName'];
			 $t_strMotherBirthPlace=$row['motherBirthPlace'];
			 $t_strSkills=$row['skills'];
			 $t_strQualifications=$row['qualifications'];
			 $t_strComTaxNumber=$row['comTaxNumber'];
			 $t_strIssuedAt=$row['issuedAt'];
			 $t_strIssuedOn=$row['issuedOn'];
			 $t_strGSISNumber=$row['gsisNumber'];
			 $t_strPhilHealthNumber=$row['philHealthNumber'];
			 $t_strPagibigNumber=$row['pagibigNumber'];
			 $t_strOplNumber1=$row['oplNo1'];
			 $t_strOplNumber2=$row['oplNo2'];
			 $t_strOplNumber3=$row['oplNo3'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
			 $t_strBirthDate = $this->combineDate($t_strBirthYear, $t_strBirthMonth, $t_strBirthDay);
			 $t_strIssuedOn = $this->combineDate($t_strIssuedOnYear, $t_strIssuedOnMonth, $t_strIssuedOnDay);
			 $updateResults = "UPDATE tblEmpPersonal SET empNumber='$t_strEmpNumber', surname='$t_strSurname', firstname='$t_strFirstname', middlename='$t_strMiddlename', sex='$t_strSex', civilStatus='$t_strCivilStatus', maidenname='$t_strMaidenName', spouse='$t_strSpouse', spouseWork='$t_strSpouseWork', tin='$t_strTin', citizenship='$t_strCitizenship', birthday='$t_strBirthDate', birthPlace='$t_strBirthPlace', bloodType='$t_strBloodType', height='$t_intHeight', weight='$t_intWeight', cityNumber='$t_intCityNumber', cityStreet='$t_strCityStreet', cityBrgy='$t_strCityBrgy', cityTown='$t_strCityTown', city='$t_strCity', cityZipCode='$t_intCityZipCode', provNumber='$t_intProvNumber', provStreet='$t_strProvStreet', provBrgy='$t_strProvBrgy', provTown='$t_strProvTown', province='$t_strProvince', provZipCode='$t_intProvZipCode', telephone='$t_strTelephone', mobile='$t_strMobile', email='$t_strEmail', fatherName='$t_strFatherName', fatherBirthPlace='$t_strFatherBirthPlace', motherName='$t_strMotherName',motherBirthPlace='$t_strMotherBirthPlace', skills='$t_strSkills', qualifications='$t_strQualifications', comTaxNumber='$t_strComTaxNumber', issuedAt='$t_strIssuedAt', issuedOn='$t_strIssuedOn', gsisNumber='$t_strGSISNumber', philHealthNumber='$t_strPhilHealthNumber', pagibigNumber='$t_strPagibigNumber', oplNo1='$t_strOplNumber1', oplNo2='$t_strOplNumber2', oplNo3='$t_strOplNumber3' WHERE empNumber='$t_strOldEmpNumber'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee Personal Data not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function viewProfile($txtSearch, $optField, $p, $t_strSex, $t_strCivilStatus, $t_strMaidenName, $t_strSpouse, $t_strSpouseWork, $t_strBirthDate, $t_strTin, $t_strCitizenship, $t_strBloodType, $t_strBirthPlace, $t_intHeight, $t_intWeight, $t_intCityNumber, $t_strCityStreet, $t_strCityBrgy, $t_strCityTown, $t_strCity, $t_intCityZipCode, $t_intProvNumber, $t_strProvStreet, $t_strProvBrgy, $t_strProvTown, $t_strProvince, $t_intProvZipCode, $t_strTelephone, $t_strMobile, $t_strEmail, $t_strFatherName, $t_strFatherBirthPlace, $t_strMotherName, $t_strMotherBirthPlace, $t_strSkills, $t_strQualifications, $t_strComTaxNumber, $t_strIssuedAt, $t_strIssuedOn, $t_strGSISNumber, $t_strPagibigNumber, $t_strPhilHealthNumber, $t_strOplNumber1, $t_strOplNumber2, $t_strOplNumber3, $t_strEmpNumber)   //View employee profile
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
			 $t_strEmpNumber=$row['empNumber'];
			 $t_strSurname=$row['surname'];
			 $t_strFirstname=$row['firstname'];
			 $t_strMiddlename=$row['middlename'];
			 $t_strSex=$row['sex'];
			 $t_strCivilStatus=$row['civilStatus'];
			 $t_strMaidenName=$row['maidenname'];
			 $t_strSpouse=$row['spouse'];
			 $t_strSpouseWork=$row['spouseWork'];
			 $t_strTin=$row['tin'];
			 $t_strCitizenship=$row['citizenship'];			 
			 $t_strBirthDate=$row['birthday'];
			 $t_strBirthPlace=$row['birthPlace'];
			 $t_strBloodType=$row['bloodType'];
			 $t_intHeight=$row['height'];
			 $t_intWeight=$row['weight'];
			 $t_intCityNumber=$row['cityNumber'];
			 $t_strCityStreet=$row['cityStreet'];
			 $t_strCityBrgy=$row['cityBrgy'];
			 $t_strCityTown=$row['cityTown'];
			 $t_strCity=$row['city'];
			 $t_intCityZipCode=$row['cityZipCode'];
			 $t_intProvNumber=$row['provNumber'];
			 $t_strProvStreet=$row['provStreet'];
			 $t_strProvBrgy=$row['provBrgy'];
			 $t_strProvTown=$row['provTown'];
			 $t_strProvince=$row['province'];
			 $t_intProvZipCode=$row['provZipCode'];
			 $t_strTelephone=$row['telephone'];
			 $t_strMobile=$row['mobile'];
			 $t_strEmail=$row['email'];
			 $t_strFatherName=$row['fatherName'];
			 $t_strFatherBirthPlace=$row['fatherBirthPlace'];
			 $t_strMotherName=$row['motherName'];
			 $t_strMotherBirthPlace=$row['motherBirthPlace'];
			 $t_strSkills=$row['skills'];
			 $t_strQualifications=$row['qualifications'];
			 $t_strComTaxNumber=$row['comTaxNumber'];
			 $t_strIssuedAt=$row['issuedAt'];
			 $t_strIssuedOn=$row['issuedOn'];
			 $t_strGSISNumber=$row['gsisNumber'];
			 $t_strPhilHealthNumber=$row['philHealthNumber'];
			 $t_strPagibigNumber=$row['pagibigNumber'];
			 $t_strOplNumber1=$row['oplNo1'];
			 $t_strOplNumber2=$row['oplNo2'];
			 $t_strOplNumber3=$row['oplNo3'];
			// do {
			 echo "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
            echo "<tr><td class=\"header\"><div align=\"justify\"></div></td></tr>";
            echo "<tr><td height=\"332\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
            echo "<tr><td width=\"21%\" class=\"paragraph\">Gender :</td><td width=\"27%\" class=\"row\">" . $row['sex'] . "</td>";
			echo "<td width=\"22%\" class=\"paragraph\">Civil Status :</td><td width=\"30%\" class=\"row\">" . $row['civilStatus'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Maiden Name :</td><td class=\"row\">" . $row['maidenname'] . "</td><td class=\"paragraph\">TIN NO. :</td><td class=\"row\">" . $row['tin'] . "</td>";
            echo "</tr><tr><td class=\"paragraph\">Spouse Name :</td><td class=\"row\">" . $row['spouse'] . "</td>";
			echo "<td class=\"paragraph\">Ocupation :</td><td class=\"row\">" . $row['spouseWork'] . "</td></tr>";
			echo "<tr><td class=\"paragraph\">Birth Date :</td><td class=\"row\">" . $row['birthday'] . "</td>";
			echo "<td class=\"paragraph\">Birth Place :</td><td class=\"row\">" . $row['birthPlace'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Citizenship :</td><td class=\"row\">" . $row['citizenship'] . "</td>";
			echo "<td class=\"paragraph\">Blood Type :</td><td class=\"row\">" . $row['bloodType'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Height :</td><td class=\"row\">" . $row['height'] . "</td>";
			echo "<td class=\"paragraph\">Weight :</td><td class=\"row\">" . $row['weight'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">City Number :</td><td class=\"row\">" . $row['cityNumber'] . "</td>";
			echo "<td class=\"paragraph\">City Street :</td> <td class=\"row\">" . $row['cityStreet'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">City Brgy. :</td><td class=\"row\">" . $row['cityBrgy'] . "</td><td class=\"paragraph\">Town/Municipality :</td><td class=\"row\">" . $row['cityTown'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">City :</td><td class=\"row\">" . $row['city'] . "</td><td class=\"paragraph\">Zip Code :</td><td class=\"row\">" . $row['cityZipCode'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Provincial Number :</td><td class=\"row\">" . $row['provNumber'] . "</td><td class=\"paragraph\">Provincial Street :</td><td class=\"row\">" . $row['provStreet'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Provincial Brgy. :</td><td class=\"row\">" . $row['provBrgy'] . "</td><td class=\"paragraph\">Town/Municipality :</td><td class=\"row\">" . $row['provTown'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Provincial City : </td><td class=\"row\">" . $row['province'] . "</td><td class=\"paragraph\">Zip Code :</td><td class=\"row\">" . $row['provZipCode'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Home Telephone :</td><td class=\"row\">" . $row['telephone'] . "</td><td class=\"paragraph\">Mobile Number :</td><td class=\"row\">" . $row['mobile'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Father's Name :</td><td class=\"row\">" . $row['fatherName'] . "</td><td class=\"paragraph\">Birth Place :</td><td class=\"row\">" . $row['fatherBirthPlace'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Mother's Name :</td><td class=\"row\">" . $row['motherName'] . "</td><td class=\"paragraph\">Birth Place :</td><td class=\"row\">" . $row['motherBirthPlace'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Special Skills :</td><td class=\"row\">" . $row['skills'] . "</td><td class=\"paragraph\">Other Qualifications :</td><td class=\"row\">" . $row['qualifications'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Community Tax No. :</td><td class=\"row\">" . $row['comTaxNumber'] . "</td><td class=\"paragraph\">Issued At :</td><td class=\"row\">" . $row['issuedAt'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Issued On :</td><td class=\"row\">" . $row['issuedOn'] . "</td><td class=\"paragraph\">GSIS No. :</td><td class=\"row\">" . $row['gsisNumber'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">PHILHEALTH No. :</td><td class=\"row\">" . $row['philHealthNumber'] . "</td><td class=\"paragraph\">PAGIBIG No. :</td><td class=\"row\">" . $row['pagibigNumber'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">OPL No.1 :</td><td class=\"row\">" . $row['oplNo1'] . "</td><td class=\"paragraph\">OPL No.2 :</td><td class=\"row\">" . $row['oplNo2'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">OPL No.3 :</td><td class=\"row\">" . $row['oplNo3'] . "</td><td class=\"paragraph\">Email Address :</td><td class=\"row\">" . $row['email'] . "</td>";
			//echo "<td>&nbsp;</td><td>&nbsp;</td>";
			//echo "</tr>";
            //echo "<tr><td class=\"paragraph\">&nbsp;</td>";
			//echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
			echo "</tr></table>";
           //echo "<div align=\"center\"><a href=\"Profile.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strSurname=$t_strSurname&t_strFirstname=$t_strFirstname&t_strMiddlename=$t_strMiddlename&t_strSex=$t_strSex&t_strCivilStatus=$t_strCivilStatus&t_strMaidenName=$t_strMaidenName&t_strSpouse=$t_strSpouse&t_strSpouseWork=$t_strSpouseWork&t_strBirthDate=$t_strBirthDate&t_strTin=$t_strTin&t_strCitizenship=$t_strCitizenship&t_strBirthPlace=$t_strBirthPlace&t_strBloodType=$t_strBloodType&t_intHeight=$t_intHeight&t_intWeight=$t_intWeight&t_intCityNumber=$t_intCityNumber&t_strCityStreet=$t_strCityStreet&t_strCityBrgy=$t_strCityBrgy&t_strCityTown=$t_strCityTown&t_strCity=$t_strCity&t_intCityZipCode=$t_intCityZipCode&t_intProvNumber=$t_intProvNumber&t_strProvStreet=$t_strProvStreet&t_strProvBrgy=$t_strProvBrgy&t_strProvTown=$t_strProvTown&t_strProvince=$t_strProvince&t_intProvZipCode=$t_intProvZipCode&t_strTelephone=$t_strTelephone&t_strMobile=$t_strMobile&t_strEmail=$t_strEmail&t_strFatherName=$t_strFatherName&t_strFatherBirthPlace=$t_strFatherBirthPlace&t_strMotherName=$t_strMotherName&t_strMotherBirthPlace=$t_strMotherBirthPlace&t_strSkills=$t_strSkills&t_strQualifications=$t_strQualifications&t_strComTaxNumber=$t_strComTaxNumber&t_strIssuedAt=$t_strIssuedAt&t_strIssuedOn=$t_strIssuedOn&t_strGSISNumber=$t_strGSISNumber&t_strPhilHealthNumber=$t_strPhilHealthNumber&t_strPagibigNumber=$t_strPagibigNumber&t_strOplNumber1=$t_strOplNumber1&t_strOplNumber2=$t_strOplNumber2&t_strOplNumber3=$t_strOplNumber3&t_strEmpNumber=$t_strEmpNumber&Submit=EDIT\">EDIT</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			// }  while ($row = mysql_fetch_array($viewResults));
		   //echo "&nbsp;";
           //echo "</div></td></tr></table>";
		 }	
	} 
}
?>