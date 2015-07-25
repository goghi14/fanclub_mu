<?php
if(!function_exists('p'))
{
    function p($value)
    {
        print '<pre>';
        print_r ($value);
        print '</pre>';
    }
}
if(!function_exists('i'))
{
    function i($i, $w = false, $h = false)
    {
        $h = ($h) ? '&h='.$h : '';
        $w = ($w) ? '&w='.$w : '';

        return base_url('i.php?src='.base_url().'uploads/'.$i.$w.$h);
    }
}

if(!function_exists('grid'))
{
    function grid($value)
    {
        return str_replace('.' , '_c.', $value);
    }
}

if(!function_exists('our_date'))
{
    function our_date()
    {
        date_default_timezone_set('Etc/GMT-3');
        return date("Y-m-d, H:i");
    }
}

if(!function_exists('model_data'))
{
    function model_data($data)
    {
        date_default_timezone_set('Etc/GMT-3');
        $actual_year = date("Y");
        $month = substr($data, 5, -10);
        $date = substr($data, 8, -7);
        $year = substr($data, 0, 4);
        $hour = substr($data, -5);
        if($date[0] == 0) {
            $date = $date[1];
        }
        
        if($month == 01) $month_name = "Ian";
        else if($month == 02) $month_name = "Feb";
        else if($month == 03) $month_name = "Mar";
        else if($month == 04) $month_name = "Apr";
        else if($month == 05) $month_name = "Mai";
        else if($month == 06) $month_name = "Iun";
        else if($month == 07) $month_name = "Iul";
        else if($month == 08) $month_name = "Aug";
        else if($month == 09) $month_name = "Sep";
        else if($month == 10) $month_name = "Oct";
        else if($month == 11) $month_name = "Noi";
        else if($month == 12) $month_name = "Dec";
        
        if($actual_year == $year) {
            $final_date = $date . " " . $month_name . ", " . $hour;
        } else {
            $final_date = $date . " " . $month_name . ", " . $year;
        }
        return $final_date;
    }
}

if(!function_exists('cleanURL'))
{
    function cleanURL($string)
    {
        $url = str_replace("'", '', $string);
        $url = str_replace('%20', ' ', $url);
        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url); // substitutes anything but letters, numbers and '_' with separator
        $url = trim($url, "-");
        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);  // you may opt for your own custom character map for encoding.
        $url = strtolower($url);
        $url = preg_replace('~[^-a-z0-9_]+~', '', $url); // keep only letters, numbers, '_' and separator
        return $url;
    }
}

if(!function_exists('reply_msg'))
{
    function reply_msg($reply_id, $coments) {
            $replies = array();
            $reply = array();
            foreach($coments as $r_comment) {
                if($r_comment->reply_to_msg_id != 0) {
                    if($r_comment->reply_to_msg_id == $reply_id) {  
                        $reply = array(
                                'id' => $r_comment->id,
                                'sender_id' => $r_comment->sender_id,
                                'message' => $r_comment->message,
                                'article_id' => $r_comment->article_id,
                                'like_up' => $r_comment->like_up,
                                'reply_to' => $r_comment->reply_to_msg_id,
                                'added_date' => $r_comment->added_date,
                                'deleted' => $r_comment->deleted,
                            );
                        if(!empty(reply_msg($r_comment->id, $coments))) {
                            $repli = reply_msg($r_comment->id, $coments);
                            array_push($reply, $repli);
                        }
                        array_push($replies, $reply);
                    }
                }
            }
            return $replies;
    }
}

if(!function_exists('checkLikedPermission')) 
{
    function checkLikedPermission($likes_rel, $like_type, $user_id, $comment_id) {
        $like_permission = true;
        foreach($likes_rel as $rel) :
            if(($user_id == $rel->user_id) && ($comment_id == $rel->comment_id)) {
                if($rel->like_type == $like_type) { 
                    $like_permission = false; 
                    break; 
                }
            }
        endforeach;
        return $like_permission;
    }
}

if(!function_exists('checkLikedId')) 
{
    function checkLikedId($likes_rel, $user_id, $comment_id) {
        foreach($likes_rel as $rel) :
            if(($user_id == $rel->user_id) && ($comment_id == $rel->comment_id)) {
                $id = $rel->id;
            }
        endforeach;
        return $id;
    }
}

if(!function_exists('cropAvatar'))
{
    function cropAvatar($img_src, $imgA, $img_path) {
        $imgSrc = $img_src . $imgA;

        //getting the image dimensions
        list($width, $height) = getimagesize($imgSrc);

        //saving the image into memory (for manipulation with GD Library)
        $myImage = imagecreatefromjpeg($imgSrc);

        // calculating the part of the image to use for thumbnail
        if ($width > $height) {
          $y = 0;
          $x = ($width - $height) / 2;
          $smallestSide = $height;
        } else {
          $x = 0;
          $y = ($height - $width) / 2;
          $smallestSide = $width;
        }
        $quality = 60;

        // copying the part into thumbnail
        $thumbSize = 100;
        $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
        imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
        
        // Save Thumbnail
        
        $save_path = ROOT . $img_path . $imgA;
        imagejpeg($thumb,$save_path,$quality);
    }
}

if(!function_exists('getVideoID'))
{
    function getVideoID($url, $type) {
        if($type == 'youtube') {
            $video_id = explode("?v=", $url);
            if (empty($video_id[1]))
                $video_id = explode("/v/", $url);
                
                $video_id = explode("&", $video_id[1]);
                $id = $video_id[0];
        } else if($type == 'facebook') {
            $url = substr($url, 8);
            $url = explode("/", $url);
            $chk = substr($url[3], 0, 2);
            if(!empty($url[3])) {
                if($chk == 'vb') 
                    $id = $url[4];
                else    
                    $id = $url[3];
            }
        } else {
            $id = 0;
        }
            return $id;
    }
}

