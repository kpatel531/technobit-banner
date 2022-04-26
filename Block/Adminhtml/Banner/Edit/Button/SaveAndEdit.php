<?php

namespace Technobit\Banner\Block\Adminhtml\Banner\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveAndEdit
 * @package Technobit\Banner\Block\Adminhtml\Banner\Edit\Button
 */
class SaveAndEdit extends AbstractButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save and Continue Edit'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 80,
        ];
    }
}
