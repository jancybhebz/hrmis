<?
require("../hrmis/class/Attendance.php");
$objAttendance = new Attendance;
$arrEmpPersonal = $objAttendance->getEmpInfo($strEmpNmbr);
$objAttendance->setPrintDTR(1);
$strMonthName = $objAttendance->intToMonthFull($strMonth);
?>				
<html>
<head>
<title>Daily Time Record</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="report.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="window.print()">
<div align="center">
<table width="590" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> 
    <td height="35" colspan="4" align="center" valign="middle" class="title">Daily 
      Time Record</td>
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
    <td colspan="4" valign="top"><table border="0" width="590" cellpadding="0" cellspacing="0" style="border-collapse: collapse" Bordercolor="#CCCCCC">
        <!--DWLayoutTable-->
        <tr>
		  <td width="20" align="center" valign="middle" class="subtitle"><!--DWLayoutEmptyCell-->&nbsp;</td>		 
          <td width="95" align="center" valign="middle" class="subtitle">In</td>
          <td width="95" align="center" valign="middle" class="subtitle">Out</td>
          <td width="95" align="center" valign="middle" class="subtitle">In</td>
          <td width="95" align="center" valign="middle" class="subtitle">Out</td>
          <td width="95" align="center" valign="middle" class="subtitle">In</td>
          <td width="95" align="center" valign="middle" class="subtitle">Out</td>		  		  		  		  		  
        </tr>
		<?
  			$objAttendance->viewDTR($strMonth, $strYear, $arrEmpPersonal["empNumber"]);
		?>		
      </table></td>
  </tr>
  <tr><td colspan="4" class="subtitle"><br><br>NOTED BY:</td></tr>
  <tr><td colspan="2" class="subtitle"><br><br></td>
  <td colspan="2"class="subtitle"><br><br></td>
  <tr><td colspan="2" class="subtitle"><? echo strtoupper($arrEmpPersonal["divisionHead"])?></td>
  <td colspan="2"class="subtitle"><? echo strtoupper($arrEmpPersonal["surname"].", ".$arrEmpPersonal["firstname"])?></td>
  </tr>  
</table>
</div>
</body>
</html>
