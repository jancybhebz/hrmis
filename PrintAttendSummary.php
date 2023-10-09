<?
require("../hrmis/class/Attendance.php");
$objAttendance = new Attendance;
$arrEmpPersonal = $objAttendance->getEmpInfo($strEmpNmbr);
$strMonthName = $objAttendance->intToMonthFull($strMonth);
?>		
<html>
<head>
<title>Attendance Summary</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="report.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="window.print()">
<table width="590" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> 
    <td height="35" colspan="4" align="center" valign="middle" class="title">Attendance Summary</td>
  </tr>
  <tr> 
    <td width="120" height="24" align="right" valign="middle" class="subtitle">Employee Number:&nbsp;</td>
    <td width="100" class="titlebar"><? echo $arrEmpPersonal["empNumber"];?></td>
    <td width="80" align="right" valign="middle" class="subtitle">Name:&nbsp;</td>
    <td width="190" class="titlebar"><? echo $arrEmpPersonal["surname"].", ".$arrEmpPersonal["firstname"]?></td>
  </tr>
  <tr> 
    <td width="120" height="24" align="right" valign="middle" class="subtitle">Division:&nbsp;</td>
    <td width="150" class="titlebar"><? echo $arrEmpPersonal["divisionCode"];?></td>
    <td width="80" align="right" valign="middle" class="subtitle">Pay Ending:&nbsp;</td>
    <td width="240" class="titlebar"><? echo $strMonthName." ".$strYear?></td>
  </tr>
  <tr><td colspan="4" height="10"></td></tr>
  <tr> 
    <td colspan="4" valign="top">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="titlebar" style="border-collapse: collapse" Bordercolor="#CCCCCC">
	  <? 
	  $strDaysAbs = $objAttendance->daysAbsent($strMonth, $strYear, $arrEmpPersonal["empNumber"]);
	  if ($strDaysAbs)
	  {
		$intDaysAbs = $objAttendance->getTotalAbs();
	  }
	  else
	  {
		$strDaysAbs = "XXXX";	
		$intDaysAbs = "0";
	  }
	  ?>
		  <tr> 
			<td align="right" class="radio" width="200" height="20">Days Absent:&nbsp;&nbsp;</td>
			<td width="390"><? echo  $strDaysAbs?></td>
		  </tr>
		  <tr> 
			<td align="right" class="radio" width="200" height="20">Number of Absent:&nbsp;&nbsp;</td>
			<td><? echo $intDaysAbs?></td>
		  </tr>									  									  
		  <?
		  $strDaysLate = $objAttendance->daysLate($strMonth, $strYear, $arrEmpPersonal["empNumber"]);
		  if($strDaysLate)
		  {
			$strHoursLate = $objAttendance->getTotalLate();									  
		  }
		  else
		  {
			$strDaysLate = "XXXX";
			$strHoursLate = "0";
		  }
		  ?>									  									  
		  <tr> 
			<td align="right" class="radio" width="200" height="20">Days Late:&nbsp;&nbsp;</td>
			<td>
			<? 
			echo $strDaysLate;
			?></td>
		  </tr>
		  <tr> 
			<td align="right" class="radio" width="200" height="20">Hours Late:&nbsp;&nbsp;</td>
			<td>
			<? 
			echo $strHoursLate;
			?></td>
		  </tr>
		  <?
		  $strUndDays = $objAttendance->daysUndertime($strMonth, $strYear, $arrEmpPersonal["empNumber"]);
		  if ($strUndDays)
		  {
			$strUndHours = $objAttendance->getTotalUnd();
		  }
		  else
		  {
			$strUndDays = "XXXX";
			$strUndHours = "0";
		  }
		  ?>
		  <tr> 
			<td align="right" class="radio" width="200" height="20">Days Undertime:&nbsp;&nbsp;</td>
			<td><? echo $strUndDays?></td>
		  </tr>
		  <tr> 
			<td align="right" class="radio" width="200" height="20">Hours Undertime:&nbsp;&nbsp;</td>
			<td><? echo $strUndHours?></td>
		  </tr>
		  <?
			$intVL = $objAttendance->getSLVL($strMonth, $strYear, $arrEmpPersonal["empNumber"], "VL");
			if($intVL == "")
			{
				$intVL = "0";
			}
		  ?>
		  <tr> 
			<td align="right" class="radio" width="200" height="20">Vacation Leave Left:&nbsp;&nbsp;</td>
			<td><? echo $intVL?></td>
		  </tr>
		  <?
			$intSL = $objAttendance->getSLVL($strMonth, $strYear, $arrEmpPersonal["empNumber"], "SL");									  
			if($intSL == "")
			{
				$intSL = "0";						
			}
		  ?>
		  <tr> 
			<td align="right" class="radio" width="200" height="20"> Sick Leave Left:&nbsp;&nbsp;</td>
			<td><? echo $intSL?></td>
		  </tr>
		</table></td>
  </tr>
</table>
</body>
</html>
