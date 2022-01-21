<?php
class post {
    private $user_obj;
    private $conn;
   public function __construct($conn, $user){
        $this->conn = $conn;
        $this->user_obj = new user($conn, $user);   
   }

   public function submitPost($body, $user_to, $imageName){
       $body = strip_tags($body); //removes any html tags
       $body = mysqli_real_escape_string($this->conn, $body);

       $body = str_replace('\r\n', '\n' , $body);
       $body = nl2br($body);

      $check_empty = preg_replace('/\s+/' , '', $body); // deletes all spaces

      //current date and time
      if($check_empty !=""){
          $date_added = date("y-m-d h:i:s");

        //get username
        $added_by = $this->user_obj->getUsername();

        //if user on own prof = none
        if($user_to == $added_by) {
            $user_to = "none";
        }

        //insert post
        $query = mysqli_query($this->conn, "INSERT INTO posts VALUES('', '$body','$added_by','$date_added','0','no','$imageName')");
        $returned_id = mysqli_insert_id($this->conn);

      }
   }

   public function loadPosts($data, $limit){
        $page = $data['page'];
        $userLoggedIn = $this->user_obj->getUsername();

        if($page == 1)
            $start = 0;
        else
            $start = ($page - 1) * $limit;

       $str = "";
       $data_query = mysqli_query($this->conn, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

       if(mysqli_num_rows($data_query) > 0){

        $num_iterations = 0; //number of results
        $count = 1;


        while($row = mysqli_fetch_array($data_query)){
     
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];


            if($num_iterations++ < $start)
                continue; 


            //Once 10 posts have been loaded, break
            if($count > $limit) {
                break;
            }
            else {
                $count++;
            }

                
                $user_details_query = mysqli_query($this->conn, "SELECT username, profile_picture FROM users WHERE username='$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $username = $user_row['username'];
                $profile_pic = $user_row['profile_picture'];

             
                
                ?>


                <script>
                    function toggle<?php echo $id; ?>() {

                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block") 
                            element.style.display = "none";
                        else 
                            element.style.display = "block";
						}
					</script>



                <?php   
                    $comments_check = mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id='$id'");
                    $comments_check_num = mysqli_num_rows($comments_check);
                    

                //timestamp
                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time); //Time of post
                $end_date = new DateTime($date_time_now); //Current time
                $interval = $start_date->diff($end_date); //Difference between dates 
                if($interval->y >= 1) {
                    if($interval == 1)
                        $time_message = $interval->y . " year ago"; //1 year ago
                    else 
                        $time_message = $interval->y . " years ago"; //1+ year ago
                }
                else if ($interval-> m >= 1) {
                    if($interval->d == 0) {
                        $days = " ago";
                    }
                    else if($interval->d == 1) {
                        $days = $interval->d . " day ago";
                    }
                    else {
                        $days = $interval->d . " days ago";
                    }


                    if($interval->m == 1) {
                        $time_message = $interval->m . " month". $days;
                    }
                    else {
                        $time_message = $interval->m . " months". $days;
                    }

                }
                else if($interval->d >= 1) {
                    if($interval->d == 1) {
                        $time_message = "Yesterday";
                    }
                    else {
                        $time_message = $interval->d . " days ago";
                    }
                }
                else if($interval->h >= 1) {
                    if($interval->h == 1) {
                        $time_message = $interval->h . " hour ago";
                    }
                    else {
                        $time_message = $interval->h . " hours ago";
                    }
                }
                else if($interval->i >= 1) {
                    if($interval->i == 1) {
                        $time_message = $interval->i . " minute ago";
                    }
                    else {
                        $time_message = $interval->i . " minutes ago";
                    }
                }
                else {
                    if($interval->s < 30) {
                        $time_message = "Just now";
                    }
                    else {
                        $time_message = $interval->s . " seconds ago";
                    }
                }

                // uploaded image
                if($imagePath != ""){
                        $imageDiv = "<div class='posted-image'>
                                        <img src='$imagePath'>
                                    </div>";
                    }
                    else{
                        $imageDiv = "";
                    }


                $str .= "<div class='status_post' onClick='javascript:toggle$id()'>
                    <div class='post-container'>
                            <div class='post_profile_pic'>
                                <img src='$profile_pic' class='post-pfp'>
                            </div>
                            <div class='posted_by'>
                                <a class='post-username'> @$username </a> <br>
                            <p class='time'>$time_message</p> 
                            </div>
                            </div>
                            <div id='post_body' class='post-body'>
                                $body
                                <br>
                                $imageDiv
                                <br>
                            </div>
                            <div class='newsfeedoptions' >
                            REPLIES: ($comments_check_num)
                           
                        </div>
                        <div class='likes-inline'>
                        <iframe src='likes.php?post_id=$id' id='likes-iframe' style='height:40px; width:20px; font-family:oxygen; margin-left: 10px;'></iframe> 
                        </div>
                    
                           
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                            <iframe src='comments_frame.php?post_id=$id' id='comment_iframe'></iframe>

                            </div>
                        </div>
                        ";
            }




    

			if($count > $limit) 
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
			else 
				$str .= "<input type='hidden' class='noMorePosts' value='true'> <p style='text-align: center; font-family: viga; font-size: 19px; margin-top: 20px;'> No more bees buzzing :( </p>";

        }

        echo $str;
   }


}
   ?>