<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
//use Application\Route\StaticRoute;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'check-alert' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/check-alert',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'checkAlert',
                    ],
                ],
            ],
            'ajax' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/ajax',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'ajax',
                    ],
                ],
            ],
            'alert' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/alert',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'alert',
                    ],
                ],
            ],
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/login_bad',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action' => 'prihlaseni',
                    ],
                ],
            ],
            'nastaveni' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/nastaveni',
                    'defaults' => [
                        'controller' => Controller\SettingController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'application' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'about' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/about',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'about',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\LoginController::class => InvokableFactory::class,
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\SettingController::class => Controller\Factory\SettingControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\SettingManager::class => Service\Factory\SettingManagerFactory::class,
            Service\OnlineManager::class => Service\Factory\OnlineManagerFactory::class,
            Service\NavManager::class => Service\Factory\NavManagerFactory::class,
            Service\RbacAssertionManager::class => Service\Factory\RbacAssertionManagerFactory::class,
        ],
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.
    'access_filter' => [
        'options' => [
            // The access filter can work in 'restrictive' (recommended) or 'permissive'
            // mode. In restrictive mode all controller actions must be explicitly listed 
            // under the 'access_filter' config key, and access is denied to any not listed 
            // action for not logged in users. In permissive mode, if an action is not listed 
            // under the 'access_filter' key, access to it is permitted to anyone (even for 
            // not logged in users. Restrictive mode is more secure and recommended to use.
            'mode' => 'restrictive'
        ],
        'controllers' => [
            Controller\IndexController::class => [
                // Allow anyone to visit "index" and "about" actions
                //['actions' => ['index', 'about','ajax'], 'allow' => '*'],
                // Allow authorized users to visit "settings" action
                ['actions' => ['index', 'about', 'ajax','checkAlert', 'alert', 'settings'], 'allow' => '@']
            ],
            Controller\SettingController::class => [
                // Allow anyone to visit "index" and "about" actions
                ['actions' => ['index'], 'allow' => '+profile.own.edit'],
                ['actions' => '*', 'allow' => '+permission.manage']
            ],
        ]
    ],
    // This key stores configuration for RBAC manager.
    'rbac_manager' => [
        'assertions' => [Service\RbacAssertionManager::class],
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\Menu::class => View\Helper\Factory\MenuFactory::class,
            View\Helper\Breadcrumbs::class => InvokableFactory::class,
        ],
        'aliases' => [
            'mainMenu' => View\Helper\Menu::class,
            'pageBreadcrumbs' => View\Helper\Breadcrumbs::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/login' => __DIR__ . '/../view/layout/login.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => array('ViewJsonStrategy',),
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
];
