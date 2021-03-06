<?php
namespace bconnect;

use Bit3\GitPhp\GitRepository;
use Webmozart\Glob\Glob;
use Webmozart\PathUtil\Path;

class GitCheck {
    public function run($options) {
        $config = json_decode(file_get_contents(realpath($options['config'])));
        $git = new GitRepository($config->root);
        $status = $git->status()->getStatus();

        foreach ($config->exclude as $ex) {
            foreach ($status as $key => $s) {
                if (Glob::match(Path::makeAbsolute($key, getcwd()), Path::makeAbsolute($ex, getcwd()))) {
                    unset($status[$key]);
                }
            }
        }

        if (isset($options['verbose'])) {
            print_r($status);
        }

        http_response_code(200);

        if (count($status) > 0) {
            http_response_code(500);
        }
    }
}