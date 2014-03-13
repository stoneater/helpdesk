<!DOCTYPE html> 
<?php
session_start();
include 'common/start.inc.php';
include '../home/common/config.inc.php';
include 'common/functions.inc.php';
include 'common/dbopen.inc.php';
?>

<html> 
<head> 
	<meta name="viewport" content = "width = device-width, initial-scale = 1.0, minimum-scale = 1.0, maximum-scale = 1.0, user-scalable = no" />
	<title>WarriorDesk</title>
	<script type="text/javascript" src="js/jquery-2.js"></script>
	<script type="text/javascript" src="js/jquery-1.js"></script>
	<script type="text/javascript" src="js/jquery-3.js"></script>
    <script type="text/javascript" src="js/jquery-4.js"></script>	
	<script type="text/javascript" src="js/jquery-5.js"></script>
    <script type="text/javascript" src="js/jquery-7.js"></script>
	<script type="text/javascript" src="js/jquery-search.js"></script>	
	<script type="text/javascript" src="js/footable-0.1.js"></script>
	<script type="text/javascript" src="js/footable.sortable.js"></script>
	<script type="text/javascript" src="js/footable.filter.js"></script>
    <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
    <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('ul.sf-menu').sooperfish();
      });
    </script>	
	<script type="text/javascript" src="js/jquery.tooltip.js"></script>	
	<link rel="stylesheet" href="common/jquery-1.css" type="text/css"/>
	<link rel="stylesheet" href="common/jquery-2.css" type="text/css"/>	
	<link rel="stylesheet" href="common/footable-0.1.css" type="text/css"/>
	<link rel="stylesheet" href="common/footable.sortable-0.1.css" type="text/css"/>
	<link rel="stylesheet" href="themes/fletch.min.css"  type="text/css"/>
	<link rel="shortcut icon" href="favicon.ico" />

	<script type="text/javascript">
		$(function() {
		  $('table').footable();
		});
	</script>
	<script type="text/javascript">
		$(function() {
			$( "#datepicker" ).datepicker();
		});
    </script>	
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
