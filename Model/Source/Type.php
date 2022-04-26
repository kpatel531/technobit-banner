<?php

namespace Technobit\Banner\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Type
 */
class Type extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    /**#@+
     * Type values
     */
    const TYPE_IMAGE = 'image';

    const TYPE_HTML = 'html';

    /**#@-*/

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [self::TYPE_IMAGE => __('Image'), self::TYPE_HTML => __('Html')];
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }
}
