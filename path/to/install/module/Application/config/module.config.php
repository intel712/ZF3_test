<?php
namespace Application;

use Application\Controller\IndexController;
use Application\I18n\I18nListener;
use Application\I18n\I18nListenerFactory;
use Zend\I18n\View\Helper\Translate;
use Zend\ServiceManager\Factory\InvokableFactory;

use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/[:lang]',
                    'defaults'    => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                        'lang'       => 'ru',
                    ],
                    'constraints' => [
                        'lang' => '(ru|en)',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            I18nListener::class => I18nListenerFactory::class,
        ],
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'invokables' => [
            'translate' => Translate::class
        ],
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'i18n' => [
        'defaultLang'    => 'ru',
        'allowedLocales' => [
            'ru' => 'ru_RU',
            'en' => 'en_US',
        ],
        'defaultRoute'   => 'index',
    ],

    'translator' => [
        'translation_file_patterns' => [
            [
                'type'     => 'phparray',
                'base_dir' => APPLICATION_MODULE_ROOT . '/language',
                'pattern'  => '%s.php',
            ],
        ],
    ],

];
