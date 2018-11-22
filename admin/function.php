 <?php

 //////////////////////////

 // function for add_post.php
 // confirm posts

 function confirmQuery($result) {

    global $connection;

    if (!$result) {
        # code...
        die("Query Failed" .mysqli_error($connection));
    }

 }


///////////////////////////
// function for categories.php
// function for insert various category

function insert_categories(){

    global $connection;

    if(isset($_POST['submit']))
        {
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){

        echo "This field should be filled";
        }
    else
        {
            $query = "INSERT INTO categories(cat_title) VALUES('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query)
            {
                die('QUERY Failed' . mysqli_error($connection));
            }

        }
    }

}

//////////////////////////
// displaying category

function findAllCategories() {

    globaL $connection;

    $query = "SELECT * FROM categories";

    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
                # code...
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    // delete category by cat_id
    echo "<td><a href='categories.php?delete={$cat_id}'> Delete </a></td>";
    // update/edit category by cat_id
    echo "<td><a href='categories.php?edit={$cat_id}'> Edit </a></td>";
    echo "</tr>";
    }
}



////////////////////////////
// Delete

function deleteCategories()
{
    global $connection;

    if (isset($_GET['delete'])) {
    
    $the_cat_id = $_GET['delete'];

    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";

    $delete_query = mysqli_query($connection
        , $query );
    // refresh the page
    header("Location: categories.php");
        }
}


?>