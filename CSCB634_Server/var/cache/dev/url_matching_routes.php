<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/attendance/add' => [[['_route' => 'attendance_add', '_controller' => 'App\\Controller\\AttendanceController::add'], null, null, null, false, false, null]],
        '/attendance/list' => [[['_route' => 'attendance_list', '_controller' => 'App\\Controller\\AttendanceController::list'], null, null, null, false, false, null]],
        '/grades/add' => [[['_route' => 'grades_add', '_controller' => 'App\\Controller\\GradesController::add'], null, null, null, false, false, null]],
        '/grades/list' => [[['_route' => 'grades_list', '_controller' => 'App\\Controller\\GradesController::list'], null, null, null, false, false, null]],
        '/marks/add' => [[['_route' => 'marks_add', '_controller' => 'App\\Controller\\MarksController::add'], null, null, null, false, false, null]],
        '/marks/list' => [[['_route' => 'marks_list', '_controller' => 'App\\Controller\\MarksController::list'], null, null, null, false, false, null]],
        '/parents/add' => [[['_route' => 'parents_add', '_controller' => 'App\\Controller\\ParentsController::add'], null, null, null, false, false, null]],
        '/parents/list' => [[['_route' => 'parents_list', '_controller' => 'App\\Controller\\ParentsController::list'], null, null, null, false, false, null]],
        '/principals/add' => [[['_route' => 'principals_add', '_controller' => 'App\\Controller\\PrincipalsController::add'], null, null, null, false, false, null]],
        '/principals/list' => [[['_route' => 'principals_list', '_controller' => 'App\\Controller\\PrincipalsController::list'], null, null, null, false, false, null]],
        '/qualifications/add' => [[['_route' => 'qualifications_add', '_controller' => 'App\\Controller\\QualificationsController::add'], null, null, null, false, false, null]],
        '/qualifications/list' => [[['_route' => 'qualifications_list', '_controller' => 'App\\Controller\\QualificationsController::list'], null, null, null, false, false, null]],
        '/schedule/list' => [[['_route' => 'schedule_list', '_controller' => 'App\\Controller\\ScheduleController::list'], null, null, null, false, false, null]],
        '/schedule/add' => [[['_route' => 'schedule_add', '_controller' => 'App\\Controller\\ScheduleController::add'], null, null, null, false, false, null]],
        '/schools/add' => [[['_route' => 'schools_add', '_controller' => 'App\\Controller\\SchoolsController::add'], null, null, null, false, false, null]],
        '/schools/list' => [[['_route' => 'schools_list', '_controller' => 'App\\Controller\\SchoolsController::list'], null, null, null, false, false, null]],
        '/students/add' => [[['_route' => 'students_add', '_controller' => 'App\\Controller\\StudentsController::add'], null, null, null, false, false, null]],
        '/students/list' => [[['_route' => 'students_list', '_controller' => 'App\\Controller\\StudentsController::list'], null, null, null, false, false, null]],
        '/subjects/add' => [[['_route' => 'subject_add', '_controller' => 'App\\Controller\\SubjectsController::add'], null, null, null, false, false, null]],
        '/subjects/list' => [[['_route' => 'subject_list', '_controller' => 'App\\Controller\\SubjectsController::list'], null, null, null, false, false, null]],
        '/teachers/add' => [[['_route' => 'teachers_add', '_controller' => 'App\\Controller\\TeachersController::add'], null, null, null, false, false, null]],
        '/teachers/list' => [[['_route' => 'teachers_list', '_controller' => 'App\\Controller\\TeachersController::list'], null, null, null, false, false, null]],
        '/users/login' => [[['_route' => 'users_login', '_controller' => 'App\\Controller\\UsersController::login'], null, null, null, false, false, null]],
        '/users/add' => [[['_route' => 'users_add', '_controller' => 'App\\Controller\\UsersController::add'], null, null, null, false, false, null]],
        '/users/list' => [[['_route' => 'users_list', '_controller' => 'App\\Controller\\UsersController::list'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/attendance/(?'
                    .'|getAttendance/([^/]++)(*:79)'
                    .'|edit/([^/]++)(*:99)'
                    .'|delete/([^/]++)(*:121)'
                .')'
                .'|/grades/(?'
                    .'|getGrade/([^/]++)(*:158)'
                    .'|edit/([^/]++)(*:179)'
                    .'|delete/([^/]++)(*:202)'
                .')'
                .'|/marks/(?'
                    .'|getMark/([^/]++)(*:237)'
                    .'|edit/([^/]++)(*:258)'
                    .'|delete/([^/]++)(*:281)'
                .')'
                .'|/p(?'
                    .'|arents/(?'
                        .'|getParent/([^/]++)(*:323)'
                        .'|edit/([^/]++)(*:344)'
                        .'|delete/([^/]++)(*:367)'
                        .'|([^/]++)/students(*:392)'
                    .')'
                    .'|rincipals/(?'
                        .'|get(?'
                            .'|P(?'
                                .'|rincipal/([^/]++)(*:441)'
                                .'|arents/([^/]++)(*:464)'
                            .')'
                            .'|S(?'
                                .'|tudents/([^/]++)(*:493)'
                                .'|ubjects/([^/]++)(*:517)'
                            .')'
                            .'|Teachers/([^/]++)(*:543)'
                        .')'
                        .'|edit/([^/]++)(*:565)'
                        .'|delete/([^/]++)(*:588)'
                    .')'
                .')'
                .'|/qualifications/(?'
                    .'|edit/([^/]++)(*:630)'
                    .'|delete/([^/]++)(*:653)'
                .')'
                .'|/s(?'
                    .'|ch(?'
                        .'|edule/(?'
                            .'|get/([^/]++)(*:693)'
                            .'|edit/([^/]++)(*:714)'
                            .'|delete/([^/]++)(*:737)'
                        .')'
                        .'|ools/(?'
                            .'|getSchool/([^/]++)(*:772)'
                            .'|edit/([^/]++)(*:793)'
                            .'|delete/([^/]++)(*:816)'
                        .')'
                    .')'
                    .'|tudents/(?'
                        .'|getS(?'
                            .'|tudent/([^/]++)(*:859)'
                            .'|chedule/([^/]++)(*:883)'
                        .')'
                        .'|edit/([^/]++)(*:905)'
                        .'|delete/([^/]++)(*:928)'
                    .')'
                    .'|ubjects/(?'
                        .'|edit/([^/]++)(*:961)'
                        .'|delete/([^/]++)(*:984)'
                    .')'
                .')'
                .'|/teachers/(?'
                    .'|get(?'
                        .'|Teacher/([^/]++)(*:1029)'
                        .'|S(?'
                            .'|tudents/([^/]++)(*:1058)'
                            .'|chedule/([^/]++)(*:1083)'
                            .'|ubjects/([^/]++)(*:1108)'
                        .')'
                        .'|Qualifications/([^/]++)(*:1141)'
                    .')'
                    .'|edit/([^/]++)(*:1164)'
                    .'|delete/([^/]++)(*:1188)'
                .')'
                .'|/users/(?'
                    .'|delete/([^/]++)(*:1223)'
                    .'|getRole/([^/]++)(*:1248)'
                    .'|setRole/([^/]++)(*:1273)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        79 => [[['_route' => 'attendance_getAttendance', '_controller' => 'App\\Controller\\AttendanceController::getAttendance'], ['id'], null, null, false, true, null]],
        99 => [[['_route' => 'attendance_edit', '_controller' => 'App\\Controller\\AttendanceController::edit'], ['id'], null, null, false, true, null]],
        121 => [[['_route' => 'attendance_delete', '_controller' => 'App\\Controller\\AttendanceController::delete'], ['id'], null, null, false, true, null]],
        158 => [[['_route' => 'grades_getGrade', '_controller' => 'App\\Controller\\GradesController::getGrade'], ['id'], null, null, false, true, null]],
        179 => [[['_route' => 'grades_edit', '_controller' => 'App\\Controller\\GradesController::edit'], ['id'], null, null, false, true, null]],
        202 => [[['_route' => 'grades_delete', '_controller' => 'App\\Controller\\GradesController::delete'], ['id'], null, null, false, true, null]],
        237 => [[['_route' => 'marks_getMark', '_controller' => 'App\\Controller\\MarksController::getMark'], ['id'], null, null, false, true, null]],
        258 => [[['_route' => 'marks_edit', '_controller' => 'App\\Controller\\MarksController::edit'], ['id'], null, null, false, true, null]],
        281 => [[['_route' => 'marks_delete', '_controller' => 'App\\Controller\\MarksController::delete'], ['id'], null, null, false, true, null]],
        323 => [[['_route' => 'parents_getParent', '_controller' => 'App\\Controller\\ParentsController::getParent'], ['id'], null, null, false, true, null]],
        344 => [[['_route' => 'parents_edit', '_controller' => 'App\\Controller\\ParentsController::edit'], ['id'], null, null, false, true, null]],
        367 => [[['_route' => 'parents_delete', '_controller' => 'App\\Controller\\ParentsController::delete'], ['id'], null, null, false, true, null]],
        392 => [[['_route' => 'parent_students', '_controller' => 'App\\Controller\\ParentsController::getStudentsByParent'], ['id'], null, null, false, false, null]],
        441 => [[['_route' => 'principals_getPrincipal', '_controller' => 'App\\Controller\\PrincipalsController::getPrincipal'], ['id'], null, null, false, true, null]],
        464 => [[['_route' => 'principals_parents', '_controller' => 'App\\Controller\\PrincipalsController::getParents'], ['id'], null, null, false, true, null]],
        493 => [[['_route' => 'principals_students', '_controller' => 'App\\Controller\\PrincipalsController::getStudents'], ['id'], null, null, false, true, null]],
        517 => [[['_route' => 'principals_subjects', '_controller' => 'App\\Controller\\PrincipalsController::getSubjects'], ['id'], null, null, false, true, null]],
        543 => [[['_route' => 'principals_teachers', '_controller' => 'App\\Controller\\PrincipalsController::getTeachers'], ['id'], null, null, false, true, null]],
        565 => [[['_route' => 'principals_edit', '_controller' => 'App\\Controller\\PrincipalsController::edit'], ['id'], null, null, false, true, null]],
        588 => [[['_route' => 'principals_delete', '_controller' => 'App\\Controller\\PrincipalsController::delete'], ['id'], null, null, false, true, null]],
        630 => [[['_route' => 'qualifications_edit', '_controller' => 'App\\Controller\\QualificationsController::edit'], ['id'], null, null, false, true, null]],
        653 => [[['_route' => 'qualifications_delete', '_controller' => 'App\\Controller\\QualificationsController::delete'], ['id'], null, null, false, true, null]],
        693 => [[['_route' => 'schedule_get', '_controller' => 'App\\Controller\\ScheduleController::getSchedule'], ['id'], null, null, false, true, null]],
        714 => [[['_route' => 'schedule_edit', '_controller' => 'App\\Controller\\ScheduleController::edit'], ['id'], null, null, false, true, null]],
        737 => [[['_route' => 'schedule_delete', '_controller' => 'App\\Controller\\ScheduleController::deleteSchedule'], ['id'], null, null, false, true, null]],
        772 => [[['_route' => 'schools_getSchool', '_controller' => 'App\\Controller\\SchoolsController::getSchool'], ['id'], null, null, false, true, null]],
        793 => [[['_route' => 'schools_edit', '_controller' => 'App\\Controller\\SchoolsController::edit'], ['id'], null, null, false, true, null]],
        816 => [[['_route' => 'schools_delete', '_controller' => 'App\\Controller\\SchoolsController::delete'], ['id'], null, null, false, true, null]],
        859 => [[['_route' => 'students_getStudent', '_controller' => 'App\\Controller\\StudentsController::getStudent'], ['id'], null, null, false, true, null]],
        883 => [[['_route' => 'students_getSchedule', '_controller' => 'App\\Controller\\StudentsController::getSchedule'], ['id'], null, null, false, true, null]],
        905 => [[['_route' => 'students_get', '_controller' => 'App\\Controller\\StudentsController::edit'], ['id'], null, null, false, true, null]],
        928 => [[['_route' => 'students_delete', '_controller' => 'App\\Controller\\StudentsController::delete'], ['id'], null, null, false, true, null]],
        961 => [[['_route' => 'subject_edit', '_controller' => 'App\\Controller\\SubjectsController::edit'], ['id'], null, null, false, true, null]],
        984 => [[['_route' => 'subject_delete', '_controller' => 'App\\Controller\\SubjectsController::delete'], ['id'], null, null, false, true, null]],
        1029 => [[['_route' => 'teachers_getTeacher', '_controller' => 'App\\Controller\\TeachersController::getTeacher'], ['id'], null, null, false, true, null]],
        1058 => [[['_route' => 'teachers_students', '_controller' => 'App\\Controller\\TeachersController::getStudents'], ['id'], null, null, false, true, null]],
        1083 => [[['_route' => 'teachers_getSchedule', '_controller' => 'App\\Controller\\TeachersController::getSchedule'], ['id'], null, null, false, true, null]],
        1108 => [[['_route' => 'teachers_getSubjects', '_controller' => 'App\\Controller\\TeachersController::getSubjects'], ['id'], null, null, false, true, null]],
        1141 => [[['_route' => 'teachers_getQualifications', '_controller' => 'App\\Controller\\TeachersController::getQualifications'], ['id'], null, null, false, true, null]],
        1164 => [[['_route' => 'teachers_edit', '_controller' => 'App\\Controller\\TeachersController::edit'], ['id'], null, null, false, true, null]],
        1188 => [[['_route' => 'teachers_delete', '_controller' => 'App\\Controller\\TeachersController::delete'], ['id'], null, null, false, true, null]],
        1223 => [[['_route' => 'users_delete', '_controller' => 'App\\Controller\\UsersController::delete'], ['id'], null, null, false, true, null]],
        1248 => [[['_route' => 'users_getRole', '_controller' => 'App\\Controller\\UsersController::getRole'], ['id'], null, null, false, true, null]],
        1273 => [
            [['_route' => 'users_setRole', '_controller' => 'App\\Controller\\UsersController::changeRole'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
