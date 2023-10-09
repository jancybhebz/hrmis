<?
/* 
File Name: ReportEPDBody.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add and delete agency to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: August 13, 2004
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
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require("../hrmis/class/ReportEmpPersonalData.php");

class ReportEPDBody extends General
{
	var $objRprt;
	var $intPersonalDateNum = 0;

	function printBody($t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strBirthDay, $t_strBirthPlace, $t_strResidential, $t_extResidential, $t_intZipCode1, $t_intTelephone1, $t_strPermanent, $t_extPermanent, $t_intZipCode2, $t_intTelephone2, $t_strCitizenship, $t_intHeight, $t_intWeight, $t_strBloodType, $t_strGSISNumber, $t_intPhilHealthNumber, $t_intPagibigNumber, $t_intTin, $t_strEmail, $t_intMobile, $t_strSpouse, $t_strSpouseWork, $t_strSpouseBusName, $t_strSpouseBusAddress, $t_intSpouseTelephone, $t_strChildName, $t_dtmChildBirthDate, $t_strFatherName, $t_strMotherName, $t_strParentAddress, $t_strSkills, $t_strNADR, $t_strMIAO, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strAdminCaseParticulars, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strIndigenous, $t_strIndigenousParticulars, $t_strSoloParent, $t_strSoloParentParticulars, $t_strSignature, $t_dtmDateAccomplished, $t_strCTC, $t_strIssuedAt, $t_dtmIssuedOn, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_intUnits, $t_dtmSchoolFromDate, $t_dtmSchoolToDate, $t_strHonors, $t_strExamCode, $t_dtmExamDate, $t_intExamRating, $t_strExamPlace, $t_strLicenseNumber, $t_dtmDateRelease, $t_dtmServiceFromDate, $t_dtmServiceToDate, $t_strPositionCode, $t_intSalary, $t_strStationAgency, $t_strAppointmentCode, $t_strSeparationCause, $t_dtmSeparationDate, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFrom, $t_dtmVWDateTo, $t_intVWHours, $t_strVWPosition, $t_strTrainingCode, $t_dtmTrainingContractDate, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_dtmTrainingStartDate, $t_dtmTrainingEndDate, $t_intTrainingHours, $t_intTrainingCost, $t_strRefName, $t_strRefAddress, $t_intRefTelephone)
	{
		$InterLigne = 6;
		$Ligne = 45;

		//  start here PERSONAL DATA SHEET
		$this->objRprt->SetFont('Arial','',7);
		$this->objRprt->Cell(5,$InterLigne,"CS Form 212 (Revised 2003)",LT,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,"",T,0,L);
		$this->objRprt->Cell(95,$InterLigne,"",T,0,C);
		$this->objRprt->Cell(15,$InterLigne,"",T,0,L);
		$this->objRprt->Cell(30,$InterLigne,"",T,0,L);
		$this->objRprt->Cell(0,$InterLigne,"",TR,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(5,$InterLigne,"",L,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->objRprt->SetFont('Arial','B',20);
		$this->objRprt->Cell(95,$InterLigne,"",0,0,C);
		$this->objRprt->Cell(15,$InterLigne,"",0,0,L);
		$this->objRprt->SetFont('Arial','',6);
		$this->objRprt->Cell(30,$InterLigne,"",LTR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",R,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(5,$InterLigne,"",L,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->objRprt->SetFont('Arial','B',20);
		$this->objRprt->Cell(95,$InterLigne,"",0,0,C);
		$this->objRprt->Cell(15,$InterLigne,"",0,0,L);
		$this->objRprt->SetFont('Arial','',6);
		$this->objRprt->Cell(30,$InterLigne,"not older than 6 mos.",LR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",R,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(5,$InterLigne,"",L,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->objRprt->SetFont('Arial','B',20);
		$this->objRprt->Cell(95,$InterLigne,"PERSONAL DATA SHEET",0,0,C);
		$this->objRprt->Cell(15,$InterLigne,"",0,0,L);
		$this->objRprt->SetFont('Arial','',6);

/*		
		$objEmpPicture = ("SELECT empNumber, picture, filetype FROM tblEmpPicture WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
		$arrEmpPicture = @mysql_query($objEmpPicture);
		$strEmpNumberPicture = @mysql_result($arrEmpPicture,0,"empNumber");
		$strEmpPicture = @mysql_result($arrEmpPicture,0,"picture");
		$strEmpFileType = @mysql_result($arrEmpPicture,0,"filetype");
		
		Header("Content-type: $arrEmpFileType");


*/

		$this->objRprt->Cell(30,$InterLigne,"picture here",LR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",R,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(5,$InterLigne,"",L,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->objRprt->Cell(95,$InterLigne,"",0,0,C);
		$this->objRprt->Cell(15,$InterLigne,"",0,0,L);
		$this->objRprt->SetFont('Arial','',6);
		$this->objRprt->Cell(30,$InterLigne,"(passport size)",LR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",R,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(5,$InterLigne,"",L,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->objRprt->SetFont('Arial','B',20);
		$this->objRprt->Cell(95,$InterLigne,"",0,0,C);
		$this->objRprt->Cell(15,$InterLigne,"",0,0,L);
		$this->objRprt->SetFont('Arial','',6);
		$this->objRprt->Cell(30,$InterLigne,"",LBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",R,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','',7);
		$this->objRprt->Cell(5,$InterLigne,"Print legibly. Mark approriate boxed",L,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->objRprt->Cell(95,$InterLigne,"",0,0,C);
		$this->objRprt->Cell(15,$InterLigne,"",0,0,L);
		$this->objRprt->Cell(30,$InterLigne,"",0,0,L);
		$this->objRprt->Cell(0,$InterLigne,"",R,0,L);
		$this->objRprt->Ln(6);

		//  PERSONAL INFORMATION - Colors of frame, background and text
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(0,$InterLigne,"I. PERSONAL INFORMATION",1,0,L,1);
		$this->objRprt->Ln(6);

		//  surname
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"1.     SURNAME ",LTR,0,L);

		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(15,$InterLigne,"",B,0);
		$this->objRprt->Cell(136,$InterLigne,$t_strSurname,BR,0);
		$this->objRprt->Ln(6);
		
		//  firstname
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"        FIRST NAME ",LR,0,L);

		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(15,$InterLigne,"",B,0);
		$this->objRprt->Cell(136,$InterLigne,$t_strFirstname,BR,0);
		$this->objRprt->Ln(6);

		//   middle name
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"        MIDDLE NAME ",LR,0,L);

		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(15,$InterLigne,"",B,0);
		$this->objRprt->Cell(136,$InterLigne,$t_strMiddlename,BR,0);
		$this->objRprt->Ln(6);

		//  Date of Birth
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"2.     DATE OF BIRTH ",LTBR,0,L);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,$t_strBirthDay,1,0,C);

		//  Residential
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"13.    RESIDENTIAL                   ",LTR,0,L);

		$this->objRprt->SetFont('Arial','B',6);
		$this->objRprt->Cell(0,$InterLigne,$t_strResidential,1,0,L);
		$this->objRprt->Ln(6);

		//  Place of Birth
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"3.     PLACE OF BIRTH ",LTBR,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,$t_strBirthPlace,1,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);

		$this->objRprt->SetFont('Arial','B',6);
		$this->objRprt->Cell(0,$InterLigne,$t_extResidential,1,0,L);
		$this->objRprt->Ln(6);
		
		//  Sex
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"4.     SEX ",LTBR,0,L);

		$objEmpSex = mysql_query("SELECT sex FROM tblEmpPersonal 
								WHERE empNumber = '".$_SESSION['sesEmpNum']."'");

		$intEmpSexCounter = 0 ;
		while($arrEmpSex = mysql_fetch_array($objEmpSex))
		{
			$intEmpSexCounter++;
			$strEmpSex = $arrEmpSex['sex'];
			$strSex = "x";	
			if ($intEmpSexCounter != 0) 
			{
				if($strEmpSex == 'M') 
				{
			
				$this->objRprt->Cell($Ligne,$InterLigne,"[" . $strSex . "]   Male     [  ]   Female",1,0,C);
				} else {
				$this->objRprt->Cell($Ligne,$InterLigne,"[  ]   Male     [" . $strSex . "]   Female",1,0,C);
				
				}	//  end if $strEmpSex
			
			}	//  end if $intEmpSexCounter
		
		}	//  end while

		$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",R,0);
		$this->objRprt->Ln(6);
		
		//  civil status
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"5.     CIVIL STATUS ",LR,0);

		$objEmpCivilStatus = mysql_query("SELECT civilStatus FROM tblEmpPersonal 
								WHERE empNumber = '".$_SESSION['sesEmpNum']."'");

		$intEmpCivilStatusCounter = 0 ;
		while($arrEmpCivilStatus = mysql_fetch_array($objEmpCivilStatus))
		{
			$intEmpCivilStatusCounter++;
			$strEmpCivilStatus = $arrEmpCivilStatus['civilStatus'];
			$strEmpCStatus = "x";	
			if ($intEmpCivilStatusCounter != 0) 
			{
				if($strEmpCivilStatus == 'Single') 
				{
			
					$this->objRprt->Cell($Ligne,$InterLigne,"[" . $strEmpCStatus . "]  Single  [  ]  Widowed",R,0,C);

				} elseif ($strEmpCivilStatus == 'Widowed') {
				
					$this->objRprt->Cell($Ligne,$InterLigne,"[  ]  Single  [" . $strEmpCStatus . "]  Widowed",R,0,C);
				
				} else {
				
					$this->objRprt->Cell($Ligne,$InterLigne,"[  ]  Single    [  ]  Widowed",R,0,C);
				
				}	//  end if $strEmpCivilStatus
			
			}	//  end if $intEmpCivilStatusCounter
		
		}	//  end while



		$this->objRprt->Cell($Ligne,$InterLigne,"        ZIP CODE                            ",R,0,L);
		$this->objRprt->Cell(0,$InterLigne,$t_intZipCode1,TBR,0);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);		//  Civil Status Blank


		$objEmpCivilStatus2 = mysql_query("SELECT civilStatus FROM tblEmpPersonal 
								WHERE empNumber = '".$_SESSION['sesEmpNum']."'");

		$intEmpCivilStatusCounter2 = 0 ;
		while($arrEmpCivilStatus2 = mysql_fetch_array($objEmpCivilStatus2))
		{
			$intEmpCivilStatusCounter2++;
			$strEmpCivilStatus2 = $arrEmpCivilStatus2['civilStatus'];
			$strEmpCStatus2 = "x";	
			if ($intEmpCivilStatusCounter2 != 0) 
			{
				if ($strEmpCivilStatus2 == 'Married') {

					$this->objRprt->Cell($Ligne,$InterLigne,"[" . $strEmpCStatus2 . "]  Married  [  ]  Separated",R,0,C);

				} elseif ($strEmpCivilStatus2 == 'Separated') {

					$this->objRprt->Cell($Ligne,$InterLigne,"[  ]  Married  [" . $strEmpCStatus2 . "]  Separated",R,0,C);

				} else {
				
					$this->objRprt->Cell($Ligne,$InterLigne,"     [  ]  Married  [  ]  Separated",R,0,C);

				}	//  end if $strEmpCivilStatus
			
			}	//  end if $intEmpCivilStatusCounter
		
		}	//  end while


		$this->objRprt->Cell($Ligne,$InterLigne,"14.    TELEPHONE NO                   ",LBR,0);

		$this->objRprt->Cell(0,$InterLigne,$t_intTelephone1,R,0);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell($Ligne,$InterLigne,"",LBR,0,C);		//  Civil Status Blank

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"",R,0,C);

		$this->objRprt->Cell($Ligne,$InterLigne,"15.   PERMANENT",LR,0);

		$this->objRprt->SetFont('Arial','B',6);
		$this->objRprt->Cell(0,$InterLigne,$t_strPermanent,1,0,L);
		$this->objRprt->Ln(6);
		
		//  citizenship
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"6.     CITIZENSHIP ",LTR,0);
		$this->objRprt->Cell($Ligne,$InterLigne,$t_strCitizenship,1,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0);
		$this->objRprt->SetFont('Arial','B',6);
		$this->objRprt->Cell(0,$InterLigne,$t_extPermanent,1,0,L);
		$this->objRprt->Ln(6);
		//  height
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"7.     HEIGHT (m) ",LTR,0);
		$this->objRprt->Cell($Ligne,$InterLigne,$t_intHeight,1,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"        ZIP CODE                            ",R,0,L);
		$this->objRprt->Cell(0,$InterLigne,$t_intZipCode2,1,0);
		$this->objRprt->Ln(6);

		//Text color in gray
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"8.     WEIGHT (kg) ",1,0,L);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,$t_intWeight,1,0,C);

		//  AGENCY EMPLOYEE NO.
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"16.    TELEPHONE NO.  ",1,0,L);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$t_intTelephone2,1,0);
		$this->objRprt->Ln(6);

		//Text color in gray
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"9.     BLOOD TYPE ",1,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,$t_strBloodType,1,0,C);

		//  AGENCY EMPLOYEE NO.
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"17.    E-MAIL ADDRESS (if any)  ",1,0,L);
		$this->objRprt->Cell(0,$InterLigne,$t_strEmail,1,0);
		$this->objRprt->Ln(6);

		//Text color in gray
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"10.   GSIS POLICY NO. ",1,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,$t_strGSISNumber,1,0,C);

		//  AGENCY EMPLOYEE NO.
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"18.    CELLPHONE NO. (if any)   ",1,0,L);
		$this->objRprt->Cell(0,$InterLigne,$t_intMobile,1,0,L);
		$this->objRprt->Ln(6);

		//Text color in gray
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"11.   PAG-IBIG ID NO. ",1,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,$t_intPagibigNumber,1,0,C);

		//  AGENCY EMPLOYEE NO.
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"19.    AGENCY EMPLOYEE NO.  ",1,0,L);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$t_strEmpNumber,1,0,L);
		$this->objRprt->Ln(6);

		//   PHILHEALTH NO.
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"12.   PHILHEALTH NO. ",1,0,L);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,$t_intPhilHealthNumber,1,0,C);

		//  TIN
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"20.    TIN                                       ",1,0,L);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$t_intTin,1,0,L);
		$this->objRprt->Ln(6);

		//   FAMILY BACKGROUND
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(0,$InterLigne,"II. FAMILY BACKGROUND",1,0,L,1);
		$this->objRprt->Ln(6);

		//  name of spouse
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"21.   NAME OF SPOUSE",LBR,0);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$t_strSpouse,1,0);
		$this->objRprt->Ln(6);

		//  occupation
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"        OCCUPATION",LR,0);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$t_strSpouseWork,R,0);
		$this->objRprt->Ln(6);

		//  employer/bus.name
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"        EMPLOYER/BUS. NAME ",1,0,'LR');

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$t_strSpouseBusName,1,0);
		$this->objRprt->Ln(6);

		//  business address
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"        BUSINESS ADDRESS ",1,0,'LR');

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$t_strSpouseBusAddress,1,0);
		$this->objRprt->Ln(6);

		//  telephone no.
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"        TELEPHONE NO. ",1,0,'LR');

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$t_intSpouseTelephone,1,0);
		$this->objRprt->Ln(6);

		//  name of birth
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(90,$InterLigne,"22.   N A M E   O F   C H I L D R E N",1,0);
		$this->objRprt->Cell(0,$InterLigne,"Date of Birth (mm/dd/yyyy)",1,0,C);
		$this->objRprt->Ln(6);

		$objEmpChild = mysql_query("SELECT * FROM tblEmpChild 
									WHERE empNumber = '".$_SESSION['sesEmpNum']."' 
										ORDER BY tblEmpChild.childBirthDate DESC limit 0,12");
		
		$intChildCounter = 0;
		while($arrEmpChild = mysql_fetch_array($objEmpChild)) 
		{
			$intChildCounter++;
			$strEmpNumberInChild = $arrEmpChild['empNumber'];
			$strEmpChildName = $arrEmpChild['childName'];
			$dtmEmpChildBirthDate = $arrEmpChild['childBirthDate'];

			if ($intChildCounter != 0 || $strEmpNumberInChild != NULL) 
			{

				$this->objRprt->SetFont(Arial,B,8);
				$this->objRprt->Cell(90,$InterLigne,$strEmpChildName,1,0,C);
				$this->objRprt->Cell(0,$InterLigne,$dtmEmpChildBirthDate,1,0,C);
				$this->objRprt->Ln(6); 
																			
			}	//  end if
			
		}	//  end while

		if ($strEmpChildName <= 8) 				//  if child is empty/not applicable
		{
		
		//  empty employee number in tblEmpChild
		$this->objRprt->SetFont('Arial',B,8);
		$this->objRprt->Cell(90,$InterLigne,"Not - Applicable",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);
		
		$this->objRprt->Cell(90,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(90,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);
		
		$this->objRprt->Cell(90,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(90,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);
		
		$this->objRprt->Cell(90,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);
		
		}
		
		//  name of father
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"23.   NAME OF FATHER ",1,0,'LR');
		$this->objRprt->Cell($Ligne,$InterLigne,$t_strFatherName,1,0);

		//  full maiden name of mother
		$this->objRprt->Cell(55,$InterLigne,"24.   FULL MAIDEN NAME OF MOTHER",1,0,LT);
		$this->objRprt->Cell(0,$InterLigne,$t_strMotherName,1,0);
		$this->objRprt->Ln(6);

		//  parent address
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"25.   PARENT ADDRESS ",1,0,'LR');
		$this->objRprt->Cell(0,$InterLigne,$t_strParentAddress,1,0);
		$this->objRprt->Ln(6);

		//  EDUCATIONAL BACKGROUND
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(0,$InterLigne,"III. EDUCATIONAL BACKGROUND",1,0,'L',1);
		$this->objRprt->Ln(6);

		//  level
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell($Ligne,$InterLigne,"26.",LTR,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LTR,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LTR,0,C);
		$this->objRprt->Cell(22,$InterLigne,"Highest Grade/",LTR,0,C);
		$this->objRprt->Cell(22,$InterLigne,"INCLUSIVE",LTR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"ACADEMIC",LTR,0,C);
		$this->objRprt->Ln(3);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"Name of School",LR,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"DEGREE / COURSE",LR,0,C);
		$this->objRprt->Cell(22,$InterLigne,"Level/",LR,0,C);
		$this->objRprt->Cell(22,$InterLigne,"DATES OF",LR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"HONORS",LR,0,C);
		$this->objRprt->Ln(3);
		$this->objRprt->Cell($Ligne,$InterLigne,"LEVEL",LR,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"(Write in full)",LR,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"(Write in full)",LR,0,C);
		$this->objRprt->Cell(22,$InterLigne,"Units Earned",LR,0,C);
		$this->objRprt->Cell(22,$InterLigne,"ATTENDANCE",LR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"RECEIVED",LR,0,C);
		$this->objRprt->Ln(3);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->objRprt->Cell(22,$InterLigne,"(If not",LR,0,C);
		$this->objRprt->Cell(22,$InterLigne,"",LR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(3);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->objRprt->Cell(22,$InterLigne,"graduate)",LBR,0,C);
		$this->objRprt->Cell(11,$InterLigne,"FROM",LTBR,0,C);
		$this->objRprt->Cell(11,$InterLigne,"TO",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LBR,0,C);
		$this->objRprt->Ln(6);



		$objEmpSchool = mysql_query("SELECT *
									FROM tblEmpSchool
									WHERE empNumber = '".$_SESSION['sesEmpNum']."'
										ORDER BY schoolFromDate ASC limit 0,12");

		$intSchoolCounter = 0;
		while($arrEmpSchool = mysql_fetch_array($objEmpSchool))
		{
			$intSchoolCounter++;
			$strEmpLevelCode = $arrEmpSchool['levelCode'];
			$strEmpSchoolNumber = $arrEmpSchool['empNumber'];
			$strEmpSchoolName = $arrEmpSchool['schoolName'];
			$strEmpSchoolCourse = $arrEmpSchool['course'];
			$intEmpSchoolUnits = $arrEmpSchool['units'];
			$dtmEmpSchoolFromDate = $arrEmpSchool['schoolFromDate'];
			$dtmEmpSchoolToDate = $arrEmpSchool['schoolToDate'];
			$strEmpSchoolHonors = $arrEmpSchool['honors'];
			
			if ($intSchoolCounter != 0) 
			{
				if ($strEmpLevelCode == 'ELM' && $strEmpSchoolName != NULL) 
				{
					$this->objRprt->Cell($Ligne,$InterLigne,"ELEMENTARY",LBR,0,C);
					
				} elseif ($strEmpLevelCode == 'HSL' && $strEmpSchoolName != NULL) 
				{
				
					$this->objRprt->Cell($Ligne,$InterLigne,"SECONDARY",LBR,0,C);
					
				} elseif ($strEmpLevelCode == 'VCL' && $strEmpSchoolName != '') 
				{
				
					$this->objRprt->Cell($Ligne,$InterLigne,"VOCATIONAL",LBR,0,C);
				
				} elseif ($strEmpLevelCode == 'TRT' && $strEmpSchoolName != NULL) 
				{
				
					$this->objRprt->Cell($Ligne,$InterLigne,"TRADE COURSE",LBR,0,C);

				} elseif ($strEmpLevelCode == 'TRT' && $strEmpSchoolName != '') 
				{
				
					$this->objRprt->Cell($Ligne,$InterLigne,"TRADE COURSE",LBR,0,C);
			
				} elseif ($strEmpLevelCode == 'CLG' && $strEmpSchoolName != '') 
				{
					$this->objRprt->Cell($Ligne,$InterLigne,"GRADUATE STUDIES",LR,0,L);
					$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",LR,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",LR,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",LR,0,C);
					$this->objRprt->Cell(0,$InterLigne,"",LR,0,L);
					$this->objRprt->Ln(6);
					
					$this->objRprt->Cell($Ligne,$InterLigne,"        - Diploma",LR,0,L);
				
				} elseif ($strEmpLevelCode == 'MA/MS' && $strEmpSchoolName != '')
				{
				
					$this->objRprt->Cell($Ligne,$InterLigne,"        - Master's",LR,0,L);

				} elseif ($strEmpLevelCode == 'Ph.D.' && $strEmpSchoolName != '') 
				{
				
					$this->objRprt->Cell($Ligne,$InterLigne,"        - Doctorate",LR,0,L);
				
				} elseif ($strEmpLevelCode == 'NDC' && $strEmpSchoolName != '') 
				{
			
					$this->objRprt->Cell($Ligne,$InterLigne,"NON-DEGREE COURSE*",LR,0,L);
					
				}	//  end if $strEmpLevelCode
				
				$this->objRprt->SetFont('Arial',B,8);
				$this->objRprt->Cell($Ligne,$InterLigne,$strEmpSchoolName,1,0,C);
				$this->objRprt->Cell($Ligne,$InterLigne,$strEmpSchoolCourse,1,0,C);
				$this->objRprt->Cell(22,$InterLigne,$intEmpSchoolUnits,1,0,C);
				$this->objRprt->SetFont('Arial',B,6);
				$this->objRprt->Cell(11,$InterLigne,$dtmEmpSchoolFromDate,1,0,C);
				$this->objRprt->Cell(11,$InterLigne,$dtmEmpSchoolToDate,1,0,C);
				$this->objRprt->SetFont('Arial',B,7);
				$this->objRprt->Cell(0,$InterLigne,$strEmpSchoolHonors,1,0,C);
				$this->objRprt->SetFont('Arial',B,8);
				$this->objRprt->Ln(6);
				
				if(!$strEmpLevelCode && $strEmpSchoolName == NULL) 		//	empty lines
				{
				
					$this->objRprt->SetFont('Arial',B,8);
					$this->objRprt->Cell($Ligne,$InterLigne,"ELEMENTARY",LBR,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,6);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
					$this->objRprt->Ln(6);
					
					$this->objRprt->SetFont('Arial',B,8);
					$this->objRprt->Cell($Ligne,$InterLigne,"SECONDARY",LBR,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,6);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
					$this->objRprt->Ln(6);
					
					$this->objRprt->SetFont('Arial',B,8);
					$this->objRprt->Cell($Ligne,$InterLigne,"VOCATIONAL",LBR,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,6);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
					$this->objRprt->Ln(6);
				
					$this->objRprt->SetFont('Arial',B,8);
					$this->objRprt->Cell($Ligne,$InterLigne,"TRADE COURSE",LBR,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,6);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
					$this->objRprt->Ln(6);

					$this->objRprt->SetFont('Arial',B,8);
					$this->objRprt->Cell($Ligne,$InterLigne,"TRADE COURSE",LBR,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,6);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
					$this->objRprt->Ln(6);
			
					$this->objRprt->SetFont('Arial',B,8);
					$this->objRprt->Cell($Ligne,$InterLigne,"GRADUATE STUDIES",LR,0,L);
					$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",LR,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",LR,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",LR,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",LR,0,C);
					$this->objRprt->Cell(0,$InterLigne,"",LR,0,L);
					$this->objRprt->Ln(6);
					
					$this->objRprt->Cell($Ligne,$InterLigne,"        - Diploma",LR,0,L);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,6);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
					$this->objRprt->Ln(6);
				
					$this->objRprt->SetFont('Arial',B,8);
					$this->objRprt->Cell($Ligne,$InterLigne,"        - Master's",LR,0,L);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,6);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
					$this->objRprt->Ln(6);

					$this->objRprt->SetFont('Arial',B,8);
					$this->objRprt->Cell($Ligne,$InterLigne,"        - Doctorate",LR,0,L);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,6);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
					$this->objRprt->Ln(6);

					$this->objRprt->SetFont('Arial',B,8);
					$this->objRprt->Cell($Ligne,$InterLigne,"NON-DEGREE COURSE*",LR,0,L);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell($Ligne,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(22,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,6);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->Cell(11,$InterLigne,"",1,0,C);
					$this->objRprt->SetFont('Arial',B,7);
					$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
					$this->objRprt->Ln(6);

				}	//  end if strEmpLevelCode			
				
			}	//  end if $intSchoolCounter != 0;

		}	//  end while
		
		$this->objRprt->SetFont('Arial','B',7);
		$this->objRprt->Cell(0,5,"*(COURSE TAKEN FROM Tertiary education but not classified as Graduate Studies)",LR,0,C);
		$this->objRprt->Ln(4);
		$this->objRprt->SetFont('Arial','B',6);
		$this->objRprt->Cell(0,4,"(Continue on Separate sheet if necessary)",1,0,C);
		$this->objRprt->Ln(31);

		//  CIVIL SERVICE ELIGIBILITY
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(0,$InterLigne,"IV. CIVIL SERVICE ELIGIBILITY",1,0,'L',1);
		$this->objRprt->Ln(6);
		
		//  career service/RA 1080(board/bar)
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(65,$InterLigne,"27.    CAREER SERVICE/RA 1080(BOARD/BAR)",LTR,0,L,1);
		$this->objRprt->Cell(20,$InterLigne,"",LTR,0,C,1);
		$this->objRprt->Cell(30,$InterLigne,"Date of",LTR,0,C,1);
		$this->objRprt->Cell(35,$InterLigne,"",LTR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"LICENSE (if applicable)",LTBR,0,C,1);
		$this->objRprt->Ln(4);
		
		$this->objRprt->Cell(65,$InterLigne,"UNDER SPECIAL LAWS/CES/CSEE",LR,0,L,1);
		$this->objRprt->Cell(20,$InterLigne,"RATING",LR,0,C,1);
		$this->objRprt->Cell(30,$InterLigne,"Examination/",LR,0,C,1);
		$this->objRprt->Cell(35,$InterLigne,"Place of Examination/",LR,0,C,1);
		$this->objRprt->Cell(20,$InterLigne,"Number",LTBR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"Date of",LTR,0,C,1);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(65,$InterLigne,"",LBR,0,L,1);
		$this->objRprt->Cell(20,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->Cell(30,$InterLigne,"Conferment",LBR,0,C,1);
		$this->objRprt->Cell(35,$InterLigne,"Conferment",LBR,0,C,1);
		$this->objRprt->Cell(20,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"Release",LBR,0,C,1);
		$this->objRprt->Ln(6);


		$objEmpExam = mysql_query("SELECT tblEmpExam.*, tblExamType.*
								FROM tblEmpExam
								INNER JOIN tblExamType
									ON tblEmpExam.examCode = tblExamType.examCode
								WHERE tblEmpExam.empNumber = '".$_SESSION['sesEmpNum']."'
									ORDER BY tblEmpExam.examDate DESC limit 0,3");
		
		$intEmpExamCounter = 0;
		while($arrEmpExam = mysql_fetch_array($objEmpExam))
		{
			$intEmpExamCounter++;
			$strEmpNumberExam = $arrEmpExam['empNumber'];
			$strEmpExamCode = $arrEmpExam['examCode'];
			$strEmpExamDesc = $arrEmpExam['examDesc'];
			$dtmEmpExamDate = $arrEmpExam['examDate'];
			$intEmpExamRating = $arrEmpExam['examRating'];
			$strEmpExamPlace = $arrEmpExam['examPlace'];
			$strEmpExamLicense = $arrEmpExam['licenseNumber'];
			$dtmEmpExamDateRelease = $arrEmpExam['dateRelease'];
			
			if ($intEmpExamCounter != 0) 
			{
				//  first line
					$this->objRprt->Cell(65,$InterLigne,$strEmpExamDesc,LTBR,0,L);
					$this->objRprt->Cell(20,$InterLigne,$intEmpExamRating,LTBR,0,C);
					$this->objRprt->Cell(30,$InterLigne,$dtmEmpExamDate,LTBR,0,C);
					$this->objRprt->Cell(35,$InterLigne,$strEmpExamPlace,LTBR,0,C);
					$this->objRprt->Cell(20,$InterLigne,$strEmpExamLicense,LTBR,0,C);
					$this->objRprt->Cell(0,$InterLigne,$dtmEmpExamDateRelease,LTBR,0,C);
					$this->objRprt->Ln(6);

			}  //  end if ($intEmpExamCounter)
			
		}	//  end while

		if ($strEmpExamCode <= 2) 
		{
			//  second line
			$this->objRprt->Cell(65,$InterLigne,"  --  Start of this line is Not-Applicable  --  ",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(35,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Ln(6);

			//  third line
			$this->objRprt->Cell(65,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(35,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Ln(6);
	
			//  fourth line
			$this->objRprt->Cell(65,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(35,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Ln(6);
	
			//  fifth line
			$this->objRprt->Cell(65,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(35,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Ln(6);
	
			//  sixth line
			$this->objRprt->Cell(65,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(35,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Ln(6);
	
			//  seventh line
			$this->objRprt->Cell(65,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(35,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Ln(6);
	
			//  eight line
			$this->objRprt->Cell(65,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(35,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,L);
			$this->objRprt->Ln(6);
	
		}	//  end if $strEmpNumberExam


		$this->objRprt->SetFont('Arial','B',6);
		$this->objRprt->Cell(0,4,"(Continue on Separate sheet if necessary)",1,0,C);
		$this->objRprt->Ln(4);
		
		//Colors of frame, background and text
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(0,$InterLigne,"V. WORK EXPERIENCE (include private employment start from most recent work experience.)",1,0,L,1);
		$this->objRprt->Ln(6);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(40,$InterLigne,"28.    INCLUSIVE DATES",LTR,0,L,1);
		$this->objRprt->Cell(45,$InterLigne,"POSITION TITLE",LTR,0,C,1);
		$this->objRprt->Cell(60,$InterLigne,"",LTR,0,C,1);
		$this->objRprt->Cell(25,$InterLigne,"MONTHLY",LTR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"STATUS OF",LTR,0,C,1);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(40,$InterLigne,"(mm/dd/yyyy)",LBR,0,C,1);
		$this->objRprt->Cell(45,$InterLigne,"(Write in full)",LR,0,C,1);
		$this->objRprt->Cell(60,$InterLigne,"DEPARTMENT/AGENCY/OFFICE",LR,0,C,1);
		$this->objRprt->Cell(25,$InterLigne,"SALARY",LR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"APPOINTMENT",LR,0,C,1);
		$this->objRprt->Ln(6);
		
		$this->objRprt->Cell(20,$InterLigne,"From",LTBR,0,C,1);
		$this->objRprt->Cell(20,$InterLigne,"To",LTBR,0,C,1);
		$this->objRprt->Cell(45,$InterLigne,"",LR,0,C,1);
		$this->objRprt->Cell(60,$InterLigne,"",LR,0,C,1);
		$this->objRprt->Cell(25,$InterLigne,"",LR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,L,1);
		$this->objRprt->Ln(6);
		
		
		$objEmpSrvcRcd = mysql_query("SELECT tblServiceRecord.*, tblPosition.positionDesc,
											tblPosition.positionCode
										FROM tblServiceRecord
										INNER JOIN tblPosition
											ON tblServiceRecord.positionCode = tblPosition.positionCode
										WHERE empNumber = '".$_SESSION['sesEmpNum']."' ");
		
		$intEmpSrvcRcdCounter = 0;
		while($arrEmpSrvcRcd = mysql_fetch_array($objEmpSrvcRcd))
		{
			$intEmpSrvcRcdCounter++;
			$strEmpSrvcRcdID= $arrEmpSrvcRcd['serviceRecID'];
			$strEmpNumberSrvcRcd = $arrEmpSrvcRcd['empNumber'];
			$strEmpSrvcRcdFromDate = $arrEmpSrvcRcd['serviceFromDate'];
			$strEmpSrvcRcdToDate = $arrEmpSrvcRcd['serviceToDate'];
			$strEmpSrvcRcdPositionCode = $arrEmpSrvcRcd['positionCode'];
			$strEmpSrvcRcdPositionDesc = $arrEmpSrvcRcd['positionDesc'];
			$intEmpSrvcRcdSalary = $arrEmpSrvcRcd['salary'];
			$strEmpSrvcRcdStationAgency = $arrEmpSrvcRcd['stationAgency'];
			$strEmpSrvcRcdAppointmentCode = $arrEmpSrvcRcd['appointmentCode'];
			$strEmpSrvcRcdSeparationCause = $arrEmpSrvcRcd['separationCause'];
			$strEmpSrvcRcdSeparationDate = $arrEmpSrvcRcd['separationDate'];
		
		
			if ($intEmpSrvcRcdCounter != 0) 
			{
				//  1.
				
				$this->objRprt->SetFont('Arial',B,6);
				$this->objRprt->Cell(20,$InterLigne,$strEmpSrvcRcdFromDate,1,0,C);
				$this->objRprt->Cell(20,$InterLigne,$strEmpSrvcRcdToDate,1,0,C);
				$this->objRprt->SetFont('Arial',B,7);
				$this->objRprt->Cell(45,$InterLigne,$strEmpSrvcRcdPositionDesc,1,0,C);
				$this->objRprt->Cell(60,$InterLigne,$strEmpSrvcRcdStationAgency,1,0,L);
				$this->objRprt->Cell(25,$InterLigne,$intEmpSrvcRcdSalary,1,0,C);
				$this->objRprt->Cell(0,$InterLigne,$strEmpSrvcRcdAppointmentCode,1,0,C);
				$this->objRprt->Ln(6);
		
			
			}	//  end if ($intEmpSrvcRcdCounter) 
			
		}	//  end while									

		if ($strEmpSrvcRcdPositionCode <=10)
		{
			//  2.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
		
			//  3.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  4.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  5.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  6.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  7.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  8.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  9.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  10.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  11.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  12.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  13.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  14.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  15.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
			
			//  16.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  17.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  18.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  19.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  20.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  21.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  22.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
			
			//  23.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  24.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  25.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
	
			//  26.
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(20,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(45,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(60,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(25,$InterLigne,"",1,0,L);
			$this->objRprt->Cell(0,$InterLigne,"",1,0,L);
			$this->objRprt->Ln(6);
		}


		//  work experience separate sheet
		$this->objRprt->SetFont('Arial','B',6);
		$this->objRprt->Cell(0,4,"(Continue on separate sheet, if necessary)",1,0,C);
		$this->objRprt->Ln(4);
		
		//  work experience affixe applicant signature and date
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,"",LTR,0,C);
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(0,$InterLigne,"Affix your signature: ___________________________________________________              Date  :	__________________",LR,0,C);
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(0,$InterLigne,"",LBR,0,C);
		$this->objRprt->Ln(30);

		
		//  VOLUNTARY WORK (Colors of frame, background and text)
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(0,$InterLigne,"VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / ORGANIZATIONS",1,0,'L',1);
		$this->objRprt->Ln(6);
		//Text color in gray
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(70,$InterLigne,"NAME & ADDRESS OF ORGANIZATION",LTR,0,C,1);
		$this->objRprt->Cell(50,$InterLigne,"INCLUSIVE DATES (mm/dd/yyyy)",LTBR,0,C,1);
		$this->objRprt->Cell(30,$InterLigne,"NUMBER OF",LTR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"POSITION/",LTR,0,C,1);
		$this->objRprt->Ln(6);
		
		$this->objRprt->Cell(70,$InterLigne,"(Write in full)",LR,0,C,1);
		$this->objRprt->Cell(25,$InterLigne,"From",LTBR,0,C,1);
		$this->objRprt->Cell(25,$InterLigne,"To",LTBR,0,C,1);
		$this->objRprt->Cell(30,$InterLigne,"HOURS",LBR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"NATURE OF WORK",LBR,0,C,1);
		$this->objRprt->Ln(6);
		
		
		$objEmpVoluntaryWrk = mysql_query("SELECT * FROM tblEmpVoluntaryWork
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'
										ORDER BY vwDateFrom DESC, vwDateTo DESC limit 0,5");
		
		$intVoluntaryWrkCounter = 0;								
		while ($arrEmpVoluntaryWrk = mysql_fetch_array($objEmpVoluntaryWrk))
		{
			$intVoluntaryWrkCounter++;
			$strEmpNumberVoluntaryWrk = $arrEmpVoluntaryWrk['empNumber'];
			$strEmpVWName = $arrEmpVoluntaryWrk['vwName'];
			$strEmpVWAddress = $arrEmpVoluntaryWrk['vwAddress'];
			$dtmEmpVWDateFrom = $arrEmpVoluntaryWrk['vwDateFrom'];
			$dtmEmpVWDateTo = $arrEmpVoluntaryWrk['vwDateTo'];
			$intEmpVWHours = $arrEmpVoluntaryWrk['vwHours'];
			$strEmpVWPosition = $arrEmpVoluntaryWrk['vwPosition'];

			if ($intVoluntaryWrkCounter != 0 || $strEmpNumberVoluntaryWrk != NULL)
			{
				
				$this->objRprt->Cell(70,$InterLigne,$strEmpVWName . " - " . $strEmpVWAddress,1,0,L);
				$this->objRprt->Cell(25,$InterLigne,$dtmEmpVWDateFrom,1,0,C);
				$this->objRprt->Cell(25,$InterLigne,$dtmEmpVWDateTo,1,0,C);
				$this->objRprt->Cell(30,$InterLigne,$intEmpVWHours,1,0,C);
				$this->objRprt->Cell(0,$InterLigne,$strEmpVWPosition,1,0,C);
				$this->objRprt->Ln(6);

			}	//  end if
		
		}	//  end while

		if ($strEmpVWName <= 2)
		{

		//  line 2
		$this->objRprt->Cell(70,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);

		//  line 3
		$this->objRprt->Cell(70,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);

		//  line 4
		$this->objRprt->Cell(70,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);

		//  line 5
		$this->objRprt->Cell(70,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);
		}

		// voluntary work - continue on separate sheet
		$this->objRprt->SetFont('Arial','B',6);
		$this->objRprt->Cell(0,4,"(Continue on separate sheet, if necessary)",1,0,C);
		$this->objRprt->Ln(4);

		//  TRAINING PROGRAMS (Colors of frame, background and text)
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(0,$InterLigne,"VII. TRAINING PROGRAMS / STUDY / SCHOLARSHIP GRANTS (starts from the most recent training)",1,0,'L',1);
		$this->objRprt->Ln(6);
		
		//  30. title of seminar/trainings
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(70,$InterLigne,"30.",LTR,0,L,1);
		$this->objRprt->Cell(50,$InterLigne,"",LTR,0,C,1);
		$this->objRprt->Cell(30,$InterLigne,"",LTR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LTR,0,C,1);
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(70,$InterLigne,"TITLE OF",LR,0,C,1);
		$this->objRprt->Cell(50,$InterLigne,"INCLUSIVE DATE OF ATTENDANCE",LR,0,C,1);
		$this->objRprt->Cell(30,$InterLigne,"NUMBER OF",LR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"CONDUCTED/SPONSORED BY",LR,0,C,1);
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(70,$InterLigne,"SEMINAR/CONFERENCE/WORKSHOP",LR,0,C,1);
		$this->objRprt->Cell(50,$InterLigne,"(mm/dd/yyyy)",LR,0,C,1);
		$this->objRprt->Cell(30,$InterLigne,"HOURS",LR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"(Write in full)",LR,0,C,1);
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(70,$InterLigne,"(Write in full)",LBR,0,C,1);
		$this->objRprt->Cell(50,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->Cell(30,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C,1);
		$this->objRprt->Cell(25,$InterLigne,"From",LTBR,0,C,1);
		$this->objRprt->Cell(25,$InterLigne,"To",LTBR,0,C,1);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C,1);
		$this->objRprt->Ln(6);


		$objEmpTraining = mysql_query("SELECT tblEmpTraining.*, tblTraining.trainingCode, 
											tblTraining.trainingTitle
										FROM tblEmpTraining
										INNER JOIN tblTraining
											ON tblEmpTraining.trainingCode = tblTraining.trainingCode
										WHERE tblEmpTraining.empNumber = '".$_SESSION['sesEmpNum']."'
										ORDER BY trainingStartDate DESC, trainingEndDate DESC limit 0,15");
									
		$intTrainingCounter = 0;
		while ($arrEmpTraining = mysql_fetch_array($objEmpTraining))
		{
			$intTrainingCounter++;
			$strEmpNumberTraining = $arrEmpTraining['empNumber'];
			$strEmpTrainingCode = $arrEmpTraining['trainingCode'];
			$strEmpTrainingTitle = $arrEmpTraining['trainingTitle'];
			$dtmEmpTrainingContractDate = $arrEmpTraining['trainingContractDate'];
			$strEmpTrainingConductedBy = $arrEmpTraining['trainingConductedBy'];
			$strEmpTrainingVenue = $arrEmpTraining['trainingVenue'];
			$dtmEmpTrainingStartDate = $arrEmpTraining['trainingStartDate'];
			$dtmEmpTrainingEndDate = $arrEmpTraining['trainingEndDate'];
			$intEmpTrainingHours = $arrEmpTraining['trainingHours'];
			$intEmpTrainingCost = $arrEmpTraining['trainingCost'];
			
			if ($intTrainingCounter != 0 || $strEmpNumberTraining != NULL)
			{
				//  1.
				$this->objRprt->SetFont(Arial,B,6);
				$this->objRprt->Cell(70,$InterLigne,$strEmpTrainingTitle,LTBR,0,L);
				$this->objRprt->Cell(25,$InterLigne,$dtmEmpTrainingStartDate,LTBR,0,C);
				$this->objRprt->Cell(25,$InterLigne,$dtmEmpTrainingEndDate,LTBR,0,C);
				$this->objRprt->Cell(30,$InterLigne,$intEmpTrainingHours,LTBR,0,C);
				$this->objRprt->Cell(0,$InterLigne,$intEmpTrainingCost,LTBR,0,C);
				$this->objRprt->Ln(6);
			
			}
		}

		if ($strEmpTrainingTitle <= 5) {

		//  4.
		$this->objRprt->Cell(70,$InterLigne,"  --  Start this line is not-applicable  --  ",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  5.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  6.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  7.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  8.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  9.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  10.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  11.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  12.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  13.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  14.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  15.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  16.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  17.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  18.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  19.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  20.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  21.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  22.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		}  //  endif
		
		
		//  Training/Seminars - separate sheet
		$this->objRprt->SetFont('Arial','B',6);
		$this->objRprt->Cell(0,4,"(Continue on separate sheet, if necessary)",1,0,C);
		$this->objRprt->Ln(4);

		//  OTHER INFORMATION - Colors of frame, background and text
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->SetFillColor(200,200,200);
		$this->objRprt->Cell(0,$InterLigne,"VII. OTHER INFORMATION",1,0,L,1);
		$this->objRprt->Ln(6);
		
		//  special skills/recognition/organization
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"31.",LTR,0,L);
		$this->objRprt->Cell(80,$InterLigne,"32.",LTR,0,L);
		$this->objRprt->Cell(0,$InterLigne,"33.",LTR,0,L);
		$this->objRprt->Ln(3);
		
		$this->objRprt->Cell(70,$InterLigne,"SPECIAL SKILLS / HOBBIES",LR,0,C);
		$this->objRprt->Cell(80,$InterLigne,"NON-ACADEMIC DISTINCTIONS/RECOGNITION:",LR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"MEMBERSHIP IN",LR,0,C);
		$this->objRprt->Ln(3);
		
		$this->objRprt->Cell(70,$InterLigne,"",LR,0,C);
		$this->objRprt->Cell(80,$InterLigne,"(Write in full)",LR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"ASSOCIATION/ORGANIZATION",LR,0,C);
		$this->objRprt->Ln(3);
		$this->objRprt->Cell(70,$InterLigne,"",LBR,0,C);
		$this->objRprt->Cell(80,$InterLigne,"",LBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"(Write in full)",LBR,0,C);
		$this->objRprt->Ln(6);
		
		$objEmpSkills = mysql_query("SELECT skills, nadr, miao FROM tblEmpPersonal 
									WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
		
		$intEmpSkillsCounter = 0;
		while($arrEmpSkills = mysql_fetch_array($objEmpSkills))
		{
		
			$intEmpSkillsCounter++;
			$strEmpSkills = $arrEmpSkills['skills'];
			$strEmpNADR = $arrEmpSkills['nadr'];
			$strEmpMIAO = $arrEmpSkills['miao'];
			
			if ($intEmpSkillsCounter != 0) 
			{
			
				$this->objRprt->SetFont('Arial',B,6);
				$this->objRprt->Cell(70,5,$strEmpSkills,1,0,C);
				$this->objRprt->Cell(80,5,$strEmpNADR,1,0,C);
				$this->objRprt->Cell(0,5,$strEmpMIAO,1,0,C);
				$this->objRprt->Ln(5);
			
			}	//  end if
			
		}	//  end while

		if (($strEmpSkills <= 2) && ($strEmpNADR <= 2) && ($strEmpMIAO <= 2)) 
		{
		
		//  1.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(80,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  2.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(80,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  3.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(80,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  4.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(80,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);

		//  5.
		$this->objRprt->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(80,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->objRprt->Ln(6);
		}

		//  34.  other information
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->objRprt->Cell(0,$InterLigne,"",LTR,0,L);
		$this->objRprt->Ln(4);
		$this->objRprt->Cell(70,$InterLigne,"",LR,0,L,1);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"34.  Are  you   related  by   consanguinity  or   ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);


		$objEmpOtherInfo = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intOtherInfoCounter = 0;
		while ($arrEmpOtherInfo = mysql_fetch_array($objEmpOtherInfo))
		{
			$intOtherInfoCounter++;
			$strRelatedThird = $arrEmpOtherInfo['relatedThird'];
			$strAnswer = "x";

			
			if ($intOtherInfoCounter != 0) 
			{
				if($strRelatedThird == 'Y') 
				{
			
					$this->objRprt->Cell(0,$InterLigne,"a.  Within the third degree?       						   [" . $strAnswer  . "]	YES 				[  ]	NO",LR,0,C);
				} else {
					$this->objRprt->Cell(0,$InterLigne,"a.  Within the third degree?       						   []	YES 				[" . $strAnswer . "]	NO",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while
		
	
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	affinity   to   any   of  the    following:   ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->Cell(0,$InterLigne,"(for NATIONAL GOVERNMENT Employees)",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	appointing   authority,  recommending ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	authority,     chief    of     office/bureau/ ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);

		$objEmpRelatedForth = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpRelatedForthCounter = 0;
		while ($arrEmpRelatedForth = mysql_fetch_array($objEmpRelatedForth))
		{
			$intEmpRelatedForthCounter++;
			$strRelatedForth = $arrEmpRelatedForth['relatedFourth'];
			$strAnswerForth = "x";

			if ($intEmpRelatedForthCounter != 0) 
			{
				if($strRelatedForth == 'Y') 
				{
			
					$this->objRprt->Cell(0,$InterLigne,"b.  Within the  fourth  degree?       						   [" . $strAnswerForth  . "]	YES 				[  ]	NO",LR,0,C);
				} else {
					$this->objRprt->Cell(0,$InterLigne,"b.  Within the  fourth  degree?       						   []	YES 				[" . $strAnswerForth . "]	NO",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while


		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	department   or     person     who   has  ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->Cell(0,$InterLigne,"(for LOCAL Government Employees)            ",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	immediate   supervision  over  you  in  ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	the   Office,   Bureau   or   Deparment   ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, give particulars",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	where   you   will   be   appointed?        ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"",LR,0,C,1);


		$objEmpRelatedDegree = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpRelatedDegreeCounter = 0;
		while ($arrEmpRelatedDegree = mysql_fetch_array($objEmpRelatedDegree))
		{
			$intEmpRelatedDegreeCounter++;
			$strRelatedDegree = $arrEmpRelatedDegree['relatedDegreeParticulars'];

			if ($intEmpRelatedDegreeCounter != 0) 
			{
				if($strRelatedDegree != '') 
				{
			
					$this->objRprt->SetFont('Arial',I,9);
					$this->objRprt->Cell(0,$InterLigne,$strRelatedDegree,LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','B',10);
					$this->objRprt->Cell(0,$InterLigne,_________________________,LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while


		$this->objRprt->Ln(4);
		
		$this->objRprt->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LBR,0,C);
		$this->objRprt->Ln(35);

		//  35.  other information
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->objRprt->Cell(0,$InterLigne,"",LTR,0,L);
		$this->objRprt->Ln(4);
		$this->objRprt->Cell(70,$InterLigne,"",LR,0,L,1);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"35.  Have  you  ever  been  declared      ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);


		$objEmpAdminCase = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpAdminCaseCounter = 0;
		while ($arrEmpAdminCase = mysql_fetch_array($objEmpAdminCase))
		{
			$intEmpAdminCaseCounter++;
			$strAdminCase = $arrEmpAdminCase['adminCase'];
			$strAdminCaseParticulars = $arrEmpAdminCase['adminCaseParticulars'];
			$strAnswerAdminCase = "x";

			if ($intEmpAdminCaseCounter != 0) 
			{
				if($strAdminCase == 'Y') 
				{
			
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, give details of offense.       						   [" . $strAnswerAdminCase  . "]	YES 				[  ]	NO",LR,0,C);
				} else {
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, give details of offense.       						   [  ]	YES 				[" . $strAnswerAdminCase . "]	NO",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while



		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"    guilty  of any  administrative         ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	offense?                                        ",LR,0,C,1);
		
		
		$objEmpAdminCaseParticulars = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpAdminCaseParticularsCounter = 0;
		while ($arrEmpAdminCaseParticulars = mysql_fetch_array($objEmpAdminCaseParticulars))
		{
			$intEmpAdminCaseParticularsCounter++;
			$strAdminCaseParticulars = $arrEmpAdminCaseParticulars['adminCaseParticulars'];

			if ($intEmpAdminCaseParticularsCounter != 0) 
			{
				if($strAdminCaseParticulars != '') 
				{
			
					$this->objRprt->SetFont('Arial',I,9);
					$this->objRprt->Cell(0,$InterLigne,$strAdminCaseParticulars,LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','B',10);
					$this->objRprt->Cell(0,$InterLigne,"______________________________________________________",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while

		
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);
		
		$this->objRprt->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LBR,0,C);
		$this->objRprt->Ln(6);

		//  36.  other information
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->objRprt->Cell(0,$InterLigne,"",LTR,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"36.  Have you ever been convicted of     ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);

		$objEmpViolateLaw = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpViolateLawCounter = 0;
		while ($arrEmpViolateLaw = mysql_fetch_array($objEmpViolateLaw))
		{
			$intEmpViolateLawCounter++;
			$strViolateLaw = $arrEmpViolateLaw['violateLaw'];
			$strViolateLawParticulars = $arrEmpViolateLaw['violateLawParticulars'];
			$strAnswerViolateLaw = "x";

			
			if ($intEmpViolateLawCounter != 0) 
			{
				if($strViolateLaw == 'Y') 
				{
			
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, give details of offense.       						   [" . $strAnswerViolateLaw  . "]	YES 				[  ]	NO",LR,0,C);
				} else {
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, give details of offense.       						   []	YES 				[" . $strAnswerViolateLaw . "]	NO",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while


		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"  any crime or violation of any law,",LR,0,C,1);
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	decree, ordinance or regulations",LR,0,C,1);
		

		$objEmpViolateLawParticulars = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpViolateLawParticularsCounter = 0;
		while ($arrEmpViolateLawParticulars = mysql_fetch_array($objEmpViolateLawParticulars))
		{
			$intEmpViolateLawParticularsCounter++;
			$strViolateLawParticulars = $arrEmpViolateLawParticulars['violateLawParticulars'];

			if ($intEmpViolateLawParticularsCounter != 0) 
			{
				if($strViolateLawParticulars != '') 
				{
			
					$this->objRprt->SetFont('Arial',I,9);
					$this->objRprt->Cell(0,$InterLigne,$strViolateLawParticulars,LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','I',10);
					$this->objRprt->Cell(0,$InterLigne,"______________________________________________________",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while
		
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	by any court or tribunal.              ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);
		
		$this->objRprt->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LBR,0,C);
		$this->objRprt->Ln(6);

		//  37.  other information
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->objRprt->Cell(0,$InterLigne,"",LTR,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"37.  Have  you ever  been  forced to      ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);


		$objEmpForcedResign = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpForcedResignCounter = 0;
		while ($arrEmpForcedResign = mysql_fetch_array($objEmpForcedResign))
		{
			$intEmpForcedResignCounter++;
			$strForcedResign = $arrEmpForcedResign['forcedResign'];
			$strAnswerForcedResign = "x";

			
			if ($intEmpForcedResignCounter != 0) 
			{
				if($strForcedResign == 'Y') 
				{
			
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, give reasons.       						   [" . $strAnswerForcedResign  . "]	YES 				[  ]	NO",LR,0,C);
				} else {
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, give reasons.       						   []	YES 				[" . $strAnswerForcedResign . "]	NO",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while

		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"  retire/resign  or  dropped  from ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	employment  in  the  public or  ",LR,0,C,1);
		

		$objEmpForcedResignParticulars = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpForcedResignParticularsCounter = 0;
		while ($arrEmpForcedResignParticulars = mysql_fetch_array($objEmpForcedResignParticulars))
		{
			$intEmpForcedResignParticularsCounter++;
			$strForcedResignParticulars = $arrEmpForcedResignParticulars['forcedResignParticulars'];

			if ($intEmpForcedResignParticularsCounter != 0) 
			{
				if($strForcedResignParticulars != '') 
				{
			
					$this->objRprt->SetFont('Arial',I,9);
					$this->objRprt->Cell(0,$InterLigne,$strForcedResignParticulars,LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','I',10);
					$this->objRprt->Cell(0,$InterLigne,"______________________________________________________",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while
		
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	private    sector?                        ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);
		
		$this->objRprt->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LBR,0,C);
		$this->objRprt->Ln(6);

		//  38.  other information
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->objRprt->Cell(0,$InterLigne,"",LTR,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"38.  Have you ever been a candidate       ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);
		

		$objEmpCandidate = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpCandidateCounter = 0;
		while ($arrEmpCandidate = mysql_fetch_array($objEmpCandidate))
		{
			$intEmpCandidateCounter++;
			$strCandidate = $arrEmpCandidate['candidate'];
			$strAnswerCandidate = "x";

			
			if ($intEmpCandidateCounter != 0) 
			{
				if($strCandidate == 'Y') 
				{
			
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, give date of elections       						   [" . $strAnswerCandidate  . "]	YES 				[  ]	NO",LR,0,C);
				} else {
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, give date of elections       						   []	YES 				[" . $strAnswerCandidate . "]	NO",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while

		
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"  in a national or local election       ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(0,$InterLigne," and other particulars.                                                                       ",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	(except Barangay election)         ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"",LR,0,C,1);
		
		
		$objEmpCandidateParticulars = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpCandidateParticularsCounter = 0;
		while ($arrEmpCandidateParticulars = mysql_fetch_array($objEmpCandidateParticulars))
		{
			$intEmpCandidateParticularsCounter++;
			$strCandidateParticulars = $arrEmpCandidateParticulars['candidateParticulars'];

			if ($intEmpCandidateParticularsCounter != 0) 
			{
				if($strCandidateParticulars != '') 
				{
			
					$this->objRprt->SetFont('Arial',I,9);
					$this->objRprt->Cell(0,$InterLigne,$strCandidateParticulars,LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','B',10);
					$this->objRprt->Cell(0,$InterLigne,"______________________________________________________",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while
		
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);
		
		$this->objRprt->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->Cell(0,$InterLigne,"",LBR,0,C);
		$this->objRprt->Ln(6);

		//  39.  other information
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->objRprt->Cell(0,$InterLigne,"",LTR,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(70,$InterLigne,"39.  Pursuant  to  (a)  Indigenous              ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);
		

		$objEmpIndigenous = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpIndigenousCounter = 0;
		while ($arrEmpIndigenous = mysql_fetch_array($objEmpIndigenous))
		{
			$intEmpIndigenousCounter++;
			$strIndigenous = $arrEmpIndigenous['indigenous'];
			$strAnswerIndigenous = "x";

			
			if ($intEmpIndigenousCounter != 0) 
			{
				if($strIndigenous == 'Y') 
				{
			
					$this->objRprt->SetFont('Arial','B',10);
					$this->objRprt->Cell(0,$InterLigne,"a.  Are you a member of  any  indigenous group?   		[" . $strAnswerIndigenous  . "]	YES 		[  ]	NO",LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','B',10);
					$this->objRprt->Cell(0,$InterLigne,"a.  Are you a member of  any  indigenous group?     []	YES 		[" . $strAnswerIndigenous . "]	NO",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while

		
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"   People's Act (RA 8371);                   ",LR,0,C,1);
		
		
		$objEmpIndigenousParticulars = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpIndigenousParticularsCounter = 0;
		while ($arrEmpIndigenousParticulars = mysql_fetch_array($objEmpIndigenousParticulars))
		{
			$intEmpIndigenousParticularsCounter++;
			$strIndigenousParticulars = $arrEmpIndigenousParticulars['indigenousParticulars'];

			if ($intEmpIndigenousParticularsCounter != 0) 
			{
				if($strIndigenousParticulars != '') 
				{
			
					$this->objRprt->SetFont('Arial','B',9);
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, please specify				                      " . $strIndigenousParticulars,LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','B',9);
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, please specify				______________________",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while
		
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"(b) Magna Carta for Disabled       ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','I',9);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	Persons (RA 7277);   and  (c)        ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',10);


		$objEmpDisabled = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpDisabledCounter = 0;
		while ($arrEmpDisabled = mysql_fetch_array($objEmpDisabled))
		{
			$intEmpDisabledCounter++;
			$strDisabled = $arrEmpDisabled['disabled'];
			$strAnswerDisabled = "x";

			
			if ($intEmpDisabledCounter != 0) 
			{
				if($strDisabled == 'Y') 
				{
			
					$this->objRprt->SetFont('Arial','B',10);
					$this->objRprt->Cell(0,$InterLigne,"b.  Are    you    differently    abled?         						        [" . $strAnswerDisabled  . "]	YES    				[  ]	NO",LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','B',10);
					$this->objRprt->Cell(0,$InterLigne,"b.  Are    you    differently    abled?           						       []	YES    				[" . $strAnswerDisabled . "]	NO",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while


		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	 Solo Parents Welfare  Act of         ",LR,0,C,1);
		
		
		$objEmpDisabledParticulars = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpDisabledParticularsCounter = 0;
		while ($arrEmpDisabledParticulars = mysql_fetch_array($objEmpDisabledParticulars))
		{
			$intEmpDisabledParticularsCounter++;
			$strDisabledParticulars = $arrEmpDisabledParticulars['disabledParticulars'];

			if ($intEmpDisabledParticularsCounter != 0) 
			{
				if($strDisabledParticulars != '') 
				{
			
					$this->objRprt->SetFont('Arial','B',9);
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, please specify				                      ". $strDisabledParticulars,LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','B',9);
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, please specify				______________________",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while

		$this->objRprt->Ln(4);
		
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	 2000 (RA 8972); please                  ",LR,0,C,1);
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(0,$InterLigne,"",LR,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"	answer the following items:         ",LR,0,C,1);


		$objEmpSoloParent = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpSoloParentCounter = 0;
		while ($arrEmpSoloParent = mysql_fetch_array($objEmpSoloParent))
		{
			$intEmpSoloParentCounter++;
			$strSoloParent = $arrEmpSoloParent['soloParent'];
			$strAnswerSoloParent = "x";

			
			if ($intEmpSoloParentCounter != 0) 
			{
				if($strSoloParent == 'Y') 
				{
			
					$this->objRprt->SetFont('Arial','B',10);
					$this->objRprt->Cell(0,$InterLigne,"c.  Are    you    a   solo    parent?         						           [" . $strAnswerSoloParent  . "]	YES    				[  ]	NO",LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','B',10);
					$this->objRprt->Cell(0,$InterLigne,"c.  Are    you    a   solo    parent?             						       []	YES    				[" . $strAnswerSoloParent . "]	NO",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while


		$this->objRprt->Ln(4);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"",LR,0,C,1);
		
		
		$objEmpSoloParentParticulars = mysql_query("SELECT * FROM tblEmpPersonal
										WHERE empNumber = '".$_SESSION['sesEmpNum']."'");
										
		$intEmpSoloParentParticularsCounter = 0;
		while ($arrEmpSoloParentParticulars = mysql_fetch_array($objEmpSoloParentParticulars))
		{
			$intEmpSoloParentParticularsCounter++;
			$strSoloParentParticulars = $arrEmpSoloParentParticulars['soloParentParticulars'];

			if ($intEmpSoloParentParticularsCounter != 0) 
			{
				if($strSoloParentParticulars != '') 
				{
			
					$this->objRprt->SetFont('Arial','B',9);
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, please specify				                      ". $strSoloParentParticulars,LR,0,C);
				} else {
					$this->objRprt->SetFont('Arial','B',9);
					$this->objRprt->Cell(0,$InterLigne,"If your answer is YES, please specify				______________________",LR,0,C);
				}
				
			}  //  end if
		
		}	//  end while

		
		$this->objRprt->Ln(4);
		
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(0,$InterLigne,"",LBR,0,C);
		$this->objRprt->Ln(6);

		//  40.  References
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,"40.  REFERENCES(Persons not related by consanguinity or affinity to applicant / appointee)",1,0,L,1);
		$this->objRprt->Ln(6);
		//  name
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(70,$InterLigne,"NAME",LTBR,0,C,1);
		//  address
		$this->objRprt->Cell(70,$InterLigne,"Address",LTBR,0,C,1);
		//  telephone no.
		$this->objRprt->Cell(0,$InterLigne,"Telephone No.",LTBR,0,C,1);
		$this->objRprt->Ln(6);
		
		$objEmpReference = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpReference.refName,
										tblEmpReference.refAddress, tblEmpReference.refTelephone
									FROM tblEmpPersonal
									INNER JOIN tblEmpReference
										ON tblEmpPersonal.empNumber = tblEmpReference.empNumber 
									WHERE tblEmpPersonal.empNumber = '".$_SESSION['sesEmpNum']."'
										OR tblEmpPersonal.empNumber is null LIMIT 0,3");
		$intRefCounter = 0;
		while($arrEmpReference = mysql_fetch_array($objEmpReference))
		{
		
			$intRefCounter++;
			$strEmpRefNumber = $arrEmpReference['empNumber'];
			$strEmpRefName = $arrEmpReference['refName'];
			$strEmpRefAddress = $arrEmpReference['refAddress'];
			$intEmpRefTelephone = $arrEmpReference['refTelephone'];

			if ($intRefCounter != 0) 
			{

				//  reference count
				$this->objRprt->Cell(70,$InterLigne,$strEmpRefName,1,0,C);
				$this->objRprt->Cell(70,$InterLigne,$strEmpRefAddress,1,0,C);
				$this->objRprt->Cell(0,$InterLigne,$intEmpRefTelephone,1,0,C);
				$this->objRprt->Ln(6);

			}	//  end if
			
		}	//  end while
				
		if($strEmpRefNumber == NULL) 		//  if employee number is empty/not-applicable
		{
		
		//  reference blank
		$this->objRprt->Cell(70,$InterLigne,"Not-Applicable",1,0,C);
		$this->objRprt->Cell(70,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);
		
		$this->objRprt->Cell(70,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(70,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(70,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(70,$InterLigne,"",1,0,C);
		$this->objRprt->Cell(0,$InterLigne,"",1,0,C);
		$this->objRprt->Ln(6);

		}
		//  41. declaration to wit
		$txt = "41.   I declare under the penalties of perjury that this Personal Data Sheet has been accomplished in good faith, veriried by me and to the best";
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$txt,LTR,0,L,1);
		$this->objRprt->Ln(4);
		//  paragraph1
		$txt = "        of my  knowledge and belief is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations";
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L,1);
		$this->objRprt->Ln(4);
		// paragraph1
		$txt = "        of the Republic of the Philippines.    ";
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L,1);
		$this->objRprt->Ln(6);
		//  paragraph2
		$txt = "        I also authorize the agency head / authorized representative to verify / validate the contents stated herein. I trust that this information shall";
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L,1);
		$this->objRprt->Ln(4);
		//  paragraph2
		$txt = "        remain confidential.";
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(0,$InterLigne,$txt,LBR,0,L,1);
		$this->objRprt->Ln(4);
		
		//  SIGNATURE/DATE ACCOMPLISHED/TAX
		$this->objRprt->SetFont('Arial','I',10);
		$this->objRprt->Cell(3,$InterLigne,"",L,0);
		$this->objRprt->Cell(70,$InterLigne,"",0,0);			//  signature
		$this->objRprt->Cell(65,$InterLigne,"",0,0);			//  blank/space provided
		$this->objRprt->Cell(15,$InterLigne,"",0,0);			//  spaces
		$this->objRprt->Cell(35,10,"",0,0);					//  thumbmark
		$this->objRprt->Cell(0,$InterLigne,"",R,0);				
		$this->objRprt->Ln(6);
		$this->objRprt->SetFillColor(225,225,225);
		$this->objRprt->Cell(3,$InterLigne,"",L,0);
		$this->objRprt->Cell(70,$InterLigne,"Signature",1,0,R,1);
		$this->objRprt->Cell(65,$InterLigne,$t_strSignature,LTBR,0);
		$this->objRprt->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->objRprt->Cell(35,$InterLigne,"",0,0);			//  thumbmark
		$this->objRprt->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(3,$InterLigne,"",L,0);
		$this->objRprt->Cell(70,$InterLigne,"Date Accomplished",1,0,R,1);
		$this->objRprt->Cell(65,$InterLigne,$t_dtmDateAccomplished,LTBR,0);
		$this->objRprt->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->objRprt->Cell(35,$InterLigne,"",LTR,0);			//  thumbmark
		$this->objRprt->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(3,$InterLigne,"",L,0);
		$this->objRprt->Cell(70,$InterLigne,"",0,0);
		$this->objRprt->Cell(65,$InterLigne,"",0,0);
		$this->objRprt->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->objRprt->Cell(35,$InterLigne,"",LR,0);			//  thumbmark
		$this->objRprt->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(3,$InterLigne,"",L,0);
		$this->objRprt->Cell(70,$InterLigne,"Community Tax Certificate No.",1,0,R,1);
		$this->objRprt->Cell(65,$InterLigne,$t_strCTC,LTBR,0);
		$this->objRprt->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->objRprt->Cell(35,$InterLigne,"",LR,0);			//  thumbmark
		$this->objRprt->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(3,$InterLigne,"",L,0);
		$this->objRprt->Cell(70,$InterLigne,"Issued at",1,0,R,1);
		$this->objRprt->Cell(65,$InterLigne,$t_strIssuedAt,LTBR,0);
		$this->objRprt->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->objRprt->Cell(35,$InterLigne,"",LBR,0);			//  thumbmark
		$this->objRprt->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(3,$InterLigne,"",L,0);
		$this->objRprt->Cell(70,$InterLigne,"Issued on",1,0,R,1);
		$this->objRprt->Cell(65,$InterLigne,$t_dtmIssuedOn,LTBR,0);
		$this->objRprt->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(35,$InterLigne,"Right Thumbmark",0,0,C);			//  thumbmark
		$this->objRprt->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->objRprt->Ln(6);

		$this->objRprt->SetFont('Arial','B',8);
		$this->objRprt->Cell(3,$InterLigne,"",L,0);
		$this->objRprt->Cell(70,$InterLigne,"",0,0);			//  signature
		$this->objRprt->Cell(65,$InterLigne,"",0,0);			//  blank/space provided
		$this->objRprt->Cell(15,$InterLigne,"",0,0);			//  spaces
		$this->objRprt->Cell(35,10,"",0,0);					//  thumbmark
		$this->objRprt->Cell(0,$InterLigne,"",R,0);				
		$this->objRprt->Ln(4);

		// Footer
		//$this->objRprt->Rect(10,283,196,40,'D');   // Rect(10,H,W,40,'D')
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "*Solo Parent has defined in Section 3 of the Republic of the Philippines Act. No 8972 refers to any individual who falls under any of the following categories:
		";
		$this->objRprt->Cell(0,$InterLigne,$txt,LTR,0,L);
		$this->objRprt->Ln(3);
		// other paragraph
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "(a) A woman who gives birth as a result of rape and other crimes against chastity even without a final conviction of the offender.  Provide that the mother keeps and raises the child;";
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->objRprt->Ln(3);
		// other paragraph
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "(b) Parent left solo or alone with the responsibility of parenthood due to the dead of spouse;";
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->objRprt->Ln(3);
		// other paragraph
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "(c) Parent left solo or alone with the reponsibility of parenthood while the spouse is detained, or is serving sentence for a criminal conviction for at least one (1) year;
		";
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->objRprt->Ln(3);
		// other paragraph
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "(d) Parent left solo or alone with the responsibility of parenthood due to physical and/or mental incapacity of spouse as certified by a public medical practitioner;";
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->objRprt->Ln(3);
		// other paragraph
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "(e) Parent left solo or alone with the responsibility of parenthood due to legal separation from spouse for at least one (1) year as long as he/shee is entrusted with the custody of the children;";
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->objRprt->Ln(3);
		// other paragraph
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "(f) Parent left solo or alone with the responsibility of parenthood due to declaration of nullity or annulment of marriage as decreed by a court or by the church as long as he/shee is entrusted";
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->objRprt->Ln(3);
		// other paragraph
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "     with the custody of the children;";
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->objRprt->Ln(3);
		// other paragraph
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "(g) Parent left solo or alone with the responsibility of parenthood due to abandonment of spouse for at least one (1) year;";
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->objRprt->Ln(3);
		// other paragraph
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "(h) Parent left solo or alone with the responsibility of parenthood due to unmarried mother/father who has preferred to keep and rear her/his child/children instead of having others care for";
		$this->objRprt->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->objRprt->Ln(3);
		// other paragraph
		$this->objRprt->SetFont('Arial','B',6);
		$txt = "     them or give them up to a welface institution.";
		$this->objRprt->Cell(0,$InterLigne,$txt,LBR,0,L);
		$this->objRprt->Ln(6);
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportEmpPersonalData;
		
		$this->objRprt->SetLeftMargin(10);
		$this->objRprt->SetRightMargin(10);
		$this->objRprt->SetTopMargin(10);
		$this->objRprt->SetAutoPageBreak("on",30);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
	
		$objEmpTrainingData = mysql_query("SELECT tblEmpTraining.*, tblEmpPersonal.empNumber FROM tblEmpPersonal
											INNER JOIN tblEmpTraining
												ON tblEmpPersonal.empNumber = tblEmpTraining.empNumber
											WHERE tblEmpPersonal.empNumber = '" . $_SESSION['sesEmpNum'] . "' ");
		
		$arrEmpTrainingData = mysql_fetch_array($objEmpTrainingData);
		
		
	
		$objEmpData = mysql_query("SELECT tblEmpPersonal.*, tblEmpPosition.*, 
										 tblEmpExam.*, tblEmpReference.*, 
										 tblEmpSchool.*, tblServiceRecord.*
								   FROM tblEmpPersonal
								   INNER JOIN tblEmpPicture
								   		ON tblEmpPersonal.empNumber = tblEmpPicture.empNumber
								   INNER JOIN tblEmpPosition
								   		ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								   INNER JOIN tblEmpReference
								   		ON tblEmpPersonal.empNumber = tblEmpReference.empNumber
								   INNER JOIN tblEmpSchool
								   		ON tblEmpPersonal.empNumber = tblEmpSchool.empNumber
								   INNER JOIN tblEmpExam
								   		ON tblEmpPersonal.empNumber = tblEmpExam.empNumber
								   INNER JOIN tblServiceRecord
								   		ON tblEmpPersonal.empNumber = tblServiceRecord.empNumber
								   WHERE tblEmpPersonal.empNumber = '" . $_SESSION['sesEmpNum'] . "'
								   ORDER BY tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc,
								   		tblEmpPersonal.middlename asc");

		$intCounter =0;						   
		while($arrEmpData = mysql_fetch_array($objEmpData))
		{
			//  tblEmpPersonal
			$strEmpNumber = $arrEmpData['empNumber'];
			$strStatusOfAppointment = $arrEmpData['statusOfAppointment'];
			$strMidName = $arrEmpData['middlename'];
			$strMiddleName = substr($strMidName, 0,1);
			$strSurname = $arrEmpData['surname'];
			$strFirstname = $arrEmpData['firstname'];
			$strMiddlename = $arrEmpData['middlename'];
			$strBirthDay = $arrEmpData['birthday'];
			$strBirthPlace = $arrEmpData['birthPlace'];
			$Residential = $arrEmpData['residentialAddress'];
			$strResidential = substr($Residential,0,56);
			$extResidential = substr($Residential,56);
			$intZipCode1 = $arrEmpData['zipCode1'];
			$intTelephone1 = $arrEmpData['telephone1'];
			$Permanent = $arrEmpData['permanentAddress'];
			$strPermanent = substr($Permanent,0,56);
			$extPermanent = substr($Permanent,56);
			$intZipCode2 = $arrEmpData['zipCode2'];
			$intTelephone2 = $arrEmpData['telephone2'];
			$strCitizenship = $arrEmpData['citizenship'];
			$intHeight = $arrEmpData['height'];
			$intWeight = $arrEmpData['weight'];
			$strBloodType = $arrEmpData['bloodType'];
			$strGSISNumber = $arrEmpData['gsisNumber'];
			$intPhilHealthNumber = $arrEmpData['philHealthNumber'];
			$intPagibigNumber = $arrEmpData['pagibigNumber'];
			$intTin = $arrEmpData['tin'];
			$strEmail = $arrEmpData['email'];
			$intMobile = $arrEmpData['mobile'];
			$strSpouse = $arrEmpData['spouse'];
			$strSpouseWork = $arrEmpData['spouseWork'];
			$strSpouseBusName = $arrEmpData['spouseBusName'];
			$strSpouseBusAddress = $arrEmpData['spouseBusAddress'];
			$intSpouseTelephone = $arrEmpData['spouseTelephone'];
			$strChildName = $arrEmpData['childName'];
			$dtmChildBirthDate = $arrEmpData['childBirthDate'];
			$strFatherName = $arrEmpData['fatherName'];
			$strMotherName = $arrEmpData['motherName'];
			$strParentAddress = $arrEmpData['parentAddress'];
			$strSkills = $arrEmpData['skills'];
			$strNADR= $arrEmpData['nadr'];
			$strMIAO= $arrEmpData['miao'];
			$strRelatedThird = $arrEmpData['relatedThird'];
			$strRelatedFourth = $arrEmpData['relatedFourth'];
			$strRelatedDegreeParticulars = $arrEmpData['relatedDegreeParticulars'];
			$strAdminCase = $arrEmpData['adminCase'];
			$strAdminCaseParticulars = $arrEmpData['adminCaseParticulars'];
			$strViolateLaw = $arrEmpData['violateLaw'];
			$strViolateLawParticulars = $arrEmpData['violateLawParticulars'];
			$strForcedResign = $arrEmpData['forcedResign'];
			$strForcedResignParticulars = $arrEmpData['forcedResignParticulars'];
			$strCandidate = $arrEmpData['candidate'];
			$strCandidateParticulars = $arrEmpData['candidateParticulars'];
			$strIndigenous = $arrEmpData['indigenous'];
			$strIndigenousParticulars = $arrEmpData['indigenousParticulars'];
			$strSoloParent = $arrEmpData['soloParent'];
			$strSoloParentParticulars = $arrEmpData['soloParentParticulars'];			
			$strSignature = $arrEmpData['signature'];
			$dtmDateAccomplished = $arrEmpData['dateAccomplished'];
			$strCTC = $arrEmpData['comTaxNumber'];
			$strIssuedAt = $arrEmpData['issuedAt'];
			$dtmIssuedOn = $arrEmpData['issuedOn'];
			//  tblEmpSchool
			$strLevelCode = $arrEmpData['levelCode'];
			$strSchoolName = $arrEmpData['schoolName'];
			$strCourse = $arrEmpData['course'];
			$intUnits = $arrEmpData['units'];
			$dtmSchoolFromDate = $arrEmpData['schoolFromDate'];
			$dtmSchoolToDate = $arrEmpData['schoolToDate'];
			$strHonors = $arrEmpData['honors'];
			//  tblEmpExam
			$strExamCode = $arrEmpData['examCode'];
			$dtmExamDate = $arrEmpData['examDate'];
			$intExamRating = $arrEmpData['examRating'];
			$strExamPlace = $arrEmpData['examPlace'];
			$strLicenseNumber = $arrEmpData['licenseNumber'];
			$dtmDateRelease = $arrEmpData['dateRelease'];
			//  tblServiceRecord
			$dtmServiceFromDate = $arrEmpData['serviceFromDate'];
			$dtmServiceToDate = $arrEmpData['serviceToDate'];
			$strPositionCode = $arrEmpData['positionCode'];
			$intSalary = $arrEmpData['salary'];
			$strStationAgency = $arrEmpData['stationAgency'];
			$strAppointmentCode = $arrEmpData['appointmentCode'];
			$strSeparationCause = $arrEmpData['separationCause'];
			$dtmSeparationDate = $arrEmpData['separationDate'];
			//  tblEmpVoluntaryWork
			$strVWName = $arrEmpData['vwName'];
			$strVWAddress = $arrEmpData['vwAddress'];
			$dtmVWDateFrom = $arrEmpData['vwDateFrom'];
			$dtmVWDateTo = $arrEmpData['vwDateTo'];
			$intVWHours = $arrEmpData['vwHours'];
			$strVWPosition = $arrEmpData['vwPosition'];
			//  tblEmpTraining
			$strTrainingCode = $arrEmpTrainingData['trainingCode'];
			$dtmTrainingContractDate = $arrEmpTrainingData['trainingContractDate'];
			$strTrainingConductedBy = $arrEmpTrainingData['trainingConductedBy'];
			$strTrainingVenue = $arrEmpTrainingData['trainingVenue'];
			$dtmTrainingStartDate = $arrEmpTrainingData['trainingStartDate'];
			$dtmTrainingEndDate = $arrEmpTrainingData['trainingEndDate'];
			$intTrainingHours = $arrEmpTrainingData['trainingHours'];
			$intTrainingCost = $arrEmpTrainingData['trainingCost'];
			//  tblEmpReference
			$strRefName = $arrEmpData['refName'];
			$strRefAddress = $arrEmpData['refAddress'];
			$intRefTelephone = $arrEmpData['refTelephone'];
			//  current date			
			$curDateYr = date("Y");
			$curDateMonth = date("m");
			$curDateDay = date("d");
			
			
			if($strStatusOfAppointment == 'In-Service')
			{
			
				$this->printBody($strEmpNumber, $strSurname, $strFirstname, $strMiddlename, $strBirthDay, $strBirthPlace, $strResidential, $extResidential, $intZipCode1, $intTelephone1, $strPermanent, $extPermanent, $intZipCode2, $intTelephone2, $strCitizenship, $intHeight, $intWeight, $strBloodType, $strGSISNumber, $intPhilHealthNumber, $intPagibigNumber, $intTin, $strEmail, $intMobile, $strSpouse, $strSpouseWork, $strSpouseBusName, $strSpouseBusAddress, $intSpouseTelephone, $strChildName, $dtmChildBirthDate, $strFatherName, $strMotherName, $strParentAddress, $strSkills, $strNADR, $strMIAO, $strRelatedThird, $strRelatedFourth, $strRelatedDegreeParticulars, $strAdminCase, $strAdminCaseParticulars, $strViolateLaw, $strViolateLawParticulars, $strForcedResign, $strForcedResignParticulars, $strCandidate, $strCandidateParticulars, $strIndigenous, $strIndigenousParticulars, $strSoloParent, $strSoloParentParticulars, $strSignature, $dtmDateAccomplished, $strCTC, $strIssuedAt, $dtmIssuedOn, $strLevelCode, $strSchoolName, $strCourse, $intUnits, $dtmSchoolFromDate, $dtmSchoolToDate, $strHonors, $strExamCode, $dtmExamDate, $intExamRating, $strExamPlace, $strLicenseNumber, $dtmDateRelease, $dtmServiceFromDate, $dtmServiceToDate, $strPositionCode, $intSalary, $strStationAgency, $strAppointmentCode, $strSeparationCause, $dtmSeparationDate, $strVWName, $strVWAddress, $dtmVWDateFrom, $dtmVWDateTo, $intVWHours, $strVWPosition, $strTrainingCode, $dtmTrainingContractDate, $strTrainingConductedBy, $strTrainingVenue, $dtmTrainingStartDate, $dtmTrainingEndDate, $intTrainingHours, $intTrainingCost, $strRefName, $strRefAddress, $intRefTelephone);
							
			}
		
		$this->objRprt->Output();

		}

	}
	
}   //  end of class
?>