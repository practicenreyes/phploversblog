<?php include 'includes/header.php' ; ?>
<?php 

    $DB = new Database();

    if (isset($_POST['submit'])) {
    	$name = $_POST['name'];

    	if ($name == '') {
    		$message = 'Please fill all required fields';
    		$alert = 'danger';
    	} else {
    		$query = "INSERT INTO categories(name) VALUES (:name)";
    		$DB->query($query);
    		$DB->bind(':name', $name);
    		$DB->execute();
    		$message = 'The category was saved succefully';
    		$alert = 'success';
    	}
    }
 ?>
<?php if (isset($message)): ?>
 	<div class="alert alert-<?php echo $alert ; ?>" role='alert'><p><?php echo $message ; ?></p></div>
<?php endif ?>
<form role="form" method="post" action="add_category.php">
	<div class="form-group">
		<label>Category Name</label>
		<input name="name" type="text" class="form-control" placeholder="Enter Category Name">
	</div>
	<div>
		<button name="submit" type="submit" class="btn btn-default">Submit</button>
		<a href="index.php" class="btn btn-warning">Cancel</a>
	</div>
	<br>
</form>

<?php include 'includes/footer.php' ; ?>