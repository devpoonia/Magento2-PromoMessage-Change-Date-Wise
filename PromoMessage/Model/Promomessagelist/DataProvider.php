<?php
/**
 * Devpoonia_PromoMessage extension
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category  Devpoonia
 * @package   Devpoonia_PromoMessage
 * @copyright Copyright (c) 2018
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
namespace Devpoonia\PromoMessage\Model\Promomessagelist;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * Loaded data cache
     * 
     * @var array
     */
    protected $loadedData;

    /**
     * Data persistor
     * 
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * constructor
     * 
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\CollectionFactory $collectionFactory
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\CollectionFactory $collectionFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Devpoonia\PromoMessage\Model\Promomessagelist $promomessagelist */
        foreach ($items as $promomessagelist) {
            $this->loadedData[$promomessagelist->getId()] = $promomessagelist->getData();

        }
        $data = $this->dataPersistor->get('devpoonia_promomessage_promomessagelist');
        if (!empty($data)) {
            $promomessagelist = $this->collection->getNewEmptyItem();
            $promomessagelist->setData($data);
            $this->loadedData[$promomessagelist->getId()] = $promomessagelist->getData();
            $this->dataPersistor->clear('devpoonia_promomessage_promomessagelist');
        }
        return $this->loadedData;
    }
}
