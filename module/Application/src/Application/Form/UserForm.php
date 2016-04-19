<?php
namespace Application\Form;

use Zend\Form\Form;

class UserForm extends Form{
	public function __construct($name = null)
	{
		parent::__construct('users');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         
		$this->add(array(
			'name'		=>	'username',
			'options'	=>	array(
				'label' => "Usuário*",
			),
			'attributes' => array(
				'type' 	=> 'text',
				'class' => 'form-control'
			),
			'decorators' => array(
				array(
					'HtmlTag', array(
					'tag'  => 'div',
					'id'   => 'form-group',
					),
				),
			),
		));
		$this->add(array(
			'name'		=>	'name',
			'options'	=>	array(
				'label' => "Nome*",
			),
			'attributes' => array(
				'type' 	=> 'text',
				'class' => 'form-control'
			),
			'decorators' => array(
				array(
					'HtmlTag', array(
					'tag'  => 'div',
					'id'   => 'form-group',
					),
				),
			),
		));

		$this->add(array(
			'name'		=>	"lastName",
			'options'	=>	array(
				'label' => "Sobrenome*",
			),
			'attributes' => array(
				'type' 	=> 'text',
				'class' => 'form-control'
			),
			'decorators' => array(
				array(
					'HtmlTag', array(
					'tag'  => 'div',
					'id'   => 'form-group',
					),
				),
			),
		));

		$this->add(array(
			'name'		=>	"age",
			'options'	=>	array(
				'label' => "Idade",
			),
			'attributes' => array(
				'type' 	=> 'text',
				'class' => 'form-control'
			),
			'decorators' => array(
				array(
					'HtmlTag', array(
					'tag'  => 'div',
					'id'   => 'form-group',
					),
				),
			),
		));

		$this->add(array(
			'name'		=>	"city",
			'options'	=>	array(
				'label' => "Cidade",
			),
			'attributes' => array(
				'type' 	=> 'text',
				'class' => 'form-control'
			),
			'decorators' => array(
				array(
					'HtmlTag', array(
					'tag'  => 'div',
					'id'   => 'form-group',
					),
				),
			),
		));

		$this->add(array(
			'name'		=>	"password",
			'options'	=>	array(
				'label' => "Senha*",
			),
			'attributes' => array(
				'type' => 'password',
				'class' => 'form-control',
			),
		));

        $this->add(array(
        	'name' => 'submit',
        	'type' => 'Submit',
        	'attributes' => array(
        		'value' => 'Cadastrar',
        		'class'	=> 'btn btn-default',
        		'id'	=> 'submitbutton',
        	),
       	));
	}
}

?>