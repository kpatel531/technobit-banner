<?php

namespace Technobit\Banner\Ui\Banner;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Technobit\Banner\Model\Banner;
use Technobit\Banner\Model\ResourceModel\Banner\Collection;
use Technobit\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 * @package Technobit\Banner\Ui\Banner
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $formData;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->dataPersistor = $dataPersistor;

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if(!isset($this->formData)) {

            /** @var Collection $collection */
            $collection = $this->collectionFactory->create();

            /** @var \Technobit\Banner\Model\Banner $model */
            foreach ($collection->getItems() as $model) {
                $this->formData[$model->getId()] = $this->getRowData($model);
            }

            $data = $this->dataPersistor->get('Technobit_banner');
            if (!empty($data)) {
                $model = $collection->getNewEmptyItem();
                $model->setData($data);
                $this->formData[$model->getId()] = $this->getRowData($model);
                $this->dataPersistor->clear('technobit_banner');
            }
        }
        return $this->formData;
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collectionFactory->create();
    }

    /**
     * @param Banner $model
     * @return array
     */
    public function getRowData(Banner $model)
    {
        $data = $model->getData();

        $imageData = [];

        if($model->getImage()) {

            $imageData = [
                [   'name' => $model->getImage(),
                    'url' => $model->getImageUrl(),
                ]
            ];
        }

        $data['image'] = $imageData;

        return $data;
    }
}
