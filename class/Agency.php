<?php 
/* 
File Name: Agency.php (class folder)
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
Date of Revision: October 17, 2003
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
class Agency extends General
{

   function agency() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addAgency($strEmpNmbr, $t_strAgencyName, $t_strAbbreviation, $t_intAgencyTin, $t_strAddress, $t_intTelephone, $t_strSalarySchedule, $t_dtmLBStartMonth, $t_dtmLBStartYear, $t_intGSISEmpShare, $t_intGSISEmprShare, $t_intPAGIBIGEmpShare, $t_intPAGIBIGEmprShare, $t_intPHILHEALTHEmpShare, $t_intPHILHEALTHEmprShare, $t_intPHILHEALTHPercentage, $t_intLongevityMultiply, $t_intLongevityYear, $t_intHPFactor, $t_intSubsistence, $t_dtmLBStartMonth, $t_dtmLBStartYear, $Submit)    //Add agency
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblAgency (agencyName, abbreviation, agencyTin, address, telephone, salarySchedule, lbStartMonth, lbStartYear, gsisEmpShare, gsisEmprShare, pagibigEmpShare, pagibigEmprShare, philhealthEmpShare, philhealthEmprShare, philhealthPercentage, longevityMultiply, longevityYear, hpFactor, subsistence, lbStartMonth, lbStartYear) VALUES ('$t_strAgencyName', '$t_strAbbreviation', '$t_intAgencyTin', '$t_strAddress', '$t_intTelephone', '$t_strSalarySchedule', '$t_dtmLBStartMonth', '$t_dtmLBStartYear', '$t_intGSISEmpShare', '$t_intGSISEmprShare', '$t_intPAGIBIGEmpShare', '$t_intPAGIBIGEmprShare', '$t_intPHILHEALTHEmpShare', '$t_intPHILHEALTHEmprShare', '$t_intPHILHEALTHPercentage', '$t_intLongevityMultiply', '$t_intLongevityYear', '$t_intHPFactor', '$t_intSubsistence', '$t_dtmLBStartMonth', '$t_dtmLBStartYear')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Agency not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}

	function editAgency($strEmpNmbr, $t_strAgencyName, $t_strAbbreviation, $t_intAgencyTin, $t_strAddress, $t_intTelephone, $t_strSalarySchedule, $t_dtmLBStartMonth, $t_dtmLBStartYear, $t_intGSISEmpShare, $t_intGSISEmprShare, $t_intPAGIBIGEmpShare, $t_intPAGIBIGEmprShare, $t_intPHILHEALTHEmpShare, $t_intPHILHEALTHEmprShare, $t_intPHILHEALTHPercentage, $t_intLongevityMultiply, $t_intLongevityYear, $t_intHPFactor, $t_intSubsistence, $t_dtmLBStartMonth, $t_dtmLBStartYear, $Submit, $t_strOldAgencyName)    //Edit agency
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblAgency WHERE agencyName='$t_strAgencyName'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strAgencyName=$row['agencyName']; 
			   $t_strAbbreviation=$row['abbreviation']; 
			   $t_intAgencyTin=$row['agencyTin'];
			   $t_strAddress=$row['address']; 
			   $t_intTelephone=$row[''];
			   $t_strSalarySchedule=$row['salarySchedule'];
			   $t_dtmLBStartMonth=$row['lbStartMonth'];
			   $t_dtmLBStartYear=$row['lbStartYear'];
			   $t_intGSISEmpShare=$row['gsisEmpShare'];
			   $t_intGSISEmprShare=$row['gsisEmprShare'];
			   $t_intPAGIBIGEmpShare=$row['pagibigEmpShare'];
			   $t_intPAGIBIGEmprShare=$row['pagibigEmprShare'];
			   $t_intPHILHEALTHEmpShare=$row['philhealthEmpShare'];
			   $t_intPHILHEALTHEmprShare=$row['philhealthEmprShare'];
			   $t_intPHILHEALTHPercentage=$row['philhealthPercentage'];
			   $t_intLongevityMultiply=$row['longevityMultiply'];
			   $t_intLongevityYear=$row['longevityYear'];
			   $t_intHPFactor=$row['hpFactor'];
			   $t_intSubsistence=$row['subsistence'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
			 $updateResults = "UPDATE tblAgency SET agencyName='$t_strAgencyName', abbreviation='$t_strAbbreviation', agencyTin='$t_intAgencyTin', address='$t_strAddress', telephone='$t_intTelephone', salarySchedule='$t_strSalarySchedule', lbStartMonth='$t_dtmLBStartMonth', lbStartYear='$t_dtmLBStartYear', gsisEmpShare='$t_intGSISEmpShare', gsisEmprShare='$t_intGSISEmprShare', pagibigEmpShare='$t_intPAGIBIGEmpShare', pagibigEmprShare='$t_intPAGIBIGEmprShare', philhealthEmpShare='$t_intPHILHEALTHEmpShare', philhealthEmprShare='$t_intPHILHEALTHEmprShare', philhealthPercentage='$t_intPHILHEALTHPercentage', longevityMultiply='$t_intLongevityMultiply', longevityYear='$t_intLongevityYear', hpFactor='$t_intHPFactor', subsistence='$t_intSubsistence', lbStartMonth='$t_dtmLBStartMonth', lbStartYear='$t_dtmLBStartYear' WHERE agencyName='$t_strOldAgencyName' ";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Agency not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
	function viewAgency($strEmpNmbr)    //view agency
    {
	    $viewResults=mysql_query("SELECT tblAgency.agencyName, tblAgency.abbreviation,
										tblAgency.address, tblAgency.telephone,
										tblAgency.salarySchedule, tblAgencyImages.AgencyLogo,	
										tblAgency.gsisEmpShare, tblAgency.gsisEmprShare,
										tblAgency.pagibigEmpShare, tblAgency.pagibigEmprShare,
										tblAgency.philhealthEmpShare, tblAgency.philhealthEmprShare,
										tblAgency.philhealthPercentage, tblAgency.longevityMultiply,
										tblAgency.longevityYear, tblAgency.hpFactor,
										tblAgency.subsistence, tblAgency.lbStartMonth,
										tblAgency.lbStartYear, tblAgencyImages.id, 
										tblAgencyImages.filename, tblAgency.agencyTin
							FROM tblAgency 
								LEFT JOIN tblAgencyImages ON 
								tblAgency.agencyName=tblAgencyImages.agencyName
							"); 
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "database is empty";
		} else {
		   $t_strAgencyName=$row['agencyName']; 
		   $t_strAbbreviation=$row['abbreviation']; 
		   $t_intAgencyTin=$row['agencyTin'];
		   $t_strAddress=$row['address'];
		   $t_intTelephone=$row['telephone']; 
		   $t_strSalarySchedule=$row['salarySchedule'];
		   $t_dtmLBStartMonth=$row['lbStartMonth'];
		   $t_dtmLBStartYear=$row['lbStartYear'];
		   $t_intGSISEmpShare=$row['gsisEmpShare'];
		   $t_intGSISEmprShare=$row['gsisEmprShare'];
		   $t_intPAGIBIGEmpShare=$row['pagibigEmpShare'];
		   $t_intPAGIBIGEmprShare=$row['pagibigEmprShare'];
		   $t_intPHILHEALTHEmpShare=$row['philhealthEmpShare'];
		   $t_intPHILHEALTHEmprShare=$row['philhealthEmprShare'];
		   $t_intPHILHEALTHPercentage=$row['philhealthPercentage'];
		   $t_intLongevityMultiply=$row['longevityMultiply'];
		   $t_intLongevityYear=$row['longevityYear'];
		   $t_intHPFactor=$row['hpFactor'];
		   $t_intSubsistence=$row['subsistence'];
		   $t_strAgencyID=$row['id'];
		   $filename=$row['filename'];
		   $t_strAgencyLogo=$row['agencyLogo'];
			 echo "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"30000\"><tr>";
             echo "<td height=\"19\" class=\"paragraph\">Agency Name :</td>";
			 echo "<td>" . $row['agencyName'] . "</td></tr>";
             echo "<tr><td height=\"4\" class=\"paragraph\">Agency Code :</td>";
             echo "<td>" . $row['abbreviation'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">TIN Number :</td>";
			 echo "<td> ". $row['agencyTin'] . "</td></tr>";
             echo "<tr><td height=\"5\" class=\"paragraph\">Address :</td>";
             echo "<td>" . $row['address'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\"> Telephone :</td>";
             echo "<td>" . $row['telephone'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">Salary Schedule :</td>";
             echo "<td>". $row['salarySchedule'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">Start Date :</td>";
             echo "<td><span class=\"paragraph\">". $row['lbStartYear'] . "-" . $row['lbStartMonth'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\"><hr></td>";
             echo "<td><hr></td></tr>";
             echo "<tr><td class=\"paragraph\">GSIS Employee Share :</td>";
             echo "<td> " . $row['gsisEmprShare'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">GSIS Employer Share :</td>";
             echo "<td>" . $row['gsisEmprShare'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">PAGIBIG Employee Share :</td>";
             echo "<td>" . $row['pagibigEmpShare'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">PAGIBIG Employer Share :</td>";
             echo "<td> " . $row['pagibigEmprShare'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">PhilHealth Employee Share :</td>";
             echo "<td>" . $row['philhealthEmpShare'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">PhilHealth Employer Share :</td>";
             echo "<td> " . $row['philhealthEmpShare'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">PhilHealth Percentage :</td>";
             echo "<td> " . $row['philhealthPercentage'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">Longevity Multiply :</td>";
             echo "<td>" . $row['longevityMultiply'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">Longevity Year :</td>";
             echo "<td> " . $row['longevityYear'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">HP Factor :</td>";
             echo "<td> " . $row['hpFactor'] . "</td></tr>";
             echo "<tr><td class=\"paragraph\">Subsistence :</td>";
             echo "<td>" . $row['subsistence'] . "<input name=\"t_strOldAgencyName\" type=\"hidden\" value=\"<? echo $t_strAgencyName; ?>\"></td></tr>";
             echo "<tr><td class=\"paragraph\"> </td><td>&nbsp;</td></tr>";
             echo "<tr><td rowspan=\"2\" class=\"paragraph\"> </td>";
             echo "<td><a href=\"Agency.php?strEmpNmbr=$strEmpNmbr&filename=$filename&t_strAgencyName=$t_strAgencyName&t_strAbbreviation=$t_strAbbreviation&t_intAgencyTin=$t_intAgencyTin&t_strAddress=$t_strAddress&t_intTelephone=$t_intTelephone&t_strSalarySchedule=$t_strSalarySchedule&t_dtmLBStartMonth=$t_dtmLBStartMonth&t_dtmLBStartYear=$t_dtmLBStartYear&t_intGSISEmpShare=$t_intGSISEmpShare&t_intGSISEmprShare=$t_intGSISEmprShare&t_intPAGIBIGEmpShare=$t_intPAGIBIGEmpShare&t_intPAGIBIGEmprShare=$t_intPAGIBIGEmprShare&t_intPHILHEALTHEmpShare=$t_intPHILHEALTHEmpShare&t_intPHILHEALTHEmprShare=$t_intPHILHEALTHEmprShare&t_intPHILHEALTHPercentage=$t_intPHILHEALTHPercentage&t_intLongevityMultiply=$t_intLongevityMultiply&t_intLongevityYear=$t_intLongevityYear&t_intHPFactor=$t_intHPFactor&t_intSubsistence=$t_intSubsistence&Submit=Edit\">Edit</a></td></tr>";
             echo "<tr><td><a href=\"AgencyImage.php?strEmpNmbr=$strEmpNmbr&filename=$filename&t_strAgencyName=$t_strAgencyName&Submit2=Delete\">*** Click to Edit Logo (automatically deleted the old stored logo) ***</a></td></tr></form></table>";
        }
	}
	
	function AgencyName($t_strAgencyName)
	{
		$result = mysql_query ("SELECT agencyName FROM tblAgency");
		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strAgencyName == $row["agencyName"])
			{
			print "<OPTION VALUE=\"".$row["agencyName"]."\" selected>".$row["agencyName"]."\r";
			}
			print "<OPTION VALUE=\"".$row["agencyName"]."\">".$row["agencyName"]."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}

	}
	
	function deleteAgencyLogo($strEmpNmbr, $t_strAgencyName, $Submit2) //edit delete logo
    {

	   if ($Submit2 == 'Delete') 
	   {
	    	$delete = mysql_query("DELETE FROM tblAgencyImages WHERE agencyName = '$t_strAgencyName'");
	     	$del = mysql_query($delete);
	   }

	}

	
}	//  end class
?> 