<?
/* 
File Name: ReportHeaderFooter.php 
----------------------------------------------------------------------
Purpose of this file: 
Header footer blank
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 15, 2004
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


//define('FPDF_FONTPATH','../hrmis/class/font/');
//require('../hrmis/class/fpdf.php');

class ReportHeaderFooter extends FPDF
{
	//Page header
	function Header()
	{
		$this->Ln(33);
	}
	
	//Page footer
	function Footer()
	{
/*		//Position at 1.5 cm from bottom, and right
		$this->SetXY( -15, -15);
		$intY = $this->GetY();
		$intX = $this->GetX();		
		//draw a line
		$this->SetLineWidth(0.5);				
		$this->Line(15, $intY, $intX, $intY);
		//Arial italic 8
		$this->SetFont('Arial','B',10);
		//Page number
		$this->Cell(0, 10,'Page '.$this->PageNo().' of {nb}',0,0,'R'); */
	}
}
?>