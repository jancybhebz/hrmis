<?
//Attendance constants

define('WORKTIME', 28800);  // 8 HOURS, 28800 in seconds

define('VACLEAVE', 'VL');   //Vacation Leave Code
define('SICKLEAVE', 'SL');   //Sick Leave Code
define('FORCELEAVE', 'FL');   //force leave
define('PRIVLEAVE', 'PL');   //priviledge leave
define('MATLEAVE', 'ML');   //force leave
define('PATLEAVE', 'PTL');   //priviledge leave
define('ABSENT', 'ABS');   //absent for contructuals

define('HVACLEAVE', 'HVL');   //Vacation Leave Code
define('HSICKLEAVE', 'HSL');   //Sick Leave Code
define('HFORCELEAVE', 'HFL');   //force leave
define('HPRIVLEAVE', 'HPL');   //priviledge leave

define('WHOLEDAY', 'W');   //WHOLE DAY LEAVE 
define('HALFDAY', 'H');   //half DAY LEAVE 

define('VL_AVAIL_FL', 10);
define('DAYS_FL', 5);


define('TWELVEMONTHS', 12);   //12 months, one year in add 15 leave
define('SIXMONTHS', 5);   //12 months, one year in add 15 leave
define('WORKHOURS', 8);   //8 hours work hours
define('HALFDAYHOURS', 8);   //8 hours work hours
define('DAYEARNED', 1.25/30);   //day vacation and sick leave earned
define('MONTH_EARNED', '1.25');   //month earned SLVL

define('NULLABSUND', 0.000);
define('FLAGCRMNY', '08:00:00');   //time start of flag ceremony
define('NULLTIME', '00:00:00');   //null time
define('NULLDATE', '0000-00-00');   //null time
define('FLAG_CEREMONY', 'FC');   //code of Flag Ceremony

define('NOON','12:00:00');
define('LATE_NOON','12:59:59');
define('MIDNIGHT','12:00:00');

define('AM', 'AM');
define('PM', 'PM');

define('YES', 'Y');
define('NO', 'N');

define('QUASI', 'QB');
define('OFFICIAL', 'OB');
define('OVERTIME', 'OT');
define('TRAVELORDER', 'TO');
define('TRIPTICKET', 'TT');
define('MEETING', 'MET');
//end attendance constants

//tblAgency salarySchedule values
define('MONTHLY','Monthly');   // 1
define('WEEKLY','Weekly');   //4
define('BIMONTHLY','Bi-Monthly');   //2

//Report Generate

define('FIRST_MONTH',1);
define('END_MONTH',12);

//payment basis
define('CALENDAR_DAYS', 'CLNDR');
define('WEEKDAYS','WKDY');

?>