<?
/* 
File Name: ReportPIBody.php (class folder)
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
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportCapabilityBuilding.php');

class ReportCBBody extends General
{
	var $objRprt;
	var $intCounter = 0;

	// Body
	function printBody()
	{
		$InterLigne = 7;
		
		$this->objRprt->SetFont(Arial,'',8);
		$this->objRprt->Cell(20,$InterLigne,"Planning",0,0,L);					//  Type of Activity
		$this->objRprt->Cell(50,$InterLigne,"DOST-ICT Planning",0,0,L);			//  Title of Activity
		$this->objRprt->Cell(50,$InterLigne,"Team Building",0,0,L);				//  Subject Matter
		$this->objRprt->Cell(30,$InterLigne,"2004-05-15",0,0,C);				//  Venue/Date
		$this->objRprt->Cell(40,$InterLigne,"STII-ITD",0,0,L);					//  Organizing Group
		$this->objRprt->Cell(60,$InterLigne,"Catorce, Edgardo P.",0,0,L);		//  Name of Personnel Involved
		$this->objRprt->Cell(30,$InterLigne,"ITD",0,0,C);						//  Division/Dept.
		$this->objRprt->Cell(30,$InterLigne,"9,000.00",0,0,L);					//  Cost of Training
		$this->objRprt->Cell(30,$InterLigne,"Budget",0,0,L);					//  Source of Funds
		$this->objRprt->Ln(5);
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportCapabilityBuilding;
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesYear']);
		//$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(10);
		$this->objRprt->SetRightMargin(00);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on",25);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		$this->printBody();
		$this->objRprt->Output();
	}
				

}  // End Class

?>