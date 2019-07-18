<?php
namespace Application\I18n;

use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\Translator;
use Zend\I18n\Translator\TranslatorInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class I18nListenerFactory
 *
 * @package Application\I18n
 */
class I18nListenerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        /** @var Translator $translator */
        $translator = $container->get(TranslatorInterface::class);
        $config     = $container->get('config');

        $listener = new I18nListener();
        $listener->setTranslator($translator);
        $listener->setDefaultLang($config['i18n']['defaultLang']);
        $listener->setAllowedLocales($config['i18n']['allowedLocales']);

        return $listener;
    }
}