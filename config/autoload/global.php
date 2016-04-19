<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
	    'driver'    => 'Pdo',
	    'dsn'       => "pgsql:dbname=daniboy;port=5432;host=localhost",
		'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
	),
	'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'acl' => array(
        'roles' => array(
            'visitante' => null,
            'usuario'   => 'visitante',
            'admin'     => 'usuario',
        ),
        'resources' => array(
            'Application\Controller\Index.index',
            'Application\Controller\Admin.index',
            'Application\Controller\Admin.edit',
            'Application\Controller\Admin.add',
            'Application\Controller\Admin.delete',
            'Application\Controller\Auth.login',
            'Application\Controller\Auth.logout',
            'Application\Controller\Auth.authenticate',
        ), 
        'privilege' => array(
            'visitante' => array(
                'allow' => array(
                    'Application\Controller\Index.index',
                    'Application\Controller\Auth.login',
                    'Application\Controller\Auth.authenticate'
                ),
            ),
            'usuario' => array(
                'allow' => array(
                    // 'Application\Controller\Admin.index',
                    'Application\Controller\Auth.logout',
                    // 'Application\Controller\Auth.logout',
                ), 
            ),
            'admin' => array(
                'allow' => array(
                    'Application\Controller\Admin.edit',
                    'Application\Controller\Admin.add',
                    'Application\Controller\Admin.delete',
                    'Application\Controller\Auth.logout'
                ),
            ),
        ),
    ),
);
