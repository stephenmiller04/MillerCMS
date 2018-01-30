<?php
require('system/connection.php');

$sql = "SELECT id, username, email, dname, userrole FROM users";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

echo "<br>" . "<b> - id: </b>" . $row["id"]. "<br>" . "<b> - User Name:  </b>" . $row["username"]. "<br>" . "<b> - Email:  </b>" . $row["email"]. "<br>" . "<b> - Display name:  </b>" . $row["dname"];

if ($row["userrole"] == 2) {
  echo "<br><b> - Role: </b> Admin";
}

$conn->close();
echo "<br>";
echo "<br>";

$sql = "SELECT id, title, summary, content, thumbnail FROM articles WHERE id=" . htmlspecialchars($_GET["id"]);
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo "Title: " . $row["title"];
echo "<br>";
echo "Summary: " . $row["summary"];
echo "<br>";
echo "Content: " . $row["content"];
echo "<br>";
echo "<img src=../" . $row["thumbnail"] . ">";

$conn->close();
?>
