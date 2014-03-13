<?php
include_once 'header.php';

if($_SESSION['id'] == 'ok'){

?>
<?php
if ($_POST['startDate'] && $_POST['endDate']) {
	$startDate = ($_POST['startDate']);
	$endDate = ($_POST['endDate']);

$query = "SELECT *, DATE_FORMAT(created, '%m/%d/%y') AS created FROM it_data WHERE created BETWEEN '".$startDate."' AND '".$endDate."' ORDER BY id DESC LIMIT 500";
$result = mysql_query($query);
$count = mysql_num_rows($result);


if ($count > 0){ // If it ran OK, display the records.
?>
	<meta http-equiv="refresh" content="300" />
	<script>
		$(function() 
		{
			$('#yahoo a').tooltip({
			track: true,
			delay: 0,
			showURL: false,
			showBody: " - ",
			fade: 250
			});
		});
	</script>
	<style>
		#tooltip {
			position: absolute;
			z-index: 3000;
			border: 1px solid #111;
			background-color: #eee;
			padding: 5px;
			opacity: 0.85;
		}
		#tooltip h3, #tooltip div { margin: 0; }
	</style>
	<div data-role="page" class="type-interior">
		<div data-role="header" data-theme="a">
			<h1>WarriorDesk</h1>
			<a href="#" data-icon="home" data-iconpos="notext" data-direction="reverse" onclick="javascript:location.href='index.php'">Home</a>
		</div><!-- /header -->	
	<br />
		<div data-role="content" class="mybg">
		<b>Total Work Orders: <?php if ($count > 499) {?> ><?php print $count; } else { print $count; }?><br /></b>
		<br />
		<?php
		if ($rs = mysql_fetch_array($result, MYSQL_ASSOC))
		{		
		?>
			<table class="footable" data-filter="#filter">
				<thead>
					<tr>
						<th data-class="expand">
							Priority
						</th>						
						<th data-hide="phone, tablet" data-type="numeric">
							Date
						</th>
						<th>
							From
						</th>				
						<th data-hide="phone, tablet">
							Building
						</th>
						<th>
							Problem
						</th>						
						<th data-hide="phone">
							Technician
						</th>
						<th data-hide="phone, tablet">
							Status
						</th>
						<th data-hide="phone, tablet" data-sort-ignore="true">
							Edit
						</th>	
					</tr>
				</thead>	
				<tbody>
			<?php
				do
				{
					$id = $rs['id'];
					$created = $rs['created'];
					$createdNumeric = strtotime($created);
					$requestedbyL = $rs['requestedby'];
						if (strlen($requestedbyL) > 10) 
						{
							$requestedby = substr($requestedbyL, 0, 10) . "...";
						} else {
							$requestedby = $requestedbyL;
						}
					$building = $rs['building'];
					$technician = $rs['assignedto'];
					if ($technician == '') {
					$technician = 'Unassigned';
					}
					$problems = $rs['problem'];
						if (strlen($problems) > 30) 
						{
							$problem = substr($problems, 0, 30) . "...";
						} else {
							$problem = $problems;
						}
					$priorityNumber = $rs['priority'];
					switch ($priorityNumber) {
						case 1:
							$priority = "<span style='color: #A80000; background-color: #F78181;'>Alert</span>";
							break;
						case 2:
							$priority = "<span style='color: #000000; background-color: #F7FE2E'>High</span>";
							break;
						case 3:
							$priority = "<span style='color: #0B610B; background-color: #CEF6CE'>Normal</span>";
						break;
						case 4:
							$priority = "<span style='color: #000000; background-color: #CECEF6'>Low</span>";
					
							break;
					}
					$statusL = $rs['status'];
						if (strlen($statusL) > 10) 
						{
							$status = substr($statusL, 0, 10) . "...";
						} else {
							$status = $statusL;
						}

					echo '<tr><td>'.$priority.'</td>';
					echo '<td data-value="'.$createdNumeric.'">'.$created.'</td>';
					echo '<td><span id="yahoo" title="'.$requestedbyL.'">'.$requestedby.'</td>';
					echo '<td>'.$building.'</td>';
					echo '<td><span id="yahoo" title="'.$problems.'">'.$problem.'</span></td>';	
					echo '<td>'.$technician.'</td>';
					echo '<td><span id="yahoo" title="'.$statusL.'">'.$status.'</td>';
					echo '<td><a href="edit.php?id='.$id.'">Edit Record</a></td></tr>';
			
				} while ($rs = mysql_fetch_array($result));
				
			?>
			</tbody>
		</table>
			<span data-mini="true">
				<br />
				<hr />
				<br />
			</span>
			<?php
			if($_SESSION['id'] == 'ok'){
			?>
			<table align="center">
				<tr>
					<td>
						<a href="new.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Submit Work Order</a>
					</td>
					<td>
						<a href="completed.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Recently Completed</a>
					</td>
				</tr>
				<tr>
					<td>
						<a href="search.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Search Workorders</a>	
					</td>
					<td>
						<a href="/tech/index.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Back to Tech Home</a>	
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<a href="logout.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Logout</a>
					</td>
				</tr>
			</table>
			<?php
			} else {
			?>
			<table align="center">
				<tr>
					<td>
						<a href="new.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Submit Work Order</a>
					</td>
					<td>
						<a href="mobilelogin.php"  data-theme="a" data-role="button" data-ajax="false" data-mini="true">Log In</a>
					</td>
				</tr>
			</table>	
			<?php
			}
			?>
		</div>
	<?php 
	} else {
				print 'Sorry, no results found for your search of ' . $query . '.  Please try again.<br />';
			}
} else {
	print '<div data-role="dialog"><div data-role="header" data-theme="a">
		<h1>Error</h1>
		<a href="#" data-icon="home" data-iconpos="notext" data-direction="reverse" onclick="javascript:location.href="index.php"">Home</a>
	</div><!-- /header -->	<div data-role="content">Sorry, there were no workorders entered between those dates.</div></div>';
}			
} else {
?>
<div data-role="page" class="type-interior mybg">
	<div data-role="header" data-theme="a">
		<h1>View By Date Range</h1>
		<a href="#" data-icon="home" data-iconpos="notext" data-direction="reverse" onclick="javascript:location.href='index.php'">Home</a>
	</div><!-- /header -->	
<br />
<div data-role="content">
<form method="post" onSubmit="byDates.php">
	<label for="basic"><b>Select a Start Date: </b></label>
		<input type="date" id="datepicker" name="startDate"/>
	<label for="basic"><b>Select an End Date: </b></label>
		<input type="date" id="datepicker" name="endDate"/>	
	<input type="submit" value="Submit" data-inline="true"/>
	<a href="/tech/index.php"><input type="button" value="Cancel" data-inline="true" data-theme="e"/></a>		
</form>
<?php
}
} else {
?>
	<label for="basic">You're Not Logged in!</label>
	<form action="mobilelogin.php" method="get">
		<input type="hidden" name="adding" value="yes" />
			<a href="mobilelogin.php" data-inline="true" data-role="button">Login</a>
	</form>
<?php
}
?>
</div>
<?php
include_once 'footer.php';
include_once 'common/end.inc.php';
?>
