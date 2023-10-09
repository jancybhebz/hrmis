<?
/* 
File Name: ReportGenerate.php 
----------------------------------------------------------------------
Purpose of this file: 
Class Generate
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: September 16, 2004
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
require('../hrmis/class/fpdf.php');

require("../hrmis/class/Attendance.php");
require("../hrmis/class/Constant.php");
require('../hrmis/class/ReportHeaderFooter.php');
require('../hrmis/class/ReportHeaderFooterLWOP.php');
require('../hrmis/class/ReportHeaderFooterTR.php');
require('../hrmis/class/ReportHeaderFooterMA.php');
require('../hrmis/class/ReportHeaderFooterMCR.php');
require('../hrmis/class/ReportHeaderFooterHPR.php');
require('../hrmis/class/ReportHeaderFooterHYA.php');
require('../hrmis/class/ReportHeaderFooterAAR.php');
require('../hrmis/class/ReportHeaderFooterAFC.php');

class ReportGenerate extends Attendance
{
	var $objRprt;
	
	function reportGenerate()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection	
	}
	
	function empInfo($t_strRprtType, $t_strEmpNmbr, $t_intMonth, $t_intYear)
	{	
		$objAgency = mysql_query("SELECT agencyName, abbreviation, address, salarySchedule FROM tblAgency");
		$arrAgency = mysql_fetch_array($objAgency);
		
		if(strlen($t_intMonth) != 0 && strlen($t_intYear) != 0)
		{
			$dtmQueryDate = $this->combineDate($t_intYear, $t_intMonth, '01');   //neded for longevity LB, DTR, PS
			$intTotalMonthDay = date('t' ,strtotime($dtmQueryDate));    //compare to longevity if equal or morethan
			$dtmQueryDate = $this->combineDate($t_intYear, $t_intMonth, $intTotalMonthDay);   //employee is included in the list
			
			$strMonthYear = $this->combineMonthYear($t_intYear, $t_intMonth);
		}
		
		if($_SESSION["empPerSelect"] == "Per Division")
		{
			$strPer = "tblEmpPosition.divisionCode";
		}
		elseif($_SESSION["empPerSelect"] == "Per Section")
		{
			$strPer = "tblEmpPosition.sectionCode";
		}
		
		if(strlen($_SESSION["empPerSelect"]) != 0 && strlen($_SESSION["divSecCode"]) != 0)
		{
			$strWhereSQL = " WHERE $strPer = '".$_SESSION["divSecCode"]."' ";
			$strAndSQL = " AND $strPer = '".$_SESSION["divSecCode"]."' ";
		}
		else
		{
			$strWhereSQL = " ";
			$strAndSQL = " ";
		}

			
		if($t_strEmpNmbr)
		{
			switch($t_strRprtType)
			{
				case "CEC":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, 
								tblEmpPosition.positionCode, tblEmpPosition.appointmentCode, tblEmpPosition.longevityDate,
								tblPosition.positionDesc, tblAppointment.appointmentDesc
							FROM tblEmpPersonal
							INNER JOIN tblEmpPosition
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblPosition
									ON tblEmpPosition.positionCode = tblPosition.positionCode
									INNER JOIN tblAppointment
										ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
							WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'
							ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

			 	case "SR":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
								tblEmpPersonal.birthday, tblEmpPersonal.birthPlace 
							FROM tblEmpPersonal
							INNER JOIN tblEmpPosition
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
							INNER JOIN tblServiceRecord 
								ON tblEmpPersonal.empNumber = tblServiceRecord.empNumber
							WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'
							ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

 				case "LT":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
								tblEmpPersonal.birthday, tblEmpPersonal.birthPlace 
							FROM tblEmpPersonal
							INNER JOIN tblEmpPosition
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
							INNER JOIN tblEmpTraining
								ON tblEmpPersonal.empNumber = tblEmpTraining.empNumber
							WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'
							ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";			
					break;
	
				case "DTR":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
								tblEmpPosition.divisionCode, tblDivision.divisionName, 
								tblDivision.divisionHead, tblDivision.divisionHeadTitle 
							FROM tblEmpPersonal 
							LEFT JOIN tblEmpPosition 
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
							INNER JOIN tblDivision
								ON tblEmpPosition.divisionCode = tblDivision.divisionCode
							WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'
									AND tblEmpPosition.longevityDate <= '$dtmQueryDate'
									AND tblEmpPosition.dtrSwitch = 'Y'
									AND tblEmpPosition.statusOfAppointment = 'In-Service'
							ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";			
					break;
				
				case "PS":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblAppointment.header, tblAppointment.leaveEntitled,
									tblAppointment.appointmentCode
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
								INNER JOIN tblEmpIncome 
									ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'
									AND tblEmpPosition.longevityDate <= '$dtmQueryDate'								
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

				case "LB":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.longevityDate, tblEmpPosition.divisionCode
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblEmpLeaveBalance
									ON tblEmpPersonal.empNumber = tblEmpLeaveBalance.empNumber								
								WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'
									AND tblEmpPosition.longevityDate <= '$dtmQueryDate'
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

				case "AS":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.divisionCode, tblAppointment.leaveEntitled
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode								
								WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

				case "EAS":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.divisionCode, tblAppointment.leaveEntitled,
									tblPosition.positionDesc, tblDivision.divisionName
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
								INNER JOIN tblPosition
									ON tblEmpPosition.positionCode = tblPosition.positionCode
								INNER JOIN tblDivision
									ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr' 
									AND tblEmpPosition.dtrSwitch = 'Y'
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;
					
				case "AR":
						$strSQL = $this->empCrtfctSql($t_strEmpNmbr);
					break;

				case "CNAC":
						$strSQL = $this->empCrtfctSql($t_strEmpNmbr);
					break;

				case "CCA":
						$strSQL = $this->empCrtfctSql($t_strEmpNmbr);
					break;

				case "CU":
						$strSQL = $this->empCrtfctSql($t_strEmpNmbr);
					break;

				case "EL":
						$strSQL = $this->empCrtfctSql($t_strEmpNmbr);
					break;
				
				case "PK":
						$strSQL = $this->empCrtfctSql($t_strEmpNmbr);
					break;

				case "ADR":
						$strSQL = $this->empCrtfctSql($t_strEmpNmbr);
					break;
					
				case "CDR":
						$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.sex,
								tblPosition.positionDesc, tblDivision.divisionName
							FROM tblEmpPersonal
							INNER JOIN tblEmpPosition
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblPosition
									ON tblEmpPosition.positionCode = tblPosition.positionCode
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
										INNER JOIN tblEmpDuties
											ON tblEmpDuties.empNumber = tblEmpPosition.empNumber
							WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'
							ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

				case "AL":
					$dtmDateFiled = $this->combineDate($_SESSION['year'], $_SESSION['month'], $_SESSION['day']);
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.middlename,
								tblEmpPosition.divisionCode, tblEmpPosition.actualSalary,
								tblEmpLeave.*, tblDivision.divisionHead, tblDivision.divisionHeadTitle,
								tblLeave.leaveType, tblPosition.positionDesc
								FROM tblEmpPersonal
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblEmpLeave
										ON tblEmpPosition.empNumber = tblEmpLeave.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblLeave
										ON tblLeave.leaveCode = tblEmpLeave.leaveCode
									INNER JOIN tblPosition
										ON tblPosition.positionCode = tblEmpPosition.positionCode
								WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr' 
									AND tblEmpLeave.dateFiled = '$dtmDateFiled'";
					break;
					
				case "PRO":
					$dtmDateFiled = $this->combineDate($_SESSION['year'], $_SESSION['month'], $_SESSION['day']);
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.middlename,
								tblEmpPosition.divisionCode, tblEmpOvertime.*, 
								tblDivision.divisionHead, tblDivision.divisionHeadTitle
								FROM tblEmpPersonal
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblEmpOvertime
										ON tblEmpPosition.empNumber = tblEmpOvertime.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode										
								WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr' 
									AND tblEmpOvertime.dateFiled = '$dtmDateFiled'";
					break;
					
				case "OB":
						$dtmDateFiled = $this->combineDate($_SESSION['year'], $_SESSION['month'], $_SESSION['day']);
						$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.divisionCode, tblEmpOB.*, 
									tblDivision.divisionHead, tblDivision.divisionHeadTitle
									FROM tblEmpPersonal
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpOB
											ON tblEmpPosition.empNumber = tblEmpOB.empNumber
										INNER JOIN tblDivision
											ON tblEmpPosition.divisionCode = tblDivision.divisionCode										
									WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr' 
										AND tblEmpOB.dateFiled = '$dtmDateFiled'";
					break;

				case "TO":
						$dtmDateFiled = $this->combineDate($_SESSION['year'], $_SESSION['month'], $_SESSION['day']);
						$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.divisionCode, tblEmpTravelOrder.*, 
									tblDivision.divisionHead, tblDivision.divisionHeadTitle
									FROM tblEmpPersonal
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpTravelOrder
											ON tblEmpPosition.empNumber = tblEmpTravelOrder.empNumber
										INNER JOIN tblDivision
											ON tblEmpPosition.divisionCode = tblDivision.divisionCode										
									WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr' 
										AND tblEmpTravelOrder.dateFiled = '$dtmDateFiled'";
					break;
				
				case "LWOP":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpLeaveBalance.vlAbsUndWoPay, tblEmpLeaveBalance.slAbsUndWoPay
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblEmpLeaveBalance 
									ON tblEmpPosition.empNumber = tblEmpLeaveBalance.empNumber
								WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr' 
									AND periodMonth='$t_intMonth' 
									AND periodYear='$t_intYear' 
									AND (tblEmpLeaveBalance.vlAbsUndWoPay > 0 
											OR tblEmpLeaveBalance.slAbsUndWoPay > 0) 
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;
				
				case "TR":
					$strSQL = $this->empCrtfctSql($t_strEmpNmbr);					
					break;
					
				case "MA":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname 
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblEmpDTR 
									ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber 
								WHERE tblEmpDTR.Remarks = 'MET'
									AND tblEmpPersonal.empNumber = '$t_strEmpNmbr' 
									AND tblEmpDTR.dtrDate LIKE '$strMonthYear%'
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;
				
				case "MCR":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname 
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblEmpDTR 
									ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber";	
					$intFlag = 0;
					$objLeave = mysql_query("SELECT leaveCode FROM tblLeave");
					while($arrLeave = mysql_fetch_array($objLeave))
					{
						if($intFlag == 0)
						{
							$strStmt = " WHERE (";
							$intFlag = 1;
						}
						else
						{
							$strStmt = " OR ";
						}
						
						$strCndtn = "tblEmpDTR.remarks = '".$arrLeave["leaveCode"]."'";
						
						$strSQL = $strSQL.$strStmt.$strCndtn;
					}
					
					$strSQL = $strSQL." OR tblEmpDTR.remarks = 'TO')
										AND tblEmpPersonal.empNumber = '$t_strEmpNmbr' 
										AND tblEmpDTR.dtrDate LIKE '$strMonthYear%'
										ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";										
					break;

				case "HPR":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname 
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblEmpDTR 
									ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber";	
					$intFlag = 0;
					$objLeave = mysql_query("SELECT leaveCode FROM tblLeave");
					while($arrLeave = mysql_fetch_array($objLeave))
					{
						if($intFlag == 0)
						{
							$strStmt = " WHERE (";
							$intFlag = 1;
						}
						else
						{
							$strStmt = " OR ";
						}
						
						$strCndtn = "tblEmpDTR.remarks = '".$arrLeave["leaveCode"]."'";
						
						$strSQL = $strSQL.$strStmt.$strCndtn;
					}
					
					$strSQL = $strSQL.")
							AND tblEmpPersonal.empNumber = '$t_strEmpNmbr' 
							AND tblEmpDTR.dtrDate LIKE '$strMonthYear%'
							ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";										
					break;
				
				case "HYA":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblDivision.divisionName,
										tblSection.sectionName 
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblDivision
									ON tblDivision.divisionCode = tblEmpPosition.divisionCode								
								INNER JOIN tblSection
									ON tblSection.sectionCode = tblEmpPosition.sectionCode								
								WHERE tblEmpPosition.dtrSwitch='Y' 
									AND tblEmpPersonal.empNumber = '$t_strEmpNmbr' 
								ORDER BY tblEmpPosition.divisionCode, tblEmpPersonal.surname";
					break;
				
				case "AFC":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname,
										tblEmpPersonal.firstname, tblDivision.divisionName,
										tblSection.sectionName
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblDivision
									ON tblDivision.divisionCode = tblEmpPosition.divisionCode
								INNER JOIN tblSection
									ON tblSection.sectionCode = tblEmpPosition.sectionCode								
								WHERE tblEmpPosition.dtrSwitch='Y'
									AND tblEmpPersonal.empNumber = '$t_strEmpNmbr'
								ORDER BY tblEmpPosition.divisionCode, tblEmpPersonal.surname";
					break;
				
				case "AAR":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblDivision.divisionName,
										tblSection.sectionName
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblAppointment
									ON tblAppointment.appointmentCode = tblEmpPosition.appointmentCode
								INNER JOIN tblDivision
									ON tblDivision.divisionCode = tblEmpPosition.divisionCode								
								INNER JOIN tblSection
									ON tblSection.sectionCode = tblEmpPosition.sectionCode								
								WHERE tblEmpPosition.dtrSwitch='Y' 
									AND tblAppointment.leaveEntitled = 'Y' 
									AND tblEmpPersonal.empNumber = '$t_strEmpNmbr' 									
								ORDER BY tblEmpPosition.divisionCode, tblEmpPersonal.surname";
					break;					
			}
		}
		else
		{
			switch($t_strRprtType)
			{
				case "CEC":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, 
								tblEmpPosition.positionCode, tblEmpPosition.appointmentCode, tblEmpPosition.longevityDate,
								tblPosition.positionDesc, tblAppointment.appointmentDesc
							FROM tblEmpPersonal
							INNER JOIN tblEmpPosition
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblPosition
									ON tblEmpPosition.positionCode = tblPosition.positionCode
									INNER JOIN tblAppointment
										ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode"
							.$strWhereSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

			 	case "SR":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
								tblEmpPersonal.birthday, tblEmpPersonal.birthPlace 
							FROM tblEmpPersonal 
							INNER JOIN tblEmpPosition
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber							
							INNER JOIN tblServiceRecord 
								ON tblEmpPersonal.empNumber = tblServiceRecord.empNumber"
							.$strWhereSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

 				case "LT":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
								tblEmpPersonal.birthday, tblEmpPersonal.birthPlace 
							FROM tblEmpPersonal 
							INNER JOIN tblEmpPosition
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber							
							INNER JOIN tblEmpTraining
								ON tblEmpPersonal.empNumber = tblEmpTraining.empNumber"
							.$strWhereSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;
	
				case "DTR":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.middlename, 
								tblEmpPosition.divisionCode, tblDivision.divisionName, 
								tblDivision.divisionHead, tblDivision.divisionHeadTitle 
							FROM tblEmpPersonal 
							LEFT JOIN tblEmpPosition 
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
							INNER JOIN tblDivision
								ON tblEmpPosition.divisionCode = tblDivision.divisionCode
							WHERE tblEmpPosition.longevityDate <= '$dtmQueryDate'
								AND tblEmpPosition.dtrSwitch = 'Y'
								AND tblEmpPosition.statusOfAppointment = 'In-Service'"
							.$strAndSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";						
					break;

				case "PS":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblAppointment.header, tblAppointment.leaveEntitled,
									tblAppointment.appointmentCode
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
								INNER JOIN tblEmpIncome 
									ON tblEmpPersonal.empNumber = tblEmpIncome.empNumber
								WHERE tblEmpPosition.longevityDate <= '$dtmQueryDate'"
							.$strAndSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

				case "LB":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.longevityDate, tblEmpPosition.divisionCode
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblEmpLeaveBalance
									ON tblEmpPersonal.empNumber = tblEmpLeaveBalance.empNumber
								WHERE tblEmpPosition.longevityDate <= '$dtmQueryDate'"
							.$strAndSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

				case "AS":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.divisionCode, tblDivision.divisionHead, 
									tblDivision.divisionHeadTitle, tblAppointment.leaveEntitled
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode																	
								INNER JOIN tblDivision
									ON tblEmpPosition.divisionCode = tblDivision.divisionCode"
							.$strWhereSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

				case "EAS":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.divisionCode, tblAppointment.leaveEntitled,
									tblPosition.positionDesc, tblDivision.divisionName
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblAppointment
									ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
								INNER JOIN tblPosition
									ON tblEmpPosition.positionCode = tblPosition.positionCode
								INNER JOIN tblEmpLeaveBalance
									ON tblEmpPersonal.empNumber = tblEmpLeaveBalance.empNumber
								INNER JOIN tblDivision
									ON tblEmpPosition.divisionCode = tblDivision.divisionCode"
							.$strWhereSQL.
							"	AND tblEmpPosition.dtrSwitch = 'Y'
							ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;
					
				case "AR":
						$strSQL = $this->allCrtfctSql();
					break;					

				case "CNAC":
						$strSQL = $this->allCrtfctSql();
					break;

				case "CCA":
						$strSQL = $this->allCrtfctSql();
					break;

				case "CU":
						$strSQL = $this->allCrtfctSql();
					break;

				case "EL":
						$strSQL = $this->allCrtfctSql();
					break;

				case "PK":
						$strSQL = $this->allCrtfctSql();
					break;

				case "ADR":
						$strSQL = $this->allCrtfctSql();
					break;

				case "CDR":
						$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.sex,
								tblPosition.positionDesc, tblDivision.divisionName, 
								tblDivision.divisionHead, tblDivision.divisionHeadTitle
							FROM tblEmpPersonal
							INNER JOIN tblEmpPosition
								ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblPosition
									ON tblEmpPosition.positionCode = tblPosition.positionCode
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
										INNER JOIN tblEmpDuties
											ON tblEmpDuties.empNumber = tblEmpPosition.empNumber"
							.$strWhereSQL.
							"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

				case "LWOP":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpLeaveBalance.vlAbsUndWoPay, tblEmpLeaveBalance.slAbsUndWoPay
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblEmpLeaveBalance 
									ON tblEmpPosition.empNumber = tblEmpLeaveBalance.empNumber
								WHERE periodMonth='$t_intMonth' 
									AND periodYear='$t_intYear' 
									AND (tblEmpLeaveBalance.vlAbsUndWoPay > 0 
											OR tblEmpLeaveBalance.slAbsUndWoPay > 0) "
								.$strAndSQL.
								"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;

				case "TR":
					$strSQL = $this->allCrtfctSql();
					break;

				case "MA":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname 
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblEmpDTR 
									ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber 
								WHERE tblEmpDTR.Remarks = 'MET'
									AND tblEmpDTR.dtrDate LIKE '$strMonthYear%'"
								.$strAndSQL.	
								"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
					break;	

				case "MCR":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname 
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblEmpDTR 
									ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber";	
					$intFlag = 0;
					$objLeave = mysql_query("SELECT leaveCode FROM tblLeave");
					while($arrLeave = mysql_fetch_array($objLeave))
					{
						if($intFlag == 0)
						{
							$strStmt = " WHERE (";
							$intFlag = 1;
						}
						else
						{
							$strStmt = " OR ";
						}
						
						$strCndtn = "tblEmpDTR.remarks = '".$arrLeave["leaveCode"]."'";
						
						$strSQL = $strSQL.$strStmt.$strCndtn;
					}
					
					$strSQL = $strSQL." OR tblEmpDTR.remarks = 'TO') "
										.$strAndSQL.
										" AND tblEmpDTR.dtrDate LIKE '$strMonthYear%'
										ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";										
					break;

				case "HPR":
					$strSQL = "SELECT DISTINCT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname 
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblEmpDTR 
									ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber";	
					$intFlag = 0;
					$objLeave = mysql_query("SELECT leaveCode FROM tblLeave");
					while($arrLeave = mysql_fetch_array($objLeave))
					{
						if($intFlag == 0)
						{
							$strStmt = " WHERE (";
							$intFlag = 1;
						}
						else
						{
							$strStmt = " OR ";
						}
						
						$strCndtn = "tblEmpDTR.remarks = '".$arrLeave["leaveCode"]."'";
						
						$strSQL = $strSQL.$strStmt.$strCndtn;
					}
					
					$strSQL = $strSQL.") ".$strAndSQL.
								" AND tblEmpDTR.dtrDate LIKE '$strMonthYear%'
							ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";										
					break;

				case "HYA":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblDivision.divisionName,
										tblSection.sectionName
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblDivision
									ON tblDivision.divisionCode = tblEmpPosition.divisionCode
								INNER JOIN tblSection
									ON tblSection.sectionCode = tblEmpPosition.sectionCode																	
								WHERE tblEmpPosition.dtrSwitch='Y' "
								.$strAndSQL.
								" ORDER BY tblEmpPosition.divisionCode, tblEmpPersonal.surname";
					break;

				case "AFC":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblDivision.divisionName,
										tblSection.sectionName
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblDivision
									ON tblDivision.divisionCode = tblEmpPosition.divisionCode
								INNER JOIN tblSection
									ON tblSection.sectionCode = tblEmpPosition.sectionCode																	
								WHERE tblEmpPosition.dtrSwitch='Y' "
								.$strAndSQL.
								" ORDER BY tblEmpPosition.divisionCode, tblEmpPersonal.surname";
					break;

				case "AAR":
					$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblDivision.divisionName,
										tblSection.sectionName										  
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblAppointment
									ON tblAppointment.appointmentCode = tblEmpPosition.appointmentCode
								INNER JOIN tblDivision
									ON tblDivision.divisionCode = tblEmpPosition.divisionCode								
								INNER JOIN tblSection
									ON tblSection.sectionCode = tblEmpPosition.sectionCode																	
								WHERE tblEmpPosition.dtrSwitch='Y' 
									AND tblAppointment.leaveEntitled = 'Y' "
								.$strAndSQL.
								" ORDER BY tblEmpPosition.divisionCode, tblEmpPersonal.surname";
					break;
					
					case "AL":
						$dtmDateFiled = $this->combineDate($_SESSION['year'], $_SESSION['month'], $_SESSION['day']);
						$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.middlename,
								tblEmpPosition.divisionCode, tblEmpPosition.actualSalary,
								tblEmpLeave.*, tblDivision.divisionHead, tblDivision.divisionHeadTitle,
								tblLeave.leaveType, tblPosition.positionDesc
								FROM tblEmpPersonal
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblEmpLeave
										ON tblEmpPosition.empNumber = tblEmpLeave.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblLeave
										ON tblLeave.leaveCode = tblEmpLeave.leaveCode
									INNER JOIN tblPosition
										ON tblPosition.positionCode = tblEmpPosition.positionCode
								WHERE tblEmpLeave.dateFiled = '$dtmDateFiled' ".$strAndSQL;
					break;
					
					case "PRO":
						$dtmDateFiled = $this->combineDate($_SESSION['year'], $_SESSION['month'], $_SESSION['day']);
						$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
								tblEmpPersonal.firstname, tblEmpPersonal.middlename,
								tblEmpPosition.divisionCode, tblEmpOvertime.*, 
								tblDivision.divisionHead, tblDivision.divisionHeadTitle
								FROM tblEmpPersonal
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblEmpOvertime
										ON tblEmpPosition.empNumber = tblEmpOvertime.empNumber
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode										
								WHERE tblEmpOvertime.dateFiled = '$dtmDateFiled'".$strAndSQL;
					break;
					
				case "OB":
						$dtmDateFiled = $this->combineDate($_SESSION['year'], $_SESSION['month'], $_SESSION['day']);
						$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.divisionCode, tblEmpOB.*, 
									tblDivision.divisionHead, tblDivision.divisionHeadTitle
									FROM tblEmpPersonal
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpOB
											ON tblEmpPosition.empNumber = tblEmpOB.empNumber
										INNER JOIN tblDivision
											ON tblEmpPosition.divisionCode = tblDivision.divisionCode										
									WHERE tblEmpOB.dateFiled = '$dtmDateFiled'".$strAndSQL;
					break;

					case "TO":
						$dtmDateFiled = $this->combineDate($_SESSION['year'], $_SESSION['month'], $_SESSION['day']);
						$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
									tblEmpPersonal.firstname, tblEmpPersonal.middlename,
									tblEmpPosition.divisionCode, tblEmpTravelOrder.*, 
									tblDivision.divisionHead, tblDivision.divisionHeadTitle
									FROM tblEmpPersonal
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
										INNER JOIN tblEmpTravelOrder
											ON tblEmpPosition.empNumber = tblEmpTravelOrder.empNumber
										INNER JOIN tblDivision
											ON tblEmpPosition.divisionCode = tblDivision.divisionCode										
									WHERE tblEmpTravelOrder.dateFiled = '$dtmDateFiled'".$strAndSQL;
						break;
					
			}
		}
		$intPyslpCntr = 0;
		$objEmpInfo = mysql_query($strSQL);
		
		switch($t_strRprtType)
		{
			case "LWOP":
				$this->bodyLWOP($objEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
				break;
			
			case "TR":
				$this->bodyTR($objEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
				break;

			case "MA":
				$this->bodyMA($objEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
				break;
				
			case "MCR":
				$this->bodyMCR($objEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
				break;

			case "HPR":
				$this->bodyHPR($objEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
				break;

			case "HYA":
				$this->bodyHYA($objEmpInfo, $arrAgency, $_SESSION["period"], $t_intYear);
				break;

			case "AFC":
				$this->bodyAFC($objEmpInfo, $arrAgency, $_SESSION["period"], $t_intYear);
				break;
				
			case "AAR":
				$this->bodyAAR($objEmpInfo, $arrAgency, $_SESSION["period"], $t_intYear);
				break;

		}
		
		while($arrEmpInfo = mysql_fetch_array($objEmpInfo))
		{					
			switch($t_strRprtType)
			{
				case "CEC":
					$this->objRprt->AddPage();				
					$this->bodyCEC($arrEmpInfo, $arrAgency);
					break;

			 	case "SR":
					$this->objRprt->AddPage();
					$this->bodySR($arrEmpInfo, $arrAgency);			
					break;

 				case "LT":
					$this->objRprt->AddPage();
					$this->bodyLT($arrEmpInfo, $arrAgency);			
					break;
	
				case "DTR":
					$this->objRprt->AddPage();
					$this->bodyDTR($arrEmpInfo, $t_intMonth, $t_intYear);						
					break;
				
				case "PS":
					$intPySlpCntr = $intPySlpCntr + 1;
					if($intPySlpCntr == 2)
					{
						$this->objRprt->AddPage();
						$intPySlpCntr = 0;
					}
					$this->bodyPS($arrEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
					break;

				case "LB":
					$this->objRprt->AddPage();
					$this->bodyLB($arrEmpInfo, $arrAgency);
					break;					

				case "AS":
					$this->objRprt->AddPage();
					$this->bodyAS($arrEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
					break;
					
				case "EAS":
					$this->objRprt->AddPage();
					$this->bodyEAS($arrEmpInfo, $arrAgency, $_SESSION["period"], $t_intYear);
					break;
				
				case "CNAC":
					$this->objRprt->AddPage();
					$this->bodyCNAC($arrEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
					break;

				case "CCA":
					$this->objRprt->AddPage();
					$this->bodyCCA($arrEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
					break;
				
				case "CU":
					$this->objRprt->AddPage();
					$this->bodyCU($arrEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
					break;				

				case "EL":
					$this->objRprt->AddPage();
					$this->bodyEL($arrEmpInfo);
					break;				
				
				case "PK":
					$this->objRprt->AddPage();
					$this->bodyPK($arrEmpInfo, $arrAgency);
					break;
					
				case "ADR":
					$this->objRprt->AddPage();
					$this->bodyADR($arrEmpInfo, $arrAgency);
					break;				
				
				case "CDR":
					$this->objRprt->AddPage();
					$this->bodyCDR($arrEmpInfo, $arrAgency, $t_intMonth, $t_intYear);
					break;
				
				case "AL":
					$this->objRprt->AddPage();
					$this->bodyAL($arrEmpInfo, $arrAgency);
					break;
				
				case "PRO":
					$this->objRprt->AddPage();
					$this->bodyPRO($arrEmpInfo, $arrAgency);
					break;
				
				case "OB":
					$this->objRprt->AddPage();
					$this->bodyOB($arrEmpInfo, $arrAgency);
					break;				

				case "TO":
					$this->objRprt->AddPage();
					$this->bodyTO($arrEmpInfo, $arrAgency);
					break;
					
				case "AR":
					$this->objRprt->AddPage();
					$this->bodyAR($arrEmpInfo, $arrAgency);
					break;
			}
		}
	}

	function empCrtfctSql($t_strEmpNmbr)
	{
		$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
			tblEmpPersonal.firstname, tblEmpPersonal.middlename, tblEmpPersonal.sex, 
			tblPosition.positionDesc, tblDivision.divisionName, 
			tblDivision.divisionHead, tblDivision.divisionHeadTitle,
			tblEmpPersonal.comTaxNumber, tblEmpPersonal.issuedAt, 
			tblEmpPersonal.issuedOn, tblEmpPosition.positionDate
		FROM tblEmpPersonal
		INNER JOIN tblEmpPosition
			ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
			INNER JOIN tblPosition
				ON tblEmpPosition.positionCode = tblPosition.positionCode
				INNER JOIN tblDivision
					ON tblEmpPosition.divisionCode = tblDivision.divisionCode
		WHERE tblEmpPersonal.empNumber = '$t_strEmpNmbr'
		ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";	
		
		return $strSQL;
	}

	function allCrtfctSql()
	{
		if($_SESSION["empPerSelect"] == "Per Division")
		{
			$strPer = "tblEmpPosition.divisionCode";
		}
		elseif($_SESSION["empPerSelect"] == "Per Section")
		{
			$strPer = "tblEmpPosition.sectionCode";
		}
		
		if(strlen($_SESSION["empPerSelect"]) != 0 && strlen($_SESSION["divSecCode"]) != 0)
		{
			$strWhereSQL = " WHERE $strPer = '".$_SESSION["divSecCode"]."' ";
			$strAndSQL = " AND $strPer = '".$_SESSION["divSecCode"]."' ";
		}
		else
		{
			$strWhereSQL = " ";
			$strAndSQL = " ";
		}
	
		$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
					tblEmpPersonal.firstname, tblEmpPersonal.middlename, tblEmpPersonal.sex, 
					tblPosition.positionDesc, tblDivision.divisionName,
					tblDivision.divisionHead, tblDivision.divisionHeadTitle,
					tblEmpPersonal.comTaxNumber, tblEmpPersonal.issuedAt, 
					tblEmpPersonal.issuedOn, tblEmpPosition.positionDate
				FROM tblEmpPersonal
				INNER JOIN tblEmpPosition
					ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
					INNER JOIN tblPosition
						ON tblEmpPosition.positionCode = tblPosition.positionCode
						INNER JOIN tblDivision
							ON tblEmpPosition.divisionCode = tblDivision.divisionCode"
							.$strWhereSQL.
				"ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";						
		return $strSQL;
	}
	
	function getIncm($t_arrIncm, $t_strIncmCode)
	{
		$blnFlag = 0;
		for($intCntr = 0; $intCntr < count($t_arrIncm); $intCntr++)
		{
			if($t_arrIncm[$intCntr]["code"] == $t_strIncmCode)
			{
				$blnFlag = 1;
				return $t_arrIncm[$intCntr]["amount"];
			}
		}
		if($blnFlag == 0)
		{
			return 0;
		}
	}
	
	function bodyCEC($t_arrEmpInfo, $t_arrAgency)
	{
		//income details
		$objIncmDtl = mysql_query("SELECT incomeCode, incomeAmount
								FROM tblIncomeDetails
								WHERE empNumber = '".$t_arrEmpInfo['empNumber']."'
									AND (incomeCode = 'MS' OR incomeCode = 'AC' OR
										incomeCode = 'PERA' OR incomeCode = 'TA' OR
										incomeCode = 'RATA')										
								ORDER BY incomeCode");
		
		
		if(mysql_num_rows($objIncmDtl))
		{
			$intIncmDetails = 0;
			while($arrIncmDtl = mysql_fetch_array($objIncmDtl))
			{
				$arrIncmDetails[] = array("code"=>$arrIncmDtl["incomeCode"], "amount"=>$arrIncmDtl["incomeAmount"]);
				$intIncmDetails = $intIncmDetails + $arrIncmDtl["incomeAmount"];
			}
		}
		$intSbtIncmDetails = $intIncmDetails * 12;
		$intSalary = $this->getIncm($arrIncmDetails, "MS");
		$intAC = $this->getIncm($arrIncmDetails, "AC");
		$intPERA = $this->getIncm($arrIncmDetails, "PERA");
		$intTA = $this->getIncm($arrIncmDetails, "TA");
		$intCITRA = $this->getIncm($arrIncmDetails, "RATA");
		
		// monthly benefits
		$objBnft = mysql_query("SELECT mcSwitch, hazardSwitch, hpFactor FROM tblEmpPosition
									WHERE empNumber='".$t_arrEmpInfo['empNumber']."'");
		if(mysql_num_rows($objBnft))
		{
			$arrBnft = mysql_fetch_array($objBnft);
			if($arrBnft["mcSwitch"] == 'Y')
			{
				$intSA = 3000;
				$intLA = 300;
			}
			else
			{
				$intSA = 0;
				$intLA = 0;				
			}
			
			if($arrBnft["hazardSwitch"] == 'Y' && $arrBnft["hpFactor"] > 0)
			{
				$intHP = ($arrBnft["hpFactor"] / 100) * $intSalary;
			}
			else
			{
				$intHP = 0;
			}
		}
		else
		{
			$intSA = 0;
			$intLA = 0;
			$intHP = 0;										
		}
		
		$intBenefit = $intSA + $intLA + $intHP;
		$intSbtBenefit = $intBenefit * 12;
		
		//Annual Benefits
		
		$objAnnual = mysql_query("SELECT DISTINCT addIncomeCode FROM tblEmpAddIncome
						WHERE empNumber = '".$t_arrEmpInfo['empNumber']."'");

		if(mysql_num_rows($objAnnual))
		{
			$intAnnCtr = 0;
			while($arrAnnual = mysql_fetch_array($objAnnual))
			{ 
				if($intAnnCtr == 0)
				{
					$strOr = " WHERE addIncomeCode = '".$arrAnnual["addIncomeCode"]."' ";
				}
				else
				{
					$strOr = $strOr." OR addIncomeCode = '".$arrAnnual["addIncomeCode"]."' ";
				}
				
				$intAnnCtr++;
			}

			$objAddIncm = mysql_query("SELECT addIncomeCode, fixedAmount FROM tblAddIncome".$strOr);
			
			while($arrAddIncm = mysql_fetch_array($objAddIncm))
			{
				$arrAnnBenefit[] = array("code"=>$arrAddIncm["addIncomeCode"], "amount"=>$arrAddIncm["fixedAmount"]);
			}
			$intCB = $this->getIncm($arrAnnBenefit, "CB");
			$intCG = $this->getIncm($arrAnnBenefit, "CG");
			$intPI = $this->getIncm($arrAnnBenefit, "PI");
			$intCA = $this->getIncm($arrAnnBenefit, "CA");
			$intSbtAnnual = $intCB + $intCG + $intPI + $intCA;
		}
		else
		{
			$intCB = 0;
			$intCG = 0;
			$intPI = 0;
			$intCA = 0;
			$intSbtAnnual = 0;
		}
		
		$intGross = $intSbtIncmDetails + $intSbtBenefit + $intSbtAnnual;   //gross annual compensation
		
		if ($t_arrEmpInfo['longevityDate'] != "0000-00-00")
		{
			$intLngvtyMonth = $this->epochDate('n', $t_arrEmpInfo['longevityDate']);
			$intLngvtyDay = $this->epochDate('j', $t_arrEmpInfo['longevityDate']);
			$intLngvtyYear = $this->epochDate('Y', $t_arrEmpInfo['longevityDate']);
			$intLngvtyMonth = $this->intToMonthFull($intLngvtyMonth);
			$strLngvty = $intLngvtyMonth." ".$intLngvtyDay.", ".$intLngvtyYear;
		}
		else
		{
			$strLngvty = "";
		}
		
		
		$strPrgrph1 = "     This is to certify that ".strtoupper($t_arrEmpInfo['firstname'])." "
		.strtoupper($t_arrEmpInfo['surname']).",	".$t_arrEmpInfo['positionDesc'].", is a "
		.$t_arrEmpInfo['appointmentDesc']." employee of ".$t_arrAgency['agencyName']
		." (".$t_arrAgency['abbreviation'].") the since "
		.$strLngvty.".";

		$strPrgrpg2 = "     This further certify that ".strtoupper($t_arrEmpInfo['firstname'])." ".strtoupper($t_arrEmpInfo['surname'])
		." is receiveing the following monthly compensation and additional renumeration:";

		$arrCellWidth = array(40,60,30);
		$arrHeader = array(
			0 => array("head"=>"Monthly Compensation", "begin"=>0, "end"=>3, "subtotal"=>number_format($intSbtIncmDetails,2,".",",")),
			1 => array("head"=>"Monthly Benefits and Allowance", "begin"=>4, "end"=>7, "subtotal"=>number_format($intSbtBenefit,2,".",",")),
			2 => array("head"=>"Additional (Annual) Benefits", "begin"=>8, "end"=>11, "subtotal"=>number_format($intSbtAnnual,2,".",","))
		);


		$arrMnthComp = array(
			0 => array("name"=>"Basic Salary", "income"=>number_format($intSalary,2,".",",")),
			1 => array("name"=>"Additional Compensation", "income"=>number_format($intAC,2,".",","))			
		);


		$arrCellValue = array(
			0 => array("name"=>"PERA", "income"=>number_format($intPERA,2,".",","), "style"=>""),
			1 => array("name"=>"Transportation Allowance", "income"=>number_format($intTA,2,".",","), "style"=>""),
			2 => array("name"=>"CITRA", "income"=>number_format($intCITRA,2,".",","), "style"=>""),
			3 => array("name"=>"MONTHLY TOTAL", "income"=>number_format($intIncmDetails,2,".",","), "style"=>"I"),
			4 => array("name"=>"Subsistence Allowance", "income"=>number_format($intSA,2,".",","), "style"=>""),
			5 => array("name"=>"Laundry Allowance", "income"=>number_format($intLA,2,".",","), "style"=>""),
			6 => array("name"=>"Hazard Pay", "income"=>number_format($intHP,2,".",","), "style"=>""),			
			7 => array("name"=>"MONTHLY TOTAL", "income"=>number_format($intBenefit,2,".",","), "style"=>"I"),			
			8 => array("name"=>"Christmas Bonus", "income"=>number_format($intCB,2,".",","), "style"=>""),
			9 => array("name"=>"Cash Gift", "income"=>number_format($intCG,2,".",","), "style"=>""),			
			10 => array("name"=>"Productivity Incentive", "income"=>number_format($intPI,2,".",","), "style"=>""),
			11 => array("name"=>"Clothing Allowance", "income"=>number_format($intCA,2,".",","), "style"=>"")			
		);
		
		$this->objRprt->SetFont('Arial','BU',15);
		$this->objRprt->Cell(0,10,'CERTIFICATE OF EMPLOYMENT AND COMPENSATION',0,0,'C');
		$this->objRprt->Ln(15);
		$this->objRprt->SetFont('Arial','',11);
		$this->objRprt->MultiCell(0, 6, $strPrgrph1, 0, 'J', 0);
		$this->objRprt->MultiCell(0, 6, $strPrgrpg2, 0, 'J', 0);

		for($intCounter=0; $intCounter<=2; $intCounter++)
		{
			$this->objRprt->Cell(20);
			$this->objRprt->SetFont('Arial','B',11);		
			$this->objRprt->Cell(0,10,$arrHeader[$intCounter]["head"],0,0,'L');
			$this->objRprt->Ln(7);
		
			if($intCounter == 0)
			{
				
				for($intCtr=0; $intCtr<=1; $intCtr++)
				{
					$this->objRprt->Cell(30);		
					$this->objRprt->SetFont('Arial','',10);		
					$this->objRprt->Cell(70,10,$arrMnthComp[$intCtr]["name"],0,0,'L');
					$this->objRprt->Cell(30,10,$arrMnthComp[$intCtr]["income"],0,0,'R');
					$this->objRprt->Ln(5);				
				}	
			}

			for($intCount=$arrHeader[$intCounter]["begin"]; $intCount <=$arrHeader[$intCounter]["end"]; $intCount++)
			{
				$this->objRprt->Cell($arrCellWidth[0]);		
				$this->objRprt->SetFont('Arial',$arrCellValue[$intCount]["style"],10);		
				$this->objRprt->Cell($arrCellWidth[1],10,$arrCellValue[$intCount]["name"],0,0,'L');
				$this->objRprt->Cell($arrCellWidth[2],10,$arrCellValue[$intCount]["income"],0,0,'R');
				$this->objRprt->Ln(5);
			}
			
			$this->objRprt->Cell(60);		
			$this->objRprt->SetFont('Arial','B',10);		
			$this->objRprt->Cell(40,10,'SUB_TOTAL(Annual)',0,0,'L');
			if($intCounter == 2)
			{
				$this->objRprt->Cell(30);
			}
			else
			{
				$this->objRprt->Cell(30,10,'X 12',0,0,'R');
			}
			$this->objRprt->Cell(30,10,$arrHeader[$intCounter]["subtotal"],0,0,'R');
			$this->objRprt->Ln(10);				
		}
		
		$this->objRprt->Cell(40);		
		$this->objRprt->SetFont('Arial','B',10);		
		$this->objRprt->Cell(60,10,'GROSS ANNUAL COMPENSATION',0,0,'L');
		$this->objRprt->Cell(30,10,'',0,0,'R');
		$this->objRprt->SetFont('Arial','BU',10);				
		$this->objRprt->Cell(30,10,number_format($intGross,2,".",","),0,0,'R');		
		$this->objRprt->Ln(15);

		$this->objRprt->SetFont('Arial','',11);
		
		$strPrgrph3 = "     This certification is issued upon the request of "
		.strtoupper($t_arrEmpInfo['firstname'])." "
		.strtoupper($t_arrEmpInfo['surname'])." for whatever legal purpose it may serve him/her.";
		$this->objRprt->MultiCell(0, 6, $strPrgrph3, 0, 'J', 0);
		
		$strPrgrph4 = "     Done this ".date('jS')." day of ".date('F')." of ".date('Y')." at ".$t_arrAgency['address'];
		$this->objRprt->MultiCell(0, 6, $strPrgrph4, 0, 'J', 0);		
	
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$this->objRprt->Ln(10);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','B',11);		
		$this->objRprt->Cell(0,10,strtoupper($arrSgntry["signatory"]),0,0,'C');

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(0,10,$arrSgntry["signatoryTitle"],0,0,'C');
	}
	
	function bodySR($t_arrEmpInfo, $t_arrAgency)
	{
		$strPrgrph1 = "     This is to certify that the employee here in above actually rendered"
					." services in this Office as shown by the service record below, each line"
					." of which is supported by appointment and papers actually issued by this"
					." Office and approved by the authorities concerned.";
		$arrEmp = $this->empInfoHeader($t_arrEmpInfo);
		$objSR = mysql_query("SELECT tblServiceRecord.*, tblAppointment.appointmentDesc
								FROM tblServiceRecord 
								INNER JOIN tblAppointment
									ON tblServiceRecord.appointmentCode = tblAppointment.appointmentCode
								WHERE tblServiceRecord.empNumber='".$t_arrEmpInfo['empNumber']."'
								ORDER BY tblServiceRecord.serviceFromDate desc");
		
		$this->objRprt->SetFont('Arial','B',15);
		$this->objRprt->Cell(0,10,'SERVICE RECORD',0,0,'C');
		$this->objRprt->Ln(10);

		for($intCount=0; $intCount<=3; $intCount++)
		{
			$this->objRprt->SetFont('Arial','B',10);
			$this->objRprt->Cell(40, 10, $arrEmp[$intCount]["title"], 0, 0, 'R');
			$this->objRprt->SetFont('Arial','',10);		
			$this->objRprt->Cell(0, 10, $arrEmp[$intCount]["emp"], 0, 0, 'L');
			$this->objRprt->Ln(5);
		}

		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 6, $strPrgrph1, 0, 'J', 0);
		
		$this->objRprt->SetX(-15);
		$intX = $this->objRprt->GetX();
		$this->objRprt->Line(15, 100, $intX, 100);
		$this->objRprt->SetFont('Arial','',8);

		$this->objRprt->Ln(5);
		$this->objRprt->Cell(30, 5, 'SERVICE', 0, 0, 'C');
		$this->objRprt->Cell(60, 5, 'RECORD OF APPOINTMENT', 0, 0, 'C');
		$this->objRprt->Cell(35, 5, 'OFFICE ENTITY/DIVISION', 0, 0, 'C');		
		$this->objRprt->Cell(25);		
		$this->objRprt->Cell(30, 5, 'SEPARATION(4)', 0, 0, 'C');		

		$this->objRprt->Ln(5);
		$this->objRprt->Cell(15, 5, 'From', 0, 0, 'C');
		$this->objRprt->Cell(15, 5, 'To', 0, 0, 'C');
		$this->objRprt->Cell(20, 5, 'Designation', 0, 0, 'C');
		$this->objRprt->Cell(15, 5, 'Status', 0, 0, 'C');
		$this->objRprt->Cell(25, 5, 'Salary', 0, 0, 'C');						
		$this->objRprt->Cell(15, 5, 'Station', 0, 0, 'C');		
		$this->objRprt->Cell(20, 5, 'Branch', 0, 0, 'C');
		$this->objRprt->Cell(25, 5, 'L/V Abs w/o Pay', 0, 0, 'C');
		$this->objRprt->Cell(15, 5, 'Date', 0, 0, 'C');
		$this->objRprt->Cell(15, 5, 'Cause', 0, 0, 'C');						
		
		$this->objRprt->Ln(5);
		$this->objRprt->Line(15, 112, $intX, 112);		

		while($arrSR = mysql_fetch_array($objSR))	
		{
			if ($arrSR["serviceToDate"] == NULLDATE)
			{
				$strToDate = "Present";
			}
			else
			{
				$intSrvcToMonth = $this->epochDate('n', $arrSR["serviceToDate"]);
				$intSrvcToDay = $this->epochDate('j', $arrSR["serviceToDate"]);
				$intSrvcToYear = $this->epochDate('Y', $arrSR["serviceToDate"]);

				$intSrvcFrMonth = $this->epochDate('n', $arrSR["serviceFromDate"]);
				$intSrvcFrDay = $this->epochDate('j', $arrSR["serviceFromDate"]);
				$intSrvcFrYear = $this->epochDate('Y', $arrSR["serviceFromDate"]);
				
				if(strlen($intSrvcToMonth) != 0 && strlen($intSrvcToDay) != 0 && strlen($intSrvcToYear) != 0)
				{
					$strToDate = $intSrvcToMonth."/".$intSrvcToDay."/".$intSrvcToYear;
				}
				else
				{
					$strToDate = "";
				}
				
				if(strlen($intSrvcFrMonth) != 0 && strlen($intSrvcFrDay) != 0 && strlen($intSrvcFrYear) != 0)
				{
					$strFrDate = $intSrvcFrMonth."/".$intSrvcFrDay."/".$intSrvcFrYear;
				}
				else
				{
					$strFrDate = "";
				}
			}
			
			if(strlen($strFrDate) != 0 && strlen($strToDate) != 0)
			{
				$strDateFromTo = $strFrDate."-".$strToDate;
			}
			
			$this->objRprt->Ln(5);
			$this->objRprt->Cell(30, 5, $strDateFromTo, 0, 0, 'C');
			$this->objRprt->Cell(20, 5, $arrSR["positionCode"], 0, 0, 'C');
			$this->objRprt->Cell(15, 5, $arrSR["appointmentDesc"], 0, 0, 'C');
			$this->objRprt->Cell(25, 5, $arrSR["salary"], 0, 0, 'C');						
			$this->objRprt->Cell(15, 5,  $arrSR["stationAgency"], 0, 0, 'C');		
			$this->objRprt->Cell(20, 5,  $arrSR["branch"], 0, 0, 'C');
			if ($arrSR["leaveWoPay"] == NULLABSUND)
			{
				$this->objRprt->Cell(25, 5,  "NONE", 0, 0, 'C');
			}
			else
			{
				$this->objRprt->Cell(25, 5,  $arrSR["leaveWoPay"], 0, 0, 'C');
			}
			if ($arrSR["separationDate"] == NULLDATE)
			{
				$this->objRprt->Cell(15, 5,  "", 0, 0, 'C');
			}
			else
			{
				$this->objRprt->Cell(15, 5,  $arrSR["separationDate"], 0, 0, 'C');
			}
			$this->objRprt->Cell(15, 5, $arrSR["separationCause"], 0, 0, 'C');						
		}

		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial','B',10);		
		$this->objRprt->Cell(0, 5, 'CERTIFIED CORRECT', 0, 0, 'C');

		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial','',10);		
		$this->objRprt->Cell(90, 5, date("l, F d, Y"), 0, 0, 'C');
		$this->objRprt->SetFont('Arial','B',10);				
		$this->objRprt->Cell(90, 5, strtoupper($arrSgntry["signatory"]), 0, 0, 'C');		

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(90, 5, 'Date', 0, 0, 'C');
		$this->objRprt->Cell(90, 5, $arrSgntry["signatoryTitle"], 0, 0, 'C');		
	}
	
	function bodyLT($t_arrEmpInfo, $t_arrAgency)
	{
		$strPrgrph1 = "     This is to certify that the employee here in above have"
					." attended the following training:";
		$arrEmp = $this->empInfoHeader($t_arrEmpInfo);
		$objLT = mysql_query("SELECT tblEmpTraining.*, tblTraining.trainingTitle
								FROM tblEmpTraining 
								INNER JOIN tblTraining
									ON tblEmpTraining.trainingCode = tblTraining.trainingCode
								WHERE tblEmpTraining.empNumber='".$t_arrEmpInfo['empNumber']."'
								ORDER BY tblEmpTraining.trainingStartDate desc");
		
		$this->objRprt->SetFont('Arial','B',15);
		$this->objRprt->Cell(0,10,'LIST OF TRAINING',0,0,'C');
		$this->objRprt->Ln(10);

		for($intCount=0; $intCount<=3; $intCount++)
		{
			$this->objRprt->SetFont('Arial','B',10);
			$this->objRprt->Cell(40, 10, $arrEmp[$intCount]["title"], 0, 0, 'R');
			$this->objRprt->SetFont('Arial','',10);		
			$this->objRprt->Cell(0, 10, $arrEmp[$intCount]["emp"], 0, 0, 'L');
			$this->objRprt->Ln(5);
		}

		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 6, $strPrgrph1, 0, 'J', 0);
		
		$this->objRprt->SetX(-15);
		$intX = $this->objRprt->GetX();
		$this->objRprt->Line(15, 90, $intX, 90);
		$this->objRprt->SetFont('Arial','',8);

		$this->objRprt->Ln(7);
		$this->objRprt->Cell(60, 5, 'Training Title', 0, 0, 'C');
		$this->objRprt->Cell(35, 5, 'Period of Training', 0, 0, 'C');
		$this->objRprt->Cell(15, 5, 'Hours', 0, 0, 'C');		
		$this->objRprt->Cell(15, 5, 'Cost', 0, 0, 'C');		
		$this->objRprt->Cell(25, 5, 'Conducted by', 0, 0, 'C');		
		$this->objRprt->Cell(30, 5, 'Venue', 0, 0, 'C');		

		$this->objRprt->Line(15, 97, $intX, 97);
		$this->objRprt->SetFont('Arial','',8);
		$this->objRprt->Ln(7);
	
		$this->objRprt->SetWidths(array(60, 35, 15, 15, 25, 30));
		while($arrLT = mysql_fetch_array($objLT))
		{
			$strPeriod = date("m/d/y",strtotime($arrLT["trainingStartDate"]))
						."-".date("m/d/y",strtotime($arrLT["trainingEndDate"]));
			$this->objRprt->Row(array($arrLT["trainingTitle"], $strPeriod, $arrLT["trainingHours"], number_format($arrLT["trainingCost"],2,".",","), $arrLT["trainingConductedBy"], $arrLT["trainingVenue"]), 0);
		}

		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial','B',10);		
		$this->objRprt->Cell(0, 5, 'CERTIFIED CORRECT', 0, 0, 'C');

		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial','',10);		
		$this->objRprt->Cell(90, 5, date("l, F d, Y"), 0, 0, 'C');
		$this->objRprt->SetFont('Arial','B',10);				
		$this->objRprt->Cell(90, 5, strtoupper($arrSgntry["signatory"]), 0, 0, 'C');		

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(90, 5, 'Date', 0, 0, 'C');
		$this->objRprt->Cell(90, 5, $arrSgntry["signatoryTitle"], 0, 0, 'C');				
	}
	
	function signatory($t_strEmpNmbr, $t_strDivisionHead, $t_strDivisionHeadTitle)
	{
		$objDivSgntry = mysql_query("SELECT divisionHead FROM tblDivision WHERE empNumber='$t_strEmpNmbr'");
		if(mysql_num_rows($objDivSgntry))
		{
			//chief un
			$objSgntry = mysql_query("SELECT signatory, signatoryTitle FROM tblSignatory WHERE designation='Director'");
			$arrSgntry = mysql_fetch_array($objSgntry);
			return $arrSgntry;
		}
		else
		{
			$arrSgntry = array("signatory"=>$t_strDivisionHead, "signatoryTitle"=>$t_strDivisionHeadTitle);
			return $arrSgntry;
		}
	}
	
	function bodyDTR($t_arrEmpInfo, $t_intMonth, $t_intYear)
	{
		$strMonth = $this->intToMonthFull($t_intMonth);
		$strPay = $strMonth." ".$t_intYear;
		
		$arrSgntry = $this->signatory($t_arrEmpInfo["empNumber"], $t_arrEmpInfo["divisionHead"], $t_arrEmpInfo["divisionHeadTitle"]);
		
		$strName = $t_arrEmpInfo["surname"].", ".$t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["middlename"];

		$arrInfo = array(
				0 => array("title1"=>"Employee Number: ", "value1"=>$t_arrEmpInfo["empNumber"], "title2"=>"Name: ", "value2"=>$strName),
				1 => array("title1"=>"Division: ", "value1"=>$t_arrEmpInfo["divisionCode"], "title2"=>"Pay Ending: ", "value2"=>$strPay)
				);

		$this->objRprt->SetFont('Arial','B',15);
		$this->objRprt->Ln(15);
		$this->objRprt->Cell(0,10,'DAILY TIME RECORD',0,0,'C');
		$this->objRprt->Ln(10);

		$this->objRprt->SetX(-15);
		$intX = $this->objRprt->GetX();
		$this->objRprt->SetLineWidth(0.5);		

		$this->objRprt->Line(15, 37, $intX, 37);
		$this->objRprt->Line(15, 55, $intX, 55);
		$this->objRprt->Ln(5);
	
		for($intCounter=0; $intCounter<=1; $intCounter++)
		{
			$this->objRprt->SetFont('Arial', "B", 10);
			$this->objRprt->Cell(40, 5, $arrInfo[$intCounter]["title1"], 0, 0, "R");
			$this->objRprt->SetFont('Arial', "", 10);			
			$this->objRprt->Cell(20, 5, $arrInfo[$intCounter]["value1"], 0, 0, "L");
			$this->objRprt->SetFont('Arial', "B", 10);			
			$this->objRprt->Cell(30, 5, $arrInfo[$intCounter]["title2"], 0, 0, "R");
			$this->objRprt->SetFont('Arial', "", 10);			
			$this->objRprt->Cell(0, 5, $arrInfo[$intCounter]["value2"], 0, 0, "L");
			$this->objRprt->Ln(7);
		}

		$this->objRprt->Ln(5);
		
		$this->objRprt->SetFont('Arial', "B", 9);
		$this->objRprt->Cell(135, 3, "", 0, 0, "C");
		$this->objRprt->Cell(15, 3, "TARDY", 0, 0, "C");
		$this->objRprt->Cell(15);
		$this->objRprt->Cell(15, 3, "OVER", 0, 1, "C");

		$this->objRprt->Cell(5, 3, "", 0, 0, "C");		
		$this->objRprt->Cell(10, 3, "", 0, 0, "C");
		$this->objRprt->Cell(15, 3, "IN", 0, 0, "C");
		$this->objRprt->Cell(15, 3, "OUT", 0, 0, "C");		
		$this->objRprt->Cell(15, 3, "IN", 0, 0, "C");
		$this->objRprt->Cell(15, 3, "OUT", 0, 0, "C");
		$this->objRprt->Cell(15, 3, "IN", 0, 0, "C");
		$this->objRprt->Cell(15, 3, "OUT", 0, 0, "C");
		$this->objRprt->Cell(15, 3, "REMARKS", 0, 0, "C");
		$this->objRprt->Cell(15, 3, "TOTAL", 0, 0, "C");
		$this->objRprt->Cell(15, 3, "UND", 0, 0, "C");
		$this->objRprt->Cell(15, 3, "EXCESS", 0, 0, "C");		
		$this->objRprt->Cell(15, 3, "TIME", 0, 0, "C");		

		$strDTRDate = $this->combineDate($t_intYear, $t_intMonth, "1");   //construct a date format YYYY-MM-DD
		$intDaysInMonth = date('t',strtotime($strDTRDate));   //get how many days in the month date('t')

		for ($intCounter=1; $intCounter <= $intDaysInMonth; $intCounter++)
		{
			$strDTRDate = $this->combineDate($t_intYear, $t_intMonth, $intCounter);
			$strDay = date('D', strtotime($strDTRDate));   //day eg: Sunday, Monday
			$objEmpDTR = mysql_query("SELECT * FROM tblEmpDTR 
										WHERE empNumber = '".$t_arrEmpInfo["empNumber"]."' 
										AND dtrDate = '$strDTRDate'");

			$arrDTR = mysql_fetch_array($objEmpDTR);

			$this->objRprt->SetFont('Arial', "", 8);
			$this->objRprt->Ln(4);	
			$this->objRprt->Cell(5, 4, $intCounter, 0, 0, "R");				
			$this->objRprt->Cell(10, 4, $strDay, 0, 0, "L");
							
			if(mysql_num_rows($objEmpDTR) != 0)
			{
				$this->objRprt->Cell(15, 4, $arrDTR["inAM"], 0, 0, "C");
				$this->objRprt->Cell(15, 4, $arrDTR["outAM"], 0, 0, "C");		
				$this->objRprt->Cell(15, 4, $arrDTR["inPM"], 0, 0, "C");
				$this->objRprt->Cell(15, 4, $arrDTR["outPM"], 0, 0, "C");
				$this->objRprt->Cell(15, 4, $arrDTR["inOT"], 0, 0, "C");
				$this->objRprt->Cell(15, 4, $arrDTR["outOT"], 0, 0, "C");
				$this->objRprt->Cell(15, 4, $arrDTR["remarks"], 0, 0, "C");
				
				$arrDTR = $this->getEmpDTRPrDay($t_arrEmpInfo["empNumber"], $strDTRDate);
				
				$strWrkHr = $this->getWrkHrPrDay($t_arrEmpInfo["empNumber"], $strDTRDate, 1, $arrDTR);
				$this->objRprt->Cell(15, 4, $strWrkHr, 0, 0, "R");
				
				$arrLateUndPrDay = $this->getLateUndPrDay($t_arrEmpInfo["empNumber"], $strDTRDate, $arrDTR);
				$this->objRprt->Cell(15, 4, $arrLateUndPrDay["display"], 0, 0, "R");
				
				$strExcess = $this->getExcessPrDay($t_arrEmpInfo["empNumber"], $strDTRDate, 1, $arrDTR);
				$this->objRprt->Cell(15, 4, $strExcess, 0, 0, "R");

				$strOvrtm = $this->getOvrtmPrDay($t_arrEmpInfo["empNumber"], $strDTRDate, 1, $arrDTR);
				$this->objRprt->Cell(15, 4, $strOvrtm, 0, 0, "R");

			}
			else
			{
				$objHoliday = mysql_query("SELECT tblHoliday.holidayName FROM tblHolidayYear
										INNER JOIN tblHoliday 
											ON tblHolidayYear.holidayCode = tblHoliday.holidayCode
										WHERE tblHolidayYear.holidayDate = '$strDTRDate'");
										
				if(mysql_num_rows($objHoliday) != 0)
				{
					$arrHoliday = mysql_fetch_array($objHoliday);
					$this->objRprt->Cell(80, 4, "", 0, 0, "C");
					$this->objRprt->Cell(25, 4, $arrHoliday ["holidayName"], 0, 0, "C");
					$this->objRprt->Cell(0);
				}
				else
				{
					$this->objRprt->Cell(25);	
				}				
			}
			
		}   //end for loop
		
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(95);
		$this->objRprt->Cell(25, 5, "Total:", 0, 0, "C");

		$arrDTR = $this->getEmpDTR($t_arrEmpInfo["empNumber"], $t_intMonth, $t_intYear);

		$strWrkHrPrMnth = $this->getWrkHrPrMonth($t_arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, $arrDTR);
		$this->objRprt->Cell(15, 5, $strWrkHrPrMnth, 0, 0, "R");
		
		$arrLateUndPrMnth = $this->getLateUndPrMonth($t_arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, $arrDTR);
		$this->objRprt->Cell(15, 5, $arrLateUndPrMnth["display"], 0, 0, "R");

		$strExcessPrMnth = $this->getExcessPrMonth($t_arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, $arrDTR);
		$this->objRprt->Cell(15, 5, $strExcessPrMnth, 0, 0, "R");

		$strOvrtmPrMnth = $this->getOvrtmPrMonth($t_arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, $arrDTR);
		$this->objRprt->Cell(15, 5, $strOvrtmPrMnth, 0, 0, "R");

		$this->objRprt->Ln(7);
		$this->objRprt->Cell(135, 4, "Total Tardy/Undertime:", 0, 0, "R");
		$this->objRprt->Cell(0, 4, $arrLateUndPrMnth["display"], 0, 0, "L");

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(135, 4, "Total Number of Tardy/Undertime:", 0, 0, "R");
		$this->objRprt->Cell(0, 4, $arrLateUndPrMnth["count"], 0, 0, "L");

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(135, 4, "Total Number of Absences:", 0, 0, "R");
		$this->objRprt->Cell(0, 4, $arrLateUndPrMnth["absent count"], 0, 0, "L");

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(135, 4, "Total Excess:", 0, 0, "R");
		$this->objRprt->Cell(0, 4, $strExcessPrMnth, 0, 0, "L");

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(135, 4, "Total Overtime:", 0, 0, "R");
		$this->objRprt->Cell(0, 4, $strOvrtmPrMnth, 0, 0, "L");
			
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(10);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(0, 5, "NOTED BY: ", 0, 0, "L");
		$this->objRprt->Ln(15);
		$this->objRprt->Cell(90, 5, strtoupper($arrSgntry["signatory"]), 0, 0, "C");
		$this->objRprt->Cell(90, 5, strtoupper($strName), 0, 1, "C");		
		$this->objRprt->SetFont('Arial', "", 10);		
		$this->objRprt->Cell(90, 5, strtoupper($arrSgntry["signatoryTitle"]), 0, 0, "C");
		$this->objRprt->Cell(90, 5, "EMPLOYEE", 0, 1, "C");

		$this->objRprt->Ln(7);
		$this->objRprt->SetFont('Arial', "B", 6);
		$objLegend = mysql_query("SELECT * FROM tblAttendanceCode");

		$intLgndCntr = 0;
		while($arrLegend = mysql_fetch_array($objLegend))
		{
			if($intLgndCntr < 6)
			{
				$this->objRprt->Cell(32, 3, $arrLegend["code"]."-".$arrLegend["name"], 0, 0, "L");
				$intLgndCntr++;
			}
			else
			{
				$this->objRprt->Ln(3);
				$this->objRprt->Cell(32, 3, $arrLegend["code"]."-".$arrLegend["name"], 0, 0, "L");
				$intLgndCntr = 1;
			}
		}
				
	}
	
	function boldOB($dtmFrom, $dtmDTR)
	{
		if($dtmFrom == $dtmDTR)
		{
			return "B";
		}
		else
		{
			return "";
		}
	}
	
	function bodyPS($t_arrEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
		$strMonth = $this->intToMonthFull($t_intMonth);
		$strPay = $strMonth." ".$t_intYear;
		
		$strName = $t_arrEmpInfo["surname"].", ".$t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["middlename"];
		
		$objIncome = mysql_query("SELECT tblIncome.incomeDesc, tblEmpIncome.incomeAmount 
									FROM tblEmpIncome 
								INNER JOIN tblIncome
									ON tblIncome.incomeCode = tblEmpIncome.incomeCode
								WHERE tblEmpIncome.empNumber = '".$t_arrEmpInfo["empNumber"]."' 
									AND tblEmpIncome.incomeYear = '$t_intYear'
									AND tblEmpIncome.incomeCode = 'MS'
									AND tblEmpIncome.incomeMonth = '$t_intMonth'");

		$objDeduct = mysql_query("SELECT tblDeduction.deductionDesc, tblEmpDeductRemit.deductAmount 
									FROM tblEmpDeductRemit
								INNER JOIN tblDeduction
									ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode
								WHERE tblEmpDeductRemit.empNumber = '".$t_arrEmpInfo["empNumber"]."' 
									AND tblEmpDeductRemit.deductYear = '$t_intYear'
									AND tblEmpDeductRemit.deductMonth = '$t_intMonth'");						
		
		$this->objRprt->SetFont('Arial','B',12);
		$this->objRprt->Ln(8);
		$this->objRprt->Cell(0,10,strtoupper($t_arrEmpInfo["header"]).' PAY-SLIP FOR '.strtoupper($strPay),0,0,'C');

		$this->objRprt->Ln(8);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(30);
		$this->objRprt->Cell(15,10, "Name: ",0,0,'L');
		$this->objRprt->SetFont('Arial','',10);		
		$this->objRprt->Cell(0,10, $strName,0,0,'L');

		$this->objRprt->Ln(8);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(30);
		$this->objRprt->Cell(0,10, "INCOME ",0,0,'L');
		
		$intSumIncome = 0;
		while($arrIncome = mysql_fetch_array($objIncome))
		{
			$this->objRprt->Ln(6);
			$this->objRprt->Cell(35);		
			$this->objRprt->SetFont('Arial','B',10);
			$this->objRprt->Cell(35, 10, $arrIncome["incomeDesc"],0,0,'L');
			$this->objRprt->SetFont('Arial',"",10);		
			$this->objRprt->Cell(35,10, number_format($arrIncome["incomeAmount"], 2, ".", ","),0,0,"R");
			$intSumIncome = $intSumIncome + $arrIncome["incomeAmount"];
		}

		$this->objRprt->Ln(6);
		$this->objRprt->Cell(35);		
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(45, 10, "Total Income: ",0,0,'L');		
		$this->objRprt->Cell(50,10, number_format($intSumIncome, 2, ".", ","),0,0,"R");

		$this->objRprt->Ln(8);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(30);		
		$this->objRprt->Cell(0,10, "DEDUCTION(S) ",0,0,'L');

		$intSumDeduct = 0;
		while($arrDeduct = mysql_fetch_array($objDeduct))
		{
			$this->objRprt->Ln(6);
			$this->objRprt->Cell(35);					
			$this->objRprt->SetFont('Arial','B',10);
			$this->objRprt->Cell(35, 10, $arrDeduct["deductionDesc"], 0, 0, 'L');
			$this->objRprt->SetFont('Arial',"",10);		
			$this->objRprt->Cell(35,10, number_format($arrDeduct["deductAmount"], 2, ".", ","), 0, 0, "R");
			$intSumDeduct = $intSumDeduct + $arrDeduct["deductAmount"];
		}	
//------------------------- Absent Undertime WOP -----------------------------		
		$intDayAbsUndLate = $this->getWithoutPay($t_arrEmpInfo["empNumber"], $t_arrEmpInfo["leaveEntitled"], $t_intMonth, $t_intYear);		
		$intPaymentBasis = $this->getPaymentBasis($t_arrEmpInfo["appointmentCode"], $t_intMonth, $t_intYear);
		$intPerDay = $intSumIncome / $intPaymentBasis;
		$intDeductAbsUndLate = $intDayAbsUndLate * $intPerDay;
		
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(35);					
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(35, 10, "Absent, Undertime and Late", 0, 0, 'L');
		$this->objRprt->SetFont('Arial',"",10);		
		$this->objRprt->Cell(35,10, number_format($intDeductAbsUndLate, 2, ".", ","), 0, 0, "R");
		$intSumDeduct = $intSumDeduct + $intDeductAbsUndLate;			
//--------------------------------------------------------------------------------
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(35);		
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(45, 10, "Total Deduction: ",0,0,'L');
		$this->objRprt->Cell(50,10, number_format($intSumDeduct, 2, ".", ","),0,0,"R");
		
		$intNetPay = $intSumIncome-$intSumDeduct;
		
		$this->objRprt->Ln(8);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(30);
		$this->objRprt->Cell(50, 10, "NET PAY . . . . . . ",0,0,'L');
		$this->objRprt->SetFont('Arial','BU',10);		
		$this->objRprt->Cell(50,10, number_format($intNetPay, 2, ".", ","),0,0,'R');
		
		$this->objRprt->Ln(8);
		$this->objRprt->SetFont('Arial','B',10);
		$this->objRprt->Cell(0, 10, "Pay based on Monthly Salary",0,0,'C');

		switch($t_arrAgency["salarySchedule"])
		{
			case MONTHLY:
				$intPayBased = 1;
				$strDesc = " Month    ";   //example 1st Half, 2nd Half
				break;
			
			case BIMONTHLY:
				$intPayBased = 2;
				$strDesc = " Half    ";   //example 1st Half, 2nd Half
				break;
			
			case WEEKLY:
				$intPayBased = 4;
				$strDesc = " Week    ";   //example 1st Week, 2nd Week
				break;
		}

		for($intCounter=1; $intCounter<=$intPayBased; $intCounter++)
		{
			if ($intPayBased > 1)
			{
				$strDate = $this->combineDate($t_intYear, $t_intMonth, $intCounter);
				$strOrdinalSuffix = date("jS", strtotime($strDate)); 
			}
			$fltPayBasedSalary = $intNetPay/$intPayBased;
			$intPayBasedSalary = intval($intNetPay/$intPayBased);

			if($intCounter == $intPayBased)
			{   //kasi sa huling sweldo plus ung mga remaining decimals chuva
				$fltDecimal = $fltPayBasedSalary - $intPayBasedSalary;    //kuhanin ung butal na decimal
				$fltDecimal = $fltDecimal * $intPayBased;    //times mo un kng ilan per week
				$intPayBasedSalary = $intPayBasedSalary + $fltDecimal;   //plus mo sa sweldo na integer
			}
			
			$strPayBased = $strOrdinalSuffix.$strDesc.number_format($intPayBasedSalary,2,".",",");
			
			$this->objRprt->Ln(6);
			$this->objRprt->SetFont('Arial','B',10);		
			$this->objRprt->Cell(0, 10, $strPayBased, 0, 0,'C');
		}
		
		$this->objRprt->Ln(30);
	}
	
	function checkIfNull($t_dtmTimeIn, $t_dtmTimeOut)
	{
		$blnIn = $t_dtmTimeIn != NULLTIME;
		$blnOut = $t_dtmTimeOut != NULLTIME;
		return $blnIn || $blnOut;				
	}
	
	function empInfoHeader($t_arrEmpInfo)
	{
		$strName = strtoupper($t_arrEmpInfo["surname"]).", ".strtoupper($t_arrEmpInfo["firstname"])." ".strtoupper($t_arrEmpInfo["middlename"]);
		$strEmpNmbr = $t_arrEmpInfo["empNumber"];

		if ($t_arrEmpInfo["birthday"] != "0000-00-00")
		{
			$intBdayMonth = $this->epochDate('n', $t_arrEmpInfo["birthday"]);
			$intBdayDay = $this->epochDate('j', $t_arrEmpInfo["birthday"]);
			$intBdayYear = $this->epochDate('Y', $t_arrEmpInfo["birthday"]);
			$intBdayMonth = $this->intToMonthFull($intBdayMonth);
			$strBdayDate = $intBdayMonth." ".$intBdayDay.", ".$intBdayYear;
		}
		else
		{
			$strBdayDate = "";
		}
		$arrEmp = array(
			0 => array("title"=>"Employee Number: ", "emp"=>$strEmpNmbr),
			1 => array("title"=>"Name: ", "emp"=>$strName),
			2 => array("title"=>"Date of Birth: ", "emp"=>$strBdayDate),
			3 => array("title"=>"Place of Birth: ", "emp"=>$t_arrEmpInfo["birthPlace"])						
		);
		return $arrEmp;
	}
	
	function bodyLB($t_arrEmpInfo, $t_arrAgency)
	{
		$strSQL = "SELECT * FROM tblEmpLeaveBalance 
								WHERE";
		if ($_SESSION['FromToLB']["Period"])   //get the month from, year from and To
		{
			for ($intCount=$_SESSION['FromToLB']["YearFrom"]; $intCount<=$_SESSION['FromToLB']["YearTo"]; $intCount++)   
			{
				if($intCount == $_SESSION['FromToLB']["YearFrom"] && $intCount == $_SESSION['FromToLB']["YearTo"])
				{
					$strLgclOprtr = "";
					$intMonthFrom = $_SESSION['FromToLB']["MonthFrom"];
					$intMonthTo = $_SESSION['FromToLB']["MonthTo"];				
					
				}
				elseif($intCount == $_SESSION['FromToLB']["YearTo"])
				{   //in case same year - AND parin ang value
					$strLgclOprtr = "OR";
					$intMonthFrom = FIRST_MONTH;
					$intMonthTo = $_SESSION['FromToLB']["MonthTo"];				
				}
				elseif($intCount == $_SESSION['FromToLB']["YearFrom"])
				{
					$strLgclOprtr = "";
					$intMonthFrom = $_SESSION['FromToLB']["MonthFrom"];
					$intMonthTo = END_MONTH;
				}
				else
				{
					$strLgclOprtr = "OR";
					$intMonthFrom = FIRST_MONTH;
					$intMonthTo = END_MONTH;				
				}
				
				$strSQL = $strSQL." $strLgclOprtr 
									(empNumber='".$t_arrEmpInfo["empNumber"]."' 
									AND (periodMonth >= $intMonthFrom AND periodYear = $intCount)
									AND (periodMonth <= $intMonthTo AND periodYear = $intCount))"; 
			}
		}
		else
		{
			$strSQL = $strSQL." empNumber='".$t_arrEmpInfo["empNumber"]."'";
		}
		
		if ($t_arrEmpInfo['longevityDate'] != "0000-00-00")
		{
			$intLngvtyMonth = $this->epochDate('n', $t_arrEmpInfo['longevityDate']);
			$intLngvtyDay = $this->epochDate('j', $t_arrEmpInfo['longevityDate']);
			$intLngvtyYear = $this->epochDate('Y', $t_arrEmpInfo['longevityDate']);
			$intLngvtyMonth = $this->intToMonthFull($intLngvtyMonth);
			$strLngvtyDate = $intLngvtyMonth." ".$intLngvtyDay.", ".$intLngvtyYear;
		}
		else
		{
			$strLngvtyDate = "";
		}
		
		$strSQL = $strSQL." ORDER BY periodYear, periodMonth";
		$objLB = mysql_query($strSQL);
		$strName = $t_arrEmpInfo["surname"].", ".$t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["middlename"];
		$arrInfo = array(
				0 => array("title1"=>"Employee Number: ", "value1"=>$t_arrEmpInfo["empNumber"], "title2"=>"Name: ", "value2"=>$strName),
				1 => array("title1"=>"Division: ", "value1"=>$t_arrEmpInfo["divisionCode"], "title2"=>"1st Day of Service: ", "value2"=>$strLngvtyDate)
				);

		$this->objRprt->SetFont('Arial','B',15);
		$this->objRprt->Cell(0,10,'LEAVE BALANCE',0,0,'C');
		$this->objRprt->Ln(10);

		$this->objRprt->SetX(-15);
		$intX = $this->objRprt->GetX();
		$this->objRprt->SetLineWidth(0.5);		

		$this->objRprt->Line(15, 55, $intX, 55);
		$this->objRprt->Line(15, 72, $intX, 72);
		$this->objRprt->Ln(5);

		$this->objRprt->SetLineWidth(0.1);
		for($intCounter=0; $intCounter<=1; $intCounter++)
		{
			$this->objRprt->SetFont('Arial', "B", 10);
			$this->objRprt->Cell(40, 5, $arrInfo[$intCounter]["title1"], 0, 0, "R");
			$this->objRprt->SetFont('Arial', "", 10);			
			$this->objRprt->Cell(20, 5, $arrInfo[$intCounter]["value1"], 0, 0, "L");
			$this->objRprt->SetFont('Arial', "B", 10);			
			$this->objRprt->Cell(30, 5, $arrInfo[$intCounter]["title2"], 0, 0, "R");
			$this->objRprt->SetFont('Arial', "", 10);			
			$this->objRprt->Cell(0, 5, $arrInfo[$intCounter]["value2"], 0, 0, "L");
			$this->objRprt->Ln(7);
		}

		$this->objRprt->Ln(7);
		$this->objRprt->SetFont('Arial', "B", 8);
		$this->objRprt->Cell(13, 5, "", "LTR", 0, "C");
		$this->objRprt->Cell(25, 5, "", "LTR", 0, "C");
		$this->objRprt->Cell(75, 5, "VACATION LEAVE", 1, 0, "C");
		$this->objRprt->Cell(67, 5, "SICK LEAVE", 1, 1, "C");

		$this->objRprt->Cell(13, 5, "Period", "LR", 0, "C");
		$this->objRprt->Cell(25, 5, "Particular", "LR", 0, "C");		
		$this->objRprt->Cell(12, 5, "", "LTR", 0, "C");
		$this->objRprt->Cell(24, 5, "Abs Und W/P", 1, 0, "C");
		$this->objRprt->Cell(15, 5, "", "LTR", 0, "C");
		$this->objRprt->Cell(24, 5, "Abs Und WOP", 1, 0, "C");
		$this->objRprt->Cell(12, 5, "", "LTR", 0, "C");
		$this->objRprt->Cell(20, 5, "", "LTR", 0, "C");
		$this->objRprt->Cell(15, 5, "", "LTR", 0, "C");
		$this->objRprt->Cell(20, 5, "", "LTR", 1, "C");

		$this->objRprt->Cell(13, 5, "", "LBR", 0, "C");
		$this->objRprt->Cell(25, 5, "", "LBR", 0, "C");		
		$this->objRprt->Cell(12, 5, "Earned", "LBR", 0, "C");
		$this->objRprt->Cell(12, 5, "tr/ut/hd", 1, 0, "C");
		$this->objRprt->Cell(12, 5, "Leave", 1, 0, "C");
		$this->objRprt->Cell(15, 5, "Balance", "LBR", 0, "C");
		$this->objRprt->Cell(12, 5, "tr/ut/hd", 1, 0, "C");
		$this->objRprt->Cell(12, 5, "Leave", 1, 0, "C");
		$this->objRprt->Cell(12, 5, "Earned", "LBR", 0, "C");
		$this->objRprt->Cell(20, 5, "Abs Und W/P", "LBR", 0, "C");
		$this->objRprt->Cell(15, 5, "Balance", "LBR", 0, "C");
		$this->objRprt->Cell(20, 5, "Abs Und WOP", "LBR", 0, "C");

		//get the startMonth and start year balance
		$objStartLB = mysql_query("SELECT lbStartMonth, lbStartYear FROM tblAgency");
		$arrStartLB = mysql_fetch_array($objStartLB);
		
		while($arrLB = mysql_fetch_array($objLB))
		{
			$strMonth = $this->intToMonthName($arrLB["periodMonth"]);
			$this->objRprt->SetFont('Arial', "", 8);		

			$intAbs = 0;
			$arrUnd = $this->getLateUndPrMonth($t_arrEmpInfo["empNumber"], $arrLB["periodMonth"], $arrLB["periodYear"]);

			$intUnd = $arrUnd["compute"] / WORKHOURS;
			$intHlfday = $arrUnd["half count"] * 0.5;
			$intUnd = $intUnd + $intHlfday;
			$intUnd = number_format($intUnd,3,".",",");
			if($intUnd != 0)
			{
				$arrPrtclrWPWOP = $this->particularWPWOP($arrLB["vlAbsUndWPay"], $intUnd);
				$intUndWP = $arrPrtclrWPWOP["WP"];
				$intUndWOP = $arrPrtclrWPWOP["WOP"];
			}
			else
			{
				$intUndWP = 0;
				$intUndWOP = 0;
			}
			
			$dtmMonthYear = $this->combineMonthYear($arrLB["periodYear"], $arrLB["periodMonth"]);
			
			$objOthInfo = mysql_query("SELECT DISTINCT otherInfo FROM tblEmpDTR
								WHERE dtrDate LIKE '$dtmMonthYear%' 
								AND empNumber = '".$t_arrEmpInfo["empNumber"]."'
								ORDER BY dtrDate");
			while($arrOthInfo = mysql_fetch_array($objOthInfo))
			{
				if ($arrLB["periodMonth"] != $arrStartLB["lbStartMonth"] && $arrStartLB["lbStartYear"] != $arrLB["periodYear"])
				{   //should not print the start entry
					$arrPrtclr = $this->particulars($t_arrEmpInfo["empNumber"], $arrLB["periodMonth"], $arrLB["periodYear"], $arrOthInfo["otherInfo"], $arrLB["vlAbsUndWPay"], $arrLB["slAbsUndWPay"], $intUndWP);
				}

				if(count($arrPrtclr) != 0)
				{
					$this->objRprt->Ln(5);
					$this->objRprt->Cell(13, 5, $strMonth." ".$arrLB["periodYear"], 1, 0, "L");
					$this->objRprt->Cell(25, 5, $arrPrtclr["particular"], 1, 0, "L");
					$this->objRprt->Cell(12, 5, "", 1, 0, "L");
					$this->objRprt->Cell(12, 5, "", 1, 0, "L");
					$this->objRprt->Cell(12, 5, number_format($arrPrtclr["vlAbsUndWP"],3,".",","), 1, 0, "L");
					$this->objRprt->Cell(15, 5, "", 1, 0, "L");
					$this->objRprt->Cell(12, 5, "", 1, 0, "L");
					$this->objRprt->Cell(12, 5, number_format($arrPrtclr["vlAbsUndWOP"],3,".",","), 1, 0, "L");
					$this->objRprt->Cell(12, 5, "", 1, 0, "L");
					$this->objRprt->Cell(20, 5, number_format($arrPrtclr["slAbsUndWP"],3,".",","), 1, 0, "L");
					$this->objRprt->Cell(15, 5, "", 1, 0, "L");
					$this->objRprt->Cell(20, 5, number_format($arrPrtclr["slAbsUndWOP"],3,".",","), 1, 0, "L");
				}
			}			
			
			//for monetization
			$objMonetize = mysql_query("SELECT vlMonetize, slMonetize FROM tblEmpMonetization
										WHERE monetizeMonth = '".$arrLB["periodMonth"]."' 
											AND monetizeYear ='".$arrLB["periodYear"]."'
											AND empNumber = '".$t_arrEmpInfo["empNumber"]."'");
			
			if(mysql_num_rows($objMonetize))
			{
				$arrMonetize = mysql_fetch_array($objMonetize);
				
				$this->objRprt->Ln(5);
				$this->objRprt->Cell(13, 5, $strMonth." ".$arrLB["periodYear"], 1, 0, "L");
				$this->objRprt->Cell(25, 5, "monetize", 1, 0, "L");
				$this->objRprt->Cell(12, 5, "", 1, 0, "L");
				$this->objRprt->Cell(12, 5, "", 1, 0, "L");
				$this->objRprt->Cell(12, 5, "", 1, 0, "L");
				$this->objRprt->Cell(15, 5, number_format($arrMonetize["vlMonetize"],3,".",","), 1, 0, "L");
				$this->objRprt->Cell(12, 5, "", 1, 0, "L");
				$this->objRprt->Cell(12, 5, "", 1, 0, "L");
				$this->objRprt->Cell(12, 5, "", 1, 0, "L");
				$this->objRprt->Cell(20, 5, "", 1, 0, "L");
				$this->objRprt->Cell(15, 5, number_format($arrMonetize["slMonetize"],3,".",","), 1, 0, "L");
				$this->objRprt->Cell(20, 5, "", 1, 0, "L");
			}
			
			if(number_format($arrLB["vlAbsUndWPay"],3,".","") > $intUndWP)
			{
				$intVLabsWP = $arrLB["vlAbsUndWPay"] - $intUndWP;
			}
			else
			{
				$intVLabsWP = 0;
			}
			
			if(number_format($arrLB["vlAbsUndWoPay"],3,".","") > $intUndWOP)
			{
				$intVLabsWOP = $arrLB["vlAbsUndWoPay"] - $intUndWOP;
			}
			else
			{
				$intVLabsWOP = 0;
			}
					
			$this->objRprt->Ln(5);
			$this->objRprt->Cell(13, 5, $strMonth." ".$arrLB["periodYear"], 1, 0, "L");
			$this->objRprt->Cell(25, 5, "Ending Balance", 1, 0, "L");
			$this->objRprt->Cell(12, 5, $arrLB["vlEarned"], 1, 0, "L");
			$this->objRprt->Cell(12, 5, number_format($intUndWP,3,".",","), 1, 0, "L");
			$this->objRprt->Cell(12, 5, number_format($intVLabsWP,3,".",","), 1, 0, "L");
			$this->objRprt->Cell(15, 5, $arrLB["vlBalance"], 1, 0, "L");
			$this->objRprt->Cell(12, 5, number_format($intUndWOP,3,".",","), 1, 0, "L");
			$this->objRprt->Cell(12, 5, number_format($intVLabsWOP,3,".",","), 1, 0, "L");
			$this->objRprt->Cell(12, 5, $arrLB["slEarned"], 1, 0, "L");
			$this->objRprt->Cell(20, 5, $arrLB["slAbsUndWPay"], 1, 0, "L");
			$this->objRprt->Cell(15, 5, $arrLB["slBalance"], 1, 0, "L");
			$this->objRprt->Cell(20, 5, $arrLB["slAbsUndWoPay"], 1, 0, "L");			
		}
	}
	
	function bodyAS($t_arrEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
//---------------------------- entries for attendance summary ------------------------------------------
		if($t_arrEmpInfo["leaveEntitled"] == 'Y')
		{
			$intVL = $this->getLeftSLVL($t_intMonth, $t_intYear, $t_arrEmpInfo["empNumber"], "VL");
		}
		if($intVL < 0)
		{
			$intVL = 0;
		}
		
		if($t_arrEmpInfo["leaveEntitled"] == 'Y')
		{
			$intSL = $this->getLeftSLVL($t_intMonth, $t_intYear, $t_arrEmpInfo["empNumber"], "SL");									  
		}	
		if($intSL < 0)
		{
			$intSL = 0;						
		}
//------------------------------------ excess and number tary/undertime---------------------------
		$arrDTR = $this->getEmpDTR($t_arrEmpInfo["empNumber"], $t_intMonth, $t_intYear);
		$arrLateUnd = $this->getLateUndPrMonth($t_arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, $arrDTR);
		if(strlen($arrLateUnd["day"] == 0))
		{
			$intLateUnd = 0;
			$strLateUnd = "XXXX";
			$dtmLateUnd = "0.000";
		}
		else
		{
			$intLateUnd = $arrLateUnd["count"];
			$strLateUnd = strtr(trim($arrLateUnd["day"]), " ", ",");
			$dtmLateUnd = $arrLateUnd["display"];
		}
		
		if(strlen($arrLateUnd["absent day"] == 0))
		{
			$strAbsDay = "XXXX";
			$intAbsCount = "0";
		}
		else
		{
			$strAbsDay = strtr(trim($arrLateUnd["absent day"]), " ", ",");
			$intAbsCount = $arrLateUnd["absent count"];
		}
		
		if(strlen($arrLateUnd["half day"] == 0))
		{
			$strHlfDay = "XXXX";
			$intHlfCount = "0";
		}
		else
		{
			$strHlfDay = strtr(trim($arrLateUnd["half day"]), " ", ",");
			$intHlfCount = $arrLateUnd["half count"];
		}

		$strWrkHr = $this->getWrkHrPrMonth($t_arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, $arrDTR);		
		$strOvrtm = $this->getOvrtmPrMonth($t_arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, $arrDTR);
		$strExcess = $this->getExcessPrMonth($t_arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, $arrDTR);
//------------------------------------------ report code ----------------------------------------------
		$strMonth = $this->intToMonthFull($t_intMonth);
		$strPay = $strMonth." ".$t_intYear;
		
		$strName = $t_arrEmpInfo["surname"].", ".$t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["middlename"];

		$arrInfo = array(
				0 => array("title1"=>"Employee Number: ", "value1"=>$t_arrEmpInfo["empNumber"], "title2"=>"Name: ", "value2"=>$strName),
				1 => array("title1"=>"Division: ", "value1"=>$t_arrEmpInfo["divisionCode"], "title2"=>"Pay Ending: ", "value2"=>$strPay)
				);
		
		$arrAttndSmry = array(
			0 => array("title"=>"Days Absent: ", "value"=>strtr($strAbsDay," ",",")),
			1 => array("title"=>"Number of Absent: ", "value"=>$intAbsCount),
			2 => array("title"=>"Days Late/Undertime: ", "value"=>strtr($strLateUnd," ",",")),
			3 => array("title"=>"Total Late/Undertime: ", "value"=>$dtmLateUnd),
			4 => array("title"=>"Number Late/Undertime: ", "value"=>$intLateUnd),
			5 => array("title"=>"Days Half-day: ", "value"=>strtr($strHlfDay," ",",")),
			6 => array("title"=>"Number of Half-day: ", "value"=>$intHlfCount),
			7 => array("title"=>"Total Excess Time: ", "value"=>$strExcess),
			8 => array("title"=>"Total Overtime: ", "value"=>$strOvrtm),
			9 => array("title"=>"Total Work Time: ", "value"=>$strWrkHr),
			10 => array("title"=>"Vacation Leave Left: ", "value"=>number_format($intVL,"3",".","")),
			11 => array("title"=>"Sick Leave Left: ", "value"=>number_format($intSL,"3",".",""))
			);
		
		$this->objRprt->SetFont('Arial','B',15);
		$this->objRprt->Ln(15);
		$this->objRprt->Cell(0,10,'ATTENDANCE SUMMARY',0,0,'C');
		$this->objRprt->Ln(10);

		$this->objRprt->SetX(-15);
		$intX = $this->objRprt->GetX();
		$this->objRprt->SetLineWidth(0.5);		

		$this->objRprt->Line(15, 37, $intX, 37);
		$this->objRprt->Line(15, 55, $intX, 55);
		$this->objRprt->Ln(5);
	
		for($intCounter=0; $intCounter<=1; $intCounter++)
		{
			$this->objRprt->SetFont('Arial', "B", 10);
			$this->objRprt->Cell(40, 5, $arrInfo[$intCounter]["title1"], 0, 0, "R");
			$this->objRprt->SetFont('Arial', "", 10);			
			$this->objRprt->Cell(20, 5, $arrInfo[$intCounter]["value1"], 0, 0, "L");
			$this->objRprt->SetFont('Arial', "B", 10);			
			$this->objRprt->Cell(30, 5, $arrInfo[$intCounter]["title2"], 0, 0, "R");
			$this->objRprt->SetFont('Arial', "", 10);			
			$this->objRprt->Cell(0, 5, $arrInfo[$intCounter]["value2"], 0, 0, "L");
			$this->objRprt->Ln(7);
		}
		$this->objRprt->Ln(7);

		for($intCounter=0; $intCounter<=count($arrAttndSmry); $intCounter++)
		{
			$this->objRprt->SetFont('Arial', "B", 10);
			$this->objRprt->Cell(70, 5, $arrAttndSmry[$intCounter]["title"], 0, 0, "R");
			$this->objRprt->SetFont('Arial', "", 10);
			$this->objRprt->Cell(0, 5, $arrAttndSmry[$intCounter]["value"], 0, 0, "L");
			$this->objRprt->Ln(5);
		}

		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial','B',10);		
		$this->objRprt->Cell(0, 5, 'CERTIFIED CORRECT', 0, 0, 'C');

		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial','',10);		
		$this->objRprt->Cell(90, 5, date("l, F d, Y"), 0, 0, 'C');
		$this->objRprt->SetFont('Arial','B',10);				
		$this->objRprt->Cell(90, 5, strtoupper($arrSgntry["signatory"]), 0, 0, 'C');		

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(90, 5, 'Date', 0, 0, 'C');
		$this->objRprt->Cell(90, 5, $arrSgntry["signatoryTitle"], 0, 0, 'C');				
		
	}

	function bodyEAS($t_arrEmpInfo, $t_arrAgency, $t_intPeriod, $t_intYear)
	{
		$this->objRprt->SetFont('Arial','B',15);
		$this->objRprt->Cell(0,7,strtoupper($t_arrAgency["agencyName"]),0,1,'C');
		$this->objRprt->Cell(0,7,'EMPLOYEE ATTENDANCE SUMMARY LEDGER',0,0,'C');
		$this->objRprt->Ln(10);
		
		$this->objRprt->SetFont('Arial','B',12);

		$this->objRprt->Cell(30, 5, "NAME:", 0, 0, 'L');
		$strName = $t_arrEmpInfo["surname"].", ".$t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["middlename"];
		$this->objRprt->SetFont('Arial','U',12);
		$this->objRprt->Cell(0,5,strtoupper($strName),0,1,'L');

		$this->objRprt->SetFont('Arial','B',12);
		$this->objRprt->Cell(30,5,'POSITION:',0,0,'L');
		$this->objRprt->SetFont('Arial','U',12);
		$this->objRprt->Cell(0,5,strtoupper($t_arrEmpInfo["positionDesc"]),0,1,'L');
		
		$this->objRprt->SetFont('Arial','B',12);
		$this->objRprt->Cell(30,5,'DIVISION:',0,0,'L');
		$this->objRprt->SetFont('Arial','U',12);
		$this->objRprt->Cell(0,5,strtoupper($t_arrEmpInfo["divisionName"]),0,1,'L');

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial','B',9);
		$this->objRprt->Cell(30,4,'Entries','LTR',0,'C');
		$this->objRprt->Cell(20,4,'',1,0,'C');
		$this->objRprt->Cell(50,4,'Tardy/Undertime',1,0,'C');
		$this->objRprt->Cell(60,4,'Approved No. of Days',1,0,'C');
		$this->objRprt->Cell(25,4,'Number','LTR',0,'C');
		$this->objRprt->Cell(80,4,'Official Business',1,0,'C');
		$this->objRprt->Cell(0,4,'',1,1,'C');

		$this->objRprt->Cell(30,4,'Certified','LR',0,'C');
		$this->objRprt->Cell(20,4,'','LR',0,'C');
		$this->objRprt->Cell(20,4,'No. of','LTR',0,'C');
		$this->objRprt->Cell(30,4,'Total','LTR',0,'C');
		$this->objRprt->Cell(15,4,'','LTR',0,'C');
		$this->objRprt->Cell(15,4,'','LTR',0,'C');
		$this->objRprt->Cell(15,4,'','LTR',0,'C');
		$this->objRprt->Cell(15,4,'','LTR',0,'C');
		$this->objRprt->Cell(25,4,'of Days','LR',0,'C');
		$this->objRprt->Cell(10,4,'','LTR',0,'C');
		$this->objRprt->Cell(20,4,'','LTR',0,'C');
		$this->objRprt->Cell(50,4,'','LTR',0,'C');
		$this->objRprt->Cell(0,4,'','RL',1,'C');

		$this->objRprt->Cell(30,4,'Correct by','LR',0,'C');
		$this->objRprt->Cell(20,4,'CY '.$t_intYear,'LR',0,'C');
		$this->objRprt->Cell(20,4,'Times','LR',0,'C');
		$this->objRprt->Cell(30,4,'Hrs/Min/Sec','LR',0,'C');
		$this->objRprt->Cell(15,4,'SL','LR',0,'C');
		$this->objRprt->Cell(15,4,'VL/FL','LR',0,'C');
		$this->objRprt->Cell(15,4,'PL','LR',0,'C');
		$this->objRprt->Cell(15,4,'ML/PTL','LR',0,'C');
		$this->objRprt->Cell(25,4,'AWOL','LR',0,'C');
		$this->objRprt->Cell(10,4,'Date','LR',0,'C');
		$this->objRprt->Cell(20,4,'Time','LR',0,'C');
		$this->objRprt->Cell(50,4,'Purpose','LR',0,'C');
		$this->objRprt->Cell(0,4,'Remarks','RL',1,'C');

		$this->objRprt->Cell(30,4,'HRMO III','LBR',0,'C');
		$this->objRprt->Cell(20,4,'','LBR',0,'C');
		$this->objRprt->Cell(20,4,'','LBR',0,'C');
		$this->objRprt->Cell(30,4,'','LBR',0,'C');
		$this->objRprt->Cell(15,4,'','LBR',0,'C');
		$this->objRprt->Cell(15,4,'','LBR',0,'C');
		$this->objRprt->Cell(15,4,'','LBR',0,'C');
		$this->objRprt->Cell(15,4,'','LBR',0,'C');
		$this->objRprt->Cell(25,4,'','LBR',0,'C');
		$this->objRprt->Cell(10,4,'','LBR',0,'C');
		$this->objRprt->Cell(20,4,'','LBR',0,'C');
		$this->objRprt->Cell(50,4,'','LBR',0,'C');
		$this->objRprt->Cell(0,4,'','LBR',1,'C');

		if($t_intPeriod == 1)
		{
			$arrMonth = array(0=>"1", 1=>"2", 2=>"3", 3=>"4", 4=>"5", 5=>"6");
		}
		elseif($t_intPeriod == 2)
		{
			$arrMonth = array(0=>"7", 1=>"8", 2=>"9", 3=>"10", 4=>"11", 5=>"12");
		}

		for ($intCtr = 0; $intCtr < 6; $intCtr++)
		{

			$arrDTR = $this->getEmpDTR($t_arrEmpInfo["empNumber"], $arrMonth[$intCtr], $t_intYear);
			$arrLateUnd = $this->getLateUndPrMonth($t_arrEmpInfo["empNumber"], $arrMonth[$intCtr], $t_intYear, $arrDTR);
			
			$intVL = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $t_arrEmpInfo["empNumber"], VACLEAVE);
			$intHVL = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $t_arrEmpInfo["empNumber"], HVACLEAVE);
			$intVL = $intVL + ($intHVL * 0.5);

			$intSL = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $t_arrEmpInfo["empNumber"], SICKLEAVE);
			$intHSL = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $t_arrEmpInfo["empNumber"], HSICKLEAVE);
			$intSL = $intSL + ($intHSL * 0.5);
			
			
			$intPL = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $t_arrEmpInfo["empNumber"], PRIVLEAVE);
			$intPTL = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $t_arrEmpInfo["empNumber"], PATLEAVE);
			$intML = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $t_arrEmpInfo["empNumber"], MATLEAVE);
			$intMPTL = $intPTL + $intML;
			
			$intAWOL = $intSL + $intVL + $intPL + $intMPTL;
			
			if($arrLateUnd["absent count"] > $intAWOL)
			{
				$intAWOL = $arrLateUnd["absent count"] - $intAWOL;
			}
			else
			{
				$intAWOL = 0;
			}
			
			
			
			$this->objRprt->SetFont('Arial','',9);
			$strMonth = $this->intToMonthFull($arrMonth[$intCtr]);
			$this->objRprt->Cell(30,4,'','LTR',0,'C');
			$this->objRprt->Cell(20,4,$strMonth,'LTR',0,'C');
			$this->objRprt->Cell(20,4,$arrLateUnd["count"],'LTR',0,'C');
			
			if($arrLateUnd["display"] == "0:0:0")
			{
				$strDisplay = '';
			}
			else
			{
				$strDisplay = $arrLateUnd["display"];
			}
			
			$this->objRprt->Cell(30,4, $strDisplay,'LTR',0,'C');
			$this->objRprt->Cell(15,4, $intSL,'LTR',0,'C');
			$this->objRprt->Cell(15,4, $intVL,'LTR',0,'C');
			$this->objRprt->Cell(15,4, $intPL,'LTR',0,'C');
			$this->objRprt->Cell(15,4, $intMPTL,'LTR',0,'C');
			$this->objRprt->Cell(25,4, $intAWOL,'LTR',0,'C');
			
			$dtmDate = $this->combineMonthYear($t_intYear, $arrMonth[$intCtr]);
			$strSQL = "SELECT *	FROM tblEmpOB
						WHERE empNumber = '".$t_arrEmpInfo["empNumber"]."' 
						AND (obDateFrom LIKE '$dtmDate%' OR obDateTo LIKE '$dtmDate%')
						ORDER BY obDateFrom";

			$objOB = mysql_query($strSQL);
			$intEmpOB = mysql_num_rows($objOB);
			
			if($intEmpOB > 1)
			{
				$intCtrOB = 0;

				while($arrOB = mysql_fetch_array($objOB))
				{
					$intCtrOB = $intCtrOB + 1;
					
					if($intCtrOB == 1)
					{
						$this->objRprt->Cell(10,4, date("d", strtotime($arrOB["obDateFrom"])),'LTR',0,'C');
						$this->objRprt->Cell(20,4, date("h:i a", strtotime($arrOB["obTimeFrom"])),'LTR',0,'C');
						$this->objRprt->Cell(50,4, $arrOB["purpose"],'LTR',0,'L');
						$this->objRprt->Cell(0,4, '','LTR',1,'L');
					}
					else
					{
						$this->objRprt->Cell(30,4, '','LR',0,'C');
						$this->objRprt->Cell(20,4, '','LR',0,'C');
						$this->objRprt->Cell(20,4, '','LR',0,'C');
						$this->objRprt->Cell(30,4, '','LR',0,'C');
						$this->objRprt->Cell(15,4, '','LR',0,'C');
						$this->objRprt->Cell(15,4, '','LR',0,'C');
						$this->objRprt->Cell(15,4, '','LR',0,'C');
						$this->objRprt->Cell(15,4, '','LR',0,'C');
						$this->objRprt->Cell(25,4, '','LR',0,'C');
						$this->objRprt->Cell(10,4, date("d", strtotime($arrOB["obDateFrom"])),'LR',0,'C');
						$this->objRprt->Cell(20,4, date("h:i a", strtotime($arrOB["obTimeFrom"])),'LR',0,'C');
						$this->objRprt->Cell(50,4, $arrOB["purpose"],'LR',0,'L');
						$this->objRprt->Cell(0,4, '','LR',1,'L');					
					}
				}

				$this->objRprt->Cell(30,4, '','LBR',0,'C');
				$this->objRprt->Cell(20,4, '','LBR',0,'C');
				$this->objRprt->Cell(20,4, '','LBR',0,'C');
				$this->objRprt->Cell(30,4, '','LBR',0,'C');
				$this->objRprt->Cell(15,4, '','LBR',0,'C');
				$this->objRprt->Cell(15,4, '','LBR',0,'C');
				$this->objRprt->Cell(15,4, '','LBR',0,'C');
				$this->objRprt->Cell(15,4, '','LBR',0,'C');
				$this->objRprt->Cell(25,4, '','LBR',0,'C');
				$this->objRprt->Cell(10,4, '','LBR',0,'C');
				$this->objRprt->Cell(20,4, '','LBR',0,'C');
				$this->objRprt->Cell(50,4, '','LBR',0,'L');
				$this->objRprt->Cell(0,4, '','LBR',1,'L');									
			}
			elseif($intEmpOB == 1)
			{
				$arrOB = mysql_fetch_array($objOB);
				$this->objRprt->Cell(10,4, date("d", strtotime($arrOB["obDateFrom"])),'LTR',0,'C');
				$this->objRprt->Cell(20,4, date("h:i a", strtotime($arrOB["obTimeFrom"])),'LTR',0,'C');
				$this->objRprt->Cell(50,4, $arrOB["purpose"],'LTR',0,'L');
				$this->objRprt->Cell(0,4, '','LTR',1,'L');

				$this->objRprt->Cell(30,4, '','LBR',0,'C');
				$this->objRprt->Cell(20,4, '','LBR',0,'C');
				$this->objRprt->Cell(20,4, '','LBR',0,'C');
				$this->objRprt->Cell(30,4, '','LBR',0,'C');
				$this->objRprt->Cell(15,4, '','LBR',0,'C');
				$this->objRprt->Cell(15,4, '','LBR',0,'C');
				$this->objRprt->Cell(15,4, '','LBR',0,'C');
				$this->objRprt->Cell(15,4, '','LBR',0,'C');
				$this->objRprt->Cell(25,4, '','LBR',0,'C');
				$this->objRprt->Cell(10,4, '','LBR',0,'C');
				$this->objRprt->Cell(20,4, '','LBR',0,'C');
				$this->objRprt->Cell(50,4, '','LBR',0,'L');
				$this->objRprt->Cell(0,4, '','LBR',1,'L');												
			}
			else
			{
				$this->objRprt->Cell(10,4, '', 'LTR', 0, 'C');
				$this->objRprt->Cell(20,4, '', 'LTR', 0, 'C');
				$this->objRprt->Cell(50,4, '', 'LTR', 0, 'L');
				$this->objRprt->Cell(0,4, '','LTR', 1, 'L');
				
				$this->objRprt->Cell(30,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(20,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(20,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(30,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(15,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(15,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(15,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(15,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(25,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(10,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(20,4, '', 'LBR', 0, 'C');
				$this->objRprt->Cell(50,4, '', 'LBR', 0, 'L');
				$this->objRprt->Cell(0,4, '', 'LBR', 1, 'L');																
			}
		}    //end for loop month
		
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(20,4, 'Note:', 0, 0, 'R');
		$this->objRprt->Cell(40,4, 'On Travel with SO:', 0, 0, 'L');
		$this->objRprt->Cell(160);
		$this->objRprt->Cell(10,4, 'Legend:', 0, 0, 'R');
		$this->objRprt->Cell(30,4, 'SL - Sick Leave', 0, 0, 'L');
		$this->objRprt->Cell(0,4, 'VL/FL - Vacation Leave/Force Leave', 0, 1, 'L');
		
		$this->objRprt->Cell(20,4, '', 0, 0, 'R');
		$this->objRprt->Cell(40,4, 'Period, SO No.', 0, 0, 'L');
		$this->objRprt->Cell(160);
		$this->objRprt->Cell(10,4, '', 0, 0, 'R');
		$this->objRprt->Cell(30,4, 'PL - Privilege Leave', 0, 0, 'L');
		$this->objRprt->Cell(0,4, 'ML/PTL - Maternity Leave/Paternity Leave', 0, 1, 'L');
		
		$this->objRprt->Cell(230);
		$this->objRprt->Cell(0,4, 'AWOL - Absent w/o official Leave', 0, 1, 'L');
		
	}
	
	function bodyCNAC($t_arrEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
		$strName = $t_arrEmpInfo['firstname']." ".$t_arrEmpInfo['middlename']
					." ".$t_arrEmpInfo['surname'];

		$strPronoun = $this->pronoun($t_arrEmpInfo['sex']);
		
		$strPrgrph1 = "     This is to certify that ".strtoupper($strName)
					.", ".$t_arrEmpInfo['positionDesc'].", ".$t_arrEmpInfo['divisionName']
					.", has no pending administrative and criminal charges filed "
					."against ".strtolower($strPronoun)." in this Office.";
		
		$strPrgrph2 = "     This certification is being issued to ".strtoupper($strName)
					." for whatever purpose it may serve ".strtolower($strPronoun).".";					
		$this->objRprt->Ln(20);
		
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, date("d F Y"), 0, 0, "R");
		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "BU", 16);
		$this->objRprt->Cell(0, 5, "C E R T I F I C A T I O N", 0, 0, "C");

		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, "TO WHOM IT MAY CONCERN:", 0, 0, "L");

		$this->objRprt->Ln(15);
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->MultiCell(0, 6, $strPrgrph1, 0, 'J', 0);
		
		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 6, $strPrgrph2, 0, 'J', 0);
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$this->objRprt->Ln(10);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','B',11);		
		$this->objRprt->Cell(0,10,strtoupper($arrSgntry["signatory"]),0,0,'C');

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(0,10,$arrSgntry["signatoryTitle"],0,0,'C');
	}

	function bodyADR($t_arrEmpInfo, $t_arrAgency)
	{
		$strName = $t_arrEmpInfo['firstname']." ".$t_arrEmpInfo['middlename']
					." ".$t_arrEmpInfo['surname'];

		$strPronoun = $this->pronoun2($t_arrEmpInfo['sex']);
		
		$strPrgrph1 = "     This is to certify that ".strtoupper($strName)
					.", ".$t_arrEmpInfo['positionDesc'].", ".$t_arrEmpInfo['divisionName']
					." of ".$t_arrAgency["agencyName"]
					." assumed the duties and responsibilities of "
					.strtolower($strPronoun)." position on "
					.date("F d, Y",$t_arrEmpInfo['divisionName']).".";
		
		$this->objRprt->Ln(20);
		
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, date("F d, Y"), 0, 0, "R");
		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "BU", 16);
		$this->objRprt->Cell(0, 5, "C E R T I F I C A T I O N", 0, 0, "C");

		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, "TO WHOM IT MAY CONCERN:", 0, 0, "L");

		$this->objRprt->Ln(15);
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->MultiCell(0, 6, $strPrgrph1, 0, 'J', 0);
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$this->objRprt->Ln(10);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','B',12);		
		$this->objRprt->Cell(0,10,strtoupper($arrSgntry["signatory"]),0,0,'C');

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',12);				
		$this->objRprt->Cell(0,10,$arrSgntry["signatoryTitle"],0,0,'C');
	}

	function intToBuwan($t_intMonth)
	{
		$arrMonths = array(1=>"Enero", 2=>"Pebrero", 3=>"Marso", 
						4=>"Abril", 5=>"Mayo", 6=>"Hunyo", 
						7=>"Hulyo", 8=>"Augosto", 9=>"Septembre", 
						10=>"Oktubre", 11=>"Nobyembre", 12=>"Disyembre");
		return $arrMonths[$t_intMonth];
	}

	function bodyPK($t_arrEmpInfo, $t_arrAgency)
	{
		$strName = $t_arrEmpInfo['firstname']." ".$t_arrEmpInfo['middlename']
					." ".$t_arrEmpInfo['surname'];

		
		$strPrgrph1 = "     Ako, si ".strtoupper($strName)
					." ng ".strtoupper($t_arrAgency["agencyName"]).", ay taimtim na nanunumpa na tutuparin"
					." kong buong husay at katapatan, sa abot na aking kakayahan, ang mga tungkulin ng"
					." aking kasalukuyang katungkulan at ng mga iba pang pagkaraan nito'y gagampanan ko sa"
					." ilalim ng Republika ng Pilipinas; na aking itataguyod at ipagtatanggol ang"
					." Konstitusyon ng Pilipinas; na tunay na mananalig at tatalima ako rito; na susundin"
					." ko ang mga batas, mga kautusang legal, at mga dekretong pinaiiral ng mga sadyang"
					." itinakdang maykapangyarihan ng Republika ng Pilipinas at kusa kong babalikatin"
					." ang pananagutang ito, nang walang ano mang pasubali o hangaring umiwas.";
		
		$strPrgrph2 = "     Nilagdaan at pinanumpaan sa harap ko ngayon ika ".date("j")
					." ng ".$this->intToBuwan(date("n"))." ".date("Y").", A.D., sa Bicutan, Taguig, Metro Manila, Pilipinas.";					
		
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, "Pormularyong S.S. Blg. 32", 0, 0, "L");
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "", 14);
		$this->objRprt->Cell(0, 5, "REPUBLIKA NG PILIPINAS", 0, 1, "C");
		$this->objRprt->Cell(0, 5, "KOMISYON NG SERBISYO SIBIL", 0, 0, "C");
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 16);
		$this->objRprt->Cell(0, 5, "PANUNUMPA SA KATUNGKULAN", 0, 0, "C");

		$this->objRprt->Ln(15);
		$this->objRprt->SetFont('Arial', "I", 12);
		$this->objRprt->MultiCell(0, 8, $strPrgrph1, 0, 'J', 0);
		
		$this->objRprt->Ln(2);
		$this->objRprt->Cell(0, 5, "                 KASIHAN NAWA AKO NG DIYOS.", 0, 0, "L");

		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Ln(20);
		$this->objRprt->Cell(100);
		$this->objRprt->Cell(0, 5, strtoupper($strName), 0, 1, "L");
		$this->objRprt->SetFont('Arial', "", 11);
		$this->objRprt->Cell(100);
		$this->objRprt->Cell(0, 5, "Com. Tax. Cert. No. ".$t_arrEmpInfo["comTaxNumber"], 0, 1, "L");
		$this->objRprt->Cell(100);
		$this->objRprt->Cell(0, 5, "Issued on ".$t_arrEmpInfo["issuedAt"], 0, 1, "L");
		$this->objRprt->Cell(100);
		$this->objRprt->Cell(0, 5, "Issued ".$t_arrEmpInfo["issuedOn"], 0, 1, "L");

		$this->objRprt->SetFont('Arial', "I", 12);
		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 8, $strPrgrph2, 0, 'J', 0);
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Director'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$this->objRprt->Ln(10);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','B',12);		
		$this->objRprt->Cell(0,10,strtoupper($arrSgntry["signatory"]),0,0,'C');

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',12);				
		$this->objRprt->Cell(0,10,$arrSgntry["signatoryTitle"],0,0,'C');
	}

	function bodyCCA($t_arrEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
		$strName = $t_arrEmpInfo['firstname']." ".$t_arrEmpInfo['middlename']
					." ".$t_arrEmpInfo['surname'];

		$strPronoun = $this->pronoun($t_arrEmpInfo['sex']);
		
		$strPrgrph1 = "     This is to certify that ".strtoupper($strName)
					.", ".$t_arrEmpInfo['positionDesc'].", ".$t_arrEmpInfo['divisionName']
					.", has not availed of any clothing allowance for the last "
					."twenty-four (24) months.";
		
		$strPrgrph2 = "     This certification is being issued to ".strtoupper($strName)
					." for whatever purpose it may serve ".strtolower($strPronoun).".";					
		$this->objRprt->Ln(20);
		
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, date("d F Y"), 0, 0, "R");
		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "BU", 16);
		$this->objRprt->Cell(0, 5, "C E R T I F I C A T I O N", 0, 0, "C");

		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, "TO WHOM IT MAY CONCERN:", 0, 0, "L");

		$this->objRprt->Ln(15);
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->MultiCell(0, 6, $strPrgrph1, 0, 'J', 0);
		
		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 6, $strPrgrph2, 0, 'J', 0);
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$this->objRprt->Ln(10);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','B',11);		
		$this->objRprt->Cell(0,10,strtoupper($arrSgntry["signatory"]),0,0,'C');

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(0,10,$arrSgntry["signatoryTitle"],0,0,'C');
	}

	function bodyAR($t_arrEmpInfo, $t_arrAgency)
	{
		$strName = $t_arrEmpInfo['firstname']." ".$t_arrEmpInfo['middlename']
					." ".$t_arrEmpInfo['surname'];
		
		$strPrgrph1 = "     In reply to your letter of ".$_SESSION['sesLtrDate']
					." which we recieved only last ".$_SESSION['sesRcvDate']
					.", opting for resignation from the position of ".$t_arrEmpInfo['positionDesc']
					." in this Office, please be advised that the same is hereby accepted"
					." to take effect at the close of the office hours on ".$_SESSION['sesAcptDate'].".";
		
		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "BU", 16);
		$this->objRprt->Cell(0, 5, "A C C E P T A N C E  O F  R E S I G N A T I O N", 0, 0, "C");
		$this->objRprt->Ln(20);
				
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, date("d F Y"), 0, 0, "R");


		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 5, $strName, 0, 1, "L");
		$this->objRprt->Cell(0, 5, $t_arrEmpInfo['positionDesc'], 0, 0, "L");

		$this->objRprt->Ln(15);
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->MultiCell(0, 6, $strPrgrph1, 0, 'J', 0);	
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Director'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$this->objRprt->Ln(20);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',11);		
		$this->objRprt->Cell(0,10,strtoupper($arrSgntry["signatory"]),0,0,'C');

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(0,10,$arrSgntry["signatoryTitle"],0,0,'C');
		
		$this->objRprt->Ln(15);
		$this->objRprt->SetFont('Arial','',11);		
		$this->objRprt->Cell(0,10,"Copy furnished:",0,0,'L');
		$this->objRprt->Ln(7);
		$this->objRprt->Cell(0,10,"Civil Service Commision",0,0,'L');
	}

	function bodyCU($t_arrEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
		$strName = $t_arrEmpInfo['firstname']." ".$t_arrEmpInfo['middlename']
					." ".$t_arrEmpInfo['surname'];

		$strPronoun = $this->pronoun($t_arrEmpInfo['sex']);
		
		$strPlace = $_SESSION['place'];
		$strDate = $_SESSION['dateTrng'];
		$strEvent = $_SESSION['trng'];
		
		$strPrgrph1 = "This is to certify that the travel of ".strtoupper($strName)
					.", ".$t_arrEmpInfo['positionDesc'].", ".$t_arrEmpInfo['divisionName']
					.", to ".$strPlace." on ".$strDate." to attend and participate in the "
					.$strEvent.", is urgent and absolutely necessary for the following reasons:";
		
		$strPrgrph2 = $_SESSION['reason'];					
		$this->objRprt->Ln(20);
		
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, date("d F Y"), 0, 0, "R");
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "BU", 16);
		$this->objRprt->Cell(0, 5, "CERTIFICATE OF URGENCY", 0, 0, "C");

		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->MultiCell(0, 6, $strPrgrph1, 0, 'J', 0);
		
		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 6, $strPrgrph2, 0, 'J', 0);
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Director'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$this->objRprt->Ln(20);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','B',11);		
		$this->objRprt->Cell(0,10,strtoupper($arrSgntry["signatory"]),0,0,'C');

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(0,10,$arrSgntry["signatoryTitle"],0,0,'C');
	}

	function bodyCDR($t_arrEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
		$objDuties = mysql_query("SELECT * FROM tblEmpDuties WHERE empNumber='".$t_arrEmpInfo['empNumber']."'");
		
		$strName = $t_arrEmpInfo['firstname']." ".$t_arrEmpInfo['middlename']
					." ".$t_arrEmpInfo['surname'];
					
		$strPronoun = $this->pronoun($t_arrEmpInfo['sex']);
			
		$strPrgrph1 = "     This is to certify that ".strtoupper($strName)
					.", ".$t_arrEmpInfo['positionDesc'].", ".$t_arrEmpInfo['divisionName']
					.", has the following duties and responsibilities:";
		
		$strPrgrph3 = "     This certification is being issued to ".strtoupper($strName)
					." for whatever purpose it may serve ".strtolower($strPronoun).".";
		
		$this->objRprt->Ln(20);
		
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, date("d F Y"), 0, 0, "R");
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "BU", 16);
		$this->objRprt->Cell(0, 5, "C E R T I F I C A T I O N", 0, 0, "C");

		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->MultiCell(0, 6, $strPrgrph1, 0, 'J', 0);
		
		$this->objRprt->Ln(5);
		while ($arrDuties = mysql_fetch_array($objDuties))
		{
			$this->objRprt->Cell(10);
			$this->objRprt->MultiCell(0, 6, "-".$arrDuties['duties'], 0, 'L', 0);
			$this->objRprt->Ln(5);	
		}

		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 6, $strPrgrph3, 0, 'J', 0);
				
		$this->objRprt->Ln(10);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','B',11);		
		$this->objRprt->Cell(0,10,strtoupper($t_arrEmpInfo["divisionHead"]),0,0,'C');

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(0,10,$t_arrEmpInfo["divisionHeadTitle"],0,0,'C');
	}
	
	function bodyEL($t_arrEmpInfo)
	{
		$strName = $t_arrEmpInfo['firstname']." ".$t_arrEmpInfo['middlename']
					." ".$t_arrEmpInfo['surname'];
					
		$strPronoun = $this->pronoun($t_arrEmpInfo['sex']);
		
		$strTraining = $_SESSION['trng'];
		$strSponsor = $_SESSION['sponsor'];
		$strOrganize = $_SESSION['organizer'];
		$strDate = $_SESSION['dateTrng'];
		$strPlace = $_SESSION['place'];
		
		$strPrgrph1 = "     This is to request your approval of the official travel abroad of "
					.strtoupper($strName).", ".$t_arrEmpInfo['positionDesc'].", ".$t_arrEmpInfo['divisionName']
					.", to attend and participate in the ".$strTraining." sponsored by the "
					.$strSponsor." and orginized by ".$strOrganize.", to be held on ".$strDate
					." in ".$strPlace.".";
		if($strPronoun == "Him")
		{
			$strPrn = "His";   //the next paragraph kpg gnmit mo him akward
		}
		else
		{
			$strPrn = "Her";
		}
		$strPrgrph2 = "     ".$strPrn." travel will be at no cost to the Philippine Government "
					."except for ".strtolower($strPrn)." pre-departure expenses.";
		$strPrgrph3 = "     The orginizing agency will provide ".strtolower($strPronoun)
					." with adequate allowances and program costs during the duration "
					."of the workshop including the cost of international round trip airfare.";
		$strPrgrph4 = "     Your favorable consideration will be highly appreciated.";
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Director'");
		$arrSgntry = mysql_fetch_array($objSgntry);
		
		$objContact = mysql_query("SELECT * FROM tblContact WHERE agencyCode='DOST'");
		$arrContact = mysql_fetch_array($objContact);
		
		$strPerson = strtoupper($arrContact[title]." ".$arrContact['firstname']." ".$arrContact['middleInitial'].". ".$arrContact['surname']);
		
		$this->objRprt->Ln(20);		
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, date("d F Y"), 0, 0, "R");    //Date
		$this->objRprt->Ln(10);

		$this->objRprt->Ln(5);		
		$this->objRprt->SetFont('Arial', "B", 12);	
		$this->objRprt->Cell(0, 5, strtoupper($strPerson), 0, 0, "L");    //Person

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, $arrContact["position"], 0, 0, "L");    //Person's position

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, $arrContact["agency"], 0, 0, "L");    //agency

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, $arrContact["address"], 0, 0, "L");    //address
		$this->objRprt->Ln(10);

		$this->objRprt->SetFont('Arial', "", 12);	
		$this->objRprt->Cell(0, 5, "Dear ".$arrContact["title"]." ".$arrContact["surname"].":", 0, 0, "L");    //address
		$this->objRprt->Ln(5);
		
		
		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 6, $strPrgrph1, 0, 'J', 0);
		
		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 6, $strPrgrph2, 0, 'J', 0);
		
		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 6, $strPrgrph3, 0, 'J', 0);

		$this->objRprt->Ln(5);
		$this->objRprt->MultiCell(0, 6, $strPrgrph4, 0, 'J', 0);
		
		$this->objRprt->Ln(4);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(0,10,"Very truly yours,",0,0,'C');
		
		$this->objRprt->Ln(20);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','B',11);		
		$this->objRprt->Cell(0,10,strtoupper($arrSgntry["signatory"]),0,0,'C');

		$this->objRprt->Ln(4);
		$this->objRprt->Cell(130);		
		$this->objRprt->SetFont('Arial','',10);				
		$this->objRprt->Cell(0,10,$arrSgntry["signatoryTitle"],0,0,'C');		
	}
	
	function pronoun($t_strGender)
	{
		if($t_strGender == 'F')
		{
			return "Her";
		}
		else
		{
			return"Him";
		}	
	}
	
	function pronoun2($t_strGender)
	{
		if($t_strGender == 'F')
		{
			return "Her";
		}
		else
		{
			return"His";
		}	
	}
	
	function bodyAL($t_arrEmpInfo, $t_arrAgency)
	{
		$dtmMonth = date("m",strtotime($t_arrEmpInfo["dateFiled"]));
		$dtmYear = date("Y",strtotime($t_arrEmpInfo["dateFiled"]));
		$arrPreMonth = $this->getPreMonth($dtmMonth, $dtmYear);
		
		$intVL = $this->getLeftSLVL($arrPreMonth["month"], $arrPreMonth["year"], $t_arrEmpInfo["empNumber"], "VL");
		if($intVL < 0)
		{
			$intVL = 0;
		}
		$intSL = $this->getLeftSLVL($arrPreMonth["month"], $arrPreMonth["year"], $t_arrEmpInfo["empNumber"], "SL");
		if($intSL < 0)
		{
			$intSL = 0;						
		}
		
		$this->objRprt->SetFont('Arial', "", 8);
		$this->objRprt->Cell(0, 4, "CSC Form No. 6", 0, 1, "L");
		$this->objRprt->Cell(0, 4, "Revised 1984", 0, 0, "L");		
		
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 14);
		$this->objRprt->Cell(0, 5, "APPLICATION FOR LEAVE", 0, 0, "C");	

		$this->objRprt->Line(15, 60, 200, 60);
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(45, 5, $t_arrAgency["abbreviation"], 0, 0, "C");
		$this->objRprt->Cell(45, 5, $t_arrEmpInfo["surname"], 0, 0, "C");
		$this->objRprt->Cell(45, 5, $t_arrEmpInfo["firstname"], 0, 0, "C");
		$this->objRprt->Cell(45, 5, $t_arrEmpInfo["middlename"], 0, 1, "C");

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(45, 5, "OFFICE/AGENCY", 0, 0, "C");
		$this->objRprt->Cell(45, 5, "NAME  (Last)", 0, 0, "C");
		$this->objRprt->Cell(45, 5, "(First)", 0, 0, "C");
		$this->objRprt->Cell(45, 5, "(Middle)", 0, 1, "C");
		$this->objRprt->Line(15, 72, 200, 72);
		
		$this->objRprt->Ln(2);
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(60, 4, date("m/d/Y",strtotime($t_arrEmpInfo["dateFiled"])), 0, 0, "C");
		$this->objRprt->Cell(60, 4, $t_arrEmpInfo["positionDesc"], 0, 0, "C");
		$this->objRprt->Cell(60, 4, number_format($t_arrEmpInfo["actualSalary"], 2,".",","), 0, 1, "C");

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(60, 4, "DATE OF FILING", 0, 0, "C");
		$this->objRprt->Cell(60, 4, "POSITION", 0, 0, "C");
		$this->objRprt->Cell(60, 4, "SALARY (Monthly)", 0, 0, "C");
		
		$this->objRprt->Line(15, 83, 200, 83);
		$this->objRprt->Ln(6);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, "DETAILS OF APPLICATION", 0, 0, "C");	
		$this->objRprt->Line(15, 90, 200, 90);

		$this->objRprt->Ln(7);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, "Type of Leave:", 0, 0, "L");
		$this->objRprt->Cell(90, 5, "Where leave will be spent:", 0, 1, "L");

		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(90, 5, "   ".$t_arrEmpInfo["leaveType"], 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, "   In case of vacation leave:", 0, 1, "L");

		$this->objRprt->Cell(90);
		$this->objRprt->SetFont('Arial', "B", 9);
		if($t_arrEmpInfo["specificLeave"] == "Local")
		{
			$this->objRprt->Cell(90, 5, "       (*) within the Philippines", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(90, 5, "       ( ) within the Philippines", 0, 1, "L");
		}
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, "Number of Working Days Applied For:", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 9);		
		if($t_arrEmpInfo["specificLeave"] == "Abroad")
		{
			$this->objRprt->Cell(90, 5, "       (*) abroad", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(90, 5, "       ( ) abroad", 0, 1, "L");
		}

		$intMonthDiff = date("m",strtotime($t_arrEmpInfo["leaveTo"])) - date("m",strtotime($t_arrEmpInfo["leaveFrom"]));
		$intMonthDiff = $intMonthDiff + 1;
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(90, 5, "   $intMonthDiff day", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(18, 5, "   Specify:", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->MultiCell(0, 5, "", 0, 'J', 0);

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, "Inclusive Dates:", 0, 0, "L");
		$this->objRprt->Cell(90, 5, "   In case of sick leave:", 0, 1, "L");

		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(90, 5, "   from ".date("m/d/Y", strtotime($t_arrEmpInfo["leaveFrom"]))." to ".date("m/d/Y", strtotime($t_arrEmpInfo["leaveTo"])), 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 9);
		if($t_arrEmpInfo["specificLeave"] == "In-patient")
		{		
			$this->objRprt->Cell(90, 5, "      (*) In-patient", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(90, 5, "      ( ) In-patient", 0, 1, "L");
		}
		
		$this->objRprt->Cell(90);
		if($t_arrEmpInfo["specificLeave"] == "Out-patient")
		{		
			$this->objRprt->Cell(90, 5, "      (*) Out-patient", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(90, 5, "      ( ) Out-patient", 0, 1, "L");
		}
		
		$this->objRprt->Cell(90);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(18, 5, "   Specify:", 0, 0, "L");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->MultiCell(0, 5, "", 0, 'J', 0);
		
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90);
		$this->objRprt->Cell(90, 5, "Commutations:", 0, 1, "L");
		$this->objRprt->Cell(90);
		$this->objRprt->SetFont('Arial', "B", 9);		
		$this->objRprt->Cell(25, 5, "   ( ) required", 0, 0, "L");
		$this->objRprt->Cell(45, 5, "(*) not required", 0, 1, "L");
		
		$this->objRprt->Ln(2);
		$this->objRprt->Cell(90);
		$this->objRprt->SetFont('Arial', "", 10);		
		$this->objRprt->Cell(90, 5, "(Signed)", 0, 1, "C");
		
		$this->objRprt->Cell(90);
		$this->objRprt->SetFont('Arial', "B", 10);		
		$this->objRprt->Cell(90, 5, "SIGNATURE OF APPLICANT", 0, 1, "C");

		$this->objRprt->Line(15, 170, 200, 170);
		$this->objRprt->Ln(3);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, "DETAILS OF ACTION ON APPLICATION", 0, 0, "C");	
		$this->objRprt->Line(15, 177, 200, 177);
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, "Certification of Leave Credits as of:", 0, 0, "L");
		$this->objRprt->Cell(90, 5, "Recomendations:", 0, 1, "L");		

		$this->objRprt->SetFont('Arial', "", 10);		
		$this->objRprt->Cell(90, 5, "   ".$this->intToMonthFull($arrPreMonth["month"])." ".$arrPreMonth["year"], 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 9);
		
		if($t_arrEmpInfo["approveChief"] == 'Y')
		{
			$this->objRprt->Cell(90, 5, "   (*) Approval", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(90, 5, "   ( ) Approval", 0, 1, "L");
		}

		$this->objRprt->Cell(90);
		
		if($t_arrEmpInfo["approveChief"] == 'N')
		{				
			$this->objRprt->Cell(40, 5, "   (*) Disapproval due to ", 0, 0, "L");
		}
		else
		{
			$this->objRprt->Cell(40, 5, "   ( ) Disapproval due to ", 0, 0, "L");
		}
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->MultiCell(0, 5, "", 0, 'J', 0);
		
		$this->objRprt->Cell(30, 5, "Vacation", "TR", 0, "C");
		$this->objRprt->Cell(30, 5, "Sick", "TR", 0, "C");
		$this->objRprt->Cell(30, 5, "Total", "T", 1, "C");		

		$this->objRprt->Cell(30, 5, number_format($intVL,3,".",","), "BR", 0, "C");
		$this->objRprt->Cell(30, 5, number_format($intSL,3,".",","), "BR", 0, "C");
		$this->objRprt->Cell(30, 5, number_format($intVL+$intSL,3,".",","), "B", 1, "C");
		
		$arrSgntry = $this->signatory($t_arrEmpInfo["empNumber"], $t_arrEmpInfo["divisionHead"], $t_arrEmpInfo["divisionHeadTitle"]);
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrHRSgntry = mysql_fetch_array($objSgntry);

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(90, 5, "(Signed)", 0, 0, "C");
		$this->objRprt->Cell(90, 5, "(Signed)", 0, 1, "C");

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(90, 5, strtoupper($arrHRSgntry["signatory"]), 0, 0, "C");
		$this->objRprt->Cell(90, 5, strtoupper($arrSgntry["signatory"]), 0, 1, "C");
		$this->objRprt->Cell(90, 5, "Personnel Officer", 0, 0, "C");
		$this->objRprt->Cell(90, 5, "Authorized Official", 0, 1, "C");
		
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(90, 5, "APPROVED FOR:", 0, 0, "L");
		$this->objRprt->Cell(90, 5, "DISAPPROVED DUE TO:", 0, 1, "L");

		$this->objRprt->SetFont('Arial', "B", 9);
		
		$strApproved = $this->ApprovedFor($t_arrEmpInfo["empNumber"], $t_arrEmpInfo["leaveFrom"]);

		if($strApproved == "WP")
		{
			$this->objRprt->Cell(27, 5, "(*) Days with pay", 0, 0, "L");
		}
		else
		{
			$this->objRprt->Cell(27, 5, "( ) Days with pay", 0, 0, "L");
		}
		
		if($strApproved == "WOP")
		{
			$this->objRprt->Cell(33, 5, "(*) Days without pay", 0, 0, "L");
		}
		else
		{
			$this->objRprt->Cell(33, 5, "( ) Days without pay", 0, 0, "L");
		}
		
		if($strApproved == "OTH")
		{		
			$this->objRprt->Cell(30, 5, "(*) Others", 0, 0, "L");
		}
		else
		{
			$this->objRprt->Cell(30, 5, "( ) Others", 0, 0, "L");
		}
		$this->objRprt->SetFont('Arial', "", 10);		
		$this->objRprt->MultiCell(0, 5, "", 0, 'J', 0);
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Line(80, 257, 130, 257);
		$this->objRprt->Cell(0, 5, "(Signed)", 0, 0, "C");
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Ln(7);
		$this->objRprt->Cell(0, 5, strtoupper($arrSgntry["signatory"]), 0, 1, "C");
		$this->objRprt->Cell(0, 5, "Authorized Official", 0, 1, "C");		

		$this->objRprt->Ln(4);
		$this->objRprt->SetFont('Arial', "", 8);
		$this->objRprt->Cell(0, 4, "**************** NO SIGNATURE NEEDED. THIS DOCUMENT HAS BEEN APPROVED ONLINE ****************", 0, 1, "C");
	}

	function bodyPRO($t_arrEmpInfo, $t_arrAgency)
	{
		$this->objRprt->SetFont('Arial', "B", 16);
		$this->objRprt->Cell(0, 5, strtoupper($t_arrAgency["agencyName"]), 0, 1, "C");
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, $t_arrAgency["address"], 0, 0, "C");	
		$this->objRprt->Ln(15);
		$this->objRprt->SetFont('Arial', "BU", 12);
		$this->objRprt->Cell(0, 5, "PERMISSION TO RENDER OVERTIME WORK / EXTEND HOURS OF WORK", 0, 0, "C");	
		$this->objRprt->Ln(10);
		
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(50, 5, "Office Unit:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(0, 5, $t_arrEmpInfo["divisionCode"], 0, 0, "L");

		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(50, 5, "Purpose:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->MultiCell(0, 6, $t_arrEmpInfo["otPurpose"], 0, 'J', 0);

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(50, 5, "Expected Output:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->MultiCell(0, 6, $t_arrEmpInfo["otOutput"], 0, 'J', 0);
		
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(50, 5, "Date From:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(40, 5, date("m/d/Y", strtotime($t_arrEmpInfo["otDateFrom"])), 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(30, 5, "Date To:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(0, 5, date("m/d/Y", strtotime($t_arrEmpInfo["otDateTo"])), 0, 0, "L");

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(50, 5, "Time From:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(40, 5, $t_arrEmpInfo["otTimeFrom"], 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(30, 5, "Time To:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(0, 5, $t_arrEmpInfo["otTimeTo"], 0, 0, "L");

		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(50, 5, "REQUESTED BY:", 0, 0, "R");
		$this->objRprt->Cell(80, 5, "APPROVED BY:", 0, 0, "R");

		$arrSgntry = $this->signatory($t_arrEmpInfo["tblEmpNumber"], $t_arrEmpInfo["divisionHead"], $t_arrEmpInfo["divisionHeadTitle"]);
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(85, 5, "(Signed)", 0, 0, "C");
		$this->objRprt->Cell(85, 5, "(Signed)", 0, 1, "C");

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(85, 5, strtoupper($t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["surname"]), 0, 0, "C");
		$this->objRprt->Cell(85, 5, strtoupper($arrSgntry["signatory"]), 0, 1, "C");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(85, 5, 'EMPLOYEE', 0, 0, "C");
		$this->objRprt->Cell(85, 5, strtoupper($arrSgntry["signatoryTitle"]), 0, 1, "C");

		$this->objRprt->Ln(4);
		$this->objRprt->SetFont('Arial', "", 8);
		$this->objRprt->Cell(0, 4, "**************** NO SIGNATURE NEEDED. THIS DOCUMENT HAS BEEN APPROVED ONLINE ****************", 0, 1, "C");		
	}

	function bodyOB($t_arrEmpInfo, $t_arrAgency)
	{
		$this->objRprt->SetFont('Arial', "B", 16);
		$this->objRprt->Cell(0, 5, strtoupper($t_arrAgency["agencyName"]), 0, 1, "C");
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, $t_arrAgency["address"], 0, 0, "C");	
		$this->objRprt->Ln(15);
		
		$this->objRprt->SetFont('Arial', "BU", 16);
		$this->objRprt->Cell(0, 5, "PASS SLIP", 0, 0, "C");
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(140, 5, "DATE:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 5, date( "m/d/Y", strtotime($t_arrEmpInfo["dateFiled"])), 0, 0, "L");
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(30, 5, "Name:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(70, 5, $t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["surname"], 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(30, 5, "Division:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(40, 5, $t_arrEmpInfo["divisionCode"], 0, 0, "L");

		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(50, 10, "Destination:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 10, $t_arrEmpInfo["obPlace"], 0, 1, "L");

		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(50, 6, "Purpose:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->MultiCell(0, 6, $t_arrEmpInfo["purpose"], 0, 'J', 0);

		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(50, 5, "Date From:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(30, 5, date("m/d/Y", strtotime($t_arrEmpInfo["obDateFrom"])), 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(20, 5, "Date To:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(40, 5, date("m/d/Y", strtotime($t_arrEmpInfo["obDateTo"])), 0, 0, "L");		

		$this->objRprt->Ln(7);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(50, 5, "Time From:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(30, 5, $t_arrEmpInfo["obTimeFrom"], 0, 0, "L");
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(20, 5, "Time To:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(40, 5, $t_arrEmpInfo["obTimeTo"], 0, 0, "L");		

		if($t_arrEmpInfo["official"] == 'Y')
		{
			$strOfficial = "Yes";
		}
		else
		{
			$strOfficial = "No";
		}
		
		$this->objRprt->Ln(7);
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(50, 5, "Official:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 12);
		$this->objRprt->Cell(0, 5, $strOfficial, 0, 1, "L");
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(100, 5, "", 0, 0, "C");
		$this->objRprt->Cell(0, 5, "NOTED BY", 0, 1, "L");
		
		$arrSgntry = $this->signatory($t_arrEmpInfo["empNumber"], $t_arrEmpInfo["divisionHead"], $t_arrEmpInfo["divisionHeadTitle"]);
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrHRSgntry = mysql_fetch_array($objSgntry);

		$this->objRprt->Ln(7);
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(85, 5, "(Signed)", 0, 0, "C");
		$this->objRprt->Cell(85, 5, "(Signed)", 0, 1, "C");

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(85, 5, strtoupper($arrSgntry["signatory"]), 0, 0, "C");
		$this->objRprt->Cell(85, 5, strtoupper($arrHRSgntry["signatory"]), 0, 1, "C");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(85, 5, strtoupper($arrSgntry["signatoryTitle"]), 0, 0, "C");
		$this->objRprt->Cell(85, 5, strtoupper($arrHRSgntry["signatoryTitle"]), 0, 1, "C");
		
		$this->objRprt->Ln(4);
		$this->objRprt->SetFont('Arial', "", 8);
		$this->objRprt->Cell(0, 4, "**************** NO SIGNATURE NEEDED. THIS DOCUMENT HAS BEEN APPROVED ONLINE ****************", 0, 1, "C");		
	}	
	
	function bodyTO($t_arrEmpInfo, $t_arrAgency)
	{	
		$this->objRprt->SetFont('Arial', "B", 16);
		$this->objRprt->Cell(0, 5, strtoupper($t_arrAgency["agencyName"]), 0, 1, "C");
		$this->objRprt->SetFont('Arial', "B", 12);
		$this->objRprt->Cell(0, 5, $t_arrAgency["address"], 0, 0, "C");	
		$this->objRprt->Ln(15);	

		$this->objRprt->SetFont('Arial', "BU", 16);
		$this->objRprt->Cell(0, 5, "TRAVEL ORDER", 0, 0, "C");
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "BI", 12);
		$this->objRprt->Cell(0, 5, "Permission to travel is hereby granted", 0, 0, "L");

		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(40, 5, "NAME:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(0, 5, $t_arrEmpInfo["firstname"]." ".$t_arrEmpInfo["surname"], 0, 1, "L");
		
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(40, 5, "DESIGNATION:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(0, 5, $t_arrEmpInfo["destination"], 0, 1, "L");

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(40, 5, "DATE OF TRAVEL:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(30, 5, " from ".date("m/d/Y",strtotime($t_arrEmpInfo["toDateFrom"])), 0, 0, "L");
		$this->objRprt->Cell(40, 5, " to ".date("m/d/Y",strtotime($t_arrEmpInfo["toDateTo"])), 0, 1, "L");		

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(40, 5, "PURPOSE:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->MultiCell(0, 6, $t_arrEmpInfo["purpose"], 0, 'J', 0);
		
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(40, 5, "SOURCE OF FUND:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		
		if ($t_arrEmpInfo["fund"] == "Fund 101")
		{
			$this->objRprt->Cell(30, 5, "(*) Fund 101", 0, 0, "L");
		}
		else
		{
			$this->objRprt->Cell(30, 5, "( ) Fund 101", 0, 0, "L");
		}
		
		if ($t_arrEmpInfo["fund"] == "Fund 202")
		{
			$this->objRprt->Cell(0, 5, "(*) Fund 202", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(0, 5, "( ) Fund 202", 0, 1, "L");
		}

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(40, 5, "TRANSPORTATION:", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);
		
		if($t_arrEmpInfo["transportation"] == "Official Vehicle")
		{
			$this->objRprt->Cell(30, 5, "(*) Official Vehicle", 0, 0, "L");
		}
		else
		{
			$this->objRprt->Cell(30, 5, "( ) Official Vehicle", 0, 0, "L");
		}
		
		if($t_arrEmpInfo["transportation"] == "Non-agency")
		{
			$this->objRprt->Cell(30, 5, "(*) Non-agency", 0, 0, "L");
		}
		else
		{
			$this->objRprt->Cell(30, 5, "( ) Non-agency", 0, 0, "L");		
		}
		
		if($t_arrEmpInfo["transportation"] == "Personal")
		{
			$this->objRprt->Cell(30, 5, "(*) Personal", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(30, 5, "( ) Personal", 0, 1, "L");		
		}

		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(40, 5, "CLAIM PERDIEM?", 0, 0, "R");
		$this->objRprt->SetFont('Arial', "", 10);

		if($t_arrEmpInfo["perdiem"] == "Y")
		{
			$this->objRprt->Cell(30, 5, "(*) Yes", 0, 0, "L");
		}
		else
		{
			$this->objRprt->Cell(30, 5, "( ) Yes", 0, 0, "L");
		}

		if($t_arrEmpInfo["perdiem"] == "N")
		{
			$this->objRprt->Cell(30, 5, "(*) No", 0, 1, "L");
		}
		else
		{
			$this->objRprt->Cell(30, 5, "( ) No", 0, 1, "L");
		}				

		$arrSgntry = $this->signatory($t_arrEmpInfo["empNumber"], $t_arrEmpInfo["divisionHead"], $t_arrEmpInfo["divisionHeadTitle"]);

		$this->objRprt->Ln(20);
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Line(80, 150, 130, 150);
		$this->objRprt->Cell(0, 5, "(Signed)", 0, 0, "C");

		$this->objRprt->Ln(7);
		$this->objRprt->SetFont('Arial', "B", 10);
		$this->objRprt->Cell(0, 5, strtoupper($arrSgntry["signatory"]), 0, 1, "C");
		$this->objRprt->SetFont('Arial', "", 10);
		$this->objRprt->Cell(0, 5, strtoupper($arrSgntry["signatoryTitle"]), 0, 0, "C");
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont('Arial', "", 8);
		$this->objRprt->Cell(0, 4, "**************** NO SIGNATURE NEEDED. THIS DOCUMENT HAS BEEN APPROVED ONLINE ****************", 0, 1, "C");		
	}
	
	function bodyLWOP($t_objEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
		$strMonth = $this->intToMonthFull($t_intMonth);
		if($_SESSION["empPerSelect"] == "Per Division")
		{
			$strType = "DIVISION: ";
			
			$objDvsnName = mysql_query("SELECT divisionName 
											FROM tblDivision 
										WHERE divisionCode = '".$_SESSION["divSecCode"]."'");
			$arrDvsnName = mysql_fetch_array($objDvsnName);
			$strTypeName = $arrDvsnName["divisionName"];
		}
		elseif($_SESSION["empPerSelect"] == "Per Section")
		{
			$strType = "SECTION: ";		
			$objSctnName = mysql_query("SELECT sectionName  
											FROM tblSection 
										WHERE sectionCode = '".$_SESSION["divSecCode"]."'");
			$arrSctnName = mysql_fetch_array($objSctnName);
			$strTypeName = $arrSctnName["sectionName"];
		}
		$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $strMonth, $t_intYear, $strType, $strTypeName);
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);		
		$this->objRprt->setFooter($arrSgntry["signatory"], $arrSgntry["signatoryTitle"]);
		
		$this->objRprt->AddPage();
		while($arrEmpInfo = mysql_fetch_array($t_objEmpInfo))
		{
			$this->objRprt->SetFont('Arial', "", 9);
			$this->objRprt->Cell(60, 5, $arrEmpInfo["surname"].", ".$arrEmpInfo["firstname"], 0, 0, "L");
			$this->objRprt->Cell(40, 5, number_format($arrEmpInfo["vlAbsUndWoPay"],"3",".",","), 0, 0, "R");
			$this->objRprt->Cell(40, 5, number_format($arrEmpInfo["slAbsUndWoPay"],"3",".",","), 0, 0, "R");
			$this->objRprt->Cell(40, 5, number_format($arrEmpInfo["vlAbsUndWoPay"] + $arrEmpInfo["slAbsUndWoPay"],"3",".",","), 0, 1, "R");
		}
	}

	function bodyTR($t_objEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
		$strMonth = $this->intToMonthFull($t_intMonth);
		if($_SESSION["empPerSelect"] == "Per Division")
		{
			$strType = "DIVISION: ";
			
			$objDvsnName = mysql_query("SELECT divisionName 
											FROM tblDivision 
										WHERE divisionCode = '".$_SESSION["divSecCode"]."'");
			$arrDvsnName = mysql_fetch_array($objDvsnName);
			$strTypeName = $arrDvsnName["divisionName"];
		}
		elseif($_SESSION["empPerSelect"] == "Per Section")
		{
			$strType = "SECTION: ";		
			$objSctnName = mysql_query("SELECT sectionName  
											FROM tblSection 
										WHERE sectionCode = '".$_SESSION["divSecCode"]."'");
			$arrSctnName = mysql_fetch_array($objSctnName);
			$strTypeName = $arrSctnName["sectionName"];
		}
		$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $strMonth, $t_intYear, $strType, $strTypeName);
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);		
		$this->objRprt->setFooter($arrSgntry["signatory"], $arrSgntry["signatoryTitle"]);
		
		$this->objRprt->AddPage();
		while($arrEmpInfo = mysql_fetch_array($t_objEmpInfo))
		{
			$arrDTR = $this->getEmpDTR($arrEmpInfo["empNumber"], $t_intMonth, $t_intYear);
			$arrLateUnd = $this->getLateUndPrMonth($arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, $arrDTR);
			$strExcess = $this->getExcessPrMonth($arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, $arrDTR);
			
			if($arrLateUnd["count"] >= 10)
			{
				$this->objRprt->SetFont('Arial', "", 8);
				$this->objRprt->Cell(60, 5, $arrEmpInfo["surname"].", ".$arrEmpInfo["firstname"], 0, 0, "L");
				$this->objRprt->Cell(40, 5, $arrLateUnd["display"], 0, 0, "R");
				$this->objRprt->Cell(30, 5, $strExcess, 0, 0, "R");
				$this->objRprt->Cell(20, 5, $arrLateUnd["count"], 0, 0, "R");
				$this->objRprt->Cell(25, 5, $arrLateUnd["absent count"], 0, 1, "R");
			}
		}
	}

	function bodyMA($t_objEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
		$strMonth = $this->intToMonthFull($t_intMonth);
		$strMonthYear = $this->combineMonthYear($t_intYear, $t_intMonth);
		if($_SESSION["empPerSelect"] == "Per Division")
		{
			$strType = "DIVISION: ";
			
			$objDvsnName = mysql_query("SELECT divisionName 
											FROM tblDivision 
										WHERE divisionCode = '".$_SESSION["divSecCode"]."'");
			$arrDvsnName = mysql_fetch_array($objDvsnName);
			$strTypeName = $arrDvsnName["divisionName"];
		}
		elseif($_SESSION["empPerSelect"] == "Per Section")
		{
			$strType = "SECTION: ";		
			$objSctnName = mysql_query("SELECT sectionName  
											FROM tblSection 
										WHERE sectionCode = '".$_SESSION["divSecCode"]."'");
			$arrSctnName = mysql_fetch_array($objSctnName);
			$strTypeName = $arrSctnName["sectionName"];
		}
		$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $strMonth, $t_intYear, $strType, $strTypeName);
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);		
		$this->objRprt->setFooter($arrSgntry["signatory"], $arrSgntry["signatoryTitle"]);
		
		$this->objRprt->AddPage();
		while($arrEmpInfo = mysql_fetch_array($t_objEmpInfo))
		{
			$this->objRprt->SetFont('Arial', "", 9);
			$this->objRprt->Cell(30, 5, $arrEmpInfo["empNumber"], 0, 0, "L");
			$this->objRprt->Cell(60, 5, $arrEmpInfo["surname"].", ".$arrEmpInfo["firstname"], 0, 0, "L");
			
			$objMeet = mysql_query("SELECT tblEmpDTR.dtrDate, tblEmpMeeting.meetingTitle 
							FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition 
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
								INNER JOIN tblEmpDTR 
									ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber 
								INNER JOIN tblEmpMeeting 
									ON tblEmpMeeting.meetingID = tblEmpDTR.otherInfo
							WHERE tblEmpDTR.Remarks = 'MET' 
								AND tblEmpDTR.dtrDate LIKE '$strMonthYear%' 
								AND tblEmpPersonal.empNumber = '".$arrEmpInfo["empNumber"]."'
							ORDER BY tblEmpDTR.dtrDate");
			
			$intFlag = 0;
			
			while($arrMeet = mysql_fetch_array($objMeet))
			{
				if ($intFlag == 0)
				{
					$this->objRprt->Cell(30, 5, date("m/d/Y", strtotime($arrMeet["dtrDate"])), 0, 0, "L");
					$this->objRprt->Cell(60, 5, $arrMeet["meetingTitle"], 0, 1, "L");				
					$intFlag = 1;					
				}
				else
				{
					$this->objRprt->SetFont('Arial', "", 9);
					$this->objRprt->Cell(90);
					$this->objRprt->Cell(30, 5, date("m/d/Y", strtotime($arrMeet["dtrDate"])), 0, 0, "L");
					$this->objRprt->Cell(60, 5, $arrMeet["meetingTitle"], 0, 1, "L");
				}
			}
		}
	}

	function bodyMCR($t_objEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
		$strMonth = $this->intToMonthFull($t_intMonth);
		if($_SESSION["empPerSelect"] == "Per Division")
		{
			$strType = "DIVISION: ";
			
			$objDvsnName = mysql_query("SELECT divisionName 
											FROM tblDivision 
										WHERE divisionCode = '".$_SESSION["divSecCode"]."'");
			$arrDvsnName = mysql_fetch_array($objDvsnName);
			$strTypeName = $arrDvsnName["divisionName"];
		}
		elseif($_SESSION["empPerSelect"] == "Per Section")
		{
			$strType = "SECTION: ";		
			$objSctnName = mysql_query("SELECT sectionName  
											FROM tblSection 
										WHERE sectionCode = '".$_SESSION["divSecCode"]."'");
			$arrSctnName = mysql_fetch_array($objSctnName);
			$strTypeName = $arrSctnName["sectionName"];
		}
		$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $strMonth, $t_intYear, $strType, $strTypeName);
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);		
		$this->objRprt->setFooter($arrSgntry["signatory"], $arrSgntry["signatoryTitle"]);
		
		$this->objRprt->AddPage();
		while($arrEmpInfo = mysql_fetch_array($t_objEmpInfo))
		{
			$arrAbsHlf = $this->getLateUndPrMonth($arrEmpInfo["empNumber"], $t_intMonth, $t_intYear);
			$intDaysPrdm = $this->countPerDiem($arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, "Y");
			$intDaysWoPrdm = $this->countPerDiem($arrEmpInfo["empNumber"], $t_intMonth, $t_intYear, "N");

			$intHlfDay = $arrAbsHlf["half count"] * 0.5;
			$intAbsDay = $arrAbsHlf["absent count"];
			$intDaysTotal = $intDaysPrdm + $intHlfDay + $intAbsDay;
			
			$strDaysTotal = $this->displayAttndDays($intDaysTotal);
			$strDaysPrdm = $this->displayAttndDays($intDaysPrdm);
			$strDaysWoPrdm = $this->displayAttndDays($intDaysWoPrdm);
			$strDaysHlf = $this->displayAttndDays($intHlfDay);
			$strDaysWhl = $this->displayAttndDays($intAbsDay);
			
			$this->objRprt->SetFont('Arial', "", 9);
			$this->objRprt->Cell(45, 5, $arrEmpInfo["surname"].", ".$arrEmpInfo["firstname"], 0, 0, "L");
			$this->objRprt->Cell(30, 5, $strDaysHlf, 0, 0, "L");
			$this->objRprt->Cell(30, 5, $strDaysWhl, 0, 0, "L");
			$this->objRprt->Cell(25, 5, $strDaysPrdm, 0, 0, "L");
			$this->objRprt->Cell(25, 5, $strDaysWoPrdm, 0, 0, "L");
			$this->objRprt->Cell(25, 5, $strDaysTotal, 0, 1, "L");
		}
	}
	
	function countPerDiem($t_strEmpNmbr, $t_intMonth, $t_intYear, $blnPerdiem)
	{
		$strMonthYear = $this->combineMonthYear($t_intYear, $t_intMonth);
		$objTO = mysql_query("SELECT dtrDate FROM tblEmpDTR 
								INNER JOIN tblEmpTravelOrder 
									ON tblEmpDTR.otherInfo = tblEmpTravelOrder.toID 
								WHERE tblEmpDTR.empNumber='$t_strEmpNmbr'
									AND tblEmpDTR.dtrDate LIKE '$strMonthYear%'
									AND tblEmpDTR.remarks = '".TRAVELORDER."'
									AND tblEmpTravelOrder.perdiem = '$blnPerdiem'");

		$intDays = mysql_num_rows($objTO);		
		return $intDays;
	}
	
	function displayAttndDays($t_intDayNmbr)
	{
		if($t_intDayNmbr == 0)
		{
			return "None";
		}
		else
		{
			$intDayNmbrInteger = intval($t_intDayNmbr);
			if($intDayNmbrInteger < $t_intDayNmbr)
			{
				if($intDayNmbrInteger == 0)
				{
					$strDayNmbr = "1/2";
				}
				else
				{
					$strDayNmbr = "$intDayNmbrInteger and 1/2";
				}
			}
			else
			{
				$strDayNmbr = $t_intDayNmbr;
			}
			return "$strDayNmbr day(s)";
		}
	}
	
	function bodyHPR($t_objEmpInfo, $t_arrAgency, $t_intMonth, $t_intYear)
	{
		$strMonth = $this->intToMonthFull($t_intMonth);
		if($_SESSION["empPerSelect"] == "Per Division")
		{
			$strType = "DIVISION: ";
			
			$objDvsnName = mysql_query("SELECT divisionName 
											FROM tblDivision 
										WHERE divisionCode = '".$_SESSION["divSecCode"]."'");
			$arrDvsnName = mysql_fetch_array($objDvsnName);
			$strTypeName = $arrDvsnName["divisionName"];
		}
		elseif($_SESSION["empPerSelect"] == "Per Section")
		{
			$strType = "SECTION: ";		
			$objSctnName = mysql_query("SELECT sectionName  
											FROM tblSection 
										WHERE sectionCode = '".$_SESSION["divSecCode"]."'");
			$arrSctnName = mysql_fetch_array($objSctnName);
			$strTypeName = $arrSctnName["sectionName"];
		}
		$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $strMonth, $t_intYear, $strType, $strTypeName);
		
		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);		
		$this->objRprt->setFooter($arrSgntry["signatory"], $arrSgntry["signatoryTitle"]);
		
		$this->objRprt->AddPage();
		while($arrEmpInfo = mysql_fetch_array($t_objEmpInfo))
		{			
			$arrAbsHlf = $this->getLateUndPrMonth($arrEmpInfo["empNumber"], $t_intMonth, $t_intYear);			
			
			$intHlfDay = $arrAbsHlf["half count"] * 0.5;
			$intAbsDay = $arrAbsHlf["absent count"];
			$intDaysTotal = $intHlfDay + $intAbsDay;
			
			$strDaysTotal = $this->displayAttndDays($intDaysTotal);
			$strDaysHlf = $this->displayAttndDays($intHlfDay);
			$strDaysWhl = $this->displayAttndDays($intAbsDay);
			
			$this->objRprt->SetFont('Arial', "", 9);
			$this->objRprt->Cell(40, 5, $arrEmpInfo["surname"].", ".$arrEmpInfo["firstname"], 0, 0, "L");
			$this->objRprt->Cell(55, 5, $strDaysHlf, 0, 0, "L");
			$this->objRprt->Cell(55, 5, $strDaysWhl, 0, 0, "L");
			$this->objRprt->Cell(30, 5, $strDaysTotal, 0, 1, "L");
		}
	}
	
	function bodyHYA($t_objEmpInfo, $t_arrAgency, $t_intPeriod, $t_intYear)
	{
		if($_SESSION["empPerSelect"] == "Per Division")
		{
			$strType = "DIVISION: ";
			
			$objDvsnName = mysql_query("SELECT divisionName 
											FROM tblDivision 
										WHERE divisionCode = '".$_SESSION["divSecCode"]."'");
			$arrDvsnName = mysql_fetch_array($objDvsnName);
			$strTypeName = $arrDvsnName["divisionName"];
			$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);			
		}
		elseif($_SESSION["empPerSelect"] == "Per Section")
		{
			$strType = "SECTION: ";		
			$objSctnName = mysql_query("SELECT sectionName  
											FROM tblSection 
										WHERE sectionCode = '".$_SESSION["divSecCode"]."'");
			$arrSctnName = mysql_fetch_array($objSctnName);
			$strTypeName = $arrSctnName["sectionName"];
			$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);
		}

		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);		
		$this->objRprt->setFooter($arrSgntry["signatory"], $arrSgntry["signatoryTitle"]);
		
//--------------------------------------------------------------------------------------------------
		$intFlag = 0;
	
		while($arrEmpInfo = mysql_fetch_array($t_objEmpInfo))
		{
			if($intFlag == 0)
			{
				if($_SESSION["empPerSelect"] == "All Employees")
				{
					$strType = "DIVISION: ";
					$strTypeName = $arrEmpInfo["divisionName"];
					$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);
				}
				$intFlag = 1;
				$this->objRprt->AddPage();
			}
			elseif($_SESSION["empPerSelect"] == "All Employees" && $strTypeName != $arrEmpInfo['divisionName'])
			{
				$strTypeName = $arrEmpInfo['divisionName'];
				$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);
				$this->objRprt->AddPage();
			}

			if($t_intPeriod == 1)
			{
				$arrMonth = array(0=>"1", 1=>"2", 2=>"3", 3=>"4", 4=>"5", 5=>"6");
			}
			elseif($t_intPeriod == 2)
			{
				$arrMonth = array(0=>"7", 1=>"8", 2=>"9", 3=>"10", 4=>"11", 5=>"12");
			}

			$strName = $arrEmpInfo['surname'].", ".$arrEmpInfo['firstname'];
			$this->objRprt->SetFont('Arial','B',8);
			$this->objRprt->SetFillColor(200,200,200);
			$this->objRprt->Cell(40,5,$strName, 1, 0, 'L');

			$intTardyTotal = 0;
			$intUndTotal = 0;
			$intHlfTotal = 0;
			$intWhlTotal = 0;
			
			for ($intCtr = 0; $intCtr < 6; $intCtr++)
			{
				$arrDTR = $this->getEmpDTR($arrEmpInfo["empNumber"], $arrMonth[$intCtr], $t_intYear);
				//late
				$arrLateUndAbs = $this->getLateUndPrMonth($arrEmpInfo["empNumber"], $arrMonth[$intCtr], $t_intYear, $arrDTR);
				$this->objRprt->Cell(20,5, $arrLateUndAbs["count"], 1, 0, 'C');			
				//halfday
				$this->objRprt->Cell(10,5, $arrLateUndAbs["half count"], 1, 0, 'C');
				//absent
				$this->objRprt->Cell(10,5, $arrLateUndAbs["absent count"], 1, 0, 'C');

				$intTardyTotal = $intTardyTotal + $arrLateUndAbs["count"];
				$intHlfTotal = $intHlfTotal + $arrLateUndAbs["half count"];
				$intWhlTotal = $intWhlTotal + $arrLateUndAbs["absent count"];

			}
			$this->objRprt->Cell(20,5, $intTardyTotal, 1, 0, 'C');
			$this->objRprt->Cell(10,5, $intHlfTotal, 1, 0, 'C');
			$this->objRprt->Cell(10,5, $intWhlTotal, 1, 1, 'C');
		}
		
//--------------------------------------------------------------------------------------------------
	}

	function bodyAFC($t_objEmpInfo, $t_arrAgency, $t_intPeriod, $t_intYear)
	{
		if($_SESSION["empPerSelect"] == "Per Division")
		{
			$strType = "DIVISION: ";
			
			$objDvsnName = mysql_query("SELECT divisionName 
											FROM tblDivision 
										WHERE divisionCode = '".$_SESSION["divSecCode"]."'");
			$arrDvsnName = mysql_fetch_array($objDvsnName);
			$strTypeName = $arrDvsnName["divisionName"];
			$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);			
		}
		elseif($_SESSION["empPerSelect"] == "Per Section")
		{
			$strType = "SECTION: ";		
			$objSctnName = mysql_query("SELECT sectionName  
											FROM tblSection 
										WHERE sectionCode = '".$_SESSION["divSecCode"]."'");
			$arrSctnName = mysql_fetch_array($objSctnName);
			$strTypeName = $arrSctnName["sectionName"];
			$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);
		}

		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);		
		$this->objRprt->setFooter($arrSgntry["signatory"], $arrSgntry["signatoryTitle"]);
		
//--------------------------------------------------------------------------------------------------
		$intFlag = 0;
	
		while($arrEmpInfo = mysql_fetch_array($t_objEmpInfo))
		{
			if($intFlag == 0)
			{
				if($_SESSION["empPerSelect"] == "All Employees")
				{
					$strType = "DIVISION: ";
					$strTypeName = $arrEmpInfo["divisionName"];
					$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);
				}
				$intFlag = 1;
				$this->objRprt->AddPage();
			}
			elseif($_SESSION["empPerSelect"] == "All Employees" && $strTypeName != $arrEmpInfo['divisionName'])
			{
				$strTypeName = $arrEmpInfo['divisionName'];
				$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);
				$this->objRprt->AddPage();
			}

			if($t_intPeriod == 1)
			{
				$arrMonth = array(0=>"1", 1=>"2", 2=>"3", 3=>"4", 4=>"5", 5=>"6");
			}
			elseif($t_intPeriod == 2)
			{
				$arrMonth = array(0=>"7", 1=>"8", 2=>"9", 3=>"10", 4=>"11", 5=>"12");
			}

			$strName = $arrEmpInfo['surname'].", ".$arrEmpInfo['firstname'];
			$this->objRprt->SetFont('Arial','B',8);
			$this->objRprt->SetFillColor(200,200,200);
			$this->objRprt->Cell(100,5,$strName, 1, 0, 'L');

			$intTotalFC = 0;			
			for ($intCtr = 0; $intCtr < 6; $intCtr++)
			{
/*				$arrDTR = $this->getEmpDTR($arrEmpInfo["empNumber"], $arrMonth[$intCtr], $t_intYear);
				//late
				$arrLateUndAbs = $this->getLateUndPrMonth($arrEmpInfo["empNumber"], $arrMonth[$intCtr], $t_intYear, $arrDTR);
				$this->objRprt->Cell(20,5, $arrLateUndAbs["count"], 1, 0, 'C');			
				//halfday
				$this->objRprt->Cell(10,5, $arrLateUndAbs["half count"], 1, 0, 'C');
				//absent
				$this->objRprt->Cell(10,5, $arrLateUndAbs["absent count"], 1, 0, 'C');

				$intTardyTotal = $intTardyTotal + $arrLateUndAbs["count"];
				$intHlfTotal = $intHlfTotal + $arrLateUndAbs["half count"];
				$intWhlTotal = $intWhlTotal + $arrLateUndAbs["absent count"];
*/				$intFC = $this->getEmpFC($arrEmpInfo["empNumber"], $arrMonth[$intCtr], $t_intYear);
				$this->objRprt->Cell(30,5, $intFC, 1, 0, 'C');
				$intTotalFC = $intTotalFC + $intFC;
			}
			$this->objRprt->Cell(30,5, $intTotalFC, 1, 1, 'C');
		}
		
//--------------------------------------------------------------------------------------------------
	}

	function bodyAAR($t_objEmpInfo, $t_arrAgency, $t_intPeriod, $t_intYear)
	{
		if($_SESSION["empPerSelect"] == "Per Division")
		{
			$strType = "DIVISION: ";
			
			$objDvsnName = mysql_query("SELECT divisionName 
											FROM tblDivision 
										WHERE divisionCode = '".$_SESSION["divSecCode"]."'");
			$arrDvsnName = mysql_fetch_array($objDvsnName);
			$strTypeName = $arrDvsnName["divisionName"];
			$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);			
		}
		elseif($_SESSION["empPerSelect"] == "Per Section")
		{
			$strType = "SECTION: ";		
			$objSctnName = mysql_query("SELECT sectionName  
											FROM tblSection 
										WHERE sectionCode = '".$_SESSION["divSecCode"]."'");
			$arrSctnName = mysql_fetch_array($objSctnName);
			$strTypeName = $arrSctnName["sectionName"];
			$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);
		}

		$objSgntry = mysql_query("SELECT * FROM tblSignatory WHERE designation = 'Personnel'");
		$arrSgntry = mysql_fetch_array($objSgntry);		
		$this->objRprt->setFooter($arrSgntry["signatory"], $arrSgntry["signatoryTitle"]);
		
//--------------------------------------------------------------------------------------------------
		$intFlag = 0;
	
		while($arrEmpInfo = mysql_fetch_array($t_objEmpInfo))
		{
			if($intFlag == 0)
			{
				if($_SESSION["empPerSelect"] == "All Employees")
				{
					$strType = "DIVISION: ";
					$strTypeName = $arrEmpInfo["divisionName"];
					$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);
				}
				$intFlag = 1;
				$this->objRprt->AddPage();
			}
			elseif($_SESSION["empPerSelect"] == "All Employees" && $strTypeName != $arrEmpInfo['divisionName'])
			{
				$strTypeName = $arrEmpInfo['divisionName'];
				$this->objRprt->setHeader($t_arrAgency["agencyName"], $t_arrAgency["address"], $t_intPeriod, $t_intYear, $strType, $strTypeName);
				$this->objRprt->AddPage();
			}

			if($t_intPeriod == 1)
			{
				$arrMonth = array(0=>"1", 1=>"2", 2=>"3");
			}
			elseif($t_intPeriod == 2)
			{
				$arrMonth = array(0=>"4", 1=>"5", 2=>"6");
			}
			elseif($t_intPeriod == 3)
			{
				$arrMonth = array(0=>"7", 1=>"8", 2=>"9");
			}
			elseif($t_intPeriod == 4)
			{
				$arrMonth = array(0=>"10", 1=>"11", 2=>"12");
			}
			
			$arrLB = $this->getLeaveBlnc($arrEmpInfo["empNumber"], $arrMonth[0], $arrMonth[2], $t_intYear);
		
			$strName = $arrEmpInfo['surname'].", ".$arrEmpInfo['firstname'];
			$this->objRprt->SetFont('Arial','B',8);
			$this->objRprt->SetFillColor(200,200,200);
			$this->objRprt->Cell(50,5,$strName, 1, 0, 'L');

			for ($intCtr = 0; $intCtr < 3; $intCtr++)
			{
				$arrDTR = $this->getEmpDTR($arrEmpInfo["empNumber"], $arrMonth[$intCtr], $t_intYear);
				//late				
				$arrTardyUnd = $this->getLateUndPrMonth($arrEmpInfo["empNumber"], $arrMonth[$intCtr], $t_intYear, $arrDTR);
				$this->objRprt->Cell(20,5,$arrTardyUnd["count"], 1, 0, 'C');			
				//halfday
				$this->objRprt->Cell(10,5,$arrTardyUnd["half count"], 1, 0, 'C');
				//Vacation Leave
				$intVL = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $arrEmpInfo["empNumber"], VACLEAVE);
				$intHVL = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $arrEmpInfo["empNumber"], HVACLEAVE);
				$intVL = $intVL + ($intHVL * 0.5);
				$this->objRprt->Cell(10,5,number_format($intVL,1,".",","), 1, 0, 'C');
				//Sick Leave
				$intSL = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $arrEmpInfo["empNumber"], SICKLEAVE);
				$intHSL = $this->getMonthSLVL($arrMonth[$intCtr], $t_intYear, $arrEmpInfo["empNumber"], HSICKLEAVE);
				$intSL = $intSL + ($intHSL * 0.5);

				$this->objRprt->Cell(10,5,number_format($intSL,1,".",","), 1, 0, 'C');

				$this->objRprt->Cell(20,5,number_format($arrLB[$intCtr][0],2,".",","), 1, 0, 'C');
				$this->objRprt->Cell(20,5,number_format($arrLB[$intCtr][1],2,".",","), 1, 0, 'C');
			}
			$this->objRprt->Ln(5);
		}
		
//--------------------------------------------------------------------------------------------------
	}
	
	function getLeaveBlnc($t_strEmpNmbr, $t_intMonthFrom, $t_intMonthTo, $t_intYear)
	{
		$objLB = mysql_query("SELECT vlBalance, slBalance
								FROM tblEmpLeaveBalance 
								WHERE periodYear='$t_intYear' 
									AND (periodMonth >= '$t_intMonthFrom' 
										AND periodMonth <= '$t_intMonthTo')
									AND empNumber = '$t_strEmpNmbr'
								ORDER BY periodMonth");
		
		while($arrLB = mysql_fetch_array($objLB))
		{
			$arrLeaveBalance[] = array($arrLB['vlBalance'], $arrLB['slBalance']);
		}
		
		return $arrLeaveBalance;
	}

	
	function reportPreview($t_intHeadFoot=1 ,$t_strRprtType, $t_strEmpNmbr='', $t_intMonth='', $t_intYear='')
	{
		if($t_intHeadFoot == 1)
		{
			$this->objRprt = new ReportHeaderFooter;
		}
		elseif($t_intHeadFoot == 0)
		{
			$this->objRprt= new FPDF;
		}
		elseif($t_intHeadFoot == 2)
		{
			$this->objRprt = new ReportHeaderFooterLWOP;
		}
		elseif($t_intHeadFoot == 3)
		{
			$this->objRprt = new ReportHeaderFooterTR;
		}
		elseif($t_intHeadFoot == 4)
		{
			$this->objRprt = new ReportHeaderFooterMA;
		}
		elseif($t_intHeadFoot == 5)
		{
			$this->objRprt = new ReportHeaderFooterMCR;
		}
		elseif($t_intHeadFoot == 6)
		{
			$this->objRprt = new ReportHeaderFooterHPR;
		}
		elseif($t_intHeadFoot == 7)
		{
			$this->objRprt = new ReportHeaderFooterHYA('L','mm', 'Legal');
		}
		elseif($t_intHeadFoot == 8)
		{
			$this->objRprt = new ReportHeaderFooterAAR('L','mm', 'Legal');
		}
		elseif($t_intHeadFoot == 9)
		{
			$this->objRprt = new FPDF('L','mm', 'Legal');
		}
		elseif($t_intHeadFoot == 10)
		{
			$this->objRprt = new ReportHeaderFooterAFC('L','mm', 'Legal');
		}
		
		$this->objRprt->SetLeftMargin(15);
		$this->objRprt->SetRightMargin(15);		
		
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		$this->empInfo($t_strRprtType, $t_strEmpNmbr, $t_intMonth, $t_intYear);
		$this->objRprt->Output();
	}
}
?>