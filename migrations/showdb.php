<?php

$db_file_path = '../db/sqlitedb.db';

$db = new SQLite3($db_file_path) or die('Unable to open database');

$res = $db->query("SELECT * FROM posts");

while($row = $res->fetchArray(SQLITE3_ASSOC) ){
    echo "( ". $row['id'] . " , " . $row['title'] . " , " . $row['content'] ." )\n";
}

$db->close();