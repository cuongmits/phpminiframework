<?php

$db_file_path = '../db/sqlitedb.db';

if (file_exists($db_file_path))
    unlink ($db_file_path);

$db = new SQLite3($db_file_path) or die('Unable to open database');

$db->exec("CREATE TABLE posts (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title STRING, content TEXT);");

$db->query("BEGIN");
$db->exec("INSERT INTO posts(title, content) VALUES ('title #1', 'This is the first content');") or die("Unable to add node.");
$db->exec("INSERT INTO posts(title, content) VALUES ('title #2', 'This is the second content');") or die("Unable to add node.");
$db->exec("INSERT INTO posts(title, content) VALUES ('title #3', 'This is the third content');") or die("Unable to add node.");
$db->exec("INSERT INTO posts(title, content) VALUES ('title #4', 'This is the fourth content');") or die("Unable to add node.");
$db->exec("INSERT INTO posts(title, content) VALUES ('title #5', 'This is the fiveth content');") or die("Unable to add node.");
$db->query("COMMIT");

$res = $db->query("SELECT * FROM posts");

while($row = $res->fetchArray(SQLITE3_ASSOC) ){
    echo "( ". $row['id'] . " , " . $row['title'] . " , " . $row['content'] ." )\n";
}

$db->close();

echo "Database created successfully.";