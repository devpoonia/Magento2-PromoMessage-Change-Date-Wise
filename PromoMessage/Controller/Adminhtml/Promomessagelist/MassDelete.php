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

class MassDelete extends \Devpoonia\PromoMessage\Controller\Adminhtml\Promomessagelist\MassAction
{
    /**
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist
     * @return $this
     */
    protected function massAction(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist)
    {
        $this->promomessagelistRepository->delete($promomessagelist);
        return $this;
    }
}
