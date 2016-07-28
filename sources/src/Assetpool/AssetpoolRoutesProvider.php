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
         * @SWG\Parameter(name="assetname", type="string", in="path")
         * @SWG\Parameter(name="path", type="string", in="path")
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
         *     path="/asset/{assetid}",
         *     tags={"asset"},
         *     @SWG\Parameter(ref="#/parameters/assetid"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource")
         * )
         */
        $controllers->get('/{assetId}', 'service.asset:getDetails');
        /**
         * @SWG\Post(
         *     path="/asset/createAsset/{assetname}&{path}",
         *     tags={"asset"},
         *     @SWG\Parameter(ref="#/parameters/assetname"),
         *     @SWG\Parameter(ref="#/parameters/path"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource")
         * )
         */
        $controllers->get('/createasset/{assetname}&{path}', 'service.asset:createAsset');

        $controllers->put('/{assetId}', 'service.asset:changeAsset');

        return $controllers;
    }
}
