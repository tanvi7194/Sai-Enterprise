<?php

require_once 'Database.php';

class Forum
{

     private $db_host = "localhost";
            private $db_username = "root";
            private $db_pass ="";
            private $db = "sai_enterprise";
            public $con;
           
            public function __construct()
            {
                 $this->con=Database::connect($this->db_host, $this->db_username, $this->db_pass, $this->db);
            }

            public function getForumCategory()
            {

                 $getCategory = mysqli_query($this->con,"select * from se_forum_category");
                 if($getCategory)
                 {
                     return $getCategory;
                     mysqli_close($this->con);
                 }
                 else
                 {
                     return "Fail".  mysqli_error();
                     mysqli_close($this->con);
                 }
            }

            public function getNoOfTopics($catid)
            {
                $getTopics = mysqli_query($this->con,"select * from se_forum_topic where topic_cat=$catid");
                if($getTopics)
                 {
                     return $getTopics;
                     mysqli_close($this->con);
                 }
                 else
                 {
                     return "Fail".  mysqli_error();
                     mysqli_close($this->con);
                 }
            }

            public function addNewTopic($subject,$category,$userid)
            {
                
                $addtopic = mysqli_query($this->con,"insert into se_forum_topic(subject,topic_cat,topic_by) values ('$subject',$category,$userid)");
                if($addtopic)
                {
                 return "Success";
                 mysqli_close($this->con);
                }
                else
                {
                    return mysqli_error();
                    mysqli_close($this->con);
                }


            }
            public function addNewQuestion($question,$subject,$userid)
            {
                $gettopicId = mysqli_query($this->con,"select * from se_forum_topic where subject='$subject'");
                $currentdate = date("Y/m/d");
                while($rows = mysqli_fetch_array($gettopicId,MYSQLI_BOTH))
                {
                    $id=$rows["forum_topic_id"];
                }
                $addques = mysqli_query($this->con,"insert into se_forum_posts (post_content,post_date,post_topic,post_by) values('".$question."','".$currentdate."',".$id.",".$userid.")");

                if($gettopicId && $addques)
                {
                    return "Success";
                 mysqli_close($this->con);
                }
                else
                {
                    return mysqli_error();
                   mysqli_close($this->con);
                }
            }

            public function getTopics($cat_id)
            {
                $gettopics = mysqli_query($this->con,"select * from se_forum_topic where topic_cat=".$cat_id);
                if($gettopics)
                {
                    return $gettopics;
                    mysqli_close($this->con);
                }
                else
                {
                    return mysqli_error();
                    mysqli_close($this->con);
                }
            }
            public function getTopicBy($userid)
            {
                $gettopicby = mysqli_query($this->con,"select * from se_user where u_id=".$userid);
                if($gettopicby)
                {
                    while($row=  mysqli_fetch_array($gettopicby,MYSQLI_BOTH))
                    {
                         return $row["u_fname"];
                    }
                   
                    mysqli_close($this->con);
                }
                else
                {
                    return mysqli_error();
                    mysqli_close($this->con);
                }
            }
            public function getNoOfPosts($topicid)
            {
                $getNoOfPosts = mysqli_query($this->con,"select * from se_forum_posts where post_topic=".$topicid);
                if($getNoOfPosts)
                {
                    return $getNoOfPosts;
                    mysqli_close($this->con);
                }
                else
                {
                    return mysqli_error();
                    mysqli_close($this->con);
                }
            }
            public function getTopicName($forum_topic_id)
            {
                $gettopicname = mysqli_query($this->con,"select * from se_forum_topic where forum_topic_id=".$forum_topic_id);
                if($gettopicname)
                {
                    return $gettopicname;
                    mysqli_close($this->con);
                }
                else
                {
                    return mysqli_error();
                    mysqli_close($this->con);
                }
            }
            public function getPosts($topic_id)
            {
                $getposts = mysqli_query($this->con,"select * from se_forum_posts where post_topic=".$topic_id);
                if($getposts)
                {
                    return $getposts;
                    mysqli_close($this->con);
                }
                else
                {
                    return mysqli_error();
                   mysqli_close($this->con);
                }
            }
            public function InsertPost($post_content,$post_topic,$post_by)
            {
                $currentdate = date("Y/m/d");
                $insertpost = mysqli_query($this->con,"insert into se_forum_posts (post_content,post_date,post_topic,post_by) values('".$post_content."','".$currentdate."',".$post_topic.",".$post_by.")");
                if($insertpost)
                {
                    return "success";
                   mysqli_close($this->con);
                }
                else
                {
                    return mysqli_error();
                    mysqli_close($this->con);
                }
            }
            public function DeleteTopic($id)
            {
                $deletetopic = mysqli_query($this->con,"delete from se_forum_topic where forum_topic_id=".$id);
                $deletePost = mysqli_query($this->con,"delete from se_forum_posts where post_topic=".$id);
                if($deletetopic && $deletePost)
                {
                    return "success";
                    mysqli_close($this->con);
                }
                else
                {
                    return mysqli_error();
                    mysqli_close($this->con);
                }
            }
            public function DeletePost($id)
            {
                $deletetopic = mysqli_query($this->con,"delete from se_forum_posts where post_id=".$id);

                if($deletetopic)
                {
                    return "success";
                    mysqli_close($this->con);
                }
                else
                {
                    return mysqli_error();
                    mysqli_close($this->con);
                }
            }
}



?>
