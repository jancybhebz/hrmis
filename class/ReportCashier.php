<?
/* 
File Name: Report.php
----------------------------------------------------------------------
Purpose of this file: 
Class report
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: December 18, 2003
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

require('../hrmis/class/ReportGenerate.php');

class ReportCashier extends General
{
	var $objRprt;
	
	function reportCashier()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection
	}
	
	function reportPreview($t_intHeadFoot=1 ,$t_strRprtType, $t_strEmpNmbr='', $t_intMonth='', $t_intYear='')
	{
		$blnCmprRslt = $this->compareReport($t_strRprtType);
		if($blnCmprRslt)
		{
			$this->objRprt = new ReportGenerate;
			$this->objRprt->reportPreview($t_intHeadFoot, $t_strRprtType, $t_strEmpNmbr, $t_intMonth, $t_intYear);
		}
		else
		{
			$this->plymrphObjct($t_intHeadFoot);	
			$this->objRprt->SetLeftMargin(15);
			$this->objRprt->SetRightMargin(15);		
			
			$this->objRprt->Open();
			$this->objRprt->AliasNbPages();
			$this->empInfo($t_strRprtType, $t_strEmpNmbr, $t_intMonth, $t_intYear);
			$this->objRprt->Output();
		}
	}
	
	function compareReport($t_strRprtType)
	{
		$arrRprt = array( 0=>"CEC", 1=>"CU", 2=>"DR", 3=>"AC", 4=>"CA",
						5=>"EL", 6=>"SR", 7=>"LT", 8=>"LB", 9=>"DTR", 10=>"PS"
					);
		
		$blnCmpr = 0;
		for($intCount=0; $intCount<=10; $intCount++)
		{
			$blnCmprRprt = $t_strRprtType == $arrRprt[$intCount];
			$blnCmpr = $blnCmpr || $blnCmprRprt;
		}
		
		return $blnCmpr;
	}
	
	function plymrphObjct($t_intHeadFoot)
	{
		if($t_intHeadFoot == 1)
		{
			$this->objRprt = new ReportHeaderFooter;
		}
		else
		{
			$this->objRprt= new FPDF;
		}	
	}

}
?>