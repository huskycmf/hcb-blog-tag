<?php
return array(
    // Product
    'HcbBlogTag-Controller-Collection-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' =>
                'HcbBlogTag-Service-Collection-FetchQbBuilder',
            'viewModel' => 'HcbBlogTag-Paginator-ViewModel-JsonModel'
        )
    ),

    'HcbBlogTag-Controller-View' => array(
        'parameters' => array(
            'fetchService' => 'HcbBlogTag-Service-FetchService',
            'extractor' => 'HcbBlogTag-Stdlib-Extractor-Resource'
        )
    ),

    'HcbBlogTag-Controller-Create' => array(
        'parameters' => array(
            'serviceCommand' => 'HcbBlogTag-Service-Create',
            'jsonResponseModelFactory' =>
                'HcbBlogTag-Json-View-StatusMessageDataModelFactory'
        )
    ),

    'HcbBlogTag-Controller-Collection-Delete' => array(
        'parameters' => array(
            'inputData' => 'HcbBlogTag-Data-Collection-Entities-ByIds',
            'serviceCommand' => 'HcbBlogTag-Service-Collection-Delete',
            'jsonResponseModelFactory' =>
                'HcbBlogTag-Json-View-StatusMessageDataModelFactory'
        )
    ),

    // Localized
    'HcbBlogTag-Controller-Localized-Collection-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbBlogTag-Service-FetchService',
            'paginatorDataFetchService' =>
                'HcbBlogTag-Service-Localized-Collection-FetchArrayCollection',
            'viewModel' => 'HcbBlogTag-Paginator-ViewModel-JsonModel-Localized'
        )
    ),

    'HcbBlogTag-Controller-Localized-Update' => array(
        'parameters' => array(
            'inputData' => 'HcbBlogTag-Data-Localized',
            'fetchService' => 'HcbBlogTag-Service-FetchService-Localized',
            'serviceCommand' => 'HcbBlogTag-Service-Localized-UpdateCommand',
            'jsonResponseModelFactory' =>
                'HcbBlogTag-Json-View-StatusMessageDataModelFactory'
        )
    ),

    'HcbBlogTag-Controller-Localized-Create' => array(
        'parameters' => array(
            'inputData' => 'HcbBlogTag-Data-Localized',
            'fetchService' => 'HcbBlogTag-Service-FetchService',
            'serviceCommand' => 'HcbBlogTag-Service-Localized-CreateCommand',
            'jsonResponseModelFactory' =>
                'HcbBlogTag-Json-View-StatusMessageDataModelFactory'
        )
    )
);
