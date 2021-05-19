#!/usr/bin/php -q
<?php
// $file: main.php $timestamp: 2012/02/20 @ 20:01

// For Platypus $argv contains:
// [0] - Absolute to the running script
// [1...n] - Absolute path to each dropped file
// var_dump($argv);

require('./FileManager.php');

// find the files dropped onto the Platypus app icon:
$droppedFiles = array_slice($argv,1);

if (!empty($droppedFiles)) {
  foreach ($droppedFiles as $droppedFile) {
    $path = CheckPath($droppedFile);
    $size = format_size(filesize($droppedFile));
    $name = basename($droppedFile);
    $url = "[url=http://layout.sophieparis.com/download?file=";
    $url .= $path;
    $url .= "]Download «" . $name ."» [i](" . $size . ")[/i][/url]";
    
    echo $url . PHP_EOL;
  }
} else {
  echo "Please drag'n Drop some files or Menu » File » Open...";
  exit;
}

function CheckPath($path) {
  if (stripos($path, "/Volumes/") === false) {
    echo "The file: " . $path . " must be on the Server. Its path has to begin with \"/Volumes/[...]\"" . PHP_EOL;
    exit;
  }
  if (!realpath($path)) {
    echo "The file: " . $path . "that you submitted is not reacheable!" . PHP_EOL;
    exit;
  }
  if(is_dir($path)) {
    echo "You have just drop a Folder. Select files only!";
    exit;
  }
  $path = substr_replace($path, 'public', 0, strlen("/Volumes"));
  $path = urlencode($path);
  return $path;
}
