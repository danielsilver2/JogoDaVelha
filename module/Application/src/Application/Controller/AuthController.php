<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Session\Container;

use Application\Model\User;
use Application\Form\UserForm;

class AuthController extends AbstractActionController
{
    protected $form;
    protected $storage;
    protected $authservice;


    public function getAuthService()
    {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }

        return $this->authservice;
    }

    public function getSessionStorage()
    {
        if ( $this->storage) {
            $this->storage = $this->getServiceLocator()
                                  ->get('Application\Model\MyAuthStorage');
        }

        return $this->storage;
    }

    public function getForm()
    {
        if (! $this->form) {
            // $user       = new User();
            // $builder    = new AnnotationBuilder();
            // $this->form = $builder->createForm($user);
            $form = new UserForm();
            $this->form = $form;
        }

        return $this->form;
    }

    public function loginAction()
    {
        if ($this->getAuthService()->hasIdentity()){
            return $this->redirect()->toRoute('admin');
        }

        $form       = $this->getForm();

        return array(
            'form'      => $form,
            'messages'  => $this->flashmessenger()->getMessages()
        );
    }

    public function authenticateAction()
    {
        $form       = $this->getForm();
        $redirect = 'login';

        $request = $this->getRequest();
        if ($request->isPost()){
            $form->setData($request->getPost());
            if ($form->isValid()){
                $this->getAuthService()->getAdapter()
                                       ->setIdentity($request->getPost('username'))
                                       ->setCredential($request->getPost('password'));

                $result = $this->getAuthService()->authenticate();
                foreach($result->getMessages() as $message)
                {
                    $this->flashmessenger()->addMessage($message);
                }

                if ($result->isValid()) {
                    $redirect = 'admin';
                    if ($request->getPost('rememberme') == 1 ) {
                        $this->getSessionStorage()
                             ->setRememberMe(1);
                        $this->getAuthService()->setStorage($this->getSessionStorage());
                    }
                    $this->getAuthService()->getStorage()->write($request->getPost('username'));
                    $userSession = new Container('user');
                    $userSession->username = $request->getPost('username');
                }
            }
        }

        return $this->redirect()->toRoute($redirect);
    }

    public function logoutAction()
    {
        $this->getAuthService()->clearIdentity();

        $this->flashmessenger()->addMessage("Você foi deslogado");
        $this->redirect()->toRoute('login');
    }
}