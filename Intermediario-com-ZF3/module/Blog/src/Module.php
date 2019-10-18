<?php

namespace Blog;

use Blog\Controller\BlogController;
use Blog\Model\Factory\PostTableGatewayFactory;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\Pdo\Result;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig(){
        return include __DIR__ ."/../config/module.config.php";
    }

    public function getServiceConfig(){
        return [
            'factories' => [
                Model\PostTable::class => function($container) {
                    $tableGateway = $container->get(Model\PostTableGateway::class);
                    return new Model\PostTable($tableGateway);
                },
                Model\PostTableGateway::class => PostTableGatewayFactory::class
            ]
        ];
    }

    public function getControllerConfig(){
        return [
            'factories' => [
                BlogController::class => function($container) {
                    return new BlogController(
                        $container->get(Model\PostTable::class)
                    );
                }
            ]
        ];
    }
}