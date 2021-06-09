<?php
	function getPublishedPosts() {
		global $conn;
    	//$result = $conn->query("SELECT * FROM posts  WHERE published=true ORDER BY posts.created_at DESC ");
		$result = $conn->query("SELECT * FROM posts INNER JOIN users ON posts.user_id=users.user_id WHERE published=true ORDER BY posts.created_at DESC ");
		// fetch all posts as an associative array called $posts
		$posts = $result->fetchAll(PDO::FETCH_ASSOC);
		$final_posts = array();
		foreach ($posts as $post) {
			$post['category'] = getPostCategory($post['id']); 
			array_push($final_posts, $post);
		}
		return $final_posts;
    }
	/* * * * * * * * * * * * * * *
	* Receives a post id and
	* Returns category of the post
	* * * * * * * * * * * * * * */
	function getPostCategory($post_id){
		global $conn;
		$result = $conn->query("SELECT * FROM categories WHERE id=(SELECT category_id FROM post_category WHERE post_category.post_id=$post_id)  LIMIT 1");
		$category = $result->fetch(PDO::FETCH_ASSOC);
		return $category;
	}
	/* * * * * * * * * * * * * * * *
	* Returns all posts under a category
	* * * * * * * * * * * * * * * * */
	function getPublishedPostsByCategory($category_id) {
		global $conn;
		$sql = "SELECT * FROM posts ps INNER JOIN users ON ps.user_id=users.user_id
				WHERE ps.published=true AND ps.id IN 
				(SELECT pc.post_id FROM post_category pc 
					WHERE pc.category_id=$category_id GROUP BY pc.post_id 
					HAVING COUNT(1) = 1)";
		$result = $conn->query($sql);
		// fetch all posts as an associative array called $posts
		$posts = $result->fetchAll(PDO::FETCH_ASSOC);
		$final_posts = array();
		foreach ($posts as $post) {
			$post['category'] = getPostCategory($post['id']); 
			array_push($final_posts, $post);
		}
		return $final_posts;
	}
	/* * * * * * * * * * * * * * * *
	* Returns all posts under a category
	* * * * * * * * * * * * * * * * */
	function getRelatedPostsByCategory($category_id, $clicked_post_id) {
		global $conn;
		$sql = "SELECT * FROM posts ps INNER JOIN users ON ps.user_id=users.user_id
				WHERE ps.published=true AND ps.id!=$clicked_post_id AND ps.id IN 
				(SELECT pc.post_id FROM post_category pc 
					WHERE pc.category_id=$category_id GROUP BY pc.post_id 
					HAVING COUNT(1) = 1)  ORDER BY `ps`.`created_at` DESC LIMIT 3";
		$result = $conn->query($sql);
		// fetch all posts as an associative array called $posts
		$posts = $result->fetchAll(PDO::FETCH_ASSOC);
		$final_posts = array();
		foreach ($posts as $post) {
			$post['category'] = getPostCategory($post['id']); 
			array_push($final_posts, $post);
		}
		return $final_posts;
	}
	/* * * * * * * * * * * * * * * *
	* Returns category name by topic id
	* * * * * * * * * * * * * * * * */
	function getCategoryNameById($id){
		global $conn;
		$sql = "SELECT categories.name FROM categories WHERE id=$id";
		$result = $conn->query($sql);
		$category = $result->fetch(PDO::FETCH_ASSOC);
		return $category['name'];
	}
	/* * * * * * * * * * * * * * *
	* Returns a single post
	* * * * * * * * * * * * * * */
	function getPost($slug){
		global $conn;
		// Get single post slug
		$post_slug = $_GET['post-slug'];
		$sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id=users.user_id WHERE slug='$post_slug' AND published=true";
		$result = $conn->query($sql);
		// fetch query results as associative array.
		$post = $result->fetch(PDO::FETCH_ASSOC);
		if ($post) {
			// get the category to which this post belongs
			$post['category'] = getPostCategory($post['id']);
		}
		return $post;
	}
	/* * * * * * * * * * * *
	*  Returns all categories
	* * * * * * * * * * * * */
	function getAllCategories()	{
		global $conn;
		$sql = "SELECT * FROM categories";
		$result = $conn->query($sql);
		// fetch all posts as an associative array called $posts
		$categories = $result->fetchAll(PDO::FETCH_ASSOC);
		return $categories;
	}
?>