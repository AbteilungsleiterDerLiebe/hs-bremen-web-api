<?php

namespace HsBremen\WebApi\Entity;

use Swagger\Annotations as SWG;

/**
 * Class Asset
 *
 * @package HsBremen\WebApi\Entity
 * @SWG\Definition(
 *     definition="Asset",
 *     type="object"
 * )
 */
class Asset implements \JsonSerializable
{

    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $assetid;
    private $path = "path is not set";
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
     * @var string
     * @SWG\Property(type="string")
     */
    private $assetname = 'placed';

    public function __construct($id = null)
    {
        $this->assetid = $id;
    }

    public static function createFromArray(array $row)
    {
        $Asset = new self();
        if (array_key_exists('assetid', $row)) {
            $Asset->setAssetid($row['assetid']);
            $Asset->setPath($row['path']);
            $Asset->setAssetname($row['assetname']);
        }
        return $Asset;
    }

    /**
     * @return int
     */
    public function getAssetid()
    {
        return $this->assetid;
    }

    public function setAssetid($assetid)
    {
        $this->assetid = $assetid;
    }

    public function jsonSerialize()
    {
        return [
            'assetid'     => $this->assetid,
            'assetname' => $this->assetname,
            'path' => $this->path
        ];
    }

    /**
     * @return string
     */
    public function getAssetname()
    {
        return $this->assetname;
    }

    /**
     * @param string $assetname
     */
    public function setAssetname($assetname)
    {
        $this->assetname = $assetname;
    }
}
?>
