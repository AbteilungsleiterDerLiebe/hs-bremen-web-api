<?php

namespace HsBremen\WebApi\Assetpool;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class AssetpoolDomainEventSubscriber
 *
 * @package HsBremen\WebApi\Assetpool
 */
class AssetpoolDomainEventSubscriber implements EventSubscriberInterface
{
    /** @var  AssetpoolRepository */
    private $assetpoolRepository;

    /**
     * AssetpoolDomainEventSubscriber constructor.
     *
     * @param AssetpoolRepository $orderRepository
     */
    public function __construct(
        AssetpoolRepository $assetpoolRepository
    ) {
        $this->assetpoolRepository = $assetpoolRepository;
    }


    /** {@inheritdoc} */
    public static function getSubscribedEvents()
    {
        return [
          AssetpoolEvent::GET_DETAILS => ['getAssetDetails', 1024],
          AssetpoolEvent::CREATE_ASSET => ['createAsset', 1024]
        ];
    }

    /**
     * @param \HsBremen\WebApi\Assetpool\AssetpoolEvent $event
     *
     * @throws \HsBremen\WebApi\Database\DatabaseException
     */
    public function getAssetDetails(AssetpoolEvent $event)
    {
        $asset = $this->assetpoolRepository->getById($event->getAssetId());
        $event->setAsset($asset);
    }
    public function createAsset(AssetpoolEvent $event)
    {
        $this->assetpoolRepository->createAsset($event->getAssetName(), $event->getPath());
       // $event->setAsset($asset);
    }
}
