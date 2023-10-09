<?
include("../hrmis/class/adodb-time.inc.php");
require("../hrmis/class/Attendance.php");
class PreviousDayYr extends Attendance
{

	function PreviousDayYr()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection		
	}
	
	function getPrevDayYr($t_prevYear, $t_prevMonth, $t_prevDay)
	{
		$prevMnthYr = $this->getPreMonth($t_prevMonth,$t_prevYear);
		$prevMonth = $prevMnthYr["month"];
		$prevYear = $prevMnthYr["year"];
		$dtmDateCombine = $this->combineDate($prevYear, $prevMonth,"01");
		$intPrevTotalDays = adodb_date("t", strtotime($dtmDateCombine));
		$prevDayTotalDays = $intPrevTotalDays;
		$dtmDateCombineRet = $this->combineDate($prevYear, $prevMonth, $prevDayTotalDays);
		return $dtmDateCombineRet;
	}
}
?>