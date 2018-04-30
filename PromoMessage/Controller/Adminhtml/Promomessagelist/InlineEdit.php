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

class InlineEdit extends \Devpoonia\PromoMessage\Controller\Adminhtml\Promomessagelist
{
    /**
     * Core registry
     * 
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * Promo Message List repository
     * 
     * @var \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface
     */
    protected $promomessagelistRepository;

    /**
     * Page factory
     * 
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Date filter
     * 
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $dateFilter;

    /**
     * Data object processor
     * 
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * Data object helper
     * 
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * JSON Factory
     * 
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * Promo Message List resource model
     * 
     * @var \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist
     */
    protected $promomessagelistResourceModel;

    /**
     * constructor
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
     * @param \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor
     * @param \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist $promomessagelistResourceModel
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter,
        \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist $promomessagelistResourceModel
    ) {
        $this->dataObjectProcessor           = $dataObjectProcessor;
        $this->dataObjectHelper              = $dataObjectHelper;
        $this->jsonFactory                   = $jsonFactory;
        $this->promomessagelistResourceModel = $promomessagelistResourceModel;
        parent::__construct($context, $coreRegistry, $promomessagelistRepository, $resultPageFactory, $dateFilter);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($postItems) as $promomessagelistId) {
            /** @var \Devpoonia\PromoMessage\Model\Promomessagelist|\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist */
            $promomessagelist = $this->promomessagelistRepository->getById((int)$promomessagelistId);
            try {
                $promomessagelistData = $postItems[$promomessagelistId];
                $promomessagelistData = $this->filterData($promomessagelistData);
                $this->dataObjectHelper->populateWithArray($promomessagelist, $promomessagelistData, \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::class);
                $this->promomessagelistResourceModel->saveAttribute($promomessagelist, array_keys($promomessagelistData));
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithPromomessagelistId($promomessagelist, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithPromomessagelistId($promomessagelist, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithPromomessagelistId(
                    $promomessagelist,
                    __('Something went wrong while saving the Promo&#x20;Message&#x20;List.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add Promo&#x20;Message&#x20;List id to error message
     *
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithPromomessagelistId(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist, $errorText)
    {
        return '[Promo&#x20;Message&#x20;List ID: ' . $promomessagelist->getId() . '] ' . $errorText;
    }
}
