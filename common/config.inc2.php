<?php

//Genral options...
$app_title = "Inventory"; //Please enter a title. e.g.: My School District
$app_password = "W@rriors"; //Please enter a system password. e.g.: password
$admin_email = "henshaw@smithville.k12.mo.us"; //Please enter a administrator's email address. e.g.: jdoe@domain.com
$smtp_server = "aspmx.l.google.com"; //Please enter a SMTP server. e.g.: mail.domain.com
$base_url = "http://linux.smithville.k12.mo.us/it_inventory/"; //Please enter the web address of the system. e.g.: http://www.domain.com/helpdesk/
$header_type = "Image"; //Please enter a header type. e.g.: Image, Text, None
$email_notification = "False"; //Please enable or disable email notification. e.g.: True
$items_per_page = 15; //Please enter how many items displayed per page. e.g.: 15

//MySQL database options...
$db_server = "localhost"; //Please enter a database server address. e.g.: localhost
$db_username = "helpdesk"; //Please enter a username. e.g.: owos
$db_password = "helpdesk"; //Please enter a password. e.g.: password
$db_database = "helpdesk"; //Please enter the database. e.g.: owoslite
$db_table = "it_data"; //Please enter the database table. e.g.: data

//Building options (10 Max.)...
$building1 = "Central"; //This field is required
$building2 = "High";
$building3 = "Middle";
$building4 = "Upper";
$building5 = "Primary";
$building6 = "Shed";
$building7 = "";
$building8 = "";
$building9 = "";
$building10 = "";

//Assigned to options (5 Max.)
$assigned_to1 = "Matt Henshaw"; //This field is required
$assigned_to2 = "Randy Wallace";
$assigned_to3 = "Jay Fude";
$assigned_to4 = "Richard Fletcher";
$assigned_to5 = "Joni Egbert";

//Assigned to email options (Must correspond to above technician names)...
$assigned_to_email1 = "henshaw@smithville.k12.mo.us"; //This field is required
$assigned_to_email2 = "wallacer@smithville.k12.mo.us";
$assigned_to_email3 = "fudej@smithville.k12.mo.us";
$assigned_to_email4 = "fletchr@smithville.k12.mo.us";
$assigned_to_email5 = "egbertj@smithville.k12.mo.us";

//Do not edit anything below this line...
//---------------------------------------
error_reporting(E_ERROR);
$debugging = False;
$app_version = '4.00';
?>
