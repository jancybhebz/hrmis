<script language="JavaScript">
function checkDate()
{
	var intMonth;
	var dtmDateNow = new Date(<?php echo($objAttendance->getDateToday())?>);
	
	intMonth = document.frmAttendance.cboMonth.value;
	var intYear = document.frmAttendance.cboYear.value;	

	if(intYear == dtmDateNow.getYear())
	{
		if(intMonth > dtmDateNow.getMonth() + 3)
		{
			alert("You cannot select month and year that is more than 3 months ahead of the present time!");
			event.returnValue=false;		
		}
	}
	else if(intYear > dtmDateNow.getYear())
	{
		alert("You cannot select month and year that is more than 3 months ahead of the present time!");
		event.returnValue=false;				
	}
	
}
</script>