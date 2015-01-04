<?php
return array(
    'routes' => array(
        'hc-backend' => array(
            'child_routes' => array(
                'blog' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/blog'
                    ),
                    'child_routes' => array(
                        'tag' => include __DIR__ . '/router/tag.config.php'
                    )
                )
            )
        )
    )
);
