<?
/* 
File Name: ReportAFBody.php (class folder)
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
by the Free Softwar e Foundation; either version 2 of the License, or 
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
require('../hrmis/class/ReportAppointmentForm.php');

class ReportAFBody extends General
{
	var $objRprt;
	var $intCounter = 0;

	
	//  Body
	function printBody($t_strEmpName,$t_strAgencyName,$t_strPositionDesc,$t_strAgencyAbb,$t_agencyAdd,$t_strAgencyHeadName,$t_strDateOfSigning,$t_strPersonnelOfficer,$t_strPublishedWhen)
	{
		

		$this->objRprt->SetFont(Arial,'',11);
		$this->objRprt->Cell(0,7,"KSS PORMA BLG. 33",0,0,L); 
		$this->objRprt->ln(5);
		$this->objRprt->Cell(0,7,"(Narebisa, 1998)",0,0,L); 
		$this->objRprt->ln(10);
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(0,7,"Republic of the Philippines",0,0,C); 
		$this->objRprt->ln(5);
		$this->objRprt->SetFont(Arial,'B',11);
		$this->objRprt->Cell(0,7,$t_strAgencyName,0,0,C); 
		$this->objRprt->ln(5);
		$this->objRprt->SetFont('Arial','',11);
		$this->objRprt->Cell(0,7,$t_agencyAdd,0,0,C);
		$this->objRprt->ln(20);

		$this->objRprt->SetFont(Arial,'',11);
		$this->objRprt->Cell(14,5,"Ginoong/Gng/Bb.:",0,0,L);
		$this->objRprt->Cell(70,5,$t_strEmpName,0,0,R);
		$this->objRprt->ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(0,5,"Mr./Mrs./Ms",0,0,L);	
		$this->objRprt->Ln(15);
		
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(200,3,$t_strAgencyAbb,0,0,C);
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"Kayo ay nahirang na _______________________________________________________na",0,0,L);
		$this->objRprt->ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(0,5,"You are hereby appointed as",0,0,L);
		$this->objRprt->Ln(6);
			
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(105,3," ".$_SESSION['sesAppointmentStatus']." ",0,0,C);
		$this->objRprt->Cell(30,3,$t_strPositionDesc,0,0,C);
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"May katayuang __________________   sa ________________________________________",0,0,L);
		$this->objRprt->ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(0,5,"with a                                                         (Status)                              at the                                                   (Agency)",0,0,L);
		$this->objRprt->Ln(6);
	

		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(200,3," ".$_SESSION['sesSalary'],0,0,C);
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"sa pasahod na __________________________________________________________ piso",0,0,L);
		$this->objRprt->Ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(0,5,"with a compensation rate of                                                                                                                                                                                      pesos per annum",0,0,L);
		$this->objRprt->Ln(6);
		
		
		
		
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(0,5,"Ito  ay magkakabisa  sa petsa ng  pagganap  ng  tungkulin  subali't  di aaga sa petsa ng",0,0,L);
		$this->objRprt->Ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(0,5,"The   effectivity  date   of   his   appointment   shall  be  the  date  of  actual  assumption  by  the  appointee  but  not  earlier  than  the  date  of  issuance  of",0,0,L);
		$this->objRprt->Ln(6);
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(0,5,"pagpirma ng puno ng tanggapan o appointing authority.",0,0,L);
		$this->objRprt->Ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(0,5,"the appointment which is the date of the signing of the appointing authority.",0,0,L);
		$this->objRprt->Ln(6);
		
			
		$this->objRprt->Ln(7);
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(210,3,$_SESSION['sesRsnForAppointment'],0,0,C);
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"             Ang appointment  na ito  ay _________________________________bilang kapalit ni",0,0,L);
		$this->objRprt->ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(0,5,"                     This appointment is                                                                                   (Original,Promition, etc)                                         vice",0,0,L);                      
		$this->objRprt->Ln(6);
		
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(70,3,$_SESSION['sesReplaced'],0,0,C);
		$this->objRprt->Cell(80,3,$_SESSION['sesModeOfSeparation'],0,0,C);
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"_______________________________ na _______________________ at ayon sa Plantilya",0,0,L);
		$this->objRprt->ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(0,5,"                                                                                                                who                       (Transfered, Retired etc)                     and in accordance with Plantilla",0,0,C);                      
		$this->objRprt->Ln(6);
		
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(105,3,$_SESSION['sesItemNumber'],0,0,C);
		$this->objRprt->Cell(10,3,$_SESSION['sesPlantillaPageNum'],0,0,C);
		
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"Aytem Bldg ____________________________Pahina _______.",0,0,L);
		$this->objRprt->ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(0,5,"Item Number                                                                                                            Page",0,0,L);                      	

		$this->objRprt->Ln(15);
		$this->objRprt->SetFont(Arial,'B',12);
		$this->objRprt->Cell(100,5," ",0,0,L);
		$this->objRprt->Cell(110,5,"Sumasainyo",0,0,L);
		$this->objRprt->ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(100,5," ",0,0,L);
		$this->objRprt->Cell(110,5,"  Very truly yours",0,0,L);
		               	

		$this->objRprt->Ln(10);
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(260,3,$t_strAgencyHeadName,0,0,C);
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(100,5," ",0,0,L);
		$this->objRprt->Cell(110,5,"_________________________",0,0,L);                      	
		$this->objRprt->SetFont(Arial,'B',12);
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(110,5," ",0,0,C);
		$this->objRprt->Cell(35,5,"Puno ng Tanggapan",0,0,L);                      	
		$this->objRprt->Ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(120,5," ",0,0,C);
		$this->objRprt->Cell(45,5,"Head of the Agency",0,0,L);                      	
	
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(260,3,$t_strDateOfSigning,0,0,C);
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(100,5," ",0,0,L);
		$this->objRprt->Cell(110,5,"_________________________",0,0,L);  
		$this->objRprt->SetFont(Arial,'B',12);
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(110,5," ",0,0,C);
		$this->objRprt->Cell(35,5,"Petsa ng Pagpirma",0,0,L);  
		$this->objRprt->Ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(120,5," ",0,0,C);
		$this->objRprt->Cell(45,5,"Date of Signing",0,0,L);                      	
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont(Arial,'',12);
		//$this->objRprt->Cell(0,3,"         Pealiezl Dy Tioco",0,0,L);
		//$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"_______________________",0,0,L);                      	
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(0,5,"    Awtorisadong Opisyal",0,0,L);    
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(0,5,"Komisyon ng Serbisyo Sibil",0,0,L);    
		$this->objRprt->Ln(4);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(0,5,"   Authorized Official/Civil Service Commission",0,0,L);   
			
		$this->objRprt->Ln(10);

		//Sertipikasyon paragraph 1
		$this->objRprt->SetFont(Arial,'B',12);
		$this->objRprt->Ln(10);
		$this->objRprt->Cell(0,5,"Sertipikasyon",0,0,C);                      	
		$this->objRprt->Ln(8);
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(0,5,"            Ito  ay  pagpapatunay  na   lahat  ng  dapat  gawin  at  mga   kailangan",0,0,C);   
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(135,5," ",0,0,R);
		$this->objRprt->Cell(17,5,$_SESSION['sesMCNumber'],0,0,C);
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"dokumento  para sa appointment  na ito ay ayon sa CSC MC No. ________, s.",0,0,C);    
		
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(0,5,"1998 ay nasunod na , narebisa ko at napatunayang nasa ayos.                           ",0,0,C);     
	
		$this->objRprt->Ln(11);
		$this->objRprt->Cell(95,5," ",0,0,R);
		$this->objRprt->Cell(20,5,$_SESSION['sesPublishedWher'],0,0,C);    
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"            Ang  posisyon  ay  nalathala  sa _________________________ noong ",0,0,C);     
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(58,5,$t_strPublishedWhen,0,0,C);    
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"        ________________",0,0,L);     
		
		$this->objRprt->Ln(10);
		$this->objRprt->Cell(0,5,"            This    is  to  certify  that   all   requirements   and     supporting   papers",0,0,C);     
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(55,5," ",0,0,L);
		$this->objRprt->Cell(20,5,$_SESSION['sesMCNumber'],0,0,C);
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(0,5,"pursuant   to   MC  # ____________, s    1998   have    been    complied   with,",0,0,C);     
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(0,5,"         reviewed and  found  to  be  in  order.",0,0,L);     

		$this->objRprt->Ln(15);
		$this->objRprt->Cell(260,3,$t_strPersonnelOfficer,0,0,C);
		$this->objRprt->Ln(1);
		$this->objRprt->Cell(100,5," ",0,0,L);
		$this->objRprt->Cell(110,5,"_________________________",0,0,L);                      	
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(120,5," ",0,0,C);
		$this->objRprt->Cell(20,5,"Personnel Officer/HRMO",0,0,C);                      	
		                    	
	
		
		
//setipikasyon2

		$this->objRprt->Ln(10);
		$this->objRprt->SetFont(Arial,'B',12);
		$this->objRprt->Cell(0,5,"Sertipikasyon",0,0,C);                      	
		$this->objRprt->Ln(8);
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(0,5,"           Ito  ay   pagpapatunay  na   ang   nahirang  ay  nagdaan  sa  pagsusulit",0,0,C);   
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(0,5,"          ng Personnel Selection Board at kwalipikado.",0,0,L);    
		$this->objRprt->Ln(10);
		$this->objRprt->Cell(0,5,"           This  is   to certify that  the  appointee  has  been  screened  and  found",0,0,C);   
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(0,5,"          qualified by the Promotion/Personnel Selection Board.",0,0,L);    

//mga notasyon		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont(Arial,'B',12);
		$this->objRprt->Cell(0,5,"Mga Notasyon",0,0,C);
		$this->objRprt->Ln(5);
		$this->objRprt->SetFont(Arial,'',12);
		$this->objRprt->Cell(0,5,"           ___________________________________________________________",0,0,C);   
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(0,5,"           ___________________________________________________________",0,0,C);   
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(0,5,"           ___________________________________________________________",0,0,C);   
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(0,5,"           ___________________________________________________________",0,0,C);   
	
		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont(Arial,'B',12);
		$this->objRprt->Cell(0,5,"           ANUMANG   BURA   O  PAGBABAGO  SA  AKSYONG  GINAWA  NG",0,0,C);   
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(0,5,"          KOMISYON   NG   SERBISYO   SIBIL   AY   MAGPAPAWALANG   BISA   SA",0,0,L);    
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(0,5,"     PAGHIRANG NA ITO MALIBAN KUNG ANG PAGBABAGO AY NASULAT NA",0,0,C);   
		$this->objRprt->Ln(6);
		$this->objRprt->Cell(0,5,"          KINUMPIRMA NG KOMISYON.",0,0,L);    

		
		$this->objRprt->Ln(10);
		$this->objRprt->SetFont(Arial,'',11);
		$this->objRprt->Cell(0,5,"           Petsa ng paglabas sa KSS/Komisyon :",0,0,L);   
		$this->objRprt->Ln(10);
		$this->objRprt->Cell(0,5,"           Mga Pagbibigay ng Kopya:",0,0,L);  
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(0,5,"            Orihinal                       -  Kopya ng nahirang",0,0,L);   
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(0,5,"            Pangalawang Kopya  -  para sa Komisyon ng Serbisyo Sibil",0,0,L);   
		$this->objRprt->Ln(5);
		$this->objRprt->Cell(0,5,"            Pangatlong Kopya      -  para sa Ahensiya",0,0,L);   
		
	}
	
	
	
	function generateReport()
	{
		$this->objRprt = new ReportAppointmentForm;
	
		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(25);
		$this->objRprt->SetAutoPageBreak("on",25);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		
		$objOfficeInfo = mysql_query("SELECT tblAgency.agencyName,tblAgency.abbreviation, tblAgency.address, tblAgency.telephone
								      FROM tblAgency");
		$arrOfficeInfo = mysql_fetch_array($objOfficeInfo);
		$strAgencyAbb = $arrOfficeInfo['abbreviation'];
		$strAgencyName = $arrOfficeInfo['agencyName'];
		$tstrAgencyName = strtoupper($strAgencyName);
		$agencyAdd = $arrOfficeInfo['address'];
		
		
		$objAgencyHead = mysql_query("SELECT tblSignatory.signatory
									   FROM tblSignatory
									  WHERE tblSignatory.designation = 'Director'");	
		$arrAgencyHeadName = mysql_fetch_array($objAgencyHead);
		$strAgencyHeadName = $arrAgencyHeadName['signatory'];
		
		
		$curDate = date("Y-m-d");
		$strYear = date("Y", strtotime($curDate)); 
		$strMonth = date("n", strtotime($curDate));
		$strMonthFull = $this->intToMonthFull($strMonth);
		$strDay = date("d", strtotime($curDate));
		$strDateOfSigning = $strMonthFull." ".$strDay." ,  ".$strYear;
		
		
		$objPersonnelOfficer = mysql_query("SELECT tblSignatory.signatory
									   FROM tblSignatory
									  WHERE tblSignatory.designation = 'Personnel'");
		$arrPersonnelOfficer = mysql_fetch_array($objPersonnelOfficer);
		$strPersonnelOfficer = $arrPersonnelOfficer['signatory'];
		$strPublishedMonth = $this->intToMonthFull($_SESSION['sesMonth']);
		$strPublishedWhen = $strPublishedMonth." ".$_SESSION['sesDay']. " , ".$_SESSION['sesYear'];
		
		
		
		$objEmpName = mysql_query("SELECT tblEmpPersonal.surname, tblEmpPersonal.firstname,tblEmpPersonal.middlename
								   FROM tblEmpPersonal
								   WHERE tblEmpPersonal.empNumber = '".$_SESSION['sesEmpNum']."'");
		$arrEmpName = mysql_fetch_array($objEmpName);
		$strMidName = $arrEmpName['middlename'];
		$strMiddleInitial = substr($strMidName, 0,1);
		$strEmpName = $arrEmpName['firstname']." ".$strMidName." ".$arrEmpName['surname'];
		
		$objEmpPositionDesc = mysql_query("SELECT tblPosition.positionDesc
											FROM tblPosition
											WHERE tblPosition.positionCode = '".$_SESSION['sesPositionName']."' ");
		$arrEmpPositionDesc = mysql_fetch_array($objEmpPositionDesc);
		$strPositionDesc = $arrEmpPositionDesc['positionDesc'];
		
		$this->printBody($strEmpName,$tstrAgencyName,$strAgencyAbb,$strPositionDesc,$agencyAdd,$strAgencyHeadName,$strDateOfSigning,$strPersonnelOfficer,$strPublishedWhen);
		$this->objRprt->Output();
	}
				

}  // End Class




?>