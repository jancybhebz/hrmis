<script language="JavaScript">

function trapEntryElementary()
{
	var intMonthFrom, intMonthTo, intDayFrom, intDayTo, intYearFrom, intYearTo

	intMonthFrom = document.all.t_dtmElementaryFromMonth.value;
	intMonthTo = document.all.t_dtmElementaryToMonth.value;
	
	intDayFrom = document.all.t_dtmElementaryFromDay.value;	
	intDayTo = document.all.t_dtmElementaryToDay.value;

	intYearFrom = document.all.t_dtmElementaryFromYear.value;
	intYearTo = document.all.t_dtmElementaryToYear.value;
	
	if(intYearFrom > intYearTo)
	{
		alert("Please enter correct elementary year from!");
		document.all.t_dtmElementaryFromYear.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(intDayFrom > intDayTo)
			{
				alert("Please enter correct elementary day from!");
				document.all.t_dtmElementaryFromDay.focus();
				event.returnValue=false;
			}				
		}
		else if(intMonthFrom > intMonthTo)
		{
			alert("Please enter correct elementary month from!");
			document.all.t_dtmElementaryFromMonth.focus();
			event.returnValue=false;
		}
	}			
}

function trapEntrySecondary()
{
	var intMonthFrom, intMonthTo, intDayFrom, intDayTo, intYearFrom, intYearTo

	intMonthFrom = document.all.t_dtmSecondaryFromMonth.value;
	intMonthTo = document.all.t_dtmSecondaryToMonth.value;
	
	intDayFrom = document.all.t_dtmSecondaryFromDay.value;	
	intDayTo = document.all.t_dtmSecondaryToDay.value;

	intYearFrom = document.all.t_dtmSecondaryFromYear.value;
	intYearTo = document.all.t_dtmSecondaryToYear.value;
	
	if(intYearFrom > intYearTo)
	{
		alert("Please enter correct secondary year from!");
		document.all.t_dtmSecondaryFromYear.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(intDayFrom > intDayTo)
			{
				alert("Please enter correct secondary day from!");
				document.all.t_dtmSecondaryFromDay.focus();
				event.returnValue=false;
			}				
		}
		else if(intMonthFrom > intMonthTo)
		{
			alert("Please enter correct secondary month from!");
			document.all.t_dtmSecondaryFromMonth.focus();
			event.returnValue=false;
		}
	}			
}

</script>
