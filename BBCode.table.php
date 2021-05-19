#!/usr/bin/php -q
<?php
// $file: BBCode.table.php $timestamp: 2012/02/21 @ 10:21

// For Platypus $argv contains:
// [0] - Absolute to the running script
// [1...n] - Absolute path to each dropped file
// var_dump($argv);

require('./FileManager.php');

// find the files dropped onto the Platypus app icon:
$droppedFiles = array_slice($argv,1);

if (!empty($droppedFiles)) {
  natsort($droppedFiles);
  $counter = 1;
  $table = "[table]" . PHP_EOL;
  $table .= "[r][h]File[/h][h]Link[/h][h]Date[/h][h]Size[/h][/r]" . PHP_EOL;
  foreach ($droppedFiles as $droppedFile) {
    $path = CheckPath($droppedFile);
    $size = format_size(filesize($droppedFile));
    $name = basename($droppedFile);
    $mime = get_mime($name);
    $timestamp = format_date($droppedFile);
    if (($counter % 2) == 0) {
      $odd_even = "even";
    } else {
      $odd_even = "odd";
    }
    $table .= "[r class={$odd_even}]" . PHP_EOL;
    $table .= "  [c]{$mime}[/c]" . PHP_EOL;
    $table .= "  [c][url=/download?file={$path}]{$name}[/url][/c]" . PHP_EOL;
    $table .= "  [c]{$timestamp}[/c]" . PHP_EOL;
    $table .= "  [c][i]{$size}[/i][/c]" . PHP_EOL;
    $table .= "[/r]" . PHP_EOL;
    $counter++;
  }
  $table .= "[/table]";
  echo $table;
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
