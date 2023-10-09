<?
session_start();

//session_register for CSC Plantilla of Casual Appointment
//session_register('sesDivision');
session_register('sesFundsSource');
session_register('sesAppointAuthority');
session_register('sesHeadCSCOfficer');

//session_register for Plantilla of Personnel
session_register('sesAreaCode'); 
session_register('sesAreaType'); 
session_register('sesAttribution'); 

//session_register of appointment form
session_register('sesReport');
session_register('sesPositionName');
session_register('sesAppointmentStatus');
session_register('sesSalary');
session_register('sesRsnForAppointment');
session_register('sesReplaced');
session_register('sesModeOfSeparation');
session_register('sesPlantillaPageNum');
session_register('sesItemNumber');
session_register('sesMCNumber');
session_register('sesPublishedWher');
session_register('sesMonth');
session_register('sesYear');
session_register('sesDay');
session_register('sesEmpNum');

//session_register of position description form
session_register('sesAgencyName');
session_register('sesDivision');
session_register('sesWorkPlace');
session_register('sesPrevItemNumber');
session_register('sesAuthorizeSalary');
session_register('sesAuthorizeSalaryYr');
session_register('sesPositionCode');
session_register('sesPercentOfWork');
session_register('sesDuties');
session_register('sesNameTitleItem');
session_register('sesSupervisor');
session_register('sesNextSupervisor');
session_register('sesMachineTools');
session_register('sesEmpName');
session_register('sesEmpExamination');
session_register('sesEmpNameSupervisor');
session_register('sesHeadAgency');
session_register('sesOthers');
session_register('sesBureau');
session_register('sesWorkingTitle');
session_register('sesWAPCO');

//$_SESSION of CSC Plantilla of Casual Appointment
//$_SESSION['sesAreaCode'] = $t_strDivision;
$_SESSION['sesFundsSource'] = $t_strFundsSource;
$_SESSION['sesAppointAuthority'] = $t_strAppointAuthority;
$_SESSION['sesHeadCSCOfficer'] = $t_strHeadCSCOfficer;

//$_SESSION of Plantilla of Personnel
$_SESSION['sesAreaCode'] = $t_strAreaCode;
$_SESSION['sesAreaType'] = $t_strAreaType;
$_SESSION['sesAttribution'] = $t_strAttribution;

//$_SESSION of appointment form
$_SESSION['sesMonth'] = $intMonth;
$_SESSION['sesDay'] = $intDay;
$_SESSION['sesYear'] = $intYear;
$_SESSION['sesReport'] = $strReports;
$_SESSION['sesPositionName'] = $t_strPositionCode;
$_SESSION['sesAppointmentStatus'] = $t_strAppointmentDesc;
$_SESSION['sesSalary'] = $t_intActualSalary;
$_SESSION['sesRsnForAppointment'] = $t_strAppointmentReason;
$_SESSION['sesReplaced'] = $t_strEmpFullName;
$_SESSION['sesModeOfSeparation'] = $t_strSeparationCause;
$_SESSION['sesItemNumber'] = $t_strItemNumber;
$_SESSION['sesPlantillaPageNum'] = $t_intPlantillaPageNumber;
$_SESSION['sesMCNumber'] = $t_strCSCMCNumber;
$_SESSION['sesPublishedWher'] = $t_strPublishedWhere;
$_SESSION['sesEmpNum'] = $strEmpNmbr;

//$_SESSION of position description form
$_SESSION['sesAgencyName'] = $strAgencyName;
$_SESSION['sesDivision'] = $t_strDivision;
$_SESSION['sesWorkPlace'] = $t_strWorkPlace;
$_SESSION['sesPrevItemNumber'] = $t_strPrevItemNumber;
$_SESSION['sesAuthorizeSalary'] = $intAuthorizeSalary;
$_SESSION['sesAuthorizeSalaryYr'] = $t_intAuthorizeSalaryYr;
$_SESSION['sesPositionCode'] = $t_strPositionCode;
$_SESSION['sesPercentOfWork'] = $strPercentOfWork;
$_SESSION['sesDuties'] = $strDuties;
$_SESSION['sesNameTitleItem'] = $t_strNameTitleItem;
$_SESSION['sesSupervisor'] = $t_strSupervisor;
$_SESSION['sesNextSupervisor'] = $t_strNextSupervisor;
$_SESSION['sesMachineTools'] = $t_strMachineTools;
$_SESSION['sesEmpName'] = $strEmpName;
$_SESSION['sesEmpExamination'] = $strEmpExamination;
$_SESSION['sesEmpNameSupervisor'] = $strEmpNameSupervisor;
$_SESSION['sesHeadAgency'] = $strHeadAgency;
$_SESSION['sesOthers'] = $t_intOthers;
$_SESSION['sesBureau'] = $t_strBureau;
$_SESSION['sesWorkingTitle'] = $t_strWorkingTitle;
$_SESSION['sesWAPCO'] = $t_strWAPCO;

header("Location: PrintHRMISReport.php?strEmpNmbr=$strEmpNmbr&strReports=$strReports");
?>