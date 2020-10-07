<!DOCTYPE html>
<html>
<head>
	<title>PDO - Update a Record - PHP CRUD Tutorial</title>

	<!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
	<!-- container -->
	<div class="container">
		<div class="page-header">
			<h1>Update Product</h1>		
		</div>
	
	<?php
	//Get passed parameter value, in this case, the record ID
	//isset() is a PHP function used to verify if a value is there or not
	$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

	//Include database configuration
	include 'config/database.php';

	//Read current record's data
	try {
		//Prepare select query
		$query = "SELECT id,name,description, price FROM products WHERE id = ? LIMIT 0,1";
		$stmt = $con->prepare($query);

		//This is the first question mark
		$stmt->bindParam(1,$id);

		//Execute our query
		$stmt->execute();

		//Store retrieved row to a variable
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		//Values to fill up our form
		extract($row);
	} catch (PDOException $e) {
		die('ERROR: ' . $e->getMessage());
	}
	?>

	<?php
	//Check if form was submitted
	if ($_POST) {
		try {
			//Write update query, in this case, it seeemd like we have so many fields to pass and
			//it is batter to label them and not use question marks
			$query = "UPDATE products SET " .
		             "name = :name, " .
		             "description = :description, " .
		             "price = :price " .
		             "WHERE id = :id";			

		    //Prepare query for execution
			$stmt = $con->prepare($query);

			//Posted values
			$name = htmlspecialchars(strip_tags($_POST['name']));
			$description = htmlspecialchars(strip_tags($_POST['description']));
			$price = htmlspecialchars(strip_tags($_POST['price']));

			//Bind the parameters
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':description', $description);
			$stmt->bindParam(':price', $price);
			$stmt->bindParam(':id', $id);

			//Execute the query
			if ($stmt->execute()) {
				echo "<div class='alert alert-success'>Record was updated.</div>";
			} else {
				echo "<div class='alert alert-danger'>Unable to update record. Please try againg</div>";
			}
		} catch (PDOException $e) {
			die('ERROR: '.$e->getMessage());
		}
	}
	?>

	<!-- we have out html form here where new record information can be updated -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
		<table class="table table-hover table-resposive table-bordered">
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>" class="form-control" /></td>			
			</tr>	
			<tr>
				<td>Description</td>
				<td><textarea name="description" class="form-control"><?php echo htmlspecialchars($description, ENT_QUOTES); ?></textarea></td>
			</tr>	
			<tr>
				<td>Price</td>
				<td><input type="text" name="price" value="<?php echo htmlspecialchars($price, ENT_QUOTES); ?>" class="form-control" /></td>			
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" value="Save Changes" class="btn btn-primary">
					<a href="index.php" class="btn btn-danger">Back to read product</a>
				</td>
			</tr>
		</table>
	</form>

	</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
</body>
</html>