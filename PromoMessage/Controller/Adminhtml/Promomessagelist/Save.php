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
namespace Devpoonia\PromoMessage\Controller\Adminhtml\Promomessagelist;

class Save extends \Devpoonia\PromoMessage\Controller\Adminhtml\Promomessagelist
{
    /**
     * Promo Message List factory
     * 
     * @var \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterfaceFactory
     */
    protected $promomessagelistFactory;

    /**
     * Data Object Processor
     * 
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * Data Object Helper
     * 
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * Data Persistor
     * 
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * constructor
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterfaceFactory $promomessagelistFactory
     * @param \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor
     * @param \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter,
        \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterfaceFactory $promomessagelistFactory,
        \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->promomessagelistFactory = $promomessagelistFactory;
        $this->dataObjectProcessor     = $dataObjectProcessor;
        $this->dataObjectHelper        = $dataObjectHelper;
        $this->dataPersistor           = $dataPersistor;
        parent::__construct($context, $coreRegistry, $promomessagelistRepository, $resultPageFactory, $dateFilter);
    }

    /**
     * run the action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        /** @var \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist */
        $promomessagelist = null;
        $postData = $this->getRequest()->getPostValue();
        $data = $postData;
        $data = $this->filterData($data);
        $id = !empty($data['promomessagelist_id']) ? $data['promomessagelist_id'] : null;
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            if ($id) {
                $promomessagelist = $this->promomessagelistRepository->getById((int)$id);
            } else {
                unset($data['promomessagelist_id']);
                $promomessagelist = $this->promomessagelistFactory->create();
            }
            $this->dataObjectHelper->populateWithArray($promomessagelist, $data, \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::class);
            $this->promomessagelistRepository->save($promomessagelist);
            $this->messageManager->addSuccessMessage(__('You saved the Promo&#x20;Message&#x20;List'));
            $this->dataPersistor->clear('devpoonia_promomessage_promomessagelist');
            if ($this->getRequest()->getParam('back')) {
                $resultRedirect->setPath('devpoonia_promomessage/promomessagelist/edit', ['promomessagelist_id' => $promomessagelist->getId()]);
            } else {
                $resultRedirect->setPath('devpoonia_promomessage/promomessagelist');
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('devpoonia_promomessage_promomessagelist', $postData);
            $resultRedirect->setPath('devpoonia_promomessage/promomessagelist/edit', ['promomessagelist_id' => $id]);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was a problem saving the Promo&#x20;Message&#x20;List'));
            $this->dataPersistor->set('devpoonia_promomessage_promomessagelist', $postData);
            $resultRedirect->setPath('devpoonia_promomessage/promomessagelist/edit', ['promomessagelist_id' => $id]);
        }
        return $resultRedirect;
    }

    /**
     * @param string $type
     * @return \Devpoonia\PromoMessage\Model\Uploader
     * @throws \Exception
     */
    protected function getUploader($type)
    {
        //return $this->uploaderPool->getUploader($type);
    }
}
