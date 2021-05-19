<?php
// $file: FileManager.php $timestamp: 2012/02/21 @ 08:46

function format_size($size) {
  if (empty($size)) {
    echo "The variable size of the function format_size() is null";
    exit;
  }
  if ($size < 1024) {
      return $size = "1 byte";
  } else {
    $size = round($size / 1024, 2);
    $unit = "KB";
    if ($size >= 1024) {
      $size = round($size / 1024, 2);
      $unit = "MB";
    }
    return $size . " " . $unit;
  }
}

function get_mime($basename) {
  if (empty($basename)) {
    echo "The variable basename of the function get_mime() is null";
    exit;
  }
  $mime = array();
  //$mime['type'] = mime_content_type($path);
  // Description based on this: http://www.sharpened.net/extensions/
  $mime_description  = array(
    'ai'          => "Adobe Illustrator File",
    'applescript' => "AppleScript File",                      
    'dmg'         => "Mac OS X Disk Image",
    'doc'         => "Microsoft Word Document",
    'ppt'         => "PowerPoint Presentation",
    'xls'         => "Excel Spreadsheet",
    'eps'         => "Encapsulated PostScript File",
    'icap'        => "InCopy Assignment Package",
    'icma'        => "InCopy Markup Assignment",
    'icml'        => "InCopy Markup Language",
    'idap'        => "InDesign Document Assignment Package",
    'indb'        => "Adobe InDesign Book",
    'indd'        => "Adobe InDesign Document",
    'jsx'         => "ExtendScript Script File",
    'jsxbin'      => "ExtendScript Binary File",
    'jpg|jpeg'    => "JPEG Image File",
    'otf'         => "OpenType Font",
    'pdf'         => "Portable Document Format File",
    'png'         => "Portable Network Graphic",
    'crw|cr2'     => "Canon Raw CIFF Image File",
    'psd'         => "Adobe Photoshop Document",
    'swf'         => "Shockwave Flash Movie",
    'ttf'         => "TrueType Font",
    'tif|tiff'    => "Tagged Image File",
    'tar'         => "Consolidated Unix File Archive",
    'txt'         => "Plain Text File",
    'zip'         => "ZIP Archive",
  );
  
  foreach ($mime_description as $extension_preg => $mime_match){
    if (preg_match('!\.('. $extension_preg .')$!i', $basename)) {
      return $mime_match;
    }
  }
  return "Unknown Type";
}

function format_date($path) {
  if (empty($path)) {
    echo "The variable $path of the function format_date() is null";
    exit;
  }
  date_default_timezone_set('Asia/Jakarta');
  // format Tue 14 Feb 2012, 06:30 pm
  return date("D d M Y, h:i a", filemtime($path));
}