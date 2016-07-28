<?php

namespace HsBremen\WebApi\Assetpool;
use HsBremen\WebApi\Entity\Asset;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class OrderEvent
 *
 * @package HsBremen\WebApi\Assetpool
 */
class AssetpoolEvent extends Event
{
    const GET_DETAILS = 'asset.get_details';

    /** @var  Asset */
    private $asset;

    /** @var  int */
    private $assetId;

    /**
     * @return int
     */
    public function getAssetId()
    {
        return $this->assetId;
    }

    /**
     * @param int $assetId
     *
     * @return AssetpoolEvent
     */
    public function setAssetId($assetId)
    {
        $this->assetId = $assetId;

        return $this;
    }

    /**
     * @return \HsBremen\WebApi\Entity\Asset
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * @param \HsBremen\WebApi\Entity\Asset $asset
     */
    public function setAsset(Asset $asset)
    {
        $this->asset = $asset;
    }
}
