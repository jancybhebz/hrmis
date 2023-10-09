<?
require("../hrmis/class/AttendanceLate.php");
class AttendanceUndertime extends AttendanceLate
{
	function daysUndertime($t_strMonth, $t_strYear, $t_strEmpNmbr)   //main undertime method. monthly
	{
		$this->strNmbrDays = "";
		$strMonthYear = $this->combineMonthYear($t_strYear, $t_strMonth);

		$dtmOfficialTimeOutFrom = $this->getOfficialTimeOut("begin", $t_strEmpNmbr);
		$dtmOfficialTimeOutTo = $this->getOfficialTimeOut("end", $t_strEmpNmbr);
		
		$dtmOfficialTimeInFrom = $this->getOfficialTimeIn("begin", $t_strEmpNmbr);
		$dtmOfficialTimeInTo = $this->getOfficialTimeIn("end", $t_strEmpNmbr);			

		$intQB = $this->getHourQB($t_strMonth, $t_strYear, $t_strEmpNmbr);   //plus ung QB sa final Undetime		
		$objDaysUnd = mysql_query("SELECT dtrDate, inAM, outAM, inPM, outPM, remarks, otherInfo FROM tblEmpDTR 
										WHERE empNumber = '$t_strEmpNmbr'  
											AND dtrDate LIKE '$strMonthYear%' 
										ORDER BY dtrDate");
			
		while($arrDaysUnd = mysql_fetch_array($objDaysUnd))
		{
			if($arrDaysUnd['inAM'] != NULLTIME && $arrDaysUnd['outPM'] != NULLTIME)   //inAM outPM
			{
				if($arrDaysUnd['inAM'] <= $dtmOfficialTimeInTo && $arrDaysUnd['outPM'] < $dtmOfficialTimeOutTo)
				{   //not late but undertime
					$this->intWorkTime = WORKTIME + 3600;   //9 hours
					$this->getDaysUndertime($arrDaysUnd['inAM'], "AM", $arrDaysUnd['outPM'], "PM", $arrDaysUnd['dtrDate']);
				}
				elseif($arrDaysUnd['inAM'] > $dtmOfficialTimeInTo && $arrDaysUnd['outPM'] < $dtmOfficialTimeOutTo)
				{   //late and undertime
					$this->intWorkTime = WORKTIME + 3600;   //9 hours
					$this->getDaysUndertime($dtmOfficialTimeInTo, "AM", $arrDaysUnd['outPM'], "PM", $arrDaysUnd['dtrDate']);					
				}
			}
			elseif ($arrDaysUnd['inAM'] != NULLTIME && $arrDaysUnd['outAM'] != NULLTIME)  //half day morning
			{		
				if($arrDaysUnd['remarks'] == 'QB' || $arrDaysUnd['remarks'] == 'OB')
				{
					$objQB = mysql_query("SELECT obID, obTimeFrom, obTimeTo FROM tblEmpOB
									WHERE obID = '".$arrDaysUnd["otherInfo"]."'");
					$arrQB = mysql_fetch_array($objQB);
					$strQBAMPMFrom = date('A', strtotime($arrQB["obTimeFrom"]));
					$strQBAMPMTo = date('A', strtotime($arrQB["obTimeTo"]));
				}
			
				if ($arrDaysUnd['inAM'] < $dtmOfficialTimeInFrom)
				{
					$dtmInAM =  $dtmOfficialTimeInFrom;
				}
				else
				{
					$dtmInAM = $arrDaysUnd['inAM'];
				}
				
				if($arrDaysUnd['outAM'] < "12:00:00")
				{
					$strAMPM = "AM";
				}
				elseif($arrDaysUnd['outAM'] >= "12:00:00")
				{
					$strAMPM = "PM";
				}
				$this->intWorkTime = WORKTIME;

				if($arrDaysUnd['remarks'] != 'QB' && $arrDaysUnd['remarks'] != 'OB')
				{
					$this->getDaysUndertime($arrDaysUnd['inAM'], "AM", $arrDaysUnd['outAM'], $strAMPM, $arrDaysUnd['dtrDate']);
				}
				else
				{
					$this->getDaysUndertime($arrDaysUnd['inAM'], $strQBAMPMFrom, $arrDaysUnd['outAM'], $strQBAMPMTo, $arrDaysUnd['dtrDate']);
				}
			}
			elseif ($arrDaysUnd['inPM'] != NULLTIME && $arrDaysUnd['outPM'] != NULLTIME)  //halfday afternon
			{			
				if ($arrDaysUnd['outPM'] > $dtmOfficialTimeOutTo)   //6:00:00 afternoon to
				{
					$dtmOutPM = $dtmOfficialTimeOutTo;   //6:00:00 afternoon to
				}
				else
				{
					$dtmOutPM = $arrDaysUnd['outPM'];
				}
					$this->intWorkTime = WORKTIME;
					$this->getDaysUndertime($arrDaysUnd['inPM'], "PM", $dtmOutPM, "PM", $arrDaysUnd['dtrDate']);			
			}			
		}
		
		$this->dtmUndHours = $this->dtmUndHours + $intQB;
		
		return substr($this->strNmbrDays, 0, -2);
	}
	
	function getDaysUndertime($t_dtmTimeIn, $t_strInAMPM, $t_dtmTimeOut, $t_strOutAMPM,  $t_dtmDate)
	{   //get hours work in a day
		$strTimeIn = $this->combineTime($t_dtmTimeIn, $t_strInAMPM);
		$strTimeOut = $this->combineTime($t_dtmTimeOut, $t_strOutAMPM);
		$dtmTimeDiff = strtotime($strTimeOut) - strtotime($strTimeIn);   // in seconds
		$this->getUndertime($dtmTimeDiff, $t_dtmDate);
	}
	
	function getUndertime($t_dtmTimeDiff, $t_dtmDate)
	{    //less the hours work in a day in 9 hours
		if ($t_dtmTimeDiff < $this->intWorkTime)
		{
			$intDay = substr($t_dtmDate, -2);   //get the day
			$strValueInsd = strstr($this->strNmbrDays, $intDay);   //para d magprint ng dalawang 
			// date kailangan ma trap ung isa...
			if(strlen($strValueInsd) == 0)
			{
				$this->strNmbrDays = $this->strNmbrDays.$intDay.", ";
			}
			
			$dtmUndTime = $this->intWorkTime - $t_dtmTimeDiff;   //para makuha ung undertime
			$this->dtmUndHours = $this->dtmUndHours + $dtmUndTime;   //minus mo ung time in-out sa 8 hours
		}
	}
	
	function getTotalUnd()
	{
		$this->dtmUndHours = $this->dtmUndHours/60/60;   //converts in hours
		$this->dtmUndHours = number_format($this->dtmUndHours, 2, ".", "");
		return $this->dtmUndHours;
	
	}
	
	function getHourQB($t_strMonth, $t_strYear, $t_strEmpNmbr)
	{   //un na mismo ung time kaya plus lng ng plus. monthly
		$intHourQB = 0;	    
	   	$strMonthYear = $this->combineMonthYear($t_strYear, $t_strMonth);
		$objQBDTR = mysql_query("SELECT dtrDate, otherInfo FROM tblEmpDTR 
										WHERE empNumber = '$t_strEmpNmbr'  
											AND dtrDate LIKE '$strMonthYear%'
											AND remarks = '".QUASI."'
										ORDER BY dtrDate");
		while($arrQBDTR = mysql_fetch_array($objQBDTR))
		{
			$dtmDay = date("d",strtotime($arrQBDTR['dtrDate']));
			
			$objQB = mysql_query("SELECT obID, obTimeFrom, obTimeTo FROM tblEmpOB
									WHERE obID = '".$arrQBDTR["otherInfo"]."'");
			$arrQB = mysql_fetch_array($objQB);
			
			$dtmDateDiff = strtotime($arrQB["obTimeTo"]) - strtotime($arrQB["obTimeFrom"]);

			if($dtmDateDiff >= WORKTIME)
			{
				$dtmDateDiff = WORKTIME;
			}
			$intHourQB = $intHourQB + $dtmDateDiff;  
			
			$strValueInsd = strstr($this->strNmbrDays, $dtmDay);   //para d magprint ng dalawang 
			// date kailangan ma trap ung isa...
			if(strlen($strValueInsd) == 0)
			{
				$this->strNmbrDays = $this->strNmbrDays.$dtmDay.", ";
			}
		}
		return $intHourQB;
	}
	
	function resetdtmUndHours()
	{
		$this->dtmUndHours = 0;
	}
	

//------------------------------------------ Late Undertime function --------------------------------------
	function getLateUndPrDay($t_strEmpNmbr, $t_dtmDate, $t_arrDTR='')
	{ //$t_strReturn values: both, late, undertime
		
		if(is_array($t_arrDTR) == 0)
		{
			$objEmpDTR = mysql_query("SELECT * FROM tblEmpDTR 
									WHERE dtrDate='$t_dtmDate'
										AND empNumber='$t_strEmpNmbr'");
		
			$intEmpDTR = mysql_num_rows($objEmpDTR);
		}
		else
		{
			$intEmpDTR = count($t_arrDTR);
		}
		
		if($intEmpDTR != 0)
		{
			if(is_array($t_arrDTR) == 0)
			{
				$arrEmpDTR = mysql_fetch_array($objEmpDTR);
			}
			else
			{
				$arrEmpDTR = $t_arrDTR;
			}
			
			$strDay = date("D", strtotime($arrEmpDTR["dtrDate"]));
			
			if($strDay != "Sun" && $strDay != "Sat")
			{				
				$blnRmrk1 = $arrEmpDTR["remarks"] != TRIPTICKET && $arrEmpDTR["remarks"] != TRAVELORDER;
				$blnRmrk2 = $arrEmpDTR["remarks"] != HVACLEAVE && $arrEmpDTR["remarks"] != HSICKLEAVE;
				$blnRmrk3 = $arrEmpDTR["remarks"] != HFORCELEAVE && $arrEmpDTR["remarks"] != HPRIVLEAVE;
				$blnRmrk = $blnRmrk1 && $blnRmrk2 && $blnRmrk3;
				
				if($blnRmrk)
				{
					$dtmSchmTmOutPmTo = $this->getOfficialTimeOut("end", $t_strEmpNmbr);
					$dtmSchmTmInAmFrm = $this->getOfficialTimeIn("begin", $t_strEmpNmbr);
					
					$dtmOffSchmTmInAmTo = $this->getOfficialTimeIn("end", $t_strEmpNmbr);  //official morning time in
					$dtmGpSchmTmInAmTo = $this->getOfficialTimeIn("end", $t_strEmpNmbr, 0);  //grace period morning
	
					$dtmOffSchmTmInPmTo = $this->getOfficialTimeInNoon("end", $t_strEmpNmbr);  //official afternoon time in
					$dtmGpSchmTmInPmTo = $this->getOfficialTimeInNoon("end", $t_strEmpNmbr, 0);  //grace period afternoon
					
					$objOfficialTime = mysql_query("SELECT tblAttendanceScheme.hlfLateUnd, tblAttendanceScheme.wrkhrLeave 
										FROM tblAttendanceScheme
										INNER JOIN tblEmpPosition 
											ON tblAttendanceScheme.schemeCode = tblEmpPosition.schemeCode
										WHERE tblEmpPosition.empNumber = '$t_strEmpNmbr'");
					$arrSchmTm = mysql_fetch_array($objOfficialTime);   //get the official values to attandance scheme for condition
					
					$dtmLateUndDisplay = $this->computeLateUndPrDay($dtmSchmTmOutPmTo, $dtmSchmTmInAmFrm, $dtmOffSchmTmInAmTo, $dtmGpSchmTmInAmTo, $dtmOffSchmTmInPmTo, $dtmGpSchmTmInPmTo, $arrSchmTm["hlfLateUnd"], $arrSchmTm["wrkhrLeave"], $t_arrDTR, 'display');
					$dtmLateUndCompute = $this->computeLateUndPrDay($dtmSchmTmOutPmTo, $dtmSchmTmInAmFrm, $dtmOffSchmTmInAmTo, $dtmGpSchmTmInAmTo, $dtmOffSchmTmInPmTo, $dtmGpSchmTmInPmTo, $arrSchmTm["hlfLateUnd"], $arrSchmTm["wrkhrLeave"], $t_arrDTR, 'compute');
					$dtmLateUndCount = $this->computeLateUndPrDay($dtmSchmTmOutPmTo, $dtmSchmTmInAmFrm, $dtmOffSchmTmInAmTo, $dtmGpSchmTmInAmTo, $dtmOffSchmTmInPmTo, $dtmGpSchmTmInPmTo, $arrSchmTm["hlfLateUnd"], $arrSchmTm["wrkhrLeave"], $t_arrDTR, 'count');
					
					if($dtmLateUndCount)
					{
						$strLateUndDay = date("d", $arrEmpDTR["dtrDate"]);
					}
					else
					{
						$strLateUndDay = "";
					}
					
					$arrLateUnd = array("count"=>$dtmLateUndCount, "compute"=>$dtmLateUndCompute, "display"=>$dtmLateUndDisplay, "day"=>$strLateUndDay);
					return $arrLateUnd;
				}
			}
		}		
	}
	
	function computeLateUndPrDay($t_dtmSchmTmOutPmTo, $t_dtmSchmTmInAmFrm, $t_dtmOffSchmTmInAmTo, $t_dtmGpSchmTmInAmTo, $t_dtmOffSchmTmInPmTo, $t_dtmGpSchmTmInPmTo, $t_blnHlfLateUnd, $t_intWrkLeave, $t_arrDTR, $t_strReturn='display')
	{   /* this function is computation of tardy undertime.   computeLateUndPrDay(7:00, 6:00, 9:00, 9:15, 1:00, 1:15, array that contains dtrDate, display/count/compute)*/
		$blnTime1 = $this->getBooleanInOut($t_arrDTR["inAM"], $t_arrDTR["outAM"]);   //record of morning
		$blnTime2 = $this->getBooleanInOut($t_arrDTR["inPM"], $t_arrDTR["outPM"]);   //record of afternoon
		$blnTime3 = $this->getBooleanInOut($t_arrDTR["inAM"], $t_arrDTR["outPM"]);   //record of morning in and afternoon out
				
		if($blnTime1 && $blnTime2)   //complte time in out 4 fields
		{
			$dtmInAm = $t_arrDTR["inAM"];
			$dtmOutAm = $t_arrDTR["outAM"];
			$dtmInPm = $t_arrDTR["inPM"];
			$dtmOutPm = $t_arrDTR["outPM"];
			
			if($t_arrDTR["inAM"] < $t_dtmSchmTmInAmFrm)   //less than 7:00 in
			{  
				$dtmInAm = $t_dtmSchmTmInAmFrm;   //should be replaced by 7:00
			}
			
			if($t_arrDTR["outPM"] > $t_dtmSchmTmOutPmTo)    //more than 6:00 out
			{
				$dtmOutPm = $t_dtmSchmTmOutPmTo;   //should be replaced by 6:00
			}
			
			if($t_strReturn == "count")   //we must apply the grace period on tardy count
			{
				if($t_arrDTR["inAM"] > $t_dtmOffSchmTmInAmTo && $t_arrDTR["inAM"] <= $t_dtmGpSchmTmInAmTo)
				{    //means that more than 9:00 but less than 9:15 grace period
					$dtmInAm = $t_dtmOffSchmTmInAmTo;
				}
				
				if($t_arrDTR["inPM"] > $t_dtmOffSchmTmInPmTo && $t_arrDTR["inPM"] <= $t_dtmGpSchmTmInPmTo)
				{   //means that more than 1:00 but less than 1:15 grace period
					$dtmInPm = $t_dtmOffSchmTmInPmTo;
				}
			}
			
			$dtmInAm = $this->combineTime($dtmInAm, AM);
			if($dtmOutAm < NOON && $dtmOutAm > $t_dtmSchmTmOutPmTo) 
			{   //outam is less than 12:00 and more than 6:00 means it is in am
				$dtmOutAm = $this->combineTime($dtmOutAm, AM);
			}
			else
			{   //equal or morethan 12:00 or 1:00 or 2:00 ...
				$dtmOutAm = $this->combineTime($dtmOutAm, PM);
			}
			$dtmInPm = $this->combineTime($dtmInPm, PM);
			$dtmOutPm = $this->combineTime($dtmOutPm, PM);			
			
			$dtmWorkAm = strtotime($dtmOutAm) - strtotime($dtmInAm);   //get hours work in am
			$dtmWorkPm = strtotime($dtmOutPm) - strtotime($dtmInPm);   //get hours work in pm
			
			$dtmWork = $dtmWorkAm + $dtmWorkPm;      //get hours work
			if($dtmInPm == NOON)
			{   //noon = 12:00 must be 1 hour less 
				$intWorkHour = 9;   //get the applicable work hours
			}
			else
			{   //noon > 12:00
				$intWorkHour = 8;   //less 8 because using 9 will appear they are undertime
			}
		}
		elseif($blnTime3)
		{
			$dtmIn = $t_arrDTR["inAM"];
			$dtmOut = $t_arrDTR["outPM"];
			
			if($t_arrDTR["inAM"] < $t_dtmSchmTmInAmFrm)   //less than 7:00 in
			{  
				$dtmIn = $t_dtmSchmTmInAmFrm;   //should be replaced by 7:00
			}
			
			if($t_arrDTR["outPM"] > $t_dtmSchmTmOutPmTo)    //more than 6:00 out
			{
				$dtmOut = $t_dtmSchmTmOutPmTo;   //should be replaced by 6:00
			}
			
			if($t_strReturn == "count")   //we must apply the grace period on tardy count
			{
				if($t_arrDTR["inAM"] > $t_dtmOffSchmTmInAmTo && $t_arrDTR["inAM"] <= $t_dtmGpSchmTmInAmTo)
				{    //means that more than 9:00 but less than 9:15 grace period
					$dtmIn = $t_dtmOffSchmTmInAmTo;
				}
			}

			$dtmIn = $this->combineTime($dtmIn, AM);  
			$dtmOut = $this->combineTime($dtmOut, PM);
			
			$dtmWork = strtotime($dtmOut) - strtotime($dtmIn);  //gets the hours work
			$intWorkHour = 9;   //less 8 hours plus 1 hour for break
		}
		elseif($t_blnHlfLateUnd == "Y")
		{
			if($blnTime1)
			{
				$dtmInAm = $t_arrDTR["inAM"];
				$dtmOutAm = $t_arrDTR["outAM"];
				
				if($t_arrDTR["inAM"] < $t_dtmSchmTmInAmFrm)   //less than 7:00 in
				{  
					$dtmInAm = $t_dtmSchmTmInAmFrm;   //should be replaced by 7:00
				}
				
				if($t_strReturn == "count")   //we must apply the grace period on tardy count
				{
					if($t_arrDTR["inAM"] > $t_dtmOffSchmTmInAmTo && $t_arrDTR["inAM"] <= $t_dtmGpSchmTmInAmTo)
					{    //means that more than 9:00 but less than 9:15 grace period
						$dtmInAm = $t_dtmOffSchmTmInAmTo;
					}
				}
				
				$dtmInAm = $this->combineTime($dtmInAm, AM);
				if($dtmOutAm < NOON && $dtmOutAm > $t_dtmSchmTmOutPmTo)
				{
					$dtmOutAm = $this->combineTime($dtmOutAm, AM);
				}
				else
				{
					$dtmOutAm = $this->combineTime($dtmOutAm, PM);
				}

				$dtmWork = strtotime($dtmOutAm) - strtotime($dtmInAm);
				$intWorkHour = 8;
			}
			elseif($blnTime2)
			{
				$dtmInPm = $t_arrDTR["inPM"];
				$dtmOutPm = $t_arrDTR["outPM"];
				
				if($t_arrDTR["outPM"] > $t_dtmSchmTmOutPmTo)    //more than 6:00 out
				{
					$dtmOutPm = $t_dtmSchmTmOutPmTo;   //should be replaced by 6:00
				}
				
				if($t_strReturn == "count")   //we must apply the grace period on tardy count
				{
					if($t_arrDTR["inPM"] > $t_dtmOffSchmTmInPmTo && $t_arrDTR["inPM"] <= $t_dtmGpSchmTmInPmTo)
					{   //means that more than 1:00 but less than 1:15 grace period
						$dtmInPm = $t_dtmOffSchmTmInPmTo;
					}
				}
				
				$dtmInPm = $this->combineTime($dtmInPm, PM);
				$dtmOutPm = $this->combineTime($dtmOutPm, PM);			
				
				$dtmWork = strtotime($dtmOutPm) - strtotime($dtmInPm);

				if($dtmInPm == NOON)
				{
					$intWorkHour = 9;
				}
				else
				{
					$intWorkHour = 8;
				}
			}
			else
			{
				$dtmWork = 0;
				$intWorkHour = 0;
			}
		}
		else
		{
			$dtmWork = 0;
			$intWorkHour = 0;
		}
		
		$dtmWork = $dtmWork/60/60;
		if($dtmWork < $intWorkHour && $dtmWork > $t_intWrkLeave)
		{
			$dtmLateUnd = $intWorkHour - $dtmWork;   //official work hour less work hour
			if($dtmLateUnd != 0)
			{
				if($t_strReturn == "count")
				{
					return 1;   //the count 
				}
				elseif($t_strReturn == "compute")
				{
					return $dtmLateUnd;   //returns in computation format in hours
				}
				elseif($t_strReturn == "display")
				{
					return $this->diplayHrMinSec($dtmLateUnd);  //returns in format hh:mm:ss
				}
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	
	function getBooleanInOut($t_dtmField1, $t_dtmField2)
	{
		$blnTime = ($t_dtmField1 != NULLTIME) && ($t_dtmField2 != NULLTIME);
		return $blnTime;
	}

	function getLateUndPrMonth($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_arrDTR='')
	{
		if(is_array($t_arrDTR) == 0)
		{
			$t_arrDTR = $this->getEmpDTR($t_strEmpNmbr, $t_intMonth, $t_intYear);
		}
		
		$intLateUndHour = 0;
		$intLateUndCount = 0;
		$strLateUndDay = "";
		
		for($intCtr = 0; $intCtr < count($t_arrDTR); $intCtr++)
		{
			$arrLateUnd = $this->getLateUndPrDay($t_strEmpNmbr, "", $t_arrDTR[$intCtr]);
			
			$intLateUndHour = $intLateUndHour + $arrLateUnd["compute"];
			
			$intLateUndCount = $intLateUndCount + $arrLateUnd["count"];
			
			$strLateUndDay = $strLateUndDay.$arrLateUnd["day"]." ";
		}
		
		$strDisplayTime = $this->diplayHrMinSec($intLateUndHour);
		
		$arrLateUndPrMonth = array("count"=>$intLateUndCount, "display"=>$strDisplayTime, "day"=>$strLateUndDay);
		
		return $arrLateUndPrMonth;	
	}
//------------------------------------------ display function --------------------------------------
	function diplayHrMinSec($t_intHr)
	{
		$intHrInteger = intval($t_intHr);
		
		$intMin = $t_intHr - $intHrInteger;
		$intMin = $intMin * 60;
		$intMinInteger = intval($intMin);
		
		$intSec = $intMin - $intMinInteger;
		$intSec = $intSec * 60;
		$intSecInteger = round($intSec);
		
		if($intSecInteger == 60)
		{
			$intSecInteger = 0;
			$intMinInteger = $intMinInteger + 1;
		}
		elseif($intMinInteger == 60)
		{
			$intMinInteger = 0;
			$intHrInteger = $intHrInteger + 1;
		}
		
		return $intHrInteger.":".$intMinInteger.":".$intSecInteger;
	}

//------------------------------------------ work hour --------------------------------------
	function getWrkHrPrDay($t_strEmpNmbr, $t_dtmDate, $t_blnDisplay='1', $t_arrDTR='')
	{
		if(is_array($t_arrDTR) == 0)
		{
			$objEmpDTR = mysql_query("SELECT * FROM tblEmpDTR 
									WHERE dtrDAte='$t_dtmDate'
										AND empNumber='$t_strEmpNmbr'");
			$intEmpDTR = mysql_num_rows($objEmpDTR);
		}
		else
		{
			$intEmpDTR = count($t_arrDTR);
		}

		if($intEmpDTR != 0)
		{
			if(is_array($t_arrDTR) == 0)
			{
				$arrEmpDTR = mysql_fetch_array($objEmpDTR);   //if array pass not existing
			}
			else
			{
				$arrEmpDTR = $t_arrDTR;   //if array pass exist
			}

			$strDay = date("D", strtotime($arrEmpDTR["dtrDate"]));
			
			if($strDay != "Sun" && $strDay != "Sat")
			{
			
				if($arrEmpDTR["remarks"] == TRIPTICKET || $arrEmpDTR["remarks"] == TRAVELORDER)
				{
					return WORKHOURS;
				}
				else
				{
					if($arrEmpDTR["inAM"] != NULLTIME && $arrEmpDTR["outPM"] != NULLTIME)
					{
						if($arrEmpDTR["outAM"] < NOON)
						{   //for time 9:00 - 11:00  01:00 - 6:00 time computation for 9:00 am - 11:00 am plus 01:00 - 6:00 computation
							$intHrAM = $this->computeWrkHrPrDay($arrEmpDTR["inAM"], AM, $arrEmpDTR["outAM"], AM);	
							if($arrEmpDTR["inPM"] >= NOON && $arrEmpDTR["inPM"] <= LATE_NOON)
							{

								$intHrPM = $this->computeWrkHrPrDay($arrEmpDTR["inPM"], PM, $arrEmpDTR["outPM"], PM, "1");
							}
							else
							{
								$intHrPM = $this->computeWrkHrPrDay($arrEmpDTR["inPM"], PM, $arrEmpDTR["outPM"], PM);
							}
							$intHr = $intHrAM + $intHrPM;
						}
						else
						{   //for 09:00am - 06:00pm computation minus the afternun late
							$intHr = $this->computeWrkHrPrDay($arrEmpDTR["inAM"], AM, $arrEmpDTR["outPM"], PM, "1");
							$intTardy = $this->getLateUndPrDay($t_strEmpNmbr, $t_dtmDate, "late pm", 0, 1, $arrEmpDTR);   //get the tardy afternun
							$intHr = $intHr - $intTardy;
						}
					}
					elseif($arrEmpDTR["inAM"] != NULLTIME && $arrEmpDTR["outAM"] != NULLTIME)
					{
						if($arrEmpDTR["outAM"] >= NOON || $arrEmpDTR["outAM"] < "05:00:00")
						{
							$intHr = $this->computeWrkHrPrDay($arrEmpDTR["inAM"], AM, $arrEmpDTR["outAM"], PM);
						}
						else
						{
							$intHr = $this->computeWrkHrPrDay($arrEmpDTR["inAM"], AM, $arrEmpDTR["outAM"], AM);
						}
					}
					elseif($arrEmpDTR["inPM"] != NULLTIME && $arrEmpDTR["outPM"] != NULLTIME)
					{
						if($arrEmpDTR["inPM"] >= NOON && $arrEmpDTR["inPM"] <= LATE_NOON)
						{
							$intHr = $this->computeWrkHrPrDay($arrEmpDTR["inPM"], PM, $arrEmpDTR["outPM"], PM, 1);
						}
						else
						{
							$intHr = $this->computeWrkHrPrDay($arrEmpDTR["inPM"], PM, $arrEmpDTR["outPM"], PM);
						}
					}
					else
					{
						return "";
					}
					
					if($t_blnDisplay)
					{
						$strTimeDisplay = $this->diplayHrMinSec($intHr);
						return $strTimeDisplay;
					}
					else
					{
						return $intHr;
					}
				}
			}
		}
	}
	
	function computeWrkHrPrDay($t_dtmTimeIn, $t_strTimeIn, $t_dtmTimeOut, $t_strTimeOut, $t_blnHourLess='0')
	{
		$strTimeIn = $this->combineTime($t_dtmTimeIn, $t_strTimeIn);
		$strTimeOut = $this->combineTime($t_dtmTimeOut, $t_strTimeOut);
	
		$dtmDateDiff = strtotime($strTimeOut) - strtotime($strTimeIn);
		$dtmHour = $dtmDateDiff/60/60;
		
		if($t_blnHourLess)
		{
			$dtmHour = $dtmHour - 1;
		}
		
		return $dtmHour;
	}
	
	function getWrkHrPrMonth($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_arrDTR='')
	{	
		if(is_array($t_arrDTR) == 0)
		{
			$t_arrDTR = $this->getEmpDTR($t_strEmpNmbr, $t_intMonth, $t_intYear);
		}

		$intHrTotal = 0;

		for($intCtr = 0; $intCtr < count($t_arrDTR); $intCtr++)
		{
			$intHours = $this->getWrkHrPrDay($t_strEmpNmbr, "", 0, $t_arrDTR[$intCtr]); //actually $dtmDate value is nevermind
			$intHrTotal = $intHrTotal + $intHours;
		}
		
		$strDisplayTime = $this->diplayHrMinSec($intHrTotal);
		return $strDisplayTime;
	}
//------------------------------------------ excess --------------------------------------
	function getExcessPrDay($t_strEmpNmbr, $t_dtmDate, $t_blnDisplay='1', $t_arrDTR='')
	{
		$intHrs = $this->getWrkHrPrDay($t_strEmpNmbr, $t_dtmDate, 0, $t_arrDTR);
		if($intHrs > WORKHOURS)
		{
			$intHrs = $intHrs - WORKHOURS;
		}
		else
		{
			return "";
		}
		
		if($t_blnDisplay)
		{
			$strDisplayTime = $this->diplayHrMinSec($intHrs);
			return $strDisplayTime;
		}
		else
		{
			return $intHrs;
		}
	}
	
	function getExcessPrMonth($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_arrDTR='')
	{
		if(is_array($t_arrDTR) == 0)
		{
			$t_arrDTR = $this->getEmpDTR($t_strEmpNmbr, $t_intMonth, $t_intYear);
		}

		$intExcessTotal = 0;
		
		for($intCtr = 0; $intCtr < count($t_arrDTR); $intCtr++)
		{
			$strDay = date("D", strtotime($arrEmpDTR["dtrDate"]));
			
			if($strDay != "Sun" && $strDay != "Sat")
			{
				$intExcess = $this->getExcessPrDay($t_strEmpNmbr, "", 0, $t_arrDTR[$intCtr]);
				$intExcessTotal = $intExcessTotal + $intExcess;
			}
		}
		
		$strDisplayTime = $this->diplayHrMinSec($intExcessTotal);
		return $strDisplayTime;	
	}
//-------------------------------------- overtime -----------------------------------------------------

	function getOvrtmPrDay($t_strEmpNmbr, $t_dtmDate, $t_blnDisplay='1', $t_arrDTR='')
	{
		if(is_array($t_arrDTR) == 0)
		{
			$objEmpDTR = mysql_query("SELECT * FROM tblEmpDTR 
									WHERE dtrDate='$t_dtmDate'
										AND empNumber='$t_strEmpNmbr'
										AND remarks='".OVERTIME."'");
			$intEmpDTR = mysql_num_rows($objEmpDTR);
		}
		else
		{
			if(count($t_arrDTR))
			{
				if($t_arrDTR['remarks'] == 'OT')
				{
					$intEmpDTR = 1;
				}
				else
				{
					$intEmpDTR = 0;
				}
			}
			else
			{
				$intEmpDTR = 0;
			}
		}

		if($intEmpDTR != 0)
		{
			if(is_array($t_arrDTR) == 0)
			{
				$arrEmpDTR = mysql_fetch_array($objEmpDTR);   //if array pass not existing
			}
			else
			{
				$arrEmpDTR = $t_arrDTR;   //if array pass exist
			}

			$strDay = date("D", strtotime($arrEmpDTR["dtrDate"]));
			
			if($strDay == 'Sun' || $strDay == 'Sat')
			{
				if($arrEmpDTR["outAM"] >= NOON)
				{
					$strAMPM = PM;
				}
				else
				{
					$strAMPM = AM;
				}
				$intHrAM = $this->computeWrkHrPrDay($arrEmpDTR["inAM"], AM, $arrEmpDTR["outAM"], $strAMPM);
				$intHrPM = $this->computeWrkHrPrDay($arrEmpDTR["inPM"], PM, $arrEmpDTR["outPM"], PM);
				$intHr = $intHrAM + $intHrPM;
			}
			else
			{
				$intHr = $this->computeWrkHrPrDay($arrEmpDTR["inOT"], PM, $arrEmpDTR["outOT"], PM);
			}
	
			if($t_blnDisplay)
			{
				$strDisplayTime = $this->diplayHrMinSec($intHr);
				return $strDisplayTime;
			}
			else
			{
				return $intHr;
			}
		}
		else
		{
			if($t_blnDisplay)
			{
				return "";
			}
			else
			{
				return 0;
			}
		}
	}
	
	function getOvrtmPrMonth($t_strEmpNmbr, $t_intMonth, $t_intYear, $t_arrDTR='')
	{
		if(is_array($t_arrDTR) == 0)
		{
			$t_arrDTR = $this->getEmpDTR($t_strEmpNmbr, $t_intMonth, $t_intYear);
		}
		
		$intOvrtmTotal = 0;
		
		for($intCtr = 0; $intCtr < count($t_arrDTR); $intCtr++)
		{
			$intOvrtm = $this->getOvrtmPrDay($t_strEmpNmbr, "", 0, $t_arrDTR[$intCtr]);
			$intOvrtmTotal = $intOvrtmTotal + $intOvrtm;
		}
		
		$strDisplayTime = $this->diplayHrMinSec($intOvrtmTotal);
		return $strDisplayTime;	
	}
//------------------------------ get query --------------------------------------------------------

	function getEmpDTR($t_strEmpNmbr, $t_intMonth, $t_intYear)
	{
		$dtmDate = $this->combineMonthYear($t_intYear, $t_intMonth);
		$objDTR = mysql_query("SELECT *
								FROM tblEmpDTR 
								WHERE empNumber = '$t_strEmpNmbr'
									AND dtrDate LIKE '$dtmDate%'
								ORDER BY dtrDate");
		
		if(mysql_num_rows($objDTR))
		{
			while($arrDTR = mysql_fetch_array($objDTR))
			{
				$arrLeaveBalance[] = array("dtrDate"=>$arrDTR['dtrDate'], "inAM"=>$arrDTR['inAM'],
					"outAM"=>$arrDTR['outAM'], "inPM"=>$arrDTR['inPM'], "outPM"=>$arrDTR['outPM'],
					"inOT"=>$arrDTR['inOT'], "outOT"=>$arrDTR['outOT'], "remarks"=>$arrDTR['remarks'], 
					"otherInfo"=>$arrDTR['otherInfo']);
			}
			
			return $arrLeaveBalance;
		}
		else
		{
			$arrDTR = array();
			return $arrDTR;
		}
	}

	function getEmpDTRPrDay($t_strEmpNmbr, $t_dtmDate)
	{
		$objDTR = mysql_query("SELECT *
								FROM tblEmpDTR 
								WHERE empNumber = '$t_strEmpNmbr'
									AND dtrDate = '$t_dtmDate'
								ORDER BY dtrDate");
		
		if(mysql_num_rows($objDTR))
		{
			$arrDTR = mysql_fetch_array($objDTR);
			return $arrDTR;
		}
		else
		{
			$arrDTR = array();
			return $arrDTR;		
		}
	}

}
?>