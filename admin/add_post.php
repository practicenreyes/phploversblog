<?php include 'includes/header.php' ; ?>
<?php 

    $DB = new Database();

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
    		$query = "INSERT INTO posts(title, body, category, author, tags) VALUES (:title, :body, :category, :author, :tags)";
    		$DB->query($query);
    		$DB->bind(':title', $title);
    		$DB->bind(':body', $body);
    		$DB->bind(':category', $category);
    		$DB->bind(':author', $author);
    		$DB->bind(':tags', $tags);

    		$DB->execute();
    		$message = 'The post was saved succefully';
    		$alert = 'success';
    	}
    }

    //Select categories
	$query = "SELECT * FROM categories";
	$DB->query($query);
	$categories = $DB->resultset();
 ?>
 <?php if (isset($message)): ?>
 	<div class="alert alert-<?php echo $alert ; ?>" role='alert'><p><?php echo $message ; ?></p></div>
 <?php endif ?>
<form role="form" method="post" action="add_post.php">
	<div class="form-group">
		<label>Post Title</label>
		<input name="title" type="text" class="form-control" placeholder="Enter Title">
	</div>
	<div class="form-group">
		<label>Post Body</label>
		<textarea name="body" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label>Category</label>
		<select name="category" class="form-control">
			<?php foreach ($categories as $category): ?>
				<option value="<?php echo $category['id'] ; ?>"><?php echo $category['name'] ; ?></option>
			<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Author</label>
		<input name="author" type="text" class="form-control" placeholder="Enter Author Name">
	</div>
	<div class="form-group">
		<label>Tags</label>
		<input name="tags" type="text" class="form-control" placeholder="Enter Tags">
	</div>
	<div>
		<button name="submit" type="submit" class="btn btn-default">Submit</button>
		<a href="index.php" class="btn btn-warning">Cancel</a>
	</div>
	<br>
</form>

<?php include 'includes/footer.php' ; ?>