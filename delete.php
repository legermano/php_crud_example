<?php  
	//Include database connection
	include 'config/database.php';

	try {
		//Get record id
		//isset() is a PHP function used to verify if a value is there or not
		$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

		//Delete query
		$query = "DELETE FROM products WHERE id = ?";
		$stmt = $con->prepare($query);
		$stmt->bindParam(1,$id);

		if ($stmt->execute()) {
			//Redirect to read records page and tell the user record was deleted
			header('Location: index.php?action=deleted');
		} else {
			die('Unable to delete record.');
		}
	} catch (PDOException $e) {
		die('ERROR: '.$e->getMessage());
	}
?>