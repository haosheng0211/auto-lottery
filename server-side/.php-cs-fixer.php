<?php

declare(strict_types=1);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2'                                  => true,
        '@Symfony'                               => true,
        '@DoctrineAnnotation'                    => true,
        '@PhpCsFixer'                            => true,
        'array_syntax'                           => [
            'syntax' => 'short',
        ],
        'binary_operator_spaces'                 => [
            'operators' => [
                '=>' => 'align',
            ],
        ],
        'blank_line_before_statement'            => [
            'statements' => [
                'declare',
                'for',
                'foreach',
                'if',
                'return',
                'switch',
                'throw',
                'try',
                'while',
            ],
        ],
        'class_attributes_separation'            => true,
        'combine_consecutive_unsets'             => true,
        'concat_space'                           => [
            'spacing' => 'one',
        ],
        'constant_case'                          => [
            'case' => 'lower',
        ],
        'explicit_indirect_variable'             => true,
        'general_phpdoc_annotation_remove'       => true,
        'linebreak_after_opening_tag'            => true,
        'list_syntax'                            => [
            'syntax' => 'short',
        ],
        'lowercase_static_reference'             => true,
        'multiline_comment_opening_closing'      => true,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],
        'no_empty_phpdoc'                        => true,
        'no_empty_statement'                     => true,
        'no_superfluous_phpdoc_tags'             => true,
        'no_unused_imports'                      => true,
        'no_useless_else'                        => true,
        'no_useless_return'                      => true,
        'not_operator_with_space'                => false,
        'not_operator_with_successor_space'      => true,
        'ordered_class_elements'                 => true,
        'ordered_imports'                        => [
            'imports_order'  => [
                'class',
                'function',

                'const',
            ],
            'sort_algorithm' => 'alpha',
        ],
        'phpdoc_align'                           => [
            'align' => 'vertical',
        ],
        'phpdoc_separation'                      => true,
        'single_quote'                           => true,
        'single_line_after_imports'              => true,
        'standardize_not_equals'                 => true,
        'yoda_style'                             => [
            'always_move_variable' => false,
            'equal'                => false,
            'identical'            => false,
        ],
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in('app')
            ->in('config')
            ->in('database')
            ->in('resources')
            ->in('routes')
            ->in('tests')
    )
    ->setUsingCache(false);
