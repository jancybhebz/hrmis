<?
/* 
File Name: LoginDTR.php
----------------------------------------------------------------------
Purpose of this file: 
Class login
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 15, 2004
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
require_once("../hrmis/class/General.php");
include_once("../hrmis/class/Constant.php");
class LoginDTR extends General
{
	function loginDTR()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection	
	}
	function logDTR($t_strEmpNmbr, $t_strPword, $t_strTime, $t_strDate, $t_blnSwipe=0)
	{
		if($t_blnSwipe == 0)
		{
			$strPword = $this->logDTRPassword($t_strPword);
			
			$objRecordset = mysql_query("SELECT * FROM tblEmpAccount 
										WHERE empNumber='$t_strEmpNmbr' 
											AND userPassword='$strPword'");
	
			if(!mysql_num_rows($objRecordset))   //username password is invalid
			{
				$blnPass = 0;
				return "Invalid password. Please re-enter your Password.";
			}
			else
			{
				$blnPass = 1;
			}
		}
		else
		{
			$objRecordset = mysql_query("SELECT * FROM tblEmpAccount 
										WHERE empNumber='$t_strEmpNmbr'");
	
			if(!mysql_num_rows($objRecordset))   //username password is invalid
			{
				$blnPass = 0;
				return "Invalid barcode. Please swipe valid code.";
			}
			else
			{
				$blnPass = 1;
			}		
		}
		
		if($blnPass)
		{
			$arrSchema = $this->getSchema($t_strEmpNmbr);  //get the attendance scheme
			
			$objDate = mysql_query("SELECT * FROM tblEmpDTR 
									WHERE empNumber='$t_strEmpNmbr' 
										AND dtrDate='$t_strDate'");
			if(!mysql_num_rows($objDate))   //username password is invalid
			{
				
				if (strstr($t_strTime,'A'))
				{
					mysql_query("INSERT INTO tblEmpDTR (empNumber, inAM, dtrDate) 
									VALUES ('$t_strEmpNmbr',
									'".substr($t_strTime, 0, -2)."',
									'".date("Y-m-d")."')");
				}
				else
				{
					mysql_query("INSERT INTO tblEmpDTR (empNumber, inPM, dtrDate) 
									VALUES ('$t_strEmpNmbr',
									'".substr($t_strTime, 0, -2)."',
									'".date("Y-m-d")."')");
				}
				$strConfirm = $this->logDTRConfirm(1);    //confirm function			
				return $strConfirm;
			}
			else
			{
				while($arrTime = mysql_fetch_array($objDate))
				{
					$arrLog = array(1=>$arrTime["inAM"], 2=>$arrTime["outAM"], 3=>$arrTime["inPM"], 
						4=>$arrTime["outPM"], 5=>$arrTime["inOT"], 6=>$arrTime["outOT"]); 
				}

				for($intCounter=1; $intCounter<=6; $intCounter++)
				{
					if ($arrLog[$intCounter] != '00:00:00')
					{
						$intTimeColumn = $intCounter;
					}
				}
				++$intTimeColumn;			
				$strTimeField = $this->logDTRGetFields($intTimeColumn, $t_strTime, $arrSchema["nnTimeoutTo"]);   //function logDTRGetFields
				$strErrMsg = $this->logDTRError($strTimeField, $t_strTime, $t_strPword, $arrSchema["nnTimeinFrom"], $arrSchema["nnTimeoutTo"], $arrSchema["overtimeStarts"]);   //function logDTRError
				
				if ($strErrMsg)
				{
					return $strErrMsg;
				}
				elseif (substr($t_strPword, -1) != '*')
				{  //updates the dtr...
					mysql_query("UPDATE tblEmpDTR SET $strTimeField = '$t_strTime' WHERE empNumber='$t_strEmpNmbr' AND dtrDate='$t_strDate'");				
					
					$strConfirm = $this->logDTRConfirm($intTimeColumn);    //confirm function			
					return $strConfirm;
				}
				elseif ($strTimeField == 'outAM' && substr($t_strPword, -1) == '*' && substr($t_strTime, 0, 2) == '12' && strstr($t_strTime,'P'))
				{
					++$intTimeColumn;
					$strTimeField2 = $this->logDTRGetFields($intTimeColumn, $t_strTime, $arrSchema["nnTimeoutTo"]);
					mysql_query("UPDATE tblEmpDTR SET $strTimeField = '$t_strTime', $strTimeField2 = '$t_strTime' WHERE empNumber='$t_strEmpNmbr' AND dtrDate='$t_strDate'");				

					$strConfirm = $this->logDTRConfirm("OUT-IN");    //confirm function			
					return $strConfirm;
				}
			}			
		}
	}
//-------------------------------------------- functions --------------------------------------------------	
	function getSchema($t_strEmpNmbr)
	{
		$objSchema = mysql_query("SELECT tblAttendanceScheme.nnTimeoutFrom, 
									tblAttendanceScheme.nnTimeoutTo, 
									tblAttendanceScheme.nnTimeinFrom, 
									tblAttendanceScheme.nnTimeinTo, 
									tblAttendanceScheme.overtimeStarts
								FROM tblAttendanceScheme
								INNER JOIN tblEmpPosition
									ON tblAttendanceScheme.schemeCode = tblEmpPosition.schemeCode
								WHERE tblEmpPosition.empNumber = '$t_strEmpNmbr'");
		
		$arrSchema = mysql_fetch_array($objSchema);
		return $arrSchema;
	}
	
	function logDTRPassword($t_strPword)
	{
		if (substr($t_strPword, -1) == "*")
		{
			$intPwordLen = strlen($t_strPword);
			--$intPwordLen;
			return substr($t_strPword, 0, $intPwordLen);
		}
		else
		{
			return $t_strPword;
		}	
	}

	function logDTRGetFields($t_intTimeColumn, $t_strTime, $t_dtmSchmOutTo)
	{
		$intTime = strtotime($t_strTime);  //the time
		$t_dtmSchmOutTo = $this->combineTime($t_dtmSchmOutTo, PM);
		$intSchmOut = strtotime($t_dtmSchmOutTo); //the nnTimeoutTo
		if ($t_intTimeColumn == 2 && $intSchmOut < $intTime)  //if the employee forgets to out-in in the afternoon
		{   //if the time is pm the out will be saved in outPM field!
			$t_intTimeColumn = 4;
		}		
		switch($t_intTimeColumn)
		{
			case 1:
				return "inAM";
				break;
			case 2:
				return "outAM";
				break;
			case 3:
				return "inPM";
				break;
			case 4:
				return "outPM";
				break;
			case 5:
				return "inOT";
				break;
			case 6:
				return "outOT";
				break;
			case 7:
				return "outOT";
				break;						
		}
	}

	function logDTRError($t_strTimeField, $t_strTime, $t_strPword, $t_dtmSchmInFrom, $t_dtmSchmOutTo, $t_dtmOvrtmStrt)
	{
		$intTime = strtotime($t_strTime);

		$t_dtmSchmInFrom = $this->combineTime($t_dtmSchmInFrom, PM);		
		$intSchmInFrom = strtotime($t_dtmSchmInFrom);

		$t_dtmSchmOutTo = $this->combineTime($t_dtmSchmOutTo, PM);
		$intSchmOutTo = strtotime($t_dtmSchmOutTo);

		if($t_dtmOvrtmStrt != NULLTIME)
		{
			$t_dtmOvrtmStrt = $this->combineTime($t_dtmOvrtmStrt, PM);
			$intOvrtm = strtotime($t_dtmOvrtmStrt);
		}
				
		if (substr($t_strPword, -1) != '*' && $t_strTimeField == 'inPM' && $intSchmInFrom > $intTime)
		{   //if inPM time is morning no afternoon in...
			return "Afternoon IN starts at ".$t_dtmSchmInFrom." onwards !!!";
		}
		elseif(substr($t_strPword, -1) != '*' && $t_strTimeField == 'inOT' && $t_dtmOvrtmStrt != NULLTIME)
		{
			if ($intOvrtm > $intTime)
			{	//if inOT time is less than 6 eg: 1 pm and morning... no OT			
				return "Overtime starts at ".$t_dtmOvrtmStrt." onwards !!!";
			}
		}
		elseif($t_strTimeField != 'outAM' && substr($t_strPword, -1) == '*') 
		{   //if the field is not outAm the OUT_IN is invalid
			return "We're sorry, your OUT-IN is NOT valid !!!";
		}
		elseif($t_strTimeField == 'outAM' && substr($t_strPword, -1) == '*' && ($intSchmInFrom > $intTime || $intSchmOutTo < $intTime))
		{   //out-in in afternoon
			return "Please OUT-IN from ".$t_dtmSchmInFrom." to ".$t_dtmSchmOutTo." !!!";
		}
		elseif($t_strTimeField == 'outOT')
		{
			return "Already Logged OUT!!!";
		}
		else
		{
			return NULL;
		}	
	}

	function logDTRConfirm($t_intTimeColumn)
	{
		if($t_intTimeColumn == 'OUT-IN')   // OUT-IN confirmation
		{
			return "You have successfully Logged OUT-IN !!!";
		}
		elseif($t_intTimeColumn%2)   //if 0 then its even, if not zero, their is remainder its odd
		{   //if odd goes here
			return "You have successfully Logged-IN !!!";
		}
		else
		{   //if even
			return "You have successfully Logged-OUT !!!";
		}
	}
//------------------------------------ screen functions ---------------------------------------------------
	function checkEmpNmbr($t_strEmpNmbr)
	{
		$objRecordset = mysql_query("SELECT empNumber FROM tblEmpPersonal WHERE empNumber='$t_strEmpNmbr'");

		if(!mysql_num_rows($objRecordset))   //username is invalid
		{
			return "Invalid employee number. Please re-enter your Employee Number.";
		}
	}
		
	function getPicture($t_strEmpNmbr)
	{
		$objRecordset = mysql_query("SELECT picture FROM tblEmpPicture WHERE empNumber='$t_strEmpNmbr'");

		if(mysql_num_rows($objRecordset))
		{
			while($arrPicture=mysql_fetch_array($objRecordset))
			{
				$strImage = $arrPicture["picture"];
				return $strImage;   //show photo to screen		
				// go query and get the photo
			}
		}
		else
		{
			$objRecordset = mysql_query("SELECT agencyLogo FROM tblAgencyImages");
			while($arrPicture=mysql_fetch_array($objRecordset))
			{
				$strImage = $arrPicture["agencyLogo"];
				return $strImage;
			}			
		}

	}
	
	function getName($t_strEmpNmbr)
	{
		$objName = mysql_query("SELECT surname, firstname FROM tblEmpPersonal WHERE empNumber='$t_strEmpNmbr'");
		if(mysql_num_rows($objName))
		{
			$arrName = mysql_fetch_array($objName);
			$strName = $arrName['surname'].", ".$arrName["firstname"];
		}
		return $strName;
	}

# ------------------------------------- employees inside the building ------------------------------------
	
	function empInside($t_strOrder, $t_intPage, $t_intCurrPage, $t_strDivision='')
	{
		if(strlen($t_strDivision) != 0)
		{
			$strAND = " AND tblEmpPosition.divisionCode = '$t_strDivision' ";
		}
		else
		{
			$strAND = "";
		}
		
		if($t_strOrder == 'name' || strlen($t_strOrder) == 0)
		{
			$strOrder = "tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		else if($t_strOrder == 'time')
		{
			$strOrder = "tblEmpDTR.inAM";
		}
		$dtmDateNow = date("Y-m-d");
		
		$strSQL = "SELECT tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpDTR.* 
								FROM tblEmpPersonal 
								INNER JOIN tblEmpPosition
									ON tblEmpPosition.empNumber = tblEmpPersonal.empNumber
								INNER JOIN tblEmpDTR 
									ON tblEmpDTR.empNumber = tblEmpPosition.empNumber
								WHERE tblEmpDTR.dtrDate = '$dtmDateNow' ".$strAND.
								" 	AND ((tblEmpDTR.outOT = '00:00:00' 
											AND tblEmpDTR.inOT != '00:00:00') 
										OR (tblEmpDTR.outPM = '00:00:00' 
											AND tblEmpDTR.outAM = '00:00:00'
											AND tblEmpDTR.inPM = '00:00:00'
											AND tblEmpDTR.inAM != '00:00:00')
										OR (tblEmpDTR.outPM = '00:00:00' 
											AND tblEmpDTR.outAM = '00:00:00'
											AND tblEmpDTR.inAM = '00:00:00'
											AND tblEmpDTR.inPM != '00:00:00')
										OR (tblEmpDTR.outPM = '00:00:00' 
											AND tblEmpDTR.outAM != '00:00:00'
											AND tblEmpDTR.inAM != '00:00:00'
											AND tblEmpDTR.inPM != '00:00:00')) 
								ORDER BY $strOrder ";
		
		$objName = mysql_query($strSQL);
		$intTotalRecord = mysql_num_rows($objName);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objName = mysql_query($strSQL);
		
		if(mysql_num_rows($objName))
		{
			while($arrName = mysql_fetch_array($objName))
			{
				if($arrName["inAM"] != NULLTIME)
				{
					$dtmTime = $arrName["inAM"]." ".AM;
				}
				elseif($arrName["inPM"] != NULLTIME)
				{
					$dtmTime = $arrName["inPM"]." ".PM;
				}
				elseif($arrName["inOT"] != NULLTIME)
				{
					$dtmTime = $arrName["inOT"]." ".PM;
				}
					
				echo "<tr><td></td><td height='20'>";
				echo ucwords(strtolower($arrName["surname"].", ".$arrName["firstname"]));
				echo "</td><td height='20'>";
				echo $dtmTime;
				echo "</td><td></td></tr>";
			}
		}
		else
		{
				echo"<tr><td colspan='6' height='70' align='center' valign='middle' class='errorsearch'>";
				echo "No present employees this time.</td></tr>";
		}
	}	
//------------------------------------ employees absent --------------------------------------------------
	function getEmpAbsForNow($t_intPage, $t_intCurrPage, $t_strDivision='')
	{
		if(strlen($t_strDivision) != 0)
		{
			$strAND = " AND tblEmpPosition.divisionCode = '$t_strDivision' ";
		}
		else
		{
			$strAND = "";
		}
		
		$dtmDateNow = date("Y-m-d");
		
		$strSQL = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblEmpPersonal.middlename 
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPosition.empNumber = tblEmpPersonal.empNumber
								WHERE tblEmpPosition.dtrSwitch = 'Y' $strAND 
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname";
		
		$objEmp = mysql_query($strSQL);
		$intTotalRecord = mysql_num_rows($objEmp);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objEmp = mysql_query($strSQL);
							
		if(mysql_num_rows($objEmp))
		{
			while($arrEmp = mysql_fetch_array($objEmp))
			{
				$strEmpNmbr = $arrEmp["empNumber"];
				
				$objEmpAbs = mysql_query("SELECT empNumber 
											FROM tblEmpDTR 
										WHERE dtrDate = '$dtmDateNow'
											AND empNumber='$strEmpNmbr'");
				
				if(!mysql_num_rows($objEmpAbs))
				{	
					echo "<tr><td width='20%'></td><td height='20' width='60%'>";
					$strEmpName = $arrEmp['surname'].", ".$arrEmp['firstname']." ".$arrEmp['middlename']; 
					echo ucwords( strtolower($strEmpName));
					echo "</td><td width='20%'></td></tr>";
				}
			}	
		}
		else
		{
			echo"<tr><td colspan='6' height='70' align='center' valign='middle' class='errorsearch'>";
			echo "No absent employees this time.</td></tr>";			
		}

	}

//------------------------------------ employees OB TO TT ------------------------------------------------
	function getOBTOTTForNow($t_strOrder, $t_intPage, $t_intCurrPage, $t_strDivision='')
	{
		if(strlen($t_strDivision) != 0)
		{
			$strAND = " AND tblEmpPosition.divisionCode = '$t_strDivision' ";
		}
		else
		{
			$strAND = "";
		}
		
		if($t_strOrder == 'name' || strlen($t_strOrder) == 0)
		{
			$strOrder = "tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		else if($t_strOrder == 'on')
		{
			$strOrder = "tblEmpDTR.remarks";
		}
		
		$dtmDateNow = date("Y-m-d");
		$strSQL = "SELECT tblEmpPersonal.surname, tblEmpPersonal.firstname, 
						  tblEmpPersonal.middlename, tblEmpDTR.remarks 
						FROM tblEmpPersonal 
					INNER JOIN tblEmpPosition
						ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
					INNER JOIN tblEmpDTR 
						ON tblEmpPersonal.empNumber = tblEmpDTR.empNumber
					WHERE tblEmpDTR.dtrDate = '$dtmDateNow' $strAND
						AND (tblEmpDTR.remarks = 'OB'
						OR tblEmpDTR.remarks = 'TO'
						OR tblEmpDTR.remarks = 'TT')
					ORDER BY $strOrder";
		
		$objEmp = mysql_query($strSQL);
		$intTotalRecord = mysql_num_rows($objEmp);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objEmp = mysql_query($strSQL);
		
		if(mysql_num_rows($objEmp))
		{
			while($arrEmp = mysql_fetch_array($objEmp))
			{
					echo "<tr><td></td><td height='20'>";
					echo ucwords(strtolower($arrEmp["surname"].", ".$arrEmp["firstname"]));
					echo "</td><td height='20'>";
					echo $arrEmp["remarks"];
					echo "</td><td></td></tr>";
			}
		}
		else
		{
			echo"<tr><td colspan='6' height='70' align='center' valign='middle' class='errorsearch'>";
			echo "No on official business / travel order / trip ticket employees this time.</td></tr>";					
		}
	}

//---------------------------------- employees on leave --------------------------------------------------

	function getEmpLeaveForNow($t_strOrder, $t_intPage, $t_intCurrPage, $t_strDivision='')
	{
		if(strlen($t_strDivision) != 0)
		{
			$strAND = " AND tblEmpPosition.divisionCode = '$t_strDivision' ";
		}
		else
		{
			$strAND = "";
		}
		
		if($t_strOrder == 'name' || strlen($t_strOrder) == 0)
		{
			$strOrder = "tblEmpPersonal.surname, tblEmpPersonal.firstname";
		}
		else if($t_strOrder == 'leave')
		{
			$strOrder = "tblLeave.leaveCode";
		}
		
		$dtmDateNow = date("Y-m-d");
		$strSQL = "SELECT tblEmpPersonal.surname, tblEmpPersonal.firstname, 
						  tblEmpPersonal.middlename, tblLeave.leaveType
						FROM tblEmpPersonal 
					INNER JOIN tblEmpDTR 
						ON tblEmpPersonal.empNumber=tblEmpDTR.empNumber
					INNER JOIN tblLeave 
						ON tblEmpDTR.remarks = tblLeave.leaveCode
					WHERE tblEmpDTR.dtrDate = '$dtmDateNow'
					ORDER BY $strOrder";
		
		$objEmp = mysql_query($strSQL);
		$intTotalRecord = mysql_num_rows($objEmp);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$strSQL = "$strSQL LIMIT ".$this->limit();
		$objEmp = mysql_query($strSQL);

		if(mysql_num_rows($objEmp))
		{
			while($arrEmp = mysql_fetch_array($objEmp))
			{
				echo "<tr><td></td><td height='20'>";
						echo ucwords(strtolower($arrEmp["surname"].", ".$arrEmp["firstname"]));
						echo "</td><td height='20'>";
						echo $arrEmp["leaveType"];
						echo "</td><td></td></tr>";
			}
		}
		else
		{
			echo"<tr><td colspan='6' height='70' align='center' valign='middle' class='errorsearch'>";
			echo "No on-leave employees this time.</td></tr>";					
		}
	}

}

?>