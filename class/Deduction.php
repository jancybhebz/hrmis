<?
/* 
File Name: Deduction.php
----------------------------------------------------------------------
Purpose of this file: 
Class Deduction
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: JDG
----------------------------------------------------------------------
Date of Revision: October 23, 2003
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
class Deduction extends General
{
var $sumLoan;
var $loanBalance;
var $balance;
var $deductCode;


		
	function Deduction()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection
	}
	
	
	function comboDeductCode($strDeductCode, $strComboDeduct)
	{
		$objDeductCode = mysql_query("SELECT deductionCode, deductionDesc FROM tblDeduction WHERE deductionType = 'premium' or deductionType = 'loan' or deductionType = 'contribution'");
		
		while($row= mysql_fetch_array($objDeductCode))
		{
			$strDeductCode = $row["deductionCode"];
			$strDeductDesc = $row["deductionDesc"];
			echo "<option value='$strDeductCode'>$strDeductDesc</option>";
			
		}
		
	}
	
	function addDeduction($strEmpNmbr, $empNumber, $deductionCode, $voucherNmbr, $voucherDate, $amountGranted, $dateGranted, $amortization, $actualStartDate, $actualEndDate, $Submit2, $p, $txtSearch, $optField) //Add deduction
   {
		
		switch ($Submit2) { 
			case "ADD"    :	$searchresults = "SELECT * FROM tblEmpDeduction WHERE empNumber='$empNumber' and deductionCode='$deductionCode'";							   
		    			   	$searchResults = mysql_query($searchresults) or die (mysql_error());
						  	if($row = mysql_fetch_array($searchResults)) 
								 {
								 //echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeeincome.php?p=$p&txtSearch=$txtSearch\">";	
								 echo "<center><span class=\"warning\">Deduction already exist</span></center><br> ";
								 }		
							else {
								$results = "INSERT INTO tblEmpDeduction (empNumber, deductionCode, voucherNmbr, voucherDate, amountGranted, dateGranted, deductAmount, actualStartDate, actualEndDate) 
											VALUES ('$empNumber', '$deductionCode', '$voucherNmbr', '$voucherDate', '$amountGranted', '$dateGranted', '$amortization', '$actualStartDate', '$actualEndDate')";
		 				   		mysql_query($results) or die (mysql_error());
								echo "<meta http-equiv=\"refresh\" content=\"0; url=CLoans.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&optField=$optField\">";
						   		if(!$results) {
	     				   		echo "<b>Employee Deduction not added:</b> ", mysql_error(); 
		    			   		exit; } 
						    	if($results) { return 1; }
								}
						   	break;
						   
			case "Edit"   :	$editresults = "SELECT * FROM tblEmpDeduction WHERE empNumber='$empNumber' and deductionCode='$deductionCode'";							   
		    			    $editResults = mysql_query($editresults) or die (mysql_error());
						  	if($row = mysql_fetch_array($editResults))     {
		    					do {		
			   						$deductionCode=$row['deductionCode'];
			   						$voucherNmbr=$row['voucherNmbr'];
									$voucherDate=$row['voucherDate'];
									$amountGranted=$row['amountGranted'];															
									$dateGranted=$row['dateGranted'];
									$amortization=$row['deductAmount'];															
									$actualStartDate=$row['actualStartDate'];
									$actualEndDate=$row['actualEndDate'];
									} 
								while($row=mysql_fetch_array($editResults)); }
						   	break;
						   								
			case "Submit" :	$updateResults = "UPDATE tblEmpDeduction SET empNumber='$empNumber', deductionCode='$deductionCode', voucherNmbr='$voucherNmbr', 
											  voucherDate='$voucherDate', amountGranted='$amountGranted', dateGranted='$dateGranted', deductAmount='$amortization', actualStartDate='$actualStartDate', 
											  actualEndDate='$actualEndDate'
											  WHERE empNumber='$empNumber' and deductionCode='$deductionCode1'";
			 				$modifyResults = mysql_query($updateResults);
							
							if(!$modifyResults) { 
								echo "<b>Employee Deduction not modify:</b> ", mysql_error(); 
								exit; 			} 
			 				if($modifyResults)  { return 1; }
							break; 
							
			case "Delete":	return 1 ; break;
							
			case "OK" 	:	$delete = "DELETE FROM tblEmpDeduction WHERE empNumber='$empNumber' and deductionCode='$deductionCode'";  
	      					$del = mysql_query($delete);

							break;
			
			default       : break;				
			}
	}
	
	/*function sumLoan($strEmpNmbr, $empNumber, $p) 
	{ */
		/*$result1 = "SELECT ed.empNumber, ed.deductionCode, ed.amountGranted, SUM(er.deductAmount) as total, er.deductionCode, er.empNumber 
					FROM tblEmpDeductRemit er
					LEFT JOIN tblEmpDeduction ed
					ON ed.empNumber = er.empNumber and ed.deductionCode = er.deductionCode
					WHERE ed.empNumber='$empNumber'
					GROUP BY er.empNumber, er.deductAmount, er.deductionCode, ed.amountGranted"; */
	/*	$result1 = "SELECT * From tblEmpDeduction where empNumber='$empNumber'";
		$sqlresult = mysql_query($result1) or die (mysql_error());
	 	if($row1 = mysql_fetch_array($sqlresult))     {
			do {
			$empNumber = $row1['empNumber'];
			$deductionCode1 = $row1['deductionCode'];
			$amountGranted = $row1['amountGranted'];
			
			$result2 = "SELECT empNumber, deductionCode, SUM(deductAmount) as total 
						FROM tblEmpDeductRemit 
						WHERE empNumber='$empNumber' and deductionCode='$deductionCode1'
						GROUP BY empNumber, deductionCode, deductAmount";
			$sqlresult2 = mysql_query($result2) or die (mysql_error());
			if($row2 = mysql_fetch_array($sqlresult2))     {
		    	do {
					$this->deductCode = $row2['deductionCode'];								
			   		$this->sumLoan = $row2['total'];
					//echo $this->sumLoan . ";";									
					//$this->balance = $amountGranted - $this->sumLoan;
					//return $this->deductCode;
					//return $this->balance;
					} 		
				while($row2=mysql_fetch_array($sqlresult2)); }
			}	while($row1=mysql_fetch_array($sqlresult)); }
							
	} */ 
	
	/*function getBalance($strEmpNmbr, $empNumber, $p)
	{
		$result1 = mysql_query("SELECT empNumber, amountGranted, deductionCode FROM tblEmpDeduction WHERE empNumber='$empNumber'");
	 	if($row1 = mysql_fetch_array($result1))     {
		    	do {
			 
			   		$empNumber=$row['empNumber'];
					$amountGranted=$row['amountGranted'];
					$deductionCode=$row['deductionCode'];
					
					$this->loanBalance = ($amountGranted - $this->sumLoan);
					echo $this->loanBalance;
					} 		
				while($row1=mysql_fetch_array($result1)); }
				
				

	} */
	
	function viewDeduction($strEmpNmbr, $empNumber, $p, $txtSearch, $optField) // view employee deduction list
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpDeduction WHERE empNumber='$empNumber'");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo "Empty";
		 }
		 else
		 {
		 	$empNumber=$row['empNumber'];	
			$deductionCode=$row['deductionCode'];
			$voucherNmbr=$row['voucherNmbr'];
			$voucherDate=$row['voucherDate'];
			$amountGranted=$row['amountGranted'];															
			$dateGranted=$row['dateGranted'];
			$amortization=$row['deductAmount'];															
			$actualStartDate=$row['actualStartDate'];
			$actualEndDate=$row['actualEndDate'];
			//$LoanBalance = ($amountGranted - $this->sumLoan);
			
			//$LoanBalance = ($amountGranted - $this->sumLoan);
			//$LoanBalance = $this->balance;
	   
			 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"title\"><td width=\"10%\" height=\"18\" class=\"border\">Code</td>";
			 echo "<td width=\"10%\" class=\"border\">Voucher<br>No.</td>";
			 echo "<td width=\"10%\" class=\"border\">Voucher<br>Date</td>";
			 echo "<td width=\"11%\" class=\"border\">Amount<br>Granted</td>";
			 echo "<td width=\"10%\" class=\"border\">Date<br>Granted</td>";
			 echo "<td width=\"10%\" class=\"border\">Monthly Amortization</td>";
			 echo "<td width=\"10%\" class=\"border\">Start<br>Date</td>";
			 echo "<td width=\"10%\" class=\"border\">End<br>Date</td>";
			 echo "<td width=\"10%\" class=\"border\">Loan<br>Balance</td>";
			// echo "<td width=\"10%\" class=\"border\">&nbsp;</td>";
			 echo "<td width=\"9%\" class=\"border\">&nbsp;</td></tr>";
		 
		 do 
		 {
		 	$deductionCode=$row['deductionCode'];
			$voucherNmbr=$row['voucherNmbr'];
			$voucherDate=$row['voucherDate'];
			$amountGranted=$row['amountGranted'];															
			$dateGranted=$row['dateGranted'];
			$amortization=$row['deductAmount'];															
			$actualStartDate=$row['actualStartDate'];
			$actualEndDate=$row['actualEndDate'];
			$result2 = "SELECT empNumber, deductionCode, SUM(deductAmount) as total 
						FROM tblEmpDeductRemit 
						WHERE empNumber='$empNumber' and deductionCode='$deductionCode'
						GROUP BY empNumber, deductionCode, deductAmount";
			$sqlresult2 = mysql_query($result2) or die (mysql_error());
			if(!$row2 = mysql_fetch_array($sqlresult2))     {
				$LoanBalance = $amountGranted;
			} else {
		    	do {
					$this->deductCode = $row2['deductionCode'];								
			   		$this->sumLoan = $row2['total'];
					//echo $this->sumLoan . ";";									
					//$this->balance = $amountGranted - $this->sumLoan;
					//return $this->deductCode;
					//return $this->balance;
					$LoanBalance = ($amountGranted - $this->sumLoan);
					if ($LoanBalance =="0" || $LoanBalance < 0) {
					$delete = "DELETE FROM tblEmpDeduction WHERE empNumber='$empNumber' and deductionCode='$deductionCode'";  
	      			$del = mysql_query($delete); }
					 
					} 		
				while($row2=mysql_fetch_array($sqlresult2)); }
			
		
			//$LoanBalance = $this->balance;
			//echo "<tr><td width=\"35%\" class=\"border\">". $row['deductionCode'] ." ". $row['voucherNmbr'] ." " . $row['voucherDate'] . " " . $row['amountGranted'] . "</td>";
			//echo "<td width=\"40%\" class=\"border\">". $row['dateGranted'] ."  ". $row['amortization'] ." ". $row['actualStartDate'] ." ". $row['actualEndDate'] ."</td>";
			//echo "<td  class=\"border\">";
			//echo "<a href=\"CLoans.php?Submit2=Edit\">Edit</a></td>";
			echo "<tr class=\"border\"><td class=\"border\">" . $row['deductionCode'] . "</td>";
			echo "<td class=\"border\">" . $row['voucherNmbr'] . "</td>";
			echo "<td class=\"border\">" . $row['voucherDate'] . "</td>";
			echo "<td class=\"border\">" . $row['amountGranted'] . "</td>";
			echo "<td class=\"border\">" . $row['dateGranted'] . "</td>";
			echo "<td class=\"border\">" . $row['deductAmount'] . "</td>";
			echo "<td class=\"border\">" . $row['actualStartDate'] . "</td>";
			echo "<td class=\"border\">" . $row['actualEndDate'] . "</td>";
			echo "<td class=\"border\">" . $LoanBalance . "</td>";
			//echo "<td class=\"border\"><a href=\"CLoans.php?empNumber=$empNumber&deductionCode=$deductionCode&Submit2=Edit\"></a></td></td>";
			echo "<td class=\"border\"><a href=\"CLoans.php?strEmpNmbr=$strEmpNmbr&strLetter=$strLetter&empNumber=$empNumber&deductionCode=$deductionCode&Submit2=Delete&p=$p&txtSearch=$txtSearch&optField=$optField\">Delete</a></td></tr></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
			echo "</tr><tr class=\"border\"><td height=\"18\" class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td></tr></table>";
		} 
	
	} 	
	
	function viewDeduction1($empNumber) // view employee deduction list
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpDeduction WHERE empNumber='$empNumber'");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo "Empty";
		 }
		 else
		 {
		 	$empNumber=$row['empNumber'];	
			$deductionCode=$row['deductionCode'];
			$voucherNmbr=$row['voucherNmbr'];
			$voucherDate=$row['voucherDate'];
			$amountGranted=$row['amountGranted'];															
			$dateGranted=$row['dateGranted'];
			$amortization=$row['deductAmount'];															
			$actualStartDate=$row['actualStartDate'];
			$actualEndDate=$row['actualEndDate'];
	   
			 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"title\"><td width=\"10%\" height=\"18\" class=\"border\">Code</td>";
			 echo "<td width=\"10%\" class=\"border\">Voucher<br>No.</td>";
			 echo "<td width=\"10%\" class=\"border\">Voucher<br>Date</td>";
			 echo "<td width=\"11%\" class=\"border\">Amount<br>Granted</td>";
			 echo "<td width=\"10%\" class=\"border\">Date<br>Granted</td>";
			 echo "<td width=\"10%\" class=\"border\">Monthly Amortization</td>";
			 echo "<td width=\"10%\" class=\"border\">Start<br>Date</td>";
			 echo "<td width=\"10%\" class=\"border\">End<br>Date</td>";
			 echo "<td width=\"10%\" class=\"border\">Loan<br>Balance</td></tr>";
			// echo "<td width=\"10%\" class=\"border\">&nbsp;</td>";
			 //echo "<td width=\"9%\" class=\"border\">&nbsp;</td></tr>";
		 
		 do 
		 {
		 	$deductionCode=$row['deductionCode'];
			$voucherNmbr=$row['voucherNmbr'];
			$voucherDate=$row['voucherDate'];
			$amountGranted=$row['amountGranted'];															
			$dateGranted=$row['dateGranted'];
			$amortization=$row['deductAmount'];															
			$actualStartDate=$row['actualStartDate'];
			$actualEndDate=$row['actualEndDate'];
			$result2 = "SELECT empNumber, deductionCode, SUM(deductAmount) as total 
						FROM tblEmpDeductRemit 
						WHERE empNumber='$empNumber' and deductionCode='$deductionCode'
						GROUP BY empNumber, deductionCode, deductAmount";
			$sqlresult2 = mysql_query($result2) or die (mysql_error());
			if(!$row2 = mysql_fetch_array($sqlresult2))     {
				$LoanBalance = $amountGranted;
			} else {
		    	do {
					$this->deductCode = $row2['deductionCode'];								
			   		$this->sumLoan = $row2['total'];
					//echo $this->sumLoan . ";";									
					//$this->balance = $amountGranted - $this->sumLoan;
					//return $this->deductCode;
					//return $this->balance;
					$LoanBalance = ($amountGranted - $this->sumLoan);
					if ($LoanBalance == 0 || $LoanBalance < 0) {
					$delete = "DELETE FROM tblEmpDeduction WHERE empNumber='$empNumber' and deductionCode='$deductionCode'";  
	      			$del = mysql_query($delete); }
					 
					} 		
				while($row2=mysql_fetch_array($sqlresult2)); }
			//echo "<tr><td width=\"35%\" class=\"border\">". $row['deductionCode'] ." ". $row['voucherNmbr'] ." " . $row['voucherDate'] . " " . $row['amountGranted'] . "</td>";
			//echo "<td width=\"40%\" class=\"border\">". $row['dateGranted'] ."  ". $row['amortization'] ." ". $row['actualStartDate'] ." ". $row['actualEndDate'] ."</td>";
			//echo "<td  class=\"border\">";
			//echo "<a href=\"CLoans.php?Submit2=Edit\">Edit</a></td>";
			echo "<tr class=\"border\"><td class=\"border\">" . $row['deductionCode'] . "</td>";
			echo "<td class=\"border\">" . $row['voucherNmbr'] . "</td>";
			echo "<td class=\"border\">" . $row['voucherDate'] . "</td>";
			echo "<td class=\"border\">" . $row['amountGranted'] . "</td>";
			echo "<td class=\"border\">" . $row['dateGranted'] . "</td>";
			echo "<td class=\"border\">" . $row['deductAmount'] . "</td>";
			echo "<td class=\"border\">" . $row['actualStartDate'] . "</td>";
			echo "<td class=\"border\">" . $row['actualEndDate'] . "</td>";
			echo "<td class=\"border\">" . $LoanBalance . "</td>";
			//echo "<td class=\"border\"><a href=\"CLoans.php?empNumber=$empNumber&deductionCode=$deductionCode&Submit2=Edit\"></a></td></td>";
			//echo "<td class=\"border\"><a href=\"CLoans.php?empNumber=$empNumber&deductionCode=$deductionCode&Submit2=Delete\">Delete</a></td></tr></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
			echo "</tr><tr class=\"border\"><td height=\"18\" class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			//echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td></tr></table>";
		} 
	
	}		

}		
?>