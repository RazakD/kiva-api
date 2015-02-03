<?php
namespace Loan;
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Loan\Controller\Index',
                      
                    ),
                ),
            ),
            'plugin' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/loan/plugin',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Loan\Controller',
                        'controller'    => 'Loan',
                        'action'        => 'fetchLoans',
                    ),
                ),
            ),
            'loan' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/loan[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Loan\Controller\Loan',
                       
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
           'Loan\Controller\Loan'   => 'Loan\Controller\LoanController',
         'KivaPlugin' => 'Loan\Controller\Plugin\KivaPlugin'
        ),

    ),
     'controller_plugins' => array(
'invokables' => array(
'KivaPlugin' => 'Loan\Controller\Plugin\KivaPlugin',
)
),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);
