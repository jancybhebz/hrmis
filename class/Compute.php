<?
/* 
File Name: Compute.php
----------------------------------------------------------------------
Purpose of this file: 
Class Compute
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: JDG
----------------------------------------------------------------------
Date of Revision: October 26, 2003
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
require("AttendanceCompensation.php");
class Compute extends AttendanceCompensation
{
var $laundryAllow;
var $hazardPay;
var $subsistence;
var $longevityAllow;
var $lifeRetshare;
var $pagIbigshare;
var $lifeRet;
var $pagIbig;
var $philHealth;
var $itw;
var $strDeduct;
var $magnaCarta;
var $sumDeduction;


		
	function Compute()
	{
		include("Connect.php");   //the dbase connection
				
	}
	
	function computeIncome($actualSal, $strIncome, $hpFactor, $workDays, $daysAbsent, $holidays, $yearService, $chkvalue)
	{
		switch ($strIncome) { 
			
			case "laundryAllow"	: 	if ($chkvalue == 'Y') 
									{			
										$this->laundryAllow = 300;
								  		return $this->laundryAllow;
									}
									else 
									{ 
										$this->laundryAllow = 0; 
										return $this->laundryAllow;
									} 
								  
			case "hazardPay"	: 	if (($chkvalue == 'Y') and ($hpFactor > 0)) 
									{		
								  			$this->hazardPay = ((($actualSal * ($hpFactor/100)) / $workDays) * ($workDays - $daysAbsent));
								  			return $this->hazardPay;
								  	}
								  	else {
								  			$this->hazardPay = 0;
								  			return $this->hazardPay;
								  		}
								  
			case "subsistence"	: 	if ($chkvalue == 'Y') 
									{
										$this->subsistence = (($workDays - $holidays) - $daysAbsent) * 150;
								  		return $this->subsistence;
									}
									else 
									{ 
										$this->subsistence = 0; 
										return $this->subsistence;
									}
									
			case "longevityAllow" :	if ($chkvalue == 'Y') 
									{	
										$yearFactor = ($yearService / 5) ; 
										$this->longevityAllow = ($actualSal * floor($yearFactor)) * (5 / 100);
										return $this->longevityAllow;
									}
									else 
									{ 
										$this->longevityAllow = 0; 
										return $this->longevityAllow;
									}
									
			case "magnaCarta"	:	if ($chkvalue == 'Y') 
									{
									 $this->magnaCarta = ($this->laundryAllow + $this->subsistence);
									 return $this->magnaCarta;
									}
									else 
									{ 
										$this->magnaCarta = 0; 
										return $this->magnaCarta;
									}		
			default			: break;
		}
   
	}
	
	function computeTotal($benefitsTotal)
	{
		$benefitsTotal = $this->laundryAllow + $this->subsistence + + $this->hazardPay + $this->longevityAllow;
		return $benefitsTotal;
	
	}
	
	function computeDeduction($empNumber, $actualSal, $strDeduct, $taxCode, $dependents, $chkDeduct, $cboMonth, $healthProvider)
	{

	 switch ($strDeduct) { 
	 	
		case "lifeRet"		:	if ($chkDeduct == 'Y') 
								{	
									$this->lifeRet = $actualSal * 0.09; 
						  			return round($this->lifeRet,2);
								}
								else {
									$this->lifeRet = 0; 
						  			return $this->lifeRet;
								}
						  
		case "lifeRetshare"	: 	if ($chkDeduct == 'Y') 
								{		
									$this->lifeRetshare = $actualSal * 0.12;
									return round($this->lifeRetshare,2);
								}
								else {
									$this->lifeRetshare = 0;
									return $this->lifeRetshare;
								}
						  
		case "pagIbig"		:   if ($chkDeduct == 'Y') 
								{	
									if (($actualSal * 0.02) > 100) {
										$this->pagIbig = 100;
										return $this->pagIbig; }
							    	else {
										$this->pagIbig = $actualSal * 0.02;
										return round($this->pagIbig,2);
										}
								}
								else {
									$this->pagIbig = 0;
									return $this->pagIbig;
								}
								
									
		case "pagIbigshare"	:	if ($chkDeduct == 'Y') 
								{ 
									if (($actualSal > 0) && ($actualSal < 5000)) {
										$this->pagIbigshare = $actualSal * 0.02;
										return round($this->pagIbigshare,2); }		
									elseif ($actualSal >= 5000) {
										$this->pagIbigshare = 5000 * 0.02;
										return round($this->pagIbigshare,2); }
								}
								else {
									$this->pagIbigshare = 0;
									return $this->pagIbigshare;
								}
									
		case "philHealth"	:	if ($chkDeduct == 'Y') 
								{ 		
									$result = "SELECT * FROM tblPhilhealthRange";
									$sqlresult = mysql_query($result) or die (mysql_error());
									if($row = mysql_fetch_array($sqlresult))     {
		    						do {
			   							$philhealthFrom=$row['philhealthFrom'];
			   							$philhealthTo=$row['philhealthTo'];
										$philSalaryBase=$row['philSalaryBase'];
									
										if (($actualSal > $philhealthFrom) && ($actualSal < $philhealthTo)) 
										{
											$salBase = $philSalaryBase;
											$monthlyCon = ($salBase / 100) * 2.5;
											$this->philHealth = $monthlyCon / 2;	
											return round($this->philHealth,2);
							    		}
										} 
									while($row=mysql_fetch_array($sqlresult)); }
								}
								else {
									$this->philHealth = 0;	
									return $this->philHealth;
								}
							
		case "itw"		:	if ($chkDeduct == 'Y') 
							{
		
							$nonTax = $this->lifeRetshare + $this->pagIbigshare + $this->philHealth;
							 		
							$result = "SELECT * FROM tblTaxExempt WHERE taxStatus = '$taxCode'";
							$sqlresult = mysql_query($result) or die (mysql_error());
							if($row = mysql_fetch_array($sqlresult))     {
		    					do {
			   						$taxStatus=$row['taxStatus'];
			   						$exemptionAmount=$row['exemptAmount'];

									if (($taxCode == "Single") or ($taxCode == "SINGLE"))
										{
											$taxExempt = $exemptionAmount;								
										} 
										elseif (($taxCode == "Head") or ($taxCode == "HEAD"))
										{ 
											$taxExempt = $exemptionAmount + ($dependents * 8000);
										}
										elseif (($taxCode == "Married") or ($taxCode == "MARRIED"))
										{
											$taxExempt = $exemptionAmount + ($dependents * 8000);			
										}	
									} 
									
								while($row=mysql_fetch_array($sqlresult)); }
								
							if ($healthProvider == 'Y')
							{	$taxExemptAll = $taxExempt + 2400;
								
							}
							else {	$taxExemptAll = $taxExempt; }	
									
							$result1 = "SELECT * FROM tblTaxRange";
							$sqlresult1 = mysql_query($result1) or die (mysql_error());
								if($row1 = mysql_fetch_array($sqlresult1))     {
									
									$taxable = (($actualSal - $nonTax)*12) - $taxExemptAll;
									
										
		    					do {
			   						$taxBase=$row1['taxBase'];
			   						$taxDeduct=$row1['taxDeduct'];
									$taxFactor=$row1['taxFactor'];
			   						$taxableFrom=$row1['taxableFrom'];
			   						$taxableTo=$row1['taxableTo']; 
									
									 //$taxable = (($actualSal - $nonTax) * 12) - $taxExempt;
									 
									 	if (($taxable > $taxableFrom) && ($taxable <= $taxableTo)) 
										{   	
											
											$taxDue = ($taxDeduct + (($taxable - $taxBase) * $taxFactor));
											
											$this->itw = $taxDue / 12;
											return round($this->itw,2);
											
																					 
									 	} 
													
									} 	
								while($row1=mysql_fetch_array($sqlresult1)); }
								
							}
							else {
								$this->itw = 0;
								return $this->itw;
								
							}
							
							
		 /* case "itw1"		:	if ($chkDeduct == 'Y') 
							{
		
							 $actualS = $actualSal * ($cboMonth - 1);
							 $estimateS = $actualSal * (13 - $cboMonth);
							 $nonTax = $this->lifeRet + $this->pagIbig + $this->philHealth;
							 $actualN = $nonTax * ($cbomonth - 1);
							 $estimateN = $nonTax * (13 - $cboMonth);
							 $annualIncome = $actualS + $estimateS;
							 $annualNonTax = $actualN + $estimateN;
							 		
							$result = "SELECT * FROM tblTaxExempt WHERE taxStatus = '$taxCode'";
							$sqlresult = mysql_query($result) or die (mysql_error());
							if($row = mysql_fetch_array($sqlresult))     {
		    					do {
			   						$taxStatus=$row['taxStatus'];
			   						$exemptionAmount=$row['exemptAmount'];

									if ($taxCode == "Single")
										{
											$taxExempt = $exemptionAmount;								
										} 
										elseif ($taxCode == "Head")
										{ 
											$taxExempt = $exemptionAmount + ($dependents * 8000);
										}
										elseif ($taxCode == "Married")
										{
											$taxExempt = $exemptionAmount + ($dependents * 8000);			
										}	
									} 
									
								while($row=mysql_fetch_array($sqlresult)); }
									
							$result1 = "SELECT * FROM tblTaxRange";
							$sqlresult1 = mysql_query($result1) or die (mysql_error());
								if($row1 = mysql_fetch_array($sqlresult1))     {
									$taxable = ($annualIncome - $annualNonTax) - $taxExempt;
									
		    					do {
			   						$taxBase=$row1['taxBase'];
			   						$taxDeduction=$row1['taxDeduct'];
									$taxFactor=$row1['taxFactor'];
			   						$taxableFrom=$row1['taxableFrom'];
			   						$taxableTo=$row1['taxableTo']; 
																				  
									 //$taxable = (($actualSal - $nonTax) * 12) - $taxExempt;
									 	if (($taxable > $taxableFrom) && ($taxable <= $taxableTo)) 
										{   	
											$taxDue = ($taxDeduction + (($taxable - $taxBase) * $taxFactor));
											
											$this->itw = $taxDue / (13 - $cboMonth);
											return round($this->itw,2);
																				 
									 	}
													
									}	
								while($row1=mysql_fetch_array($sqlresult1)); }
							}
							else {
								$this->itw = 0;
								return $this->itw;
								
							} */
								
						  
	 	default			: break;		
	 
	 }
	 
	}
	
	function viewInfo($empNumber)
	{
			
		$result = "Select pe.residentialAddress AS city, pe.empNumber, pe.surname, pe.firstname, pe.middlename,
				   pe.birthday, pe.tin, pe.gsisNumber, pe.philHealthNumber, pe.pagibigNumber, po.oplNo1, po.oplNo2, po.oplNo3, po.statusOfAppointment,
				   po.actualSalary, po.divisionCode, po.positionCode, po.appointmentCode, po.serviceCode, po.taxStatCode, po.dependents, po.hpFactor, po.longevityDate, po.mcSwitch, po.payrollSwitch,
				   po.hazardSwitch, po.longevitySwitch, po.pagibigSwitch, po.philhealthSwitch, po.itwSwitch, po.lifeRetSwitch, po.healthProvider, pd.projectCode		 
				   From tblEmpPersonal pe
				   LEFT JOIN tblEmpPosition po
				   ON pe.empNumber = po.empNumber
				   INNER JOIN tblDivision pd
				   ON po.divisionCode = pd.divisionCode
				   Where pe.empNumber = '$empNumber'
				   Order by pe.surname";
	    
		$sqlresult = mysql_query($result) or die (mysql_error());
		$ssqlnum = mysql_num_rows($sqlresult);
	
		while ($info = mysql_fetch_array($sqlresult)) {
			return $info;
		}
	
	}
	
	function getDeduction($empNumber)
	 {
	 $result = mysql_query("SELECT deductionCode, deductAmount FROM tblEmpDeduction	WHERE empNumber='$empNumber'");
	 	if($row = mysql_fetch_array($result))     {
		    	do {
			   		$deductionCode=$row['deductionCode'];
			   		$this->strDeduct=$row['deductAmount'];
				
						echo "<tr>";
						echo "<td width='50%' class='paragraph'>$deductionCode</td>";
						echo"<td width='50%'><input name='amortization' type='text' class='tbtext' readonly value=$this->strDeduct></td>";			
						echo "</tr>";
						
					} 		
				while($row=mysql_fetch_array($result)); }
				
	 }
	 
	function sumDeduction($empNumber)
	{
		$result1 = mysql_query("SELECT SUM(deductAmount) as total FROM tblEmpDeduction	WHERE empNumber='$empNumber'");
	 	if($row1 = mysql_fetch_array($result1))     {
		    	do {
			 
			   		$this->sumDeduction=$row1['total'];
					
					} 		
				while($row1=mysql_fetch_array($result1)); }
				return $this->sumDeduction;
				

	}
	
	function computeTotalDeduction($deductionTotal)
	{
		$deductionTotal = $this->lifeRet+ $this->pagIbig + $this->philHealth + $this->sumDeduction;
		return round($deductionTotal,2);
	
	}
	
	function computePayroll($actualSal, $deductionTotal)
	{
		$perDay = $actualSal / $workingDays;
		$getAbs = $perDay * $undLatedays;
		$netPay = ($actualSal - ($deductionTotal + $getAbs));
		return $netPay;
	
	}
	
	/*function getDeduction($empNumber, $deductCode)
	 {
	     $result = mysql_query("SELECT deductionCode, amortization FROM tblEmpDeduction WHERE empNumber='$empNumber' and deductionCode='$deductCode'");
			if($row = mysql_fetch_array($result))     {
		    	do {
			   		$deductionCode=$row['deductionCode'];
			   		$amortization=$row['amortization'];
										
						return $amortization;
					
					}	
				while($row1=mysql_fetch_array($result)); }
	} */
	
	 
	function comboEmpList($strEmpList, $strEmpNumber)
	{
		$objEmpList = mysql_query("SELECT concat(pe.surname,' , ',pe.firstname) as fullname, pe.empNumber, po.statusOfAppointment 
				  From tblEmpPersonal pe
				  LEFT JOIN tblEmpPosition po
				  ON pe.empNumber = po.empNumber
				  Where po.statusOfAppointment = 'In-Service'
				  ORDER BY pe.surname");
		
		while($row= mysql_fetch_array($objEmpList))
		{
			$strEmpNumber = $row["empNumber"];
			$strEmpList = $row["fullname"];
			echo "<option value='$strEmpNumber'>$strEmpList</option>";
			
		}
		
	}
	
	function comboDeductCode($strDeductCode, $strComboDeduct)
	{
		$objDeductCode = mysql_query("SELECT deductionCode, deductionDesc FROM tblDeduction WHERE deductionType = 'premium' or deductionType = 'loan'");
		
		while($row= mysql_fetch_array($objDeductCode))
		{
			$strDeductCode = $row["deductionCode"];
			$strDeductDesc = $row["deductionDesc"];
			echo "<option value='$strDeductCode'>$strDeductDesc</option>";
			
		}
		
	}
	
	function comboContributeCode($strContributeCode, $strContributeDesc)
	{
		$objDeductCode = mysql_query("SELECT deductionCode, deductionDesc FROM tblDeduction WHERE deductionType = 'others'");
		
		while($row= mysql_fetch_array($objDeductCode))
		{
			$strContributeCode = $row["deductionCode"];
			$strContributeDesc = $row["deductionDesc"];
			echo "<option value='$strContributeCode'>$strContributeDesc</option>";
			
		}
		
	}
	
	function updateRecords($strEmpNmbr, $sysRecords, $Submit, $sysList, $empNumber, $empList, $cboMonth, $cboYear, $deductionCode, $contributeCode, $orNo, $orDate, $orNo2, $orDate2, $la, $subsistence, $hp, $longevity, $hpFactor, $workDays, $daysAbsent, $holidays, $yearService, $hazardSwitch, $longevitySwitch, $payrollSwitch, $statusOfAppointment, $itwSwitch, $philhealthSwitch, $pagibigSwitch, $lifeRetSwitch, $strDeduct, $chkDeduct, $i, $deductAmount, $itwAmount, $philAmount, $pagibigAmount, $lifeAmount, $pagibigAmountS, $lifeAmountS, $wopay, $maternity, $study, $t_blnLeaveEntitled, $longevityDate)
		{
			
			switch ($sysRecords) 
			{
			
			case "remittance"	: $result = "SELECT * FROM tblEmpDeduction WHERE deductionCode='$deductionCode'";
								  $sqlresult = mysql_query($result) or die (mysql_error());
								  if($row = mysql_fetch_array($sqlresult))     {
		    						do {
										$empNumber=$row['empNumber'];		
			   							$deductionCode=$row['deductionCode'];				
										$deductAmount=$row['deductAmount'];															
											
										if ($sysList == "allEmp") {
											$results = "UPDATE tblEmpDeductRemit SET empNumber='$empNumber', deductionCode='$deductionCode', deductAmount='$deductAmount', deductMonth='$cboMonth', deductYear='$cboYear', orNumber='$orNo', orDate='$orDate' 
														WHERE empNumber='$empNumber' and deductionCode='$deductionCode' and deductMonth='$cboMonth' and deductYear='$cboYear'";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											}
										elseif (($sysList == "oneEmp") && ($empNumber == $empList)) {
											$results = "UPDATE tblEmpDeductRemit SET empNumber='$empList', deductionCode='$deductionCode', deductAmount='$deductAmount', deductMonth='$cboMonth', deductYear='$cboYear', orNumber='$orNo', orDate='$orDate' 
														WHERE empNumber='$empList' and deductionCode='$deductionCode' and deductMonth='$cboMonth' and deductYear='$cboYear'";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											} 
										
										} 
										while($row=mysql_fetch_array($sqlresult)); }
										
			case "ashare"	: 	$result = "SELECT * FROM tblEmpAgencyShare WHERE deductionCode='$contributeCode'";
								$sqlresult = mysql_query($result) or die (mysql_error());
								  if($row = mysql_fetch_array($sqlresult))     {
		    						do {
										$empNumber=$row['empNumber'];
										$contributeCode = $row['deductionCode'];
										$shareAmount = $row['shareAmount'];		
			   
										if ($sysList == "allEmp") {
											$results = "UPDATE tblEmpAgencyShare SET empNumber='$empNumber', deductionCode='$contributeCode', shareAmount='$shareAmount', deductMonth='$cboMonth', deductYear='$cboYear', orNumber='$orNo2', orDate='$orDate2' 
														WHERE empNumber='$empNumber' and deductionCode='$contributeCode' and deductMonth='$cboMonth' and deductYear='$cboYear'";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											}
										elseif (($sysList == "oneEmp") && ($empNumber == $empList)) {
											$results = "UPDATE tblEmpAgencyShare SET empNumber='$empList', deductionCode='$contributeCode', shareAmount='$shareAmount', deductMonth='$cboMonth', deductYear='$cboYear', orNumber='$orNo2', orDate='$orDate2' 
														WHERE empNumber='$empList' and deductionCode='$contributeCode' and deductMonth='$cboMonth' and deductYear='$cboYear'";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											} 
										
										} 
										while($row=mysql_fetch_array($sqlresult)); }
								
			case "subsistence"	:	$result = "SELECT empNumber, mcSwitch, actualSalary FROM tblEmpPosition Where mcSwitch='Y'";
								  	$sqlresult = mysql_query($result) or die (mysql_error());
								  	if($row = mysql_fetch_array($sqlresult))     {
		    							do {
											$empNumber=$row['empNumber'];		
			   								$mcSwitch=$row['mcSwitch'];
											$actualSalary=$row['actualSalary'];
											
											$la = $this->computeIncome($actualSalary,"laundryAllow", $hpFactor, $workDays, $daysAbsent, $holidays, $yearService, 	$mcSwitch);
											$subsistence = $this->computeIncome($actualSalary,"subsistence", $hpFactor, $workDays, $daysAbsent, $holidays, $yearService, $mcSwitch);				
										
										if ($mcSwitch == 'Y') {
											$incomeAmount = $subsistence;
										} else {  $incomeAmount = '0'; }
										
										if ($sysList == "allEmp") {
										
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empNumber' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and incomeCode='SA'";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 			{  echo "<center><b><br>Subsistence has already been updated for this month</b></center><br> "; break;
											} else {
											
											$incomeCode = 'SA';
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											
											$results1 = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empNumber', 'LA', '$la', '$cboMonth', '$cboYear')";
											mysql_query($results1) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
										}}
										elseif ($sysList == "oneEMP") {
										
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empList' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and incomeCode='SA'";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 			{  echo "<center><b><br>Subsistence has already been updated for this month</b></center><br> "; break;
											} else {
										
											$incomeCode = 'SA';
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empList', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											$results1 = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empList', 'LA', '$la', '$cboMonth', '$cboYear')";
											mysql_query($results1) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											} 
										} }

									while($row=mysql_fetch_array($sqlresult)); }
									break;
									
			case "ta"	: $result = "SELECT * FROM tblIncomeDetails WHERE incomeCode='TA'";
						  $sqlresult = mysql_query($result) or die (mysql_error());
							if($row = mysql_fetch_array($sqlresult))     {
		    						do {
										$empNumber=$row['empNumber'];		
			   							$incomeCode=$row['incomeCode'];				
										$incomeAmount=$row['incomeAmount'];
										if ($sysList == "allEmp") {
											
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											}
										elseif (($sysList == "oneEmp") && ($empNumber == $empList)){
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empList', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
										
											} 
										} 
									
									while($row=mysql_fetch_array($sqlresult)); }
									break;
									
			case "pera"	: $result = "SELECT * FROM tblIncomeDetails WHERE incomeCode='PERA' or incomeCode='AC'";
						  $sqlresult = mysql_query($result) or die (mysql_error());
							if($row = mysql_fetch_array($sqlresult))     {
		    						do {
										$empNumber=$row['empNumber'];		
			   							$incomeCode=$row['incomeCode'];				
										$incomeAmount=$row['incomeAmount'];
										
										if ($sysList == "allEmp") {
										
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empNumber' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and (incomeCode='PERA' or incomeCode='AC')";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 			{  echo "<center><b><br>PERA with AC has already been updated for this month</b></center><br> "; break;
											} else {
										
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											}
											}
										elseif (($sysList == "oneEmp") && ($empNumber == $empList)) {
										
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empList' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and (incomeCode='PERA' or incomeCode='AC')";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 			{  echo "<center><b><br>PERA with AC has already been updated for this month</b></center><br> "; break;
											} else {
										
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empList', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											} 
										} }
									
									while($row=mysql_fetch_array($sqlresult)); }
									break;
									
			case "citra"	: $result = "SELECT * FROM tblIncomeDetails WHERE incomeCode='RRA' or incomeCode='RTA'";
						  	  $sqlresult = mysql_query($result) or die (mysql_error());
							if($row = mysql_fetch_array($sqlresult))     {
		    						do {
										$empNumber=$row['empNumber'];		
			   							$incomeCode=$row['incomeCode'];				
										$incomeAmount=$row['incomeAmount'];
										
										if ($sysList == "allEmp") {
										
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empNumber' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and (incomeCode='RRA' or incomeCode='RTA')";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 			{  echo "<center><b><br>CITRA has already been updated for this month</b></center><br> "; break;
											} else {
										
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											}}
										elseif (($sysList == "oneEmp") && ($empNumber == $empList)) {
											
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empList' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and (incomeCode='RRA' or incomeCode='RTA')";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 			{  echo "<center><b><br>CITRA has already been updated for this month</b></center><br> "; break;
											} else {
											
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empList', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											} 
										} }
									
									while($row=mysql_fetch_array($sqlresult)); }
									break;
									
			case "hazardPay"	:	$result = "SELECT empNumber, hazardSwitch, hpFactor, actualSalary FROM tblEmpPosition Where hazardSwitch='Y'";
								  	$sqlresult = mysql_query($result) or die (mysql_error());
								  	if($row = mysql_fetch_array($sqlresult))     {
		    							do {
											$empNumber=$row['empNumber'];		
			   								$hazardSwitch=$row['hazardSwitch'];
											$hpFactor=$row['hpFactor'];
											$actualSalary=$row['actualSalary'];
											$hp = $this->computeIncome($actualSalary, "hazardPay", $hpFactor, $workDays, $daysAbsent, $holidays, $yearService, $hazardSwitch);				
										if (($hazardSwitch == 'Y') && ($hpFactor > 0)) {
											$incomeAmount = $hp;
										} else {  $incomeAmount = '0'; }
										
										if ($sysList == "allEmp") {
										
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empNumber' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and incomeCode='HP'";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 			{  echo "<center><b><br>Hazard Pay has already been updated for this month</b></center><br> "; break;
											} else {
											
											$incomeCode = 'HP';
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
										}}
										elseif (($sysList == "oneEmp") && ($empNumber == $empList)) {
										
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empList' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and incomeCode='HP'";							   
											$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 			{  echo "<center><b><br>Hazard Pay has already been updated for this month</b></center><br> "; break;
											} else {
										
											$incomeCode = 'HP';
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empList', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											} 
										} }

									while($row=mysql_fetch_array($sqlresult)); }
									break;
									
			case "longevityPay"	:	$result = "SELECT empNumber, longevitySwitch, actualSalary, longevityDate FROM tblEmpPosition Where longevitySwitch='Y'";
								  	$sqlresult = mysql_query($result) or die (mysql_error());
								  	if($row = mysql_fetch_array($sqlresult))     {
		    							do {
											$empNumber=$row['empNumber'];		
			   								$longevitySwitch=$row['longevitySwitch'];
											$actualSalary=$row['actualSalary'];
											$longevityDate=$row['longevityDate'];
											if ($longevityDate == '0000-00-00') { $yearService = 0; }
											else {
											$currentdate = date ("Y m", mktime(0,0,0,date("m") ,date("d") ,date("Y")));
											$lastmonth = date ("m", mktime(0,0,0,date("m")-1 ,date("d") ,date("Y")));
											$yearService = $currentdate - $longevityDate; 
											}				
											$longevity = $this->computeIncome($actualSalary, "longevityAllow", $hpFactor, $workDays, $daysAbsent, $holidays, $yearService, $longevitySwitch);
											
										if ($longevitySwitch == 'Y') {
											$incomeAmount = $longevity;
										} else {  $incomeAmount = '0'; }
										
										if ($sysList == "allEmp") {
										
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empNumber' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and incomeCode='LOA'";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 			{  echo "<center><b><br>Longevity Pay has already been updated for this month</b></center><br> "; break;
											} else {
											
											$incomeCode = 'LOA';
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
										} }
										elseif (($sysList == "oneEmp") && ($empNumber == $empList)) {
										
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empList' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and incomeCode='LOA'";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 			{  echo "<center><b><br>Longevity Pay has already been updated for this month</b></center><br> "; break;
											} else {
										
											$incomeCode = 'LOA';
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empList', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";	
											} 
										} }

									while($row=mysql_fetch_array($sqlresult)); }
									break;
									
			case "payrollAC" :	 $result = "SELECT empNumber, actualSalary, taxStatCode, dependents, payrollSwitch, itwSwitch, philhealthSwitch, pagibigSwitch, lifeRetSwitch, statusOfAppointment
										   From tblEmpPosition Where payrollSwitch='Y' and statusOfAppointment='In-Service'";
								 $sqlresult = mysql_query($result) or die (mysql_error());
								  	if($row = mysql_fetch_array($sqlresult))     {
		    							do {
											$empNumber=$row['empNumber'];		
											$actualSalary=$row['actualSalary'];
											$payrollSwitch=$row['payrollSwitch'];
											$statusOfAppointment=$row['statusOfAppointment'];
											$itwSwitch = $row['itwSwitch'];
											$taxCode = $row['taxStatCode'];
											$dependents = $row['dependents'];
											$philhealthSwitch = $row['philhealthSwitch'];
											$pagibigSwitch = $row['pagibigSwitch'];
											$lifeRetSwitch = $row['lifeRetSwitch'];
											$itwAmount = $this->viewITW($empNumber, $strDeduct1);
											$philAmount = $this->computeDeduction($empNumber, $actualSalary,"philHealth",$taxCode,$dependents, $philhealthSwitch, $cboMonth, $healthProvider);
											$pagibigAmount = $this->computeDeduction($empNumber, $actualSalary,"pagIbig",$taxCode,$dependents, $pagibigSwitch, $cboMonth, $healthProvider);
											$lifeAmount = $this->computeDeduction($empNumber, $actualSalary,"lifeRet",$taxCode,$dependents, $lifeRetSwitch, $cboMonth, $healthProvider);
											$pagibigAmountS = $this->computeDeduction($empNumber, $actualSalary,"pagIbigshare",$taxCode,$dependents, $pagibigSwitch, $cboMonth, $healthProvider);
											$lifeAmountS = $this->computeDeduction($empNumber, $actualSalary,"lifeRetshare",$taxCode,$dependents, $lifeRetSwitch, $cboMonth, $healthProvider);				
											$wopay = $this->getWoPay($empNumber, $t_blnLeaveEntitled, $cboMonth, $cboYear);
											$maternity = $this->getPayrollLeave($empNumber, $cboMonth, $cboYear, "ML");
											$study = $this->getPayrollLeave($empNumber, $cboMonth, $cboYear, "STL");
										/*if ($payrollSwitch == 'Y') {
											$incomeAmount = $actualSalary;
											
										} else {  $incomeAmount = '0'; $deductAmount = '0'; } */
										
										if (($sysList == "allEmp") && ($wopay == '0') && ($maternity == '0') && ($study == '0')) {
										
										$searchresultsAC = "SELECT * FROM tblEmpIncome WHERE empNumber='$empNumber' and incomeCode='PERA' and incomeMonth='$cboMonth' and incomeYear='$cboYear'";							   
		    			    			$searchResultsAC = mysql_query($searchresultsAC) or die (mysql_error());
											if($rowAC = mysql_fetch_array($searchResultsAC))
												{
													$resultAC = "SELECT * From tblIncomeDetails WHERE empNumber='$empNumber' and (incomeCode='PERA' or incomeCode='AC')";
									  				$sqlresultAC = mysql_query($resultAC) or die (mysql_error());
								  						if(!$rowP = mysql_fetch_array($sqlresultAC))     {
		    											do {
															$empNumber=$rowP['empNumber'];		
															$incomeCode=$rowP['incomeCode'];
															$incomeAmount=$rowP['incomeAmount'];
											
															$resultsPERA = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														 				 VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
															mysql_query($resultsPERA) or die (mysql_error());
															echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";
											
															} 
											
														while($rowP=mysql_fetch_array($sqlresultAC));  } 
												
												}
											else {
										
										 		$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empNumber' and incomeMonth='$cboMonth' and incomeYear='$cboYear'";							   
		    			    			  		$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  		if($row = mysql_fetch_array($searchResults)) 
								 					{  echo "<center><b><br>Payroll has already been updated for this month</b></center><br> "; break;
												} else {
											
													$incomeCode = 'MS';
													$incomeAmount = $actualSalary;
													$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
																VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
													mysql_query($results) or die (mysql_error());
													
													$resultAC = "SELECT * From tblIncomeDetails WHERE empNumber='$empNumber' and (incomeCode='PERA' or incomeCode='AC')";
									  				$sqlresultAC = mysql_query($resultAC) or die (mysql_error());
								  						if($rowP = mysql_fetch_array($sqlresultAC))     {
		    											do {
															$empNumber=$rowP['empNumber'];		
															$incomeCode=$rowP['incomeCode'];
															$incomeAmount=$rowP['incomeAmount'];
											
															$resultsPERA = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														 				 VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
															mysql_query($resultsPERA) or die (mysql_error());
															echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";
											
															} 
											
														while($rowP=mysql_fetch_array($sqlresultAC));  } 									
											
													$result2 = "SELECT empNumber, deductionCode, deductAmount
										   			   			From tblEmpDeduction
													   			WHERE empNumber='$empNumber'";
								 					$sqlresult2 = mysql_query($result2) or die (mysql_error());
								  						if($row1 = mysql_fetch_array($sqlresult2))     {
		    											do {
															$empNumber=$row1['empNumber'];		
															$deductionCode=$row1['deductionCode'];
															$deductAmount=$row1['deductAmount'];
											
															$results1 = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 				 VALUES ('$empNumber', '$deductionCode', '$deductAmount', '$cboMonth', '$cboYear')";
															mysql_query($results1) or die (mysql_error());
															echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";
											
															} 
											
														while($row1=mysql_fetch_array($sqlresult2));  } 
												
											
														$deductAmount = $itwAmount;
														$ITWresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 			  VALUES ('$empNumber', 'ITW', '$deductAmount', '$cboMonth', '$cboYear')";
														mysql_query($ITWresult) or die (mysql_error());
											
														$Philresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 			   VALUES ('$empNumber', 'PHP', '$philAmount', '$cboMonth', '$cboYear')";
														mysql_query($Philresult) or die (mysql_error());
											
														$Pagibigresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 				  VALUES ('$empNumber', 'PAGIBIGP', '$pagibigAmount', '$cboMonth', '$cboYear')";
														mysql_query($Pagibigresult) or die (mysql_error());
											
														$Liferesult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 			   VALUES ('$empNumber', 'LR', '$lifeAmount', '$cboMonth', '$cboYear')";
														mysql_query($Liferesult) or die (mysql_error());
											
														$PhilresultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 				VALUES ('$empNumber', 'PHP', '$philAmount', '$cboMonth', '$cboYear')";
														mysql_query($PhilresultS) or die (mysql_error());
											
														$PagibigresultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 				   VALUES ('$empNumber', 'PAGIBIGP', '$pagibigAmountS', '$cboMonth', '$cboYear')";
														mysql_query($PagibigresultS) or die (mysql_error());
											
														$LiferesultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 			    VALUES ('$empNumber', 'LR', '$lifeAmountS', '$cboMonth', '$cboYear')";
														mysql_query($LiferesultS) or die (mysql_error());
											
											
													}
										} } 
										elseif (($sysList == "oneEmp") && ($empNumber == $empList) && ($wopay == '0') && ($maternity == '0') && ($study == '0')){
												
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empList' and incomeMonth='$cboMonth' and incomeYear='$cboYear'";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 					{  echo "<center><b><br>Payroll has already been updated for this month</b></center><br> "; break;
											} else {
											$incomeCode = 'MS';
											$incomeAmount = $actualSalary;
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empList', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											
											
											$result2 = "SELECT empNumber, deductionCode, deductAmount
										   			   From tblEmpDeduction
													   WHERE empNumber='$empList'";
								 			$sqlresult2 = mysql_query($result2) or die (mysql_error());
								  			if($row1 = mysql_fetch_array($sqlresult2))     {
		    									do {
													$empList = $row1['empNumber'];
													$deductionCode = $row1['deductionCode'];
													$deductAmount = $row1['deductAmount'];
												
											$results1 = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 VALUES ('$empList', '$deductionCode', '$deductAmount', '$cboMonth', '$cboYear')";
											mysql_query($results1) or die (mysql_error());		
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";
											
											} 
											
												while($row1=mysql_fetch_array($sqlresult2)); }
												
											$deductAmount = $itwAmount;
											$ITWresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'ITW', '$deductAmount', '$cboMonth', '$cboYear')";
											mysql_query($ITWresult) or die (mysql_error());
											
											$Philresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'PHP', '$philAmount', '$cboMonth', '$cboYear')";
											mysql_query($Philresult) or die (mysql_error());
											
											$Pagibigresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'PAGIBIGP', '$pagibigAmount', '$cboMonth', '$cboYear')";
											mysql_query($Pagibigresult) or die (mysql_error());
											
											$Liferesult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'LR', '$lifeAmount', '$cboMonth', '$cboYear')";
											mysql_query($Liferesult) or die (mysql_error());
											
											$PhilresultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'PHP', '$philAmount', '$cboMonth', '$cboYear')";
											mysql_query($PhilresultS) or die (mysql_error());
											
											$PagibigresultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'PAGIBIGP', '$pagibigAmountS', '$cboMonth', '$cboYear')";
											mysql_query($PagibigresultS) or die (mysql_error());
											
											$LiferesultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'LR', '$lifeAmountS', '$cboMonth', '$cboYear')";
											mysql_query($LiferesultS) or die (mysql_error());
										} 
									} }
									while($row=mysql_fetch_array($sqlresult)); }
									break;
									
			case "payroll"	:	$result = "SELECT empNumber, actualSalary, taxStatCode, dependents, payrollSwitch, itwSwitch, philhealthSwitch, pagibigSwitch, lifeRetSwitch, statusOfAppointment
										   From tblEmpPosition Where payrollSwitch='Y' and statusOfAppointment ='In-Service'" ;
								 $sqlresult = mysql_query($result) or die (mysql_error());
								  	if($row = mysql_fetch_array($sqlresult))     {
		    							do {
											$empNumber=$row['empNumber'];		
											$actualSalary=$row['actualSalary'];
											$payrollSwitch=$row['payrollSwitch'];
											$statusOfAppointment=$row['statusOfAppointment'];
											$itwSwitch = $row['itwSwitch'];
											$taxCode = $row['taxStatCode'];
											$dependents = $row['dependents'];
											$philhealthSwitch = $row['philhealthSwitch'];
											$pagibigSwitch = $row['pagibigSwitch'];
											$lifeRetSwitch = $row['lifeRetSwitch'];
											$itwAmount = $this->viewITW($empNumber, $strDeduct1);
											$philAmount = $this->computeDeduction($empNumber, $actualSalary,"philHealth",$taxCode,$dependents, $philhealthSwitch, $cboMonth, $healthProvider);
											$pagibigAmount = $this->computeDeduction($empNumber, $actualSalary,"pagIbig",$taxCode,$dependents, $pagibigSwitch, $cboMonth, $healthProvider);
											$lifeAmount = $this->computeDeduction($empNumber, $actualSalary,"lifeRet",$taxCode,$dependents, $lifeRetSwitch, $cboMonth, $healthProvider);
											$pagibigAmountS = $this->computeDeduction($empNumber, $actualSalary,"pagIbigshare",$taxCode,$dependents, $pagibigSwitch, $cboMonth, $healthProvider);
											$lifeAmountS = $this->computeDeduction($empNumber, $actualSalary,"lifeRetshare",$taxCode,$dependents, $lifeRetSwitch, $cboMonth, $healthProvider);
											$wopay = $this->getWoPay($empNumber, $t_blnLeaveEntitled, $cboMonth, $cboYear);
											$maternity = $this->getPayrollLeave($empNumber, $cboMonth, $cboYear, "ML");
											$study = $this->getPayrollLeave($empNumber, $cboMonth, $cboYear, "STL");
										/*if ($payrollSwitch == 'Y') {
											$incomeAmount = $actualSalary;
											
										} else {  $incomeAmount = '0'; $deductAmount = '0'; } */
										
										if (($sysList == "allEmp") && ($wopay == '0') && ($maternity == '0') && ($study == '0')) {
										
										$searchresultsAC = "SELECT * FROM tblEmpIncome WHERE incomeCode='PERA' and incomeMonth='$cboMonth' and incomeYear='$cboYear'";							   
		    			    			$searchResultsAC = mysql_query($searchresultsAC) or die (mysql_error());
											if($rowAC = mysql_fetch_array($searchResultsAC))
												{
												$deleteAC = "DELETE FROM tblEmpIncome WHERE empNumber='$empNumber' and incomeCode='AC' and incomeCode='PERA'";  
	      										$del = mysql_query($deleteAC);
												}
											else {
											
										
										 		$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empNumber' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and (incomeCode!='PERA' or incomeCode!='AC')";							   
		    			    			  		$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  		if($row = mysql_fetch_array($searchResults)) 
								 					{  echo "<center><b><br>Payroll has already been updated for this month</b></center><br> "; break;
												} else {
											
													$incomeCode = 'MS';
													$incomeAmount = $actualSalary;
													$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
																VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
													mysql_query($results) or die (mysql_error());									
											
													$result2 = "SELECT empNumber, deductionCode, deductAmount
										   			   			From tblEmpDeduction
													   			WHERE empNumber='$empNumber'";
								 					$sqlresult2 = mysql_query($result2) or die (mysql_error());
								  						if($row1 = mysql_fetch_array($sqlresult2))     {
		    											do {
															$empNumber=$row1['empNumber'];		
															$deductionCode=$row1['deductionCode'];
															$deductAmount=$row1['deductAmount'];
											
															$results1 = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 				 VALUES ('$empNumber', '$deductionCode', '$deductAmount', '$cboMonth', '$cboYear')";
															mysql_query($results1) or die (mysql_error());
															echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";
											
															} 
											
														while($row1=mysql_fetch_array($sqlresult2));  } 
												
											
														$deductAmount = $itwAmount;
														$ITWresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 			  VALUES ('$empNumber', 'ITW', '$deductAmount', '$cboMonth', '$cboYear')";
														mysql_query($ITWresult) or die (mysql_error());
											
														$Philresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 			   VALUES ('$empNumber', 'PHP', '$philAmount', '$cboMonth', '$cboYear')";
														mysql_query($Philresult) or die (mysql_error());
											
														$Pagibigresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 				  VALUES ('$empNumber', 'PAGIBIGP', '$pagibigAmount', '$cboMonth', '$cboYear')";
														mysql_query($Pagibigresult) or die (mysql_error());
											
														$Liferesult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 			   VALUES ('$empNumber', 'LR', '$lifeAmount', '$cboMonth', '$cboYear')";
														mysql_query($Liferesult) or die (mysql_error());
											
														$PhilresultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 				VALUES ('$empNumber', 'PHP', '$philAmount', '$cboMonth', '$cboYear')";
														mysql_query($PhilresultS) or die (mysql_error());
											
														$PagibigresultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 				   VALUES ('$empNumber', 'PAGIBIGP', '$pagibigAmountS', '$cboMonth', '$cboYear')";
														mysql_query($PagibigresultS) or die (mysql_error());
											
														$LiferesultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 			    VALUES ('$empNumber', 'LR', '$lifeAmountS', '$cboMonth', '$cboYear')";
														mysql_query($LiferesultS) or die (mysql_error());
											
											
													}
										} } 
										elseif (($sysList == "oneEmp") && ($empNumber == $empList) && ($wopay == '0') && ($maternity == '0') && ($study == '0')){
												
											$searchresults = "SELECT * FROM tblEmpIncome WHERE empNumber='$empList' and incomeMonth='$cboMonth' and incomeYear='$cboYear' and (incomeCode!='PERA' or incomeCode!='AC')";							   
		    			    			  	$searchResults = mysql_query($searchresults) or die (mysql_error());	
										  	if($row = mysql_fetch_array($searchResults)) 
								 				{  echo "<center><b><br>Payroll has already been updated for this month</b></center><br> "; break;
											} else {
											
											$incomeCode = 'MS';
											$incomeAmount = $actualSalary;
											$results = "INSERT INTO tblEmpIncome (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empList', '$incomeCode', '$incomeAmount', '$cboMonth', '$cboYear')";
											mysql_query($results) or die (mysql_error());
											
											
											$result2 = "SELECT empNumber, deductionCode, deductAmount
										   			   From tblEmpDeduction
													   WHERE empNumber='$empList'";
								 			$sqlresult2 = mysql_query($result2) or die (mysql_error());
								  			if($row1 = mysql_fetch_array($sqlresult2))     {
		    									do {
													$empList = $row1['empNumber'];
													$deductionCode = $row1['deductionCode'];
													$deductAmount = $row1['deductAmount'];
												
											$results1 = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 VALUES ('$empList', '$deductionCode', '$deductAmount', '$cboMonth', '$cboYear')";
											mysql_query($results1) or die (mysql_error());		
											echo "<meta http-equiv=\"refresh\" content=\"0; url=CSystemrecord.php?strEmpNmbr=$strEmpNmbr\">";
											
											} 
											
												while($row1=mysql_fetch_array($sqlresult2)); }
												
											$deductAmount = $itwAmount;
											$ITWresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'ITW', '$deductAmount', '$cboMonth', '$cboYear')";
											mysql_query($ITWresult) or die (mysql_error());
											
											$Philresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'PHP', '$philAmount', '$cboMonth', '$cboYear')";
											mysql_query($Philresult) or die (mysql_error());
											
											$Pagibigresult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'PAGIBIGP', '$pagibigAmount', '$cboMonth', '$cboYear')";
											mysql_query($Pagibigresult) or die (mysql_error());
											
											$Liferesult = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'LR', '$lifeAmount', '$cboMonth', '$cboYear')";
											mysql_query($Liferesult) or die (mysql_error());
											
											$PhilresultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'PHP', '$philAmount', '$cboMonth', '$cboYear')";
											mysql_query($PhilresultS) or die (mysql_error());
											
											$PagibigresultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'PAGIBIGP', '$pagibigAmountS', '$cboMonth', '$cboYear')";
											mysql_query($PagibigresultS) or die (mysql_error());
											
											$LiferesultS = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode, shareAmount, deductMonth, deductYear) 
														 VALUES ('$empList', 'LR', '$lifeAmountS', '$cboMonth', '$cboYear')";
											mysql_query($LiferesultS) or die (mysql_error());
										} 
									}}
									while($row=mysql_fetch_array($sqlresult)); }
									break;
									
										
			default				: break;
			
			} 
		}
		
	function computeITW($strEmpNmbr, $empNumber, $Submit, $strDeduct1, $p, $txtSearch, $strDeduct2, $t_strEmpNumber, $optField) //Add additional Income
   {
		
		switch ($Submit) { 
		
			case "Compute"	 :	$strDeduct1 = $this->itw;
								$searchresults = "SELECT * FROM tblNonTaxable WHERE empNumber='$empNumber'";							   
		    			    	$searchResults = mysql_query($searchresults) or die (mysql_error());	
								if($row = mysql_fetch_array($searchResults)) 
								 {
								 	$updateResults = "UPDATE tblNonTaxable SET empNumber='$empNumber', tax='$strDeduct1' WHERE empNumber='$empNumber'";
			 						$modifyResults = mysql_query($updateResults);
									echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeedeductions.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&t_strEmpNumber=$t_strEmpNumber&optField=$optField\">";
								    //echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeeincome.php?p=$p&txtSearch=$txtSearch\">";		
									if(!$modifyResults) { 
										echo "<b>Income not modify not modify:</b> ", mysql_error(); 
										exit; 			} 
			 						if($modifyResults)  { return 1; }
								break;		
								 }
								else {
									$results = "INSERT INTO tblNonTaxable (empNumber, tax) VALUES ('$empNumber','$strDeduct1')";
		 				   			mysql_query($results) or die (mysql_error());
									echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeedeductions.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&t_strEmpNumber=$t_strEmpNumber&optField=$optField\">";
						   			if(!$results) {
	     				   				echo "<b>Add Income not added:</b> ", mysql_error(); 
		    			   				exit; } 
						    		if($results) { return 1; }
								}			
							 	break;
				
			
			case "Submit"    :	$searchresults = "SELECT * FROM tblNonTaxable WHERE empNumber='$empNumber'";							   
		    			    	$searchResults = mysql_query($searchresults) or die (mysql_error());	
								if($row = mysql_fetch_array($searchResults)) 
								 {
								 	$updateResults = "UPDATE tblNonTaxable SET empNumber='$empNumber', tax='$strDeduct2' WHERE empNumber='$empNumber'";
			 						$modifyResults = mysql_query($updateResults);
									echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeedeductions.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&t_strEmpNumber=$t_strEmpNumber&optField=$optField\">";
								 //echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeeincome.php?p=$p&txtSearch=$txtSearch\">";	
								 	if(!$modifyResults) { 
										echo "<b>Tax not modify not modify:</b> ", mysql_error(); 
										exit; 			} 
			 						if($modifyResults)  { return 1; }
								break;		
								 }
								else {
									$results = "INSERT INTO tblNonTaxable (empNumber, tax) VALUES ('$empNumber','$strDeduct2')";
		 				   			mysql_query($results) or die (mysql_error());
									echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeedeductions.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&t_strEmpNumber=$t_strEmpNumber&optField=$optField\">";
						   			if(!$results) {
	     				   				echo "<b>Tax not added:</b> ", mysql_error(); 
		    			   				exit; } 
						    		if($results) { return 1; }
								}			
							 	break;			
						   
			case "SET"   :		$editresults = "SELECT * FROM tblNonTaxable WHERE empNumber='$empNumber'";							   
		    			    	$editResults = mysql_query($editresults) or die (mysql_error());
						  		if(!$row = mysql_fetch_array($editResults)) 
								 {
								 echo " ";
								 }
								else { 			
								$delete = "DELETE FROM tblNonTaxable WHERE empNumber='$empNumber'";  
	      						$del = mysql_query($delete); 
								echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeedeductions.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch\">";
								}
								//$setbtn = "Submit";
						   		break;
								
			
								
			default       : break;				
			}
	}
	
	function viewITW($empNumber, $strDeduct1)
	{
		 $viewResults = mysql_query("SELECT tax FROM tblNonTaxable WHERE empNumber='$empNumber'");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo " ";
		 }
		 else
		 {
			$strDeduct1=$row['tax'];
			return $strDeduct1;
		 }	
	}

}		
?>