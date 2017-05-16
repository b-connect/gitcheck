<?php
/**
 * 
 */

require_once './vendor/autoload.php';

use bconnect\GitCheck;

try {
    $app = new GitCheck();
    $app->run(['config' => './config.json', 'verbose' => true]);
} catch (Exception $exception) {
    printf('Error: %s' . PHP_EOL, $exception->getMessage());
    exit(9);
} 