<?php

//Genral options...
$app_title = "Inventory"; //For title page name
$app_password = "p@ssw0rd"; //system password for techs.
$admin_email = "your.email@ddress.here"; // administrator's email address
$smtp_server = "aspmx.l.google.com"; // SMTP server or use google's
$base_url = "http://localhost"; // the web address of the system. 
$header_type = "Image"; //Can be Image, Text, None Might be overwritten with css
$email_notification = "False"; // enable or disable email notification. True/False
$items_per_page = 15; // how many items displayed per page.

//MySQL database options...
$db_server = "localhost"; //database server address. example: localhost
$db_username = "helpdesk"; //username. example: 
$db_password = "helpdesk"; //password. example: password
$db_database = "helpdesk"; //Please enter the database. example: lite
$db_table = "helpdesk"; //Please enter the database table. example: data

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
$assigned_to1 = "tech1"; //This field is required
$assigned_to2 = "tech2";
$assigned_to3 = "tech3";
$assigned_to4 = "tech4";
$assigned_to5 = "tech5";

//Assigned to email options (Must correspond to above technician names)...
$assigned_to_email1 = "fake@email@ddress.here"; //This field is required
$assigned_to_email2 = "fake@email@ddress.here";
$assigned_to_email3 = "fake@email@ddress.here";
$assigned_to_email4 = "fake@email@ddress.here";
$assigned_to_email5 = "fake@email@ddress.here";

//Do not edit anything below this line...
//---------------------------------------
error_reporting(E_ERROR);
$debugging = False;
$app_version = '3.00';
?>
