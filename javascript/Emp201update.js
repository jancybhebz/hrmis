<script language="JavaScript">

function trapEntrySchool()
{
	var intMonthFrom, intMonthTo, intDayFrom, intDayTo, intYearFrom, intYearTo

	intMonthFrom = document.all.t_dtmSchoolFromMonth.value;
	intMonthTo = document.all.t_dtmSchoolToMonth.value;
	
	intDayFrom = document.all.t_dtmSchoolFromDay.value;	
	intDayTo = document.all.t_dtmSchoolToDay.value;

	intYearFrom = document.all.t_dtmSchoolFromYear.value;
	intYearTo = document.all.t_dtmSchoolToYear.value;
	
	if(intYearFrom > intYearTo)
	{
		alert("Please enter correct year from!");
		document.all.t_dtmSchoolFromYear.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(intDayFrom > intDayTo)
			{
				alert("Please enter correct day from!");
				document.all.t_dtmSchoolFromDay.focus();
				event.returnValue=false;
			}				
		}
		else if(intMonthFrom > intMonthTo)
		{
			alert("Please enter correct month from!");
			document.all.t_dtmSchoolFromMonth.focus();
			event.returnValue=false;
		}
	}			
}

function trapEntryExamination()
{
	var intMonthFrom, intMonthTo, intDayFrom, intDayTo, intYearFrom, intYearTo

	intMonthFrom = document.all.t_dtmExamMonth.value;
	intMonthTo = document.all.t_dtmDateReleaseMonth.value;
	
	intDayFrom = document.all.t_dtmExamDay.value;	
	intDayTo = document.all.t_dtmDateReleaseDay.value;

	intYearFrom = document.all.t_dtmExamYear.value;
	intYearTo = document.all.t_dtmDateReleaseYear.value;
	
	if(intYearFrom > intYearTo)
	{
		alert("Please enter correct year from!");
		document.all.t_dtmExamYear.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(intDayFrom > intDayTo)
			{
				alert("Please enter correct day from!");
				document.all.t_dtmExamDay.focus();
				event.returnValue=false;
			}				
		}
		else if(intMonthFrom > intMonthTo)
		{
			alert("Please enter correct month from!");
			document.all.t_dtmExamMonth.focus();
			event.returnValue=false;
		}
	}			
}

function trapEntryTraining()
{
	var intMonthFrom, intMonthTo, intDayFrom, intDayTo, intYearFrom, intYearTo

	intMonthFrom = document.all.t_dtmTrainingStartMonth.value;
	intMonthTo = document.all.t_dtmTrainingEndMonth.value;
	
	intDayFrom = document.all.t_dtmTrainingStartDay.value;	
	intDayTo = document.all.t_dtmTrainingEndDay.value;

	intYearFrom = document.all.t_dtmTrainingStartYear.value;
	intYearTo = document.all.t_dtmTrainingEndYear.value;
	
	if(intYearFrom > intYearTo)
	{
		alert("Please enter correct year from!");
		document.all.t_dtmTrainingStartYear.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(intDayFrom > intDayTo)
			{
				alert("Please enter correct day from!");
				document.all.t_dtmTrainingStartDay.focus();
				event.returnValue=false;
			}				
		}
		else if(intMonthFrom > intMonthTo)
		{
			alert("Please enter correct month from!");
			document.all.t_dtmTrainingStartMonth.focus();
			event.returnValue=false;
		}
	}			
}

function trapEntryVoluntary()
{
	var intMonthFrom, intMonthTo, intDayFrom, intDayTo, intYearFrom, intYearTo

	intMonthFrom = document.all.t_dtmVWDateFromMonth.value;
	intMonthTo = document.all.t_dtmVWDateToMonth.value;
	
	intDayFrom = document.all.t_dtmVWDateFromDay.value;	
	intDayTo = document.all.t_dtmVWDateToDay.value;

	intYearFrom = document.all.t_dtmVWDateFromYear.value;
	intYearTo = document.all.t_dtmVWDateToYear.value;
	
	if(intYearFrom > intYearTo)
	{
		alert("Please enter correct year from!");
		document.all.t_dtmVWDateFromYear.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(intDayFrom > intDayTo)
			{
				alert("Please enter correct day from!");
				document.all.t_dtmVWDateFromDay.focus();
				event.returnValue=false;
			}				
		}
		else if(intMonthFrom > intMonthTo)
		{
			alert("Please enter correct month from!");
			document.all.t_dtmVWDateFromMonth.focus();
			event.returnValue=false;
		}
	}			
}



</script>
