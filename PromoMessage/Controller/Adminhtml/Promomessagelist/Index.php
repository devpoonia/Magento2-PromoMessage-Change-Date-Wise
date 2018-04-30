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

class Index extends \Devpoonia\PromoMessage\Controller\Adminhtml\Promomessagelist
{
    /**
     * Promo Message Lists list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Devpoonia_PromoMessage::promomessagelist');
        $resultPage->getConfig()->getTitle()->prepend(__('Promo&#x20;Message&#x20;Lists'));
        $resultPage->addBreadcrumb(__('Promo Message'), __('Promo Message'));
        $resultPage->addBreadcrumb(__('Promo&#x20;Message&#x20;Lists'), __('Promo&#x20;Message&#x20;Lists'));
        return $resultPage;
    }
}
