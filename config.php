<?php

$url = "mysql://uynitx0x6gi8qyix:rk0oy8fiaxqsdxrm@lt80glfe2gj8p5n2.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3306/vxiihtc4db5bwlw4";
if (!empty($url)) {
  $dbparts = parse_url($url);

  $hostname = $dbparts['host'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'],'/');
  return [
    'DB_USER' => $username,
    'DB_PASS' => $password,
    'DB_NAME' => $database,
    'DB_HOST' => $hostname
  ];
} else {
  return [
    'DB_USER' => 'root',
    'DB_PASS' => 'root',
    'DB_NAME' => 'instablog',
    'DB_HOST' => 'localhost'
  ];
}

