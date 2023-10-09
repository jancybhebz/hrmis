<?php 
/* 
File Name: Employee.php (class folder)
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
Date of Revision: November 06, 2003
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
class Employee extends General
{

	function employee() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function addEmployee($t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strSex, $t_strCivilStatus, $t_strMaidenName, $t_strSpouse, $t_strSpouseWork, $t_strBirthMonth, $t_strBirthDay, $t_strBirthYear, $t_strTin, $t_strCitizenship, $t_strBloodType, $t_strBirthPlace, $t_intHeight, $t_intWeight, $t_intCityNumber, $t_strCityStreet, $t_strCityBrgy, $t_strCityTown, $t_strCity, $t_intCityZipCode, $t_intProvNumber, $t_strProvStreet, $t_strProvBrgy, $t_strProvTown, $t_strProvZipCode, $t_strProvince, $t_strTelephone, $t_strMobile, $t_strEmail, $t_strFatherName, $t_strFatherBirthPlace, $t_strMotherName, $t_strMotherBirthPlace, $t_strSkills, $t_strQualifications, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strCrimeCase, $t_strDetailsOffense, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strAdminOffense, $t_strAdminOffenseParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strComTaxNumber, $t_strIssuedAt, $t_strIssuedOnMonth, $t_strIssuedOnDay,$t_strIssuedOnYear, $t_strGSISNumber, $t_strPAGIBIGNumber, $t_strPHILHEALTHNumber, $t_strOPLNumber1, $t_strOPLNumber2, $t_strOPLNumber3, $Submit)   //Add employee personal data
   {
      if ($Submit == 'Submit')
	  { 	  
 		 $t_strBirthDate = $this->combineDate($t_strBirthYear, $t_strBirthMonth, $t_strBirthDay);
 		 $t_strIssuedOn = $this->combineDate($t_strIssuedOnYear, $t_strIssuedOnMonth, $t_strIssuedOnDay);
	     $results = "INSERT INTO tblEmpPersonal (empNumber, surname, firstname, middlename, sex, civilStatus, maidenname, spouse, spouseWork, birthday, tin, citizenship, bloodType, birthPlace, height, weight, cityNumber,cityStreet, cityBrgy, cityTown, city, cityZipCode, provNumber, provStreet, provBrgy, provTown, provZipCode, province, telephone, mobile, email, fatherName, fatherBirthPlace, motherName, motherBirthPlace, skills, qualifications, relatedThird, relatedFourth, relatedDegreeParticulars, adminCase, crimeCase, detailsOffense, violateLaw, violateLawParticulars, adminOffense, adminOffenseParticulars, forcedResign, forcedResignParticulars, candidate, candidateParticulars, comTaxNumber, issuedAt, issuedOn, gsisNumber, pagibigNumber, philHealthNumber, oplNo1, oplNo2, oplNo3) VALUES ('$t_strEmpNumber', '$t_strSurname', '$t_strFirstname', '$t_strMiddlename', '$t_strSex', '$t_strCivilStatus', '$t_strMaidenName', '$t_strSpouse', '$t_strSpouseWork', '$t_strBirthDate', '$t_strTin', '$t_strCitizenship', '$t_strBloodType', '$t_strBirthPlace', '$t_intHeight', '$t_intWeight', '$t_intCityNumber', '$t_strCityStreet', '$t_strCityBrgy', '$t_strCityTown', '$t_strCity', '$t_intCityZipCode', '$t_intProvNumber', '$t_strProvStreet', '$t_strProvBrgy', '$t_strProvTown', '$t_strProvZipCode', '$t_strProvince', '$t_strTelephone', '$t_strMobile', '$t_strEmail', '$t_strFatherName', '$t_strFatherBirthPlace', '$t_strMotherName', '$t_strMotherBirthPlace', '$t_strSkills', '$t_strQualifications', '$t_strRelatedThird', '$t_strRelatedFourth', '$t_strRelatedDegreeParticulars', '$t_strAdminCase', '$t_strCrimeCase', '$t_strDetailsOffense', '$t_strViolateLaw', '$t_strViolateLawParticulars', '$t_strAdminOffense', '$t_strAdminOffenseParticulars', '$t_strForcedResign', '$t_strForcedResignParticulars', '$t_strCandidate', '$t_strCandidateParticulars', '$t_strComTaxNumber', '$t_strIssuedAt', '$t_strIssuedOn', '$t_strGSISNumber', '$t_strPAGIBIGNumber', '$t_strPHILHEALTHNumber', '$t_strOPLNumber1', '$t_strOPLNumber2', '$t_strOPLNumber3')";
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
	
	function addEducation($t_strEmpNumber, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_strUnits, $t_strSchoolFromMonth, $t_strSchoolFromDay, $t_strSchoolFromYear, $t_strSchoolToMonth, $t_strSchoolToDay, $t_strSchoolToYear, $t_strHonors, $Submit)   //Add employee educational attainment
   {
      if ($Submit == 'Submit')
	  {
 		 $t_strSchoolFromDate = $this->combineDate($t_strSchoolFromYear, $t_strSchoolFromMonth, $t_strSchoolFromDay);
 		 $t_strSchoolToDate = $this->combineDate($t_strSchoolToYear, $t_strSchoolToMonth, $t_strSchoolToDay);
	     $results = "INSERT INTO tblEmpSchool (empNumber, levelCode, schoolName, course, units, schoolFromDate, schoolToDate, honors) VALUES ('$t_strEmpNumber', '$t_strLevelCode', '$t_strSchoolName', '$t_strCourse', '$t_strUnits', '$t_strSchoolFromDate', '$t_strSchoolToDate', '$t_strHonors')";
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

	function addEmployeeExam($t_strEmpNumber, $t_strExamCode, $t_strExamMonth, $t_strExamDay, $t_strExamYear, $t_intExamRating, $t_strExamPlace, $Submit)   //Add employee
   {
      if ($Submit == 'Submit')
	  {
 		 $t_strExamDate = $this->combineDate($t_strExamYear, $t_strExamMonth, $t_strExamDay);
	     $results = "INSERT INTO tblEmpExam (empNumber, examCode, examDate, examRating, examPlace) VALUES ('$t_strEmpNumber', '$t_strExamCode', '$t_strExamDate', '$t_intExamRating', '$t_strExamPlace')";
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
	
	function addChild($t_strEmpNumber, $t_strChildName, $t_strChildBirthMonth, $t_strChildBirthDay, $t_strChildBirthYear, $Submit)   //Add employee children information
   {
      if ($Submit == 'Submit')
	  {
	     $t_strChildBirthDate = $this->combineDate($t_strChildBirthYear, $t_strChildBirthMonth, $t_strChildBirthDay);
	     $results = "INSERT INTO tblEmpChild (empNumber, childName, childBirthDate) VALUES ('$t_strEmpNumber', '$t_strChildName', '$t_strChildBirthDate')";
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
	
function addTraining($t_strEmpNumber, $t_strTrainingCode, $t_strTrainingContractMonth, $t_strTrainingContractDay, $t_strTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_strTrainingStartMonth, $t_strTrainingStartDay, $t_strTrainingStartYear, $t_dtmTrainingStartTimeHrs, $t_dtmTrainingStartTimeMin, $t_dtmTrainingStartTimeSec, $t_dtmTrainingAMPMStart, $t_strTrainingEndMonth, $t_strTrainingEndDay, $t_strTrainingEndYear, $t_dtmTrainingEndTimeHrs, $t_dtmTrainingEndTimeMin, $t_dtmTrainingEndTimeSec, $t_dtmTrainingAMPMEnd, $t_intTrainingHours, $t_intTrainingCost, $Submit)   //Add employee training/seminar
   {
      if ($Submit == 'Submit')
	  {
 		 $t_strTrainingContractDate = $this->combineDate($t_strTrainingContractYear, $t_strTrainingContractMonth, $t_strTrainingContractDay);
 		 $t_strTrainingStartDate = $this->combineDate($t_strTrainingStartYear, $t_strTrainingStartMonth, $t_strTrainingStartDay);
 		 $t_strTrainingEndDate = $this->combineDate($t_strTrainingEndYear, $t_strTrainingEndMonth, $t_strTrainingEndDay);
       	 $t_dtmTrainingStart = $this->combineHrMnSc($t_dtmTrainingStartTimeHrs, $t_dtmTrainingStartTimeMin, $t_dtmTrainingStartTimeSec);
 	  	 $t_dtmTrainingEnd = $this->combineHrMnSc($t_dtmTrainingEndTimeHrs, $t_dtmTrainingEndTimeMin, $t_dtmTrainingEndTimeSec);
		 $t_dtmTrainingTimeStart = $this->combineTime($t_dtmTrainingStart, $t_dtmTrainingAMPMStart);
 		 $t_dtmTrainingTimeEnd = $this->combineTime($t_dtmTrainingEnd, $t_dtmTrainingAMPMEnd);
	     $results = "INSERT INTO tblEmpTraining (empNumber, trainingCode, trainingContractDate, trainingConductedBy, trainingVenue, trainingStartDate, trainingTimeStart, trainingEndDate, trainingTimeEnd, trainingHours, trainingCost) VALUES ('$t_strEmpNumber', '$t_strTrainingCode', '$t_strTrainingContractDate', '$t_strTrainingConductedBy', '$t_strTrainingVenue', '$t_strTrainingStartDate', '$t_dtmTrainingTimeStart', '$t_strTrainingEndDate', '$t_dtmTrainingTimeEnd', '$t_intTrainingHours', '$t_intTrainingCost')";
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
		
	function addServiceRecords($t_strEmpNumber, $t_dtmServiceFromMonth, $t_dtmServiceFromDay, $t_dtmServiceFromYear, $t_dtmServiceToMonth, $t_dtmServiceToDay, $t_dtmServiceToYear,  $t_strPositionCode, $t_strAppointmentCode, $t_strBranch, $t_intSalary, $t_strStationAgency, $t_intLeaveWoPay, $t_strSeparationCause, $t_dtmSeparationMonth, $t_dtmSeparationDay, $t_dtmSeparationYear, $Submit)   //Add service record
   {
      if ($Submit == 'Submit')
	  {
 		 $t_dtmServiceFromDate = $this->combineDate($t_dtmServiceFromYear, $t_dtmServiceFromMonth, $t_dtmServiceFromDay);
 		 $t_dtmServiceToDate = $this->combineDate($t_dtmServiceToYear, $t_dtmServiceToMonth, $t_dtmServiceToDay);
 		 $t_dtmSeparationDate = $this->combineDate($t_dtmSeparationYear, $t_dtmSeparationMonth, $t_dtmSeparationDay);
	     $results = "INSERT INTO tblServiceRecord (empNumber, serviceFromDate, serviceToDate, positionCode, appointmentCode, branch, salary, stationAgency, leaveWoPay, separationCause, separationDate) VALUES ('$t_strEmpNumber', '$t_dtmServiceFromDate', '$t_dtmServiceToDate', '$t_strPositionCode', '$t_strAppointmentCode', '$t_strBranch', '$t_intSalary', '$t_strStationAgency', '$t_intLeaveWoPay', '$t_strSeparationCause', '$t_dtmSeparationDate')";
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
			
	function addPositionDetails($t_strEmpNumber, $t_strAppointmentCode, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_strFirstDayAgency, $t_intStep, $t_strFirstDayGov, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_intHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveMonth, $t_strEffectiveDay, $t_strEffectiveYear, $t_strLongevityMonth, $t_strLongevityDay, $t_strLongevityYear, $t_strPositionMonth, $t_strPositionDay, $t_strPositionYear, $t_strContractEndMonth, $t_strContractEndDay, $t_strContractEndYear, $t_intActualSalary, $Submit)   //Add employee position details
   {
      if ($Submit == 'Submit')
	  {
 		 $t_strEffectiveDate = $this->combineDate($t_strEffectiveYear, $t_strEffectiveMonth, $t_strEffectiveDay);
 		 $t_strLongevityDate = $this->combineDate($t_strLongevityYear, $t_strLongevityMonth, $t_strLongevityDay);
 		 $t_strPositionDate = $this->combineDate($t_strPositionYear, $t_strPositionMonth, $t_strPositionDay);
 		 $t_strContractEndDate = $this->combineDate($t_strContractEndYear, $t_strContractEndMonth, $t_strContractEndDay);
	     $results = "INSERT INTO tblEmpPosition (empNumber, appointmentCode, serviceCode, sectionCode, positionCode, divisionCode, taxStatCode, itemNumber, firstDayAgency, step, firstDayGov, personnelAction,  employmentBasis, categoryService, nature, hpFactor, payrollSwitch, dtrSwitch, dependents, healthProvider, effectiveDate, longevityDate, positionDate, contractEndDate, actualSalary) VALUES ('$t_strEmpNumber', '$t_strAppointmentCode', '$t_strServiceCode', '$t_strSectionCode', '$t_strPositionCode', '$t_strDivisionCode', '$t_strTaxStatCode', '$t_strItemNumber', '$t_strFirstDayAgency', '$t_intStep', '$t_strFirstDayGov', '$t_strPersonnelAction', '$t_strEmploymentBasis', '$t_strCategoryService', '$t_strNatureOfWork', '$t_intHPFactor', '$t_strPayrollSwitch', '$t_strDTRSwitch', '$t_intDependents', '$t_strHealthProvider', '$t_strEffectiveDate', '$t_strLongevityDate', '$t_strPositionDate', '$t_strContractEndDate', '$t_intActualSalary')";
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

	
	function addReference($t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_strRefTelephone, $Submit)   //Add employee reference
   {
      if ($Submit == 'Submit')
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
	
	function email_check($t_strEmail) { 
	   if (eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](g|l|m|pa|t|u|v)?$", $t_strEmail, $check)) { 
		  if (checkdnsrr(substr(strstr($check[0], '@'), 1), "ANY")) { 
			 return TRUE; 
		  } 
	   } 
	   return FALSE; 
	} 
	
function getPicture($t_strEmpNumber)
	{
		$objRecordset = mysql_query("SELECT picture,filetype FROM tblEmpPersonal WHERE empNumber='$t_strEmpNumber'");

		while($arrPicture=mysql_fetch_array($objRecordset))
		{
			$strImage = $arrPicture["picture"];
		}

		if(strlen($strImage) == 0)   //username is invalid
		{
			$objRecordset = mysql_query("SELECT agencyLogo FROm tblAgency");
			while($arrPicture=mysql_fetch_array($objRecordset))
			{
				$strImage = $arrPicture["agencyLogo"];
				return $strImage;
			}
			
		}
		else
		{
			return $strImage;   //show photo to screen		
			// go query and get the photo
		}
	}
		
}
?>