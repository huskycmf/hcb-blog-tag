<?php
return array(
    'HcbBlogTag-Service-FetchService' => array(
        'parameters' => array(
            'entityName' => 'HcbBlogTag\Entity\Tag'
        )
    ),

    'HcbBlogTag-Service-FetchService-Localized' => array(
        'parameters' => array(
            'entityName' => 'HcbBlogTag\Entity\Tag\Localized'
        )
    ),

    'HcbBlogTag-Service-Collection-IdsService' => array(
        'parameters' => array(
            'entityName' => 'HcbBlogTag\Entity\Tag'
        )
    ),

    'HcbBlogTag-Service-Collection-Delete' => array(
        'parameters' => array(
            'deleteData' => 'HcbBlogTag-Data-Collection-Entities-ByIds'
        )
    )
);
