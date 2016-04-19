<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Storage\Session as SessionStorage;

use Application\Form\ListForm;
use Application\Controller\Auth;


use Application\Model\UserTable;

class UserController extends AbstractActionController
{

	protected $userTable;

	public function indexAction()
	{
		if (! $this->serviceLocator->get('AuthService')->hasIdentity()){
            return $this->redirect()->toRoute('login');
    	}
		return new ViewModel();
	}

	public function gameAction()
	{
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$form = new ListForm($dbAdapter);
    	$form->get('submit')->setValue('Jogar');
		
		return array('form' 	=> $form,
					'messages' 	=> $this->flashmessenger()->getMessages()
					);
	}


	public function playAction()
	{
		// echo 'helllo';
		return new ViewModel();
	}

	public function hiscoresAction()
	{
		
	}
}