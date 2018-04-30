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
namespace Devpoonia\PromoMessage\Api;

/**
 * @api
 */
interface PromomessagelistRepositoryInterface
{
    /**
     * Save Promo Message List.
     *
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist);

    /**
     * Retrieve Promo Message List
     *
     * @param int $promomessagelistId
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($promomessagelistId);

    /**
     * Retrieve Promo Message Lists matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistSearchResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Promo Message List.
     *
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist);

    /**
     * Delete Promo Message List by ID.
     *
     * @param int $promomessagelistId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($promomessagelistId);
}