<?php 
require 'assets/header.php' ;
include 'assets/classes/user.php';
include 'assets/classes/post.php';

if(isset($_POST['post'])){
// upload image
    $uploadOk = 1;
    $imageName = $_FILES['fileToUpload']['name'];
    $errorMessage = "";

    if($imageName != ""){
        $targetDir = "assets/images/posts/";
        $imageName = $targetDir . uniqid() . basename($imageName);
        $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

        if($_FILES['fileToUpload']['size'] > 10000000){
            $errorMessage = "file is too big!";
            $uploadOk = 0;
        }

        if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "gif"){
            $errorMessage = "sorry! only jpeg, jpg and png files are allowed :(";
            $uploadOk = 0;
        }

        if($uploadOk){
            if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)){
                // image uploaded ok!!
            }
            else{
                // img did not upload :(
                    $uploadOk = 0;
            }
        }

    }

    if($uploadOk){
        $post = new Post($conn, $userLoggedIn);
        $post->submitPost($_POST['post-text'], 'none', $imageName);
    }
    else{
        echo '<script>alert("failed to post.")</script>';
    }


    $post = new post($conn, $userLoggedIn);
    $post->submitPost($_POST['post_text'],'none', $imageName);
    header('location:index.php');



}


?>
<div class="centerer">
    <div class="wrapper-whole"> <!-- content wrapper whole-->
        <div class="wrapper-profile"> <!-- wrapper for the profile -->
             <img src="<?php echo $user['profile_picture'];?>" class='pfp' alt=""> 

            <a class="display-name">
                @<?php echo $user['username'];?>
            </a>
            <p class="bio">
                <?php echo $user['bio']?>
            </p>
            <div class="btns">
            <a href='settings.php'>
                <button  class='edit-prof-btn'>
                EDIT PROFILE
                </button>
            </a>
            <a href="assets/logout.php" class='logout-btn'>
            LOG OUT
            </a>
            </div>
        </div><!-- wrapper for the profile -->

        <div class="timeline">
            <form action="index.php" class="posts" method="POST" enctype="multipart/form-data">
                <textarea name="post_text" id="post_text" placeholder="What's the latest buzz?"></textarea>
                <div class="sameline">
                <input type="submit" name="post" id="post_button" class="post-btn" value="Buzz!">
                <input type="file" name="fileToUpload" id="fileToUpload" style='font-family: oxygen'>
                 </div>
            </form>
     
            <div class="posts_area"></div>
		<img id="loading" src="assets/images/loading.gif">

	</div>

	<script>
        $(function(){
            
            var userLoggedIn = '<?php echo $userLoggedIn; ?>';
            var inProgress = false;

            loadPosts(); //Load first posts

            $(window).scroll(function() {
                var bottomElement = $(".status_post").last();
                var noMorePosts = $('.posts_area').find('.noMorePosts').val();

                // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
                if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
                    loadPosts();
                }
            });

        function loadPosts() {
            if(inProgress) { //If it is already in the process of loading some posts, just return
                return;
            }
            
            inProgress = true;
            $('#loading').show();

            var page = $('.posts_area').find('.nextPage').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'

            $.ajax({
                url: "assets/includes/ajax_load_posts.php",
                type: "POST",
                data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                cache:false,

                success: function(response) {
                    $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
                    $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
                    $('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

                    $('#loading').hide();
                    $(".posts_area").append(response);

                    inProgress = false;
                }
            });
        }

        //Check if the element is in view
            function isElementInView (el) {
                var rect = el.getBoundingClientRect();

                return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && 
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth) 
                );
            }
        });

        </script>
    </div><!-- content wrapper whole-->
</div>
</body>
</html>