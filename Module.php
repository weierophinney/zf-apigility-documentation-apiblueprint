<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @copyright Copyright (c) 2015 Apiary Ltd. <support@apiary.io>
 */

namespace ZF\Apigility\Documentation\ApiBlueprint;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/'
                )
            )
        );
    }

    public function onBootstrap($e)
    {
        $app    = $e->getApplication();
        $events = $app->getEventManager();
        $events->attach('render', array($this, 'onRender'), 100);
    }

    public function onRender($e)
    {
        $model = $e->getResult();
        if (! $model instanceof ApiBlueprintModel) {
            return;
        }

        $app      = $e->getApplication();
        $services = $app->getServiceManager();
        $view     = $services->get('View');
        $events   = $view->getEventManager();
        $events->attach($services->get(__NAMESPACE__ . '\ApiBlueprintViewStrategy'));
    }
}
