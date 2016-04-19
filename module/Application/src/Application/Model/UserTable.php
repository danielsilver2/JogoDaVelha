<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
{

	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;

	}

	public function getUserTable()
    {
    	if(!$this->userTable){
    		$sm = $this->getServiceLocator();
    		$this->userTable = $sm->get('Application\Model\UserTable');
    	}
    	return $this->userTable;
    }

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getUser($id)
	{
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if(!$row){
			throw new \Exception("Usuário não encontrado com o id: $id");
		}
		return $row;
	}

	public function saveUser(User $user)
	{
		$data = array(
			'username'		=> $user->username,
			'password'		=> $user->password,
			'lastName' 		=> $user->lastName,
			'name' 			=> $user->name,
			'age' 			=> $user->age,
			'role'			=> 'admin',
			'city' 			=> $user->city,
		);
		$id = (int) $user->id;
		if($id == 0){
				$this->tableGateway->insert($data);
		}else{
			if($this->getUser($id)){
				$this->tableGateway->update($data, array('id' => $id));
			}else{
				throw new \Exception('Id do usuário não existente');
			}
		}
	}

	public function deleteUser($id)
	{
		$this->tableGateway->delete(array('id' => (int) $id));
	}
}