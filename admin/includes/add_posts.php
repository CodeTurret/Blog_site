<?php
if(isset($_POST['create_post'])){

	$post_title = $_POST['title'];
	$post_author = $_POST['author'];
	$post_category_id = $_POST['post_category_id'];
	$post_status = $_POST['post_status'];

	$post_image = $_FILES['image']['name'];
	//$_FILES is another super global. Here our file is 
	// an image. we store its name('image' from form) and 'name'=(uploaded
	// file name)
	
	$post_image_temp = $_FILES['image']['tmp_name'];
	// $post_image_temp stores the file temporarily in server
	// next we write a function to store it other place
	
	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];
	$post_date = date('d-m-y');
	$post_comment_counts = 2;


	
	// write function for image file
	// move_uploaded_file(filename, destination)
	
	move_uploaded_file($post_image_temp, "../images/$post_image");

	// query for inserting data into database

	$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_counts, post_status) VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_counts}','{$post_status}')";

	
	$create_post_query = mysqli_query($connection, $query);

	confirmQuery($create_post_query);
}
?>





<form action="" method="post" enctype="multipart/form-data">
	
	<!-- enctype is used for different type of input such as text, image etc. -->



	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title">
	</div>

	<div class="form-group">
		<label for="post_category">Post Category Id</label>
		<input type="text" class="form-control" name="post_category_id">
	</div>

	<div class="form-group">
		<label for="title">Post Author</label>
		<input type="text" class="form-control" name="author">
	</div>

	<div class="form-group">
		<label for="post_status">Post Status</label>
		<input type="text" class="form-control" name="post_status">
	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" class="" name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="7"></textarea>
	</div>

	<div class="form-group">
		
		<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
	</div>


</form>