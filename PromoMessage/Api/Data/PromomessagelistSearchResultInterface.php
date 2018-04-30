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
namespace Devpoonia\PromoMessage\Api\Data;

/**
 * @api
 */
interface PromomessagelistSearchResultInterface
{
    /**
     * Get Promo Message Lists list.
     *
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface[]
     */
    public function getItems();

    /**
     * Set Promo Message Lists list.
     *
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}