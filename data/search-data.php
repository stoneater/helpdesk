<?php

    /* Database setup information */
    $dbhost = 'localhost';  // Database Host
    $dbuser = 'helpdesk';       // Database Username
    $dbpass = 'helpdesk';           // Database Password
    $dbname = 'helpdesk';     // Database Name

    /* Connect to the database and select database */
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
    mysql_select_db($dbname);

    /* The search input from user ** passed from jQuery .get() method */
	$param = $_GET['searchData'];

	$sResults = null;
	
	/* Don't overload phones or mobile devices, make minimum search requirement */	
	if (strlen($param) > 2){

		/* If connection to database, run sql statement. */
		if ($conn) {

			/* Fetch the users input from the database and put it into a
			 valuable $fetch for output to our table. */
			$fetch = mysql_query("SELECT *, DATE_FORMAT(created, '%m/%d/%y') AS created FROM it_data WHERE id LIKE '%$param%' OR created LIKE '%$param%' OR requestedby LIKE '%$param%' OR email LIKE '%$param%' OR building LIKE '%$param%' OR room LIKE '%$param%' OR item LIKE '%$param%' OR stamp LIKE '%$param%' OR status LIKE '%$param%' OR problem LIKE '%$param%' OR assignedto LIKE '%$param%' OR priority LIKE '%$param%' OR solution LIKE '%$param%' OR timeworked LIKE '%$param%' OR completed LIKE '%$param%' LIMIT 150");

			/*
			   Retrieve results of the query to and build the table.
			   We are looping through the $fetch array and populating
			   the table rows based on the users input.
			 */
			while ( $row = mysql_fetch_object( $fetch ) ) {
				
				$priorityNumber = $row->priority;
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
				$created = $rs['created'];
				$createdNumeric = strtotime($created);
				$technician = $row->assignedto;
				if ($technician == '') {
				$technician = 'Unassigned';
				}
				$problems = $row->problem;
				$problem = substr($problems, 0, 30).'...';
				$sResults .= '<tr>';
				$sResults .= '<td>' . $priority . '</td>';
				$sResults .= '<td data-value="'.$createdNumeric.'">' . $row->created . '</td>';
				$sResults .= '<td>' . $row->requestedby . '</td>';
				$sResults .= '<td>' . $row->building . '</td>';
				$sResults .= '<td><span id="yahoo" title="'.$problems.'">' . $problem . '</td>';
				$sResults .= '<td>' . $technician . '</td>';
				$sResults .= '<td>' . $row->status . '</td>';				
				$sResults .= '<td><a href="edit.php?id=' . $row->id . '">Edit</td></tr>';
			}

		}

		/* Free connection resources. */
		mysql_close($conn);

		/* Toss back the results to populate the table. */
		echo $sResults;
	}
?>