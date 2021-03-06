<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @copyright Copyright (c) 2015 Apiary Ltd. <support@apiary.io>
 */

namespace ZF\Apigility\Documentation\ApiBlueprint;

use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ControllerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $controllers
     * @return \Blueprint\Controller
     * @throws ServiceNotCreatedException if the ZF\Apigility\Documentation\ApiFactory service is missing
     */
    public function createService(ServiceLocatorInterface $controllers)
    {
        $services = $controllers->getServiceLocator();
        if (!$services->has('ZF\Apigility\Documentation\ApiFactory')) {
            throw new ServiceNotCreatedException(sprintf(
                '%s\BlueprintController requires the service ZF\Apigility\Documentation\ApiFactory, '
                . 'which was not found',
                __NAMESPACE__
            ));
        }
        return new Controller($services->get('ZF\Apigility\Documentation\ApiFactory'));
    }
}
