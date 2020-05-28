<?php

namespace App\Controller\User;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Psr\Container\ContainerInterface;
use App\Model\User as MUser;
use App\Utility\DateTool;
use Exception;
class User
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
	
	/**
	* 顯示使用者清單畫面
	*/	
    public function showUserList($request, $response, $args) {
		return $this->container->get('view')->render($response, 'user/users.twig', [
			'name' => 'aaab'
		]);
    }
	
	/**
	* 取得使用者清單
	*/
	public function getUsers($request, $response, $args) {
		$data = [];
		$message = 'error';
		$responseStatus = 400;
		$page = 0;
		try{
			$message = 'ok';
			$conn = $this->container->get('db');
			$userDao = new MUser\UserDao();
			$userDao->setConnect($conn);
			$data = $userDao->getList($page);
			$responseStatus = 200;
		}catch(Throwable $e){
			$message = 'error';
			$responseStatus = 400;
		}
		
		$output = [
			'data' => $data,
			'message' => $message
		];
		$jsonOutput = json_encode($output);
		$response->getBody()->write($jsonOutput);
		
		return $response
			  ->withHeader('Content-Type', 'application/json')
			  ->withStatus($responseStatus);	
	}
	
	public function insertUser($request, $response, $args){
		$data = [];
		$message = 'error';
		$responseStatus = 400;
		$postData = $request->getParsedBody();

		try{ 
			if( !empty($postData) ){
				//required use htmlspecialchars
				
				$uAccount = $postData['uAccount'] ?? "";
				$uEmail = $postData['uEmail'] ?? "";
				$uBirthday = $postData['uBirthday'] ?? "";
				$uSex = $postData['uSex'] ?? "";
				$uName = $postData['uName'] ?? "";
				
				if( empty($uAccount) || empty($uEmail) || !isset($uSex) || empty($uName) ||  empty($uBirthday)){
					throw new Exception('所有欄位都必填');
				}
				
				//required verification data
				if( !DateTool::isDate($uBirthday) ){
					throw new Exception('生日的日期格式錯誤');
				}
				

				$conn = $this->container->get('db');
				$userData = new MUser\UserData();
				$userData->setName($uName);
				$userData->setSex($uSex);
				$userData->setBirthday($uBirthday);
				$userData->setAccount($uAccount);
				$userData->setEmail($uEmail);
				$userDao = new MUser\UserDao();
				$userDao->setConnect($conn);
				$result = $userDao->insert($userData);
			}
			
			$result = true;
			if( $result ){
				$message = 'ok';
				$responseStatus = 200;
			}else{
				throw new Exception('新增失敗');
			}
		}catch (Exception $e) {
			$message = $e->getMessage();
			$responseStatus = 400;
		
		}catch(Throwable $e){
			$message = $e->getMessage();
			$responseStatus = 400;
		}
		
		$output = [
			'data' => $data,
			'message' => $message
		];
		$jsonOutput = json_encode($output);
		$response->getBody()->write($jsonOutput);
		return $response
			  ->withHeader('Content-Type', 'application/json')
			  ->withStatus($responseStatus);	
	}
	
	/**
	* 刪除使用者
	*/
	public function deleteUser($request, $response, $args){
		$data = [];
		$message = 'error';
		$responseStatus = 400;
		$userId = $args['id'];
		
		try{
			//required use checkUserId input
			
			$conn = $this->container->get('db');
			$userData = new MUser\UserData();
			$userData->setUserId($userId);
			$userDao = new MUser\UserDao();
			$userDao->setConnect($conn);
			$result = $userDao->delete($userData);
			
			if( $result ){
				$message = 'ok';
				$responseStatus = 200;
			}else{
				throw 'error';
			}
		}catch(Throwable $e){
			$message = 'error';
			$responseStatus = 400;
		}
		
		$output = [
			'data' => $data,
			'message' => $message
		];
		$jsonOutput = json_encode($output);
		$response->getBody()->write($jsonOutput);
		return $response
			  ->withHeader('Content-Type', 'application/json')
			  ->withStatus($responseStatus);			
	}
}