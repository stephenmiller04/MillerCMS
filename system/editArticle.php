<?php
   include("connection.php");
   include('session.php');

    $sql = "SELECT articles.id, articles.title, articles.summary, articles.category, categories.name AS categoryname, articles.content, articles.thumbnail, articles.tags FROM articles INNER JOIN categories ON articles.category = categories.id WHERE articles.id=" . htmlspecialchars($_GET["id"]);
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $edit_id = $row["id"];
    $edit_title = $row["title"];
    $edit_summary = $row["summary"];
    $edit_category = $row["category"];
    $edit_categoryname = $row["categoryname"];
    $edit_content = $row["content"];
    $edit_tags = $row["tags"];
    $edit_thumbnail = $row["thumbnail"];

    $sql_c = "SELECT id, name, summary FROM categories ORDER BY id ASC";
    $result_c = $conn->query($sql_c);

   $error = "";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $target_dir = "../img/thumbnails/" . htmlspecialchars($_GET["id"]) . "/";
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
         $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
         $uploadOk = 1;
     }

     if ($_FILES["fileToUpload"]["size"] > 5000000) {
         echo "Sorry, your file is too large.";
         $uploadOk = 0;
     }

     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
         //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
         $uploadOk = 0;
     }

     if ($uploadOk == 0) {
         //echo "Sorry, your file was not uploaded.";

     }
     else
     {
         if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
         }
         else
         {
             //echo "Sorry, there was an error uploading your file.";
         }
     }


      $form_title = mysqli_real_escape_string($conn,$_POST['title']);
      $form_summary = mysqli_real_escape_string($conn,$_POST['summary']);
      $form_content = mysqli_real_escape_string($conn,$_POST['content']);
      $form_tags = mysqli_real_escape_string($conn,$_POST['tags']);
      $form_category = mysqli_real_escape_string($conn,$_POST['category']);

      if ($uploadOk == 1) {
        $sql = "UPDATE articles SET title='" . $form_title . "', summary='" . $form_summary . "', category='" . $form_category . "', content='" . $form_content . "', thumbnail='" . $target_file . "', tags='" . $form_tags . "' WHERE ID=" . htmlspecialchars($_GET["id"]);
      }
      else
      {
        $sql = "UPDATE articles SET title='" . $form_title . "', summary='" . $form_summary . "', category='" . $form_category . "', content='" . $form_content . "', thumbnail='" . $edit_thumbnail . "', tags='" . $form_tags . "' WHERE ID=" . htmlspecialchars($_GET["id"]);
      }

      if ($conn->query($sql) === TRUE) {
          echo "<br>Article updated";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
   }

?>
<html>
   <body>
     <form action = "" method = "post" enctype="multipart/form-data">
       <?php
          echo "<label>Title: </label><input type =\"text\" name = \"title\" value=\"". htmlentities($edit_title) . "\"/><br><br>";
          echo "<label>Summary: </label><input type =\"text\" name = \"summary\" value=\"". htmlentities($edit_summary) . "\"/><br><br>";
          echo "<label>Content: </label><input type =\"text\" name = \"content\" value=\"". htmlentities($edit_content) . "\"/><br><br>";
          ?>
          <label>Category: </label><select name= "category">
            <?php
            echo "<option value=\"" . $edit_category . "\">Current: " . $edit_categoryname . "</option>";
            echo "<option disabled>--Select Category--</option>";
            while($row_c = $result_c->fetch_assoc()) {
              echo "<option value=\"" . $row_c["id"] ."\">" . $row_c["name"] ."</option>";
            }
            ?>
          </select>
          <br>
          <br>
        <?php
          echo "<label>Tags: </label><input type =\"text\" name = \"tags\" value=\"". htmlentities($edit_tags) . "\"/><br><br>";
          echo "<img src=../" . htmlentities($edit_thumbnail) . " style=\"max-width: 150px; height: auto;\"><br><br>";
       ?>
       <br>
       <br>
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload"><br>
        <input type = "submit" value = " Submit "/><br />

     </form>
   </body>
</html>
