<?
/* 
File Name: ReportPersonnelPlantilla.php (class folder)
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
define('FPDF_FONTPATH','../hrmis/class/font/');
require_once("../hrmis/class/fpdf.php");

class ReportPersonnelPlantilla extends FPDF
{
	
	var $strTitle;
	var $intPageNo;
	var $strMonthName, $intYear;

	//  Page Header
	function ReportPersonnelPlantilla()
	{
		$this->FPDF('L', 'mm', 'Legal');
	}

	function Header()
	{	

		$InterLigne = 4;

		$this->SetFont('Arial','B',10);
		$this->Cell(0,2,'Republic of the Philippines', 0, 0, 'C');
		$this->Ln(4);
		$this->Cell(0,0,'Department of Budget and Management', 0, 0, 'C');
		$this->Ln(4);
		$this->Cell(0,2,'PERSONAL SERVICES ITEMIZATION AND PLANTILLA OF PERSONNEL (PSIPOP)', 0, 0, 'C');
		$this->Ln(4);
		$this->Cell(0,2,'for the Fiscal Year '. " '" . date("Y"),0, 0, 'C');
		$this->Ln(4);
		
		$this->intPageNo = $this->PageNo();
		
		$this->Cell($Ligne,$InterLigne,'Page ' .$this->intPageNo . ' of {nb} pages',0,0,R);
		$this->Ln(4);

		$this->Cell(180,$InterLigne,'',LTR,0,L);
		$this->Cell(170,$InterLigne,'',LTR,0,L);
		$this->Ln(4);

		$this->Cell(180,$InterLigne,'Department:',LR,0,L);
		$this->Cell(170,$InterLigne,'Bureau/Agency:',LR,0,L);
		$this->Ln(4);

		$this->Cell(25,$InterLigne,'',L,0,L);
		$this->Cell(155,$InterLigne,'Department of Science and Technology',R,0,L);
		$this->Cell(20,$InterLigne,'',L,0,L);
		$this->Cell(150,$InterLigne,'Science and Technology Information Institute',R,0,L);
		$this->Ln(4);

		$this->Cell(180,$InterLigne,' ',LR,0,L);
		$this->Cell(170,$InterLigne,' ',LR,0,L);
		$this->Ln(4);

		//  first line (sub-header)
		$this->SetFont('Arial','B',7);
		$this->Cell(40,$InterLigne,' ',LT,0,C);				//  Item Number
		$this->Cell(45,$InterLigne,' ',LT,0,C);				//  Position Title and Salary Grade
		$this->Cell(40,$InterLigne,'ANNUAL SALARY',1,0,C);	//  Annual Salary - Authorized
		$this->Cell(5,$InterLigne,' ',LT,0,C);				//  Step
		$this->Cell(20,$InterLigne,'AREA',1,0,C);			//  Area - Code
		$this->Cell(5,$InterLigne,' ',LT,0,C);				//  LVL
		$this->Cell(25,$InterLigne,' ',LT,0,C);				//  P/P/A/ Attribution
		//  Second Column
		$this->Cell(50,$InterLigne,' ',LT,0,C);				//  Name of Incumbent
		$this->Cell(5,$InterLigne,' ',LT,0,C);				//  Sex
		$this->Cell(20,$InterLigne,' ',LT,0,C);				//  Date of Birth
		$this->Cell(20,$InterLigne,' ',LT,0,C);				//  TIN
		$this->Cell(20,$InterLigne,' ',LT,0,C);				//  Date of Original Appointment
		$this->Cell(20,$InterLigne,' ',LT,0,C);				//  Date of Last Promotion
		$this->Cell(10,$InterLigne,' ',LT,0,C);				//  Status
		$this->Cell(25,$InterLigne,' ',LTR,0,C);			//  Civil Service Eligibility
		$this->Ln(4);
		
		//  second line (sub-header)
		$this->Cell(40,$InterLigne,' ',L,0,C);				//  Item Number
		$this->Cell(45,$InterLigne,' ',L,0,C);				//  Position Title and Salary Grade
		$this->Cell(20,$InterLigne,' ',LR,0,C);				//  Annual Salary - Authorized
		$this->Cell(20,$InterLigne,' ',LR,0,C);				//  Annual Salary - Authorized
		$this->Cell(5,$InterLigne,'S',L,0,C);				//  Step
		$this->Cell(10,$InterLigne,'C',LR,0,C);				//  Area - Code
		$this->Cell(10,$InterLigne,'T',LR,0,C);				//  Area - Code
		$this->Cell(5,$InterLigne,'L',L,0,C);				//  LVL
		$this->Cell(25,$InterLigne,' ',L,0,C);				//  P/P/A/ Attribution
		//  Second Column
		$this->Cell(50,$InterLigne,' ',L,0,C);				//  Name of Incumbent
		$this->Cell(5,$InterLigne,'S',L,0,C);				//  Sex
		$this->Cell(20,$InterLigne,'DATE OF',L,0,C);		//  Date of Birth
		$this->Cell(20,$InterLigne,'',L,0,C);				//  TIN
		$this->Cell(20,$InterLigne,'DATE OF',L,0,C);		//  Date of Original Appointment
		$this->Cell(20,$InterLigne,'DATE OF',L,0,C);		//  Date of Last Promotion
		$this->Cell(10,$InterLigne,'S',L,0,C);				//  Status
		$this->Cell(25,$InterLigne,' ',LR,0,C);				//  Civil Service Eligibility
		$this->Ln(3);

		//  third line (sub-header)
		$this->Cell(40,$InterLigne,'ITEM NUMBER',L,0,C);				//  Item Number
		$this->Cell(45,$InterLigne,'POSITION TITLE and SALARY GRADE',L,0,C);	//  Position Title and Salary Grade
		$this->Cell(20,$InterLigne,' ',LR,0,C);						//  Annual Salary - Authorized
		$this->Cell(20,$InterLigne,' ',LR,0,C);						//  Annual Salary - Authorized
		$this->Cell(5,$InterLigne,'T',L,0,C);						//  Step
		$this->Cell(10,$InterLigne,'O',LR,0,C);						//  Area - Code
		$this->Cell(10,$InterLigne,'Y',LR,0,C);						//  Area - Code
		$this->Cell(5,$InterLigne,'V',L,0,C);						//  LVL
		$this->Cell(25,$InterLigne,'P/P/A ATTRIBUTION ',L,0,C);		//  P/P/A/ Attribution
		//  Second Column
		$this->Cell(50,$InterLigne,' ',L,0,C);						//  Name of Incumbent
		$this->Cell(5,$InterLigne,'E',L,0,C);						//  Sex
		$this->Cell(20,$InterLigne,'BIRTH',L,0,C);					//  Date of Birth
		$this->Cell(20,$InterLigne,'TIN',L,0,C);					//  TIN
		$this->Cell(20,$InterLigne,'ORIGINAL',L,0,C);				//  Date of Original Appointment
		$this->Cell(20,$InterLigne,'LAST',L,0,C);					//  Date of Last Promotion
		$this->Cell(10,$InterLigne,'T',L,0,C);						//  Status
		$this->Cell(25,$InterLigne,' ',LR,0,C);						//  Civil Service Eligibility
		$this->Ln(3);

		//  fourth line (sub-header)
		$this->Cell(40,$InterLigne,' ',L,0,C);				//  Item Number
		$this->Cell(45,$InterLigne,' ',L,0,C);				//  Position Title and Salary Grade
		$this->Cell(20,$InterLigne,' ',LR,0,C);				//  Annual Salary - Authorized
		$this->Cell(20,$InterLigne,' ',LR,0,C);				//  Annual Salary - Authorized
		$this->Cell(5,$InterLigne,'E',L,0,C);				//  Step
		$this->Cell(10,$InterLigne,'D',LR,0,C);				//  Area - Code
		$this->Cell(10,$InterLigne,'P',LR,0,C);				//  Area - Code
		$this->Cell(5,$InterLigne,'L',L,0,C);				//  LVL
		$this->Cell(25,$InterLigne,' ',L,0,C);				//  P/P/A/ Attribution
		//  Second Column
		$this->Cell(50,$InterLigne,' ',L,0,C);				//  Name of Incumbent
		$this->Cell(5,$InterLigne,'X',L,0,C);				//  Sex
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  Date of Birth
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  TIN
		$this->Cell(20,$InterLigne,'APPOINT-',L,0,C);		//  Date of Original Appointment
		$this->Cell(20,$InterLigne,'PROMO-',L,0,C);			//  Date of Last Promotion
		$this->Cell(10,$InterLigne,'A',L,0,C);				//  Status
		$this->Cell(25,$InterLigne,'CIVIL',LR,0,C);			//  Civil Service Eligibility
		$this->Ln(3);

		//  fifth line (sub-header)
		$this->Cell(40,$InterLigne,' ',L,0,C);				//  Item Number
		$this->Cell(45,$InterLigne,' ',L,0,C);				//  Position Title and Salary Grade
		$this->Cell(20,$InterLigne,' ',LR,0,C);				//  Annual Salary - Authorized
		$this->Cell(20,$InterLigne,' ',LR,0,C);				//  Annual Salary - Authorized
		$this->Cell(5,$InterLigne,'P',L,0,C);				//  Step
		$this->Cell(10,$InterLigne,'E',LR,0,C);				//  Area - Code
		$this->Cell(10,$InterLigne,'E',LR,0,C);				//  Area - Code
		$this->Cell(5,$InterLigne,' ',L,0,C);				//  LVL
		$this->Cell(25,$InterLigne,' ',L,0,C);				//  P/P/A/ Attribution
		//  Second Column
		$this->Cell(50,$InterLigne,' ',L,0,C);				//  Name of Incumbent
		$this->Cell(5,$InterLigne,' ',L,0,C);				//  Sex
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  Date of Birth
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  TIN
		$this->Cell(20,$InterLigne,'MENT',L,0,C);			//  Date of Original Appointment
		$this->Cell(20,$InterLigne,'TION',L,0,C);			//  Date of Last Promotion
		$this->Cell(10,$InterLigne,'T',L,0,C);				//  Status
		$this->Cell(25,$InterLigne,'ELIGIBILITY',LR,0,C);	//  Civil Service Eligibility
		$this->Ln(3);

		//  sixth line (sub-header)
		$this->Cell(40,$InterLigne,' ',L,0,C);				//  Item Number
		$this->Cell(45,$InterLigne,' ',L,0,C);				//  Position Title and Salary Grade
		$this->Cell(20,$InterLigne,' ',LR,0,C);				//  Annual Salary - Authorized
		$this->Cell(20,$InterLigne,' ',LR,0,C);				//  Annual Salary - Authorized
		$this->Cell(5,$InterLigne,' ',L,0,C);				//  Step
		$this->Cell(10,$InterLigne,' ',LR,0,C);				//  Area - Code
		$this->Cell(10,$InterLigne,' ',LR,0,C);				//  Area - Code
		$this->Cell(5,$InterLigne,' ',L,0,C);				//  LVL
		$this->Cell(25,$InterLigne,' ',L,0,C);				//  P/P/A/ Attribution
		//  Second Column
		$this->Cell(50,$InterLigne,' ',L,0,C);				//  Name of Incumbent
		$this->Cell(5,$InterLigne,' ',L,0,C);				//  Sex
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  Date of Birth
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  TIN
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  Date of Original Appointment
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  Date of Last Promotion
		$this->Cell(10,$InterLigne,'U',L,0,C);				//  Status
		$this->Cell(25,$InterLigne,' ',LR,0,C);				//  Civil Service Eligibility
		$this->Ln(3);

		//  seventh line (sub-header)
		$this->Cell(40,$InterLigne,' ',L,0,C);				//  Item Number
		$this->Cell(45,$InterLigne,' ',L,0,C);				//  Position Title and Salary Grade
		$this->Cell(20,$InterLigne,' ',LR,0,C);				//  Annual Salary - Authorized
		$this->Cell(20,$InterLigne,' ',LR,0,C);				//  Annual Salary - Authorized
		$this->Cell(5,$InterLigne,' ',L,0,C);				//  Step
		$this->Cell(10,$InterLigne,' ',LR,0,C);				//  Area - Code
		$this->Cell(10,$InterLigne,' ',LR,0,C);				//  Area - Code
		$this->Cell(5,$InterLigne,' ',L,0,C);				//  LVL
		$this->Cell(25,$InterLigne,' ',L,0,C);				//  P/P/A/ Attribution
		//  Second Column
		$this->Cell(50,$InterLigne,' ',L,0,C);				//  Name of Incumbent
		$this->Cell(5,$InterLigne,' ',L,0,C);				//  Sex
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  Date of Birth
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  TIN
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  Date of Original Appointment
		$this->Cell(20,$InterLigne,' ',L,0,C);				//  Date of Last Promotion
		$this->Cell(10,$InterLigne,'S',L,0,C);				//  Status
		$this->Cell(25,$InterLigne,' ',LR,0,C);				//  Civil Service Eligibility
		$this->Ln(4);

		//  eight line (sub-header)
		$this->Cell(40,$InterLigne,'(1)',LB,0,C);				//  Item Number
		$this->Cell(45,$InterLigne,'(2)',LB,0,C);				//  Position Title and Salary Grade
		$this->Cell(20,$InterLigne,'(3)',LBR,0,C);				//  Annual Salary - Authorized
		$this->Cell(20,$InterLigne,'(4)',LBR,0,C);				//  Annual Salary - Authorized
		$this->Cell(5,$InterLigne,'(5)',LB,0,C);				//  Step
		$this->Cell(10,$InterLigne,'(6)',LBR,0,C);				//  Area - Code
		$this->Cell(10,$InterLigne,'(7)',LBR,0,C);				//  Area - Code
		$this->Cell(5,$InterLigne,'(8)',LB,0,C);				//  LVL
		$this->Cell(25,$InterLigne,'(9)',LB,0,C);				//  P/P/A/ Attribution
		//  Second Column
		$this->Cell(50,$InterLigne,'(10)',LB,0,C);				//  Name of Incumbent
		$this->Cell(5,$InterLigne,'(11)',LB,0,C);				//  Sex
		$this->Cell(20,$InterLigne,'(12)',LB,0,C);				//  Date of Birth
		$this->Cell(20,$InterLigne,'(13)',LB,0,C);				//  TIN
		$this->Cell(20,$InterLigne,'(14)',LB,0,C);				//  Date of Original Appointment
		$this->Cell(20,$InterLigne,'(15)',LB,0,C);				//  Date of Last Promotion
		$this->Cell(10,$InterLigne,'(16)',LB,0,C);				//  Status
		$this->Cell(25,$InterLigne,'(17)',LBR,0,C);				//  Civil Service Eligibility
		$this->Ln(4);

	}	//  end of function header
	
	function Footer()
	{
		$InterLigne = 4;

		
		$this->Cell(105,$InterLigne,'',LTR,0,L);
		$this->Cell(245,$InterLigne,'',LTR,0,L);
		$this->Ln(2);

		$this->Cell(105,$InterLigne,'Department of Budget and Management',LR,0,L);
		$this->Cell(245,$InterLigne,'I certify to the correctness of the entries from columns 4 to 17 and that employees',LR,0,L);
		$this->Ln(3);

		$this->Cell(105,$InterLigne,'',LR,0,L);
		$this->Cell(245,$InterLigne,'whose names appear on the above PSIPOP are the incumbents of the positions.',LR,0,L);
		$this->Ln(4);

		$this->Cell(105,$InterLigne,'',LR,0,L);
		$this->Cell(245,$InterLigne,'',LR,0,L);
		$this->Ln(4);

		$this->Cell(105,$InterLigne,'',LR,0,C);
		$this->Cell(15,$InterLigne,'',0,0,C);
		$this->Cell(65,$InterLigne,'______________________________________',0,0,C);
		$this->Cell(15,$InterLigne,'',0,0,C);
		$this->Cell(65,$InterLigne,'____________________',0,0,C);
		$this->Cell(15,$InterLigne,'',0,0,C);
		$this->Cell(65,$InterLigne,'____________________',0,0,C);
		$this->Cell(5,$InterLigne,'',R,0,C);
		$this->Ln(4);
	
		$this->Cell(105,$InterLigne,'',LBR,0,C);
		$this->Cell(15,$InterLigne,'',B,0,C);
		$this->Cell(65,$InterLigne,'Human Resource Management Officer',B,0,C);
		$this->Cell(15,$InterLigne,'',B,0,C);
		$this->Cell(65,$InterLigne,'Date',B,0,C);
		$this->Cell(15,$InterLigne,'',B,0,C);
		$this->Cell(65,$InterLigne,'Head Of Agency',B,0,C);
		$this->Cell(5,$InterLigne,'',BR,0,C);
		$this->Ln(4);

	}	//  end of function footer
	
	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
	}
	
	
	function setMonthYear($t_strMonthName,$t_intDay, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
		$this->intDay = $t_intDay;
	}
	
	function setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum)
	{
		$objOfficeInfo = mysql_query("SELECT tblAgency.agencyName, tblAgency.address, tblAgency.telephone
									  FROM tblAgency");
		$arrOfficeInfo = mysql_fetch_array($objOfficeInfo);
		$strAgencyName = $arrOfficeInfo['agencyName'];
		$t_strAgencyName = strtoupper($strAgencyName);
		$this->agencyName = $t_strAgencyName;
		$this->agencyAdd = $arrOfficeInfo['address'];
		$this->agencyNum = $arrOfficeInfo['telephone'];
	}
	
} //end of class
	
?>