<?php

declare(strict_types=1);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PER' => true,
        'strict_param' => true,
        'single_import_per_statement' => false,
        'no_unused_imports' => true,
        'array_syntax' => ['syntax' => 'short'],
        'single_line_empty_body' => true,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => true,
            'import_functions' => true,
        ],
    ])
    ->setRiskyAllowed(true)
    ->setFinder(PhpCsFixer\Finder::create()
        ->in(__DIR__ . '/bin')
        ->in(__DIR__ . '/src')
        ->in(__DIR__ . '/tests')
    )
;
