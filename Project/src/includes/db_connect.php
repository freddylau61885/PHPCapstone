<?php

require __DIR__ . '/credential.php';

$dbh = new PDO(DB_DSN, DB_USER, DB_PASS);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

return $dbh;