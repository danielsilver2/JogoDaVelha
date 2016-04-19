<?php

namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAbstractServiceFactory;

class User implements InputFilterAwareInterface
{

    public $id;
    public $username;
    public $password;
    public $name;
    public $lastName;
    public $age;
    public $city;
    protected $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->id           = (isset($data['id']))            ? $data['id']         : null;
        $this->username     = (isset($data['username']))      ? $data['username']   : null;
        $this->password     = (isset($data['password']))      ? $data['password']   : null;
        $this->lastName     = (isset($data['lastName']))      ? $data['lastName']   : null;
        $this->name         = (isset($data['name']))          ? $data['name']       : null;
        $this->age          = (isset($data['age']))           ? $data['age']        : null;
        $this->role         = (isset($data['role']))          ? $data['role']       : null;
        $this->city         = (isset($data['city']))          ? $data['city']       : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Não usado");
    }

    public function getInputFilter()
    {
        if(!$this->inputFilter){
                    
            $inputFilter = new InputFilter();

                $inputFilter->add(array(
                    'name'     => 'id',
                    'required' => false,
                    'filters'  => array(
                        array('name' => 'Int'),
                    ),
                ));

                $inputFilter->add(array(
                    'name'      => 'username',
                    'required'  => true,
                    'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 100,
                            ),
                        ),
                    ),
                ));

                $inputFilter->add(array(
                    'name'      => 'password',
                    'required'  => true,
                    'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 70,
                            ),
                        ),
                    ),
                ));

                $inputFilter->add(array(
                    'name'      => 'name',
                    'required'  => true,
                    'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 70,
                            ),
                        ),
                    ),
                ));

                $inputFilter->add(array(
                    'name'      => 'lastName',
                    'required'  => true,
                    'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 70,
                            ),
                        ),
                    ),
                ));

                $inputFilter->add(array(
                    'name'      => 'age',
                    'required'  => false,
                    'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 25,
                            ),
                        ),
                    ),
                ));

                $inputFilter->add(array(
                    'name'      => 'city',
                    'required'  => false,
                    'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 70,
                            ),
                        ),
                    ),
                ));

                $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}

?>