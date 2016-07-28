<?php

namespace HsBremen\WebApi\Assetpool;

use HsBremen\WebApi\Logging\DomainLogger;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AssetpoolServiceProvider implements ServiceProviderInterface
{
    /** {@inheritdoc} */
    public function register(Application $app)
    {
        $app['repo.asset'] = $app->share(function (Application $app) {
            return new AssetpoolRepository($app['db']);
        });

        $app['service.asset'] = $app->share(function (Application $app) {
            return new AssetpoolService($app['repo.asset'], $app['dispatcher']);
        });

        $app['subscriber.asset_domain'] = $app->share(
          function (Application $app) {
              return new AssetpoolDomainEventSubscriber($app['repo.asset']);
          }
        );

        $app['subscriber.domain_logger'] = $app->share(
          function (Application $app) {
              return new DomainLogger($app['api_logger']);
          }
        );

        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $app['dispatcher'];
        $dispatcher->addSubscriber($app['subscriber.domain_logger']);
        $dispatcher->addSubscriber($app['subscriber.asset_domain']);

        $app->mount('/asset', new AssetpoolRoutesProvider());
    }

    /** {@inheritdoc} */
    public function boot(Application $app)
    {
        /** @var OrderRepository $repo */
        $repo = $app['repo.asset'];
        $repo->createTable();
    }
}
