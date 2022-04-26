<?php

namespace Technobit\Banner\Ui\Component\Listing\Column;

/**
 * Class Store
 */
class Store extends \Magento\Store\Ui\Component\Listing\Column\Store
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = $this->prepareValue($item);
                $item[$this->getData('name')] = $this->prepareItem($item);
            }
        }

        return $dataSource;
    }

    /**
     * Prepare value
     * @param $item
     * @return array
     */
    protected function prepareValue($item)
    {
        $value = isset($item[$this->getData('name')]) ? $item[$this->getData('name')] : [];

        if(!is_array($value)) {

            $value = explode(',', $value);
        }

        return $value;
    }
}
