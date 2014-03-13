<?php include 'header.php'; ?>

	<div data-role="header" data-theme="c" data-inline="true">
		<h2>View All</h2>
	</div><!-- /header -->	

<?php
$query = sprintf("SELECT * FROM balance ORDER BY date DESC");
$querySum = sprintf("SELECT SUM(amount) AS total FROM balance");
	
	$result = mysql_query($query);
	$results = mysql_query($querySum);	
	
	$num = mysql_num_rows($result);

	if ($num > 0){ // If it ran OK, display the records.
	
	// Fetch and print all the records:
	$count = mysql_num_rows($result);
	?>
	<br />
	Record(s) Found: <?php print $count?><br />
	<br />
	<br />
	
	<?php
	if ($rs = mysql_fetch_array($result, MYSQL_ASSOC))
		{

	//Create a table and populate it
	?>
	Search: <input id="filter" type="text" />
	<br />
	<table class="footable" data-filter="#filter">
		<thead>
			<tr>
				<th data-class="expand">
					Date
				</th>
				<th>
					Location
				</th>
				<th data-hide="phone">
					Category
				</th>
				<th>
					Amount
				</th>
				<th data-hide="phone">
					Card
				</th>
				<th data-hide="phone,tablet">
					Statement
				</th>
				<th data-hide="phone,tablet">
					Paid
				</th>
				<th data-hide="phone,tablet">
					Notes
				</th>
				<th data-hide="phone,tablet">
					Edit
				</th>				
			</tr>
		</thead>
		<?php
			do
			{
				$id = $rs['id'];
				$date = $rs['date'];
				$location = $rs['location'];
				$category = $rs['category'];
				$amount = $rs['amount'];
				$card = $rs['card'];
				$statement = $rs['statement'];
				$paid = $rs['paid'];
				$notes = $rs['notes'];		
		
				echo '<tr><td>'.$date.'</td>';
				echo '<td>'.$location.'</td>';
				echo '<td>'.$category.'</td>';
				echo '<td>$'.$amount.'</td>';
				echo '<td>'.$card.'</td>';
				echo '<td>'.$statement.'</td>';
				echo '<td>'.$paid.'</td>';
				echo '<td>'.$notes.'</td>';
				echo '<td><a href="edit.php?id='.$id.'">Edit Record</a></td></tr>';
		
			} while ($rs = mysql_fetch_array($result));
			
		?>
	</table>
	<?php
			//Echo total running balance
			while($row = mysql_fetch_array($results)){		
				$totalAmount = $row['total'];
				print "<br />";					
				print "<b>Current Available Balance: </b>$";
				print $totalAmount;
			}
		} else {
			print 'Sorry, no results found for your search of ' . $query . '.  Please try again.<br />';
		}
	}
	include_once 'footer.php';
	?>