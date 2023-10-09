<?
/* 
File Name: PrintMonthlySeparationReport.php
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
Date of Revision: May 16, 2004
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
session_cache_limiter('private_no_expire'); 
require_once("../hrmis/class/General.php");
require('../hrmis/class/ReportMSBody.php');

$objMRS = new ReportMonthlySeparation('L','mm', 'Legal');
$objMRS->Open();
$objMRS->AliasNbPages();
$objMRS->AddPage();
$objMRS->printPreview($strEmpNum ,$strEmpName, $strBirthday,$strPositionDesc,$strAppointmentDesc,$strSGNumber, $strStatusOfAppointment, $strPositionDate);
$objMRS->Output();

?>