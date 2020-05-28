<?php

namespace App\Model\User;

use PDO;

class UserDao implements IUserDao {
	protected $conn;

	//use baseDao
	public function setConnect($conn){
		$this->conn = $conn;
	}
	
	//use baseDao
	public function getConnect(){
		return $this->conn;
	}
	
	public function insert(UserData $user) : bool{
		$db = null;
		$result = false;
		try{
			$db = $this->getConnect();
			$name = $user->getName();
			$account = $user->getAccount();
			$sex = $user->getSex();
			$birthday = $user->getBirthday();
			$email = $user->getEmail();
			$sth = $db->prepare("Insert into account_info set user_account = :uAccount, user_email = :uEmail,
			user_sex = :uSex, user_Birthday = :uBirthday , user_name=:uName ");
			$sth->bindParam(':uAccount', $account, PDO::PARAM_STR );
			$sth->bindParam(':uSex', $sex, PDO::PARAM_STR );
			$sth->bindParam(':uBirthday', $birthday, PDO::PARAM_STR );
			$sth->bindParam(':uName', $name, PDO::PARAM_STR );
			$sth->bindParam(':uEmail', $email, PDO::PARAM_STR );
			$result = $sth->execute();
		}catch(Throwable $e){
			
		}

		$db = null;
		return $result;		
	}
	
    public function find(int $id) : UserData {
		
	}
	
    public function update(UserData $user) :bool{
		
	}
	
	public function getList($page) : array {
		$db = null;
		$data = [];
		try{
			$db = $this->getConnect();
			$sth = $db->prepare("Select uid,user_name,user_email,user_birthday,user_sex,user_account FROM account_info Limit ? , 20");
			$sth->bindValue(1, $page, PDO::PARAM_INT);
			$sth->execute();
			$data = $sth->fetchAll(PDO::FETCH_ASSOC);
		}catch(Throwable $e){
			
		}

		$db = null;
		return $data;		
	}
	
    public  function delete(UserData $user): bool{
		$db = null;
		$result = false;
		try{
			$db = $this->getConnect();
			$userId = $user->getUserId();
			$sth = $db->prepare("DELETE FROM account_info WHERE uid = :id");
			$sth->bindParam(':id', $userId, PDO::PARAM_INT);
			$result = $sth->execute();
		}catch(Throwable $e){
			
		}

		$db = null;
		return $result;
	}
}