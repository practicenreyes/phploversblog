<?php include 'includes/header.php' ?>
<?php 

    $DB = new Database();

    $query = "SELECT * FROM posts WHERE id=:id";

    $id = $_GET['id'];

    $DB->query($query);
    $DB->bind(':id', $id);

    $post = $DB->single();

 ?>
  <div class="blog-post">
    <h2 class="blog-post-title"><?php echo $post['title']; ?></h2>
    <p class="blog-post-meta"><?php echo formatDate($post['date']); ?> by <a href="#"><?php echo $post['author']; ?></a></p>

    <?php echo $post['body']; ?>
	
</div><!-- /.blog-post -->
<?php include 'includes/footer.php' ?>
