<?php
   include('session.php');

   echo "<a href=newArticle.php>New Article</a>";
?>
<html>

   <body>
      <h1>Welcome <?php echo $login_session; ?></h1>
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>

<?php
$sql = "SELECT id, title, summary, content, thumbnail FROM articles ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<a href=editArticle.php?id=" . $row["id"] . ">" . $row["title"] . "</a>";
        echo "<br>";
        echo $row["summary"];
        echo "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}

?>

</html>
