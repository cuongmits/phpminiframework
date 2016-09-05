<?php

$db_file_path = '../db/sqlitedb.db';

if (file_exists($db_file_path))
    unlink ($db_file_path);

$db = new SQLite3($db_file_path) or die('Unable to open database');

$db->exec("CREATE TABLE posts (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title STRING, content TEXT);");

$db->close();

echo "Database created successfully.";