<?php
require('system/connection.php');

$sql = "SELECT id, title, summary, content, tags, thumbnail FROM articles WHERE id=" . htmlspecialchars($_GET["id"]);
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo $row["title"];
echo "<br>";
echo $row["summary"];
echo "<br>";
echo $row["content"];
echo "<br>";
echo $row["tags"];
echo "<br>";
echo "<img src=../" . $row["thumbnail"] . ">";

$conn->close();
?>
