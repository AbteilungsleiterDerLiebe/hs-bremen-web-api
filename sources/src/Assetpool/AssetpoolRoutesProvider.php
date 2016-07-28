<?php

namespace HsBremen\WebApi\Assetpool;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Swagger\Annotations as SWG;

class AssetpoolRoutesProvider implements ControllerProviderInterface
{
    /** {@inheritdoc} */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        /**
         * @SWG\Parameter(name="assetid", type="integer", format="int11", in="path")
         * @SWG\Tag(name="order", description="All about assets")
         */

        /**
         * @SWG\Get(
         *     path="/asset/",
         *     tags={"asset"},
         *     @SWG\Response(response="200", description="An example resource")
         * )
         */
        // see https://github.com/silexphp/Silex/issues/149
        $controllers->get('/', 'service.asset:getList');
        /**
         * @SWG\Get(
         *     path="/asset/{assetId}",
         *     tags={"asset"},
         *     @SWG\Parameter(ref="#/parameters/assetId"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(ref="#/definitions/order")
         *     )
         * )
         */
        $controllers->get('/{assetId}', 'service.asset:getDetails');
        /**
         * @SWG\Post(
         *     tags={"asset"},
         *     path="/asset/",
         *     @SWG\Parameter(name="order", in="body", @SWG\Schema(ref="#/definitions/order")),
         *     @SWG\Response(response="201", description="TODO funktioniert noch nicht!")
         * )
         */
        $controllers->post('/', 'service.asset:createAsset');
        /**
         * @SWG\Put(
         *     tags={"asset"},
         *     path="/asset/{id}",
         *     @SWG\Parameter(ref="#/parameters/id"),
         *     @SWG\Response(
         *          response="200",
         *          description="TODO funktioniert noch nicht!",
         *          @SWG\Schema(ref="#/definitions/order")
         *     )
         * )
         */
        $controllers->put('/{assetId}', 'service.asset:changeAsset');

        return $controllers;
    }
}
