<?php

    /* Database setup information */
    $dbhost = 'localhost';  // Database Host
    $dbuser = 'helpdesk';       // Database Username
    $dbpass = 'helpdesk';           // Database Password
    $dbname = 'inventory';     // Database Name

    /* Connect to the database and select database */
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
    mysql_select_db($dbname);

    /* The search input from user ** passed from jQuery .get() method */
    $param = $_GET['searchData'];

    /* If connection to database, run sql statement. */
    if ($conn) {

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $fetch = mysql_query("SELECT *, DATE_FORMAT(created, '%m/%d/%y') AS created FROM inventory WHERE inventory_id LIKE '%$param%' OR SN LIKE '%$param%' OR building LIKE '%$param%' OR room LIKE '%$param%' OR common_name LIKE '%$param%' OR hw_type LIKE '%$param%' OR purchase_date LIKE '%$param%' OR warranty_expire LIKE '%$param%' ");

        /*
           Retrieve results of the query to and build the table.
           We are looping through the $fetch array and populating
           the table rows based on the users input.
         */
		if ($row = mysql_fetch_array($fetch, MYSQL_ASSOC))		 
		do
		{
			$id = $row['inventory_id'];
			$SN = $row['SN'];
			$building = $row['building'];
			$room = $row['room'];
			$common_name = $row['common_name'];
			$hw_type = $row['hw_type'];
			$purchase_date = $row['purchase_date'];
			$warranty_expire = $row['warranty_expire'];

            echo '<tr><td>'.$SN.'</td>';	
			echo '<td>'.$building.'</td>';
			echo '<td>'.$room.'</td>';
			echo '<td>'.$common_name.'</td>';
			echo '<td>'.$hw_type.'</td>';
			echo '<td>'.$inventory_id.'</td>';
			echo '<td>'.$purchase_date.'</td>';
			echo '<td>'.$warranty_expire.'</td>';	
			echo '<td><a href="edit.php?inventory_id='.$inventory_id.'">Edit</td></tr>';			
		}
        while ( $row = mysql_fetch_object( $fetch ) )
		}
    }

    /* Free connection resources. */
    mysql_close($conn);

    /* Toss back the results to populate the table. */
   // echo $sResults;

?>