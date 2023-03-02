<?php
/*
CREATE TABLE `stats` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `session_id` char(128) NOT NULL,
  `action` varchar(20) NOT NULL
);

ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
*/

require 'db_config.php';
session_start();

$action = $_GET['x'] ?? 'ping';
$id = session_id();

$db = new Mysqli($hostname, $username, $password, $database);
if ($db->connect_error) {
    http_response_code(500);
    exit(1);
}

$stmt = $db->prepare("INSERT INTO stats (session_id, action) VALUES (?, ?);");
$stmt->bind_param("ss", $id, $action);
$stmt->execute();
$stmt->close();
$db->close();
?>
