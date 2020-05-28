<?php
use App\Controller\User\User;

$app->get('/userList', User::class . ':showUserList');

$app->post('/user', User::class . ':insertUser');
$app->get('/users', User::class . ':getUsers');
$app->delete('/user/{id}', User::class . ':deleteUser');