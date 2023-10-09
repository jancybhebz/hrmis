<?
require_once("../hrmis/class/General.php");
include_once("../hrmis/class/Constant.php");
class FileOB extends General
{
	function checkEmpDay($t_intNewID, $t_strEmpNmbr, $t_dtmDateFrom, $t_dtmDateTo, $t_dtmTimeFrom, $t_dtmTimeTo, $t_strOB)
	{
		$blnExclude = $this->checkExcludedEmp($t_strEmpNmbr);
	
		$strRemarks = $this->obCode($t_strOB);   //gets the OB code and puts it in tblEmpDTR remarks

		if($blnExclude)
		{		
			$t_intDayFrom = date("j", strtotime($t_dtmDateFrom));
			$t_intDayTo = date("j", strtotime($t_dtmDateTo));
			$t_intYearFrom = date("Y", strtotime($t_dtmDateFrom));
			$t_intMonthFrom = date("n", strtotime($t_dtmDateFrom));
			$strAMPMFrom = date("A", strtotime($t_dtmTimeFrom));
			$strAMPMTo = date("A", strtotime($t_dtmTimeTo));
					
			for($intCounter = $t_intDayFrom; $intCounter <= $t_intDayTo; $intCounter++)
			{
				$strDate = $this->combineDate($t_intYearFrom, $t_intMonthFrom, $intCounter);				
				$strDayName = date('l', strtotime($strDate));   //gets the day name: sunday, monday etc.
				
				if($strDayName != "Sunday" && $strDayName != "Saturday")   //not sunday, not saturday and NOT HOLIDAY dapat
				{
	
					$objDay = mysql_query("SELECT * FROM tblEmpDTR 
											WHERE empNumber = '$t_strEmpNmbr' 
												AND dtrDate = '$strDate'");   //checks if YYYY-MM-DD exist in tblEmpDTR
					$intCntRow = mysql_num_rows($objDay);
					$strSql = $this->sqlOBDTR($t_intNewID, $intCntRow, $t_strEmpNmbr, $strDate, $strRemarks, $strAMPMFrom, $strAMPMTo, $t_dtmTimeFrom, $t_dtmTimeTo);
					mysql_query($strSql);
				}
			}	
		}
	}	
	
	function checkExcludedEmp($t_strEmpNmbr)
	{
		$objEmpExclude = mysql_query("SELECT dtrSwitch FROM tblEmpPosition 
										WHERE empNumber='$t_strEmpNmbr'");
										
		$arrEmpExclude = mysql_fetch_array($objEmpExclude);
		
		if($arrEmpExclude['dtrSwitch'] == 'Y')
		{
			return 1;
		}
		elseif($arrEmpExclude['dtrSwitch'] == 'N')
		{
			return 0;
		}
	}

	function obCode($t_strOfficial)
	{   //determines if the OB is official or not and puts it at tblEmpDTR remarks.
		if ($t_strOfficial == 'N')
		{
			return "QB";	
		}
		else
		{
			return "OB";
		}		
	}
	
	function sqlOBDTR($t_intNewID, $t_intCntRow, $t_strEmpNmbr, $t_strDate, $t_strRemarks, $t_strFromAMPM, $t_strToAMPM, $t_strTimeFrom, $t_strTimeTo)
	{   //returns the proper SQL if YYYY-MM-DD exists in tblEmpDTR
		$dtmDiff =  strtotime($t_strTimeTo) - strtotime($t_strTimeFrom);
		$intHour = floor($dtmDiff/60/60);
		$intOfficeWorkHour = WORKHOURS + 1;   //office hours is 9 hours

		if($t_intCntRow == 0)   //if YYYY-MM-DD is not exist
		{				
			$strSQL = "INSERT INTO tblEmpDTR (empNumber, dtrDate, remarks, otherInfo, ";	
			
			if ($t_strFromAMPM == AM)
			{
				$strSQL = $strSQL."inAM, ";
			}
			else
			{
				$strSQL = $strSQL."inPM, ";
			}

			if ($intHour < $intOfficeWorkHour)
			{
				$strSQL = $strSQL."outAM) VALUES ( ";
			}
			else
			{
				$strSQL = $strSQL."outPM) VALUES ( ";
			}
			
			$strSQL = $strSQL."'$t_strEmpNmbr', '$t_strDate', '$t_strRemarks', '$t_intNewID', '$t_strTimeFrom', '$t_strTimeTo')";
			
			return $strSQL;
			
		}
		else   //if the date exist in tblEmpDTR, it must be update
		{
			$strSQL = "UPDATE tblEmpDTR SET remarks = '$t_strRemarks', otherInfo = '$t_intNewID', ";

			if ($t_strFromAMPM == AM)
			{
				$strSQL = $strSQL."inAM = '$t_strTimeFrom', ";
			}
			else
			{
				$strSQL = $strSQL."inPM = '$t_strTimeFrom', ";
			}

			if ($intHour < $intOfficeWorkHour)
			{
				$strSQL = $strSQL."outAM = '$t_strTimeTo' ";
			}
			else
			{
				$strSQL = $strSQL."outPM = '$t_strTimeTo' ";
			}
			
			$strSQL = $strSQL."WHERE empNumber = '$t_strEmpNmbr' AND dtrDate = '$t_strDate'";

			return $strSQL;

		}
	}	
}

?>