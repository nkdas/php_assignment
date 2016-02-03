<?php
require_once('db_connection.php');

$tableColumns = array( 'username', 'firstname', 'middlename', 'lastname', 'suffix', 'gender', 'dob', 'marital', 'employement', 'employer', 'email', 
                'street', 'city', 'state', 'zip', 'telephone', 'mobile', 'fax', 'edit', 'delete');

$output = array("aaData" => array());

$query = mysqli_query($connection, "SELECT username, firstname, middlename, lastname, suffix, gender, dob, marital, employement, employer, email, 
                street, city, state, zip, telephone, mobile, fax
                FROM details");
if ($query) {
	while ($record = mysqli_fetch_assoc($query)) {
		$row = array();
        $numberOfColumns = count($tableColumns);

	    for ( $i = 0; $i < $numberOfColumns; $i++ )
        {
        	if ($i == ($numberOfColumns - 2)) {
                $username = trim($record['username']);
        		$row[] = '<input name="' . $username . '" id="' . $username . '" type="button" class="edit-button btn btn-primary" onclick="editRecord(' . htmlentities(json_encode($record)) . ')" value="Edit">';
        	}
        	else if ($i == ($numberOfColumns - 1)) {
        		$row[] = '<input name="' . $username . '" id="' . $username . '" type="button" class="delete-button btn btn-primary" onclick="confirmDeletion(' .'\'' . $username . '\'' . ')" value="Delete">';
        	}
        	else {
        		$row[] = $record[ $tableColumns[$i] ];
        	}
        }
        $output['aaData'][] = $row;
	}
	echo json_encode( $output );
}
?>