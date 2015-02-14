<?php include 'includes/header.php' ; ?>

<?php 

	$DB = new Database();

	if (isset($_GET['category'])) {
		
		$category = $_GET['category'];
		$query = 'SELECT * FROM posts WHERE category=:category';

	} else {
		
		$query = 'SELECT * FROM posts';

	}

	// Get posts
	$DB->query($query);

	if (isset($category)) {
		$DB->bind(':category', $category);
	}

	$posts = $DB->resultset();
	$total = $DB->rowCount();
	?>
	
	<?php if ($total > 0): ?>
		<?php foreach ($posts as $post): ?>
			<div class="blog-post">
				<h2 class="blog-post-title"><?php echo $post['title'] ?></h2>
				<p class="blog-post-meta"><?php echo formatDate($post['date']) ?> by <a href="#"><?php echo $post['author'] ?></a></p>
				<?php echo shortenText($post['body']) ?>
				<a class="readmore" href="post.php?id=<?php echo urlencode($post['id']) ?>">Read More</a>
			</div><!-- /.blog-post -->
		<?php endforeach ?>
	<?php else: ?>
		<p>There are no posts yet</p>
	<?php endif ?>
		
<?php include 'includes/footer.php' ?>