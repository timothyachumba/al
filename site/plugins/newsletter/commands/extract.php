<?php

use Kirby\CLI\CLI;
use Kirby\Filesystem\F;

/* EXAMPLE:
<mj-raw><!-- [myblock] --></mj-raw>
<mj-section>
    ...
</mj-section>
<mj-raw><!-- [/myblock] --></mj-raw>
 */
return [
    'description' => 'Extract blocks from a file using regex',
    'args' => [
        'input' => [
            'prefix' => 'i',
            'longPrefix' => 'input',
            'required' => true,
            'description' => 'Input file to be split',
        ],
    ],
    'command' => static function (CLI $cli): void {
        $file = $cli->arg('input');
        if (! F::exists($file)) {
            $cli->error('File does not exist');

            return;
        }

        $content = F::read($file);
        $content = str_replace(['<mj-raw>', '</mj-raw>'], ['', ''], $content);
        $pattern = '/<!-- \[([a-zA-Z0-9\-_]+)] -->(.*?)<!-- \[\/\1] -->/s';

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $identifier = $match[1];
            $output = $cli->kirby()->root('site').'/snippets/blocks/'.$identifier.'.php';
            F::write($output, trim($match[2]));
            $cli->success("Extracted: $identifier => $output");
        }
    },
];
