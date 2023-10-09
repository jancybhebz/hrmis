<?
/* 
File Name: PrintPersonalPDSForm.php
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
Date of Revision: June 14, 2004
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

session_cache_limiter('private_no_expire'); 
//require('../hrmis/PersonalPDSForm.php');
define('FPDF_FONTPATH','../hrmis/class/font/');
require('../hrmis/class/fpdf.php');

class Profile extends FPDF
{

	function PersonalDataSheet()
	{
		$InterLigne = 6;
		$Ligne = 45;

		//  start here PERSONAL DATA SHEET
		$this->SetFont('Arial','',7);
		$this->Cell(5,$InterLigne,"CS Form 212 (Revised 2003)",LT,0,L);
		$this->Cell($Ligne,$InterLigne,"",T,0,L);
		$this->Cell(95,$InterLigne,"",T,0,C);
		$this->Cell(15,$InterLigne,"",T,0,L);
		$this->Cell(30,$InterLigne,"",T,0,L);
		$this->Cell(0,$InterLigne,"",TR,0,L);
		$this->Ln(4);

		$this->Cell(5,$InterLigne,"",L,0,L);
		$this->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->SetFont('Arial','B',20);
		$this->Cell(95,$InterLigne,"",0,0,C);
		$this->Cell(15,$InterLigne,"",0,0,L);
		$this->SetFont('Arial','',6);
		$this->Cell(30,$InterLigne,"",LTR,0,C);
		$this->Cell(0,$InterLigne,"",R,0,L);
		$this->Ln(4);

		$this->Cell(5,$InterLigne,"",L,0,L);
		$this->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->SetFont('Arial','B',20);
		$this->Cell(95,$InterLigne,"",0,0,C);
		$this->Cell(15,$InterLigne,"",0,0,L);
		$this->SetFont('Arial','',6);
		$this->Cell(30,$InterLigne,"not older than 6 mos.",LR,0,C);
		$this->Cell(0,$InterLigne,"",R,0,L);
		$this->Ln(4);

		$this->Cell(5,$InterLigne,"",L,0,L);
		$this->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->SetFont('Arial','B',20);
		$this->Cell(95,$InterLigne,"PERSONAL DATA SHEET",0,0,C);
		$this->Cell(15,$InterLigne,"",0,0,L);
		$this->SetFont('Arial','',6);
		$this->Cell(30,$InterLigne,"3.5 cm. X 4.5 cm.",LR,0,C);
		$this->Cell(0,$InterLigne,"",R,0,L);
		$this->Ln(4);

		$this->Cell(5,$InterLigne,"",L,0,L);
		$this->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->Cell(95,$InterLigne,"",0,0,C);
		$this->Cell(15,$InterLigne,"",0,0,L);
		$this->SetFont('Arial','',6);
		$this->Cell(30,$InterLigne,"(passport size)",LR,0,C);
		$this->Cell(0,$InterLigne,"",R,0,L);
		$this->Ln(4);

		$this->Cell(5,$InterLigne,"",L,0,L);
		$this->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->SetFont('Arial','B',20);
		$this->Cell(95,$InterLigne,"",0,0,C);
		$this->Cell(15,$InterLigne,"",0,0,L);
		$this->SetFont('Arial','',6);
		$this->Cell(30,$InterLigne,"",LBR,0,C);
		$this->Cell(0,$InterLigne,"",R,0,L);
		$this->Ln(4);

		$this->SetFont('Arial','',7);
		$this->Cell(5,$InterLigne,"Print legibly. Mark approriate boxed",L,0,L);
		$this->Cell($Ligne,$InterLigne,"",0,0,L);
		$this->Cell(95,$InterLigne,"",0,0,C);
		$this->Cell(15,$InterLigne,"",0,0,L);
		$this->Cell(30,$InterLigne,"",0,0,L);
		$this->Cell(0,$InterLigne,"",R,0,L);
		$this->Ln(6);

		//  PERSONAL INFORMATION - Colors of frame, background and text
		$this->SetFont('Arial','I',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(0,$InterLigne,"I. PERSONAL INFORMATION",1,0,L,1);
		$this->Ln(6);

		//  surname
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"1.     SURNAME ",LTR,0,L);

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);
		
		//  firstname
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"        FIRST NAME ",LR,0,L);

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//   middle name
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"        MIDDLE NAME ",LR,0,L);

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//  Date of Birth
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"2.     DATE OF BIRTH ",LTBR,0,L);

		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"",1,0,R);

		//  Residential
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"13.    RESIDENTIAL                   ",LTR,0,L);

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,R);
		$this->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->Ln(6);

		//  Place of Birth
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"3.     PLACE OF BIRTH ",LTBR,0,L);

		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"",1,0,R);

		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"",LR,0,C);

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,R);
		$this->Ln(6);
		//  Sex
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"4.     SEX ",LTBR,0,L);

		$this->Cell($Ligne,$InterLigne,"[]   Male     []   Female",1,0,C);

		$this->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->Cell(0,$InterLigne,"",R,0);
		$this->Ln(6);
		
		//  civil status
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"5.     CIVIL STATUS ",LR,0);
		$this->Cell($Ligne,$InterLigne,"   []  Single   []  Widowed",R,0,C);
		$this->Cell($Ligne,$InterLigne,"        ZIP CODE                            ",R,0,L);
		$this->Cell(0,$InterLigne,"",TBR,0);
		$this->Ln(6);

		$this->Cell($Ligne,$InterLigne,"",LR,0,C);		//  Civil Status Blank

		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"     []  Married  []  Separated",R,0,C);

		$this->Cell($Ligne,$InterLigne,"14.    TELEPHONE NO                   ",LBR,0);

		$this->Cell(0,$InterLigne,"",R,0);
		$this->Ln(6);

		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);		//  Civil Status Blank

		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"",R,0,C);

		$this->Cell($Ligne,$InterLigne,"15.   PERMANENT",LR,0);

		$this->Cell(0,$InterLigne,"",1,0);
		$this->Ln(6);
		
		//  citizenship
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"6.     CITIZENSHIP ",LTR,0);
		$this->Cell($Ligne,$InterLigne,"",LTR,0);
		$this->Cell($Ligne,$InterLigne,"",LR,0);
		$this->Cell(0,$InterLigne,"",1,0);
		$this->Ln(6);
		//  height
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"7.     HEIGHT (m) ",LTR,0);
		$this->Cell($Ligne,$InterLigne,"",LTR,0);
		$this->Cell($Ligne,$InterLigne,"        ZIP CODE                            ",R,0,L);
		$this->Cell(0,$InterLigne,"",1,0);
		$this->Ln(6);

		//Text color in gray
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"8.     WEIGHT (kg) ",1,0,'LR');

		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"",1,0,'R');

		//  AGENCY EMPLOYEE NO.
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"16.    TELEPHONE NO.  ",1,0,'L');

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//Text color in gray
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"9.     BLOOD TYPE ",1,0,'LR');

		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"",1,0,'R');

		//  AGENCY EMPLOYEE NO.
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"17.    E-MAIL ADDRESS (if any)  ",1,0,'L');

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//Text color in gray
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"10.   GSIS POLICY NO. ",1,0,'LR');

		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"",1,0,'R');

		//  AGENCY EMPLOYEE NO.
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"18.    CELLPHONE NO. (if any)   ",1,0,'L');

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//Text color in gray
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"11.   PAG-IBIG ID NO. ",1,0,'LR');

		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"",1,0,'R');

		//  AGENCY EMPLOYEE NO.
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"19.    AGENCY EMPLOYEE NO.  ",1,0,'L');

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//   PHILHEALTH NO.
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"12.   PHILHEALTH NO. ",1,0,'LR');

		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"",1,0,'R');

		//  TIN
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"20.    TIN                                       ",1,0,'L');

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//   FAMILY BACKGROUND
		$this->SetFont('Arial','I',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(0,$InterLigne,"II. FAMILY BACKGROUND",1,0,L,1);
		$this->Ln(6);

		//  name of spouse
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"21.   NAME OF SPOUSE",LBR,0);

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//  occupation
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"        OCCUPATION",LR,0);

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",R,0);
		$this->Ln(6);

		//  employer/bus.name
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"        EMPLOYER/BUS. NAME ",1,0,'LR');

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//  business address
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"        BUSINESS ADDRESS ",1,0,'LR');

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//  telephone no.
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"        TELEPHONE NO. ",1,0,'LR');

		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//  name of birth
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"22.   NAME OF CHILDREN",LT,0);
		$this->Cell($Ligne,$InterLigne,"Date of Birth (mm/dd/yyyy)",BR,0,C);
		$this->Cell($Ligne,$InterLigne,"NAME OF CHILDREN",LT,0);
		$this->Cell(0,$InterLigne,"Date of Birth (mm/dd/yyyy)",BR,C);
		$this->Ln(6);

		//  first line
		$this->Cell($Ligne,$InterLigne,"",LT,0);
		$this->Cell($Ligne,$InterLigne,"",BR,C);
		$this->Cell($Ligne,$InterLigne,"",LT,0);
		$this->Cell(0,$InterLigne,"",BR,C);
		$this->Ln(6);

		//  second line
		$this->Cell($Ligne,$InterLigne,"",LT,0);
		$this->Cell($Ligne,$InterLigne,"",BR,C);
		$this->Cell($Ligne,$InterLigne,"",LT,0);
		$this->Cell(0,$InterLigne,"",BR,C);
		$this->Ln(6);

		//  third line
		$this->Cell($Ligne,$InterLigne,"",LT,0);
		$this->Cell($Ligne,$InterLigne,"",BR,C);
		$this->Cell($Ligne,$InterLigne,"",LT,0);
		$this->Cell(0,$InterLigne,"",BR,C);
		$this->Ln(6);

		//  fourth line
		$this->Cell($Ligne,$InterLigne,"",LT,0);
		$this->Cell($Ligne,$InterLigne,"",BR,C);
		$this->Cell($Ligne,$InterLigne,"",LT,0);
		$this->Cell(0,$InterLigne,"",BR,C);
		$this->Ln(6);

		//  name of father
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"23.   NAME OF FATHER ",1,0,'LR');

		//  full maiden name of mother
		$this->Cell($Ligne,$InterLigne,"",1,0,'R');
		$this->Cell(55,$InterLigne,"24.   FULL MAIDEN NAME OF MOTHER",1,0,LT);
		$this->Cell(0,$InterLigne,"",1,C);
		$this->Ln(6);

		//  parent address
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"25.   PARENT ADDRESS ",1,0,'LR');

		$this->Cell(0,$InterLigne,"",1,0,'R');
		$this->Ln(6);

		//  EDUCATIONAL BACKGROUND
		$this->SetFont('Arial','I',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(0,$InterLigne,"III. EDUCATIONAL BACKGROUND",1,0,'L',1);
		$this->Ln(6);

		//  level
		$this->SetFont('Arial','B',8);
		$this->Cell($Ligne,$InterLigne,"26.",LTR,0,L);
		$this->Cell($Ligne,$InterLigne,"",LTR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LTR,0,C);
		$this->Cell(22,$InterLigne,"Highest Grade/",LTR,0,C);
		$this->Cell(22,$InterLigne,"INCLUSIVE",LTR,0,C);
		$this->Cell(0,$InterLigne,"ACADEMIC",LTR,0,C);
		$this->Ln(3);
		$this->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->Cell($Ligne,$InterLigne,"Name of School",LR,0,C);
		$this->Cell($Ligne,$InterLigne,"DEGREE / COURSE",LR,0,C);
		$this->Cell(22,$InterLigne,"Level/",LR,0,C);
		$this->Cell(22,$InterLigne,"DATES OF",LR,0,C);
		$this->Cell(0,$InterLigne,"HONORS",LR,0,C);
		$this->Ln(3);
		$this->Cell($Ligne,$InterLigne,"LEVEL",LR,0,C);
		$this->Cell($Ligne,$InterLigne,"(Write in full)",LR,0,C);
		$this->Cell($Ligne,$InterLigne,"(Write in full)",LR,0,C);
		$this->Cell(22,$InterLigne,"Units Earned",LR,0,C);
		$this->Cell(22,$InterLigne,"ATTENDANCE",LR,0,C);
		$this->Cell(0,$InterLigne,"RECEIVED",LR,0,C);
		$this->Ln(3);
		$this->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LR,0,C);
		$this->Cell(22,$InterLigne,"(If not",LR,0,C);
		$this->Cell(22,$InterLigne,"",LR,0,C);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(3);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"graduate)",LBR,0,C);
		$this->Cell(11,$InterLigne,"FROM",LTBR,0,C);
		$this->Cell(11,$InterLigne,"TO",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  elementary
		$this->Cell($Ligne,$InterLigne,"ELEMENTARY",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"",LBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  secondary
		$this->Cell($Ligne,$InterLigne,"SECONDARY",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"",LBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  vocational/trade course
		$this->Cell($Ligne,$InterLigne,"VOCATIONAL",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"",LBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  trade course
		$this->Cell($Ligne,$InterLigne,"TRADE COURSE",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"",LBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  tertiary
		$this->Cell($Ligne,$InterLigne,"TERTIARY",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"",LBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  graduate studies
		$this->Cell($Ligne,$InterLigne,"GRADUATE STUDIES",LR,0,L);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"",LBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);
		
		//  Diploma
		$this->Cell($Ligne,$InterLigne,"        - Diploma",LR,0,L);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"",LBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  Master's
		$this->Cell($Ligne,$InterLigne,"        - Master's",LR,0,L);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"",LBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);
		
		//  Doctorate
		$this->Cell($Ligne,$InterLigne,"        - Doctorate",LR,0,L);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"",LBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);
		//  non-degree course
		$this->Cell($Ligne,$InterLigne,"NON-DEGREE COURSE*",LR,0,L);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell($Ligne,$InterLigne,"",LBR,0,C);
		$this->Cell(22,$InterLigne,"",LBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(11,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);
		
		$this->SetFont('Arial','B',7);
		$this->Cell(0,5,"*(COURSE TAKEN FROM Tertiary education but not classified as Graduate Studies)",LR,0,C);
		$this->Ln(4);
		$this->SetFont('Arial','B',6);
		$this->Cell(0,4,"(Continue on Separate sheet if necessary)",1,0,C);
		$this->Ln(31);

		//  CIVIL SERVICE ELIGIBILITY
		$this->SetFont('Arial','I',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(0,$InterLigne,"IV. CIVIL SERVICE ELIGIBILITY",1,0,'L',1);
		$this->Ln(6);
		
		//  career service/RA 1080(board/bar)
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(225,225,225);
		$this->Cell(65,$InterLigne,"27.    CAREER SERVICE/RA 1080(BOARD/BAR)",LTR,0,L,1);
		$this->Cell(20,$InterLigne,"",LTR,0,C,1);
		$this->Cell(30,$InterLigne,"Date of",LTR,0,C,1);
		$this->Cell(35,$InterLigne,"",LTR,0,C,1);
		$this->Cell(0,$InterLigne,"LICENSE (if applicable)",LTBR,0,C,1);
		$this->Ln(4);
		
		$this->Cell(65,$InterLigne,"UNDER SPECIAL LAWS/CES/CSEE",LR,0,L,1);
		$this->Cell(20,$InterLigne,"RATING",LR,0,C,1);
		$this->Cell(30,$InterLigne,"Examination/",LR,0,C,1);
		$this->Cell(35,$InterLigne,"Place of Examination/",LR,0,C,1);
		$this->Cell(20,$InterLigne,"Number",LTBR,0,C,1);
		$this->Cell(0,$InterLigne,"Date of",LTR,0,C,1);
		$this->Ln(4);

		$this->Cell(65,$InterLigne,"",LBR,0,L,1);
		$this->Cell(20,$InterLigne,"",LBR,0,C,1);
		$this->Cell(30,$InterLigne,"Conferment",LBR,0,C,1);
		$this->Cell(35,$InterLigne,"Conferment",LBR,0,C,1);
		$this->Cell(20,$InterLigne,"",LBR,0,C,1);
		$this->Cell(0,$InterLigne,"Release",LBR,0,C,1);
		$this->Ln(6);

		//  first line
		$this->Cell(65,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(30,$InterLigne,"",LTBR,0,L);
		$this->Cell(35,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(0,$InterLigne,"",LTBR,0,L);
		$this->Ln(6);

		//  second line
		$this->Cell(65,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(30,$InterLigne,"",LTBR,0,L);
		$this->Cell(35,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(0,$InterLigne,"",LTBR,0,L);
		$this->Ln(6);

		//  third line
		$this->Cell(65,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(30,$InterLigne,"",LTBR,0,L);
		$this->Cell(35,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(0,$InterLigne,"",LTBR,0,L);
		$this->Ln(6);

		//  fourth line
		$this->Cell(65,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(30,$InterLigne,"",LTBR,0,L);
		$this->Cell(35,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(0,$InterLigne,"",LTBR,0,L);
		$this->Ln(6);

		//  fifth line
		$this->Cell(65,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(30,$InterLigne,"",LTBR,0,L);
		$this->Cell(35,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(0,$InterLigne,"",LTBR,0,L);
		$this->Ln(6);

		//  sixth line
		$this->Cell(65,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(30,$InterLigne,"",LTBR,0,L);
		$this->Cell(35,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(0,$InterLigne,"",LTBR,0,L);
		$this->Ln(6);

		//  seventh line
		$this->Cell(65,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(30,$InterLigne,"",LTBR,0,L);
		$this->Cell(35,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(0,$InterLigne,"",LTBR,0,L);
		$this->Ln(6);

		//  eight line
		$this->Cell(65,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(30,$InterLigne,"",LTBR,0,L);
		$this->Cell(35,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(0,$InterLigne,"",LTBR,0,L);
		$this->Ln(6);

		//  ninth line
		$this->Cell(65,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(30,$InterLigne,"",LTBR,0,L);
		$this->Cell(35,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(0,$InterLigne,"",LTBR,0,L);
		$this->Ln(6);

		//  tenth line
		$this->Cell(65,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(30,$InterLigne,"",LTBR,0,L);
		$this->Cell(35,$InterLigne,"",LTBR,0,L);
		$this->Cell(20,$InterLigne,"",LTBR,0,L);
		$this->Cell(0,$InterLigne,"",LTBR,0,L);
		$this->Ln(6);

		$this->SetFont('Arial','B',6);
		$this->Cell(0,4,"(Continue on Separate sheet if necessary)",1,0,C);
		$this->Ln(4);
		
		//Colors of frame, background and text
		$this->SetFont('Arial','I',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(0,$InterLigne,"V. WORK EXPERIENCE (include private employment start from most recent work experience.)",1,0,L,1);
		$this->Ln(6);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(225,225,225);
		$this->Cell(40,$InterLigne,"28.    INCLUSIVE DATES",LTR,0,L,1);
		$this->Cell(45,$InterLigne,"POSITION TITLE",LTR,0,C,1);
		$this->Cell(60,$InterLigne,"",LTR,0,C,1);
		$this->Cell(25,$InterLigne,"MONTHLY",LTR,0,C,1);
		$this->Cell(0,$InterLigne,"STATUS OF",LTR,0,C,1);
		$this->Ln(4);

		$this->Cell(40,$InterLigne,"(mm/dd/yyyy)",LBR,0,C,1);
		$this->Cell(45,$InterLigne,"(Write in full)",LR,0,C,1);
		$this->Cell(60,$InterLigne,"DEPARTMENT/AGENCY/OFFICE",LR,0,C,1);
		$this->Cell(25,$InterLigne,"SALARY",LR,0,C,1);
		$this->Cell(0,$InterLigne,"APPOINTMENT",LR,0,C,1);
		$this->Ln(6);
		
		$this->Cell(20,$InterLigne,"From",LTBR,0,C,1);
		$this->Cell(20,$InterLigne,"To",LTBR,0,C,1);
		$this->Cell(45,$InterLigne,"",LR,0,C,1);
		$this->Cell(60,$InterLigne,"",LR,0,C,1);
		$this->Cell(25,$InterLigne,"",LR,0,C,1);
		$this->Cell(0,$InterLigne,"",LR,0,L,1);
		$this->Ln(6);
		
		//  1.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  2.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  3.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  4.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  5.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  6.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  7.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  8.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  9.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  10.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  11.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  12.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  13.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  14.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  15.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);
		
		//  16.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  17.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  18.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  19.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  20.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  21.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  22.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);
		
		//  23.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  24.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  25.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  26.
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(20,$InterLigne,"",1,0,L);
		$this->Cell(45,$InterLigne,"",1,0,L);
		$this->Cell(60,$InterLigne,"",1,0,L);
		$this->Cell(25,$InterLigne,"",1,0,L);
		$this->Cell(0,$InterLigne,"",1,0,L);
		$this->Ln(6);

		//  work experience separate sheet
		$this->SetFont('Arial','B',6);
		$this->Cell(0,4,"(Continue on separate sheet, if necessary)",1,0,C);
		$this->Ln(4);
		
		//  work experience affixe applicant signature and date
		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"",LTR,0,C);
		$this->Ln(6);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(6);
		$this->Cell(0,$InterLigne,"Affix your signature: ___________________________________________________              Date  :	__________________",LR,0,C);
		$this->Ln(6);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(6);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(30);

		
		//  VOLUNTARY WORK (Colors of frame, background and text)
		$this->SetFont('Arial','I',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(0,$InterLigne,"VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / ORGANIZATIONS",1,0,'L',1);
		$this->Ln(6);
		//Text color in gray
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(225,225,225);
		$this->Cell(70,$InterLigne,"NAME & ADDRESS OF ORGANIZATION",LTR,0,C,1);
		$this->Cell(50,$InterLigne,"INCLUSIVE DATES (mm/dd/yyyy)",LTBR,0,C,1);
		$this->Cell(30,$InterLigne,"NUMBER OF",LTR,0,C,1);
		$this->Cell(0,$InterLigne,"POSITION/",LTR,0,C,1);
		$this->Ln(6);
		
		$this->Cell(70,$InterLigne,"(Write in full)",LR,0,C,1);
		$this->Cell(25,$InterLigne,"From",LTBR,0,C,1);
		$this->Cell(25,$InterLigne,"To",LTBR,0,C,1);
		$this->Cell(30,$InterLigne,"HOURS",LBR,0,C,1);
		$this->Cell(0,$InterLigne,"NATURE OF WORK",LBR,0,C,1);
		$this->Ln(6);

		//  1.
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(30,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);

		//  2.
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(30,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);

		//  3.
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(30,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);

		//  4.
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(30,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);

		//  5.
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(30,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);
		
		//  6.
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(30,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);

		//  7.
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(30,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);

		//  8.
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(25,$InterLigne,"",1,0,C);
		$this->Cell(30,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);

		// voluntary work - continue on separate sheet
		$this->SetFont('Arial','B',6);
		$this->Cell(0,4,"(Continue on separate sheet, if necessary)",1,0,C);
		$this->Ln(4);

		//  TRAINING PROGRAMS (Colors of frame, background and text)
		$this->SetFont('Arial','I',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(0,$InterLigne,"VII. TRAINING PROGRAMS / STUDY / SCHOLARSHIP GRANTS (starts from the most recent training)",1,0,'L',1);
		$this->Ln(6);
		
		//  30. title of seminar/trainings
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(225,225,225);
		$this->Cell(70,$InterLigne,"30.",LTR,0,L,1);
		$this->Cell(50,$InterLigne,"",LTR,0,C,1);
		$this->Cell(30,$InterLigne,"",LTR,0,C,1);
		$this->Cell(0,$InterLigne,"",LTR,0,C,1);
		$this->Ln(5);

		$this->Cell(70,$InterLigne,"TITLE OF",LR,0,C,1);
		$this->Cell(50,$InterLigne,"INCLUSIVE DATE OF ATTENDANCE",LR,0,C,1);
		$this->Cell(30,$InterLigne,"NUMBER OF",LR,0,C,1);
		$this->Cell(0,$InterLigne,"CONDUCTED/SPONSORED BY",LR,0,C,1);
		$this->Ln(5);

		$this->Cell(70,$InterLigne,"SEMINAR/CONFERENCE/WORKSHOP",LR,0,C,1);
		$this->Cell(50,$InterLigne,"(mm/dd/yyyy)",LR,0,C,1);
		$this->Cell(30,$InterLigne,"HOURS",LR,0,C,1);
		$this->Cell(0,$InterLigne,"(Write in full)",LR,0,C,1);
		$this->Ln(5);

		$this->Cell(70,$InterLigne,"(Write in full)",LBR,0,C,1);
		$this->Cell(50,$InterLigne,"",LBR,0,C,1);
		$this->Cell(30,$InterLigne,"",LBR,0,C,1);
		$this->Cell(0,$InterLigne,"",LBR,0,C,1);
		$this->Ln(6);

		$this->Cell(70,$InterLigne,"",LTBR,0,C,1);
		$this->Cell(25,$InterLigne,"From",LTBR,0,C,1);
		$this->Cell(25,$InterLigne,"To",LTBR,0,C,1);
		$this->Cell(30,$InterLigne,"",LTBR,0,C,1);
		$this->Cell(0,$InterLigne,"",LTBR,0,C,1);
		$this->Ln(6);

		//  1.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  2.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  3.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  4.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  5.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  6.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  7.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  8.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  9.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  10.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  11.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  12.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  13.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  14.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  15.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  16.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  17.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(25,$InterLigne,"",LTBR,0,C);
		$this->Cell(30,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  Training/Seminars - separate sheet
		$this->SetFont('Arial','B',6);
		$this->Cell(0,4,"(Continue on separate sheet, if necessary)",1,0,C);
		$this->Ln(4);

		//  OTHER INFORMATION - Colors of frame, background and text
		$this->SetFont('Arial','I',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(0,$InterLigne,"VII. OTHER INFORMATION",1,0,L,1);
		$this->Ln(6);
		
		//  special skills/recognition/organization
		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"31.",LTR,0,L);
		$this->Cell(80,$InterLigne,"32.",LTR,0,L);
		$this->Cell(0,$InterLigne,"33.",LTR,0,L);
		$this->Ln(3);
		
		$this->Cell(70,$InterLigne,"SPECIAL SKILLS / HOBBIES",LR,0,C);
		$this->Cell(80,$InterLigne,"NON-ACADEMIC DISTINCTIONS/RECOGNITION:",LR,0,C);
		$this->Cell(0,$InterLigne,"MEMBERSHIP IN",LR,0,C);
		$this->Ln(3);
		
		$this->Cell(70,$InterLigne,"",LR,0,C);
		$this->Cell(80,$InterLigne,"(Write in full)",LR,0,C);
		$this->Cell(0,$InterLigne,"ASSOCIATION/ORGANIZATION",LR,0,C);
		$this->Ln(3);
		$this->Cell(70,$InterLigne,"",LBR,0,C);
		$this->Cell(80,$InterLigne,"",LBR,0,C);
		$this->Cell(0,$InterLigne,"(Write in full)",LBR,0,C);
		$this->Ln(6);
		
		//  1.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(80,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  2.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(80,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  3.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(80,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  4.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(80,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  5.
		$this->Cell(70,$InterLigne,"",LTBR,0,C);
		$this->Cell(80,$InterLigne,"",LTBR,0,C);
		$this->Cell(0,$InterLigne,"",LTBR,0,C);
		$this->Ln(6);

		//  34.  other information
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(225,225,225);
		$this->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->Cell(0,$InterLigne,"",LTR,0,L);
		$this->Ln(4);
		$this->Cell(70,$InterLigne,"",LR,0,L,1);
		$this->Cell(0,$InterLigne,"",LR,0,L);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"34.  Are  you   related  by   consanguinity  or   ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"a.  Within the third degree?       						   []	YES 				[]	NO",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	affinity   to   any   of  the    following:   ",LR,0,C,1);
		$this->SetFont('Arial','I',10);
		$this->Cell(0,$InterLigne,"(for NATIONAL GOVERNMENT Employees)",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	appointing   authority,  recommending ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	authority,     chief    of     office/bureau/ ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"b.  Within the  fourth  degree?										  []	YES				[]	NO",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	department   or     person     who   has  ",LR,0,C,1);
		$this->SetFont('Arial','I',10);
		$this->Cell(0,$InterLigne,"(for LOCAL Government Employees)            ",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	immediate   supervision  over  you  in  ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	the   Office,   Bureau   or   Deparment   ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"If your answer is YES, give particulars",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	where   you   will   be   appointed?        ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);
		
		$this->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(35);

		//  35.  other information
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(225,225,225);
		$this->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->Cell(0,$InterLigne,"",LTR,0,L);
		$this->Ln(4);
		$this->Cell(70,$InterLigne,"",LR,0,L,1);
		$this->Cell(0,$InterLigne,"",LR,0,L);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"35.  Have  you  ever  been  declared      ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"If your answer is YES, give details of offense.			   []	YES 				[]	NO",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"    guilty  of any  administrative         ",LR,0,C,1);
		$this->SetFont('Arial','I',10);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	offense?                                        ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"______________________________________________________",LR,0,C);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);
		
		$this->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  36.  other information
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(225,225,225);
		$this->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->Cell(0,$InterLigne,"",LTR,0,L);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"36.  Have you ever been convicted of     ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"If your answer is YES, give details of offense.			   []	YES 				[]	NO",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"  any crime or violation of any law,",LR,0,C,1);
		$this->SetFont('Arial','I',10);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	decree, ordinance or regulations",LR,0,C,1);
		$this->SetFont('Arial','I',10);
		$this->Cell(0,$InterLigne,"______________________________________________________",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	by any court or tribunal.              ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);
		
		$this->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  37.  other information
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(225,225,225);
		$this->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->Cell(0,$InterLigne,"",LTR,0,L);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"37.  Have  you ever  been  forced to      ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"If your answer is YES, give reasons.			   []	YES 				[]	NO",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"  retire/resign  or  dropped  from ",LR,0,C,1);
		$this->SetFont('Arial','I',10);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	employment  in  the  public or  ",LR,0,C,1);
		$this->SetFont('Arial','I',10);
		$this->Cell(0,$InterLigne,"______________________________________________________",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	private    sector?                        ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);
		
		$this->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  38.  other information
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(225,225,225);
		$this->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->Cell(0,$InterLigne,"",LTR,0,L);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"38.  Have you ever been a candidate       ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"If your answer is YES, give date of elections			   []	YES 				[]	NO",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"  in a national or local election       ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne," and other particulars.                                                                       ",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	(except Barangay election)         ",LR,0,C,1);
		$this->SetFont('Arial','I',10);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"______________________________________________________",LR,0,C);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);
		
		$this->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  39.  other information
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(225,225,225);
		$this->Cell(70,$InterLigne,"",LTR,0,L,1);
		$this->Cell(0,$InterLigne,"",LTR,0,L);
		$this->Ln(4);

		$this->Cell(70,$InterLigne,"39.  Pursuant  to  (a)  Indigenous              ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"a.  Are you a member of  any  indigenous group?		[]	YES 				[]	NO",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"   People's Act (RA 8371);                   ",LR,0,C,1);
		$this->SetFont('Arial','B',9);
		$this->Cell(0,$InterLigne,"If your answer is YES, please specify				______________________",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"(b) Magna Carta for Disabled       ",LR,0,C,1);
		$this->SetFont('Arial','I',9);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	Persons (RA 7277);   and  (c)        ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"b.  Are    you    differently    abled?																	[]	YES 				[]	NO										",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	 Solo Parents Welfare  Act of         ",LR,0,C,1);
		$this->SetFont('Arial','B',9);
		$this->Cell(0,$InterLigne,"If your answer is YES, please specify				______________________",LR,0,C);
		$this->Ln(4);
		
		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	 2000 (RA 8972); please                  ",LR,0,C,1);
		$this->SetFont('Arial','B',9);
		$this->Cell(0,$InterLigne,"",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"	answer the following items:         ",LR,0,C,1);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,$InterLigne,"c.  Are    you    a   solo    parent?																			[]	YES 				[]	NO												",LR,0,C);
		$this->Ln(4);

		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"",LR,0,C,1);
		$this->SetFont('Arial','B',9);
		$this->Cell(0,$InterLigne,"if your answer is YES, please specify				______________________",LR,0,C);
		$this->Ln(4);
		
		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"",LBR,0,C,1);
		$this->SetFont('Arial','B',9);
		$this->Cell(0,$InterLigne,"",LBR,0,C);
		$this->Ln(6);

		//  40.  References
		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,"40.  REFERENCES(Persons not related by consanguinity or affinity to applicant / appointee)",1,0,L,1);
		$this->Ln(6);
		//  name
		$this->SetFont('Arial','B',8);
		$this->Cell(70,$InterLigne,"NAME",LTBR,0,C,1);
		//  address
		$this->Cell(70,$InterLigne,"Address",LTBR,0,C,1);
		//  telephone no.
		$this->Cell(0,$InterLigne,"Telephone No.",LTBR,0,C,1);
		$this->Ln(6);
		//  line space 1
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);
		//  line space 2
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);
		//  line space 3
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(70,$InterLigne,"",1,0,C);
		$this->Cell(0,$InterLigne,"",1,0,C);
		$this->Ln(6);
		
		//  41. declaration to wit
		$txt = "41.   I declare under the penalties of perjury that this Personal Data Sheet has been accomplished in good faith, veriried by me and to the best";
		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,$txt,LTR,0,L,1);
		$this->Ln(4);
		//  paragraph1
		$txt = "        of my  knowledge and belief is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations";
		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,$txt,LR,0,L,1);
		$this->Ln(4);
		// paragraph1
		$txt = "        of the Republic of the Philippines.    ";
		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,$txt,LR,0,L,1);
		$this->Ln(6);
		//  paragraph2
		$txt = "        I also authorize the agency head / authorized representative to verify / validate the contents stated herein. I trust that this information shall";
		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,$txt,LR,0,L,1);
		$this->Ln(4);
		//  paragraph2
		$txt = "        remain confidential.";
		$this->SetFont('Arial','B',8);
		$this->Cell(0,$InterLigne,$txt,LBR,0,L,1);
		$this->Ln(4);
		
		//  SIGNATURE/DATE ACCOMPLISHED/TAX
		$this->SetFont('Arial','I',10);
		$this->Cell(3,$InterLigne,"",L,0);
		$this->Cell(70,$InterLigne,"",0,0);			//  signature
		$this->Cell(65,$InterLigne,"",0,0);			//  blank/space provided
		$this->Cell(15,$InterLigne,"",0,0);			//  spaces
		$this->Cell(35,10,"",0,0);					//  thumbmark
		$this->Cell(0,$InterLigne,"",R,0);				
		$this->Ln(6);
		$this->SetFillColor(225,225,225);
		$this->Cell(3,$InterLigne,"",L,0);
		$this->Cell(70,$InterLigne,"Signature",1,0,R,1);
		$this->Cell(65,$InterLigne,"",LTBR,0);
		$this->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->Cell(35,$InterLigne,"",0,0);			//  thumbmark
		$this->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->Ln(6);
		$this->Cell(3,$InterLigne,"",L,0);
		$this->Cell(70,$InterLigne,"Date Accomplished",1,0,R,1);
		$this->Cell(65,$InterLigne,"",LTBR,0);
		$this->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->Cell(35,$InterLigne,"",LTR,0);			//  thumbmark
		$this->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->Ln(4);

		$this->Cell(3,$InterLigne,"",L,0);
		$this->Cell(70,$InterLigne,"",0,0);
		$this->Cell(65,$InterLigne,"",0,0);
		$this->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->Cell(35,$InterLigne,"",LR,0);			//  thumbmark
		$this->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->Ln(6);

		$this->Cell(3,$InterLigne,"",L,0);
		$this->Cell(70,$InterLigne,"Community Tax Certificate No.",1,0,R,1);
		$this->Cell(65,$InterLigne,"",LTBR,0);
		$this->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->Cell(35,$InterLigne,"",LR,0);			//  thumbmark
		$this->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->Ln(6);

		$this->Cell(3,$InterLigne,"",L,0);
		$this->Cell(70,$InterLigne,"Issued at",1,0,R,1);
		$this->Cell(65,$InterLigne,"",LTBR,0);
		$this->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->Cell(35,$InterLigne,"",LBR,0);			//  thumbmark
		$this->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->Ln(6);

		$this->Cell(3,$InterLigne,"",L,0);
		$this->Cell(70,$InterLigne,"Issued on",1,0,R,1);
		$this->Cell(65,$InterLigne,"",LTBR,0);
		$this->Cell(15,$InterLigne,"",0,0);				//  spaces
		$this->SetFont('Arial','B',8);
		$this->Cell(35,$InterLigne,"Right Thumbmark",0,0,C);			//  thumbmark
		$this->Cell(0,$InterLigne,"",R,0);				//  spaces
		$this->Ln(6);

		$this->SetFont('Arial','B',8);
		$this->Cell(3,$InterLigne,"",L,0);
		$this->Cell(70,$InterLigne,"",0,0);			//  signature
		$this->Cell(65,$InterLigne,"",0,0);			//  blank/space provided
		$this->Cell(15,$InterLigne,"",0,0);			//  spaces
		$this->Cell(35,10,"",0,0);					//  thumbmark
		$this->Cell(0,$InterLigne,"",R,0);				
		$this->Ln(4);

		// Footer
		//$this->Rect(10,283,196,40,'D');   // Rect(10,H,W,40,'D')
		$this->SetFont('Arial','B',6);
		$txt = "*Solo Parent has defined in Section 3 of the Republic of the Philippines Act. No 8972 refers to any individual who falls under any of the following categories:
		";
		$this->Cell(0,$InterLigne,$txt,LTR,0,L);
		$this->Ln(3);
		// other paragraph
		$this->SetFont('Arial','B',6);
		$txt = "(a) A woman who gives birth as a result of rape and other crimes against chastity even without a final conviction of the offender.  Provide that the mother keeps and raises the child;";
		$this->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->Ln(3);
		// other paragraph
		$this->SetFont('Arial','B',6);
		$txt = "(b) Parent left solo or alone with the responsibility of parenthood due to the dead of spouse;";
		$this->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->Ln(3);
		// other paragraph
		$this->SetFont('Arial','B',6);
		$txt = "(c) Parent left solo or alone with the reponsibility of parenthood while the spouse is detained, or is serving sentence for a criminal conviction for at least one (1) year;
		";
		$this->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->Ln(3);
		// other paragraph
		$this->SetFont('Arial','B',6);
		$txt = "(d) Parent left solo or alone with the responsibility of parenthood due to physical and/or mental incapacity of spouse as certified by a public medical practitioner;";
		$this->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->Ln(3);
		// other paragraph
		$this->SetFont('Arial','B',6);
		$txt = "(e) Parent left solo or alone with the responsibility of parenthood due to legal separation from spouse for at least one (1) year as long as he/shee is entrusted with the custody of the children;";
		$this->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->Ln(3);
		// other paragraph
		$this->SetFont('Arial','B',6);
		$txt = "(f) Parent left solo or alone with the responsibility of parenthood due to declaration of nullity or annulment of marriage as decreed by a court or by the church as long as he/shee is entrusted";
		$this->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->Ln(3);
		// other paragraph
		$this->SetFont('Arial','B',6);
		$txt = "     with the custody of the children;";
		$this->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->Ln(3);
		// other paragraph
		$this->SetFont('Arial','B',6);
		$txt = "(g) Parent left solo or alone with the responsibility of parenthood due to abandonment of spouse for at least one (1) year;";
		$this->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->Ln(3);
		// other paragraph
		$this->SetFont('Arial','B',6);
		$txt = "(h) Parent left solo or alone with the responsibility of parenthood due to unmarried mother/father who has preferred to keep and rear her/his child/children instead of having others care for";
		$this->Cell(0,$InterLigne,$txt,LR,0,L);
		$this->Ln(3);
		// other paragraph
		$this->SetFont('Arial','B',6);
		$txt = "     them or give them up to a welface institution.";
		$this->Cell(0,$InterLigne,$txt,LBR,0,L);
		$this->Ln(6);
	}
	
}   //  end of class

$objPDS = new Profile('P','mm','Legal');
	
$objPDS->SetLeftMargin(10);
$objPDS->SetRightMargin(10);
$objPDS->SetTopMargin(15);
$objPDS->SetAutoPageBreak("on",30);
$objPDS->AliasNbPages();
$objPDS->Open();
$objPDS->AddPage();
$objPDS->PersonalDataSheet();

$objPDS->Output();
?>
