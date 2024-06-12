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
                    .'|get(?'
                        .'|Grade/([^/]++)(*:161)'
                        .'|Students/([^/]++)(*:186)'
                    .')'
                    .'|edit/([^/]++)(*:208)'
                    .'|delete/([^/]++)(*:231)'
                .')'
                .'|/marks/(?'
                    .'|getMark/([^/]++)(*:266)'
                    .'|edit/([^/]++)(*:287)'
                    .'|delete/([^/]++)(*:310)'
                .')'
                .'|/p(?'
                    .'|arents/(?'
                        .'|getParent/([^/]++)(*:352)'
                        .'|edit/([^/]++)(*:373)'
                        .'|delete/([^/]++)(*:396)'
                        .'|([^/]++)/students(*:421)'
                    .')'
                    .'|rincipals/(?'
                        .'|get(?'
                            .'|P(?'
                                .'|rincipal/([^/]++)(*:470)'
                                .'|arents/([^/]++)(*:493)'
                            .')'
                            .'|S(?'
                                .'|tudents/([^/]++)(*:522)'
                                .'|ubjects/([^/]++)(*:546)'
                            .')'
                            .'|Teachers/([^/]++)(*:572)'
                        .')'
                        .'|edit/([^/]++)(*:594)'
                        .'|delete/([^/]++)(*:617)'
                    .')'
                .')'
                .'|/qualifications/(?'
                    .'|edit/([^/]++)(*:659)'
                    .'|delete/([^/]++)(*:682)'
                .')'
                .'|/s(?'
                    .'|ch(?'
                        .'|edule/(?'
                            .'|get/([^/]++)(*:722)'
                            .'|edit/([^/]++)(*:743)'
                            .'|delete/([^/]++)(*:766)'
                        .')'
                        .'|ools/(?'
                            .'|getSchool/([^/]++)(*:801)'
                            .'|edit/([^/]++)(*:822)'
                            .'|delete/([^/]++)(*:845)'
                        .')'
                    .')'
                    .'|tudents/(?'
                        .'|getS(?'
                            .'|tudent/([^/]++)(*:888)'
                            .'|chedule/([^/]++)(*:912)'
                        .')'
                        .'|edit/([^/]++)(*:934)'
                        .'|delete/([^/]++)(*:957)'
                    .')'
                    .'|ubjects/(?'
                        .'|edit/([^/]++)(*:990)'
                        .'|delete/([^/]++)(*:1013)'
                    .')'
                .')'
                .'|/teachers/(?'
                    .'|get(?'
                        .'|Teacher/([^/]++)(*:1059)'
                        .'|S(?'
                            .'|tudents/([^/]++)(*:1088)'
                            .'|chedule/([^/]++)(*:1113)'
                            .'|ubjects/([^/]++)(*:1138)'
                        .')'
                        .'|Qualifications/([^/]++)(*:1171)'
                        .'|Grades/([^/]++)(*:1195)'
                    .')'
                    .'|edit/([^/]++)(*:1218)'
                    .'|delete/([^/]++)(*:1242)'
                .')'
                .'|/users/(?'
                    .'|delete/([^/]++)(*:1277)'
                    .'|getRole/([^/]++)(*:1302)'
                    .'|setRole/([^/]++)(*:1327)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        79 => [[['_route' => 'attendance_getAttendance', '_controller' => 'App\\Controller\\AttendanceController::getAttendance'], ['id'], null, null, false, true, null]],
        99 => [[['_route' => 'attendance_edit', '_controller' => 'App\\Controller\\AttendanceController::edit'], ['id'], null, null, false, true, null]],
        121 => [[['_route' => 'attendance_delete', '_controller' => 'App\\Controller\\AttendanceController::delete'], ['id'], null, null, false, true, null]],
        161 => [[['_route' => 'grades_getGrade', '_controller' => 'App\\Controller\\GradesController::getGrade'], ['id'], null, null, false, true, null]],
        186 => [[['_route' => 'grades_students', '_controller' => 'App\\Controller\\GradesController::getStudents'], ['id'], null, null, false, true, null]],
        208 => [[['_route' => 'grades_edit', '_controller' => 'App\\Controller\\GradesController::edit'], ['id'], null, null, false, true, null]],
        231 => [[['_route' => 'grades_delete', '_controller' => 'App\\Controller\\GradesController::delete'], ['id'], null, null, false, true, null]],
        266 => [[['_route' => 'marks_getMark', '_controller' => 'App\\Controller\\MarksController::getMark'], ['id'], null, null, false, true, null]],
        287 => [[['_route' => 'marks_edit', '_controller' => 'App\\Controller\\MarksController::edit'], ['id'], null, null, false, true, null]],
        310 => [[['_route' => 'marks_delete', '_controller' => 'App\\Controller\\MarksController::delete'], ['id'], null, null, false, true, null]],
        352 => [[['_route' => 'parents_getParent', '_controller' => 'App\\Controller\\ParentsController::getParent'], ['id'], null, null, false, true, null]],
        373 => [[['_route' => 'parents_edit', '_controller' => 'App\\Controller\\ParentsController::edit'], ['id'], null, null, false, true, null]],
        396 => [[['_route' => 'parents_delete', '_controller' => 'App\\Controller\\ParentsController::delete'], ['id'], null, null, false, true, null]],
        421 => [[['_route' => 'parent_students', '_controller' => 'App\\Controller\\ParentsController::getStudentsByParent'], ['id'], null, null, false, false, null]],
        470 => [[['_route' => 'principals_getPrincipal', '_controller' => 'App\\Controller\\PrincipalsController::getPrincipal'], ['id'], null, null, false, true, null]],
        493 => [[['_route' => 'principals_parents', '_controller' => 'App\\Controller\\PrincipalsController::getParents'], ['id'], null, null, false, true, null]],
        522 => [[['_route' => 'principals_students', '_controller' => 'App\\Controller\\PrincipalsController::getStudents'], ['id'], null, null, false, true, null]],
        546 => [[['_route' => 'principals_subjects', '_controller' => 'App\\Controller\\PrincipalsController::getSubjects'], ['id'], null, null, false, true, null]],
        572 => [[['_route' => 'principals_teachers', '_controller' => 'App\\Controller\\PrincipalsController::getTeachers'], ['id'], null, null, false, true, null]],
        594 => [[['_route' => 'principals_edit', '_controller' => 'App\\Controller\\PrincipalsController::edit'], ['id'], null, null, false, true, null]],
        617 => [[['_route' => 'principals_delete', '_controller' => 'App\\Controller\\PrincipalsController::delete'], ['id'], null, null, false, true, null]],
        659 => [[['_route' => 'qualifications_edit', '_controller' => 'App\\Controller\\QualificationsController::edit'], ['id'], null, null, false, true, null]],
        682 => [[['_route' => 'qualifications_delete', '_controller' => 'App\\Controller\\QualificationsController::delete'], ['id'], null, null, false, true, null]],
        722 => [[['_route' => 'schedule_get', '_controller' => 'App\\Controller\\ScheduleController::getSchedule'], ['id'], null, null, false, true, null]],
        743 => [[['_route' => 'schedule_edit', '_controller' => 'App\\Controller\\ScheduleController::edit'], ['id'], null, null, false, true, null]],
        766 => [[['_route' => 'schedule_delete', '_controller' => 'App\\Controller\\ScheduleController::deleteSchedule'], ['id'], null, null, false, true, null]],
        801 => [[['_route' => 'schools_getSchool', '_controller' => 'App\\Controller\\SchoolsController::getSchool'], ['id'], null, null, false, true, null]],
        822 => [[['_route' => 'schools_edit', '_controller' => 'App\\Controller\\SchoolsController::edit'], ['id'], null, null, false, true, null]],
        845 => [[['_route' => 'schools_delete', '_controller' => 'App\\Controller\\SchoolsController::delete'], ['id'], null, null, false, true, null]],
        888 => [[['_route' => 'students_getStudent', '_controller' => 'App\\Controller\\StudentsController::getStudent'], ['id'], null, null, false, true, null]],
        912 => [[['_route' => 'students_getSchedule', '_controller' => 'App\\Controller\\StudentsController::getSchedule'], ['id'], null, null, false, true, null]],
        934 => [[['_route' => 'students_get', '_controller' => 'App\\Controller\\StudentsController::edit'], ['id'], null, null, false, true, null]],
        957 => [[['_route' => 'students_delete', '_controller' => 'App\\Controller\\StudentsController::delete'], ['id'], null, null, false, true, null]],
        990 => [[['_route' => 'subject_edit', '_controller' => 'App\\Controller\\SubjectsController::edit'], ['id'], null, null, false, true, null]],
        1013 => [[['_route' => 'subject_delete', '_controller' => 'App\\Controller\\SubjectsController::delete'], ['id'], null, null, false, true, null]],
        1059 => [[['_route' => 'teachers_getTeacher', '_controller' => 'App\\Controller\\TeachersController::getTeacher'], ['id'], null, null, false, true, null]],
        1088 => [[['_route' => 'teachers_students', '_controller' => 'App\\Controller\\TeachersController::getStudents'], ['id'], null, null, false, true, null]],
        1113 => [[['_route' => 'teachers_getSchedule', '_controller' => 'App\\Controller\\TeachersController::getSchedule'], ['id'], null, null, false, true, null]],
        1138 => [[['_route' => 'teachers_getSubjects', '_controller' => 'App\\Controller\\TeachersController::getSubjects'], ['id'], null, null, false, true, null]],
        1171 => [[['_route' => 'teachers_getQualifications', '_controller' => 'App\\Controller\\TeachersController::getQualifications'], ['id'], null, null, false, true, null]],
        1195 => [[['_route' => 'teachers_getGrades', '_controller' => 'App\\Controller\\TeachersController::getGrades'], ['id'], null, null, false, true, null]],
        1218 => [[['_route' => 'teachers_edit', '_controller' => 'App\\Controller\\TeachersController::edit'], ['id'], null, null, false, true, null]],
        1242 => [[['_route' => 'teachers_delete', '_controller' => 'App\\Controller\\TeachersController::delete'], ['id'], null, null, false, true, null]],
        1277 => [[['_route' => 'users_delete', '_controller' => 'App\\Controller\\UsersController::delete'], ['id'], null, null, false, true, null]],
        1302 => [[['_route' => 'users_getRole', '_controller' => 'App\\Controller\\UsersController::getRole'], ['id'], null, null, false, true, null]],
        1327 => [
            [['_route' => 'users_setRole', '_controller' => 'App\\Controller\\UsersController::changeRole'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
