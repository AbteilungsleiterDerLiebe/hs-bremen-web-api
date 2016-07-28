<?php

namespace HsBremen\WebApi\Assetpool;

use Doctrine\DBAL\Connection;
use HsBremen\WebApi\Database\DatabaseException;
use HsBremen\WebApi\Entity\Asset;


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
CREATE TABLE IF NOT EXISTS `{$this->getTableName()}` (
    assetid INT NOT NULL AUTO_INCREMENT,
    assetname VARCHAR(30) NOT NULL,
    PRIMARY KEY (assetid)
)
EOS;

        return $this->connection->exec($sql);
    }

    public function getTableName()
    {
        return 'assetpool';
    }

    public function getById($assetid)
    {
        $sql = <<<EOS
SELECT o.* 
FROM `{$this->getTableName()}` o
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
FROM `{$this->getTableName()}` o
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

        $this->connection->insert($this->getTableName(), $data);
        $asset->setassetId($this->connection->lastInsertId());
    }
}
