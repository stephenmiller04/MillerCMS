<?php
   include('session.php');

   echo "<a href=newArticle.php>New Article</a>";
   echo "<a href=newCategory.php>New Category</a>";
?>

<html>
  <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
  </style>

   <body>
      <h1>Welcome <?php echo $login_session; ?></h1>
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>

<?php
echo "<h2> Categories </h2><br>";
$sql = "SELECT id, name, summary FROM categories ORDER BY id ASC";
$result = $conn->query($sql);

echo "<table>";
echo "<tr>";
echo "<th>Title</th>";
echo "<th>Summary</th>";
echo "<th>Actions</th>";
echo "</tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["summary"] . "</td>";
        echo "<td><a href=editCategory.php?id=" . $row["id"] . ">Edit</a>  <a href=viewCategory.php?id=" . $row["id"] . ">View</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

echo "</table>";

echo "<h2> Articles </h2><br>";

$sql = "SELECT id, title, summary, content, thumbnail FROM articles ORDER BY id DESC";
$result = $conn->query($sql);

echo "<table>";
echo "<tr>";
echo "<th>Thumbnail</th>";
echo "<th>Title</th>";
echo "<th>Summary</th>";
echo "<th>Actions</th>";
echo "</tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td><img src=" . $row["thumbnail"] . " style=\"max-width: 150px; height: auto;\"></td>";
      echo "<td>" . $row["title"] . "</td>";
      echo "<td>" . $row["summary"] . "</td>";
      echo "<td><a href=editArticle.php?id=" . $row["id"] . ">Edit</a>  <a href=../article.php?id=" . $row["id"] . ">View</a>  <a href=deleteArticle.php?id=" . $row["id"] . ">Delete</a></td>";
      echo "</tr>";
    }
} else {
    echo "0 results";
}

echo "</table>";
?>

</html>
