<?php

declare(strict_types=1);

namespace Ps\Faq\Model\Faq;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Ps\Faq\Model\ResourceModel\Faq\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /** @var DataPersistorInterface */
    protected $dataPersistor;

    /** @var array */
    protected $loadedData;
    
    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
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
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getFaqId()] = $model->getData();
        }
        $data = $this->dataPersistor->get('faq');
        
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getFaqId()] = $model->getData();
            $this->dataPersistor->clear('faq');
        }
        
        return $this->loadedData;
    }
}
