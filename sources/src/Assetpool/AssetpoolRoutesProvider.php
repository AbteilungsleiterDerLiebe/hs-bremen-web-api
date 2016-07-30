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
         * @SWG\Parameter(name="tagid", type="integer", format="int11", in="path")
         * @SWG\Parameter(name="assetname", type="string", in="path")
         * @SWG\Parameter(name="path", type="string", in="path")
         * @SWG\Definition(definition="asset",
         *     @SWG\Property(property="assetname", example="defaultname"),
         *     @SWG\Property(property="path", example="defaultpath"))
         * @SWG\Tag.php(name="asset", description="All about assets")
         * @SWG\Tag.php(name="tags", description="All about tags")
         */

         /** @SWG\Get(
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
         *     path="/asset/createasset/",
         *     tags={"asset"},
         *     @SWG\Parameter(name="json", in="body", @SWG\Schema(ref="#/definitions/asset")),
         *     @SWG\Response(response="201", description="An example resource")
         * )
         */
        $controllers->Post('/createasset/', 'service.asset:createAsset');
        /** @SWG\Get(
         *     path="/asset/tags/",
         *     tags={"tags"},
         *     @SWG\Response(response="200", description="An example resource")
         * )
         */
        $controllers->get('/tags/', 'service.asset:getTagList');
                /**
                 * @SWG\Get(
                 *     summary="get assets by tag-id",
                 *     description="enter a Valid tag-id to get the corresponding assets.",
                 *     path="/asset/tags/{tagid}",
                 *     tags={"tags"},
                 *     @SWG\Parameter(ref="#/parameters/tagid"),
                 *     @SWG\Response(
                 *         response="200",
                 *         description="An example resource")
                 * )
                 */
        $controllers->get('/tags/{tagId}', 'service.asset:getAssetsByTag');
        return $controllers;
    }
}
