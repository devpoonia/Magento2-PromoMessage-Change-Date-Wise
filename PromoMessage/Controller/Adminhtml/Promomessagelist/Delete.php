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

class Delete extends \Devpoonia\PromoMessage\Controller\Adminhtml\Promomessagelist
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('promomessagelist_id');
        if ($id) {
            try {
                $this->promomessagelistRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The Promo&#x20;Message&#x20;List has been deleted.'));
                $resultRedirect->setPath('devpoonia_promomessage/*/');
                return $resultRedirect;
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('The Promo&#x20;Message&#x20;List no longer exists.'));
                return $resultRedirect->setPath('devpoonia_promomessage/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('devpoonia_promomessage/promomessagelist/edit', ['promomessagelist_id' => $id]);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('There was a problem deleting the Promo&#x20;Message&#x20;List'));
                return $resultRedirect->setPath('devpoonia_promomessage/promomessagelist/edit', ['promomessagelist_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Promo&#x20;Message&#x20;List to delete.'));
        $resultRedirect->setPath('devpoonia_promomessage/*/');
        return $resultRedirect;
    }
}
