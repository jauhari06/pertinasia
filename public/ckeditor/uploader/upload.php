<?php
//$host = "http://".$_SERVER['HTTP_HOST']."/";
$host = "http://".$_SERVER['HTTP_HOST']."/";
$folder = 'ckeditor/images-media/';
//$url = $host.$folder.time()."_".$_FILES['upload']['name'];
$url = "../img/ckeditor_image/".time()."_".$_FILES['upload']['name'];
 //extensive suitability check before doing anything with the file…
    if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
    {
       $message = "No file uploaded.";
    }
    else if ($_FILES['upload']["size"] == 0)
    {
       $message = "The file is of zero length.";
    }
    else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
    {
       $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
    }
    else {
      $message = "";
   
      $move = move_uploaded_file($_FILES['upload']['tmp_name'], "../../../img/ckeditor_image/".time()."_".$_FILES['upload']['name']);
      if(!$move)
      {
         $message = "Error moving uploaded file."."../../../img/ckeditor_image/".time()."_".$_FILES['upload']['name'];
      }
      $url = $url;
    }
$funcNum = $_GET['CKEditorFuncNum'] ;
echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
?>