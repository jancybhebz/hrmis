<?
/* 
File Name: General.php
----------------------------------------------------------------------
Purpose of this file: 
Class General
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: October 8, 2003
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

define('FPDF_FONTPATH','../hrmis/class/font/');
require_once('../hrmis/class/fpdf.php');

class ReportABonus extends FPDF
{
	var $objRprtCmn;
	//Page header
	function Header()
	{	
		$this->SetFont('Arial','B',10);
		$this->Cell(0,4,'Republic of the Philippines', 0, 1, 'C');
		$this->Cell(0,4,'Science and Technology Information Institue', 0, 1, 'C');
		$this->Cell(0,4,'Bicutan Taguig, Metro Manila', 0, 1, 'C');
		$this->Ln(5);	
		
		$this->SetFont('Arial','',11);
		$this->Cell(0,5,'PAYROLL REGISTER FOR ADDITIONAL BONUS FOR CY 2003', 0, 1, 'C');
		$this->Ln(1);
		$this->Cell(0,5,'For REGULAR Employees', 0, 1, 'C');
		$this->Ln(5);

		$this->SetFont('Arial','',9);
		$this->Cell(0,5,'Sheet 1 of 2', 0, 1, 'R');
		
		$this->SetFont('Arial','',9);
		$this->Cell(25,2,'Project Name: ', 0, 0, 'L');
		$this->SetFont('Arial','B',9);
		$this->Cell(0,2,' AI.A.1', 0, 0, 'L');
		$this->Ln(5);

		$this->SetFont('Arial','',9);
		$this->Cell(25,2,'Divsion Name: ', 0, 0, 'L');
		$this->SetFont('Arial','B',9);
		$this->Cell(0,2,' OFFICE OF THE DIRECTOR', 0, 0, 'L');
		$this->Ln(7);
						
		$this->SetFont('Arial','B',9);
		$this->SetFillColor(200,200,200);
		$this->Cell(15,4,'EMP #', 0, 0, 'L',1);
		$this->Cell(30,4,'POSITION', 0, 0, 'L',1);		
		$this->Cell(50,4,'EMPLOYEE NAME', 0, 0, 'L',1);
		$this->Cell(30,4,'ADDITIONAL', 0, 0, 'C',1);
		$this->Cell(0,4,'SIGNATURE', 0, 1, 'L',1);		

		$this->Cell(15,4,'', 0, 0, 'L',1);
		$this->Cell(30,4,'', 0, 0, 'L',1);		
		$this->Cell(50,4,'', 0, 0, 'L',1);
		$this->Cell(30,4,'BONUS', 0, 0, 'C',1);
		$this->Cell(0,4,'', 0, 0, 'L',1);		
		$this->Ln(7);
	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-90);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',9);
		$this->Cell(95,5,'Page Total:', 0, 0, 'R',1);
		$this->Cell(30,5,'20,400.00', 0, 0, 'R',1);
		$this->Cell(0,5,'', 0, 1, 'L',1);
		
		$this->SetFillColor(150,150,150);
		$this->SetFont('Arial','B',9);
		$this->Cell(95,5,'Project Total:', 0, 0, 'R',1);
		$this->Cell(30,5,'20,400.00', 0, 0, 'R',1);
		$this->Cell(0,5,'', 0, 1, 'L',1);
		$this->Ln(10);
			
		$this->SetFont('Arial','',8);
		$this->Cell(60,5,'CERTIFIED: Service duty rendered as stated.:', 0, 0, 'L');
		$this->Cell(20);
		$this->Cell(30,5,'Approved for payment:', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'                                                            ', 0, 0, 'L');
		$this->Ln(7);

		$this->SetFont('Arial','U',11);
		$this->Cell(80);
		$this->Cell(0,5,'                                                      (P                             ', 0, 0, 'L');
		$this->Ln(10);

		$this->SetFont('Arial','B',9);
		$this->Cell(60, 5, 'CRISTETA S. OLIVAR', 0, 0, 'C');
		$this->Cell(40);
		$this->Cell(0, 5, 'JOSE L. GUERRERO', 0, 0, 'L');
		$this->Ln(4);

		$this->Cell(60, 5, 'HRMIS III', 0, 0, 'C');
		$this->Cell(50);
		$this->Cell(0, 5, 'Director', 0, 0, 'L');
		$this->Ln(7);

		$this->SetFont('Arial','',8);
		$this->Cell(80,5,'CERTIFIED: Supporting documents complete', 0, 0, 'L');
		$this->Cell(70,5,'CERTIFIED: Each employee whose name appears', 0, 0, 'L');
		$this->SetFont('Arial','',8);
		$this->Cell(15,5,'ALOBS No.', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'       ', 0, 0, 'R');
		$this->Ln(3);

		$this->SetFont('Arial','',8);
		$this->Cell(80,5,'and proper and cash', 0, 0, 'L');
		$this->Cell(70,5,'above has been paid the amount indicated opposite', 0, 0, 'L');
		$this->SetFont('Arial','',8);
		$this->Cell(15,5,'Date', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'       ', 0, 0, 'R');
		$this->Ln(3);
		
		$this->Cell(80);
		$this->SetFont('Arial','',8);
		$this->Cell(70,5,'on his/her name.', 0, 0, 'L');		
		$this->Cell(15,5,'JEV No.', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'       ', 0, 0, 'R');
		$this->Ln(5);

		$this->Cell(150);
		$this->SetFont('Arial','',8);
		$this->Cell(15,5,'Date', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,5,'       ', 0, 0, 'R');
		$this->Ln(5);
		
		$this->SetFont('Arial','B',9);
		$this->Cell(60, 5, 'DIANA A. BUCAO-SANTOS', 0, 0, 'C');
		$this->Cell(25);
		$this->Cell(50, 5, 'ZENAIDA C. SANTOS', 0, 0, 'L');
		$this->Cell(0, 5, 'Date', 0, 0, 'L');
		$this->Ln(4);
		
		$this->SetFont('Arial','B',9);
		$this->Cell(60, 5, 'Accountant III', 0, 0, 'C');
		$this->Cell(35);
		$this->Cell(50, 5, 'Cashier III', 0, 0, 'L');
		
		$this->Ln(7);
	}
}
?>