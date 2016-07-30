<?php

namespace HsBremen\WebApi\Entity;

use Swagger\Annotations as SWG;

/**
 * Class Tag.php
 *
 * @package HsBremen\WebApi\Entity
 * @SWG\Definition(
 *     definition="Tag.php",
 *     type="object"
 * )
 */
class Tag implements \JsonSerializable
{
    private $tag_id;
    private $tag_title;

    public function __construct($id = null)
    {
        $this->tag_id = $id;
    }

    public static function createFromArray(array $row)
    {
        $Tag = new self();
        if (array_key_exists('tag_id', $row)) {
            $Tag->setTagId($row['tag_id']);
            if(array_key_exists('tag_title', $row)){
                $Tag->setTagTitle($row['tag_title']);
            }
        }

        return $Tag;
    }

    public function jsonSerialize()
    {
        return [
            'tag_id'     => $this->tag_id,
            'tag_title' => $this->tag_title
        ];
    }

    /**
     * @return null
     */
    public function getTagId()
    {
        return $this->tag_id;
    }

    /**
     * @param null $tag_id
     */
    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;
    }

    /**
     * @return mixed
     */
    public function getTagTitle()
    {
        return $this->tag_title;
    }

    /**
     * @param mixed $tag_title
     */
    public function setTagTitle($tag_title)
    {
        $this->tag_title = $tag_title;
    }
}
?>
