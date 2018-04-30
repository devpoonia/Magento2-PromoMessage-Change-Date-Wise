<?php

namespace Devpoonia\PromoMessage\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

class PromoMessageWidget extends Template implements BlockInterface
{

    protected $_template = "widget/promomessagewidget.phtml";
    protected $_storeManager;

    public function __construct(
    		Context $context, 
			\Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\CollectionFactory $collectionFactory,
    		StoreManagerInterface $storeManager
    	)
    {
 
        $this->_storeManager = $storeManager;
        parent::__construct($context);
		$this->collection = $collectionFactory;
    }
	
    public function getPromoMessageByDate()
    {
		$now = new \DateTime();
        $promomessage = $this->collection->create()
        ->addFieldToFilter('datefrom', ['lteq' => $now->format('Y-m-d H:i:s')])
        ->addFieldToFilter('dateto', ['gteq' => $now->format('Y-m-d H:i:s')]);
        return $promomessage;
    }
}