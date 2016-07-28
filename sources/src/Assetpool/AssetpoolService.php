<?php

namespace HsBremen\WebApi\Assetpool;

use HsBremen\WebApi\Entity\Asset;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AssetpoolService
{
    /** @var  AssetpoolRepository */
    private $assetpoolRepository;

    /** @var  EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * AssetpoolService constructor.
     *
     * @param AssetpoolRepository $assetpoolRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
      AssetpoolRepository $assetpoolRepository,
      EventDispatcherInterface $eventDispatcher
    ) {
        $this->assetpoolRepository = $assetpoolRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * GET /asset
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getList()
    {
        return new JsonResponse($this->assetpoolRepository->getAll());
    }

    /**
     * GET /asset/{assetId}
     *
     * @param $assetId
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getDetails($assetId)
    {
        $event = new AssetpoolEvent();
        $event->setAssetId($assetId);

        $this->eventDispatcher->dispatch(AssetpoolEvent::GET_DETAILS, $event);

        return new JsonResponse($event->getAsset());
    }

    /**
     * POST /asset
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createAsset(Request $request)
    {
        $postData = $request->request->all();
        unset($postData['assetid']);

        $asset = Asset::createFromArray($postData);

        $this->assetpoolRepository->save($asset);

        return new JsonResponse($asset, 201);
    }

    /**
     * PUT /asset/{assetId}
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function changeAsset(Request $request)
    {
        $asset = new Asset(1);
        $newassetId = $request->request->get('assetId', 0);
        $asset->setId($newassetId);

        return new JsonResponse($asset);
    }
}
