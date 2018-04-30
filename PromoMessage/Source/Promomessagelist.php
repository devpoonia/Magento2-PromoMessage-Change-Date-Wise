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
namespace Devpoonia\PromoMessage\Source;

class Promomessagelist implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Promo Message List repository
     * 
     * @var \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface
     */
    protected $promomessagelistRepository;

    /**
     * Search Criteria Builder
     * 
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * Filter Builder
     * 
     * @var \Magento\Framework\Api\FilterBuilder
     */
    protected $filterBuilder;

    /**
     * Options
     * 
     * @var array
     */
    protected $options;

    /**
     * constructor
     * 
     * @param \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder
     */
    public function __construct(
        \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder
    ) {
        $this->promomessagelistRepository = $promomessagelistRepository;
        $this->searchCriteriaBuilder      = $searchCriteriaBuilder;
        $this->filterBuilder              = $filterBuilder;
    }

    /**
     * Retrieve all Promo Message Lists as an option array
     *
     * @return array
     * @throws StateException
     */
    public function getAllOptions()
    {
        if (empty($this->options)) {
            $options = [];
            $searchCriteria = $this->searchCriteriaBuilder->create();
            $searchResults = $this->promomessagelistRepository->getList($searchCriteria);
            foreach ($searchResults->getItems() as $promomessagelist) {
                $options[] = [
                    'value' => $promomessagelist->getPromomessagelistId(),
                    'label' => $promomessagelist->getName(),
                ];
            }
            $this->options = $options;
        }

        return $this->options;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return $this->getAllOptions();
    }
}
