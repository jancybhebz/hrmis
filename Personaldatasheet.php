<?php 
/* 
File Name: Personaldatasheet.php
----------------------------------------------------------------------
Purpose of this file: 
To add employees information to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: February 26, 2003 (Version 1.0.1)
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
session_start();
include("../hrmis/class/Security.php");
include("../hrmis/class/Personaldatasheet.php");
$objEmployee= new personalDataSheet;
$objEmployee->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
$arrEmpPersonal = $objEmployee->checkGetEmpNmbr("201", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p);

$arrEmpPersonal2 = $objEmployee->checkGetEmpNmbr("Employee", $strEmpNmbr);

/*  -------------------------------------- PERSONAL INFORMATION  ----------------------------------- */

$objEmployee->addEmployee($strEmpNmbr, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_dtmBirthMonth, $t_dtmBirthDay, $t_dtmBirthYear, $t_strBirthPlace, $t_strSex, $t_strCivilStatus, $t_strCitizenship, $t_intHeight, $t_intWeight, $t_strBloodType, $t_strGSISNumber, $t_intPAGIBIGNumber, $t_intPHILHEALTHNumber, $t_strResidentialAddress, $t_intZipCode1, $t_intTelephone1, $t_strPermanentAddress, $t_intZipCode2, $t_intTelephone2, $t_strEmail, $t_intMobile, $t_strEmpNumber, $t_intTin, $t_strSpouse, $t_strSpouseWork, $t_strSpouseBusName, $t_strSpouseBusAddress, $t_intSpouseTelephone, $t_strFatherName, $t_strMotherName, $t_strParentAddress, $t_strSkills, $t_strNADR, $t_strMIAO, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strAdminCaseParticulars, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strIndigenous, $t_strIndigenousParticulars, $t_strDisabled, $t_strDisabledParticulars, $t_strSoloParent, $t_strSoloParentParticulars, $t_strSignature, $t_dtmDateAccMonth, $t_dtmDateAccDay, $t_dtmDateAccYear, $t_strComTaxNumber, $t_strIssuedAt, $t_dtmIssuedOnMonth, $t_dtmIssuedOnDay, $t_dtmIssuedOnYear, $Submit);   //Add employee personal data (tblEmpPersonal)

/*  -------------------------------------- CHILDREN INFORMATION  ----------------------------------- */
if ($Submit == 'ADD') {
	if ($t_strChildName != '') 
	{
	$objEmployee->addChild($strEmpNmbr, $t_strEmpNumber, $t_strChildName, $t_dtmChildBirthMonth, $t_dtmChildBirthDay, $t_dtmChildBirthYear, $Submit);   //Add Children
	} 
}
	
if ($Submit == 'ADD') {
	if ($t_strChildName2 != '') 
	{
	$objEmployee->addChild2($strEmpNmbr, $t_strEmpNumber, $t_strChildName2, $t_dtmChildBirthMonth2, $t_dtmChildBirthDay2, $t_dtmChildBirthYear2, $Submit);  //Add employee children information
	} 
}

if ($Submit == 'ADD') {
	if ($t_strChildName3 != '') 
	{
	$objEmployee->addChild3($strEmpNmbr, $t_strEmpNumber, $t_strChildName3, $t_dtmChildBirthMonth3, $t_dtmChildBirthDay3, $t_dtmChildBirthYear3, $Submit);  //Add employee children information
	} 
}

if ($Submit == 'ADD') {
	if ($t_strChildName4 != '') 
	{
	$objEmployee->addChild4($strEmpNmbr, $t_strEmpNumber, $t_strChildName4, $t_dtmChildBirthMonth4, $t_dtmChildBirthDay4, $t_dtmChildBirthYear4, $Submit);  //Add employee children information
	} 
}
/*  -------------------------------------- EDUCATIONAL ATTAINMENT  ----------------------------------- */

if ($Submit == 'ADD') {
	if ($t_strElementarySchoolName != '') 
	{
	$objEmployee->addElementary($strEmpNmbr, $t_strEmpNumber, $t_strElementary, $t_strElementarySchoolName, $t_strElementaryCourse, $t_intElementaryUnits, $t_dtmElementaryFromMonth, $t_dtmElementaryFromDay, $t_dtmElementaryFromYear, $t_dtmElementaryToMonth, $t_dtmElementaryToDay, $t_dtmElementaryToYear, $t_strElementaryHonors, $Submit);   //Add employee educational attainment (tblEmpSchool)
	} 
}

if ($Submit == 'ADD') {
	if ($t_strSecondarySchoolName != '') 
	{
	$objEmployee->addSecondary($strEmpNmbr, $t_strEmpNumber, $t_strSecondary, $t_strSecondarySchoolName, $t_strSecondaryCourse, $t_intSecondaryUnits, $t_dtmSecondaryFromMonth, $t_dtmSecondaryFromDay, $t_dtmSecondaryFromYear, $t_dtmSecondaryToMonth, $t_dtmSecondaryToDay, $t_dtmSecondaryToYear, $t_strSecondaryHonors, $Submit);   //Add employee educational attainment (tblEmpSchool)
	} 
}

if ($Submit == 'ADD') {
	if ($t_strVocationalSchoolName != '') 
	{
	$objEmployee->addVocational($strEmpNmbr, $t_strEmpNumber, $t_strVocational, $t_strVocationalSchoolName, $t_strVocationalCourse, $t_intVocationalUnits, $t_dtmVocationalFromMonth, $t_dtmVocationalFromDay, $t_dtmVocationalFromYear, $t_dtmVocationalToMonth, $t_dtmVocationalToDay, $t_dtmVocationalToYear, $t_strVocationalHonors, $Submit);   //Add employee educational attainment (tblEmpSchool)
	} 
}

if ($Submit == 'ADD') {
	if ($t_strTertiarySchoolName != '') 
	{
	$objEmployee->addTertiary($strEmpNmbr, $t_strEmpNumber, $t_strTertiary, $t_strTertiarySchoolName, $t_strTertiaryCourse, $t_intTertiaryUnits, $t_dtmTertiaryFromMonth, $t_dtmTertiaryFromDay, $t_dtmTertiaryFromYear, $t_dtmTertiaryToMonth, $t_dtmTertiaryToDay, $t_dtmTertiaryToYear, $t_strTertiaryHonors, $Submit);   //Add employee educational attainment (tblEmpSchool)
	} 
}

if ($Submit == 'ADD') {
	if ($t_strCollegeSchoolName != '') 
	{
	$objEmployee->addCollege($strEmpNmbr, $t_strEmpNumber, $t_strCollege, $t_strCollegeSchoolName, $t_strCollegeCourse, $t_intCollegeUnits, $t_dtmCollegeFromMonth, $t_dtmCollegeFromDay, $t_dtmCollegeFromYear, $t_dtmCollegeToMonth, $t_dtmCollegeToDay, $t_dtmCollegeToYear, $t_strCollegeHonors, $Submit);  //Add employee educational attainment (tblEmpSchool)
	} 
}

if ($Submit == 'ADD') {
	if ($t_strMasterDegreeSchoolName != '') 
	{
	$objEmployee->addMasterDegree($strEmpNmbr, $t_strEmpNumber, $t_strMasterDegree, $t_strMasterDegreeSchoolName, $t_strMasterDegreeCourse, $t_intMasterDegreeUnits, $t_dtmMasterDegreeFromMonth, $t_dtmMasterDegreeFromDay, $t_dtmMasterDegreeFromYear, $t_dtmMasterDegreeToMonth, $t_dtmMasterDegreeToDay, $t_dtmMasterDegreeToYear, $t_strMasterDegreeHonors, $Submit);   //Add employee educational attainment (tblEmpSchool)
	} 
}

if ($Submit == 'ADD') {
	if ($t_strDoctorateSchoolName != '') 
	{
	$objEmployee->addDoctorate($strEmpNmbr, $t_strEmpNumber, $t_strDoctorate, $t_strDoctorateSchoolName, $t_strDoctorateCourse, $t_intDoctorateUnits, $t_dtmDoctorateFromMonth, $t_dtmDoctorateFromDay, $t_dtmDoctorateFromYear, $t_dtmDoctorateToMonth, $t_dtmDoctorateToDay, $t_dtmDoctorateToYear, $t_strDoctorateHonors, $Submit);   //Add employee educational attainment (tblEmpSchool)
	} 
}

if ($Submit == 'ADD') {
	if ($t_strNonDegreeCourseSchoolName != '') 
	{
	$objEmployee->addNonDegreeCourse($strEmpNmbr, $t_strEmpNumber, $t_strNonDegreeCourse, $t_strNonDegreeCourseSchoolName, $t_strNonDegreeCourseCourse, $t_intNonDegreeCourseUnits, $t_dtmNonDegreeCourseFromMonth, $t_dtmNonDegreeCourseFromDay, $t_dtmNonDegreeCourseFromYear, $t_dtmNonDegreeCourseToMonth, $t_dtmNonDegreeCourseToDay, $t_dtmNonDegreeCourseToYear, $t_strNonDegreeCourseHonors, $Submit);   //Add employee educational attainment (tblEmpSchool)
	} 
}

/*  -------------------------------------- EXAMINATION  ----------------------------------- */
if ($Submit == 'ADD') {
	if ($t_intExamRating != '') 
	{
$objEmployee->addExamination($strEmpNmbr, $t_strEmpNumber, $t_strExamCode, $t_intExamRating, $t_dtmExamMonth, $t_dtmExamDay, $t_dtmExamYear, $t_strExamPlace, $t_strLicenseNumber, $t_dtmDateReleaseMonth, $t_dtmDateReleaseDay, $t_dtmDateReleaseYear, $Submit);   //Load addEmployeeExam function
	}
}
/*  -------------------------------------- WORK EXPERIENCE  ----------------------------------- */
if ($Submit == 'ADD') {
	if ($t_strStationAgency != '') 
	{
	$objEmployee->addServiceRecords($strEmpNmbr, $t_strEmpNumber, $t_dtmServiceFromMonth, $t_dtmServiceFromDay, $t_dtmServiceFromYear, $t_dtmServiceToMonth, $t_dtmServiceToDay, $t_dtmServiceToYear, $t_strPositionCode, $t_strStationAgency, $t_intSalary, $t_strAppointmentCode, $t_strSeparationCause, $t_dtmSeparationMonth, $t_dtmSeparationDay, $t_dtmSeparationYear, $Submit);  //Add employee service record/work experience
	} 
}

/*  -------------------------------------- Voluntary Work  ----------------------------------- */

if ($Submit == 'ADD') {
	if ($t_strVWName != '') 
	{
	$objEmployee->addVoluntaryWork($strEmpNmbr, $t_strEmpNumber, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay, $t_dtmVWDateFromYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay, $t_dtmVWDateToYear,  $t_intVWHours, $t_strVWPosition, $Submit);   //Load add voluntary work information function
	} 
}

/*  -------------------------------------- TRAINING / SEMINAR  ----------------------------------- */
if ($Submit == 'ADD') {
	if ($t_strTrainingCode != '') 
	{
	$objEmployee->addTraining($strEmpNmbr, $t_strEmpNumber, $t_strTrainingCode, $t_dtmTrainingStartMonth, $t_dtmTrainingStartDay, $t_dtmTrainingStartYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay, $t_dtmTrainingEndYear, $t_intTrainingHours, $t_strTrainingConductedBy, $Submit);   //Add employee training/seminar
	} 
}

/*  -------------------------------------- POSITION DETAILS  ----------------------------------- */

$objEmployee->addPositionDetails($strEmpNmbr, $t_strEmpNumber, $t_strAppointmentCode, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_strFirstDayAgency, $t_intStepNumber, $t_strFirstDayGov, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_intHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveMonth, $t_strEffectiveDay, $t_strEffectiveYear, $t_strLongevityMonth, $t_strLongevityDay, $t_strLongevityYear, $t_strPositionMonth, $t_strPositionDay, $t_strPositionYear, $t_strContractEndMonth, $t_strContractEndDay, $t_strContractEndYear, $t_intActualSalary, $Submit);   //Add employee position details

/*  -------------------------------------- REFERENCES  ---------------------------------------- */

$objEmployee->addReference($strEmpNmbr, $t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $Submit);   //Add employee reference

?>
<html><!-- InstanceBegin template="/Templates/Personaltmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
include("../hrmis/javascript/Personaldatasheet.js");
?>
<script >

<!-- Begin
nextfield = "strEmpNumber"; // name of first box on page
netscape = "";
ver = navigator.appVersion; len = ver.length;
for(iln = 0; iln < len; iln++) if (ver.charAt(iln) == "(") break;
netscape = (ver.charAt(iln+1).toUpperCase() != "C");

function keyDown(DnEvents) { // handles keypress
// determines whether Netscape or Internet Explorer
k = (netscape) ? DnEvents.which : window.event.keyCode;
if (k == 13) { // enter key pressed
if (nextfield == 'Submit2') return true; // submit, we finished all fields
else { // we're not done yet, send focus to next box
eval('document.frmEmpNumber.' + nextfield + '.focus()');
return false;
      }
   }
}
document.onkeydown = keyDown; // work together to analyze keystrokes
if (netscape) document.captureEvents(Event.KEYDOWN|Event.KEYUP);
//  End -->

function validateCharacterAndNumber(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZ'+ +'abcdefghijklmnopqrstuvwxyz0123456789-"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters and numbers are accepted!");
	field.focus();
	field.select();
    }
}

function validateAgencyEmployeeNumber(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters, numbers and dash are accepted!");
	field.focus();
	field.select();
    }
}

function validateFullName(field) 
{
	var valid = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ abcdefghijklmnñopqrstuvwxyz,."
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters, comma, period and spaces are accepted!");
	field.focus();
	field.select();
    }
}

function validateCharacter(field) 
{
	var valid = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ abcdefghijklmnñopqrstuvwxyz."
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters, period and spaces are accepted!");
	field.focus();
	field.select();
    }
}

function validateNumber(field) 
{
	var valid = "0123456789'+-+'"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only numbers are accepted!");
	field.focus();
	field.select();
    }
}

function validateAddress(field) 
{
	var valid = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ'+ +'abcdefghijklmnñopqrstuvwxyz0123456789'+-+',."
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters, numbers, period, commas and dash are accepted!");
	field.focus();
	field.select();
    }
}

function validateGSISNumber(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZ'+ +'abcdefghijklmnopqrstuvwxyz0123456789'+-+'"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters, numbers and dash are accepted!");
	field.focus();
	field.select();
    }
}

function validateWeightHeight(field) 
{
	var valid = "0123456789'+.+'"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only numbers and period/point are accepted!");
	field.focus();
	field.select();
    }
}

function validateEmail(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZ.@_'+ +'abcdefghijklmnopqrstuvwxyz0123456789'+-+'"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Please try again!");
	field.focus();
	field.select();
    }
}

function checkEmail(myForm) {
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.t_strEmail.value)){
return (true)
}
alert("Invalid E-mail Address! Please re-enter.")
return (false)
}

<!--
function DegreeParticulars()
{
	document.all.t_strRelatedDegreeParticulars.focus();
}
function AdminCaseParticulars()
{
	document.all.t_strAdminCaseParticulars.focus();
}
function ViolateLawParticulars()
{
	document.all.t_strViolateLawParticulars.focus();
}
function ForcedResignParticulars()
{
	document.all.t_strForcedResignParticulars.focus();
}
function CandidateParticulars()
{
	document.all.t_strCandidateParticulars.focus();
}
function IndigenousParticulars()
{
	document.all.t_strIndigenousParticulars.focus();
}
function DisabledParticulars()
{
	document.all.t_strDisabledParticulars.focus();
}
function SoloParentParticulars()
{
	document.all.t_strSoloParentParticulars.focus();
}
//-->

function validateEmpNumber(){
if (document.frmEmpNumber.strEmpNumber.value=="") {
alert("Please input employee number!")
return false
}

return true
}

function validate(){
var digits="0123456789"
var temp
if (document.frmPDS.t_strSurname.value=="") {
alert("Please input Surname!")
return false
} else if (document.frmPDS.t_strFirstname.value=="") {
alert("Please input Firstname!")
return false
} else if (document.frmPDS.t_strMiddlename.value=="") {
alert("Please input Middle Name!")
return false
} else if (document.frmPDS.t_dtmBirthMonth.value=="") {
alert("Please input birth month!")
return false
} else if (document.frmPDS.t_dtmBirthDay.value=="") {
alert("Please input birth day!")
return false
} else if (document.frmPDS.t_dtmBirthYear.value=="") {
alert("Please input birth year!")
return false
} else if (document.frmPDS.t_strBirthPlace.value=="") {
alert("Please input place of birth!")
return false
} else if (document.frmPDS.t_strSex.value=="") {
alert("Please input sex!")
return false
} else if (document.frmPDS.t_strCivilStatus.value=="") {
alert("Please input civil status!")
return false
} else if (document.frmPDS.t_strCitizenship.value=="") {
alert("Please input Citizenship!")
return false
} else if (document.frmPDS.t_intHeight.value=="") {
alert("Please input height!")
return false
} else if (document.frmPDS.t_intWeight.value=="") {
alert("Please input weight!")
return false
} else if (document.frmPDS.t_strBloodType.value=="") {
alert("Please input blood type!")
return false
} else if (document.frmPDS.t_strResidentialAddress.value=="") {
alert("Please input residential address!")
return false
} else if (document.frmPDS.t_strPermanentAddress.value=="") {
alert("Please input permanent address!")
return false
} else if (document.frmPDS.t_strEmpNumber.value=="") {
alert("Please input employee number!")
return false
} else if (document.frmPDS.t_strFatherName.value=="") {
alert("Please input father name!")
return false
} else if (document.frmPDS.t_strMotherName.value=="") {
alert("Please input mother name!")
return false
} else if (document.frmPDS.t_strParentAddress.value=="") {
alert("Please input parent address!")
return false
} else if (document.frmPDS.t_strRefName.value=="") {
alert("Please input name of reference!")
return false
} else if (document.frmPDS.t_strRefAddress.value=="") {
alert("Please input reference address!")
return false
} else if (document.frmPDS.t_intRefTelephone.value=="") {
alert("Please input reference telephone number!")
return false
} else if (document.frmPDS.t_strComTaxNumber.value=="") {
alert("Please input Tax account number!")
return false
} else if (document.frmPDS.t_strIssuedAt.value=="") {
alert("Please input CTC place of issue!")
return false
} else if (document.frmPDS.t_intIssuedOn.value=="") {
alert("Please input CTC date of issue!")
return false
}

if (document.frmPDS.t_intCityNumber.value=="") {
alert("Please input City Number!")
return false
}
for (var i=0;i<document.frmPDS.t_intCityNumber.value.length;i++){
temp=document.frmPDS.t_intCityNumber.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Invalid city number !")
return false
      }
   }
return true
}

function emailCheck(emailStr) {
<!-- Changes:  Sandeep V. Tamhankar (stamhankar@hotmail.com) -->
// onSubmit="return emailCheck(this.t_strEmail.value);"
/* The following pattern is used to check if the entered e-mail address
   fits the user@domain format.  It also is used to separate the username
   from the domain. */
var emailPat=/^(.+)@(.+)$/
/* The following string represents the pattern for matching all special
   characters.  We don't want to allow special characters in the address. 
   These characters include ( ) < > @ , ; : \ " . [ ]    */
var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
/* The following string represents the range of characters allowed in a 
   username or domainname.  It really states which chars aren't allowed. */
var validChars="\[^\\s" + specialChars + "\]"
/* The following pattern applies if the "user" is a quoted string (in
   which case, there are no rules about which characters are allowed
   and which aren't; anything goes).  E.g. "jiminy cricket"@disney.com
   is a legal e-mail address. */
var quotedUser="(\"[^\"]*\")"
/* The following pattern applies for domains that are IP addresses,
   rather than symbolic names.  E.g. joe@[123.124.233.4] is a legal
   e-mail address. NOTE: The square brackets are required. */
var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
/* The following string represents an atom (basically a series of
   non-special characters.) */
var atom=validChars + '+'
/* The following string represents one word in the typical username.
   For example, in john.doe@somewhere.com, john and doe are words.
   Basically, a word is either an atom or quoted string. */
var word="(" + atom + "|" + quotedUser + ")"
// The following pattern describes the structure of the user
var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
/* The following pattern describes the structure of a normal symbolic
   domain, as opposed to ipDomainPat, shown above. */
var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")


/* Finally, let's start trying to figure out if the supplied address is
   valid. */

/* Begin with the coarse pattern to simply break up user@domain into
   different pieces that are easy to analyze. */
var matchArray=emailStr.match(emailPat)
if (matchArray==null) {
  /* Too many/few @'s or something; basically, this address doesn't
     even fit the general mould of a valid e-mail address. */
	alert("Email address seems incorrect (check @ and .'s)")
	return false
}
var user=matchArray[1]
var domain=matchArray[2]

// See if "user" is valid 
if (user.match(userPat)==null) {
    // user is not valid
    alert("The username doesn't seem to be valid.")
    return false
}

/* if the e-mail address is at an IP address (as opposed to a symbolic
   host name) make sure the IP address is valid. */
var IPArray=domain.match(ipDomainPat)
if (IPArray!=null) {
    // this is an IP address
	  for (var i=1;i<=4;i++) {
	    if (IPArray[i]>255) {
	        alert("Destination IP address is invalid!")
		return false
	    }
    }
    return true
}

// Domain is symbolic name
var domainArray=domain.match(domainPat)
if (domainArray==null) {
	alert("The domain name doesn't seem to be valid.")
    return false
}

/* domain name seems valid, but now make sure that it ends in a
   three-letter word (like com, edu, gov) or a two-letter word,
   representing country (uk, nl), and that there's a hostname preceding 
   the domain or country. */

/* Now we need to break up the domain to get a count of how many atoms
   it consists of. */
var atomPat=new RegExp(atom,"g")
var domArr=domain.match(atomPat)
var len=domArr.length
if (domArr[domArr.length-1].length<2 || 
    domArr[domArr.length-1].length>3) {
   // the address must end in a two letter or three letter word.
   alert("The address must end in a three-letter domain, or two letter country.")
   return false
}

// Make sure there's a host name preceding the domain.
if (len<2) {
   var errStr="This address is missing a hostname!"
   alert(errStr)
   return false
}

// If we've gotten this far, everything's valid!
return true;
}

function TINValidation(t_intTin) {
var matchArr = t_intTin.match(/^(\d{3})-?\d{3}-?\d{3}$/);
var numDashes = t_intTin.split('-').length - 1;
if (matchArr == null || numDashes == 1) {
alert('Invalid TIN. Must be 9 digits or in the form NNN-NNN-NNN.');
msg = "does not appear to be valid";
}
else 
if (parseInt(matchArr[1],10)==0) {
alert("Invalid TIN: TIN's can't start with 000.");
msg = "does not appear to be valid";
}
else {
msg = "appears to be valid";
alert(t_intTin + "\r\n\r\n" + msg + " Tax Identification Number.");
   }
}
-->

</script>
<!-- InstanceEndEditable --> 
<!-- Design/Images Made By : Angelo Campos Evangelista  -->
<!-- Template Made By : Pearliezl Samoy Dy Tioco  -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()" -->

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<link href="hrmis.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/education2.jpg','images/trainings2.jpg','images/examinations2.jpg','images/position2.jpg','images/logout2.jpg','images/family-background2.jpg','images/work-experience2.jpg','images/voluntary-work2.jpg','images/personal-information2.jpg','images/other-information2.jpg','images/notificationover.jpg','images/201click.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/librariesover.jpg','images/compensationover.jpg','images/dutiesandresponsibilities2.jpg','images/editmodifyemployeenumber2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="tblHRMODULE">
        <tr> 
          <td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblModule">
              <tr> 
                <td><img src="images/hrmodule.jpg" width="170" height="23"></td>
              </tr>
            </table></td>
          <td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblSECTION1">
              <tr> 
                <td valign="bottom"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Officer" && $t_strAccessPermission == 123456) 
{
?>
                  <table width="78%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                    <tr> 
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION1','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION1" name="NOTIFICATION1" width="96" height="29" border="0"></a></td>
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE1','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE1" name="PROFILE1" width="67" height="29" border="0"></a></td>
                      <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE1','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE1" name="ATTENDANCE1" width="88" height="29" border="0"></a></td>
                      <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS1" width="60" height="29" border="0"></a></td>
                      <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES1','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES1" name="LIBRARIES1" width="67" height="29" border="0"></a></td>
                      <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION1" name="COMPENSATION1" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 12) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNotificationProfile">
                    <tr> 
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>%20" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION2','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION2" name="NOTIFICATION2" width="96" height="29" border="0"></a></td>
                      <td width="55%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission;?>%20" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE2','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE2" name="PROFILE2" width="67" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 23) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILEATTENDANCE">
                    <tr> 
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE3','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE3" name="PROFILE3" width="67" height="29" border="0"></a></td>
                      <td width="73%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE3','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE3" name="ATTENDANCE3" width="88" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 24) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILEREPORTS">
                    <tr> 
                      <td width="59%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE4','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE4" name="PROFILE4" width="67" height="29" border="0"></a></td>
                      <td width="41%"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS4','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS4" name="REPORTS4" width="60" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 25) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILELIBRARIES">
                    <tr> 
                      <td width="59%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE5','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE5" name="PROFILE5" width="67" height="29" border="0"></a></td>
                      <td width="41%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES5','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES5" name="LIBRARIES5" width="67" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 26) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILECOMPENSATION">
                    <tr> 
                      <td width="14%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE6','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE6" name="PROFILE6" width="67" height="29" border="0"></a></td>
                      <td width="86%"><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION6','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION6" name="COMPENSATION6" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr>
                <td valign="bottom">
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 2) 
{
?>
                  <table width="10%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILECOMPENSATION">
                    <tr> 
                      <td width="14%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE61','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE6" name="PROFILE61" width="67" height="29" border="0" id="PROFILE61"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr>
                <td valign="bottom">
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                  <table width="78%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATIONCASHIER">
                    <tr> 
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION11','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION1" name="NOTIFICATION11" width="96" height="29" border="0" id="NOTIFICATION11"></a></td>
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE11','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE1" name="PROFILE11" width="67" height="29" border="0" id="PROFILE11"></a></td>
                      <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE11','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE1" name="ATTENDANCE11" width="88" height="29" border="0" id="ATTENDANCE11"></a></td>
                      <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS11','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS11" width="60" height="29" border="0" id="REPORTS11"></a></td>
                      <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES11','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES1" name="LIBRARIES11" width="67" height="29" border="0" id="LIBRARIES11"></a></td>
                      <td><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION11','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION1" name="COMPENSATION11" width="104" height="29" border="0" id="COMPENSATION11"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the HR Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="16%" height="348"><table width="150" height="348" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td><table width="90%" height="339" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="339" valign="top"> <form name="frm201" method="get" action="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr;?>">
                                      <input name="txtSearch" type="text" size="15" maxlength="30" value="<? echo $txtSearch;?>">
                                      <a href="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr?>" onMouseOut="statusBar()" onFocus="statusBar()" onMouseOver=" statusBar(); return true;" onClick="statusBar();"> 
                                      <input type="image" src="images/go.jpg" alt="Go" name="Go" width="19" height="17" border="0" align="absmiddle">
                                      </a> 
                                      <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr;?>">
                                      <br>
                                      <?
									  if($optField == "empNmbr" || $optField == "")
									  {
									  	echo "<input name='optField' type='radio' value='empNmbr' checked>";
									  }
									  else
									  {
									  	echo "<input name='optField' type='radio' value='empNmbr'>";
									  }
									  ?>
                                      Employee Number<br>
                                      <?
									  if($optField == "empName")
									  {
									  	echo "<input name='optField' type='radio' value='empName' checked>";
									  }
									  else
									  {
									  	echo "<input name='optField' type='radio' value='empName'>";
									  }
									  ?>
                                      Employee Name<br>
                                      <br>
                                      &nbsp;<br>
                                    </form>
                                    <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                                    <table width="108" height="187" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td><a href="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('profile','','images/personal-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/personal-information.jpg" alt="profile" name="profile" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalfamily.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('familybackground','','images/family-background2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/family-background.jpg" alt="familybackground" name="familybackground" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaleducation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Education','','images/education2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/education1.jpg" alt="Education" name="Education" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalexaminations.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('examinations','','images/examinations2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/examinations1.jpg" alt="examinations" name="examinations" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalworkexperience.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('workexperience','','images/work-experience2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/work-experience.jpg" alt="workexperience" name="workexperience" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalvoluntarywork.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('voluntarywork','','images/voluntary-work2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/voluntary-work.jpg" alt="voluntarywork" name="voluntarywork" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaltrainings.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Trainings','','images/trainings2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/trainings1.jpg" alt="Trainings" name="Trainings" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalotherinfo.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('otherinformation','','images/other-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/other-information.jpg" alt="otherinformation" name="otherinformation" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="Personalpositiondetails.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PositionDetails','','images/position2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/position1.jpg" alt="Position Details" name="PositionDetails" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="5"><a href="Personalduties.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('duties&responsibilities','','images/dutiesandresponsibilities2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/dutiesandresponsibilities.jpg" alt="duties&responsibilities" name="duties&responsibilities" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td height="5"><a href="PersonalEmpNumber.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore();statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empNumber','','images/editmodifyemployeenumber2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/editmodifyemployeenumber.jpg" alt="empNumber" name="empNumber" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table>
<? 
} else { 
?>
                                    <table width="108" height="187" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td><a href="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('profile1','','images/personal-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/personal-information.jpg" alt="profile" name="profile1" width="108" height="27" border="0" id="profile1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalfamily.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('familybackground1','','images/family-background2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/family-background.jpg" alt="familybackground" name="familybackground1" width="108" height="20" border="0" id="familybackground1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaleducation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Education1','','images/education2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/education1.jpg" alt="Education" name="Education1" width="108" height="20" border="0" id="Education1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalexaminations.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('examinations1','','images/examinations2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/examinations1.jpg" alt="examinations" name="examinations1" width="108" height="20" border="0" id="examinations1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalworkexperience.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('workexperience1','','images/work-experience2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/work-experience.jpg" alt="workexperience" name="workexperience1" width="108" height="20" border="0" id="workexperience1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalvoluntarywork.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('voluntarywork1','','images/voluntary-work2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/voluntary-work.jpg" alt="voluntarywork" name="voluntarywork1" width="108" height="20" border="0" id="voluntarywork1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaltrainings.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Trainings1','','images/trainings2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/trainings1.jpg" alt="Trainings" name="Trainings1" width="108" height="20" border="0" id="Trainings1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalotherinfo.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('otherinformation1','','images/other-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/other-information.jpg" alt="otherinformation" name="otherinformation1" width="108" height="20" border="0" id="otherinformation1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="Personalpositiondetails.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PositionDetails1','','images/position2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/position1.jpg" alt="Position Details" name="PositionDetails1" width="108" height="20" border="0" id="PositionDetails1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="5"><a href="Personalduties.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('duties','','images/dutiesandresponsibilities2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/dutiesandresponsibilities.jpg" alt="duties" name="duties" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td height="5"><a href="PersonalEmpNumber.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empNumber2','','images/editmodifyemployeenumber2.jpg',1);statusBar(); return true;" onClick="statusBar();"><img src="images/editmodifyemployeenumber.jpg" alt="empNumber2" name="empNumber2" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout1','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout1" width="108" height="20" border="0" id="logout1"></a></td>
                                      </tr>
                                    </table>
                                    <? } ?>
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="369" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="339"><!-- InstanceBeginEditable name="BODY" -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="16" align="right" valign="top" class="header"><p>PERSONAL 
                                DATA SHEET<br>
                                &nbsp;&nbsp;&nbsp;&nbsp; <span class="note">CS 
                                FORM 212 (Revised 2003)</span> </p></td>
                          </tr>
                          <tr>
                            <td height="16" align="right" valign="top" class="header">&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="32" align="right" valign="top" class="header"><form name="frmEmpNumber" method="post"  onSubmit="return validateEmpNumber();">
                                <?	

								$objCntEmpNumber = mysql_query("SELECT empNumber FROM tblEmpPersonal WHERE empNumber = '$strEmpNumber'");
								$strEmpNumber = mysql_num_rows($objCntEmpNumber);							
								
								if (!$Submit2) 
								{
									
								?>
                                <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
                                  <tr class="alterrow"> 
                                    <td colspan="2">Please enter employee number 
                                      to verify if the number you entered already 
                                      exist. </td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td width="43%" class="paragraph">Agency Employee 
                                      Number :</td>
                                    <td width="57%"><input name="strEmpNumber" type="text" size="20" maxlength="15" onBlur="validateAgencyEmployeeNumber(this)">
                                      <span class="note">* </span></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2" class="td"> <input type="submit" name="Submit2" value="Continue"> 
                                    </td>
                                  </tr>
                                </table>
								<? 
								} elseif(($strEmpNumber != 1) && (Submit2))							
								{ 
									
								?>
                              </form></td>
                          </tr>
                          <tr> 
                            <td> 
                              <?php
// code that will be executed if the form has been submitted:

if ($Submit == 'ADD') {	
	if ($form_data_name <> NULL) {
	include("../hrmis/class/Connect.php");
	$data = addslashes(fread(fopen($form_data, "r"), filesize($form_data)));
	$result=mysql_query("INSERT INTO tblEmpPicture (empNumber,picture,filename,filesize,filetype) ".
		"VALUES ('$t_strEmpNumber','$data','$form_data_name','$form_data_size','$form_data_type')");
	mysql_close();
	}
	print "<br><p>Employee number has been added to the database: <b>$t_strEmpNumber</b></br>";
} else {
		// else show the form to submit new data: 
?>
                              <form enctype="multipart/form-data" method="post" name="frmPDS" action="<? $PHP_SELF; ?>" onSubmit="return validate();">
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><table width="50%" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td width="33%" height="38"> <span class="paragraph">Input 
                                            Picture here : (not older than 6 mos.) 
                                            </span> <input type="file" name="form_data" size="40"> 
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td height="13" class="note">Enter employee/s 
                                      information: (* denotes required field). 
                                    </td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                  <tr> 
                                    <td class="alterrow"><div align="left">I. 
                                        PERSONAL INFORMATION</div></td>
                                  </tr>
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="27%" height="19" class="paragraph">Surname 
                                      : </td>
                                    <td width="73%"><input name="t_strSurname" type="text" size="50" maxlength="50" onBlur="validateCharacter(this)"> 
                                      <span class="note">*</span> </td>
                                  </tr>
                                  <tr> 
                                    <td height="19" class="paragraph">First Name 
                                      : </td>
                                    <td><input name="t_strFirstname" type="text" size="50" maxlength="50" onBlur="validateCharacter(this)"> 
                                      <span class="note">*</span> </td>
                                  </tr>
                                  <tr> 
                                    <td height="9" class="paragraph">Middle Name 
                                      : </td>
                                    <td><input name="t_strMiddlename" type="text" size="50" maxlength="50" onBlur="validateCharacter(this)"> 
                                      <span class="note">*</span> </td>
                                  </tr>
                                  <tr> 
                                    <td height="5" class="paragraph">Date of Birth 
                                      : </td>
                                    <td><span class="paragraph">Year </span> <select name="t_dtmBirthYear" size="1" onChange="updateList(t_dtmBirthMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmBirthDay')">
                                        <?
										$objEmployee->comboYearOld(date("Y"));
									   ?>
                                      </select>
                                      <span class="paragraph">Month </span> <select name="t_dtmBirthMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmBirthYear[t_dtmBirthYear.selectedIndex].text,'t_dtmBirthDay')">
                                        <?
										$objEmployee->comboMonth(date("n"));
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmBirthDay" size="1">
                                        <?
										$objEmployee->comboDay(date("j"));
										?>
                                      </select> <span class="note">*</span> <span class="note"> 
                                      </span></td>
                                  </tr>
                                  <tr> 
                                    <td height="5" class="paragraph">Place of 
                                      Birth : </td>
                                    <td><input name="t_strBirthPlace" type="text" size="30" maxlength="30" onBlur="validateFullName(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Sex : </td>
                                    <td> 
                                      <? 
										  	$objEmployee->gender(t_strSex, $t_strGender='');
										  	?>
                                      <span class="note">*</span> </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Civil Status:</td>
                                    <td> 
                                      <?
										  	$objEmployee->civilStatus(t_strCivilStatus, $t_strCivil='');
										  	?>
                                      <span class="note">*</span> </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Citizenship : </td>
                                    <td><input name="t_strCitizenship" type="text" size="20" maxlength="20" onBlur="validateCharacter(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Height (m) : </td>
                                    <td><input name="t_intHeight" type="text" size="10" maxlength="4" onBlur="validateWeightHeight(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Weight (kg) : </td>
                                    <td><input name="t_intWeight" type="text" size="10" maxlength="4" onBlur="validateWeightHeight(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Blood Type :</td>
                                    <td><input name="t_strBloodType" type="text" size="10" maxlength="2" onBlur="validateCharacter(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">GSIS Policy No. :</td>
                                    <td><input name="t_strGSISNumber" type="text" size="20" maxlength="10" onBlur="validateGSISNumber(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PAGIBIG ID No . </td>
                                    <td><input name="t_intPAGIBIGNumber" type="text" size="20" maxlength="10" onBlur="validateNumber(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PHILHEALTH No. : </td>
                                    <td><input name="t_intPHILHEALTHNumber" type="text" size="20" maxlength="14" onBlur="validateNumber(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Residential :</td>
                                    <td><textarea name="t_strResidentialAddress" cols="30" onBlur="validateAddress(this)"></textarea> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Zip Code :</td>
                                    <td><input name="t_intZipCode1" type="text" size="10" maxlength="4" onBlur="validateNumber(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Telephone No. : </td>
                                    <td><input name="t_intTelephone1" type="text" size="20" maxlength="20" onBlur="validateNumber(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Permanent Address :</td>
                                    <td><textarea name="t_strPermanentAddress" cols="30" onBlur="validateAddress(this)"></textarea> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">ZipCode : </td>
                                    <td><input name="t_intZipCode2" type="text" size="10" maxlength="4" onBlur="validateNumber(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Telephone No. :</td>
                                    <td><input name="t_intTelephone2" type="text" size="20" maxlength="20" onBlur="validateNumber(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Email Address (if any) 
                                      : </td>
                                    <td><input name="t_strEmail" type="text" size="30" maxlength="30" onBlur="validateEmail(this);"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Cellphone No. :</td>
                                    <td><input name="t_intMobile" type="text" size="20" maxlength="20" onBlur="validateNumber(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Agency Employee No. 
                                      :</td>
                                    <td><input name="t_strEmpNumber" type="text" onBlur="validateCharacterAndNumber(this)" size="20" maxlength="20"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">TIN No. : </td>
                                    <td><input name="t_intTin" type="text" size="20" maxlength="20" onBlur="validateNumber(this)"></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                  <tr> 
                                    <td class="alterrow"><div align="left">II. 
                                        FAMILY BACKGROUND</div></td>
                                  </tr>
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="27%" height="19" class="paragraph">Name 
                                      of Spouse :</td>
                                    <td width="73%"><input name="t_strSpouse" type="text" size="50" maxlength="70" onBlur="validateFullName(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="19" class="paragraph">Occupation 
                                      : </td>
                                    <td><input name="t_strSpouseWork" type="text" size="30" maxlength="50" onBlur="validateFullName(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="9" class="paragraph">Employer/Bus. 
                                      Name :</td>
                                    <td><input name="t_strSpouseBusName" type="text" size="50" maxlength="70" onBlur="validateFullName(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="5" class="paragraph">Business 
                                      Address : </td>
                                    <td> <textarea name="t_strSpouseBusAddress" cols="30" onBlur="validateAddress(this)"></textarea> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="5" class="paragraph">Telephone 
                                      No. : </td>
                                    <td><input name="t_intSpouseTelephone" type="text" size="20" maxlength="20" onBlur="validateNumber(this)"></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="19%" class="paragraph">Name of 
                                      Children : </td>
                                    <td width="25%"><input name="t_strChildName" type="text" size="25" maxlength="70" onBlur="validateFullName(this)"> 
                                    </td>
                                    <td width="16%" class="paragraph">Date of 
                                      Birth :</td>
                                    <td width="40%"><span class="paragraph"> Year 
                                      </span> <select name="t_dtmChildBirthYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmChildBirthYear);
									   ?>
                                      </select>
                                      <span class="paragraph"> Month </span> <select name="t_dtmChildBirthMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmChildBirthMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmChildBirthDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmChildBirthDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Name of Children : </td>
                                    <td><input name="t_strChildName2" type="text" size="25" maxlength="70" onBlur="validateFullName(this)"></td>
                                    <td class="paragraph">Date of Birth :</td>
                                    <td><span class="paragraph">Year </span> <select name="t_dtmChildBirthYear2" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmChildBirthYear2);
									   ?>
                                      </select>
                                      <span class="paragraph">Month </span> <select name="t_dtmChildBirthMonth2" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmChildBirthMonth2);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmChildBirthDay2" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmChildBirthDay2);
										?>
                                      </select> <span class="paragraph"> </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Name of Children :</td>
                                    <td><input name="t_strChildName3" type="text" id="t_strChildName3" size="25" maxlength="70" onBlur="validateFullName(this)"></td>
                                    <td class="paragraph">Date of Birth :</td>
                                    <td><span class="paragraph"> Year </span> 
                                      <select name="t_dtmChildBirthYear3" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmChildBirthYear3);
									   ?>
                                      </select>
                                      <span class="paragraph">Month </span> <select name="t_dtmChildBirthMonth3" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmChildBirthMonth3);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmChildBirthDay3" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmChildBirthDay3);
										?>
                                      </select> </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Name of Children :</td>
                                    <td><input name="t_strChildName4" type="text" id="t_strChildName4" size="25" maxlength="70" onBlur="validateFullName(this)"></td>
                                    <td class="paragraph">Date of Birth :</td>
                                    <td><span class="paragraph"> Year </span> 
                                      <select name="t_dtmChildBirthYear4" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmChildBirthYear4);
									   ?>
                                      </select>
                                      <span class="paragraph"> Month </span> <select name="t_dtmChildBirthMonth4" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmChildBirthMonth4);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmChildBirthDay4" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmChildBirthDay4);
										?>
                                      </select></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="27%" class="paragraph">Name of 
                                      Father : </td>
                                    <td width="73%"><input name="t_strFatherName" type="text" size="50" maxlength="70" onBlur="validateFullName(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Full Maiden Name of 
                                      Mother : </td>
                                    <td><input name="t_strMotherName" type="text" size="50" maxlength="70" onBlur="validateFullName(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Parent Address :</td>
                                    <td><textarea name="t_strParentAddress" cols="30" onBlur="validateAddress(this)"></textarea> 
                                      <span class="note">*</span></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                  <tr> 
                                    <td class="alterrow"><div align="left">III. 
                                        EDUCATIONAL BACKGROUND</div></td>
                                  </tr>
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="69%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td width="43%" class="paragraph">Level 
                                            Description : </td>
                                          <td width="57%"><input name="t_strLevelDesc" type="text" value="<? echo "Elementary"; ?>" size="30" maxlength="80" readonly> 
                                            <input name="t_strElementary" type="hidden" id="t_strElementary" value="<? echo "ELM"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph"> School 
                                            Name (Write in full) :</td>
                                          <td> <input name="t_strElementarySchoolName" type="text" size="30" maxlength="80" onBlur="validateFullName(this)"> 
                                            <span class="note">*</span></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"> Dates of attendance 
                                            From :</td>
                                          <td><span class="paragraph"> Year </span> 
                                            <select name="t_dtmElementaryFromYear" size="1" onChange="updateList(t_dtmElementaryFromMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmElementaryFromDay')">
                                              <?
										$objEmployee->comboYearOld(date("Y"));
									   ?>
                                            </select>
                                            <span class="paragraph">Month </span> 
                                            <select name="t_dtmElementaryFromMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmElementaryFromYear[t_dtmElementaryFromYear.selectedIndex].text,'t_dtmElementaryFromDay')">
                                              <?
										$objEmployee->comboMonth(date("n"));
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmElementaryFromDay" size="1" onFocus="updateList(t_dtmElementaryFromMonth.selectedIndex,t_dtmElementaryFromYear[t_dtmElementaryFromYear.selectedIndex].text,'t_dtmElementaryFromDay')">
                                              <?
										$objEmployee->comboDay(date("j"));
										?>
                                            </select> </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"> Dates of attendance 
                                            To :</td>
                                          <td><span class="paragraph"> Year </span> 
                                            <select name="t_dtmElementaryToYear" size="1" onChange="updateList(t_dtmElementaryToMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmElementaryToDay')">
                                              <?
										$objEmployee->comboYearOld(date("Y"));
									   ?>
                                            </select>
                                            <span class="paragraph">Month </span> 
                                            <select name="t_dtmElementaryToMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmElementaryToYear[t_dtmElementaryToYear.selectedIndex].text,'t_dtmElementaryToDay')">
                                              <?
										$objEmployee->comboMonth(date("n"));
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmElementaryToDay" size="1" onFocus="updateList(t_dtmElementaryToMonth.selectedIndex,t_dtmElementaryToYear[t_dtmElementaryToYear.selectedIndex].text,'t_dtmElementaryToDay')">
                                              <?
										$objEmployee->comboDay(date("j"));
										?>
                                            </select> </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"><input name="t_strElementaryCourse" type="hidden" id="t_strElementaryCourse" value="<? echo "None"; ?>"> 
                                            <input name="t_intElementaryUnits" type="hidden" value="<? echo "-"; ?>">
                                            Academic honors received :</td>
                                          <td><textarea name="t_strElementaryHonors" cols="20" onBlur="validateCharacterAndNumber(this)"></textarea>
                                          </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="69%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td width="43%" class="paragraph">Level 
                                            Description :</td>
                                          <td width="57%"><input name="t_strLevelDesc" type="text" value="<? echo "Secondary"; ?>" size="30" maxlength="80" readonly> 
                                            <input name="t_strSecondary" type="hidden" id="t_strSecondary" value="<? echo "HSL"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph"> School 
                                            Name (Write in full) :</td>
                                          <td><input name="t_strSecondarySchoolName" type="text" size="30" maxlength="80" onBlur="validateFullName(this)"> 
                                            <span class="note">*</span></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"> Dates of attendance 
                                            From :</td>
                                          <td><span class="paragraph">Year </span> 
                                            <select name="t_dtmSecondaryFromYear" size="1" onChange="updateList(t_dtmSecondaryFromMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmSecondaryFromDay')">
                                              <?
										$objEmployee->comboYearOld(date("Y"));
									   ?>
                                            </select>
                                            <span class="paragraph"> Month </span> 
                                            <select name="t_dtmSecondaryFromMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmSecondaryFromYear[t_dtmSecondaryFromYear.selectedIndex].text,'t_dtmSecondaryFromDay')">
                                              <?
										$objEmployee->comboMonth(date("n"));
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmSecondaryFromDay" size="1" onFocus="updateList(t_dtmSecondaryFromMonth.selectedIndex,t_dtmSecondaryFromYear[t_dtmSecondaryFromYear.selectedIndex].text,'t_dtmSecondaryFromDay')">
                                              <?
										$objEmployee->comboDay(date("j"));
										?>
                                            </select></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"> Dates of attendance 
                                            To :</td>
                                          <td><span class="paragraph"> Year </span> 
                                            <select name="t_dtmSecondaryToYear" size="1" onChange="updateList(t_dtmSecondaryToMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmSecondaryToDay')">
                                              <?
										$objEmployee->comboYearOld(date("Y"));
									   ?>
                                            </select>
                                            <span class="paragraph">Month </span> 
                                            <select name="t_dtmSecondaryToMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmSecondaryToYear[t_dtmSecondaryToYear.selectedIndex].text,'t_dtmSecondaryToDay')">
                                              <?
										$objEmployee->comboMonth(date("n"));
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmSecondaryToDay" size="1" onFocus="updateList(t_dtmSecondaryToMonth.selectedIndex,t_dtmSecondaryToYear[t_dtmSecondaryToYear.selectedIndex].text,'t_dtmSecondaryToDay')">
                                              <?
										$objEmployee->comboDay(date("j"));
										?>
                                            </select> </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"><input name="t_strSecondaryCourse" type="hidden" id="t_strSecondaryCourse" value="<? echo "None"; ?>"> 
                                            <input name="t_intSecondaryUnits" type="hidden" id="t_intSecondaryUnits2" value="<? echo "-"; ?>">
                                            Academic honors received :</td>
                                          <td><textarea name="t_strSecondaryHonors" cols="20" onBlur="validateCharacterAndNumber(this)"></textarea>
                                          </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="69%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td width="43%" class="paragraph">Level 
                                            Description :</td>
                                          <td width="57%"><input name="t_strLevelDesc" type="text" value="<? echo "Vocational/Trade Course"; ?>" size="30" maxlength="80" readonly> 
                                            <input name="t_strVocational" type="hidden" id="t_strVocational" value="<? echo "VCL"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">School 
                                            Name (Write in full) :</td>
                                          <td><input name="t_strVocationalSchoolName" type="text" size="30" maxlength="80" onBlur="validateFullName(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">Degree/Course 
                                            (Write in full) : </td>
                                          <td><input name="t_strVocationalCourse" type="text" size="30" maxlength="50" onBlur="validateFullName(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">Highest 
                                            Grade/Level/Units Earned :</td>
                                          <td><input name="t_intVocationalUnits" type="text" size="30" maxlength="50" onBlur="validateWeightHeight(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Dates of attendance 
                                            From :</td>
                                          <td><span class="paragraph">Year </span> 
                                            <select name="t_dtmVocationalFromYear" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboYearOld(t_dtmVocationalFromYear);
									   ?>
                                            </select>
                                            <span class="paragraph">Month </span> 
                                            <select name="t_dtmVocationalFromMonth" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboMonth(t_dtmVocationalFromMonth);
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmVocationalFromDay" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboDay(t_dtmVocationalFromDay);
										?>
                                            </select> </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Dates of attendance 
                                            To :</td>
                                          <td><span class="paragraph">Year </span> 
                                            <select name="t_dtmVocationalToYear" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboYearOld(t_dtmVocationalToYear);
									   ?>
                                            </select>
                                            <span class="paragraph">Month </span> 
                                            <select name="t_dtmVocationalToMonth" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboMonth(t_dtmVocationalToMonth);
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmVocationalToDay" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboDay(t_dtmVocationalToDay);
										?>
                                            </select> </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Academic honors 
                                            received :</td>
                                          <td><textarea name="t_strVocationalHonors" cols="20" onBlur="validateCharacterAndNumber(this)"></textarea></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="69%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td width="43%" class="paragraph">Level 
                                            Description :</td>
                                          <td width="57%"><input name="t_strLevelDesc" type="text" value="<? echo "Tertiary"; ?>" size="30" maxlength="80" readonly> 
                                            <input name="t_strTertiary" type="hidden" id="t_strTertiary" value="<? echo "TRT"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">School 
                                            Name (Write in full) :</td>
                                          <td><input name="t_strTertiarySchoolName" type="text" size="30" maxlength="80" onBlur="validateFullName(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">Degree/Course 
                                            (Write in full) : </td>
                                          <td><input name="t_strTertiaryCourse" type="text" size="30" maxlength="50" onBlur="validateFullName(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">Highest 
                                            Grade/Level/Units Earned :</td>
                                          <td><input name="t_intTertiaryUnits" type="text" size="30" maxlength="50" onBlur="validateWeightHeight(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Dates of attendance 
                                            From :</td>
                                          <td><span class="paragraph"> Year </span> 
                                            <select name="t_dtmTertiaryFromYear" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboYearOld(t_dtmTertiaryFromYear);
									   ?>
                                            </select>
                                            <span class="paragraph"> Month </span> 
                                            <select name="t_dtmTertiaryFromMonth" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboMonth(t_dtmTertiaryFromMonth);
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmTertiaryFromDay" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboDay(t_dtmTertiaryFromDay);
										?>
                                            </select></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Dates of attendance 
                                            To :</td>
                                          <td><span class="paragraph">Year </span> 
                                            <select name="t_dtmTertiaryToYear" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboYearOld(t_dtmTertiaryToYear);
									   ?>
                                            </select>
                                            <span class="paragraph"> Month </span> 
                                            <select name="t_dtmTertiaryToMonth" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboMonth(t_dtmTertiaryToMonth);
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmTertiaryToDay" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboDay(t_dtmTertiaryToDay);
										?>
                                            </select></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Academic honors 
                                            received :</td>
                                          <td><textarea name="t_strTertiaryHonors" cols="20" onBlur="validateCharacterAndNumber(this)"></textarea></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="69%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td width="43%" class="paragraph"> Level 
                                            Description (GRADUATE STUDIES) :</td>
                                          <td width="57%"><input name="t_strLevelDesc" type="text" value="<? echo "College"; ?>" size="30" maxlength="80" readonly> 
                                            <input name="t_strCollege" type="hidden" value="<? echo "CLG"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">School 
                                            Name (Write in full) :</td>
                                          <td><input name="t_strCollegeSchoolName" type="text" size="30" maxlength="80" onBlur="validateFullName(this)"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">Degree/Course 
                                            (Write in full) : </td>
                                          <td><input name="t_strCollegeCourse" type="text" size="30" maxlength="50" onBlur="validateFullName(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">Highest 
                                            Grade/Level/Units Earned :</td>
                                          <td><input name="t_intCollegeUnits" type="text" size="30" maxlength="50" onBlur="validateWeightHeight(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Dates of attendance 
                                            From :</td>
                                          <td><span class="paragraph"> Year </span> 
                                            <select name="t_dtmCollegeFromYear" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboYearOld(t_dtmCollegeFromYear);
									   ?>
                                            </select>
                                            <span class="paragraph"> Month </span> 
                                            <select name="t_dtmCollegeFromMonth" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboMonth(t_dtmCollegeFromMonth);
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmCollegeFromDay" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboDay(t_dtmCollegeFromDay);
										?>
                                            </select></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Dates of attendance 
                                            To :</td>
                                          <td><span class="paragraph"> Year </span> 
                                            <select name="t_dtmCollegeToYear" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboYearOld(t_dtmCollegeToYear);
									   ?>
                                            </select>
                                            <span class="paragraph"> Month </span> 
                                            <select name="t_dtmCollegeToMonth" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboMonth(t_dtmCollegeToMonth);
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmCollegeToDay" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboDay(t_dtmCollegeToDay);
										?>
                                            </select></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Academic honors 
                                            received :</td>
                                          <td><textarea name="t_strCollegeHonors" cols="20" onBlur="validateCharacterAndNumber(this)"></textarea></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="43%" class="paragraph">Level Description 
                                      (GRADUATE STUDIES) :</td>
                                    <td width="57%"><input name="t_strLevelDesc" type="text" value="<? echo "Master's Degree"; ?>" size="30" maxlength="80" readonly> 
                                      <input name="t_strMasterDegree" type="hidden" value="<? echo "MSD"; ?>"></td>
                                  </tr>
                                  <tr> 
                                    <td width="43%" class="paragraph">School Name 
                                      (Write in full) :</td>
                                    <td><input name="t_strMasterDegreeSchoolName" type="text" size="30" maxlength="80" onBlur="validateFullName(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td width="43%" class="paragraph">Degree/Course 
                                      (Write in full) : </td>
                                    <td><input name="t_strMasterDegreeCourse" type="text" size="30" maxlength="50" onBlur="validateFullName(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td width="43%" class="paragraph">Highest 
                                      Grade/Level/Units Earned :</td>
                                    <td><input name="t_intMasterDegreeUnits" type="text" size="30" maxlength="50" onBlur="validateWeightHeight(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Dates of attendance 
                                      From :</td>
                                    <td><span class="paragraph"> Year </span> 
                                      <select name="t_dtmMasterDegreeFromYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmMasterDegreeFromYear);
									   ?>
                                      </select>
                                      <span class="paragraph"> Month </span> <select name="t_dtmMasterDegreeFromMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmMasterDegreeFromMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmMasterDegreeFromDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmMasterDegreeFromDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Dates of attendance 
                                      To :</td>
                                    <td><span class="paragraph"> Year </span> 
                                      <select name="t_dtmMasterDegreeToYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmMasterDegreeToYear);
									   ?>
                                      </select>
                                      <span class="paragraph"> Month </span> <select name="t_dtmMasterDegreeToMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmMasterDegreeToMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmMasterDegreeToDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmMasterDegreeToDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Academic honors received 
                                      :</td>
                                    <td><textarea name="t_strMasterDegreeHonors" cols="20" onBlur="validateCharacterAndNumber(this)"></textarea></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="43%" class="paragraph">Level Description 
                                      (GRADUATE STUDIES) :</td>
                                    <td width="57%"><input name="t_strLevelDesc" type="text" value="<? echo "Doctorate"; ?>" size="30" maxlength="80" readonly> 
                                      <input name="t_strDoctorate" type="hidden" value="<? echo "DOC"; ?>"></td>
                                  </tr>
                                  <tr> 
                                    <td width="43%" class="paragraph">School Name 
                                      (Write in full) :</td>
                                    <td><input name="t_strDoctorateSchoolName" type="text" size="30" maxlength="80" onBlur="validateFullName(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td width="43%" class="paragraph">Degree/Course 
                                      (Write in full) : </td>
                                    <td><input name="t_strDoctorateCourse" type="text" size="30" maxlength="50" onBlur="validateFullName(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td width="43%" class="paragraph">Highest 
                                      Grade/Level/Units Earned :</td>
                                    <td><input name="t_intDoctorateUnits" type="text" size="30" maxlength="50" onBlur="validateWeightHeight(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Dates of attendance 
                                      From :</td>
                                    <td><span class="paragraph"> Year </span> 
                                      <select name="t_dtmDoctorateFromYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmDoctorateFromYear);
									   ?>
                                      </select>
                                      <span class="paragraph"> Month </span> <select name="t_dtmDoctorateFromMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmDoctorateFromMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmDoctorateFromDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmDoctorateFromDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Dates of attendance 
                                      To :</td>
                                    <td><span class="paragraph"> Year </span> 
                                      <select name="t_dtmDoctorateToYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmDoctorateToYear);
									   ?>
                                      </select>
                                      <span class="paragraph"> Month </span> <select name="t_dtmDoctorateToMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmDoctorateToMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmDoctorateToDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmDoctorateToDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Academic honors received 
                                      :</td>
                                    <td><textarea name="t_strDoctorateHonors" cols="20" onBlur="validateCharacterAndNumber(this)"></textarea></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="69%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td width="43%" class="paragraph">Level 
                                            Description :</td>
                                          <td width="57%"><input name="t_strLevelDesc" type="text" value="<? echo "Non-Degree Course"; ?>" size="30" maxlength="80" readonly> 
                                            <input name="t_strNonDegreeCourse" type="hidden" value="<? echo "NDC"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">School 
                                            Name (Write in full) :</td>
                                          <td><input name="t_strNonDegreeCourseSchoolName" type="text" size="30" maxlength="80" onBlur="validateFullName(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">Degree/Course 
                                            (Write in full) : </td>
                                          <td><input name="t_strNonDegreeCourseCourse" type="text" size="30" maxlength="50" onBlur="validateFullName(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td width="43%" class="paragraph">Highest 
                                            Grade/Level/Units Earned :</td>
                                          <td><input name="t_intNonDegreeCourseUnits" type="text" size="30" maxlength="50" onBlur="validateWeightHeight(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Dates of attendance 
                                            From :</td>
                                          <td><span class="paragraph"> Year </span> 
                                            <select name="t_dtmNonDegreeCourseFromYear" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboYearOld(t_dtmNonDegreeCourseFromYear);
									   ?>
                                            </select>
                                            <span class="paragraph"> Month </span> 
                                            <select name="t_dtmNonDegreeCourseFromMonth" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboMonth(t_dtmNonDegreeCourseFromMonth);
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmNonDegreeCourseFromDay" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboDay(t_dtmNonDegreeCourseFromDay);
										?>
                                            </select></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Dates of attendance 
                                            To :</td>
                                          <td><span class="paragraph"> Year </span> 
                                            <select name="t_dtmNonDegreeCourseToYear" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboYearOld(t_dtmNonDegreeCourseToYear);
									   ?>
                                            </select>
                                            <span class="paragraph"> Month </span> 
                                            <select name="t_dtmNonDegreeCourseToMonth" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboMonth(t_dtmNonDegreeCourseToMonth);
										?>
                                            </select> <span class="paragraph"> 
                                            Day </span> <select name="t_dtmNonDegreeCourseToDay" size="1">
                                              <option></option>
                                              <?
										$objEmployee->comboDay(t_dtmNonDegreeCourseToDay);
										?>
                                            </select></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Academic honors 
                                            received :</td>
                                          <td><textarea name="t_strNonDegreeCourseHonors" cols="20" onBlur="validateCharacterAndNumber(this)"></textarea></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><span class="note">* (Course taken from 
                                      Tertiary education but not classified as 
                                      Graduate Studies) </span></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                  <tr> 
                                    <td class="alterrow"><div align="left">IV. 
                                        EXAMINATION</div></td>
                                  </tr>
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="31%" class="paragraph">Exam Description 
                                      : </td>
                                    <td width="69%"> 
                                      <?php 
										$result = mysql_query ("SELECT examCode, examDesc FROM tblExamType");
										echo "<SELECT NAME=\"t_strExamCode\">\r";
										echo "<option></option>";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strExamDesc == $row["examCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["examCode"])."\" selected>".strtoupper($row["examDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["examCode"])."\">".strtoupper($row["examDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                      <input name="t_strOldExamCode" type="hidden" value="<? echo $t_strExamCode; ?>"></td>
                                  </tr>
                                  <tr> 
                                    <td width="31%" class="paragraph">Rating :</td>
                                    <td> <input name="t_intExamRating" type="text" size="10" maxlength="6" onBlur="validateWeightHeight(this)">
                                      % </td>
                                  </tr>
                                  <tr> 
                                    <td width="31%" class="paragraph">Date of 
                                      Exam/Conferment : </td>
                                    <td><span class="paragraph"> Year </span> 
                                      <select name="t_dtmExamYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmExamYear);
									   ?>
                                      </select>
                                      <span class="paragraph"> Month </span> <select name="t_dtmExamMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmExamMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmExamDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmExamDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td width="31%" class="paragraph">Place of 
                                      Exam/Conferment :</td>
                                    <td><input name="t_strExamPlace" type="text" size="50" maxlength="70" onBlur="validateAddress(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td width="31%" class="paragraph">License 
                                      No. (if applicable) : </td>
                                    <td><input name="t_strLicenseNumber" type="text" size="25" maxlength="10" onBlur="validateGSISNumber(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td width="31%" class="paragraph">Date of 
                                      Release :</td>
                                    <td><span class="paragraph"> Year </span> 
                                      <select name="t_dtmDateReleaseYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmExamYear);
									   ?>
                                      </select>
                                      <span class="paragraph"> Month </span> <select name="t_dtmDateReleaseMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmDateReleaseMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmDateReleaseDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmDateReleaseDay);
										?>
                                      </select></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                  <tr> 
                                    <td class="alterrow"><div align="left">V. 
                                        WORK EXPERIENCE</div></td>
                                  </tr>
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="31%" class="paragraph"> Inclusive 
                                      Date From:</td>
                                    <td width="69%"> <span class="paragraph"> 
                                      Year </span> <select name="t_dtmServiceFromYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmServiceFromYear);
									   ?>
                                      </select>
                                      <span class="paragraph"> Month </span> <select name="t_dtmServiceFromMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmServiceFromMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmServiceFromDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmServiceFromDay);
										?>
                                      </select> </td>
                                  </tr>
                                  <tr> 
                                    <td width="31%" class="paragraph">Inclusive 
                                      Date To :</td>
                                    <td><span class="paragraph"> Year </span> 
                                      <select name="t_dtmServiceToYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmServiceToYear);
									   ?>
                                      </select>
                                      <span class="paragraph"> Month </span> <select name="t_dtmServiceToMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmServiceToMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmServiceToDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmServiceToDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Position Title (Write 
                                      in full) :</td>
                                    <td> 
                                      <?php 
										$result = mysql_query ("SELECT positionCode FROM tblPosition");
										echo "<SELECT NAME=\"t_strPositionCode\">\r";
										echo "<option></option>";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strPositionCode == $row["positionCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["positionCode"])."\" selected>".strtoupper($row["positionCode"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["positionCode"])."\">".strtoupper($row["positionCode"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                      <input name="t_strOldPositionCode" type="hidden" value="<? echo $t_strPositionCode; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="16" class="paragraph">Department 
                                      / Agency / Office :</td>
                                    <td> <input name="t_strStationAgency" type="text" size="50" maxlength="70" onBlur="validateFullName(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="16" class="paragraph">Monthly 
                                      Salary :</td>
                                    <td> <input name="t_intSalary" type="text" size="20" maxlength="20" onBlur="validateWeightHeight(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="16" class="paragraph">Status of 
                                      Appointment : </td>
                                    <td> 
                                      <?php 
										$result = mysql_query ("SELECT appointmentCode FROM tblAppointment");
										echo "<SELECT NAME=\"t_strAppointmentCode\">\r";
										echo "<option></option>";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strAppointmentCode == $row["appointmentCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["appointmentCode"])."\" selected>".strtoupper($row["appointmentCode"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["appointmentCode"])."\">".strtoupper($row["appointmentCode"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                      <input name="t_strOldAppointmentCode" type="hidden" value="<? echo $t_strAppointmentCode; ?>"> 
                                    </td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                  <tr> 
                                    <td class="alterrow"><div align="left">VI. 
                                        VOLUNTARY WORK</div></td>
                                  </tr>
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="31%" class="paragraph">Name of 
                                      organization :</td>
                                    <td width="69%"><input name="t_strVWName" type="text" size="50" maxlength="70" onBlur="validateFullName(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Addreess of organization 
                                      :</td>
                                    <td><textarea name="t_strVWAddress" cols="20" onBlur="validateAddress(this)"></textarea></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Inclusive Dates From 
                                      : </td>
                                    <td> <span class="paragraph"> Year</span> 
                                      <select name="t_dtmVWDateFromYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmVWDateFromYear);
									   ?>
                                      </select>
                                      <span class="paragraph">Month</span> <select name="t_dtmVWDateFromMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmVWDateFromMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmVWDateFromDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmVWDateFromDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Inclusive Dates To : 
                                    </td>
                                    <td> <span class="paragraph"> Year </span> 
                                      <select name="t_dtmVWDateToYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmVWDateToYear);
									   ?>
                                      </select>
                                      <span class="paragraph">Month </span> <select name="t_dtmVWDateToMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmVWDateToMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmVWDateToDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmVWDateToDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Number of Hours :</td>
                                    <td><input name="t_intVWHours" type="text" size="10" maxlength="5" onBlur="validateWeightHeight(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Position / Nature of 
                                      work : </td>
                                    <td><input name="t_strVWPosition" type="text" size="50" maxlength="70" onBlur="validateFullName(this)"></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                  <tr> 
                                    <td class="alterrow"><div align="left">VII. 
                                        TRAINING/SEMINAR</div></td>
                                  </tr>
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="36%" class="paragraph">Training 
                                      / Seminar / Workshop :</td>
                                    <td width="64%"> 
                                      <?php 
										$result = mysql_query ("SELECT trainingCode, trainingTitle FROM tblTraining");
										echo "<SELECT NAME=\"t_strTrainingCode\">\r";
										echo "<option></option>";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strTrainingTitle == $row["trainingCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["trainingCode"])."\" selected>".strtoupper($row["trainingTitle"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["trainingCode"])."\">".strtoupper($row["trainingTitle"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                      <input name="t_strOldTrainingCode" type="hidden" value="<? echo $t_strTrainingCode; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td width="36%" class="paragraph">Inclusive 
                                      Dates of Attendance From :</td>
                                    <td> <span class="paragraph"> Year </span> 
                                      <select name="t_dtmTrainingStartYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmTrainingStartYear);
									   ?>
                                      </select>
                                      <span class="paragraph">Month </span> <select name="t_dtmTrainingStartMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmTrainingStartMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmTrainingStartDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmTrainingStartDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td width="36%" class="paragraph">Inclusive 
                                      Dates of Attendance To : </td>
                                    <td> <span class="paragraph"> Year </span> 
                                      <select name="t_dtmTrainingEndYear" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboYearOld(t_dtmTrainingEndYear);
									   ?>
                                      </select>
                                      <span class="paragraph">Month </span> <select name="t_dtmTrainingEndMonth" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboMonth(t_dtmTrainingEndMonth);
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmTrainingEndDay" size="1">
                                        <option></option>
                                        <?
										$objEmployee->comboDay(t_dtmTrainingEndDay);
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Number of Hours :</td>
                                    <td><input name="t_intTrainingHours" type="text" size="10" maxlength="4" onBlur="validateWeightHeight(this)"> 
                                      <input name="t_strOldEmpNumber" type="hidden" value="<? echo $arrEmpPersonal['empNumber']; ?>"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Conducted / Sponsored 
                                      By :</td>
                                    <td><input name="t_strTrainingConductedBy" type="text" size="50" maxlength="70" onBlur="validateFullName(this)"></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                  <tr> 
                                    <td class="alterrow"><div align="left">VIII. 
                                        OTHER INFORMATION</div></td>
                                  </tr>
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="40%" class="paragraph">Special 
                                      Skills / Hobbies : </td>
                                    <td width="60%"><input name="t_strSkills" type="text" size="50" maxlength="70" onBlur="validateFullName(this)"></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="40%" class="paragraph">Non - Academic 
                                      Distinctions / Recognition : </td>
                                    <td width="60%"><input name="t_strNADR" type="text" id="t_strNADR" size="50" maxlength="50" onBlur="validateFullName(this)"></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="40%" class="paragraph">Membership 
                                      in Association / Organization :</td>
                                    <td width="60%"><input name="t_strMIAO" type="text" size="50" maxlength="50" onBlur="validateFullName(this)"></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="47%" class="text">Are you related 
                                      by consanguinity or affinity to any of the 
                                      following appointing authority, recommending 
                                      authority, chief of office/ bureau/department 
                                      or person who has immediate supervision 
                                      over you in the office, Bureau or Dapartment 
                                      where you will be appointed?</td>
                                    <td width="53%"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td class="text"> Within the third degree 
                                            (for NATIONAL GOVERNMENT Employees) 
                                            ? <br> <input name="t_strRelatedThird" type="radio" value="Y" onClick="DegreeParticulars();">
                                            Yes 
                                            <input name="t_strRelatedThird" type="radio" value="N" checked>
                                            No</td>
                                        </tr>
                                        <tr> 
                                          <td class="text"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td><hr></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td class="text">Within the fourth degree 
                                            (for LOCAL GOVERNMENT Employees) ? 
                                            <br> <input name="t_strRelatedFourth" type="radio" value="Y" onClick="DegreeParticulars();">
                                            Yes 
                                            <input name="t_strRelatedFourth" type="radio" value="N" checked>
                                            No</td>
                                        </tr>
                                        <tr> 
                                          <td class="text">If your answer is &quot;YES&quot;, 
                                            give particulars </td>
                                        </tr>
                                        <tr> 
                                          <td class="text"> <input name="t_strRelatedDegreeParticulars" type="text"  size="30" maxlength="70"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="47%" class="text">Have you ever 
                                      been declared guilty of any administrative 
                                      offense ?</td>
                                    <td width="53%"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td class="text"> <input name="t_strAdminCase" type="radio" value="Y" onClick="AdminCaseParticulars();">
                                            Yes 
                                            <input name="t_strAdminCase" type="radio" value="N" checked>
                                            No </td>
                                        </tr>
                                        <tr> 
                                          <td class="text">If your answer is &quot;YES&quot;, 
                                            give details of offense</td>
                                        </tr>
                                        <tr> 
                                          <td class="text"> <input name="t_strAdminCaseParticulars" type="text" size="30" maxlength="70"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="47%" class="text">Have you ever 
                                      been convicted of any crime or violation 
                                      of any law, decree, ordinance or regulations 
                                      by any court or tribunal?</td>
                                    <td width="53%"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td class="text"> <input name="t_strViolateLaw" type="radio" value="Y" onClick="ViolateLawParticulars();">
                                            Yes 
                                            <input name="t_strViolateLaw" type="radio" value="N" checked>
                                            No </td>
                                        </tr>
                                        <tr> 
                                          <td class="text">If your answer is &quot;YES&quot;, 
                                            give details of offense</td>
                                        </tr>
                                        <tr> 
                                          <td class="text"> <input name="t_strViolateLawParticulars" type="text" size="30" maxlength="70"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="47%" class="text">Have you ever 
                                      been forced to retire/resign or dropped 
                                      from employment in the public or private 
                                      sector?</td>
                                    <td width="53%"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td class="text"> <input name="t_strForcedResign" type="radio" value="Y" onClick="ForcedResignParticulars();">
                                            Yes 
                                            <input name="t_strForcedResign" type="radio" value="N" checked>
                                            No </td>
                                        </tr>
                                        <tr> 
                                          <td class="text">If your answer is &quot;YES&quot;, 
                                            give reasons</td>
                                        </tr>
                                        <tr> 
                                          <td class="text"> <input name="t_strForcedResignParticulars" type="text" size="30" maxlength="70"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="47%" class="text">Have you ever 
                                      been a candidate in a national or local 
                                      election (except Barangay election) </td>
                                    <td width="53%"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td class="text"> <input name="t_strCandidate" type="radio" value="Y" onClick="CandidateParticulars();">
                                            Yes 
                                            <input name="t_strCandidate" type="radio" value="N" checked>
                                            No </td>
                                        </tr>
                                        <tr> 
                                          <td class="text">If your answer is &quot;YES&quot;, 
                                            give date of elections and other particulars</td>
                                        </tr>
                                        <tr> 
                                          <td class="text"> <input name="t_strCandidateParticulars" type="text" size="30" maxlength="70"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><hr></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="47%" class="text"><p>Pursuant to 
                                        (a) indigenous People's Act (RA 8371); 
                                        (b) Magna Carta for Disabled Persons (RA 
                                        7277); and (c) Solo Parents Welfare Act 
                                        of 2000 (RA 8972)</p>
                                      <p>*please answer the following items</p></td>
                                    <td width="53%"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td class="text">a. Are you a member 
                                            of any indigenous group? <br> <input name="t_strIndigenous" type="radio" value="Y" onClick="IndigenousParticulars();">
                                            Yes 
                                            <input name="t_strIndigenous" type="radio" value="N" checked>
                                            No </td>
                                        </tr>
                                        <tr> 
                                          <td class="text">If you answer is &quot;YES&quot;, 
                                            please specify<br> <input name="t_strIndigenousParticulars" type="text" id="t_strIndigenousParticulars" size="30" maxlength="70"></td>
                                        </tr>
                                        <tr> 
                                          <td class="text"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td><hr></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td class="text">b. Are you differently 
                                            abled? 
                                            <input name="t_strDisabled" type="radio" value="Y" onClick="DisabledParticulars();">
                                            Yes 
                                            <input name="t_strDisabled" type="radio" value="N" checked>
                                            No </td>
                                        </tr>
                                        <tr> 
                                          <td class="text">If you answer is &quot;YES&quot;, 
                                            please specify<br> <input name="t_strDisabledParticulars" type="text" size="30" maxlength="70"></td>
                                        </tr>
                                        <tr> 
                                          <td class="text"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td><hr></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td class="text">c. Are you a solo parent? 
                                            <input name="t_strSoloParent" type="radio" value="Y" onClick="SoloParentParticulars();">
                                            Yes 
                                            <input name="t_strSoloParent" type="radio" value="N" checked>
                                            No </td>
                                        </tr>
                                        <tr> 
                                          <td class="text">If you answer is &quot;YES&quot;, 
                                            please specify<br> <input name="t_strSoloParentParticulars" type="text" size="30" maxlength="70"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="29%" class="text"><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr class="text"> 
                                    <td colspan="2"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td class="text">REFERENCES (Persons 
                                            not related by consanguinity or affinity 
                                            to applicant/appointee)</td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr class="text"> 
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td width="31%" class="paragraph">Name of 
                                      reference :</td>
                                    <td width="69%"><input name="t_strRefName" type="text" size="50" maxlength="70" onBlur="validateFullName(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Address :</td>
                                    <td><textarea name="t_strRefAddress" cols="30" onBlur="validateAddress(this)"></textarea> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Telephone Number :</td>
                                    <td><input name="t_intRefTelephone" type="text" size="30" maxlength="15" onBlur="validateNumber(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                </table>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="29%" class="text"><hr></td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr class="text"> 
                                    <td colspan="2"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td class="text"><p>I declare under 
                                              the penalties of perjury that this 
                                              Personal Data Sheet has been accomplished 
                                              in good faith, verified by me and 
                                              to the best of my knowledge and 
                                              belief is a true, correct and complete 
                                              statement pursuant to the provisions 
                                              of pertinent laws, rules and regulations 
                                              of the Republic of the Philippines.</p>
                                            <p>I also authorize the agency head/authorized 
                                              representative to verify/validate 
                                              the contents stated herein. I trust 
                                              that this information shall remain 
                                              confidential.</p></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr class="text"> 
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td width="31%" class="paragraph">Signature 
                                      : </td>
                                    <td width="69%"><input name="t_strSignature" type="text" size="30" maxlength="50" onBlur="validateFullName(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Date Accomplished :</td>
                                    <td> <span class="paragraph"> Year </span> 
                                      <select name="t_dtmDateAccYear" size="1" onChange="updateList(t_dtmDateAccMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmDateAccDay')">
                                        <?
										$objEmployee->comboYearOld(date("Y"));
									   ?>
                                      </select> <span class="paragraph">Month</span> 
                                      <select name="t_dtmDateAccMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmDateAccYear[t_dtmDateAccYear.selectedIndex].text,'t_dtmDateAccDay')">
                                        <?
										$objEmployee->comboMonth(date("n"));
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmDateAccDay" size="1" onFocus="updateList(t_dtmDateAccMonth.selectedIndex,t_dtmDateAccYear[t_dtmDateAccYear.selectedIndex].text,'t_dtmDateAccDay')">
                                        <?
										$objEmployee->comboDay(date("j"));
										?>
                                      </select>
                                      <span class="note"> </span></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Community Tax Certificate 
                                      No. :</td>
                                    <td><input name="t_strComTaxNumber" type="text" size="30" maxlength="100" onBlur="validateCharacterAndNumber(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Issued At :</td>
                                    <td><input name="t_strIssuedAt" type="text" size="30" maxlength="100" onBlur="validateFullName(this)"> 
                                      <span class="note">*</span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Issued On :</td>
                                    <td> <span class="paragraph"> Year </span> 
                                      <select name="t_dtmIssuedOnYear" size="1" onChange="updateList(t_dtmIssuedOnMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmIssuedOnDay')">
                                        <?
										$objEmployee->comboYear(date("Y"));
									   ?>
                                      </select>
                                      <span class="paragraph">Month </span> <select name="t_dtmIssuedOnMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmIssuedOnYear[t_dtmIssuedOnYear.selectedIndex].text,'t_dtmIssuedOnDay')">
                                        <?
										$objEmployee->comboMonth(date("n"));
										?>
                                      </select> <span class="paragraph"> Day </span> 
                                      <select name="t_dtmIssuedOnDay" size="1" onFocus="updateList(t_dtmIssuedOnMonth.selectedIndex,t_dtmIssuedOnYear[t_dtmIssuedOnYear.selectedIndex].text,'t_dtmIssuedOnDay')">
                                        <?
										$objEmployee->comboDay(date("j"));
										?>
                                      </select> <span class="note">*</span> <span class="note"> 
                                      </span></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                </table>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td><div align="center"> 
                                        <input name="t_intOPLNumber1" type="hidden" value="<? echo "NULL"; ?>">
                                        <input name="t_intOPLNumber2" type="hidden" value="<? echo "NULL"; ?>">
                                        <input name="t_intOPLNumber3" type="hidden" value="<? echo "NULL"; ?>">
                                        <input type="submit" name="Submit" value="ADD" onClick="trapEntryElementary();trapEntrySecondary();">
                                        <input name="Reset" type="reset" value="Clear">
                                      </div></td>
                                  </tr>
                                </table>
                              </form>
                              <? } ?>
                            </td>
                          </tr>
                          <tr> 
                            <td><?
							} else {
								
								 echo "<table width=\"80%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"TBLNUMBEREXIST\">
                                <tr>
                                  <td class=\"alterrow\"><a href=\"Personaldatasheet.php?strEmpNmbr=$strEmpNmbr\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">SORRY! THE NUMBER YOU ENTERED ALREADY EXIST. PLEASE TRY AGAIN...</a></td></tr></table>";
								  
							}	// end if($Submit2) 
							?></td>
                          </tr>
                        </table>
                        <!-- InstanceEndEditable --></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="13" colspan="2"><table width="100%" height="13" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
              <tr> 
                <td height="13"><div align="center"> 
                    <p class="login"><font color="#FFFFFF">Copyright &copy; 2003 
                      Department of Science and Technology</font></p>
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
