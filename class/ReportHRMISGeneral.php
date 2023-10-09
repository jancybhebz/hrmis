<?
/* 
File Name: ReportHRMISGeneral.php
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
Date of Revision: October 24, 2004 (Version 1.0.0)
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

require("../hrmis/class/General.php");
require("../hrmis/class/Constant.php");
require('../hrmis/class/ReportMSBody.php');			//  Monthly Separation
require('../hrmis/class/ReportPIBody.php');			//  Personnel Information
require('../hrmis/class/ReportPABody.php');			//   Personnel Action
require('../hrmis/class/ReportAFBody.php');			//   Appointment Form
require('../hrmis/class/ReportCBBody.php');			//   Capability Building
require('../hrmis/class/ReportLPBody.php');			//   Longevity Pay
require('../hrmis/class/ReportPPBody.php');			//   Personnel Plantilla
require('../hrmis/class/ReportPEBody.php');			//   List of Employee by Educational Attainment
require('../hrmis/class/ReportPDHBody.php');		//   List of Employee by Date/Year hired
require('../hrmis/class/ReportPSGBody.php');		//   List of Employee by Salary Grade
require('../hrmis/class/ReportPDFBody.php');		//   Position Description Form
require('../hrmis/class/ReportPBDBody.php');		//   List of Employees birthday
require('../hrmis/class/ReportPAGEBody.php');		//   List of Employee by age
require('../hrmis/class/ReportPSBody.php');			//   List of Employees by sex
require('../hrmis/class/ReportPRBody.php');			//   List of employees by Date/Year Retired
require('../hrmis/class/ReportPRSBody.php');		//   List of employees by Date/Year Resigned
require('../hrmis/class/ReportEPDBody.php');		//   Employee/s Personal Data Sheet
require('../hrmis/class/ReportMABody.php');  		//   Monthly Accession Report
require('../hrmis/class/ReportCSCPCABody.php');  	//   Plantilla of Casual Appointment (CSC Format)


class ReportHRMISGeneral extends General
{
	function printPreview()
	{	
		if($_SESSION['sesReport'] == 'MRS')
		{
			$objRprt = new ReportMSBody;				//  Monthly Separation
		}
		elseif($_SESSION['sesReport'] == 'RPI')
		{
			$objRprt = new ReportPIBody;				//  Personnel Information
		}
		elseif($_SESSION['sesReport'] == 'RPA')
		{
			$objRprt = new ReportPABody;				//   Personnel Action
		}
		elseif($_SESSION['sesReport'] == 'RAF')
		{
			$objRprt = new ReportAFBody;				//   Appointment Form
		}
		elseif($_SESSION['sesReport'] == 'RCB')
		{
			$objRprt = new ReportCBBody;				//   Capability Building
		}
		elseif($_SESSION['sesReport'] == 'RLP')
		{
			$objRprt = new ReportLPBody;				//   Longevity Pay
		}
		elseif($_SESSION['sesReport'] == 'RPP')
		{
			$objRprt = new ReportPPBody;				//   Personnel Plantilla
		}
		elseif($_SESSION['sesReport'] == 'RPE')
		{
			$objRprt = new ReportPEBody;				//   List of Employee by Educational Attainment
		}
		elseif($_SESSION['sesReport'] == 'RPDH')
		{
			$objRprt = new ReportPDHBody;				//   List of Employee by Date/Year hired
		}
		elseif($_SESSION['sesReport'] == 'RPSG')
		{
			$objRprt = new ReportPSGBody;				//   List of Employee by Salary Grade
		}
		elseif($_SESSION['sesReport'] == 'RPDF')
		{
			$objRprt = new ReportPDFBody;				//   Position Description Form
		}
		elseif($_SESSION['sesReport'] == 'RPBD')
		{
			$objRprt = new ReportPBDBody;				//   List of Employees birthday
		}
		elseif($_SESSION['sesReport'] == 'RPAGE')
		{
			$objRprt = new ReportPAGEBody;				//   List of Employee by age
		}
		elseif($_SESSION['sesReport'] == 'RPS')
		{
			$objRprt = new ReportPSBody;				//   List of Employees by sex
		}
		elseif($_SESSION['sesReport'] == 'RPR')
		{
			$objRprt = new ReportPRBody;				//   List of employees by Date/Year Retired
		}
		elseif($_SESSION['sesReport'] == 'RPRS')
		{
			$objRprt = new ReportPRSBody;				//   List of employees by Date/Year Resigned
		}
		elseif($_SESSION['sesReport'] == 'EPD')
		{
			$objRprt = new ReportEPDBody;				//	 Employees Personal Data 
		}
		elseif($_SESSION['sesReport'] == 'RMA')
		{
			$objRprt = new ReportMABody;
		}
		elseif($_SESSION['sesReport'] == 'CSCPCA')		//  CSC Plantilla of Casual Appointment
		{
			$objRprt = new ReportCSCPCABody;
		}
		$objRprt->generateReport();
	}
}
?>
