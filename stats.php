<?php
include_once 'header.php';

$script = $_SERVER['PHP_SELF'];

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
	<div data-role="dialog" align="center">
		<div data-role="header" data-theme="a">
			<h1>WarriorDesk</h1>
			<a href="#" data-icon="home" data-iconpos="notext" data-direction="reverse" onclick="javascript:location.href='index.php'">Home</a>
		</div><!-- /header -->	
	<br />
		<div data-role="content" class="mybg">
		<b>Workorder Statistics<br /></b>
		<br />
		<table>
			<tr>
				<td colspan="2" align="center"><b><u>Status</u></b></td>
			</tr>
			<tr>
				<td colspan="2" align="center">Total workorders by status</td>
			</tr>
			<tr>
				<td><i>Total Workorders:</i></td>
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data;"))?></i></b></td>
			</tr>
			<tr>
				<td><i>Current New Workorders:</i></td>
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE status LIKE 'New';"))?></i></b></td>
			</tr>
			<tr>				
				<td><i>Current Workorders in Progress:</i></td>
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE status LIKE 'In Progress';"))?></i></b></td>
			</tr>
			<tr>				
				<td><i>Total Completed Workorders:</i></td>
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE status LIKE 'Completed';"))?></i></b></td>
			</tr>
			<tr> </tr>
			<tr> </tr>
			<tr> </tr>
			<tr> </tr>
			<tr> </tr>
			<tr>
				<td colspan="2" align="center"><b><u>Priority</u></b></td>
			</tr>
			<tr>
				<td colspan="2" align="center">Total workorders by priority</td>
			</tr>
			<tr>
				<td><i>Alert:</i></td>			
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE priority LIKE 1;"))?></i></b></td>
			</tr>
			<tr>
				<td><i>High:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE priority LIKE 2;"))?></i></b></td>
			</tr>
			<tr>				
				<td><i>Normal:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE priority LIKE 3;"))?></i></b></td>
			</tr>
			<tr>				
				<td><i>Low:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE priority LIKE 4;"))?></i></b></td>
			</tr>
			<tr> </tr>
			<tr> </tr>
			<tr> </tr>
			<tr> </tr>
			<tr> </tr>			
			<tr>
				<td colspan="2" align="center"><b><u>Building</u></b></td>
			</tr>
			<tr>
				<td colspan="2" align="center">Total workorders by building</td>
			</tr>
			<tr>		
				<td><i>Central:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE building LIKE 'Central';"))?></i></b></td>
			</tr>
			<tr>
				<td><i>High:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE building LIKE 'High';"))?></i></b></td>
			</tr>
			<tr>				
				<td><i>Middle:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE building LIKE 'Middle';"))?></i></b></td>
			</tr>
			<tr>				
				<td><i>Upper:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE building LIKE 'Upper';"))?></i></b></td>
			</tr>
			<tr>				
				<td><i>Primary:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE building LIKE 'Primary';"))?></i></b></td>
			</tr>
			<tr> </tr>
			<tr> </tr>
			<tr> </tr>
			<tr> </tr>
			<tr> </tr>			
			<tr>
				<td colspan="2" align="center"><b><u>Technician</u></b></td>
			</tr>
			<tr>
				<td colspan="2" align="center">Total workorders by technician</td>
			</tr>
			<tr>		
				<td><i>Richard Fletcher:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE assignedto LIKE 'Richard Fletcher';"))?>
			</tr>
			<tr>				
				<td><i>Jay Fude:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE assignedto LIKE 'Jay Fude';"))?>
			</tr>
			<tr>				
				<td><i>Matt Henshaw:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE assignedto LIKE 'Matt Henshaw';"))?>
			</tr>
			<tr>				
				<td><i>Randy Wallace:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE assignedto LIKE 'Randy Wallace';"))?>
			</tr>
			<tr>				
				<td><i>Jodi Egbert:</i></td>	
				<td><b><i><?php print mysql_num_rows(mysql_query("SELECT id FROM it_data WHERE assignedto LIKE 'Jodi Egbert';"))?>
			</tr>
		</table>
		<br />
		<br />
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
						<a href="index.php" data-theme="a" data-role="button" data-ajax="false" data-mini="true">Open Workorders</a>	
					</td>
				</tr>
				<tr>
					<td colspan="2">
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
include_once 'footer.php';?>


