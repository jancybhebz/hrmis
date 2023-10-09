<?php 
/* 
File Name: Employeeinformation.php (class folder)
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
class Employeeinformation extends General
{

	function employeeInformation() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function viewProfile($txtSearch, $optField, $p, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_dtmBirthDate, $t_strBirthPlace, $t_strSex, $t_strCivilStatus, $t_strCitizenship, $t_intHeight, $t_intWeight, $t_strBloodType, $t_strGSISNumber, $t_intPagibigNumber, $t_intPhilHealthNumber, $t_strResidentialAddress, $t_intZipCode1, $t_intTelephone1, $t_strPermanentAddress, $t_intZipCode2, $t_intTelephone2, $t_strEmail, $t_intMobile, $t_strEmpNumber, $t_intTin)   //View employee profile
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
										tblEmpPosition.divisionCode, tblEmpPosition.positionCode
									FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition 
										ON tblEmpPersonal.empNumber=tblEmpPosition.empNumber
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
			echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
            //echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
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
			echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";
		 }	
	} 
}
?>