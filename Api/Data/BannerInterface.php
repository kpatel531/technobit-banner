<?php

namespace Technobit\Banner\Api\Data;

/**
 * Interface BannerInterface
 * @package Technobit\Banner\Api\Data
 */
interface BannerInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID     = 'banner_id';
    const TITLE         = 'title';
    const IMAGE         = 'image';
    const CONTENT       = 'content';
    const SORT_ORDER    = 'sort_order';
    const STATUS        = 'status';
    const CREATED_AT    = 'created_at';
    const UPDATED_AT    = 'updated_at';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get image
     *
     * @return string|null
     */
    public function getImage();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get sort order
     *
     * @return int|null
     */
    public function getSortOrder();

    /**
     * Get status
     *
     * @return bool|null
     */
    public function getStatus();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set ID
     *
     * @param int $id
     * @return BannerInterface
     */
    public function setId($id);

    /**
     * Set title
     *
     * @param string $title
     * @return BannerInterface
     */
    public function setTitle($title);

    /**
     * Set image
     *
     * @param string $image
     * @return BannerInterface
     */
    public function setImage($image);

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setContent($content);

    /**
     * Set sort order
     *
     * @param int $sortOrder
     * @return BannerInterface
     */
    public function setSortOrder($sortOrder);

    /**
     * Set status
     *
     * @param bool|int $status
     * @return BannerInterface
     */
    public function setStatus($status);

    /**
     * Set created time
     *
     * @param string $createdAt
     * @return BannerInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Set updated time
     *
     * @param string $updatedAt
     * @return BannerInterface
     */
    public function setUpdatedAt($updatedAt);
}
