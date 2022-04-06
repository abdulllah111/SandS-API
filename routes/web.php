<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function() use ($router){
    $router->get('department', 'DepartmentController@showAllDepartments');
    $router->get('discipline', 'DisciplineController@index');
    $router->get('dgt', 'DisciplineGroupTeacherController@index');
    $router->get('group', 'GroupController@index');
    $router->get('office', 'OfficeController@index');
    $router->get('subttable', 'SubTtableController@index');
    $router->get('teacher', 'TeacherController@index');
    $router->get('ttable', 'TtableController@index');
    $router->get('lesson', 'LessonController@index');
    $router->get('weekday', 'WeekdayController@index');

    $router->get('department/{id}/groups', 'DepartmentController@getGroups');
    $router->get('subttable/getforgroupanddate/{id}/{date}', 'SubTtableController@getForIdGroupAndDate');
    $router->get('ttable/getforgroup/{id}/{weekday}', 'TtableController@getForIdGroupWeekday');
    $router->get('dgt/getforgroup/{id}', 'DisciplineGroupTeacherController@getForIdGroup');
    $router->get('ttable/fullinfo', 'TtableController@getfull');
    $router->get('subttable/fullinfo', 'SubTtableController@getfull');

    $router->get('department/{id}', 'DepartmentController@getone');
    $router->get('discipline/{id}', 'DisciplineController@getone');
    $router->get('dgt/{id}', 'DisciplineGroupTeacherController@getone');
    $router->get('group/{id}', 'GroupController@getone');
    $router->get('office/{id}', 'OfficeController@getone');
    $router->get('subttable/{id}', 'SubTtableController@getone');
    $router->get('teacher/{id}', 'TeacherController@getone');
    $router->get('ttable/{id}', 'TtableController@getone');
    $router->get('lesson/{id}', 'LessonController@getone');
    $router->get('weekday/{id}', 'WeekdayController@getone');
    
    $router->post('group/name', 'GroupController@getForName');
    $router->post('teacher/name', 'TeacherController@getForName');
    $router->post('weekday/name', 'WeekdayController@getForName');
    $router->post('lesson/name', 'LessonController@getForName');
    $router->post('office/name', 'OfficeController@getForName');
    $router->post('discipline/name', 'DisciplineController@getForName');
    $router->post('department/name', 'DepartmentController@getForName');
    
    $router->post('department', 'DepartmentController@store');
    $router->post('discipline', 'DisciplineController@store');
    $router->post('dgt', 'DisciplineGroupTeacherController@store');
    $router->post('group', 'GroupController@store');
    $router->post('office', 'OfficeController@store');
    $router->post('subttable', 'SubTtableController@store');
    $router->post('teacher', 'TeacherController@store');
    $router->post('ttable', 'TtableController@store');
    $router->post('lesson', 'LessonController@store');
    $router->post('weekday', 'WeekdayController@store');
   
    $router->put('department/{id}', 'DepartmentController@update');
    $router->put('discipline/{id}', 'DisciplineController@update');
    $router->put('dgt/{id}', 'DisciplineGroupTeacherController@update');
    $router->put('group/{id}', 'GroupController@update');
    $router->put('office/{id}', 'OfficeController@update');
    $router->put('subttable/{id}', 'SubTtableController@update');
    $router->put('teacher/{id}', 'TeacherController@update');
    $router->put('ttable/{id}', 'TtableController@update');
    $router->put('lesson/{id}', 'LessonController@update');
    $router->put('weekday/{id}', 'WeekdayController@update');
    
    $router->delete('department/{id}', 'DepartmentController@destroy');
    $router->delete('discipline/{id}', 'DisciplineController@destroy');
    $router->delete('dgt/{id}', 'DisciplineGroupTeacherController@destroy');
    $router->delete('delall', 'DisciplineGroupTeacherController@deleteAll');
    $router->delete('group/{id}', 'GroupController@destroy');
    $router->delete('office/{id}', 'OfficeController@destroy');
    $router->delete('subttable/{id}', 'SubTtableController@destroy');
    $router->delete('teacher/{id}', 'TeacherController@destroy');
    $router->delete('ttable/{id}', 'TtableController@destroy');

    $router->delete('delete/{id}', 'TtableController@deleteAll');
});