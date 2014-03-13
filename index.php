<?php
include_once 'header.php';

$script = $_SERVER['PHP_SELF'];

$query = "SELECT *, DATE_FORMAT(created, '%m/%d/%y') AS created, DATE_FORMAT(stamp, '%l:%i %p') AS submitTime, DATE_FORMAT(now(), '%j') AS now, DATE_FORMAT(stamp, '%j') AS submission FROM it_data WHERE status NOT LIKE 'completed' AND priority NOT LIKE '5' AND priority NOT LIKE '6' AND priority NOT LIKE '7' AND priority NOT LIKE '8' ORDER BY id DESC";
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
			
		</div><!-- /header -->	
	<br />
		<div data-role="content" class="mybg">
		<b>Open Public Work Orders: <?php print $count?><br /></b>
		<br />
		<?php
		if ($rs = mysql_fetch_array($result, MYSQL_ASSOC))
		{		
		?>
			<table class="footable" data-filter="#filter">
				<thead>
					<tr>
						<th data-hide="phone">
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
						<th>
							Technician
						</th>
						<th data-hide="phone, tablet">
							Status
						</th>
						<th data-hide="phone, tablet" data-sort-ignore="true">
						<?php if ($_SESSION['id']) { ?>
							Edit
						<?php } else { ?>
							View
						<?php } ?>
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
					$submitTime = $rs['submitTime'];
					$stamp = $rs['submission'];
					$now = $rs['now'];
					$test = ($now - $stamp);
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
					if ($test){
						echo '<td data-value="'.$createdNumeric.'">'.$created.'</td>';
					} else {
						echo '<td data-value="'.$createdNumeric.'">'.$submitTime.'</td>';
					}
					echo '<td><span id="yahoo" title="'.$requestedbyL.'">'.$requestedby.'</td>';
					echo '<td>'.$building.'</td>';
					echo '<td><span id="yahoo" title="'.$problems.'">'.$problem.'</span></td>';	
					echo '<td>'.$technician.'</td>';
					echo '<td><span id="yahoo" title="'.$statusL.'">'.$status.'</td>';
					if ($_SESSION['id']) {
						echo '<td><a href="edit.php?id='.$id.'">Edit Record</a></td></tr>';
					} else {
						echo '<td><a href="edit.php?id='.$id.'">View Record</a></td></tr>';
					}		
				} while ($rs = mysql_fetch_array($result));
				
			?>
			</tbody>
		</table>
			<?php
			if($_SESSION['id'] == 'ok'){
			$querys = "SELECT *, DATE_FORMAT(created, '%m/%d/%y') AS created, DATE_FORMAT(stamp, '%l:%i %p') AS submitTime, DATE_FORMAT(now(), '%j') AS now, DATE_FORMAT(stamp, '%j') AS submission FROM it_data WHERE status NOT LIKE 'completed' AND priority > 4 ORDER BY priority, id DESC";
		$results = mysql_query($querys);
		$counts = mysql_num_rows($results);
	?>
		<br />
		<b>Open Internal Work Orders: <?php print $counts?><br /></b>
		<br />
	<?php
		if ($rst = mysql_fetch_array($results, MYSQL_ASSOC))
		{		
		?>
			<table class="footable" data-filter="#filter">
				<thead>
					<tr>
						<th data-hide="phone">
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
						<th>
							Technician
						</th>
						<th data-hide="phone, tablet">
							Status
						</th>
						<th data-hide="phone, tablet" data-sort-ignore="true">
						<?php if ($_SESSION['id']) { ?>
							Edit
						<?php } else { ?>
							View
						<?php } ?>
						</th>
					</tr>
				</thead>	
			<?php
				do
				{
					$id = $rst['id'];
					$created = $rst['created'];
					$createdNumeric = strtotime($created);
					$requestedbyL = $rst['requestedby'];
						if (strlen($requestedbyL) > 7) 
						{
							$requestedby = substr($requestedbyL, 0, 7) . "...";
						} else {
							$requestedby = $requestedbyL;
						}
					$building = $rst['building'];
					$submitTime = $rst['submitTime'];
					$stamp = $rst['submission'];
					$now = $rst['now'];
					$test = ($now - $stamp);
					$technician = $rst['assignedto'];
					if ($technician == '') {
					$technician = 'Unassigned';
					}
					$problems = $rst['problem'];
						if (strlen($problems) > 15) 
						{
							$problem = substr($problems, 0, 15) . "...";
						} else {
							$problem = $problems;
						}
					$priorityNumber = $rst['priority'];
					switch ($priorityNumber) {
						case 1:
							$priority = "<span style='color: #A80000; background-color: #F78181; display: block; width: 100%; text-align: center;'>Alert</span>";
							break;
						case 2:
							$priority = "<span style='color: #000000; background-color: #F7FE2E; display: block; width: 100%; text-align: center;'>High</span>";
							break;
						case 3:
							$priority = "<span style='color: #0B610B; background-color: #CEF6CE; display: block; width: 100%; text-align: center;'>Normal</span>";
						break;
						case 4:
							$priority = "<span style='color: #000000; background-color: #CECEF6; display: block; width: 100%; text-align: center;'>Low</span>";
					
							break;
						case 5:
							$priority = "<span style='color: #A80000; background-color: #F78181; display: block; width: 100%; text-align: center;'>Tech/Alert</span>";
					
							break;								
						case 6:
							$priority = "<span style='color: #000000; background-color: #F7FE2E; display: block; width: 100%; text-align: center;'>Tech/High</span>";
					
							break;
						case 7:
							$priority = "<span style='color: #0B610B; background-color: #CEF6CE; display: block; width: 100%; text-align: center;'>Tech/Normal</span>";
					
							break;
						case 8:
							$priority = "<span style='color: #000000; background-color: #CECEF6; display: block; width: 100%; text-align: center;'>Tech/Low</span>";
					
							break;		
					}
					$statusL = $rst['status'];
						if (strlen($statusL) > 15) 
						{
							$status = substr($statusL, 0, 15) . "...";
						} else {
							$status = $statusL;
						}

					echo '<tr><td>'.$priority.'</td>';
					if ($test){
						echo '<td data-value="'.$createdNumeric.'">'.$created.'</td>';
					} else {
						echo '<td data-value="'.$createdNumeric.'">'.$submitTime.'</td>';
					}
					echo '<td><span class="yahoo" title="'.$requestedbyL.'">'.$requestedby.'</span></td>';
					echo '<td>'.$building.'</td>';
					echo '<td><span class="yahoo" title="'.$problems.'">'.$problem.'</span></td>';	
					echo '<td>'.$technician.'</td>';
					echo '<td><span class="yahoo" title="'.$statusL.'">'.$status.'</span></td>';
					if ($_SESSION['id']) {
						echo '<td><a href="edit.php?id='.$id.'">Edit</a></td></tr>';
					} else {
						echo '<td><a href="edit.php?id='.$id.'">View</a></td></tr>';
					}
			
				} while ($rst = mysql_fetch_array($results));
				
			?>
			</tbody>
		</table>
		<?php
			} else {
				print 'Sorry, no tech workorders found.  Please try again.<br />';
		}
		?>
		<br />
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
					<td colspan="2">
						<a href="feedback.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Submit Feedback</a>
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
			<br />
			<table align="center">
				<tr>
					<td>
						<a href="new.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Submit Work Order</a>
					</td>
					<td>
						<a href="mobilelogin.php"  data-theme="a" data-role="button" data-ajax="false" data-mini="true">Log In</a>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<a href="feedback.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Submit Feedback</a>
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


