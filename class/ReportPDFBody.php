<?
/* 
File Name: ReportPDFBody.php (class folder)
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
Date of Revision: May 26, 2004
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
require('../hrmis/class/ReportPositionDescriptionForm.php');

class ReportPDFBody extends General
{
	var $objRprt;
	var $intCounter = 0;

	// Body
	function printBody($t_intCounter, $t_strEmpNumber, $strEmpFullName, $t_strEmpName, $strAgencyName, $strAgencyHeadName,$strPrevItemNumber, $t_strDateOfSigning, $t_strDivisionHead)
	{
		$InterLigne = 7;
		$Percentage = 19; 
		$Height = 10;
		
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(90,6,'Republic of the Philippines',R,0,C);
		$this->objRprt->Cell(90,6,'1.   NAME OF EMPLOYEE',0,0,L);
		$this->objRprt->Ln(5);
		
		$this->objRprt->Cell(90,6,'BC-CSC Form No. 1',R,0,C);
		$this->objRprt->Cell(90,6,'',0,0,C);
		$this->objRprt->Ln(5);
		
		$this->objRprt->Cell(90,6,'(POSITION DESCRIPTION FORM)',R,0,C);		
		$this->objRprt->SetFont('Arial','',10);
		$this->objRprt->Cell(90,6,$t_strEmpName,0,0,C);
		$this->objRprt->Ln(5);
		
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(90,6,'',R,0,C);
		$this->objRprt->Cell(90,6,'',0,0,C);		
		$this->objRprt->Ln(5);
		
		$this->objRprt->Cell(90,6,'',BR,0,C);
		$this->objRprt->Cell(90,6,'(FAMILY NAME)		(GIVEN NAME)		(MIDDLE NAME)',B,0,C);
		$this->objRprt->Ln(5);
		//  Second Paragraph		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(90,6,'2.  DEPARTMENT, CORPORATION OR AGENCY/LOCAL',R,0,L);
		$this->objRprt->Cell(90,6,'3.  BUREAU OR OFFICE',0,0,L);		
		$this->objRprt->Ln(5);
		
		$this->objRprt->Cell(90,6,'     GOVERNMENT',R,0,L);
		$this->objRprt->Cell(90,6,'',0,0,L);		
		$this->objRprt->Ln(5);

		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell(90,6,$strAgencyName,BR,0,C);			//  Agency Name
		$this->objRprt->Cell(90,6,$_SESSION['sesBureau'],B,0,C);	//  Bureau or Office
		$this->objRprt->Ln(5);

		//  Third Paragraph		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(90,6,'4.  DEPT./BRANCH/DIVISION',R,0,L);
		$this->objRprt->Cell(90,6,'5.  WORK STATION/PLACE OF WORK',0,0,L);		
		$this->objRprt->Ln(5);
		
		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell(90,6,'',R,0,C);			
		$this->objRprt->Cell(90,6,'',0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(90,6,$_SESSION['sesDivision'],BR,0,C);		//  Division
		$this->objRprt->Cell(90,6,$_SESSION['sesWorkPlace'],B,0,C);		//  Place of Work			
		$this->objRprt->Ln(6);

		//  Forth Paragraph
		$Forth = 45;		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell($Forth,6,'6a.  PRES. APPROP. ACT/',R,0,L);
		$this->objRprt->Cell($Forth,6,'6b.  PREV. APPROP. ACT/',R,0,L);
		$this->objRprt->Cell($Forth,6,'7a.  SALARY',R,0,L);		
		$this->objRprt->Cell($Forth,6,'7b.  OTHER COMPENSATION',0,0,L);		
		$this->objRprt->Ln(5);
		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell($Forth,6,'       BOARD RES.',R,0,L);
		$this->objRprt->Cell($Forth,6,'       BOARD RES.',R,0,L);
		$this->objRprt->Cell($Forth,6,'		     AUTHORIZED',R,0,L);		
		$this->objRprt->Cell($Forth,6,'',0,0,L);		
		$this->objRprt->Ln(5);

		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell($Forth,6,'       ORD. NO.',R,0,L);
		$this->objRprt->Cell($Forth,6,'       ORD. NO.',R,0,L);		
		$this->objRprt->Cell($Forth,6,'       ACTUAL',R,0,L);		
		$this->objRprt->Cell($Forth,6,'',0,0,L);		
		$this->objRprt->Ln(5);

		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell($Forth,6,'       ITEM NO.',R,0,L);
		$this->objRprt->Cell($Forth,6,'       ITEM NO.',R,0,L);		
		$this->objRprt->Cell($Forth,6,"           " . $_SESSION['sesAuthorizeSalaryYr'] . "/annum",R,0,L);	// Authorize/Actual Salary		
		$this->objRprt->Cell($Forth,6," 	       " . $_SESSION['sesOthers'],0,0,L);		
		$this->objRprt->Ln(5);

		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell(45,6,$_SESSION['sesItemNumber'] ,BR,0,C);		//  Present item number
		$this->objRprt->Cell(45,6,$_SESSION['sesPrevItemNumber'] ,BR,0,C);		//  Previous item number
		$this->objRprt->Cell(45,6,'',BR,0,C);			
		$this->objRprt->Cell(45,6,'',B,0,C);			
		$this->objRprt->Ln(6);

		//  Fifth Paragraph		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(90,6,'8.  OFFICIAL DESIGNATION OF POSITION',R,0,L);
		$this->objRprt->Cell(90,6,'9.  WORKING OR PROPOSED TITLE',0,0,L);		
		$this->objRprt->Ln(5);
		
		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell(90,6,'',R,0,C);			
		$this->objRprt->Cell(90,6,'',0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(90,6,$_SESSION['sesPositionCode'],BR,0,C);		//  position code			
		$this->objRprt->Cell(90,6,$_SESSION['sesWorkingTitle'],B,0,C);		//  working proposed title
		$this->objRprt->Ln(6);

		//  Sixth Paragraph		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(90,6,'10. WAPCO CLASSIFICATION OF THIS POSITION',R,0,L);
		$this->objRprt->Cell(90,6,'11. OCCUPATIONAL GROUP TITLE (leave blank)',0,0,L);		
		$this->objRprt->Ln(5);
		
		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell(90,6,'',R,0,C);		
		$this->objRprt->Cell(90,6,'',0,0,C);
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(90,6,$_SESSION['sesWAPCO'],BR,0,C);	//  WAPCO			
		$this->objRprt->Cell(90,6,'',B,0,C);						//  occupational group title			
		$this->objRprt->Ln(6);

		//  Seventh Paragraph		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'12. FOR LOCAL GOVERNMENT POSITION, CHECK GOVERNMENTAL UNIT AND UNITS CLASS',0,0,L);
		$this->objRprt->Ln(10);
		
		$this->objRprt->Cell(180,6,'',0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(50,5,'   Municipality',0,0,C);			
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(50,5,'   City',0,0,C);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(50,5,'   Province',0,0,C);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Ln(10);

		$this->objRprt->Cell(70,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'',LTBR,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'',LTBR,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'',LTBR,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'',LTBR,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'',LTBR,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'',LTBR,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'',LTBR,0,C);	
		$this->objRprt->Ln(6);
		
		$this->objRprt->Cell(70,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'1st',0,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'2nd',0,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'3rd',0,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'4th',0,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'5th',0,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'6th',0,0,C);	
		$this->objRprt->Cell(5,5,'',0,0,C);			
		$this->objRprt->Cell(4,4,'7th',0,0,C);	
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(180,6,'13. STATEMENT OF DUTIES AND RESPONSIBILITIES if more space is needed, please attach additional sheets',0,0,L);
		$this->objRprt->Ln(10);

		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(30,5,'Percent of',R,0,L);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(30,5,'Working Time',R,0,L);
		$this->objRprt->Cell(40,5,'Duties',0,0,L);
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(30,5,'',R,0,L);
		$this->objRprt->Cell(40,5,'',0,0,L);
		$this->objRprt->Ln(5);

		//  get employee duties and responsibilities
		$objEmpDuties = mysql_query("SELECT *
										FROM tblEmpDuties
										WHERE empNumber = '$t_strEmpNumber'
										ORDER BY percentWork DESC");
										
		$arrCntEmpDuties = mysql_num_rows($objEmpDuties);

		$intCntPercentWork=0;
		while($arrEmpDuties = mysql_fetch_array($objEmpDuties))
		{
			$intCntPercentWork++;
			$strPercentWork = $arrEmpDuties['percentWork'];
			$strDuties = $arrEmpDuties['duties'];
		
			if ($intCntPercentWork >= 1)
			{
				$this->intCounter = $this->intCounter + 1;
				$this->objRprt->SetFont(Arial,'',8);
				$this->objRprt->Cell(30,5,$strPercentWork,R,0,L);
				$this->objRprt->Cell(40,5,$strDuties,0,0,L);
				$this->objRprt->Ln(5);
				//$this->objRprt->Cell(30,5,'',R,0,L);
				//$this->objRprt->Cell(40,5,'',0,0,L);
				//$this->objRprt->Ln(5);
				//$this->objRprt->Cell(30,5,'',R,0,L);
				//$this->objRprt->Cell(40,5,'',0,0,L);
				//$this->objRprt->Ln(5);
			} else {
				$this->intCounter = $this->intCounter + 1;
				$this->objRprt->Cell(30,75,'',R,0,L);
				$this->objRprt->Cell(40,75,'',0,0,L);
				$this->objRprt->Ln(85);
			}

		}
		
		$this->objRprt->Cell(30,5,'',R,0,L);
		$this->objRprt->Cell(40,5,'',0,0,L);
		$this->objRprt->Ln(70);
		
		
		//  Page 2 #14		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(90,6,'14.  POSITION TITLE OF IMMEDIATE SUPERVISOR',R,0,L);
		$this->objRprt->Cell(90,6,'15.  POSITION TITLE OF NEXT HIGHER SUPERVISOR',0,0,L);		
		$this->objRprt->Ln(6);

		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell(90,6,'',R,0,C);			
		$this->objRprt->Cell(90,6,'',0,0,C);
		$this->objRprt->Ln(4);

		$this->objRprt->Cell(90,6,$_SESSION['sesSupervisor'],BR,0,C);			//  Supervisor
		$this->objRprt->Cell(90,6,$_SESSION['sesNextSupervisor'],B,0,C);		//  Next Supervisor
		$this->objRprt->Ln(6);

		//  Page 2 #16		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'16. NAME, TITLES AND ITEM NOS. OF THOSE YOU DIRECTLY SUPERVISE (if more than (7) list only by their',0,0,L);
		$this->objRprt->Ln(4);
		$this->objRprt->Cell(37,6,'item nos and titles)',0,0,R);
		$this->objRprt->Ln(6);

		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell(180,6,$_SESSION['sesNameTitleItem'],0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(5);

		//  Page 2 #17		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'17. MACHINES, EQUIPMENT, TOOLS, etc. used regularly in performance of work',0,0,L);
		$this->objRprt->Ln(6);

		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell(180,6,$_SESSION['sesMachineTools'],0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(5);

		//  Page 2 #18		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(90,6,'18.  Contacts',R,0,L);
		$this->objRprt->Cell(90,6,'19.  Working Condition',0,0,L);		
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(90,6,'',R,0,L);
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(45,5,'General',0,0,L);			
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(15,6,'',0,0,L);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(22,6,'',R,0,L);
		$this->objRprt->Cell(45,5,'Normal Working Condition',0,0,L);			
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(45,5,'Other Agencies',0,0,L);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(15,6,'',0,0,L);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(22,6,'',R,0,L);
		$this->objRprt->Cell(45,5,'Field Work',0,0,L);			
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(45,5,'Supervisors',0,0,L);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(15,6,'',0,0,L);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(22,6,'',R,0,L);
		$this->objRprt->Cell(45,5,'Field Trips',0,0,L);			
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(45,5,'Management',0,0,L);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(15,6,'',0,0,L);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(22,6,'',R,0,L);
		$this->objRprt->Cell(45,5,'Exposed to Varied Weather',0,0,L);			
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(45,5,'Others (Specify)',0,0,L);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(15,6,'',0,0,L);
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Cell(22,6,'',R,0,L);
		$this->objRprt->Cell(45,5,'Others (Specify)',0,0,L);			
		$this->objRprt->Cell(4,4,'',LTBR,0,L);	
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(4);

		//  Page 2 #20		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'20. I CERTIFY that the above anwers are accurate and complete.',0,0,L);
		$this->objRprt->Ln(6);

		$this->objRprt->SetFont('Arial','',9);
		$this->objRprt->Cell(90,6,$t_strDateOfSigning,0,0,C);		//	date certified			
		$this->objRprt->Cell(90,6,$strEmpFullName,0,0,C);		//  signature/name of employee here			
		$this->objRprt->Ln(0);

		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(90,6,'____________________',0,0,C);			
		$this->objRprt->Cell(90,6,'_________________________',0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(90,6,'(Date)',0,0,C);			
		$this->objRprt->Cell(90,6,'(Signature of Employee)',0,0,C);			
		$this->objRprt->Ln(1);

		//  Page 2 NOTE		
		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(5);

		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'TO BE FILLED OUT BY THE IMMEDIATE SUPERVISOR',0,0,C);
		$this->objRprt->Ln(0);

		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(5);

		//  Page 2 #21		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'21. Describe briefly the general function of the Unit or Section',0,0,L);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(180,6,'',0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(5);

		//  Page 2 #22		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'22. Describe briefly the general function of the position',0,0,L);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(180,6,'',0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(5);

		//  Page 2 #23a		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'23a. Indicate  the required qualifications by years and kind of education considered in filling up a vacancy  for this',0,0,L);
		$this->objRprt->Ln(4);
		$this->objRprt->Cell(180,6,'        position. (Keep the position in mind rather than the qualifications of the present incumbent.  This item should',0,0,L);
		$this->objRprt->Ln(4);
		$this->objRprt->Cell(180,6,'        be filled for all positions other than teaching.)',0,0,L);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(180,6,'        Education:',0,0,L);			
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(180,6,'        Experience:',0,0,L);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(5);

		//  Page 2 #23b		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'23b. Licenses or certificates required to do this work, if any',0,0,L);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(90,6,'',0,0,C);		//	query result here			
		$this->objRprt->Cell(90,6,'',0,0,C);					//  space only			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(5);

		//  Page 2 #24		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'24.  I hereby certify that the above answers are acurate and complete.',0,0,L);
		$this->objRprt->Ln(6);

		$this->objRprt->Cell(180,6,'',0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(90,6,$t_strDateOfSigning,0,0,C);		//	date certified			
		$this->objRprt->Cell(90,6,$t_strDivisionHead,0,0,C);		//  signature/name of supervisor here			
		$this->objRprt->Ln(0);

		$this->objRprt->Cell(90,6,'____________________',0,0,C);			
		$this->objRprt->Cell(90,6,'______________________________________',0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(90,6,'(Date)',0,0,C);			
		$this->objRprt->Cell(90,6,'Signature and Title of Immediate Supervisor',0,0,C);			
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(180,5,'',B,0,L);
		$this->objRprt->Ln(5);

		//  Page 2 #25		
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(180,6,'25.  Approved:.',0,0,L);

		$this->objRprt->Ln(10);
		$this->objRprt->Cell(90,5,$t_strDateOfSigning,0,0,C);		//	date approved			
		$this->objRprt->Cell(90,5,$strAgencyHeadName,0,0,C);		//  signature/name of head of agency		

		$this->objRprt->Ln(0);
		$this->objRprt->Cell(90,6,'____________________',0,0,C);			
		$this->objRprt->Cell(90,6,'_________________________',0,0,C);			
		$this->objRprt->Ln(5);

		$this->objRprt->Cell(90,6,'(Date)',0,0,C);			
		$this->objRprt->Cell(90,6,'Head of Agency',0,0,C);			
		$this->objRprt->Ln(1);

	}
	
	function generateReport()
	{
		$this->objRprt = new ReportPositionDescriptionForm;
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeCode, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(18);
		$this->objRprt->SetRightMargin(15);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on",25);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		$this->objRprt->AddPage();
		
		//  get agency information (e.g. name, address)
		$objOfficeInfo = mysql_query("SELECT tblAgency.agencyName, tblAgency.abbreviation, tblAgency.address, tblAgency.telephone FROM tblAgency");
		$arrOfficeInfo = mysql_fetch_array($objOfficeInfo);
		$strAgencyAbb = $arrOfficeInfo['abbreviation'];
		$tstrAgencyName = $arrOfficeInfo['agencyName'];
		$strAgencyName = strtoupper($tstrAgencyName);
		$agencyAdd = $arrOfficeInfo['address'];
		
		//  get combo box current date 
		$curDate = date("Y-m-d");
		$strYear = date("Y", strtotime($curDate)); 
		$strMonth = date("n", strtotime($curDate));
		$strMonthFull = $this->intToMonthFull($strMonth);
		$strDay = date("d", strtotime($curDate));
		$strDateOfSigning = $strMonthFull." ".$strDay." ,  ".$strYear;
		
		//  get agency director or head
		$objAgencyHead = mysql_query("SELECT tblSignatory.signatory
									   FROM tblSignatory
									  WHERE tblSignatory.designation = 'Director'");	
		$arrAgencyHeadName = mysql_fetch_array($objAgencyHead);
		$strAgencyHeadName = $arrAgencyHeadName['signatory'];
		$strSignedMonth = $this->intToMonthFull($_SESSION['sesMonth']);
		$strSignedYearDay = $strPublishedMonth." ".$_SESSION['sesDay']. " , ".$_SESSION['sesYear'];

		//  get employee prev item number
		$objEmpPrevItemNumber = mysql_query("SELECT tblEmpPosition.positionCode, tblEmpPosition.itemNumber,
												tblPlantilla.itemNumber
											FROM tblEmpPosition
											INNER JOIN tblPlantilla
												ON tblEmpPosition.itemNumber = tblPlantilla.itemNumber
											WHERE tblEmpPosition.itemNumber = '".$_SESSION['sesPrevItemNumber']."' ");
		$arrEmpPrevItemNumber = mysql_fetch_array($objEmpPrevItemNumber);
		$strPrevItemNumber = $arrEmpPrevItemNumber['itemNumber'];


		//	get division chief/supervisor surname, firstname, middlename and number on tblDivision
		$objChiefName = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname,
										tblEmpPersonal.firstname, tblEmpPersonal.middlename,
										tblEmpPosition.divisionCode, tblDivision.divisionHead,
										tblDivision.divisionName, tblDivision.divisionHeadTitle
									FROM tblEmpPersonal
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblDivision
											ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									WHERE tblEmpPosition.empNumber = '".$_SESSION['sesEmpNum']."'
										AND tblDivision.divisionCode = '".$_SESSION['sesDivision']."'
									ORDER BY tblEmpPersonal.firstname, tblEmpPersonal.middlename,
										tblEmpPersonal.surname");
		
		$arrChiefName = mysql_fetch_array($objChiefName);

		$strChiefNumber = $arrChiefName['empNumber'];
		$strChiefSurname = $arrChiefName['surname'];
		$strChiefFirstname = $arrChiefName['firstname'];
		$strChiefMiddlename = $arrChiefName['middlename'];
		$strChiefMiddleInitial = substr($strChiefMiddlename,0,1);
		$strDivisionCode = $arrChiefName['divisionCode'];
		$strDivisionName = $arrChiefName['divisionName'];
		$strDivisionHead = $arrChiefName['divisionHead'];
		
			
		//  get employee surname, firstname, middlename and number
		$objEmpName = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									  tblEmpPersonal.firstname, tblEmpPersonal.middlename
								FROM tblEmpPersonal
								WHERE tblEmpPersonal.empNumber = '".$_SESSION['sesEmpNum']."'
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname");
		
	
		$intCounter = 0;
		while($arrEmpName = mysql_fetch_array($objEmpName))
		{
		  	$intCounter++;
			$strEmpNumber = $arrEmpName['empNumber'];
			$strMiddleName = $arrEmpName['middlename'];
			$strMiddleInitial = substr($strMiddleName,0,1);
			$strEmpName = $arrEmpName['surname'] . ",  " . $arrEmpName['firstname'] . " " . $arrEmpName['middlename']; 
			$strEmpFullName = $arrEmpName['firstname'] . " " . $strMiddleInitial . ".  " . $arrEmpName['surname']; 
	
			$this->printBody($intCounter, $strEmpNumber, $strEmpFullName, $strEmpName, $strAgencyName, $strAgencyHeadName, $strPrevItemNumber, $strDateOfSigning, $strDivisionHead);
		}
		$this->objRprt->Output();
	}
				

}  // End Class

?>