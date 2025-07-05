<?php

$url = 'https://api.rss2json.com/v1/api.json?rss_url=https://medium.com/feed/@abdullahadil145';
$response = file_get_contents($url);
$data = json_decode($response, true);

$blogs = isset($data['items']) ? array_slice($data['items'], 0, 3) : [];

require 'app/views/blog/index.php';
