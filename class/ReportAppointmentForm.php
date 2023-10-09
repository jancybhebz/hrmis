<?
/* 
File Name: ReportAppointmentForm.php (class folder)
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
define('FPDF_FONTPATH','../hrmis/class/font/');
require_once("../hrmis/class/fpdf.php");

class ReportAppointmentForm extends FPDF 
{

	var $strTitle;
	var $intPageNo;
	var $strMonthName, $intYear;
	var $strSgntryName, $strSgntryTitle;
   
/*	function MultiCell($w,$h,$txt,$border=0,$align='J',$fill=0,$indent=0)
	{
		//Output text with automatic or explicit line breaks
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
	
		$wFirst = $w-$indent;
		$wOther = $w;
	
		$wmaxFirst=($wFirst-2*$this->cMargin)*1000/$this->FontSize;
		$wmaxOther=($wOther-2*$this->cMargin)*1000/$this->FontSize;
	
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$b=0;
		if($border)
		{
			if($border==1)
			{
				$border='LTRB';
				$b='LRT';
				$b2='LR';
			}
			else
			{
				$b2='';
				if(is_int(strpos($border,'L')))
					$b2.='L';
				if(is_int(strpos($border,'R')))
					$b2.='R';
				$b=is_int(strpos($border,'T')) ? $b2.'T' : $b2;
			}
		}
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$ns=0;
		$nl=1;
			$first=true;
		while($i<$nb)
		{
			//Get next character
			$c=$s[$i];
			if($c=="\n")
			{
				//Explicit line break
				if($this->ws>0)
				{
					$this->ws=0;
					$this->_out('0 Tw');
				}
				$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$ns=0;
				$nl++;
				if($border and $nl==2)
					$b=$b2;
				continue;
			}
			if($c==' ')
			{
				$sep=$i;
				$ls=$l;
				$ns++;
			}
			$l+=$cw[$c];
	
			if ($first)
			{
				$wmax = $wmaxFirst;
				$w = $wFirst;
			}
			else
			{
				$wmax = $wmaxOther;
				$w = $wOther;
			}
	
			if($l>$wmax)
			{
				//Automatic line break
				if($sep==-1)
				{
					if($i==$j)
						$i++;
					if($this->ws>0)
					{
						$this->ws=0;
						$this->_out('0 Tw');
					}
					$SaveX = $this->x; 
					if ($first and $indent >0)
					{
						$this->SetX($this->x + $indent);
						$first=false;
					}
					$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
						$this->SetX($SaveX);
				}
				else
				{
					if($align=='J')
					{
						$this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
						$this->_out(sprintf('%.3f Tw',$this->ws*$this->k));
					}
					$SaveX = $this->x; 
					if ($first and $indent >0)
					{
						$this->SetX($this->x + $indent);
						$first=false;
					}
					$this->Cell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
						$this->SetX($SaveX);
					$i=$sep+1;
				}
				$sep=-1;
				$j=$i;
				$l=0;
				$ns=0;
				$nl++;
				if($border and $nl==2)
					$b=$b2;
			}
			else
				$i++;
		}
		//Last chunk
		if($this->ws>0)
		{
			$this->ws=0;
			$this->_out('0 Tw');
		}
		if($border and is_int(strpos($border,'B')))
			$b.='B';
		$this->Cell($w,$h,substr($s,$j,$i),$b,2,$align,$fill);
		$this->x=$this->lMargin;
		}
	}
*/	
	//  Page Header
	function ReportPersonnelAction()
	{
		$this->FPDF('P', 'mm', 'A4');
	}
/*
	function Header()
	{
		$this->SetFont(Arial,'',12);
		$txt = "KSS PORMA BLG. 33 \n (Narebisa, 1998)";
		$this->MultiCell(5,$InterLigne,'',0,'L',0); 
		$this->Write(5,$txt);
		
		$this->ln(10);
		$txt = "Republic of the Philippines";
		$txtLen = $this->GetStringWidth($txt);
		$milieu = (210-$txtLen)/2;
		$this->SetX($milieu);
		$this->Write(5,$txt);
		
		$this->ln(5);
		$txt = "_______________________________";
		$txtLen = $this->GetStringWidth($txt);
		$milieu = (210-$txtLen)/2;
		$this->SetX($milieu);
		$this->Write(5,$txt);
		
		$this->ln(5);
		$txt = "(Agency)";
		$txtLen = $this->GetStringWidth($txt);
		$milieu = (210-$txtLen)/2;
		$this->SetX($milieu);
		$this->Write(5,$txt);
		
		$this->ln(5);
		$txt = "______________________";
		$txtLen = $this->GetStringWidth($txt);
		$milieu = (210-$txtLen)/2;
		$this->SetX($milieu);
		$this->Write(5,$txt);
		
		$this->ln(20);
	}

	//  Footer
	function Footer()
	{
		//Sertipikasyon paragraph 1
		$this->SetFont(Arial,'',12);
		$this->ln(10);
		$txt = "Sertipikasyon";
		$txtLen = $this->GetStringWidth($txt);
		$milieu = (210-$txtLen)/2;
		$this->SetX($milieu);
		$this->Write(5,$txt);
		
		$this->ln(8);
		$txt = "Ito ay pagpapatunay na lahat ng dapat gawin at mga kailangan dokumento para s appointment na ito ay ayon s CSC MC No. ___, s. 1998 ay nasunod na , narebisa ko at napatunayang nasa ayos.";
		$this->MultiCell(0,$InterLigne,$txt,0,'J',0,15); 
		
		$this->ln(3);
		$txt = "Ang posisyon ay nalathala sa ____________ noong ______________________.";
		$this->MultiCell(0,$InterLigne,$txt,0,'J',0,15); 
		
		$this->ln(3);
		$txt = "This is to certify that all requirements and supporting papers pursuant to MC # __________,s 1998 have been complied with, reviewed and found to be in order.";
		$this->MultiCell(0,$InterLigne,$txt,0,'J',0,15); 
		
		$this->ln(5);
		$txt = "___________________ \n Personnel Officer/HRMO";
		$this->MultiCell(0,5,$txt,0,'R',0); 
		
		
		//Sertipikasyon paragraph 2
		$this->ln(10);
		$txt = "Sertipikasyon";
		$txtLen = $this->GetStringWidth($txt);
		$milieu = (210-$txtLen)/2;
		$this->SetX($milieu);
		$this->Write(5,$txt);
		
		$this->ln(10);
		$txt = "Ito ay pagpapatunay na ang nahirang ay nagdaan sa pagsusulit ng Personnel Selection Board at kwalipikado.";
		$this->MultiCell(0,$InterLigne,$txt,0,'J',0,15); 
		
		$this->ln(3);
		$txt = "This is to certify that the appointee has been screened and found qualified by the Promotion/Personnel Selection Board.";
		$this->MultiCell(0,$InterLigne,$txt,0,'J',0,15); 
		
		$this->ln(5);
		$txt = "______________________________";
		$this->MultiCell(0,3,$txt,0,'R',0); 
		
		//$this->ln(10);
		$txt = "Chairman Personnel Selection Board";
		$this->MultiCell(0,5,$txt,0,'R',0); 
		
		//Mga Notasyon 1
		$this->ln(10);
		$txt = "Mga Notasyon";
		$txtLen = $this->GetStringWidth($txt);
		$milieu = (210-$txtLen)/2;
		$this->SetX($milieu);
		$this->Write(5,$txt);
		
		$this->ln(10);
		$txt = "_________________________________________________________________";
		$this->MultiCell(0,$outerLigne,$txt,0,'J',0,15); 
		
		$this->ln(5);
		$txt = "_________________________________________________________________";
		$this->MultiCell(0,$outerLigne,$txt,0,'J',0,15); 
		
		$this->ln(5);
		$txt = "_________________________________________________________________";
		$this->MultiCell(0,$outerLigne,$txt,0,'J',0,15); 
		
		//Mga Notasyon 2
		$this->ln(10);
		$txt = "ANUMANG BURA O PAGBABAGO SA AKSYONG GINAWA NG KOMISYON NG SERBISYO SIBIL AY MAGPAPAWALANG BISA SA PAGHIRANG NA ITO MALIBAN KUNG ANG PAGBABAGO AY NASULAT NA KINUMPIRMA NG KOMISYON.";
		$this->MultiCell(0,$OuterLigne,$txt,1,'',0); 
		
		//Petsa ng paglabas sa KSS/Komisyon
		$this->ln(5);
		$this->SetFont('Arial','',10);
		$txt = "Petsa ng paglabas sa KSS/Komisyon    |";
		$this->MultiCell(0,$OuterLigne,$txt,1,'L',0); 
		//$this->MultiCell(0,$InterLigne,"",0,'R',0); 
		
		//Mga Pagbibigyan ng Kopya:
		$this->ln(5);
		$txt = "Mga Pagbibigay ng Kopya: \n\t    Orihinal                         -     Kopya ng nahirang \n\t    Pangalawang Kopya    -     para sa Komisyon ng Serbisyo Sibil  \n\t    Pangatlong Kopya        -     para sa Ahensiya";
		$this->MultiCell(0,$OuterLigne,$txt,1,'L',0); 
	} // End Footer
*/

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
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
	}
	
	/*function setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum)
	{
		$objOfficeInfo = mysql_query("SELECT tblAgency.agencyName, tblAgency.address, tblAgency.telephone
									  FROM tblAgency");
		$arrOfficeInfo = mysql_fetch_array($objOfficeInfo);
		$strAgencyName = $arrOfficeInfo['agencyName'];
		$t_strAgencyName = strtoupper($strAgencyName);
		$this->agencyName = $t_strAgencyName;
		$this->agencyAdd = $arrOfficeInfo['address'];
		$this->agencyNum = $arrOfficeInfo['telephone'];
	}*/	


}  //  End Class
?>