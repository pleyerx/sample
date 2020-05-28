<?php

namespace App\Model\User;

//use User;

interface IUserDao {
	public function getList($page) : array;
    public function insert(UserData $user) : bool;
    public function find(int $id) : UserData;
    public function update(UserData $user) : bool;
    public function delete(UserData $user) : bool;
}