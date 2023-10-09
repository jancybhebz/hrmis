<?
/* 
File Name: ReportPABody.php (class folder)
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
require('../hrmis/class/ReportPersonnelAction.php');

class ReportPABody extends General
{
	var $objRprt;
	var $intCounter = 0;

	
	//  Body
	function printBody()
	{
		$InterLigne = 6;
		$Border = 5;
		$Ligne = 50;

		$this->objRprt->SetFont(Arial,'B',7);
		$this->objRprt->Cell(15,$InterLigne,"2004-05-04",LR,0,C);			//  date (issued)
		$this->objRprt->Cell(17,$InterLigne,"2004-05-04",R,0,C);			//  date (of effectivity)
		$this->objRprt->Cell(30,$InterLigne,"Roasa, Rogelio N.",R,0,L);		//  name of appointee
		$this->objRprt->Cell(25,$InterLigne,"SVSRS",R,0,C);					//  position title
		$this->objRprt->Cell(25,$InterLigne,"STII-SVSRS-5-1998",R,0,C);		//  item number
		$this->objRprt->Cell(12,$InterLigne,"22",R,0,C);					//  salary grade
		$this->objRprt->Cell(13,$InterLigne,"Permanent",R,0,C);				//  appointment (status)
		$this->objRprt->Cell(13,$InterLigne,"Promotion",R,0,C);				//  appointment (nature)
		$this->objRprt->Cell(15,$InterLigne,"2004-01-10",R,0,C);			//  published (date)
		$this->objRprt->Cell(20,$InterLigne,"Manila Standard",R,0,C);		//  published (where)
		$this->objRprt->Cell(17,$InterLigne,"B.S.Aerospace",R,0,C);			//  education
		$this->objRprt->Cell(17,$InterLigne,"14 yrs",R,0,C);				//  experience
		$this->objRprt->Cell(14,$InterLigne,"500 hrs.",R,0,C);				//  training
		$this->objRprt->Cell(13,$InterLigne,"CS. Prof.",R,0,C);				//  title
		$this->objRprt->Cell(14,$InterLigne,"1996-08-05",R,0,C);			//  date
		$this->objRprt->Cell(15,$InterLigne,"Quezon City",R,0,C);			//  place
		$this->objRprt->Cell(10,$InterLigne,"82.3",R,0,C);					//  rating
		$this->objRprt->Cell(15,$InterLigne,"1968-11-05",R,0,C);			//  date of birth
		$this->objRprt->Cell(15,$InterLigne,"Manila",R,0,C);				//  place of birth
		$this->objRprt->Cell(17,$InterLigne," ",R,0,C);						//  action taken by RO/FO/PO
		$this->objRprt->Cell(18,$InterLigne," ",R,0,C);						//  deviation noted/remarks
		$this->objRprt->Ln(5);
	}


	function generateReport()
	{
		$this->objRprt = new ReportPersonnelAction;
		$strMonthName = $this->intToMonthFull($_SESSION['sesMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesYear']);
		//$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(3);
		$this->objRprt->SetRightMargin(2);
		$this->objRprt->SetTopMargin(10);
		$this->objRprt->SetAutoPageBreak("on",55);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		$this->printBody();
		$this->objRprt->Output();
	}
				

}  // End Class

?>