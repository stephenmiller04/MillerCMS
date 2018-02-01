<?php
require('system/connection.php');

echo "<a href=system/login.php>Admin Panel</a><br>";
echo "<br>";

//$sql = "SELECT id, title, author, date_format(published, \"%Y-%m-%d %H:%i\") AS published, summary, content, thumbnail, tags FROM articles ORDER BY id DESC;";
$sql = "SELECT articles.id, articles.title, articles.author, date_format(articles.published, \"%Y-%m-%d %H:%i\") AS published, articles.summary, categories.name AS category, articles.content, articles.thumbnail, articles.tags FROM articles INNER JOIN categories ON articles.category = categories.id ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<a href=article.php?id=" . $row["id"] . ">" . $row["title"] . "</a>";
        echo "<br>";
        echo "<img src=../" . $row["thumbnail"] . " style=\"max-width: 150px; height: auto;\"><br>";
        echo $row["author"] . " | " . $row["published"] . " | " . $row["category"];
        echo "<br>";
        echo $row["summary"];
        echo "<br>";
        echo $row["tags"];
        echo "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
