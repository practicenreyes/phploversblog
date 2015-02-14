<?php include 'includes/header.php' ; ?>
<?php 

    $DB = new Database();

    $id = $_GET['id'];

    if (isset($_POST['delete'])) {
    	$query = 'DELETE FROM posts WHERE id=:id';
    	$DB->query($query);
    	$DB->bind(':id', $id);
    	$delete_row = $DB->execute();

    	if ($delete_row) {
    		header('location: index.php?msg='. urlencode('Post Deleted'));
    		exit();
    	} else {
    		$message = 'Error';
    		$alert = 'danger';
    	}
    }

    if (isset($_POST['submit'])) {
    	$title = $_POST['title'];
    	$body = $_POST['body'];
    	$category = $_POST['category'];
    	$author = $_POST['author'];
    	$tags = $_POST['tags'];

    	if ($title == '' || $body == '' || $author == '' || $category == '') {
    		$message = 'Please fill all required fields';
    		$alert = 'danger';
    	} else {
    		$query = "UPDATE posts 
    				  SET title=:title, body=:body, category=:category, author=:author, tags=:tags 
    				  WHERE id=:id";
    		$DB->query($query);
    		$DB->bind(':title', $title);
    		$DB->bind(':body', $body);
    		$DB->bind(':category', $category);
    		$DB->bind(':author', $author);
    		$DB->bind(':tags', $tags);
    		$DB->bind(':id', $id);

    		$DB->execute();
    		$message = 'The post was updated succefully';
    		$alert = 'success';
    	}
    }

    $query = "SELECT * FROM posts WHERE id=:id";

    $DB->query($query);
    $DB->bind(':id', $id);

    $post = $DB->single();

    //Select categories
	$query = "SELECT * FROM categories";
	$DB->query($query);
	$categories = $DB->resultset();
 ?>
<?php if (isset($message)): ?>
	<div class="alert alert-<?php echo $alert ; ?>" role='alert'><p><?php echo $message ; ?></p></div>
<?php endif ?>
<form role="form" method="post" action="edit_post.php?id=<?php echo $id ?>">
	<div class="form-group">
		<label>Post Title</label>
		<input name="title" type="text" class="form-control" placeholder="Enter Title" value="<?php echo $post['title'] ; ?>">
	</div>
	<div class="form-group">
		<label>Post Body</label>
		<textarea name="body" class="form-control"><?php echo $post['body'] ; ?></textarea>
	</div>
	<div class="form-group">
		<label>Category</label>
		<select name="category" class="form-control">
			<?php foreach ($categories as $category): ?>
				<?php if ($category['id'] == $post['category']) {
					$selected = 'selected';
				} else {
					$selected = '';
				} ?>
				<option <?php echo $selected ?> value="<?php echo $category['id'] ; ?>"><?php echo $category['name'] ; ?></option>
			<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Author</label>
		<input name="author" type="text" class="form-control" placeholder="Enter Author Name" value="<?php echo $post['author'] ; ?>">
	</div>
	<div class="form-group">
		<label>Tags</label>
		<input name="tags" type="text" class="form-control" placeholder="Enter Tags" value="<?php echo $post['tags'] ; ?>">
	</div>
	<div>
		<button name="submit" type="submit" class="btn btn-default">Submit</button>
		<a href="index.php" class="btn btn-warning">Cancel</a>
		<input name="delete" type="submit" class="btn btn-danger" value="Delete"/>
	</div>
	<br>
</form>

<?php include 'includes/footer.php' ; ?>