<?
/* 
File Name: ReportMonthlySeparation.php
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
define('FPDF_FONTPATH','../hrmis/class/font/');
require_once("../hrmis/class/fpdf.php");

class ReportMonthlyAccession extends FPDF 
{

	var $strTitle;
	var $intPageNo;
	var $strMonthName, $intYear;
	var $strSgntryName, $strSgntryTitle;

	//Page header
	function ReportMonthlyAccession()
	{
		$this->FPDF('L', 'mm', 'Legal');
	}
	
	function Header()
	{
		
		$this->SetFont(Arial,'B',12);
		$this->Cell(0,0,"REPUBLIC OF THE PHILIPPINES",0,0,C);
		$this->Ln(5);
		$this->Cell(0,0,"CIVIL SERVICE COMMISSION",0,0,C);
		$this->Ln(10);
		$this->SetFont(Arial,'B',10);
		$this->Cell(0,0,"MONTHLY REPORT ON ACCESSION",0,0,C);
		$this->Ln(5);
		$this->Cell(0,0,'FOR THE MONTH OF  '.$this->strMonthName.'  '.$this->intYear.'',0,0,C);
		$this->Ln(10);
		$this->SetFont(Arial,'B',10);
		$this->Cell(0,0,'Agency : '.$this->agencyName.'',0,0,C);
		$this->Ln(10);
		
		
		$Title = 25;
		$this->SetFont(Arial,'B',10);
		$this->Cell(70,$Title,"NAME",0,0,C);
		$this->Cell(30,$Title,"DATE OF",0,0,C);
		$this->Cell(70,$Title,"POSITION",0,0,C);
		$this->Cell(40,$Title,"STATUS OF",0,0,C);
		$this->Cell(25,$Title,"SALARY",0,0,C);
		$this->Cell(30,$Title,"MODE OF",0,0,C);
		$this->Cell(30,$Title,"EFFECTIVITY",0,0,C);
		$this->Cell(30,$Title,"REMARKS",0,0,C);
		$this->Ln(5);
		$this->Cell(70,25," ",1,0,C);                    //  Name                    
		$this->Cell(30,25,"BIRTH",1,0,C);                //  Date of birth
		$this->Cell(70,25,"TITLE",1,0,C);                //  Position title
		$this->Cell(40,25,"APPOINTMENT",1,0,C);          //  Status of appointment
		$this->Cell(25,25,"GRADE",1,0,C);                //  Salary Grade
		$this->Cell(30,25,"ACCESSION",1,0,C);           //  Mode of Separation
		$this->Cell(30,25,"DATE OF",1,0,C);             //  Effectivity Date Of Appointment
		$this->Cell(30,25," ",1,0,C);               	//  Remarks
		$this->Ln(5);
		$this->Cell(70,$Title," ",0,0,C);               //  Name
		$this->Cell(30,$Title," ",0,0,C);          		//  Date of birth
		$this->Cell(70,$Title," ",0,0,C);         		//  Position title
		$this->Cell(40,$Title," ",0,0,C);       		//  Status of appointment
		$this->Cell(25,$Title," ",0,0,C);               //  Salary Grade
		$this->Cell(30,$Title," ",0,0,C);       		//  Mode of Separation
		$this->Cell(30,$Title,"APPOINTMENT",0,0,C);		//  Effectivity Date Of Appointment
		$this->Cell(30,$Title," ",0,0,C);             	//  Remarks
		$this->Ln(5);	
		$this->Cell(70,$Title," ",0,0,C);               //  Name
		$this->Cell(30,$Title," ",0,0,C);               //  Date of birth
		$this->Cell(70,$Title," ",0,0,C);               //  Position title
		$this->Cell(40,$Title," ",0,0,C);     			//  Status of appointment
		$this->Cell(25,$Title," ",0,0,C);               //  Salary Grade
		$this->Cell(30,$Title," ",0,0,C);     			//  Mode of Separation
		$this->Cell(30,$Title," ",0,0,C);               //  Effectivity Date Of Appointment
		$this->Cell(50,$Title," ",0,0,C);        		//  Remarks
		$this->Ln(15);
	}
	
	//Page footers
	function Footer() 
	{
		$this->SetY(-45);   // gray total
		$this->SetFont(Arial,'B',14);
		$this->Cell(0,0,"I certify that the above list is true and correct per records of this office.",0,0,C);
		$this->Ln(10);
		$this->Cell(30);
		$this->setSignatory("Personnel");
		$this->Cell(80,5, strtoupper($this->strSgntryName),0,0,L);
		$this->Ln(1);
		$curdate = date("F j, Y");
		$this->Cell(290,5,$curdate,0,0,R);
		$this->Ln(5);
		$this->Cell(80,8,"_________________________________________",0,0,L);
		//$this->Ln(3);
		$this->Cell(225,8,"_____________________",0,0,R);
		$this->Ln(5);
		$this->Cell(45);
		//$this->setSignatory("Personnel");
		$this->Cell(80,10,$this->strSgntryTitle,0,0,L);
		$this->Ln(3);	
		$this->Cell(280,10,"Date",0,0,R);
		$this->Ln(5);

	}

	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
	}
	
	
	function setMonthYear($t_strMonthName, $t_intYear)
	{
		$this->strMonthName = strtoupper($t_strMonthName);
		$this->intYear = $t_intYear;
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
	
}   //end class

?>