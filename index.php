<?php
   include("includes/header.php");
   include("includes/classes/User.php");
   include("includes/classes/Post.php");

   if(isset($_POST['post']))
   {
       $post = new Post($con, $userLoggedIn);
       $post->submitPost($_POST['post_text'], 'none');
       header("Location: index.php");
   }
?>
   
   <div class="user_details column">
       <a href="<?php echo $userLoggedIn; ?>"><img src="<?php echo $user['profile_pic']; ?>"></a>
       <div class="user_details_left_right">
            <a href="<?php echo $userLoggedIn; ?>"><?php echo $user['first_name']." ". $user['last_name']."<br>"; ?></a>
            <?php 
                echo "Posts: ".$user['num_posts']."<br>";
                echo "Likes: ".$user['nums_likes'];
            ?>
       </div>
   </div>

   <div class="main_column column">
      <form class="post_form" action="index.php" method="POST">
          <textarea name="post_text" id="post_text" placeholder="what's on your mind?"></textarea>
          <input type="submit" id="post_button" name="post" value="Post">
          <hr>
        </form>

        <?php 
          $user_obj = new User($con, $userLoggedIn);
          echo $user_obj->getFirstAndLastName();
        ?>
   </div>

</div>
</body>
</html>