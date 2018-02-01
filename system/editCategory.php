<?php
   include("connection.php");
   include('session.php');

   $sql = "SELECT id, name, summary FROM categories WHERE id=" . htmlspecialchars($_GET["id"]);
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
   $edit_name = $row["name"];
   $edit_summary = $row["summary"];

   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {

      $form_name = mysqli_real_escape_string($conn,$_POST['name']);
      $form_summary = mysqli_real_escape_string($conn,$_POST['summary']);

      $sql = "UPDATE categories SET (`name`, `summary`) VALUES ('$form_name','$form_summary')";
      $sql = "UPDATE categories SET name='" . $form_name ."',summary='" . $form_summary . "' WHERE id=" . htmlspecialchars($_GET["id"]);

      if ($conn->query($sql) === TRUE) {
          echo "Category updated.";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
   }
?>
<html>
   <body>
     <form action = "" method = "post" enctype="multipart/form-data">
       <?php
         echo "<label>Category name: </label><input type = \"text\" name = \"name\" value=\"" . $edit_name . "\"/><br/><br />";
         echo "<label>Summary: </label><input type = \"text\" name = \"summary\" value=\"" . $edit_summary . "\"/> <br/><br />";
        ?>
        <input type = "submit" value = " Submit "/><br />
     </form>
   </body>
</html>
