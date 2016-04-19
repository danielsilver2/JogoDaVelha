<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\UserForm;
use Application\Model\User;

class AdminController extends AbstractActionController
{
    protected $userTable;

    public function indexAction()
    {	
    	if (! $this->serviceLocator->get('AuthService')->hasIdentity()){
            return $this->redirect()->toRoute('login');
        }
        return new ViewModel();
    }

    public function getUserTable()
    {
    	if(!$this->userTable){
    		$sm = $this->serviceLocator;
    		$this->userTable = $sm->get('Application\Model\UserTable');
    	}
    	return $this->userTable;
    }

    public function addAction()
    {
    	$form = new UserForm();
    	$form->get('submit')->setValue('Adicionar');
        $request = $this->getRequest();
        if($request->isPost()){
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid()){
                $user->exchangeArray($form->getData());
                $this->getUserTable()->saveUser($user);
                
    			return $this->redirect()->toRoute('admin');
            }
        }
		return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if(!$id){
            return $this->redirect()->toRoute('admin', array(
                'action' => 'add'
            ));
        }

        try{
            $user = $this->getUserTable()->getUser($id);
        }
        catch (\Exception $ex){
            return $this->redirect()->toRoute('admin', array(
                'action' => 'index'
            ));
        }

        $form = new UserForm();
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'Editar');

        $request = $this->getRequest();
        if($request->isPost()){
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid()){
                $this->getUserTable()->saveUser($user);

                return $this->redirect()->toRoute('admin');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }



    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if(!$id){
            return $this->redirect()->toRoute('admin');
        }

        return array(
            'id' => $id,
            'user' => $this->getUserTable()->getUser($id),
        );
    }
}
