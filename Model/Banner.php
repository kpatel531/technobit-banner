<?php

namespace Technobit\Banner\Model;

use Magento\Framework\Model\AbstractModel;
use Technobit\Banner\Api\Data\BannerInterface;

/**
 * Class Banner
 * @package Technobit\Banner\Model
 */
class Banner extends AbstractModel implements BannerInterface
{
    /**
     * model event prefix
     * @var string
     */
    protected $_eventPrefix = 'technobit_banner';

    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * Banner constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param ImageUploader $imageUploader
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        \Technobit\Banner\Model\ImageUploader $imageUploader,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->imageUploader = $imageUploader;
    }

    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(\Technobit\Banner\Model\ResourceModel\Banner::class);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return BannerInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return BannerInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set image
     *
     * @param string $image
     * @return BannerInterface
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set sort order
     *
     * @param int $sortOrder
     * @return BannerInterface
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }

    /**
     * Set status
     *
     * @param bool|int $status
     * @return BannerInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set created time
     *
     * @param string $createdAt
     * @return BannerInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Set updated time
     *
     * @param string $updatedAt
     * @return BannerInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Get image
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Get sort order
     *
     * @return int|null
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

    /**
     * Get status
     *
     * @return bool|null
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Get image url
     * @return string
     */
    public function getImageUrl() {

        return $this->getImageUploader()->getImageUrl($this->getImage());
    }

    /**
     * @return ImageUploader
     */
    public function getImageUploader() {

        return $this->imageUploader;
    }
}
