<?php
   include("connection.php");
   include('session.php');

   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $target_dir = "../img/thumbnails/";
     $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
     $uploadOk = 1;
     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

     if(isset($_POST["submit"])) {
         $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
         if($check !== false) {
             echo "File is an image - " . $check["mime"] . ".";
             $uploadOk = 1;
         } else {
             echo "File is not an image.";
             $uploadOk = 0;
         }
     }

     if (file_exists($target_file)) {
         echo "Sorry, file already exists.";
         $uploadOk = 0;
     }

     if ($_FILES["fileToUpload"]["size"] > 5000000) {
         echo "Sorry, your file is too large.";
         $uploadOk = 0;
     }

     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
         echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
         $uploadOk = 0;
     }

     if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";

     }
     else
     {
         if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
         }
         else
         {
             echo "Sorry, there was an error uploading your file.";
         }
     }


      $form_title = mysqli_real_escape_string($conn,$_POST['title']);
      $form_summary = mysqli_real_escape_string($conn,$_POST['summary']);
      $form_content = mysqli_real_escape_string($conn,$_POST['content']);
      $form_tags = mysqli_real_escape_string($conn,$_POST['tags']);
      $form_date = date("Y-m-d H:i");
      $form_category = 1;

      if ($uploadOk == 1) {
        $sql = "INSERT INTO articles (`title`, `author`, `published`, `category`, `summary`, `content`, `thumbnail`, `tags`) VALUES ('$form_title','$login_session','$form_date',$form_category,'$form_summary','$form_content','$target_file','$form_tags')";
      }

      if ($conn->query($sql) === TRUE && $uploadOk == 1) {
          echo "<br>New record created successfully hue";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
   }
?>
<html>
   <body>
     <form action = "" method = "post" enctype="multipart/form-data">
        <label>Title: </label><input type = "text" name = "title"/><br /><br />
        <label>Summary: </label><input type = "text" name = "summary"/><br/><br />
        <label>Content: </label><input type = "text" name = "content"/><br /><br />
        <label>Tags: </label><input type = "text" name = "tags"/><br/><br />
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload"><br>
        <input type = "submit" value = " Submit "/><br />
     </form>
   </body>
</html>
