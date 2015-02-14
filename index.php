<?php include 'includes/header.php' ; ?>

<?php 

	$DB = new Database();

	// All posts
	$query = 'SELECT * FROM posts';
	$DB->query($query);
	$posts = $DB->resultset();

 ?>

<?php foreach ($posts as $post): ?>
	<div class="blog-post">
        <h2 class="blog-post-title"><?php echo $post['title'] ?></h2>
        <p class="blog-post-meta"><?php echo formatDate($post['date']) ?> by <a href="#"><?php echo $post['author'] ?></a></p>
        <?php echo shortenText($post['body']) ?>
        <a class="readmore" href="post.php?id=<?php echo urlencode($post['id']) ?>">Read More</a>
    </div><!-- /.blog-post -->
<?php endforeach ?>
        
<?php include 'includes/footer.php' ?>