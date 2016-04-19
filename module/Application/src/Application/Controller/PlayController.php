<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\ListForm;
use Application\Model\UserTable;

class PlayController extends AbstractActionController
{

	public function indexAction()
	{
		if (! $this->serviceLocator->get('AuthService')->hasIdentity()){
            return $this->redirect()->toRoute('login');
    	}

		$request = $this->getRequest();
		
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

		$idPlayer = new ListForm($dbAdapter);

		if($request->isPost()){
			$idPlayer->setData($request->getPost());
			if($idPlayer->isValid()){
				$id = $idPlayer->getData();

				$user = $this->getUserTable()->getUser($id['jogadores']);
				return array('user' => $user);
			}
		}
	}

    public function getUserTable()
    {
    	if(!$this->userTable){
    		$sm = $this->serviceLocator;
    		$this->userTable = $sm->get('Application\Model\UserTable');
    	}
    	return $this->userTable;
    }
}