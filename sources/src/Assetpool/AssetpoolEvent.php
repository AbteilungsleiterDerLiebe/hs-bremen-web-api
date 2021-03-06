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
    const CREATE_ASSET = 'asset.create_asset';
    const CREATE_ASSETPOST = 'asset.create_assetpost';
    const GET_ASSETS_BY_TAG = 'asset.get_asset_by_tag';

    /** @var  Asset */
    private $asset;

    /** @var  int */
    private $assetId;
    private $assetName;
    private $path;
    private $tagId;
    private $assetArray;

    /**
     * @return mixed
     */
    public function getAssetArray()
    {
        return $this->assetArray;
    }

    /**
     * @param mixed $assetArray
     */
    public function setAssetArray($assetArray)
    {
        $this->assetArray = $assetArray;
    }

    /**
     * @return mixed
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * @param mixed $tagId
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;
    }

    /**
     * @return mixed
     */
    public function getAssetName()
    {
        return $this->assetName;
    }

    /**
     * @param mixed $assetName
     */
    public function setAssetName($assetName)
    {
        $this->assetName = $assetName;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

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
