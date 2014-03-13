<?php
include_once 'header.php';

$script = $_SERVER['PHP_SELF'];

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
		<label>Enter a keyword to search for:</label>
		<input id="searchData" type="text" />
	<br />
		
		<table class="footable cStoreDataTable" id="cStoreDataTable" data-filter="#filter">
			<thead>
				<tr>
					<th data-class="expand">
						Priority
					</th>						
					<th data-hide="phone, tablet" data-type="numeric">
						Submitted
					</th>
					<th>
						Submitted By
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
			<tbody id="results"></tbody>
		</table>	
		<br />
		<br />
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
<?php include_once 'footer.php';?>


