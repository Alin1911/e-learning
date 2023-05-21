<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->notPath('vendor')
    ->notPath('bootstrap')
    ->notPath('node_modules')
    ->exclude('storage')
    ->exclude('public')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php');

foreach ($finder as $file) {
    echo $file->getRealPath()."\n";
}

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'linebreak_after_opening_tag' => true,
        'indentation_type' => true, 
        'no_trailing_whitespace' => true,
        'no_whitespace_in_blank_line' => true,
        'no_extra_blank_lines' => true,
    ])
    ->setIndent("\t")
    ->setFinder($finder);
