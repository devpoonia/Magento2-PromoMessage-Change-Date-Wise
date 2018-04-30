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
namespace Devpoonia\PromoMessage\Controller\Adminhtml;

abstract class Promomessagelist extends \Magento\Backend\App\Action
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
     * constructor
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
    ) {
        $this->coreRegistry               = $coreRegistry;
        $this->promomessagelistRepository = $promomessagelistRepository;
        $this->resultPageFactory          = $resultPageFactory;
        $this->dateFilter                 = $dateFilter;
        parent::__construct($context);
    }

    /**
     * filter values
     *
     * @param array $data
     * @return array
     */
    protected function filterData($data)
    {
        $inputFilter = new \Zend_Filter_Input(
            [
            ],
            [],
            $data
        );
        $data = $inputFilter->getUnescaped();
        return $data;
    }
}
