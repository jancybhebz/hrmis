<?php 
/* 
File Name: Personaldatasheet.php (class folder)
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
Date of Revision: February 27, 2003 (Version 1.0.1)
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
class Personaldatasheet extends General
{

	function personalDataSheet() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   

// -----------------------------------------  Personal Information  -----------------------------  //

	function addEmployee($strEmpNmbr, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_dtmBirthMonth, $t_dtmBirthDay, $t_dtmBirthYear, $t_strBirthPlace, $t_strSex, $t_strCivilStatus, $t_strCitizenship, $t_intHeight, $t_intWeight, $t_strBloodType, $t_strGSISNumber, $t_intPAGIBIGNumber, $t_intPHILHEALTHNumber, $t_strResidentialAddress, $t_intZipCode1, $t_intTelephone1, $t_strPermanentAddress, $t_intZipCode2, $t_intTelephone2, $t_strEmail, $t_intMobile, $t_strEmpNumber, $t_intTin, $t_strSpouse, $t_strSpouseWork, $t_strSpouseBusName, $t_strSpouseBusAddress, $t_intSpouseTelephone, $t_strFatherName, $t_strMotherName, $t_strParentAddress, $t_strSkills, $t_strNADR, $t_strMIAO, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strAdminCaseParticulars, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strIndigenous, $t_strIndigenousParticulars, $t_strDisabled, $t_strDisabledParticulars, $t_strSoloParent, $t_strSoloParentParticulars, $t_strSignature, $t_dtmDateAccMonth, $t_dtmDateAccDay, $t_dtmDateAccYear, $t_strComTaxNumber, $t_strIssuedAt, $t_dtmIssuedOnMonth, $t_dtmIssuedOnDay, $t_dtmIssuedOnYear, $Submit)   //Add employee personal data (tblEmpPersonal)
   {
      if ($Submit == 'ADD')
	  { 	  
 		 $t_dtmBirthDate = $this->combineDate($t_dtmBirthYear, $t_dtmBirthMonth, $t_dtmBirthDay);   // Employee Birthday
 		 $t_dtmVWDateFrom = $this->combineDate($t_dtmVWDateFromYear, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay);   // VWork Date From
 		 $t_dtmVWDateTo = $this->combineDate($t_dtmVWDateToYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay);   // VWork Date To
 		 $t_dtmDateAccomplished = $this->combineDate($t_dtmDateAccYear, $t_dtmDateAccMonth, $t_dtmDateAccDay);   // Date Accomplished		 
 		 $t_dtmIssuedOn = $this->combineDate($t_dtmIssuedOnYear, $t_dtmIssuedOnMonth, $t_dtmIssuedOnDay);   // Tax Issued On		 
	     $results = "INSERT INTO tblEmpPersonal (surname, firstname, middlename, birthday, birthPlace, sex, civilStatus, citizenship, height, weight, bloodType, gsisNumber, pagibigNumber, philHealthNumber, residentialAddress, zipCode1, telephone1, permanentAddress, zipCode2, telephone2, email, mobile, empNumber, tin, spouse, spouseWork, spouseBusName, spouseBusAddress, spouseTelephone, fatherName, motherName, parentAddress, skills, nadr, miao, relatedThird, relatedFourth, relatedDegreeParticulars, adminCase, adminCaseParticulars, violateLaw, violateLawParticulars, forcedResign, forcedResignParticulars, candidate, candidateParticulars, indigenous, indigenousParticulars, disabled, disabledParticulars, soloParent, soloParentParticulars, signature, dateAccomplished, comTaxNumber, issuedAt, issuedOn) VALUES ('$t_strSurname', '$t_strFirstname', '$t_strMiddlename', '$t_dtmBirthDate', '$t_strBirthPlace', '$t_strSex', '$t_strCivilStatus', '$t_strCitizenship', '$t_intHeight', '$t_intWeight', '$t_strBloodType', '$t_strGSISNumber', '$t_intPAGIBIGNumber', '$t_intPHILHEALTHNumber', '$t_strResidentialAddress', '$t_intZipCode1', '$t_intTelephone1', '$t_strPermanentAddress', '$t_intZipCode2', '$t_intTelephone2', '$t_strEmail', '$t_intMobile', '$t_strEmpNumber', '$t_intTin', '$t_strSpouse', '$t_strSpouseWork', '$t_strSpouseBusName', '$t_strSpouseBusAddress', '$t_intSpouseTelephone', '$t_strFatherName', '$t_strMotherName', '$t_strParentAddress', '$t_strSkills', '$t_strNADR', '$t_strMIAO', '$t_strRelatedThird', '$t_strRelatedFourth', '$t_strRelatedDegreeParticulars', '$t_strAdminCase', '$t_strAdminCaseParticulars', '$t_strViolateLaw', '$t_strViolateLawParticulars', '$t_strForcedResign', '$t_strForcedResignParticulars', '$t_strCandidate', '$t_strCandidateParticulars', '$t_strIndigenous', '$t_strIndigenousParticulars', '$t_strDisabled', '$t_strDisabledParticulars', '$t_strSoloParent', '$t_strSoloParentParticulars', '$t_strSignature', '$t_dtmDateAccomplished', '$t_strComTaxNumber', '$t_strIssuedAt', '$t_dtmIssuedOn')";
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


// ------------------------------------------  Children  -----------------------------------  //
	
	function addChild($strEmpNmbr, $t_strEmpNumber, $t_strChildName, $t_dtmChildBirthMonth, $t_dtmChildBirthDay, $t_dtmChildBirthYear, $Submit)   //Add employee children information
   {
      if ($Submit == 'ADD')
	  {
	     $t_dtmChildBirthDate = $this->combineDate($t_dtmChildBirthYear, $t_dtmChildBirthMonth, $t_dtmChildBirthDay);   // child's birthday
	     $results = "INSERT INTO tblEmpChild(empNumber, childName, childBirthDate) VALUES ('$t_strEmpNumber', '$t_strChildName', '$t_dtmChildBirthDate')";
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
	
	function addChild2($strEmpNmbr, $t_strEmpNumber, $t_strChildName2, $t_dtmChildBirthMonth2, $t_dtmChildBirthDay2, $t_dtmChildBirthYear2, $Submit)   //Add employee children information
   {
      if ($Submit == 'ADD')
	  {
	     $t_dtmChildBirthDate2 = $this->combineDate($t_dtmChildBirthYear2, $t_dtmChildBirthMonth2, $t_dtmChildBirthDay2);   // child's birthday
	     $results = "INSERT INTO tblEmpChild(empNumber, childName, childBirthDate) VALUES ('$t_strEmpNumber', '$t_strChildName2', '$t_dtmChildBirthDate2')";
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

	function addChild3($strEmpNmbr, $t_strEmpNumber, $t_strChildName3, $t_dtmChildBirthMonth3, $t_dtmChildBirthDay3, $t_dtmChildBirthYear3, $Submit)   //Add employee children information
   {
      if ($Submit == 'ADD')
	  {
	     $t_dtmChildBirthDate3 = $this->combineDate($t_dtmChildBirthYear3, $t_dtmChildBirthMonth3, $t_dtmChildBirthDay3);   // child's birthday
	     $results = "INSERT INTO tblEmpChild(empNumber, childName, childBirthDate) VALUES ('$t_strEmpNumber', '$t_strChildName3', '$t_dtmChildBirthDate3')";
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

	function addChild4($strEmpNmbr, $t_strEmpNumber, $t_strChildName4, $t_dtmChildBirthMonth4, $t_dtmChildBirthDay4, $t_dtmChildBirthYear4, $Submit)   //Add employee children information
   {
      if ($Submit == 'ADD')
	  {
	     $t_dtmChildBirthDate4 = $this->combineDate($t_dtmChildBirthYear4, $t_dtmChildBirthMonth4, $t_dtmChildBirthDay4);   // child's birthday
	     $results = "INSERT INTO tblEmpChild(empNumber, childName, childBirthDate) VALUES ('$t_strEmpNumber', '$t_strChildName4', '$t_dtmChildBirthDate4')";
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


// ---------------------------------------------  School Attainment  ---------------------------------  //

	function addElementary($strEmpNmbr, $t_strEmpNumber, $t_strElementary, $t_strElementarySchoolName, $t_strElementaryCourse, $t_intElementaryUnits, $t_dtmElementaryFromMonth, $t_dtmElementaryFromDay, $t_dtmElementaryFromYear, $t_dtmElementaryToMonth, $t_dtmElementaryToDay, $t_dtmElementaryToYear, $t_strElementaryHonors, $Submit)   //Add employee educational attainment (tblEmpSchool)
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmElementaryFromDate = $this->combineDate($t_dtmElementaryFromYear, $t_dtmElementaryFromMonth, $t_dtmElementaryFromDay);
 		 $t_dtmElementaryToDate = $this->combineDate($t_dtmElementaryToYear, $t_dtmElementaryToMonth, $t_dtmElementaryToDay);
	     $results = "INSERT INTO tblEmpSchool(empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strElementary', '$t_strElementarySchoolName', '$t_strElementaryCourse', '$t_intElementaryUnits', '$t_dtmElementaryFromDate', '$t_dtmElementaryToDate', '$t_strElementaryHonors')";
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

	function addSecondary($strEmpNmbr, $t_strEmpNumber, $t_strSecondary, $t_strSecondarySchoolName, $t_strSecondaryCourse, $t_intSecondaryUnits, $t_dtmSecondaryFromMonth, $t_dtmSecondaryFromDay, $t_dtmSecondaryFromYear, $t_dtmSecondaryToMonth, $t_dtmSecondaryToDay, $t_dtmSecondaryToYear, $t_strSecondaryHonors, $Submit)   //Add employee educational attainment (tblEmpSchool)
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmSecondaryFromDate = $this->combineDate($t_dtmSecondaryFromYear, $t_dtmSecondaryFromMonth, $t_dtmSecondaryFromDay);
 		 $t_dtmSecondaryToDate = $this->combineDate($t_dtmSecondaryToYear, $t_dtmSecondaryToMonth, $t_dtmSecondaryToDay);
	     $results = "INSERT INTO tblEmpSchool(empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strSecondary', '$t_strSecondarySchoolName', '$t_strSecondaryCourse', '$t_intSecondaryUnits', '$t_dtmSecondaryFromDate', '$t_dtmSecondaryToDate', '$t_strSecondaryHonors')";
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

	function addVocational($strEmpNmbr, $t_strEmpNumber, $t_strVocational, $t_strVocationalSchoolName, $t_strVocationalCourse, $t_intVocationalUnits, $t_dtmVocationalFromMonth, $t_dtmVocationalFromDay, $t_dtmVocationalFromYear, $t_dtmVocationalToMonth, $t_dtmVocationalToDay, $t_dtmVocationalToYear, $t_strVocationalHonors, $Submit)   //Add employee educational attainment (tblEmpSchool)
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmVocationalFromDate = $this->combineDate($t_dtmVocationalFromYear, $t_dtmVocationalFromMonth, $t_dtmVocationalFromDay);
 		 $t_dtmVocationalToDate = $this->combineDate($t_dtmVocationalToYear, $t_dtmVocationalToMonth, $t_dtmVocationalToDay);
	     $results = "INSERT INTO tblEmpSchool(empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strVocational', '$t_strVocationalSchoolName', '$t_strVocationalCourse', '$t_intVocationalUnits', '$t_dtmVocationalFromDate', '$t_dtmVocationalToDate', '$t_strVocationalHonors')";
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

	function addTertiary($strEmpNmbr, $t_strEmpNumber, $t_strTertiary, $t_strTertiarySchoolName, $t_strTertiaryCourse, $t_intTertiaryUnits, $t_dtmTertiaryFromMonth, $t_dtmTertiaryFromDay, $t_dtmTertiaryFromYear, $t_dtmTertiaryToMonth, $t_dtmTertiaryToDay, $t_dtmTertiaryToYear, $t_strTertiaryHonors, $Submit)   //Add employee educational attainment (tblEmpSchool)
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmTertiaryFromDate = $this->combineDate($t_dtmTertiaryFromYear, $t_dtmTertiaryFromMonth, $t_dtmTertiaryFromDay);
 		 $t_dtmTertiaryToDate = $this->combineDate($t_dtmTertiaryToYear, $t_dtmTertiaryToMonth, $t_dtmTertiaryToDay);
	     $results = "INSERT INTO tblEmpSchool(empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strTertiary', '$t_strTertiarySchoolName', '$t_strTertiaryCourse', '$t_intTertiaryUnits', '$t_dtmTertiaryFromDate', '$t_dtmTertiaryToDate', '$t_strTertiaryHonors')";
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

	function addCollege($strEmpNmbr, $t_strEmpNumber, $t_strCollege, $t_strCollegeSchoolName, $t_strCollegeCourse, $t_intCollegeUnits, $t_dtmCollegeFromMonth, $t_dtmCollegeFromDay, $t_dtmCollegeFromYear, $t_dtmCollegeToMonth, $t_dtmCollegeToDay, $t_dtmCollegeToYear, $t_strCollegeHonors, $Submit)   //Add employee educational attainment (tblEmpSchool)
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmCollegeFromDate = $this->combineDate($t_dtmCollegeFromYear, $t_dtmCollegeFromMonth, $t_dtmCollegeFromDay);
 		 $t_dtmCollegeToDate = $this->combineDate($t_dtmCollegeToYear, $t_dtmCollegeToMonth, $t_dtmCollegeToDay);
	     $results = "INSERT INTO tblEmpSchool(empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strCollege', '$t_strCollegeSchoolName', '$t_strCollegeCourse', '$t_intCollegeUnits', '$t_dtmCollegeFromDate', '$t_dtmCollegeToDate', '$t_strCollegeHonors')";
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

	function addMasterDegree($strEmpNmbr, $t_strEmpNumber, $t_strMasterDegree, $t_strMasterDegreeSchoolName, $t_strMasterDegreeCourse, $t_intMasterDegreeUnits, $t_dtmMasterDegreeFromMonth, $t_dtmMasterDegreeFromDay, $t_dtmMasterDegreeFromYear, $t_dtmMasterDegreeToMonth, $t_dtmMasterDegreeToDay, $t_dtmMasterDegreeToYear, $t_strMasterDegreeHonors, $Submit)   //Add employee educational attainment (tblEmpSchool)
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmMasterDegreeFromDate = $this->combineDate($t_dtmMasterDegreeFromYear, $t_dtmMasterDegreeFromMonth, $t_dtmMasterDegreeFromDay);
 		 $t_dtmMasterDegreeToDate = $this->combineDate($t_dtmMasterDegreeToYear, $t_dtmMasterDegreeToMonth, $t_dtmMasterDegreeToDay);
	     $results = "INSERT INTO tblEmpSchool(empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strMasterDegree', '$t_strMasterDegreeSchoolName', '$t_strMasterDegreeCourse', '$t_intMasterDegreeUnits', '$t_dtmMasterDegreeFromDate', '$t_dtmMasterDegreeToDate', '$t_strMasterDegreeHonors')";
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

	function addDoctorate($strEmpNmbr, $t_strEmpNumber, $t_strDoctorate, $t_strDoctorateSchoolName, $t_strDoctorateCourse, $t_intDoctorateUnits, $t_dtmDoctorateFromMonth, $t_dtmDoctorateFromDay, $t_dtmDoctorateFromYear, $t_dtmDoctorateToMonth, $t_dtmDoctorateToDay, $t_dtmDoctorateToYear, $t_strDoctorateHonors, $Submit)   //Add employee educational attainment (tblEmpSchool)
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmDoctorateFromDate = $this->combineDate($t_dtmDoctorateFromYear, $t_dtmDoctorateFromMonth, $t_dtmDoctorateFromDay);
 		 $t_dtmDoctorateToDate = $this->combineDate($t_dtmDoctorateToYear, $t_dtmDoctorateToMonth, $t_dtmDoctorateToDay);
	     $results = "INSERT INTO tblEmpSchool(empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strDoctorate', '$t_strDoctorateSchoolName', '$t_strDoctorateCourse', '$t_intDoctorateUnits', '$t_dtmDoctorateFromDate', '$t_dtmDoctorateToDate', '$t_strDoctorateHonors')";
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

	function addNonDegreeCourse($strEmpNmbr, $t_strEmpNumber, $t_strNonDegreeCourse, $t_strNonDegreeCourseSchoolName, $t_strNonDegreeCourseCourse, $t_intNonDegreeCourseUnits, $t_dtmNonDegreeCourseFromMonth, $t_dtmNonDegreeCourseFromDay, $t_dtmNonDegreeCourseFromYear, $t_dtmNonDegreeCourseToMonth, $t_dtmNonDegreeCourseToDay, $t_dtmNonDegreeCourseToYear, $t_strNonDegreeCourseHonors, $Submit)   //Add employee educational attainment (tblEmpSchool)
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmNonDegreeCourseFromDate = $this->combineDate($t_dtmNonDegreeCourseFromYear, $t_dtmNonDegreeCourseFromMonth, $t_dtmNonDegreeCourseFromDay);
 		 $t_dtmNonDegreeCourseToDate = $this->combineDate($t_dtmNonDegreeCourseToYear, $t_dtmNonDegreeCourseToMonth, $t_dtmNonDegreeCourseToDay);
	     $results = "INSERT INTO tblEmpSchool(empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strNonDegreeCourse', '$t_strNonDegreeCourseSchoolName', '$t_strNonDegreeCourseCourse', '$t_intNonDegreeCourseUnits', '$t_dtmNonDegreeCourseFromDate', '$t_dtmNonDegreeCourseToDate', '$t_strNonDegreeCourseHonors')";
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
	

// ---------------------------------------------  Examination  -----------------------------------  //

	function addExamination($strEmpNmbr, $t_strEmpNumber, $t_strExamCode, $t_intExamRating, $t_dtmExamMonth, $t_dtmExamDay, $t_dtmExamYear,  $t_strExamPlace, $t_strLicenseNumber, $t_dtmDateReleaseMonth, $t_dtmDateReleaseDay, $t_dtmDateReleaseYear, $Submit)   //Add employee (tblEmpExam)
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmExamDate = $this->combineDate($t_dtmExamYear, $t_dtmExamMonth, $t_dtmExamDay);
 		 $t_dtmDateRelease = $this->combineDate($t_dtmDateReleaseYear, $t_dtmDateReleaseMonth, $t_dtmDateReleaseDay);
	     $results = "INSERT INTO tblEmpExam (empNumber, examCode, examRating, examDate, examPlace, licenseNumber, dateRelease) VALUES ('$t_strEmpNumber', '$t_strExamCode', '$t_intExamRating', '$t_dtmExamDate', '$t_strExamPlace', '$t_strLicenseNumber', '$t_dtmDateRelease')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee examination not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}


// ---------------------------------------------  Voluntary Work  -----------------------------------  //

	function addVoluntaryWork($strEmpNmbr, $t_strEmpNumber, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay, $t_dtmVWDateFromYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay, $t_dtmVWDateToYear,  $t_intVWHours, $t_strVWPosition, $Submit)   //Load add voluntary work information function
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmVWDateFrom = $this->combineDate($t_dtmVWDateFromYear, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay);
 		 $t_dtmVWDateTo = $this->combineDate($t_dtmVWDateToYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay);
	     $results = "INSERT INTO tblEmpVoluntaryWork (empNumber, vwName, vwAddress, vwDateFrom, vwDateTo, vwHours, vwPosition) VALUES ('$t_strEmpNumber', '$t_strVWName', '$t_strVWAddress', '$t_dtmVWDateFrom', '$t_dtmVWDateTo', '$t_intVWHours', '$t_strVWPosition')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee voluntary work not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}


// ------------------------------------------  Training Attended  ---------------------------------  //

	function addTraining($strEmpNmbr, $t_strEmpNumber, $t_strTrainingCode, $t_dtmTrainingStartMonth, $t_dtmTrainingStartDay, $t_dtmTrainingStartYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay, $t_dtmTrainingEndYear, $t_intTrainingHours, $t_strTrainingConductedBy, $Submit)   //Add employee training/seminar (tblEmpTraining)
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmTrainingStartDate = $this->combineDate($t_dtmTrainingStartYear, $t_dtmTrainingStartMonth, $t_dtmTrainingStartDay);
 		 $t_dtmTrainingEndDate = $this->combineDate($t_dtmTrainingEndYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay);
	     $results = "INSERT INTO tblEmpTraining (empNumber, trainingCode, trainingStartDate, trainingEndDate, trainingHours, trainingConductedBy) VALUES ('$t_strEmpNumber', '$t_strTrainingCode', '$t_dtmTrainingStartDate', '$t_dtmTrainingEndDate', '$t_intTrainingHours', '$t_strTrainingConductedBy')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee training information not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	

// ------------------------------------------  Work Experience  -----------------------------------  //
		
	function addServiceRecords($strEmpNmbr, $t_strEmpNumber, $t_dtmServiceFromMonth, $t_dtmServiceFromDay, $t_dtmServiceFromYear, $t_dtmServiceToMonth, $t_dtmServiceToDay, $t_dtmServiceToYear, $t_strPositionCode, $t_strStationAgency, $t_intSalary, $t_strAppointmentCode, $t_strSeparationCause, $t_dtmSeparationMonth, $t_dtmSeparationDay, $t_dtmSeparationYear, $Submit)   //Add service record/work experience
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmServiceFromDate = $this->combineDate($t_dtmServiceFromYear, $t_dtmServiceFromMonth, $t_dtmServiceFromDay);
 		 $t_dtmServiceToDate = $this->combineDate($t_dtmServiceToYear, $t_dtmServiceToMonth, $t_dtmServiceToDay);
 		 $t_dtmSeparationDate = $this->combineDate($t_dtmSeparationYear, $t_dtmSeparationMonth, $t_dtmSeparationDay);
	     $results = "INSERT INTO tblServiceRecord (empNumber, serviceFromDate, serviceToDate, positionCode, appointmentCode, salary, stationAgency, separationCause, separationDate) VALUES ('$t_strEmpNumber', '$t_dtmServiceFromDate', '$t_dtmServiceToDate', '$t_strPositionCode', '$t_strAppointmentCode', '$t_intSalary', '$t_strStationAgency', '$t_strSeparationCause', '$t_dtmSeparationDate')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee work experience not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	

// -----------------------------------------  Position Details  -----------------------------------  //
			
	function addPositionDetails($strEmpNmbr, $t_strEmpNumber, $t_strAppointmentCode, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_strFirstDayAgency, $t_intStepNumber, $t_strFirstDayGov, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_intHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveMonth, $t_strEffectiveDay, $t_strEffectiveYear, $t_strLongevityMonth, $t_strLongevityDay, $t_strLongevityYear, $t_strPositionMonth, $t_strPositionDay, $t_strPositionYear, $t_strContractEndMonth, $t_strContractEndDay, $t_strContractEndYear, $t_intActualSalary, $Submit)   //Add employee position details
   {
      if ($Submit == 'ADD')
	  {
 		 $t_strEffectiveDate = $this->combineDate($t_strEffectiveYear, $t_strEffectiveMonth, $t_strEffectiveDay);
 		 $t_strLongevityDate = $this->combineDate($t_strLongevityYear, $t_strLongevityMonth, $t_strLongevityDay);
 		 $t_strPositionDate = $this->combineDate($t_strPositionYear, $t_strPositionMonth, $t_strPositionDay);
 		 $t_strContractEndDate = $this->combineDate($t_strContractEndYear, $t_strContractEndMonth, $t_strContractEndDay);
	     $results = "INSERT INTO tblEmpPosition (empNumber, appointmentCode, serviceCode, sectionCode, positionCode, divisionCode, taxStatCode, itemNumber, firstDayAgency, stepNumber, firstDayGov, personnelAction,  employmentBasis, categoryService, nature, hpFactor, payrollSwitch, dtrSwitch, dependents, healthProvider, effectiveDate, longevityDate, positionDate, contractEndDate, actualSalary) VALUES ('$t_strEmpNumber', '$t_strAppointmentCode', '$t_strServiceCode', '$t_strSectionCode', '$t_strPositionCode', '$t_strDivisionCode', '$t_strTaxStatCode', '$t_strItemNumber', '$t_strFirstDayAgency', '$t_intStepNumber', '$t_strFirstDayGov', '$t_strPersonnelAction', '$t_strEmploymentBasis', '$t_strCategoryService', '$t_strNatureOfWork', '$t_intHPFactor', '$t_strPayrollSwitch', '$t_strDTRSwitch', '$t_intDependents', '$t_strHealthProvider', '$t_strEffectiveDate', '$t_strLongevityDate', '$t_strPositionDate', '$t_strContractEndDate', '$t_intActualSalary')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee position details not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	} 

	
// ------------------------------------------  References  -----------------------------------  //

	function addReference($strEmpNmbr, $t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $Submit)   //Add employee reference
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblEmpReference (empNumber, refName, refAddress, refTelephone) VALUES ('$t_strEmpNumber', '$t_strRefName', '$t_strRefAddress', '$t_intRefTelephone')";
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
	
	function countEmpNumber($t_strEmpNumber)
	{
	
		$objCntEmpNumber = mysql_query("SELECT empNumber FROM tblEmpPersonal");
		while ($arrCntEmpNumber = mysql_fetch_array($objCntEmpNumber))
		{
			$t_strEmpNumber = $arrCntEmpNumber['empNumber'];
			return $t_strEmpNumber;	
		}
	
	}

	function email_check($t_strEmail) { 
	   if (eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](g|l|m|pa|t|u|v)?$", $t_strEmail, $check)) { 
		  if (checkdnsrr(substr(strstr($check[0], '@'), 1), "ANY")) { 
			 return TRUE; 
		  } 
	   } 
	   return FALSE; 
	} 
			
}
?>