<?php 
/* 
File Name: Personalinformation.php (class folder)
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
class Personalinformation extends General
{

	function personalInformation() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function editProfile($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_dtmBirthMonth, $t_dtmBirthDay, $t_dtmBirthYear, $t_strBirthPlace, $t_strSex, $t_strCivilStatus, $t_strCitizenship, $t_intHeight, $t_intWeight, $t_strBloodType, $t_strGSISNumber, $t_intPagibigNumber, $t_intPhilHealthNumber, $t_strResidentialAddress, $t_intZipCode1, $t_intTelephone1, $t_strPermanentAddress, $t_intZipCode2, $t_intTelephone2, $t_strEmail, $t_intMobile, $t_strEmpNumber, $t_intTin, $Submit, $t_strOldEmpNumber, $t_strOldSurname, $t_strOldSurname, $t_strOldResidentialAddress)   //Edit employee profile
	{
      if ($Submit == 'EDIT')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			 $t_strSurname=$row['surname'];
			 $t_strFirstname=$row['firstname'];
			 $t_strMiddlename=$row['middlename'];
			 $t_dtmBirthDate=$row['birthday'];
			 $t_strBirthPlace=$row['birthPlace'];
			 $t_strSex=$row['sex'];
			 $t_strCivilStatus=$row['civilStatus'];
			 $t_strCitizenship=$row['citizenship'];			 
			 $t_intHeight=$row['height'];
			 $t_intWeight=$row['weight'];
			 $t_strBloodType=$row['bloodType'];
			 $t_strGSISNumber=$row['gsisNumber'];
			 $t_intPagibigNumber=$row['pagibigNumber'];
			 $t_intPhilHealthNumber=$row['philHealthNumber'];
			 $t_strResidentialAddress=$row['residentialAddress'];
			 $t_intZipCode1=$row['zipCode1'];
			 $t_intTelephone1=$row['telephone1'];
			 $t_strPermanentAddress=$row['permanentAddress'];
			 $t_intZipCode2=$row['zipCode2'];
			 $t_intTelephone2=$row['telephone2'];
			 $t_strEmail=$row['email'];
			 $t_intMobile=$row['mobile'];
			 $t_intTin=$row['tin'];
			 $t_strEmpNumber=$row['empNumber'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $t_dtmBirthDate = $this->combineDate($t_dtmBirthYear, $t_dtmBirthMonth, $t_dtmBirthDay);
			 $updateResults = "UPDATE tblEmpPersonal SET surname='$t_strSurname', firstname='$t_strFirstname', middlename='$t_strMiddlename', birthday='$t_dtmBirthDate', birthPlace='$t_strBirthPlace', sex='$t_strSex', civilStatus='$t_strCivilStatus', citizenship='$t_strCitizenship', tin='$t_strTin', height='$t_intHeight', weight='$t_intWeight', bloodType='$t_strBloodType', gsisNumber='$t_strGSISNumber', philHealthNumber='$t_intPhilHealthNumber', pagibigNumber='$t_intPagibigNumber', residentialAddress='$t_strResidentialAddress', zipCode1='$t_intZipCode1', telephone1='$t_intTelephone1', permanentAddress='$t_strPermanentAddress', zipCode2='$t_intZipCode2', telephone2='$t_intTelephone2', email='$t_strEmail', mobile='$t_intMobile', empNumber='$t_strEmpNumber', tin='$t_intTin' WHERE empNumber='$t_strEmpNumber' AND surname='$t_strOldSurname'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee Personal information not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function viewProfile($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_dtmBirthDate, $t_strBirthPlace, $t_strSex, $t_strCivilStatus, $t_strCitizenship, $t_intHeight, $t_intWeight, $t_strBloodType, $t_strGSISNumber, $t_intPagibigNumber, $t_intPhilHealthNumber, $t_strResidentialAddress, $t_intZipCode1, $t_intTelephone1, $t_strPermanentAddress, $t_intZipCode2, $t_intTelephone2, $t_strEmail, $t_intMobile, $t_strEmpNumber, $t_intTin, $filename)   //View employee profile
    {
		$viewResults = mysql_query("SELECT tblEmpPersonal.surname, tblEmpPersonal.firstname,
										tblEmpPersonal.middlename, tblEmpPersonal.birthday,
										tblEmpPersonal.birthPlace, tblEmpPersonal.sex,
										tblEmpPersonal.civilStatus, tblEmpPersonal.citizenship,
										tblEmpPersonal.height, tblEmpPersonal.weight,
										tblEmpPersonal.bloodType, tblEmpPersonal.gsisNumber,
										tblEmpPersonal.pagibigNumber, tblEmpPersonal.philHealthNumber, 
										tblEmpPersonal.residentialAddress, tblEmpPersonal.zipCode1,
										tblEmpPersonal.telephone1, tblEmpPersonal.permanentAddress,
										tblEmpPersonal.zipCode2, tblEmpPersonal.telephone2,
										tblEmpPersonal.email, tblEmpPersonal.mobile,
										tblEmpPersonal.empNumber, tblEmpPersonal.tin,
										tblEmpPosition.divisionCode, tblEmpPosition.positionCode,
										tblEmpPicture.filename
									FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition 
										ON tblEmpPersonal.empNumber=tblEmpPosition.empNumber
									LEFT JOIN tblEmpPicture
										ON tblEmpPersonal.empNumber=tblEmpPicture.empNumber
									WHERE tblEmpPersonal.empNumber = '$t_strEmpNumber'");					
		 if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
			 $t_strSurname=$row['surname'];
			 $t_strFirstname=$row['firstname'];
			 $t_strMiddlename=$row['middlename'];
			 $t_dtmBirthDate=$row['birthday'];
			 $t_strBirthPlace=$row['birthPlace'];
			 $t_strSex=$row['sex'];
			 $t_strCivilStatus=$row['civilStatus'];
			 $t_strCitizenship=$row['citizenship'];			 
			 $t_intHeight=$row['height'];
			 $t_intWeight=$row['weight'];
			 $t_strBloodType=$row['bloodType'];
			 $t_strGSISNumber=$row['gsisNumber'];
			 $t_intPagibigNumber=$row['pagibigNumber'];
			 $t_intPhilHealthNumber=$row['philHealthNumber'];
			 $t_strResidentialAddress=$row['residentialAddress'];
			 $t_intZipCode1=$row['zipCode1'];
			 $t_intTelephone1=$row['telephone1'];
			 $t_strPermanentAddress=$row['permanentAddress'];
			 $t_intZipCode2=$row['zipCode2'];
			 $t_intTelephone2=$row['telephone2'];
			 $t_strEmail=$row['email'];
			 $t_intMobile=$row['mobile'];
			 $t_intTin=$row['tin'];
			 $t_strEmpNumber=$row['empNumber'];
			 $filename=$row['filename'];
			echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"border\">";
            echo "<tr><td width=\"480\" height=\"73\"><table width=\"100%\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#99CCFF\">";
            echo "<tr><td width=\"141\" class=\"paragraph\">Employee Number : </td>";
            echo "<td width=\"339\"><strong>" . $row['empNumber'] . "</strong></td></tr>";  
            echo "<tr><td class=\"paragraph\">Employee Name :</td>";
            echo "<td><strong>" . $row['surname']  . ", " . $row['firstname'] . "  ". $row['middlename'] . "</strong></td></tr>";
            echo "<tr><td class=\"paragraph\">Division :</td><td><strong>" . $row['divisionCode'] . "</strong></td></tr>";
            echo "<tr><td class=\"paragraph\">Position : </td>";
            echo "<td><strong>" . $row['positionCode'] . "</strong></td></tr></table></td>";
            echo "<td width=\"72\" bgcolor=\"#99CCFF\">";
			echo "<img src='Getdata.php?t_strEmpNumber=$t_strEmpNumber'  width=\"70\" height=\"70\"></td></tr></table>";
			echo "<hr>";
			echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
            echo "<tr><td colspan=\"4\" class=\"title\"><a href=\"Personalpicture.php?strEmpNmbr=$strEmpNmbr&filename=$filename&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&filename=$filename&t_strSurname=$t_strSurname&t_strFirstname=$t_strFirstname&t_strMiddlename=$t_strMiddlename&t_dtmBirthDate=$t_dtmBirthDate&t_strBirthPlace=$t_strBirthPlace&t_strSex=$t_strSex&t_strCivilStatus=$t_strCivilStatus&t_strCitizenship=$t_strCitizenship&t_intHeight=$t_intHeight&t_intWeight=$t_intWeight&t_strBloodType=$t_strBloodType&t_strGSISNumber=$t_strGSISNumber&t_intPhilHealthNumber=$t_intPhilHealthNumber&t_intPagibigNumber=$t_intPagibigNumber&t_strResidentialAddress=$t_strResidentialAddress&t_intZipCode1=$t_intZipCode1&t_intTelephone1=$t_intTelephone1&t_strPermanentAddress=$t_strPermanentAddress&t_intZipCode2=$t_intZipCode2&t_intTelephone2=$t_intTelephone2&t_strEmail=$t_strEmail&t_intMobile=$t_intMobile&t_strEmpNumber=$t_strEmpNumber&t_intTin=$t_intTin&Submit2=DELETE\">*** Click here to edit or delete picture ***</a></td></tr>";
            echo "<tr><td width=\"21%\" class=\"paragraph\">Date of Birth :</td>";
            echo "<td width=\"27%\">&nbsp; " . $row['birthday'] . "</td>";
            echo "<td width=\"20%\" rowspan=\"4\" class=\"paragraph\">Residential Address :</td>";
            echo "<td width=\"32%\" rowspan=\"4\">&nbsp; " . $row['residentialAddress'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Place of Birth :</td>";
            echo "<td>&nbsp; " . $row['birthPlace'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Sex :</td>";
            echo "<td>&nbsp; " . $row['sex'] . "</td></tr>";
            echo "<tr><td height=\"19\" class=\"paragraph\">Civil Status :</td>";
            echo "<td>&nbsp; " . $row['civilStatus'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Citizenship :</td>";
            echo "<td>&nbsp; " . $row['citizenship'] . "</td>";
            echo "<td width=\"21%\" class=\"paragraph\">Zip Code :</td>";
            echo "<td>&nbsp; " . $row['zipCode1'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Height (m) :</td>";
            echo "<td>&nbsp; " . $row['height'] . "</td>";
            echo "<td width=\"21%\" class=\"paragraph\">Telephone No. :</td>";
            echo "<td>&nbsp; " . $row['telephone1'] . "</td></tr>";
            echo "<tr><td width=\"21%\" class=\"paragraph\">Weight (kg) :</td>";
            echo "<td>&nbsp; " . $row['weight'] . "</td>";
            echo "<td width=\"21%\" rowspan=\"4\" class=\"paragraph\">Permanent Address :</td>";
            echo "<td rowspan=\"4\">&nbsp; " . $row['permanentAddress'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Blood Type :</td>";
            echo "<td>&nbsp; " . $row['bloodType'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">GSIS Policy No. :</td>";
			echo "<td>&nbsp; " . $row['gsisNumber'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">PAG-IBIG ID No. :</td>";
            echo "<td>&nbsp; " . $row['pagibigNumber'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">PHILHEALTH No. :</td>";
            echo "<td>&nbsp; " . $row['philHealthNumber'] . "</td>";
			echo "<td width=\"21%\" class=\"paragraph\">Zip Code :</td>";
            echo "<td>&nbsp; " . $row['zipCode2'] . "</td></tr>";
            echo "<tr><td width=\"21%\" class=\"paragraph\">TIN No. :</td>";
            echo "<td>&nbsp; " . $row['tin'] . "</td>";
            echo "<td width=\"21%\" class=\"paragraph\">Telephone No. :</td>";
            echo "<td>&nbsp; " . $row['telephone2'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Email Address :</td>";
			echo "<td>&nbsp; " . $row['email'] . "</td>";
			echo "<td width=\"21%\" class=\"paragraph\">Mobile No. : </td>";
            echo "<td>&nbsp; " . $row['mobile'] . "</td></tr>";
            echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
            echo "<tr class=\"title\"><td colspan=\"4\">";
			echo "<a href=\"Personalinformation.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strSurname=$t_strSurname&t_strFirstname=$t_strFirstname&t_strMiddlename=$t_strMiddlename&t_dtmBirthDate=$t_dtmBirthDate&t_strBirthPlace=$t_strBirthPlace&t_strSex=$t_strSex&t_strCivilStatus=$t_strCivilStatus&t_strCitizenship=$t_strCitizenship&t_intHeight=$t_intHeight&t_intWeight=$t_intWeight&t_strBloodType=$t_strBloodType&t_strGSISNumber=$t_strGSISNumber&t_intPhilHealthNumber=$t_intPhilHealthNumber&t_intPagibigNumber=$t_intPagibigNumber&t_strResidentialAddress=$t_strResidentialAddress&t_intZipCode1=$t_intZipCode1&t_intTelephone1=$t_intTelephone1&t_strPermanentAddress=$t_strPermanentAddress&t_intZipCode2=$t_intZipCode2&t_intTelephone2=$t_intTelephone2&t_strEmail=$t_strEmail&t_intMobile=$t_intMobile&t_strEmpNumber=$t_strEmpNumber&t_intTin=$t_intTin&Submit=EDIT\">EDIT</a>";
			echo "</td></tr>";
			//echo "<tr><td colspan=\"4\">&nbsp;</td>";
			echo "</tr></table>";
		 }	
	} 
	
	function employeePicture($strEmpNmbr, $t_strEmpNumber, $Submit2) //edit employee picture
    {

    	if ($Submit2 == 'DELETE')
	  	{
	    	$delete = mysql_query("DELETE FROM tblEmpPicture WHERE empNumber = '$t_strEmpNumber'");
	     	$del = mysql_query($delete);
	   	}

	}

	
}	//  end class
?>