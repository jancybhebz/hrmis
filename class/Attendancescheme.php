<?php 
/* 
File Name: Holiday.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view holiday to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco, Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: August 03, 2004
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
class Attendancescheme extends General
{

var $strSchemeCode;
var $strSchemeName;
var $strSchemeType;


  function attendancescheme() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addAttendanceSchemeFixed($strEmpNmbr, $t_schemeCode, $t_schemeName, $t_strAttendanceScheme, $t_amTimeinFrom, $t_pmTimeoutFrom, $t_nnTimeoutFrom, $t_nnTimeoutTo,$t_nnTimeinFrom, $t_nnTimeinTo, $t_overtimeStarts, $t_overtimeEnds, $t_gracePeriod, $t_gpLeaveCredits, $t_gpLate, $t_wrkhrLeave, $t_hlfLateUnd, $Submit)   //Add Attendance Scheme
   { 
      if ($Submit == "Add")
	  {
	  	 
		 $results = "INSERT INTO tblAttendanceScheme(schemeCode,schemeName,schemeType,amTimeinFrom,amTimeinTo, pmTimeoutFrom,pmTimeoutTo, nnTimeoutFrom, nnTimeoutTo, nnTimeinFrom,nnTimeinTo,overtimeStarts,overtimeEnds,gracePeriod,gpLeaveCredits, gpLate,wrkhrLeave, hlfLateUnd) 
		     		 VALUES ('$t_schemeCode', '$t_schemeName', '$t_strAttendanceScheme', '$t_amTimeinFrom','$t_amTimeinFrom','$t_pmTimeoutFrom','$t_pmTimeoutFrom', '$t_nnTimeoutFrom', '$t_nnTimeoutTo', '$t_nnTimeinFrom', '$t_nnTimeinTo', '$t_overtimeStarts', '$t_overtimeEnds', '$t_gracePeriod', '$t_gpLeaveCredits', '$t_gpLate','$t_wrkhrLeave','$t_hlfLateUnd')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Attendance Scheme not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    
			return 1; 
	     } 
	  }
	}
	
  function addAttendanceSchemeSliding($strEmpNmbr, $t_schemeCode, $t_schemeName, $t_strAttendanceScheme, $t_amTimeinFrom, $t_amTimeinTo, $t_pmTimeoutFrom, $t_pmTimeoutTo, $t_nnTimeoutFrom, $t_nnTimeoutTo,$t_nnTimeinFrom, $t_nnTimeinTo, $t_overtimeStarts, $t_overtimeEnds, $t_gracePeriod, $t_gpLeaveCredits, $t_gpLate, $t_wrkhrLeave, $t_hlfLateUnd, $Submit)   //Add Attendance Scheme
   {
      if ($Submit == "Add")
	  {
	     $results = "INSERT INTO tblAttendanceScheme(schemeCode,schemeName,schemeType,amTimeinFrom,amTimeinTo,pmTimeoutFrom,pmTimeoutTo, nnTimeoutFrom, nnTimeoutTo,
		 											 nnTimeinFrom,nnTimeinTo,overtimeStarts,overtimeEnds,gracePeriod,gpLeaveCredits, gpLate,wrkhrLeave, hlfLateUnd) 
		     		 VALUES ('$t_schemeCode', '$t_schemeName', ' $t_strAttendanceScheme', '$t_amTimeinFrom', '$t_amTimeinTo', '$t_pmTimeoutFrom', '$t_pmTimeoutTo', '$t_nnTimeoutFrom', '$t_nnTimeoutTo',
 					 		 '$t_nnTimeinFrom', '$t_nnTimeinTo', '$t_overtimeStarts', '$t_overtimeEnds', '$t_gracePeriod', '$t_gpLeaveCredits', '$t_gpLate','$t_wrkhrLeave','$t_hlfLateUnd')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Attendance Scheme not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
		
	function editAttendanceSchemeFixed($strEmpNmbr, $t_schemeCode,$t_schemeName,$t_strAttendanceScheme,$t_amTimeinFrom,$t_amTimeinTo,$t_pmTimeoutFrom,$t_pmTimeoutTo,$t_nnTimeoutFrom,$t_nnTimeoutTo,$t_nnTimeinFrom,$t_nnTimeinTo,$t_overtimeStarts,$t_overtimeEnds,$t_gracePeriod,$t_gpLeaveCredits,$t_gpLate,$t_wrkhrLeave, $t_hlfLateUnd, $Submit) //edit holiday
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblAttendanceScheme WHERE schemeCode ='$t_schemeCode'"); 
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   
			   $t_schemeCode = $row['schemeCode'];
  			   $t_schemeName = $row['schemeName'];
			   $t_strAttendanceScheme = $row['schemeType'];
			   $t_amTimeinFrom = $row['amTimeinFrom'];
			   $t_amTimeinTo = $row['amTimeinTo'];
			   $t_pmTimeoutFrom = $row['pmTimeoutFrom'];
			   $t_pmTimeoutTo = $row['pmTimeoutTo'];
			   $t_nnTimeoutFrom = $row['nnTimeoutFrom'];
			   $t_nnTimeoutTo = $row['nnTimeoutTo'];
			   $t_nnTimeinFrom = $row['nnTimeinFrom'];
			   $t_nnTimeinTo = $row['nnTimeinTo'];
			   $t_overtimeStarts = $row['overtimeStarts'];
			   $t_overtimeEnds = $row['overtimeEnds'];
			   $t_gracePeriod = $row['gracePeriod'];
			   $t_gpLeaveCredits = $row['gpLeaveCredits'];
			   $t_gpLate = $row['gpLate'];
			   $t_wrkhrLeave = $row['wrkhrLeave'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 
			 $updateResults = "UPDATE tblAttendanceScheme SET  schemeName ='$t_schemeName', 
			 							schemeType = '$t_strAttendanceScheme', amTimeinFrom = '$t_amTimeinFrom', 
										amTimeinTo = '$t_amTimeinFrom', pmTimeoutFrom = '$t_pmTimeoutFrom', 
										pmTimeoutTo = '$t_pmTimeoutFrom', nnTimeoutFrom ='$t_nnTimeoutFrom', 
										nnTimeoutTo = '$t_nnTimeoutTo', nnTimeinFrom  = '$t_nnTimeinFrom', 
										nnTimeinTo = '$t_nnTimeinTo', overtimeStarts ='$t_overtimeStarts', 
										overtimeEnds = '$t_overtimeEnds', gracePeriod = '$t_gracePeriod', 
										gpLeaveCredits ='$t_gpLeaveCredits', gpLate ='$t_gpLate', 
										wrkhrLeave = '$t_wrkhrLeave', hlfLateUnd='$t_hlfLateUnd'
								WHERE schemeCode = '$t_schemeCode'";
								
		 
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Attendance Scheme not modified:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function editAttendanceSchemeSliding($strEmpNmbr, $t_schemeCode,$t_schemeName,$t_strAttendanceScheme,$t_amTimeinFrom,$t_amTimeinTo,$t_pmTimeoutFrom,$t_pmTimeoutTo,$t_nnTimeoutFrom,$t_nnTimeoutTo,$t_nnTimeinFrom,$t_nnTimeinTo,$t_overtimeStarts,$t_overtimeEnds,$t_gracePeriod, $t_gpLeaveCredits,$t_gpLate,$t_wrkhrLeave,$t_hlfLateUnd,$Submit) //edit holiday
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblAttendanceScheme WHERE schemeCode ='$t_schemeCode'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   
			   $t_schemeCode = $row['schemeCode'];
  			   $t_schemeName = $row['schemeName'];
			   $t_schemeType = $row['schemeType'];
			   $t_amTimeinFrom = $row['amTimeinFrom'];
			   $t_amTimeinTo = $row['amTimeinTo'];  
			   $t_pmTimeoutFrom = $row['pmTimeoutFrom'];
			   $t_pmTimeoutTo = $row['pmTimeoutTo'];
			   $t_nnTimeoutFrom = $row['nnTimeoutFrom'];
			   $t_nnTimeoutTo = $row['nnTimeoutTo'];
			   $t_nnTimeinFrom = $row['nnTimeinFrom'];
			   $t_nnTimeinTo = $row['nnTimeinTo'];
			   $t_overtimeStarts = $row['overtimeStarts'];
			   $t_overtimeEnds = $row['overtimeEnds'];
			   $t_gracePeriod = $row['gracePeriod'];
			   $t_gpLeaveCredits = $row['gpLeaveCredits'];
			   $t_gpLate = $row['gpLate'];
			   $t_wrkhrLeave = $row['wrkhrLeave'];
			   $t_hlfLateUnd = $row['hlfLateUnd'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 
			 $updateResults = "UPDATE tblAttendanceScheme SET schemeName ='$t_schemeName',schemeType='$t_strAttendanceScheme', 
		   							   amTimeinFrom='$t_amTimeinFrom',amTimeinTo ='$t_amTimeinTo',  
		   								pmTimeoutFrom='$t_pmTimeoutFrom', pmTimeoutTo='$t_pmTimeoutTo', 
		   								nnTimeoutFrom='$t_nnTimeoutFrom',nnTimeoutTo='$t_nnTimeoutTo', 
										nnTimeinFrom='$t_nnTimeinFrom', nnTimeinTo='$t_nnTimeinTo',
										overtimeStarts='$t_overtimeStarts',overtimeEnds ='$t_overtimeEnds', 
		   								gracePeriod='$t_gracePeriod',gpLeaveCredits='$t_gpLeaveCredits', 
										gpLate='$t_gpLate',wrkhrLeave='$t_wrkhrLeave', hlfLateUnd='$t_hlfLateUnd'
								WHERE schemeCode = '$t_schemeCode' ";
		 
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Attendance Scheme not modified:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteAttendanceScheme($strEmpNmbr, $t_schemeCode, $t_schemeName, $t_strAttendanceScheme, $t_amTimeinFrom, $t_amTimeinTo, $t_pmTimeoutFrom, $t_pmTimeoutTo, $t_nnTimeoutFrom, $t_nnTimeoutTo,$t_nnTimeinFrom, $t_nnTimeinTo, $t_overtimeStarts, $t_overtimeEnds, $t_gracePeriod, $t_gpLeaveCredits, $t_gpLate, $t_wrkhrLeave, $t_hlfLateUnd, $Submit) //Delete division
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == "OK")
	   {
	      $delete = "DELETE FROM tblAttendanceScheme WHERE schemeCode='$t_schemeCode' and schemeName = '$t_schemeName'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewAttendanceScheme($strEmpNmbr, $t_schemeCode, $t_schemeName, $t_strAttendanceScheme, $t_amTimeinFrom, $t_amTimeinTo, $t_pmTimeoutFrom, $t_pmTimeoutTo, $t_nnTimeoutFrom, $t_nnTimeoutTo,$t_nnTimeinFrom, $t_nnTimeinTo, $t_overtimeStarts, $t_overtimeEnds, $t_gracePeriod, $t_gpLeaveCredits, $t_gpLate, $t_wrkhrLeave, $Submit) //View list of holiday
    {
	     $viewResults = mysql_query("SELECT * FROM tblAttendanceScheme");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {	
			 $t_schemeCode = $row['schemeCode'];
			 $t_schemeName = $row['schemeName']; 
			 $t_strAttendanceScheme = $row['schemeType']; 
			 $t_amTimeinFrom = $row['amTimeinFrom'];
			 $t_amTimeinTo  = $row['amTimeinTo']; 
			 $t_pmTimeoutFrom = $row['pmTimeoutFrom']; 			 
			 $t_pmTimeoutTo  = $row['pmTimeoutTo'];
			 $t_nnTimeoutFrom = $row['nnTimeoutFrom']; 
			 $t_nnTimeoutTo = $row['nnTimeoutTo']; 
			 $t_nnTimeinFrom = $row['nnTimeinFrom'];
			 $t_nnTimeinTo   = $row['nnTimeinTo']; 
			 $t_overtimeStarts = $row['overtimeStarts'];  
			 $t_overtimeEnds = $row['overtimeEnds'];
			 $t_gracePeriod = $row['gracePeriod']; 
			 $t_gpLeaveCredits  = $row['gpLeaveCredits'];
			 $t_gpLate   = $row['gpLate']; 
			 $t_wrkhrLeave = $row['wrkhrLeave']; 			 
			 echo "<table width='90%' border='1' align='center' cellpadding='0' cellspacing='0'>";
             echo "<tr><td width='16%' class='alterrow'> Code</td>";
             echo "<td width='45%' class='alterrow'>Scheme Name</td>";
             echo "<td width='18%' class='alterrow'>Sheme</td>";
             echo "<td width='11%' class='alterrow'>&nbsp;</td>";
             echo "<td width='10%' class='alterrow'>&nbsp;</td>";
             echo "</tr><tr><td height='17' colspan='5'>&nbsp;</td></tr>";
			 
			 do 
			 {
			 $t_schemeCode = $row['schemeCode'];
			 $t_schemeName = $row['schemeName']; 
			 $t_strAttendanceScheme = $row['schemeType']; 
			 $t_amTimeinFrom = $row['amTimeinFrom'];
			 $t_amTimeinTo  = $row['amTimeinTo']; 
			 $t_pmTimeoutFrom = $row['pmTimeoutFrom']; 			 
			 $t_pmTimeoutTo  = $row['pmTimeoutTo'];
			 $t_nnTimeoutFrom = $row['nnTimeoutFrom']; 
			 $t_nnTimeoutTo = $row['nnTimeoutTo']; 
			 $t_nnTimeinFrom = $row['nnTimeinFrom'];
			 $t_nnTimeinTo   = $row['nnTimeinTo']; 
			 $t_overtimeStarts = $row['overtimeStarts'];  
			 $t_overtimeEnds = $row['overtimeEnds'];
			 $t_gracePeriod = $row['gracePeriod']; 
			 $t_gpLeaveCredits  = $row['gpLeaveCredits'];
			 $t_gpLate   = $row['gpLate']; 
			 $t_wrkhrLeave = $row['wrkhrLeave']; 
			 $t_hlfLateUnd = $row['hlfLateUnd']; 			 
			  echo "<tr class='titlebar'>"; 
              echo "<td>" .$row['schemeCode']. "</td>";
   	          echo "<td>" .$row['schemeName']. "</td>";
              echo "<td>".$row['schemeType']. "</td>";
              echo "<td><a href=\"Attendancescheme.php?strEmpNmbr=$strEmpNmbr&t_schemeCode=$t_schemeCode&t_schemeName=$t_schemeName&t_strAttendanceScheme=$t_strAttendanceScheme&t_amTimeinFrom=$t_amTimeinFrom&t_amTimeinTo=$t_amTimeinTo&t_pmTimeoutFrom=$t_pmTimeoutFrom&t_pmTimeoutTo=$t_pmTimeoutTo&t_nnTimeoutFrom=$t_nnTimeoutFrom&t_nnTimeoutTo=$t_nnTimeoutTo&t_nnTimeinFrom=$t_nnTimeinFrom&t_nnTimeinTo=$t_nnTimeinTo&t_overtimeStarts=$t_overtimeStarts&t_overtimeEnds=$t_overtimeEnds&t_gracePeriod=$t_gracePeriod&t_gpLeaveCredits=$t_gpLeaveCredits&t_gpLate=$t_gpLate&t_wrkhrLeave=$t_wrkhrLeave&t_hlfLateUnd=$t_hlfLateUnd&Submit=Edit\">Edit</td>";	  			  
			  echo "<td><a href=\"Attendancescheme.php?strEmpNmbr=$strEmpNmbr&t_schemeCode=$t_schemeCode&t_schemeName=$t_schemeName&t_strAttendanceScheme=$t_strAttendanceScheme&t_amTimeinFrom=$t_amTimeinFrom&t_amTimeinTo=$t_amTimeinTo&t_pmTimeoutFrom=$t_pmTimeoutFrom&t_pmTimeoutTo=$t_pmTimeoutTo&t_nnTimeoutFrom=$t_nnTimeoutFrom&t_nnTimeoutTo=$t_nnTimeoutTo&t_nnTimeinFrom=$t_nnTimeinFrom&t_nnTimeinTo=$t_nnTimeinTo&t_overtimeStarts=$t_overtimeStarts&t_overtimeEnds=$t_overtimeEnds&t_gracePeriod=$t_gracePeriod&t_gpLeaveCredits=$t_gpLeaveCredits&t_gpLate=$t_gpLate&t_wrkhrLeave=$t_wrkhrLeave&t_hlfLateUnd=$t_hlfLateUnd&Submit=Delete\">Delete</td>";
              echo "</tr>";			
			} while ($row = mysql_fetch_array($viewResults));
			  echo "<tr><td colspan='5'>&nbsp;</td></tr></table>";	
			
		 }
	}
	
}
?> 