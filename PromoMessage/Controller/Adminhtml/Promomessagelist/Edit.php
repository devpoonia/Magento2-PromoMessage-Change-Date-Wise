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

class Edit extends \Devpoonia\PromoMessage\Controller\Adminhtml\Promomessagelist
{
    /**
     * Initialize current Promo Message List and set it in the registry.
     *
     * @return int
     */
    protected function initPromomessagelist()
    {
        $promomessagelistId = $this->getRequest()->getParam('promomessagelist_id');
        $this->coreRegistry->register(\Devpoonia\PromoMessage\Controller\RegistryConstants::CURRENT_PROMOMESSAGELIST_ID, $promomessagelistId);

        return $promomessagelistId;
    }

    /**
     * Edit or create Promo Message List
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $promomessagelistId = $this->initPromomessagelist();

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Devpoonia_PromoMessage::promomessage_promomessagelist');
        $resultPage->getConfig()->getTitle()->prepend(__('Promo&#x20;Message&#x20;Lists'));
        $resultPage->addBreadcrumb(__('Promo Message'), __('Promo Message'));
        $resultPage->addBreadcrumb(__('Promo&#x20;Message&#x20;Lists'), __('Promo&#x20;Message&#x20;Lists'), $this->getUrl('devpoonia_promomessage/promomessagelist'));

        if ($promomessagelistId === null) {
            $resultPage->addBreadcrumb(__('New Promo&#x20;Message&#x20;List'), __('New Promo&#x20;Message&#x20;List'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Promo&#x20;Message&#x20;List'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Promo&#x20;Message&#x20;List'), __('Edit Promo&#x20;Message&#x20;List'));
            $resultPage->getConfig()->getTitle()->prepend(
                $this->promomessagelistRepository->getById($promomessagelistId)->getName()
            );
        }
        return $resultPage;
    }
}
