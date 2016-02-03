<?php
return array(
    'router' => array(
        'routes' => array(
            'soccer.rest.against' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/against[/:against_id]',
                    'defaults' => array(
                        'controller' => 'soccer\\V1\\Rest\\Against\\Controller',
                    ),
                ),
            ),
            'soccer.rest.soccerteams' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/soccerteams[/:soccerteams_id]',
                    'defaults' => array(
                        'controller' => 'soccer\\V1\\Rest\\Soccerteams\\Controller',
                    ),
                ),
            ),
            'soccer.rest.team1' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/team1[/:team1_id]',
                    'defaults' => array(
                        'controller' => 'soccer\\V1\\Rest\\Team1\\Controller',
                    ),
                ),
            ),
            'soccer.rest.team2' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/team2[/:team2_id]',
                    'defaults' => array(
                        'controller' => 'soccer\\V1\\Rest\\Team2\\Controller',
                    ),
                ),
            ),
            'soccer.rest.result' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/result[/:result_id]',
                    'defaults' => array(
                        'controller' => 'soccer\\V1\\Rest\\Result\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'soccer.rest.against',
            1 => 'soccer.rest.soccerteams',
            2 => 'soccer.rest.team1',
            3 => 'soccer.rest.team2',
            4 => 'soccer.rest.result',
        ),
    ),
    'zf-rest' => array(
        'soccer\\V1\\Rest\\Against\\Controller' => array(
            'listener' => 'soccer\\V1\\Rest\\Against\\AgainstResource',
            'route_name' => 'soccer.rest.against',
            'route_identifier_name' => 'against_id',
            'collection_name' => 'against',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
                4 => 'POST',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_query_whitelist' => array(
                0 => 'search',
            ),
            'page_size' => '120',
            'page_size_param' => null,
            'entity_class' => 'soccer\\V1\\Rest\\Against\\AgainstEntity',
            'collection_class' => 'soccer\\V1\\Rest\\Against\\AgainstCollection',
            'service_name' => 'against',
        ),
        'soccer\\V1\\Rest\\Soccerteams\\Controller' => array(
            'listener' => 'soccer\\V1\\Rest\\Soccerteams\\SoccerteamsResource',
            'route_name' => 'soccer.rest.soccerteams',
            'route_identifier_name' => 'soccerteams_id',
            'collection_name' => 'soccerteams',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soccer\\V1\\Rest\\Soccerteams\\SoccerteamsEntity',
            'collection_class' => 'soccer\\V1\\Rest\\Soccerteams\\SoccerteamsCollection',
            'service_name' => 'soccerteams',
        ),
        'soccer\\V1\\Rest\\Team1\\Controller' => array(
            'listener' => 'soccer\\V1\\Rest\\Team1\\Team1Resource',
            'route_name' => 'soccer.rest.team1',
            'route_identifier_name' => 'team1_id',
            'collection_name' => 'team1',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
                4 => 'POST',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_query_whitelist' => array(
                0 => 'searchfrom',
                1 => 'searchto',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soccer\\V1\\Rest\\Team1\\Team1Entity',
            'collection_class' => 'soccer\\V1\\Rest\\Team1\\Team1Collection',
            'service_name' => 'team1',
        ),
        'soccer\\V1\\Rest\\Team2\\Controller' => array(
            'listener' => 'soccer\\V1\\Rest\\Team2\\Team2Resource',
            'route_name' => 'soccer.rest.team2',
            'route_identifier_name' => 'team2_id',
            'collection_name' => 'team2',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(
                0 => 'searchfrom',
                1 => 'searchto',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soccer\\V1\\Rest\\Team2\\Team2Entity',
            'collection_class' => 'soccer\\V1\\Rest\\Team2\\Team2Collection',
            'service_name' => 'team2',
        ),
        'soccer\\V1\\Rest\\Result\\Controller' => array(
            'listener' => 'soccer\\V1\\Rest\\Result\\ResultResource',
            'route_name' => 'soccer.rest.result',
            'route_identifier_name' => 'result_id',
            'collection_name' => 'result',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => '25',
            'page_size_param' => null,
            'entity_class' => 'soccer\\V1\\Rest\\Result\\ResultEntity',
            'collection_class' => 'soccer\\V1\\Rest\\Result\\ResultCollection',
            'service_name' => 'result',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'soccer\\V1\\Rest\\Against\\Controller' => 'HalJson',
            'soccer\\V1\\Rest\\Soccerteams\\Controller' => 'HalJson',
            'soccer\\V1\\Rest\\Team1\\Controller' => 'HalJson',
            'soccer\\V1\\Rest\\Team2\\Controller' => 'HalJson',
            'soccer\\V1\\Rest\\Result\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'soccer\\V1\\Rest\\Against\\Controller' => array(
                0 => 'application/vnd.soccer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soccer\\V1\\Rest\\Soccerteams\\Controller' => array(
                0 => 'application/vnd.soccer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soccer\\V1\\Rest\\Team1\\Controller' => array(
                0 => 'application/vnd.soccer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soccer\\V1\\Rest\\Team2\\Controller' => array(
                0 => 'application/vnd.soccer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soccer\\V1\\Rest\\Result\\Controller' => array(
                0 => 'application/vnd.soccer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'soccer\\V1\\Rest\\Against\\Controller' => array(
                0 => 'application/vnd.soccer.v1+json',
                1 => 'application/json',
            ),
            'soccer\\V1\\Rest\\Soccerteams\\Controller' => array(
                0 => 'application/vnd.soccer.v1+json',
                1 => 'application/json',
            ),
            'soccer\\V1\\Rest\\Team1\\Controller' => array(
                0 => 'application/vnd.soccer.v1+json',
                1 => 'application/json',
            ),
            'soccer\\V1\\Rest\\Team2\\Controller' => array(
                0 => 'application/vnd.soccer.v1+json',
                1 => 'application/json',
            ),
            'soccer\\V1\\Rest\\Result\\Controller' => array(
                0 => 'application/vnd.soccer.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'soccer\\V1\\Rest\\Against\\AgainstEntity' => array(
                'entity_identifier_name' => 'aid',
                'route_name' => 'soccer.rest.against',
                'route_identifier_name' => 'against_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soccer\\V1\\Rest\\Against\\AgainstCollection' => array(
                'entity_identifier_name' => 'aid',
                'route_name' => 'soccer.rest.against',
                'route_identifier_name' => 'against_id',
                'is_collection' => true,
            ),
            'soccer\\V1\\Rest\\Soccerteams\\SoccerteamsEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'soccer.rest.soccerteams',
                'route_identifier_name' => 'soccerteams_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soccer\\V1\\Rest\\Soccerteams\\SoccerteamsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'soccer.rest.soccerteams',
                'route_identifier_name' => 'soccerteams_id',
                'is_collection' => true,
            ),
            'soccer\\V1\\Rest\\Team1\\Team1Entity' => array(
                'entity_identifier_name' => 't1id',
                'route_name' => 'soccer.rest.team1',
                'route_identifier_name' => 'team1_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soccer\\V1\\Rest\\Team1\\Team1Collection' => array(
                'entity_identifier_name' => 't1id',
                'route_name' => 'soccer.rest.team1',
                'route_identifier_name' => 'team1_id',
                'is_collection' => true,
            ),
            'soccer\\V1\\Rest\\Team2\\Team2Entity' => array(
                'entity_identifier_name' => 't2id',
                'route_name' => 'soccer.rest.team2',
                'route_identifier_name' => 'team2_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soccer\\V1\\Rest\\Team2\\Team2Collection' => array(
                'entity_identifier_name' => 't2id',
                'route_name' => 'soccer.rest.team2',
                'route_identifier_name' => 'team2_id',
                'is_collection' => true,
            ),
            'soccer\\V1\\Rest\\Result\\ResultEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'soccer.rest.result',
                'route_identifier_name' => 'result_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soccer\\V1\\Rest\\Result\\ResultCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'soccer.rest.result',
                'route_identifier_name' => 'result_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-apigility' => array(
        'db-connected' => array(
            'soccer\\V1\\Rest\\Against\\AgainstResource' => array(
                'adapter_name' => 'soccerDB',
                'table_name' => 'against',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soccer\\V1\\Rest\\Against\\Controller',
                'entity_identifier_name' => 'aid',
                'resource_class' => 'soccer\\V1\\Rest\\Against\\AgainstResource',
                'table_service' => 'soccer\\V1\\Rest\\Against\\AgainstResource\\Table',
            ),
            'soccer\\V1\\Rest\\Soccerteams\\SoccerteamsResource' => array(
                'adapter_name' => 'soccerDB',
                'table_name' => 'soccerteams',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soccer\\V1\\Rest\\Soccerteams\\Controller',
                'entity_identifier_name' => 'id',
                'resource_class' => 'soccer\\V1\\Rest\\Soccerteams\\SoccerteamsResource',
                'table_service' => 'soccer\\V1\\Rest\\Soccerteams\\SoccerteamsResource\\Table',
            ),
            'soccer\\V1\\Rest\\Team1\\Team1Resource' => array(
                'adapter_name' => 'soccerDB',
                'table_name' => 'team1',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soccer\\V1\\Rest\\Team1\\Controller',
                'entity_identifier_name' => 't1id',
                'resource_class' => 'soccer\\V1\\Rest\\Team1\\Team1Resource',
                'table_service' => 'soccer\\V1\\Rest\\Team1\\Team1Resource\\Table',
            ),
            'soccer\\V1\\Rest\\Team2\\Team2Resource' => array(
                'adapter_name' => 'soccerDB',
                'table_name' => 'team2',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soccer\\V1\\Rest\\Team2\\Controller',
                'entity_identifier_name' => 't2id',
                'resource_class' => 'soccer\\V1\\Rest\\Team2\\Team2Resource',
                'table_service' => 'soccer\\V1\\Rest\\Team2\\Team2Resource\\Table',
            ),
            'soccer\\V1\\Rest\\Result\\ResultResource' => array(
                'adapter_name' => 'soccerDB',
                'table_name' => 'result',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soccer\\V1\\Rest\\Result\\Controller',
                'entity_identifier_name' => 'id',
                'table_service' => 'soccer\\V1\\Rest\\Result\\ResultResource\\Table',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'soccer\\V1\\Rest\\Against\\Controller' => array(
            'input_filter' => 'soccer\\V1\\Rest\\Against\\Validator',
        ),
        'soccer\\V1\\Rest\\Soccerteams\\Controller' => array(
            'input_filter' => 'soccer\\V1\\Rest\\Soccerteams\\Validator',
        ),
        'soccer\\V1\\Rest\\Team1\\Controller' => array(
            'input_filter' => 'soccer\\V1\\Rest\\Team1\\Validator',
        ),
        'soccer\\V1\\Rest\\Team2\\Controller' => array(
            'input_filter' => 'soccer\\V1\\Rest\\Team2\\Validator',
        ),
        'soccer\\V1\\Rest\\Result\\Controller' => array(
            'input_filter' => 'soccer\\V1\\Rest\\Result\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'soccer\\V1\\Rest\\Against\\Validator' => array(
            0 => array(
                'name' => 'date',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'team1',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
            ),
            2 => array(
                'name' => 'team2',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
            ),
            3 => array(
                'name' => 'result',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'aid',
            ),
            5 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'scteamsid',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            6 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'search',
                'continue_if_empty' => true,
                'allow_empty' => true,
            ),
        ),
        'soccer\\V1\\Rest\\Soccerteams\\Validator' => array(
            0 => array(
                'name' => 'team1id',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'team2id',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            2 => array(
                'name' => 'one',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            3 => array(
                'name' => 'x',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            4 => array(
                'name' => 'two',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            5 => array(
                'name' => 'date',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            6 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'id',
            ),
            7 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'order',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'soccer\\V1\\Rest\\Team1\\Validator' => array(
            0 => array(
                'name' => 'name',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
            ),
            1 => array(
                'name' => 'pos',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            2 => array(
                'name' => 'sp',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            3 => array(
                'name' => 'g',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            4 => array(
                'name' => 'u',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            5 => array(
                'name' => 'v',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            6 => array(
                'name' => 'goals',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
            ),
            7 => array(
                'name' => 'pm',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
            ),
            8 => array(
                'name' => 'points',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            9 => array(
                'name' => 'un',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            10 => array(
                'name' => 'ov',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            11 => array(
                'name' => 'streak',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
                'continue_if_empty' => true,
                'allow_empty' => true,
            ),
            12 => array(
                'name' => 'oldpoints',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            13 => array(
                'name' => 'oldptcount',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            14 => array(
                'name' => 'date',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            15 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 't1id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'soccer\\V1\\Rest\\Team2\\Validator' => array(
            0 => array(
                'name' => 'name',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
            ),
            1 => array(
                'name' => 'pos',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            2 => array(
                'name' => 'sp',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            3 => array(
                'name' => 'g',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            4 => array(
                'name' => 'u',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            5 => array(
                'name' => 'v',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            6 => array(
                'name' => 'goals',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
            ),
            7 => array(
                'name' => 'pm',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
            ),
            8 => array(
                'name' => 'points',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            9 => array(
                'name' => 'un',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            10 => array(
                'name' => 'ov',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            11 => array(
                'name' => 'streak',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '50',
                        ),
                    ),
                ),
            ),
            12 => array(
                'name' => 'oldpoints',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            13 => array(
                'name' => 'oldptcount',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            14 => array(
                'name' => 'date',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'soccer\\V1\\Rest\\Result\\Validator' => array(
            0 => array(
                'name' => 'scteamsid',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'team1',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            2 => array(
                'name' => 'team2',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            3 => array(
                'name' => 'onextwo',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            4 => array(
                'name' => 'result',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            5 => array(
                'name' => 'date',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'soccer\\V1\\Rest\\Soccerteams\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
            'soccer\\V1\\Rest\\Against\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
        ),
    ),
);
