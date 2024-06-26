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
        '/roles/list' => [[['_route' => 'roles_list', '_controller' => 'App\\Controller\\RolesController::list'], null, null, null, false, false, null]],
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
                    .'|s(?'
                        .'|tudent/list/([^/]++)(*:153)'
                        .'|ubject/list/([^/]++)(*:181)'
                    .')'
                .')'
                .'|/grades/(?'
                    .'|get(?'
                        .'|Grade(?'
                            .'|/([^/]++)(*:225)'
                            .'|ByStudent/([^/]++)(*:251)'
                        .')'
                        .'|Students/([^/]++)(*:277)'
                    .')'
                    .'|edit/([^/]++)(*:299)'
                    .'|delete/([^/]++)(*:322)'
                .')'
                .'|/marks/(?'
                    .'|getMark/([^/]++)(*:357)'
                    .'|edit/([^/]++)(*:378)'
                    .'|delete/([^/]++)(*:401)'
                    .'|s(?'
                        .'|tudent/list/([^/]++)(*:433)'
                        .'|ubject/list/([^/]++)(*:461)'
                    .')'
                .')'
                .'|/p(?'
                    .'|arents/(?'
                        .'|getParent(?'
                            .'|/([^/]++)(*:507)'
                            .'|ByEmail/([^/]++)(*:531)'
                        .')'
                        .'|edit/([^/]++)(*:553)'
                        .'|delete/([^/]++)(*:576)'
                        .'|([^/]++)/students(*:601)'
                    .')'
                    .'|rincipals/(?'
                        .'|get(?'
                            .'|P(?'
                                .'|rincipal(?'
                                    .'|/([^/]++)(*:653)'
                                    .'|ByEmail/([^/]++)(*:677)'
                                .')'
                                .'|arents/([^/]++)(*:701)'
                            .')'
                            .'|S(?'
                                .'|tudents/([^/]++)(*:730)'
                                .'|ubjects/([^/]++)(*:754)'
                            .')'
                            .'|Teachers/([^/]++)(*:780)'
                        .')'
                        .'|edit/([^/]++)(*:802)'
                        .'|delete/([^/]++)(*:825)'
                    .')'
                .')'
                .'|/qualifications/(?'
                    .'|edit/([^/]++)(*:867)'
                    .'|delete/([^/]++)(*:890)'
                .')'
                .'|/roles/getRole/([^/]++)(*:922)'
                .'|/s(?'
                    .'|ch(?'
                        .'|edule/(?'
                            .'|listBySchool/([^/]++)(*:970)'
                            .'|get/([^/]++)(*:990)'
                            .'|edit/([^/]++)(*:1011)'
                            .'|delete/([^/]++)(*:1035)'
                        .')'
                        .'|ools/(?'
                            .'|getSchool/([^/]++)(*:1071)'
                            .'|edit/([^/]++)(*:1093)'
                            .'|delete/([^/]++)(*:1117)'
                        .')'
                    .')'
                    .'|tudents/(?'
                        .'|getS(?'
                            .'|tudent(?'
                                .'|/([^/]++)(*:1164)'
                                .'|ByEmail/([^/]++)(*:1189)'
                            .')'
                            .'|chedule/([^/]++)(*:1215)'
                        .')'
                        .'|edit/([^/]++)(*:1238)'
                        .'|delete/([^/]++)(*:1262)'
                        .'|listBySchool/([^/]++)(*:1292)'
                    .')'
                    .'|ubjects/(?'
                        .'|edit/([^/]++)(*:1326)'
                        .'|delete/([^/]++)(*:1350)'
                        .'|school/([^/]++)(*:1374)'
                    .')'
                .')'
                .'|/teachers/(?'
                    .'|get(?'
                        .'|Teacher(?'
                            .'|/([^/]++)(*:1423)'
                            .'|ByEmail/([^/]++)(*:1448)'
                        .')'
                        .'|S(?'
                            .'|tudents/([^/]++)(*:1478)'
                            .'|chedule/([^/]++)(*:1503)'
                            .'|ubjects/([^/]++)(*:1528)'
                        .')'
                        .'|Qualifications/([^/]++)(*:1561)'
                        .'|Grades/([^/]++)(*:1585)'
                    .')'
                    .'|edit/([^/]++)(*:1608)'
                    .'|delete/([^/]++)(*:1632)'
                    .'|listBySchool/([^/]++)(*:1662)'
                .')'
                .'|/users/(?'
                    .'|edit/([^/]++)(*:1695)'
                    .'|delete/([^/]++)(*:1719)'
                    .'|getRole/([^/]++)(*:1744)'
                    .'|setRole/([^/]++)(*:1769)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        79 => [[['_route' => 'attendance_getAttendance', '_controller' => 'App\\Controller\\AttendanceController::getAttendance'], ['id'], null, null, false, true, null]],
        99 => [[['_route' => 'attendance_edit', '_controller' => 'App\\Controller\\AttendanceController::edit'], ['id'], null, null, false, true, null]],
        121 => [[['_route' => 'attendance_delete', '_controller' => 'App\\Controller\\AttendanceController::delete'], ['id'], null, null, false, true, null]],
        153 => [[['_route' => 'attendance_student_list', '_controller' => 'App\\Controller\\AttendanceController::getAttendacesForStudent'], ['id'], null, null, false, true, null]],
        181 => [[['_route' => 'attendance_subject_list', '_controller' => 'App\\Controller\\AttendanceController::getAttendancesForSubject'], ['id'], null, null, false, true, null]],
        225 => [[['_route' => 'grades_getGrade', '_controller' => 'App\\Controller\\GradesController::getGrade'], ['id'], null, null, false, true, null]],
        251 => [[['_route' => 'grade_student', '_controller' => 'App\\Controller\\GradesController::getStudentGrade'], ['id'], null, null, false, true, null]],
        277 => [[['_route' => 'grades_students', '_controller' => 'App\\Controller\\GradesController::getStudents'], ['id'], null, null, false, true, null]],
        299 => [[['_route' => 'grades_edit', '_controller' => 'App\\Controller\\GradesController::edit'], ['id'], null, null, false, true, null]],
        322 => [[['_route' => 'grades_delete', '_controller' => 'App\\Controller\\GradesController::delete'], ['id'], null, null, false, true, null]],
        357 => [[['_route' => 'marks_getMark', '_controller' => 'App\\Controller\\MarksController::getMark'], ['id'], null, null, false, true, null]],
        378 => [[['_route' => 'marks_edit', '_controller' => 'App\\Controller\\MarksController::edit'], ['id'], null, null, false, true, null]],
        401 => [[['_route' => 'marks_delete', '_controller' => 'App\\Controller\\MarksController::delete'], ['id'], null, null, false, true, null]],
        433 => [[['_route' => 'marks_student_list', '_controller' => 'App\\Controller\\MarksController::studentMarksList'], ['id'], null, null, false, true, null]],
        461 => [[['_route' => 'marks_subject_list', '_controller' => 'App\\Controller\\MarksController::subjectMarksList'], ['id'], null, null, false, true, null]],
        507 => [[['_route' => 'parents_getParent', '_controller' => 'App\\Controller\\ParentsController::getParent'], ['id'], null, null, false, true, null]],
        531 => [[['_route' => 'parents_getParentByEmail', '_controller' => 'App\\Controller\\ParentsController::getParentByEmail'], ['email'], null, null, false, true, null]],
        553 => [[['_route' => 'parents_edit', '_controller' => 'App\\Controller\\ParentsController::edit'], ['id'], null, null, false, true, null]],
        576 => [[['_route' => 'parents_delete', '_controller' => 'App\\Controller\\ParentsController::delete'], ['id'], null, null, false, true, null]],
        601 => [[['_route' => 'parent_students', '_controller' => 'App\\Controller\\ParentsController::getStudentsByParent'], ['id'], null, null, false, false, null]],
        653 => [[['_route' => 'principals_getPrincipal', '_controller' => 'App\\Controller\\PrincipalsController::getPrincipal'], ['id'], null, null, false, true, null]],
        677 => [[['_route' => 'principals_getPrincipalByEmail', '_controller' => 'App\\Controller\\PrincipalsController::getPrincipalByEmail'], ['email'], null, null, false, true, null]],
        701 => [[['_route' => 'principals_parents', '_controller' => 'App\\Controller\\PrincipalsController::getParents'], ['id'], null, null, false, true, null]],
        730 => [[['_route' => 'principals_students', '_controller' => 'App\\Controller\\PrincipalsController::getStudents'], ['id'], null, null, false, true, null]],
        754 => [[['_route' => 'principals_subjects', '_controller' => 'App\\Controller\\PrincipalsController::getSubjects'], ['id'], null, null, false, true, null]],
        780 => [[['_route' => 'principals_teachers', '_controller' => 'App\\Controller\\PrincipalsController::getTeachers'], ['id'], null, null, false, true, null]],
        802 => [[['_route' => 'principals_edit', '_controller' => 'App\\Controller\\PrincipalsController::edit'], ['id'], null, null, false, true, null]],
        825 => [[['_route' => 'principals_delete', '_controller' => 'App\\Controller\\PrincipalsController::delete'], ['id'], null, null, false, true, null]],
        867 => [[['_route' => 'qualifications_edit', '_controller' => 'App\\Controller\\QualificationsController::edit'], ['id'], null, null, false, true, null]],
        890 => [[['_route' => 'qualifications_delete', '_controller' => 'App\\Controller\\QualificationsController::delete'], ['id'], null, null, false, true, null]],
        922 => [[['_route' => 'roles_getRole', '_controller' => 'App\\Controller\\RolesController::getRole'], ['id'], null, null, false, true, null]],
        970 => [[['_route' => 'schedule_listBySchool', '_controller' => 'App\\Controller\\ScheduleController::listBySchool'], ['id'], null, null, false, true, null]],
        990 => [[['_route' => 'schedule_get', '_controller' => 'App\\Controller\\ScheduleController::getSchedule'], ['id'], null, null, false, true, null]],
        1011 => [[['_route' => 'schedule_edit', '_controller' => 'App\\Controller\\ScheduleController::edit'], ['id'], null, null, false, true, null]],
        1035 => [[['_route' => 'schedule_delete', '_controller' => 'App\\Controller\\ScheduleController::deleteSchedule'], ['id'], null, null, false, true, null]],
        1071 => [[['_route' => 'schools_getSchool', '_controller' => 'App\\Controller\\SchoolsController::getSchool'], ['id'], null, null, false, true, null]],
        1093 => [[['_route' => 'schools_edit', '_controller' => 'App\\Controller\\SchoolsController::edit'], ['id'], null, null, false, true, null]],
        1117 => [[['_route' => 'schools_delete', '_controller' => 'App\\Controller\\SchoolsController::delete'], ['id'], null, null, false, true, null]],
        1164 => [[['_route' => 'students_getStudent', '_controller' => 'App\\Controller\\StudentsController::getStudent'], ['id'], null, null, false, true, null]],
        1189 => [[['_route' => 'students_getStudent_email', '_controller' => 'App\\Controller\\StudentsController::getStudentByEmail'], ['email'], null, null, false, true, null]],
        1215 => [[['_route' => 'students_getSchedule', '_controller' => 'App\\Controller\\StudentsController::getSchedule'], ['id'], null, null, false, true, null]],
        1238 => [[['_route' => 'students_get', '_controller' => 'App\\Controller\\StudentsController::edit'], ['id'], null, null, false, true, null]],
        1262 => [[['_route' => 'students_delete', '_controller' => 'App\\Controller\\StudentsController::delete'], ['id'], null, null, false, true, null]],
        1292 => [[['_route' => 'students_listBySchool', '_controller' => 'App\\Controller\\StudentsController::listBySchool'], ['id'], null, null, false, true, null]],
        1326 => [[['_route' => 'subject_edit', '_controller' => 'App\\Controller\\SubjectsController::edit'], ['id'], null, null, false, true, null]],
        1350 => [[['_route' => 'subject_delete', '_controller' => 'App\\Controller\\SubjectsController::delete'], ['id'], null, null, false, true, null]],
        1374 => [[['_route' => 'subjects_school_list', '_controller' => 'App\\Controller\\SubjectsController::getSubjectsForSchool'], ['id'], null, null, false, true, null]],
        1423 => [[['_route' => 'teachers_getTeacher', '_controller' => 'App\\Controller\\TeachersController::getTeacher'], ['id'], null, null, false, true, null]],
        1448 => [[['_route' => 'teachers_getTeacherByEmail', '_controller' => 'App\\Controller\\TeachersController::getTeacherByEmail'], ['email'], null, null, false, true, null]],
        1478 => [[['_route' => 'teachers_students', '_controller' => 'App\\Controller\\TeachersController::getStudents'], ['id'], null, null, false, true, null]],
        1503 => [[['_route' => 'teachers_getSchedule', '_controller' => 'App\\Controller\\TeachersController::getSchedule'], ['id'], null, null, false, true, null]],
        1528 => [[['_route' => 'teachers_getSubjects', '_controller' => 'App\\Controller\\TeachersController::getSubjects'], ['id'], null, null, false, true, null]],
        1561 => [[['_route' => 'teachers_getQualifications', '_controller' => 'App\\Controller\\TeachersController::getQualifications'], ['id'], null, null, false, true, null]],
        1585 => [[['_route' => 'teachers_getGrades', '_controller' => 'App\\Controller\\TeachersController::getGrades'], ['id'], null, null, false, true, null]],
        1608 => [[['_route' => 'teachers_edit', '_controller' => 'App\\Controller\\TeachersController::edit'], ['id'], null, null, false, true, null]],
        1632 => [[['_route' => 'teachers_delete', '_controller' => 'App\\Controller\\TeachersController::delete'], ['id'], null, null, false, true, null]],
        1662 => [[['_route' => 'teachers_listBySchool', '_controller' => 'App\\Controller\\TeachersController::listBySchool'], ['id'], null, null, false, true, null]],
        1695 => [[['_route' => 'users_edit', '_controller' => 'App\\Controller\\UsersController::edit'], ['id'], ['PUT' => 0], null, false, true, null]],
        1719 => [[['_route' => 'users_delete', '_controller' => 'App\\Controller\\UsersController::delete'], ['id'], null, null, false, true, null]],
        1744 => [[['_route' => 'users_getRole', '_controller' => 'App\\Controller\\UsersController::getRole'], ['id'], null, null, false, true, null]],
        1769 => [
            [['_route' => 'users_setRole', '_controller' => 'App\\Controller\\UsersController::changeRole'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
