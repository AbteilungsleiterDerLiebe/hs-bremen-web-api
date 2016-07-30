<?php

namespace HsBremen\WebApi\Assetpool;

use Doctrine\DBAL\Connection;
use HsBremen\WebApi\Database\DatabaseException;
use HsBremen\WebApi\Entity\Asset;
use HsBremen\WebApi\Entity\Tag;


class AssetpoolRepository
{
    /** @var  Connection */
    private $connection;

    /**
     * AssetRepository constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function createTable()
    {
        $sql = <<<EOS
CREATE TABLE IF NOT EXISTS `{$this->getAssetTable()}` (
    assetid INT NOT NULL AUTO_INCREMENT,
    assetname VARCHAR(30) NOT NULL,
    PRIMARY KEY (assetid)
)
EOS;

        return $this->connection->exec($sql);
    }

    public function getAssetTable()
    {
        return 'assetpool';
    }

    public function getTagTable()
    {
        return 'tags';
    }

    public function createAsset($assetname, $path){
      //  $this->debug_to_console($assetname);
        /*
        <<<EOS
INSERT INTO `{$this->getTableName()}` (assetname, path)
VALUES ('assetname', 'path');
EOS;
        */
        $sql = <<<EOS
INSERT INTO `{$this->getAssetTable()}` (assetname, path)
VALUES ('${assetname}', '${path}');
EOS;
        return $this->connection->exec($sql);
    }


    function debug_to_console( $data ) {

        if ( is_array( $data ) )
            $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
        else
            $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

        echo $output;
    }

    public function getById($assetid)
    {
        $sql = <<<EOS
SELECT o.* 
FROM `{$this->getAssetTable()}` o
WHERE o.assetid = :assetid
EOS;

        $assets = $this->connection->fetchAll($sql, ['assetid' => $assetid]);
        if (count($assets) === 0) {
            throw new DatabaseException(
              sprintf('Asset with id "%d" not exists!', $assetid)
            );
        }

        return Asset::createFromArray($assets[0]);
    }

    public function getAll()
    {
        $sql = <<<EOS
SELECT o.* 
FROM `{$this->getAssetTable()}` o
EOS;

        $assets = $this->connection->fetchAll($sql);

        $result = [];

        foreach ($assets as $row) {
            $result[] = Asset::createFromArray($row);
        }

        return $result;
    }

    public function getAllTags()
    {
        $sql = <<<EOS
SELECT o.*
FROM `{$this->getTagTable()}` o
EOS;

        $tags = $this->connection->fetchAll($sql);

        $result = [];

        foreach ($tags as $row) {
            $result[] = Tag::createFromArray($row);
        }

        return $result;
    }

    public function getAssetsByTag($tagId)
    {
        $sql = <<<EOS
SELECT o.tag_id, o.assetid, a.assetname, a.path  from asset_tags o join assetpool a WHERE o.assetid = a.assetid and o.tag_id = {$tagId};
EOS;

        $assets = $this->connection->fetchAll($sql);

        $result = [];

        foreach ($assets as $row) {
            $result[] = Asset::createFromArray($row);
        }

        return $result;
    }

    public function save(Asset $asset)
    {
        $data = $asset->jsonSerialize();
        unset($data['assetid']);

        $this->connection->insert($this->getAssetTable(), $data);
        $asset->setassetId($this->connection->lastInsertId());
    }
}
