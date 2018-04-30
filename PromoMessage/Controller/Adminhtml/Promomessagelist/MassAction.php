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

abstract class MassAction extends \Magento\Backend\App\Action
{
    /**
     * Promo Message List repository
     * 
     * @var \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface
     */
    protected $promomessagelistRepository;

    /**
     * Mass Action filter
     * 
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $filter;

    /**
     * Promo Message List collection factory
     * 
     * @var \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Action success message
     * 
     * @var string
     */
    protected $successMessage;

    /**
     * Action error message
     * 
     * @var string
     */
    protected $errorMessage;

    /**
     * constructor
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\CollectionFactory $collectionFactory
     * @param string $successMessage
     * @param string $errorMessage
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\CollectionFactory $collectionFactory,
        $successMessage,
        $errorMessage
    ) {
        $this->promomessagelistRepository = $promomessagelistRepository;
        $this->filter                     = $filter;
        $this->collectionFactory          = $collectionFactory;
        $this->successMessage             = $successMessage;
        $this->errorMessage               = $errorMessage;
        parent::__construct($context);
    }

    /**
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist
     * @return mixed
     */
    abstract protected function massAction(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist);

    /**
     * execute action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection as $promomessagelist) {
                $this->massAction($promomessagelist);
            }
            $this->messageManager->addSuccessMessage(__($this->successMessage, $collectionSize));
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, $this->errorMessage);
        }
        $redirectResult = $this->resultRedirectFactory->create();
        $redirectResult->setPath('devpoonia_promomessage/*/index');
        return $redirectResult;
    }
}
