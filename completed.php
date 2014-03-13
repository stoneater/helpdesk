<?php
include_once 'header.php';

$script = $_SERVER['PHP_SELF'];

$query = "SELECT *, DATE_FORMAT(created, '%m/%d/%y') AS created, DATE_FORMAT(completedStamp, '%m/%d/%y') AS completedStamp FROM it_data WHERE status LIKE 'completed' ORDER BY completed DESC LIMIT 100";
$result = mysql_query($query);
$count = mysql_num_rows($result);


if ($count > 0){ // If it ran OK, display the records.
?>
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
	<b>Recently Completed Work Orders<br /></b>
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
						Submitted
					</th>
					<th data-hide="phone, tablet" data-type="numeric">
						Completed
					</th>					
					<th>
						From
					</th>				
					<th data-hide="phone, tablet">
						Problem
					</th>	
					<th data-hide="phone, tablet">
						Solution
					</th>					
					<th data-hide="phone">
						Technician
					</th>
					<th data-hide="phone, tablet">
						Edit
					</th>	
				</tr>
			</thead>	
		<?php
			do
			{
				$id = $rs['id'];
				$created = $rs['created'];
				$createdNumeric = strtotime($created);
				$completed = $rs['completedStamp'];
				$completedNumeric = strtotime($completed);				
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
				$solutionL = $rs['solution'];
					if (strlen($solutionL) > 30) 
					{
						$solution = substr($solutionL, 0, 30) . "...";
					} else {
						$solution = $solutionL;
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
				echo '<td data-value="'.$completedNumeric.'">'.$completed.'</td>';				
				echo '<td><span id="yahoo" title="'.$requestedbyL.'">'.$requestedby.'</td>';
				echo '<td><span id="yahoo" title="'.$problems.'">'.$problem.'</span></td>';	
				echo '<td><span id="yahoo" title="'.$solutionL.'">'.$solution.'</span></td>';					
				echo '<td>'.$technician.'</td>';
				echo '<td><a href="edit.php?id='.$id.'">Edit Record</a></td></tr>';
		
			} while ($rs = mysql_fetch_array($result));
			
		?>
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
					<a href="index.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Open Workorders</a>
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
	}
include_once 'footer.php';?>


