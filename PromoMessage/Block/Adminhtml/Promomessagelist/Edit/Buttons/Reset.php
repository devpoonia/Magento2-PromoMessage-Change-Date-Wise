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
namespace Devpoonia\PromoMessage\Block\Adminhtml\Promomessagelist\Edit\Buttons;

class Reset extends \Devpoonia\PromoMessage\Block\Adminhtml\Promomessagelist\Edit\Buttons\Generic implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    /**
     * get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Reset'),
            'class' => 'reset',
            'on_click' => 'location.reload();',
            'sort_order' => 30
        ];
    }
}