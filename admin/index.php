<?php include 'includes/header.php' ; ?>
<?php 

	$DB = new Database();

	//Select posts
	$query = "SELECT posts.*, categories.name FROM posts
			  INNER JOIN categories
			  ON posts.category=categories.id";
	$DB->query($query);
	$posts = $DB->resultset();

	//Select categories
	$query = "SELECT * FROM categories";
	$DB->query($query);
	$categories = $DB->resultset();
 ?>
 <?php if (isset($_GET['msg'])): ?>
	<div class="alert alert-success" role='alert'><p><?php echo $_GET['msg'] ; ?></p></div>
<?php endif ?>
<table class="table table-striped">
	<tr>
		<th>Post ID#</th>
		<th>Post Title</th>
		<th>Category</th>
		<th>Author</th>
		<th>Date</th>
	</tr>
	<?php foreach ($posts as $post): ?>
		<tr>
			<td><?php echo $post['id'] ?></td>
			<td><a href="edit_post.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a></td>
			<td><?php echo $post['name'] ?></td>
			<td><?php echo $post['author'] ?></td>
			<td><?php echo $post['date'] ?></td>
		</tr>
	<?php endforeach ?>
</table>

<table class="table table-striped">
	<tr>
		<th>Category ID#</th>
		<th>Category Name</th>
	</tr>
	<?php foreach ($categories as $category): ?>
		<tr>
			<td><?php echo $category['id'] ?></td>
			<td><a href="edit_category.php?id=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></td>
		</tr>
	<?php endforeach ?>
</table>

<?php include 'includes/footer.php' ; ?>