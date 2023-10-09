<?php 
/* 
File Name: Update201request.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view leave code & type to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: January 26, 2004
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
class Update201request extends General
{

   function update201Request() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
	function viewUpdate201Request($strEmpNmbr) //View list of employee/s request (Update201request.php)
    {
		 $t_strRequestStatus = "Filed Request";
		 $obj201Rqst = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestDetails, 
		 									tblEmpPersonal.surname, tblEmpPersonal.firstname,
											tblEmpPersonal.empNumber
									FROM tblEmpRequest 
										INNER JOIN tblEmpPersonal 
											ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber 
									WHERE tblEmpRequest.requestCode LIKE '201'
										AND tblEmpRequest.requestStatus = '$t_strRequestStatus'");
		 if (!mysql_num_rows($obj201Rqst))
		 {
		    echo "No employee/s Request yet!";
		 } 
		 else 
		 {
		    echo "<table width=\"95%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		    echo "<form action=\"<? $PHP_SELF; ?>\" method=\"post\" name=\"frmChief\">";
		    echo "<tr class=\"alterrow\"><td width=\"14%\">Request ID</td>";
		    echo "<td width=\"19%\">201 Request</td>";
		    echo "<td width=\"42%\">Employee/s Name</td>";
		    echo "<td width=\"25%\">&nbsp;</td>";
		    echo "</tr>";
		    echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			while($arr201Rqst = mysql_fetch_array($obj201Rqst))
			{
				$t_strEmpNumber=$arr201Rqst['empNumber'];
				$intRequestID=$arr201Rqst['requestID'];
				$strSurname=$arr201Rqst['surname'];
				$strFirstname=$arr201Rqst['firstname'];
				$strRequestDetails=$arr201Rqst['requestDetails'];
				$arrParticular = explode(";", $strRequestDetails);
				
				echo "<tr class=\"alterrow\"><td>$intRequestID</td>";
				echo "<td>".$arrParticular[0]."</td>";
				echo "<td><div align=\"justify\">$strFirstname  $strSurname</div></td>";
				echo "<td><a  href=\"Update201request.php?strEmpNmbr=$strEmpNmbr&t_strEmpNumber=$t_strEmpNumber&intRequestID=$intRequestID&str201Rqst=$arrParticular[0]\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">View Details</a></td>";
				echo "<tr height=5><td colspan=5></td></tr>";
			}  
                echo "</form></table>";
        }
	}
	
//----------------------------------------------- -------------------------------------------------------
	function viewBirthday($t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strBirthday) //View list of employee birthday
    {
	     $var="-".date("m")."-";
		 $viewResults = mysql_query("SELECT surname,firstname,middlename,birthday FROM tblEmpPersonal WHERE birthday LIKE '%$var%'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No birthday celebrators for this month!";
		 } else {
			echo "<table width=\"80%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			echo "<tr class=\"alterrow\"><td colspan=\"2\">CELEBRATORS</td>";
			echo "<td width=\"28%\">DATE OF BIRTH</td></tr>";
			echo "<tr class=\"title\">";
			echo "<td colspan=\"2\">&nbsp;</td>";
			echo "<td>&nbsp;</td></tr>";
			do 
			{
			   $t_strSurname=$row['surname'];
			   $t_strFirstname=$row['firstname'];
			   $t_strMiddlename=$row['middlename'];
			   $t_strBirthday=$row['birthday'];
			   echo "<tr class=\"alterrow\">";
			   echo "<td width=\"20%\"><div align=\"right\">";
			   echo "<img src=\"images/giftbox.gif\" width=\"16\" height=\"16\"></div></td>";
			   echo "<td width=\"52%\"><div align=\"justify\">" . $row['surname'] . "," . "&nbsp;" . $row['firstname'] ."</div></td>";
			   echo "<td><div align=\"center\">" . $row['birthday'] . "</div></td>";
			   echo "</tr><tr class=\"title\"><td colspan=\"2\">&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</table>";
        }
	}

	function viewFinishContract($t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strContractEndDate) //View list of employee/s finish contract
    {
		 $Year=date("Y")."-".date("m")."-";
		 $viewResults = mysql_query("SELECT * FROM tblEmpPosition LEFT JOIN tblEmpPersonal ON tblEmpPosition.empNumber=tblEmpPersonal.empNumber WHERE tblEmpPosition.contractEndDate LIKE '%$Year%'"); 
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No employee finish contract as of this month!";
		 } else {
			echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
            echo "<tr class=\"alterrow\"><td width=\"24%\">Number</td>";
            echo "<td width=\"54%\">Name</td><td width=\"22%\">Contract End Date</td></tr>";
            echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			do 
			{
			   $t_strSurname=$row['surname'];
			   $t_strFirstname=$row['firstname'];
			   $t_strMiddlename=$row['middlename'];
			   $t_strBirthday=$row['birthday'];
            echo "<tr class=\"alterrow\"><td>" . $row['empNumber'] . "</td>";
			echo "<td>" . $row['surname'] . ",&nbsp; " . $row['firstname'] . " ". $row['middlename'] . "</td>";
            echo "<td>" . $row['contractEndDate'] . "</td></tr>";
            echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</table>";
        }
	}

//-------------------------------------------------------------------------------------------------

	function viewEmployeeRequestForChildren($strEmpNmbr, $t_strRequestID, $t_strRequestCode, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestDetails, $t_strRequestStatus, $t_dtmStatusDate, $t_strRemarks, $t_strSignatory, $Submit, $t_strOldRequestStatus)   // to notify report request from employee module (Reportrequest.php)
	{
		if ($Submit == 'View')
		{
		$viewResults = mysql_query("SELECT requestStatus, statusDate, remarks, signatory FROM tblEmpRequest WHERE empNumber = '$t_strEmpNumber' AND requestID = '$t_strRequestID' ");
		 if($row = mysql_fetch_array($viewResults))
		 {
		    do 
			{   			  
			$t_strRequestID=$row['requestID'];
			$t_strRequestCode=$row['requestCode'];
			$t_strEmpNumber=$row['empNumber'];
		    $t_strSurname=$row['surname'];
			$t_strFirstname=$row['firstname'];
			$t_strMiddlename=$row['middlename'];
			$t_strRequestDetails=$row['requestDetails'];
			$t_strRequestStatus=$row['requestStatus'];
			$t_dtmStatusDate=$row['statusDate'];
			$t_strRemarks=$row['remarks'];
			$t_strSignatory=$row['signatory'];
			}  while($row=mysql_fetch_array($viewResults));
		}
	}
	elseif ($Submit == 'Update'){ 
			 $updateResults = "UPDATE tblEmpRequest SET requestStatus='$t_strRequestStatus', signatory='$t_strSignatory', remarks='$t_strRemarks' WHERE empNumber = '$t_strEmpNumber' AND requestID = '$t_strRequestID' AND requestStatus = '$t_strOldRequestStatus' ";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Request Status not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}

// -------------------------------------------------------------------------------------------------

	function getRqstDetails($t_intRequestID)
    {
		 $objRqst = mysql_query("SELECT requestDetails 
		 							FROM tblEmpRequest 
									WHERE requestID = '$t_intRequestID'");

		$arrRqst = mysql_fetch_array($objRqst);
		$strRqstDtl = $arrRqst['requestDetails'];
		$arrRqstDtl = explode(";", $strRqstDtl);
		
		return $arrRqstDtl;
	}
	
	function getCurrentTax($t_intRequestID)
	{
		$strTaxEmpNmbr = $this->getEmpNumber($t_intRequestID);
				
		$objTax = mysql_query("SELECT comTaxNumber, issuedAt, issuedOn
									FROM tblEmpPersonal
									WHERE empNumber = '$strTaxEmpNmbr'");
		$arrTax = mysql_fetch_array($objTax);
		
		return $arrTax;
	}
	
	function getCurrentProfile($t_intRequestID)
	{
		$strTaxEmpNmbr = $this->getEmpNumber($t_intRequestID);

		$objPrfl = mysql_query("SELECT *
									FROM tblEmpPersonal
									WHERE empNumber = '$strTaxEmpNmbr'");
		$arrPrfl = mysql_fetch_array($objPrfl);
		
		return $arrPrfl;			
	}
	
	function getEmpNumber($t_intRequestID)
	{
		$objTaxRqst = mysql_query("SELECT empNumber 
										FROM tblEmpRequest 
										WHERE requestID='$t_intRequestID'");

		$arrTaxRqst = mysql_fetch_array($objTaxRqst);

		return $arrTaxRqst['empNumber'];	
	}
	
	function updateEmpRqst($t_intRqstID)
	{
		mysql_query("UPDATE tblEmpRequest SET requestStatus='Updated' WHERE requestID='$t_intRqstID'");
	}
	
	function addEdctn($t_intRqstID, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_intUnits, $t_strHonors, $t_dtmFrom, $t_dtmTo)
	{
		$strEmpNmbr = $this->getEmpNumber($t_intRqstID);
		mysql_query("INSERT INTO tblEmpSchool 
						(empNumber, levelCode, schoolName, course, 
						units, honors, schoolFromDate, schoolToDate)
					VALUES('$strEmpNmbr', '$t_strLevelCode', '$t_strSchoolName', '$t_strCourse',
							'$t_intUnits', '$t_strHonors', '$t_dtmFrom', '$t_dtmTo')");
		$this->updateEmpRqst($t_intRqstID);
	}

	function addTrng($t_intRqstID, $t_strTrngCode, $t_dtmContract, $t_strConducted, $t_strVenue, $t_dtmDateFrom, $t_dtmDateTo, $t_intHours, $t_intCost)
	{
		$strEmpNmbr = $this->getEmpNumber($t_intRqstID);
		mysql_query("INSERT INTO tblEmpTraining 
						(empNumber, trainingCode, trainingContractDate, trainingConductedBy,
						trainingVenue, trainingStartDate, trainingEndDate, trainingHours, trainingCost)
					VALUES('$strEmpNmbr', '$t_strTrngCode', '$t_dtmContract', '$t_strConducted',
							'$t_strVenue', '$t_dtmDateFrom', '$t_dtmDateTo', '$t_intHours', '$t_intCost')");
		$this->updateEmpRqst($t_intRqstID);
	}
	
	function addExam($t_intRqstID, $t_strExamCode, $t_dtmExamDate, $t_strExamRate, $t_strExamPlace, $t_strLicenseNumber, $t_dtmDateRelease)
	{
		$strEmpNmbr = $this->getEmpNumber($t_intRqstID);

		if ($t_strLicenseNumber == "not-applicable")
		{
		$t_dtmDateRelease = "0000-00-00";
		mysql_query("INSERT INTO tblEmpExam 
						(empNumber, examCode, examDate, examRating, examPlace, licenseNumber, dateRelease)
					VALUES('$strEmpNmbr', '$t_strExamCode', 
							'$t_dtmExamDate', '$t_strExamRate', '$t_strExamPlace', 
							'$t_strLicenseNumber', '$t_dtmDateRelease')");
		} else {
		mysql_query("INSERT INTO tblEmpExam 
						(empNumber, examCode, examDate, examRating, examPlace, licenseNumber, dateRelease)
					VALUES('$strEmpNmbr', '$t_strExamCode', 
							'$t_dtmExamDate', '$t_strExamRate', '$t_strExamPlace', 
							'$t_strLicenseNumber', '$t_dtmDateRelease')");
		}
		$this->updateEmpRqst($t_intRqstID);		
	}
	
	function addChild($t_intRqstID, $t_strChildName, $t_dtmChildBirth)
	{
		$strEmpNmbr = $this->getEmpNumber($t_intRqstID);
		mysql_query("INSERT INTO tblEmpChild 
						(empNumber, childName, childBirthDate)
					VALUES('$strEmpNmbr', '$t_strChildName', '$t_dtmChildBirth')");
		$this->updateEmpRqst($t_intRqstID);				
	}
	
	function addReference($t_intRqstID, $t_strRefName, $t_strRefAddress, $t_strRefContact)
	{
		$strEmpNmbr = $this->getEmpNumber($t_intRqstID);
		mysql_query("INSERT INTO tblEmpReference 
						(empNumber, refName, refAddress, refTelephone)
					VALUES('$strEmpNmbr', '$t_strRefName', '$t_strRefAddress', '$t_strRefContact')");
		$this->updateEmpRqst($t_intRqstID);					
	}

	function addVoluntaryWork($t_intRqstID, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFrom, $t_dtmVWDateTo, $t_intVWHours, $t_strVWPosition)
	{
		$strEmpNmbr = $this->getEmpNumber($t_intRqstID);
		mysql_query("INSERT INTO tblEmpVoluntaryWork 
						(empNumber, vwName, vwAddress, vwDateFrom, vwDateTo, vwHours, vwPosition)
					VALUES('$strEmpNmbr', '$t_strVWName', '$t_strVWAddress', '$t_dtmVWDateFrom', '$t_dtmVWDateTo', '$t_intVWHours', '$t_strVWPosition')");
		$this->updateEmpRqst($t_intRqstID);
	}

	function updateTax($t_intRqstID, $t_strTaxNo, $t_strTaxPlace, $t_dtmTax)
	{
		$strEmpNmbr = $this->getEmpNumber($t_intRqstID);
		mysql_query("UPDATE tblEmpPersonal 
						SET comTaxNumber='$t_strTaxNo', issuedAt='$t_strTaxPlace',
							issuedOn='$t_dtmTax'
						WHERE empNumber='$strEmpNmbr'");
		$this->updateEmpRqst($t_intRqstID);					
	}

	function updateProfile($t_intRqstID, $t_strSurname, $t_strMiddlename, $t_strCivilStatus, $t_intWeight, $t_strResidentialAddress, $t_intZipCode1, $t_intTelephone1, $t_strPermanentAddress, $t_intZipCode2, $t_intTelephone2, $t_strEmail, $t_intMobile, $t_strSpouse, $t_strSpouseWork, $t_strSpouseBusName, $t_strSpouseBusAddress, $t_intSpouseTelephone)
	{
		$strEmpNmbr = $this->getEmpNumber($t_intRqstID);
		mysql_query("UPDATE tblEmpPersonal 
						SET surname='$t_strSurname', middlename='$t_strMiddlename', 	
							civilStatus='$t_strCivilStatus', weight='$t_intWeight', 
							residentialAddress='$t_strResidentialAddress', zipCode1='$t_intZipCode1', 
							telephone1='$t_intTelephone1', permanentAddress='$t_strPermanentAddress', 
							zipCode2='$t_intZipCode2', telephone2='$t_intTelephone2',
							email='$t_strEmail', mobile='$t_intMobile', 
							spouse='$t_strSpouse', spouseWork='$t_strSpouseWork',
							spouseBusName='$t_strSpouseBusName', spouseBusAddress='$t_strSpouseBusAddress',
							spouseTelephone='$t_intSpouseTelephone'
						WHERE empNumber='$strEmpNmbr'");
		$this->updateEmpRqst($t_intRqstID);							
	}
	
}	//  end class
?> 