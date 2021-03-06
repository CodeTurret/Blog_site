<?php

	if(isset($_GET['p_id'])){

		$the_post_id = $_GET['p_id'];
	}

	$query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";

    $select_posts_by_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
                # code...
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_counts = $row['post_comment_counts'];
        

    }

    // after click "update_post"

    if(isset($_POST['update_post']))
    {
    	$post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        //$post_date = $row['post_date'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
    
    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image))
    {
    	$query = "SELECT * FROM posts WHERE post_id = $the_post_id";

    	$select_image = mysqli_query($connection, $query);
    	while ($row = mysqli_fetch_array($select_image))
    	{
    		$post_image = $row['post_image'];
    	}
    }


    $query = "
    	UPDATE posts SET
    	post_title = '{$post_title }', 
    	post_category_id = '{$post_category_id}', 
    	post_date = now(), 
    	post_author = '{$post_author}', 
    	post_status = '{$post_status}', 
    	post_tags = '{$post_tags}', 
    	post_content = '{$post_content}', 
    	post_image = '{$post_image}'
    	WHERE post_id = '{$the_post_id}'
    	";

    	$update_post = mysqli_query($connection, $query);

    	confirmQuery($update_post);
    }

?>

<form action="" method="post" enctype="multipart/form-data">
	
	<!-- enctype is used for different type of input such as text, image etc. -->



	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="post_title"
		value="<?php echo $post_title; ?>">
	</div>

	<div class="form-group">
		
		<select name="post_category" id="">

		<?php
		$query = "SELECT * FROM categories";

		$select_categories = mysqli_query($connection, $query);

		confirmQuery($select_categories);

		while ($row = mysqli_fetch_assoc($select_categories)) {
		# code...
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];
		
		
			echo "<option value='{$cat_id}'> {$cat_title} </option>";

			}

			?>


		</select>


		<!-- <label for="post_category">Post Category Id</label>
		<input type="text" class="form-control" name="post_category_id" value="<?php //echo $post_category_id; ?>"> -->
	</div>

	<div class="form-group">
		<label for="title">Post Author</label>
		<input type="text" class="form-control" name="post_author"
		value="<?php echo $post_author; ?>">
	</div>

	<div class="form-group">
		<label for="post_status">Post Status</label>
		<input type="text" class="form-control" name="post_status"
		value="<?php echo $post_status; ?>">
	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label>
		<img height="50" width="100" src="../images/<?php echo $post_image; ?>">
		 <input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags"
		value="<?php echo $post_tags; ?>">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="7"
		> <?php echo $post_content; ?></textarea>
	</div>

	<div class="form-group">
		
		<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
	</div>


</form>