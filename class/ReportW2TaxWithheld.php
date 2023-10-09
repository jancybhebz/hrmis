<?
/* 
File Name: ReportW2TaxWithheld.php
----------------------------------------------------------------------
Purpose of this file: 
Class General
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl Samoy Dy Tioco, Joanne D. Gamboa
----------------------------------------------------------------------
Date of Revision: October 01, 2004
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


class ReportW2TaxWithheld extends FPDF
{

	
	function ReportW2TaxWithheld()
	{
		$this->FPDF('P','mm','Legal');
		
	}
	
	function setMonthYear($t_intYear, $t_intPeriod)
	{
		
		$this->intYear = $t_intYear;
		if($t_intPeriod == 1)
		{
			$this->intPeriod = "January - June"; 
		}
		else if($t_intPeriod == 2)
		{
			$this->intPeriod = "July - December";
		}
	}
				


}	// end class
?>