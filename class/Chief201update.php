<?php 
/* 
File Name: Chief201update.php (class folder)
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
Date of Revision: January 13, 2004
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
class Chief201update extends General
{

	function chief201Update() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function addProfile($t_strEmpNumber, $t_strEmpProfile, $t_strProfileRequestCode, $t_strSurname, $t_strMiddlename, $t_strCivilStatus, $t_intWeight, $t_strResidentialAddress, $t_intZipCode1, $t_intTelephone1, $t_strPermanentAddress, $t_intZipCode2, $t_intTelephone2, $t_strEmail, $t_intMobile, $t_strSpouse, $t_strSpouseWork, $t_strSpouseBusName, $t_strSpouseBusAddress, $t_intSpouseTelephone, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee personal data
   {
      if ($Submit == 'Submit')
	  { 	  
		 $t_strProfileRequestCode = "201";
 		 $t_strBirthDate = $this->combineDate($t_strBirthYear, $t_strBirthMonth, $t_strBirthDay);
 		 $t_dtmIssuedOn = $this->combineDate($t_dtmIssuedOnYear, $t_dtmIssuedOnMonth, $t_dtmIssuedOnDay);
		 $t_strRequestDetails = "$t_strEmpProfile;"."$t_strSurname;"."$t_strMiddlename;"
		 						."$t_strCivilStatus;"."$t_intWeight;"."$t_strResidentialAddress;"
								."$t_intZipCode1;"."$t_intTelephone1;"."$t_strPermanentAddress;"
								."$t_intZipCode2;"."$t_intTelephone2;"."$t_strEmail;"
								."$t_intMobile;"."$t_strSpouse;"."$t_strSpouseWork;"
								."$t_strSpouseBusName;"."$t_strSpouseBusAddress;"."$t_intSpouseTelephone;";
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strProfileRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee Personal Data not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}	

	function addEducation($t_strEmpNumber, $t_strEmpProfile, $t_strEducationRequestCode, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_intUnits, $t_dtmSchoolFromMonth, $t_dtmSchoolFromDay, $t_dtmSchoolFromYear, $t_dtmSchoolToMonth, $t_dtmSchoolToDay, $t_dtmSchoolToYear, $t_strHonors, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee educational attainment
   {
      if ($Submit == 'Submit')
	  {
		 $t_strEducationRequestCode = "201";
 		 $t_dtmSchoolFromDate = $this->combineDate($t_dtmSchoolFromYear, $t_dtmSchoolFromMonth, $t_dtmSchoolFromDay);
 		 $t_dtmSchoolToDate = $this->combineDate($t_dtmSchoolToYear, $t_dtmSchoolToMonth, $t_dtmSchoolToDay);
		 if ($t_strHonors == '') 
		 {
		 $t_strHonors = "none";
		 $t_strRequestDetails = "$t_strEmpProfile;"."$t_strLevelCode;"."$t_strSchoolName;"
		 						."$t_strCourse;"."$t_intUnits;"."$t_strHonors;"."$t_dtmSchoolFromDate;"
								."$t_dtmSchoolToDate;";		 
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strEducationRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 } else {
		 $t_strRequestDetails = "$t_strEmpProfile;"."$t_strLevelCode;"."$t_strSchoolName;"
		 						."$t_strCourse;"."$t_intUnits;"."$t_strHonors;"."$t_dtmSchoolFromDate;"
								."$t_dtmSchoolToDate;";		 
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strEducationRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 }
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee educational attainment not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}

	function addTraining($t_strEmpNumber, $t_strEmpProfile, $t_strTrainingRequestCode, $t_strTrainingCode, $t_dtmTrainingContractMonth, $t_dtmTrainingContractDay, $t_dtmTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_dtmTrainingStartMonth, $t_dtmTrainingStartDay, $t_dtmTrainingStartYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay, $t_dtmTrainingEndYear,  $t_intTrainingHours, $t_intTrainingCost, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee training/seminar
   {
      if ($Submit == 'Submit')
	  {
		 $t_strTrainingRequestCode = "201";
 		 $t_dtmTrainingContractDate = $this->combineDate($t_dtmTrainingContractYear, $t_dtmTrainingContractMonth, $t_dtmTrainingContractDay);
 		 $t_dtmTrainingStartDate = $this->combineDate($t_dtmTrainingStartYear, $t_dtmTrainingStartMonth, $t_dtmTrainingStartDay);
 		 $t_dtmTrainingEndDate = $this->combineDate($t_dtmTrainingEndYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay);
		 $t_dtmTrainingTimeStart = $this->combineTime($t_dtmTrainingStart, $t_dtmTrainingAMPMStart);
 		 $t_dtmTrainingTimeEnd = $this->combineTime($t_dtmTrainingEnd, $t_dtmTrainingAMPMEnd);
		 $t_strRequestDetails = "$t_strEmpProfile;"."$t_strTrainingCode;"."$t_intTrainingHours;"
		 						."$t_strTrainingVenue;"."$t_strTrainingConductedBy;"
								."$t_intTrainingCost;"."$t_dtmTrainingContractDate;"
								."$t_dtmTrainingStartDate;"."$t_dtmTrainingEndDate;";		 
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strTrainingRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee Personal Data not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}

	function addExaminations($t_strEmpNumber, $t_strEmpProfile, $t_strExamRequestCode, $t_strExamCode, $t_dtmExamMonth, $t_dtmExamDay, $t_dtmExamYear, $t_intExamRating, $t_strExamPlace, $t_strLicenseNumber, $t_dtmDateReleaseMonth, $t_dtmDateReleaseDay, $t_dtmDateReleaseYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee examination
   {
      if ($Submit == 'Submit')
	  {
		 $t_strExamRequestCode = "201";
 		 $t_dtmExamDate = $this->combineDate($t_dtmExamYear, $t_dtmExamMonth, $t_dtmExamDay);
 		 $t_dtmDateRelease = $this->combineDate($t_dtmDateReleaseYear, $t_dtmDateReleaseMonth, $t_dtmDateReleaseDay);
		 if ($t_strLicenseNumber == '') 
		 {
		 $t_dtmDateRelease = date("Y-n-j");
		 $t_strLicenseNumber = "not-applicable";

		 $t_strRequestDetails = "$t_strEmpProfile;" . "$t_strExamCode;" . 
		 		"$t_strExamPlace;" . "$t_intExamRating;" . "$t_dtmExamDate;" . 
				"$t_strLicenseNumber;" . "$t_dtmDateRelease;";		 
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strExamRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 } else {
		 $t_strRequestDetails = "$t_strEmpProfile;" . "$t_strExamCode;" . 
		 		"$t_strExamPlace;" . "$t_intExamRating;" . "$t_dtmExamDate;" . 
				"$t_strLicenseNumber;" . "$t_dtmDateRelease;";		 
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strExamRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
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

	function addChildren($t_strEmpNumber, $t_strEmpProfile, $t_strChildRequestCode, $t_strChildName, $t_strChildBirthMonth, $t_strChildBirthDay, $t_strChildBirthYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee children information
   {
      if ($Submit == 'Submit')
	  {
		 $t_strChildRequestCode = "201";
	     $t_strChildBirthDate = $this->combineDate($t_strChildBirthYear, $t_strChildBirthMonth, $t_strChildBirthDay);
		 $t_strRequestDetails = "$t_strEmpProfile;"."$t_strChildName;"."$t_strChildBirthDate;";		 
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strChildRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee children information not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
   	
		function addTax($t_strEmpNumber, $t_strEmpProfile, $t_strTaxRequestCode, $t_strTaxCertNmbr, $t_strIssuedAt, $t_dtmIssuedOnMonth, $t_dtmIssuedOnDay, $t_dtmIssuedOnYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee community tax certificate
   {
      if ($Submit == 'Submit')
	  {
		 $t_strTaxRequestCode = "201";
	     $t_dtmIssuedOn = $this->combineDate($t_dtmIssuedOnYear, $t_dtmIssuedOnMonth, $t_dtmIssuedOnDay);
		 $t_strRequestDetails = "$t_strEmpProfile;"."$t_strTaxCertNmbr;"."$t_strIssuedAt;"."$t_dtmIssuedOn;";		 
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strTaxRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee community tax certificate not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}

	function addReference($t_strEmpNumber, $t_strEmpProfile, $t_strRefRequestCode, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee reference
   {
      if ($Submit == 'Submit')
	  {
		$t_strRefRequestCode = "201";
		 $t_strRequestDetails = "$t_strEmpProfile;"."$t_strRefName;"."$t_strRefAddress;"
		 						."$t_intRefTelephone;";		 
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strRefRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
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

	function addVoluntaryWorks($t_strEmpNumber, $t_strEmpProfile, $t_strVWRequestCode, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay, $t_dtmVWDateFromYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay, $t_dtmVWDateToYear,  $t_intVWHours, $t_strVWPosition, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee voluntary works
   {
      if ($Submit == 'Submit')
	  {
		 $t_strVWRequestCode = "201";
	     $t_dtmVWDateFrom = $this->combineDate($t_dtmVWDateFromYear, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay);
	     $t_dtmVWDateTo = $this->combineDate($t_dtmVWDateToYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay);
		 $t_strRequestDetails = "$t_strEmpProfile;" . "$t_strVWName;" . "$t_strVWAddress;" 
		 			."$t_dtmVWDateFrom;" . "$t_dtmVWDateTo;" . "$t_intVWHours;" . "$t_strVWPosition";		 
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strVWRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee voluntary works not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
   	

}	//  end class
?>