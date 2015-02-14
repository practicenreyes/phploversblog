<?php include 'includes/header.php' ; ?>
<?php 

    $DB = new Database();

    $id = $_GET['id'];

    if (isset($_POST['delete'])) {
    	$query = 'DELETE FROM categories WHERE id=:id';
    	$DB->query($query);
    	$DB->bind(':id', $id);
    	$delete_row = $DB->execute();

    	if ($delete_row) {
    		header('location: index.php?msg='. urlencode('Category Deleted'));
    		exit();
    	} else {
    		$message = 'Error';
    		$alert = 'danger';
    	}
    }

	if (isset($_POST['submit'])) {
    	$name = $_POST['name'];

    	if ($name == '') {
    		$message = 'Please fill all required fields';
    		$alert = 'danger';
    	} else {
    		$query = "UPDATE categories 
    				  SET name=:name
    				  WHERE id=:id";
    		$DB->query($query);
    		$DB->bind(':name', $name);
    		$DB->bind(':id', $id);
    		$DB->execute();
    		$message = 'The category was updated succefully';
    		$alert = 'success';
    	}
    }

    $query = "SELECT * FROM categories WHERE id=:id";

    $DB->query($query);
    $DB->bind(':id', $id);

    $category = $DB->single();
 ?>
<?php if (isset($message)): ?>
	<div class="alert alert-<?php echo $alert ; ?>" role='alert'><p><?php echo $message ; ?></p></div>
<?php endif ?>
<form role="form" method="post" action="edit_category.php?id=<?php echo $id ; ?>">
	<div class="form-group">
		<label>Category Name</label>
		<input name="name" type="text" class="form-control" placeholder="Enter Category Name" value="<?php echo $category['name'] ; ?>">
	</div>
	<div>
		<input name="submit" type="submit" class="btn btn-default" value="Submit"/>
		<a href="index.php" class="btn btn-warning">Cancel</a>
		<input name="delete" type="submit" class="btn btn-danger" value="Delete"/>
	</div>
	<br>
</form>

<?php include 'includes/footer.php' ; ?>