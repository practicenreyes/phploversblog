</div><!-- /.blog-main -->

	<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
		<div class="sidebar-module sidebar-module-inset">
			<h4>About</h4>
			<p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
		</div>
		<div class="sidebar-module">
			<h4>Archives</h4>
			<ol class="list-unstyled">
				<?php foreach ($categories as $category) { ?>
					<li><a href="posts.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
				<?php } ?>
			</ol>
		</div>
		<div class="sidebar-module">
			<h4>Elsewhere</h4>
			<ol class="list-unstyled">
				<li><a href="#">GitHub</a></li>
				<li><a href="#">Twitter</a></li>
				<li><a href="#">Facebook</a></li>
			</ol>
		</div>
	</div><!-- /.blog-sidebar -->

</div><!-- /.row -->

</div><!-- /.container -->

<footer class="blog-footer">
	<p>PHPLoversBlog &copy</p>
	<p>
		<a href="#">Back to top</a>
	</p>
</footer>


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>