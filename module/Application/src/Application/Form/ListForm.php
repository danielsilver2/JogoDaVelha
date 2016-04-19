<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Session\Container;

class ListForm extends Form{

    protected $adapter;

    protected $userTable;


	public function __construct(AdapterInterface $dbAdapter)
	{
		parent::__construct('list form');

        $this->adapter = $dbAdapter;
        $this->setAttribute('method', 'post');


        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'jogadores',
            'options' => array(
                'label' => 'Com quem você gostaria de jogar?',
                'empty_option' => '---------------------------------------',
                'value_options' => $this->getSelectOptions(),
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Cadastrar',
                'class' => 'btn btn-default',
                'id'    => 'submitbutton',
            ),
        ));
    }

    public function getSelectOptions()
    {
        $session = new Container('user');
        $userSession = $session->username;
        
        $dbAdapter = $this->adapter;

        $sql       = "SELECT id, username  FROM users where username <> '".$userSession."'";
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['id']] = $res['username'];
        }
        return $selectData;
    }
}

?>