<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/subjects/add' => [[['_route' => 'subject_add', '_controller' => 'App\\Controller\\SubjectsController::add'], null, null, null, false, false, null]],
        '/subjects/list' => [[['_route' => 'subject_list', '_controller' => 'App\\Controller\\SubjectsController::list'], null, null, null, false, false, null]],
        '/users/login' => [[['_route' => 'users_login', '_controller' => 'App\\Controller\\UsersController::login'], null, null, null, false, false, null]],
        '/users/addUser' => [[['_route' => 'users_addUser', '_controller' => 'App\\Controller\\UsersController::addUser'], null, null, null, false, false, null]],
        '/users/list' => [[['_route' => 'users_list', '_controller' => 'App\\Controller\\UsersController::list'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/subjects/(?'
                    .'|show/([^/]++)(*:68)'
                    .'|edit/([^/]++)(*:88)'
                    .'|delete/([^/]++)(*:110)'
                .')'
                .'|/users/(?'
                    .'|deleteUser/([^/]++)(*:148)'
                    .'|getRole/([^/]++)(*:172)'
                    .'|setRole/([^/]++)(*:196)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        68 => [[['_route' => 'subject_show', '_controller' => 'App\\Controller\\SubjectsController::show'], ['id'], null, null, false, true, null]],
        88 => [[['_route' => 'subject_edit', '_controller' => 'App\\Controller\\SubjectsController::edit'], ['id'], null, null, false, true, null]],
        110 => [[['_route' => 'subject_delete', '_controller' => 'App\\Controller\\SubjectsController::delete'], ['id'], null, null, false, true, null]],
        148 => [[['_route' => 'users_deleteUser', '_controller' => 'App\\Controller\\UsersController::deleteUser'], ['id'], null, null, false, true, null]],
        172 => [[['_route' => 'users_getRole', '_controller' => 'App\\Controller\\UsersController::getRole'], ['id'], null, null, false, true, null]],
        196 => [
            [['_route' => 'users_setRole', '_controller' => 'App\\Controller\\UsersController::changeRole'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
