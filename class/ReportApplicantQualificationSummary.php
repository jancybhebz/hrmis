<?
/* 
File Name: ReportApplicantQualificationSummary.php (class folder)
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
Date of Revision: May 24, 2004
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
session_cache_limiter('private_no_expire'); 
include("../hrmis/class/General.php");
include("../hrmis/class/Connect.php");
define('FPDF_FONTPATH','../hrmis/class/font/');
require('../hrmis/class/fpdf.php');


class ReportApplicantQualificationSummary extends FPDF
{

	var $objRAQS;
	
	//  Header
	function Header()
	{
		$this->SetFont(Arial,'',12);
		$this->Cell(0,6,"DEPARTMENT OF SCIENCE AND TECHNOLOGY",0,0,C);
		$this->Ln(5);
		$this->SetFont(Arial,'B',14);
		$this->Cell(0,6,"SCIENCE AND TECHNOLOGY INFORMATION INSTITUTE",0,0,C);
		$this->Ln(5);
		$this->SetFont(Arial,'',12);
		$this->Cell(0,6,"SUMMARY OF APPLICANTS QUALIFICATIONS",0,0,C);
		$this->Ln(10);
		$this->SetFont(Arial,'',10);
		$this->Cell(0,6,"Applicants for  : " . $this->objRAQS->strPositionDesc,0,0,L);
		$this->Cell(0,6,"Qualifications Standards : " .this->objRAQS->strMA,0,0,R);
		$this->Ln(5);
		$this->Cell(0,6,"Item No. : " . $this->objRAQS->strItemNumber,0,0,L);
		$this->Ln(5);
		$this->Cell(0,6,"Salary Grade : " . $this->objRAQS->strSalaryGradeNumber,0,0,L);
		$this->Ln(5);
		$this->Cell(0,6,"Salary / Annum : " . $this->objRAQS->strAuthorizeSalaryYear,0,0,L);
		$this->Ln(10);
		
		//  Sub-Title
		$this->SetFont(Arial,B,10);
		$this->Cell(0,6,"NAME OF CANDIDATE",1,0,L);
		$this->Cell(0,6,"AGE",1,0,L);
		$this->Cell(0,6,"PRESENT POSITION",1,0,L);
		$this->Cell(0,6,"STATUS AND SALARY",1,0,L);
		$this->Cell(0,6,"EDUCATIONAL ATTAINMENT",1,0,L);
		$this->Cell(0,6,"CIVIL SERVICE ELIGIBILITY",1,0,L);
		$this->Cell(0,6,"PERFORMANCE RATING FOR THE LAST RATING PERIOD",1,0,L);
		$this->Cell(0,6,"RELEVANT EXPERIENCE",1,0,L);
		$this->Cell(0,6,"RELEVANT TRAININGS/SEMINARS",1,0,L);
		$this->Cell(0,6,"HONORS/AWARDS/SPECIAL SKILLS",1,0,L);
		$this->Ln(8);
	}
	
	//  Body
	function printPreview()
	{
		$this->SetFont(Arial,B,8);
		$this->Cell(0,6,"CATORCE, EDGARDO S.",1,0,L);                   //  NAME
		$this->Cell(0,6,"24",1,0,L);									//  AGE
		$this->Cell(0,6,"SRS-I",1,0,L);									//  Present Position
		$this->Cell(0,6,"PERMANENT  12,500.00 ",1,0,L);					//  Status and Salary
		$this->Cell(0,6,"B.S. Computer Science",1,0,L);					//  Educational Attainment
		$this->Cell(0,6,"CS Professional",1,0,L);						//  Civil Service Eligibility
		$this->Cell(0,6,"Excelent",1,0,L);								//  Performance Rating
		$this->Cell(0,6,"Master's Degree",1,0,L);						//  Relevant Experience
		$this->Cell(0,6,"Trainings/Seminars",1,0,L);					//  Relevant Trainings/Seminars
		$this->Cell(0,6,"Cum Laude",1,0,L);								//  Honors/Awards/Special Skills
		$this->Ln(5);
	}
	
}   //  End Class