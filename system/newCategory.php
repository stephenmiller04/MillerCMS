<?php
   include("connection.php");
   include('session.php');

   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {

      $form_name = mysqli_real_escape_string($conn,$_POST['name']);
      $form_summary = mysqli_real_escape_string($conn,$_POST['summary']);

      $sql = "INSERT INTO categories (`name`, `summary`) VALUES ('$form_name','$form_summary')";

      if ($conn->query($sql) === TRUE) {
          echo "New category created.";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
   }
?>
<html>
   <body>
     <form action = "" method = "post" enctype="multipart/form-data">
        <label>Category name: </label><input type = "text" name = "name"/><br /><br />
        <label>Summary: </label><input type = "text" name = "summary"/><br/><br />
        <input type = "submit" value = " Submit "/><br />
     </form>
   </body>
</html>
