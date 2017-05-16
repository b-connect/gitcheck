<?php

require_once './vendor/autoload.php';

use Bit3\GitPhp\GitRepository;

$config = json_decode(file_get_contents('./config.json'));

$git = new GitRepository($config->root);

$status = $git->status()->getStatus();

print_r($status);