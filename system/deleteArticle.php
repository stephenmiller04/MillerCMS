<?php
   include("connection.php");
   include('session.php');

   echo "<a href=\"admin.php\">Back to Admin panel</a>";

    $sql = "SELECT id, title, summary FROM articles WHERE id=" . htmlspecialchars($_GET["id"]);
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $edit_id = $row["id"];
    $edit_title = $row["title"];
    $edit_summary = $row["summary"];

    $sql_c = "SELECT id, name, summary FROM categories ORDER BY id ASC";
    $result_c = $conn->query($sql_c);

   $error = "";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $sql = "DELETE FROM articles WHERE ID=" . htmlspecialchars($_GET["id"]);

      if ($conn->query($sql) === TRUE) {
          echo "<br>Article deleted";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
   }

?>
<html>
   <body>
     <form action = "" method = "post" enctype="multipart/form-data">
       <?php
          echo "<p>Title: " . $edit_title . "</p>";
          echo "<p>Summary:" . $edit_summary . "</p>";
       ?>
        <input type = "submit" value = " Submit "/><br />

     </form>
   </body>
</html>
