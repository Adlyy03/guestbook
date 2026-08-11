<?php

$router->get('/', function () {
    return response()->json([
        'status' => true,
        'message' => 'API Guestbook is running'
    ]);
});

$router->get('/api/test-db', function () {
    try {
        DB::connection()->getPdo();
        return response()->json([
            'status' => true,
            'message' => 'Database Connected'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Database Connection Failed',
            'error' => $e->getMessage()
        ], 500);
    }
});

$router->get('/api/guests', 'GuestController@index');
$router->get('/api/guests/{id}', 'GuestController@show');
$router->post('/api/guests', 'GuestController@store');
$router->put('/api/guests/{id}', 'GuestController@update');
$router->delete('/api/guests/{id}', 'GuestController@destroy');

$router->get('/api/visits', 'VisitController@index');
$router->get('/api/visits/{id}', 'VisitController@show');
$router->post('/api/visits', 'VisitController@store');
$router->put('/api/visits/{id}', 'VisitController@update');
$router->delete('/api/visits/{id}', 'VisitController@destroy');

$router->get('/api/routes', function () use ($router) {
    return response()->json($router->getRoutes());
});
