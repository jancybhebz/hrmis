<?
require("../hrmis/class/Positiondetails.php");
$objPosition = new position;
$arrEmpPersonal = $objPosition->getEmpInfo($strEmpNmbr);
$strMonthName = $objPosition->intToMonthFull($strMonth);
?>		
<html>
<head>
<title>Position Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="report.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="window.print()">
<table width="650" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> 
    <td height="35" colspan="4" align="center" valign="middle" class="title">POSITION 
      DETAILS </td>
  </tr>
  <tr> 
    <td width="120" height="24" align="right" valign="middle" class="subtitle">Employee Number:&nbsp;</td>
    <td width="100" class="titlebar"><? echo $arrEmpPersonal["empNumber"];?></td>
    <td width="80" align="right" valign="middle" class="subtitle">Name:&nbsp;</td>
    <td width="190" class="titlebar"><? echo $arrEmpPersonal["surname"].", ".$arrEmpPersonal["firstname"]." ".$arrEmpPersonal["middlename"]?></td>
  </tr>
  <tr> 
    <td width="120" height="24" align="right" valign="middle" class="subtitle">Division:&nbsp;</td>
    <td width="150" class="titlebar"><? echo $arrEmpPersonal["divisionCode"];?></td>
    <td width="80" align="right" valign="middle" class="subtitle">: </td>
    <td width="240" class="titlebar"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr><td colspan="4" height="10"></td></tr>
  <tr> 
    <td colspan="4" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="31%" class="paragraph">Appointment Code:</td>
          <td width="20%">
            <? $arrEmpPersonal['healthProvider']; ?>
          </td>
          <td width="28%" class="paragraph">Position Code :</td>
          <td width="21%"> 
            <?php 
										$result = mysql_query ("SELECT positionCode FROM tblPosition");
										echo "<SELECT NAME=\"t_strPositionCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strPositionCode == $row["positionCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["positionCode"])."\" selected>".strtoupper($row["positionCode"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["positionCode"])."\">".strtoupper($row["positionCode"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
          </td>
        </tr>
        <tr> 
          <td class="paragraph">Service Code:</td>
          <td> 
            <?php 
										$result = mysql_query ("SELECT serviceCode FROM tblServiceCode");
										echo "<SELECT NAME=\"t_strServiceCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strServiceCode == $row["serviceCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["serviceCode"])."\" selected>".strtoupper($row["serviceCode"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["serviceCode"])."\">".strtoupper($row["serviceCode"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
          </td>
          <td class="paragraph">Division Code :</td>
          <td> 
            <?php 
										$result = mysql_query ("SELECT divisionCode FROM tblDivision");
										echo "<SELECT NAME=\"t_strDivisionCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strDivisionCode == $row["divisionCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["divisionCode"])."\" selected>".strtoupper($row["divisionCode"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["divisionCode"])."\">".strtoupper($row["divisionCode"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
          </td>
        </tr>
        <tr> 
          <td class="paragraph">Section Code:</td>
          <td> 
            <?php 
										$result = mysql_query ("SELECT sectionCode FROM tblSection");
										echo "<SELECT NAME=\"t_strSectionCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strSectionCode == $row["sectionCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["sectionCode"])."\" selected>".strtoupper($row["sectionCode"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["sectionCode"])."\">".strtoupper($row["sectionCode"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
          </td>
          <td class="paragraph">Tax Status Code :</td>
          <td> 
            <?php 
										$result = mysql_query ("SELECT taxStatus FROM tblTaxExempt");
										echo "<SELECT NAME=\"t_strTaxStatus\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strTaxStatus == $row["taxStatus"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["taxStatus"])."\" selected>".strtoupper($row["taxStatus"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["taxStatus"])."\">".strtoupper($row["taxStatus"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
          </td>
        </tr>
        <tr> 
          <td class="paragraph">Item Number:</td>
          <td> 
            <?php 
										$result = mysql_query ("SELECT itemNumber FROM tblPlantilla");
										echo "<SELECT NAME=\"t_strItemNumber\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strItemNumber == $row["itemNumber"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["itemNumber"])."\" selected>".strtoupper($row["itemNumber"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["itemNumber"])."\">".strtoupper($row["itemNumber"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
          </td>
          <td class="paragraph">Step Number :</td>
          <td> 
            <?php 
										$result = mysql_query ("SELECT stepNumber FROM tblSalarySched");
										echo "<SELECT NAME=\"t_strStepNumber\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strStepNumber == $row["stepNumber"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["stepNumber"])."\" selected>".strtoupper($row["stepNumber"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["stepNumber"])."\">".strtoupper($row["stepNumber"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
          </td>
        </tr>
        <tr> 
          <td class="paragraph">First Day Agency:</td>
          <td> 
            <?php 
										$result = mysql_query ("SELECT firstDayAgency FROM tblEmpPosition");
										echo "<SELECT NAME=\"t_strFirstDayAgency\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strFirstDayAgency == $row["firstDayAgency"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["firstDayAgency"])."\" selected>".strtoupper($row["firstDayAgency"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["firstDayAgency"])."\">".strtoupper($row["firstDayAgency"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
          </td>
          <td class="paragraph">First Day Government :</td>
          <td> 
            <?php 
										$result = mysql_query ("SELECT firstDayGov FROM tblEmpPosition");
										echo "<SELECT NAME=\"t_strFirstDayGov\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strFirstDayGov == $row["firstDayGov"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["firstDayGov"])."\" selected>".strtoupper($row["firstDayGov"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["firstDayGov"])."\">".strtoupper($row["firstDayGov"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
          </td>
        </tr>
        <tr> 
          <td class="paragraph">Personnel Action:</td>
          <td><? $arrEmpPersonal['personnelAction']; ?></td>
          <td class="paragraph">Employment Basis:</td>
          <td><? $arrEmpPersonal['employementBasis']; ?></td>
        </tr>
        <tr> 
          <td class="paragraph">Category Service:</td>
          <td><? $arrEmpPersonal['categoryService']; ?></td>
          <td class="paragraph">Nature of Work:</td>
          <td><? $arrEmpPersonal['nature']; ?></td>
        </tr>
        <tr> 
          <td class="paragraph">HP Factor:</td>
          <td><? $arrEmpPersonal['hpFactor']; ?></td>
          <td class="paragraph">Payroll Switch:</td>
          <td><? $arrEmpPersonal['payrollSwitch']; ?></td>
        </tr>
        <tr> 
          <td class="paragraph">DTR Switch:</td>
          <td><? $arrEmpPersonal['dtrSwitch']; ?></td>
          <td class="paragraph">No. of Dependents:</td>
          <td><? $arrEmpPersonal['dependents']; ?></td>
        </tr>
        <tr> 
          <td class="paragraph"> with Health Insurance Provider:</td>
          <td><? $arrEmpPersonal['healthProvider']; ?></td>
          <td class="paragraph">Effectivity Date:</td>
          <td><? $arrEmpPersonal['effectivityDate']; ?></td>
        </tr>
        <tr> 
          <td class="paragraph">Salary:</td>
          <td><? $arrEmpPersonal['actualSalary']; ?></td>
          <td class="paragraph">Appointment Date Position:</td>
          <td><? $arrEmpPersonal['positionDate']; ?></td>
        </tr>
        <tr> 
          <td class="paragraph">Longevity Start Year:</td>
          <td><? $arrEmpPersonal['longevityDate']; ?></td>
          <td class="paragraph">Actual Salary:</td>
          <td><? $arrEmpPersonal['actualSalary']; ?></td>
        </tr>
        <tr> 
          <td class="paragraph">Contract End Date:</td>
          <td><? $arrEmpPersonal['contractEndDate']; ?></td>
          <td class="paragraph">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table> </td>
  </tr>
</table>
</body>
</html>
