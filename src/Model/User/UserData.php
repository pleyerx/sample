<?php

namespace App\Model\User;

class UserData {
	private $account = '';
	private $name = '';
	private $email = '';
	private $sex = '';
	private $birthday = '';
	private $memo = '';
	private $userId = 0;
	
	public function setUserId($id) {
		$this->userId = $id;
	}
	
	public function getUserId() {
		return $this->userId;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setAccount($account){
		$this->account = $account;
	}
	
	public function getAccount(){
		return $this->account;
	}
	
	public function setSex( $sex){
		$this->sex = $sex;
	}
	
	public function getSex(){
		return $this->sex;
	}
	
	public function setBirthday($birthday){
		$this->birthday = $birthday;
	}
	
	public function getBirthday(){
		return $this->birthday;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getEmail(){
		return $this->email;
	}	
	
	public function setMemo($memo){
		$this->memo = $memo;
	}
	
	public function getMemo(){
		return $this->memo;
	}
	
	public function toArray(){
		return [
			'account'	=> $this->account,
			'name'	=> $this->name,
			'email'	=> $this->email,
			'sex'	=> $this->sex,
			'birthday'	=> $this->birthday,
			'memo'	=> $this->memo,
		];
	}
}