<?php

namespace Technobit\Banner\Block\Adminhtml\Banner\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;

/**
 * Class AbstractButton
 * @package Technobit\Banner\Block\Adminhtml\Banner\Edit\Button
 */
class AbstractButton
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * AbstractButton constructor.
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        /**
         * @var \Technobit\Banner\Model\Banner $model
         */
        $model = $this->registry->registry('current_banner');

        return $model ? $model->getId() : null;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
