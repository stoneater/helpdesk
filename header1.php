<!DOCTYPE html> 
<?php
session_start();
include 'common/start.inc.php';
include 'common/config.inc.php';
include 'common/functions.inc.php';
include 'common/dbopen.inc.php';
?>

<html> 
<head> 
	<meta name="viewport" content = "width = device-width, initial-scale = 1.0, minimum-scale = 1.0, maximum-scale = 1.0, user-scalable = no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<title>WarriorDesk</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-search.js"></script>
  <script type="text/javascript" src="js/jquery.tooltip.js"></script>	
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('ul.sf-menu').sooperfish();
      });
    </script>	
	<script type="text/javascript" src="js/jquery.tooltip.js"></script>	
	<script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
	<link rel="stylesheet" href="common/jquery-1.css" type="text/css"/>
	<link rel="stylesheet" href="common/jquery-2.css" type="text/css"/>	
	<link rel="stylesheet" href="common/footable-0.1.css" type="text/css"/>
	<link rel="stylesheet" href="common/footable.sortable-0.1.css" type="text/css"/>
	<link rel="stylesheet" href="themes/fletch.min.css"  type="text/css"/>
	<link rel="shortcut icon" href="favicon.ico" />
</head>

<style>
	.container {
		padding: 5px;
	}
	a.colors:visited {
		color: #FFFFFF;
	}
	h1 {
		color: #FFFFFF;
	}
  .mybg {
	background-image: url('images/warrior1.png') !important;
	background-repeat: no-repeat;
	background-position: center;
  }
  .ui-dialog .ui-header .ui-btn-icon-notext { display: none; }
</style>
<body> 
