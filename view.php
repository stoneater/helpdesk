<?php
include_once 'header.php';
if ($_POST['id']){ $id = $_POST['id'];}
if ($_GET['id']){ $id = $_GET['id'];}
if ($_GET['inventory_id']){	$id = $_GET['inventory_id'];}
if ($_POST['inventory_id']){ $id = $_POST['inventory_id'];}
//$inventory_id = '1295';
//$debuging = '1';

echo '
<br />
<div data-role="header" data-theme="c" data-inline="true">
	<h6>Item View</h6>
</div>
<div data-role="collapsible" data-theme="c" data-collapsed="false">
<h6><img src="images/pencil.png" height="15px" width="15px">
<b>Inventory Item#: '. $id.'</b></h6>';

//build the meaty part of the page
 
//Check for what type of hardware is being edited
$top_sql_statement = 'SELECT inventory.inventory_id, hw_type FROM ' . $db_table . ' WHERE inventory.inventory_id = ' . $id . '';

//Execute built query...
$top_results = mysql_query($top_sql_statement) or die ('Error in <b> '.$top_sql_statement .' </b>.' . mysql_error().' <br />.');

//Debug...
if ($debuging){
	print '<b>DEBUG:</b> $top_sql_statement: ' . $top_sql_statement . '<p>';
}

if ($rst = mysql_fetch_array($top_results)){
	do {
		$hw_type = stripslashes($rst['hw_type']);
	}
	while ($rst = mysql_fetch_array($top_results));	
		
		$sql_statement_basic = '
			SELECT 
				common_name,
				building,
				room,
				purchase_date,
				warranty_expire,
				sn
			FROM 
			'. $db_table .'
			WHERE
				inventory_id like '.$id.'';
		$result_basic = mysql_query($sql_statement_basic) or die ('Error in <b>' . $sql_statement_basic . '</b>. ' . mysql_error());
		if ($rs = mysql_fetch_array($result_basic))
				{
					do
					{
						$common_name = $rs['common_name'];
						$building = stripslashes($rs['building']);
						$room = stripslashes($rs['room']);
						$purchase_date = stripslashes($rs['purchase_date']);
						$warranty_expire = stripslashes($rs['warranty_expire']);
						$sn = $rs['sn'];
					} while ($rs = mysql_fetch_array($results));
				} else {
					print 'Is that a computer item#' . $inventory_id . '.<p>';
					include_once 'footer.php';
					die;
				}

		switch ($hw_type) 
		{
			case 'computer':
				$sql_statement_device = '
					SELECT
						assigned_pc,
						notes, 
						manuf,
						model,
						processor,
						processor_speed,
						memory,
						HD_size,
						original_OS
					FROM 
						computer,
						computer_model 
					WHERE 
						computer.computer_model_id = computer_model.computer_model_id
						and inventory_id = ' . $id . '';

			break;
			case 'monitor':
				$sql_statement_device = '
					SELECT 
						notes, 
						manuf, 
						model,
						type 
					FROM
						monitor, monitor_model
					WHERE
						monitor.monitor_model_id = monitor_model.monitor_model_id
						and inventory_id = ' . $id . '';

			break;
			case 'projector':
				$sql_statement_device = '
					SELECT 
						notes, 
						projector.projector_model_id, 
						manuf, 
						model 
					FROM 
						projector, 
						projector_model
					WHERE 
						projector.projector_model_id = projector_model.projector_model_id 
						and inventory_id = ' . $id . '';
			break;
			case 'printer':
				$sql_statement_device = '
				SELECT 
					notes,
					manuf, 
					model,
					type 
				FROM 
					printer, 
					printer_model 
				WHERE 
					printer.printer_model_id = printer.printer_model_id 
					and inventory_id = ' . $id . '';
				
			break;
			case 'scanner':
			default:
				$sql_statement_device = '
				SELECT 
					notes, 
					manuf,
					model
				FROM
					scanner, 
					scanner_model
				WHERE
				scanner.scanner_model_id = scanner_model.scanner_model_id 
				and inventory_id = ' . $id . '';

			break;			
		}
//Execute built query...
if ($debuging) //Debug
{
	print '<b>DEBUG:</b> $sql_statement_device :' . $sql_statement_device . '<br />';
}
$result_device = mysql_query($sql_statement_device) or die ('Error in <b>' . $sql_statement_device . '</b>. ' . mysql_error());

if ($rs = mysql_fetch_array($result_device))
{
	do
	{
		$assigned_pc = stripslashes($rs['assigned_pc']);
		$notes = stripslashes($rs['notes']);
		$manuf = stripslashes($rs['manuf']);
		$model = stripslashes($rs['model']);
		$processor = stripslashes($rs['processor']);
		$processor_speed = stripslashes($rs['processor_speed']);
		$memory = stripslashes($rs['memory']);
		$HD_size = stripslashes($rs['HD_size']);
		$original_OS = stripslashes($rs['original_OS']);
		$type = stripslashes($rs['type']);
	} while ($rs = mysql_fetch_array($results));
} else {
	print 'Sorry, can\'t locate inventory item#' . $id . '.<p>';
	include_once 'footer.php';
	die;
}
switch ($building){
	case 'High':
	case 'Middle':
		$building = $building.' School';
	break;
	
	case 'Primary':
	case 'Upper':
		$building = $building.' Elementary School';
}
$part1 = '<label for="basic"><b>';
$part2 = '</b></label><label for="basic">' ;
$part3 = '</label><br />';
$output = '<br />';
if ($hw_type) { 
	$output = $output.$part1.'Details about the '.$hw_type.' selected:</b>'.$part3.'<hr />';
}
if ($common_name) {
	$output = $output.$part1.'Common Name: '.$part2.$common_name.$part3;
}
if ($sn) {
	$output = $output.$part1.'Serial Number: '.$part2.$sn.$part3;
}
if ($building and $room) {
	$output = $output.$part1.'Location: '.$part2.$building.', <b>Room</b> '.$room.$part3;
}
if ($assigned_pc) {
	$output = $output.$part1.'Assigned PC: '.$part2.'Computer is Assigned'.$part3;
} else {
	if ($hw_type == 'computer') {$output = $output.$part1.'Assigned PC: '.$part2.'Not Assigned'.$part3;} //just to print something if computer and not assigned
}
if ($manuf and $model) {
	$output = $output.$part1.'Model: '.$part2.$manuf.' '.$model.$part3;
}
if ($type) {
	$output = $output.$part1.'Type: '.$part2.$type.$part3;
}
if ($purchase_date) {
	$output = $output.$part1.'Purchase Date: '.$part2.$purchase_date.$part3;
}
if ($warranty_expire){
	$output = $output.$part1.'Warranty Expires: '.$part2.$warranty_expire.$part3;
}
if ($notes) {
	$output = $output.$part1.'Notes: '.$part2.$notes.$part3;
}
$output = $output.'</div>';

echo $output;
} else {
	print 'Sorry, can\'t locate inventory ID #' . $id . '.<p>';
	include_once 'footer.php';
	die;
}
	//echo $id;

include_once 'footer.php';
?>
