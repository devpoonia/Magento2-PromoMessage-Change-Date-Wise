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
namespace Devpoonia\PromoMessage\Model;

class PromomessagelistRepository implements \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface
{
    /**
     * Cached instances
     * 
     * @var array
     */
    protected $instances = [];

    /**
     * Promo Message List resource model
     * 
     * @var \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist
     */
    protected $resource;

    /**
     * Promo Message List collection factory
     * 
     * @var \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\CollectionFactory
     */
    protected $promomessagelistCollectionFactory;

    /**
     * Promo Message List interface factory
     * 
     * @var \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterfaceFactory
     */
    protected $promomessagelistInterfaceFactory;

    /**
     * Data Object Helper
     * 
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * Search result factory
     * 
     * @var \Devpoonia\PromoMessage\Api\Data\PromomessagelistSearchResultInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * constructor
     * 
     * @param \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist $resource
     * @param \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\CollectionFactory $promomessagelistCollectionFactory
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterfaceFactory $promomessagelistInterfaceFactory
     * @param \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistSearchResultInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist $resource,
        \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\CollectionFactory $promomessagelistCollectionFactory,
        \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterfaceFactory $promomessagelistInterfaceFactory,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \Devpoonia\PromoMessage\Api\Data\PromomessagelistSearchResultInterfaceFactory $searchResultsFactory
    ) {
        $this->resource                          = $resource;
        $this->promomessagelistCollectionFactory = $promomessagelistCollectionFactory;
        $this->promomessagelistInterfaceFactory  = $promomessagelistInterfaceFactory;
        $this->dataObjectHelper                  = $dataObjectHelper;
        $this->searchResultsFactory              = $searchResultsFactory;
    }

    /**
     * Save Promo Message List.
     *
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist)
    {
        /** @var \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface|\Magento\Framework\Model\AbstractModel $promomessagelist */
        try {
            $this->resource->save($promomessagelist);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__(
                'Could not save the Promo&#x20;Message&#x20;List: %1',
                $exception->getMessage()
            ));
        }
        return $promomessagelist;
    }

    /**
     * Retrieve Promo Message List.
     *
     * @param int $promomessagelistId
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($promomessagelistId)
    {
        if (!isset($this->instances[$promomessagelistId])) {
            /** @var \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface|\Magento\Framework\Model\AbstractModel $promomessagelist */
            $promomessagelist = $this->promomessagelistInterfaceFactory->create();
            $this->resource->load($promomessagelist, $promomessagelistId);
            if (!$promomessagelist->getId()) {
                throw new \Magento\Framework\Exception\NoSuchEntityException(__('Requested Promo&#x20;Message&#x20;List doesn\'t exist'));
            }
            $this->instances[$promomessagelistId] = $promomessagelist;
        }
        return $this->instances[$promomessagelistId];
    }

    /**
     * Retrieve Promo Message Lists matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistSearchResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Devpoonia\PromoMessage\Api\Data\PromomessagelistSearchResultInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        /** @var \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\Collection $collection */
        $collection = $this->promomessagelistCollectionFactory->create();

        //Add filters from root filter group to the collection
        /** @var \Magento\Framework\Api\Search\FilterGroup $group */
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
        $sortOrders = $searchCriteria->getSortOrders();
        /** @var \Magento\Framework\Api\SortOrder $sortOrder */
        if ($sortOrders) {
            foreach ($searchCriteria->getSortOrders() as $sortOrder) {
                $field = $sortOrder->getField();
                $collection->addOrder(
                    $field,
                    ($sortOrder->getDirection() == \Magento\Framework\Api\SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        } else {
            // set a default sorting order since this method is used constantly in many
            // different blocks
            $field = 'promomessagelist_id';
            $collection->addOrder($field, 'ASC');
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        /** @var \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface[] $promomessagelists */
        $promomessagelists = [];
        /** @var \Devpoonia\PromoMessage\Model\Promomessagelist $promomessagelist */
        foreach ($collection as $promomessagelist) {
            /** @var \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelistDataObject */
            $promomessagelistDataObject = $this->promomessagelistInterfaceFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $promomessagelistDataObject,
                $promomessagelist->getData(),
                \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::class
            );
            $promomessagelists[] = $promomessagelistDataObject;
        }
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults->setItems($promomessagelists);
    }

    /**
     * Delete Promo Message List.
     *
     * @param \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface $promomessagelist)
    {
        /** @var \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface|\Magento\Framework\Model\AbstractModel $promomessagelist */
        $id = $promomessagelist->getId();
        try {
            unset($this->instances[$id]);
            $this->resource->delete($promomessagelist);
        } catch (\Magento\Framework\Exception\ValidatorException $e) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\StateException(
                __('Unable to remove Promo&#x20;Message&#x20;List %1', $id)
            );
        }
        unset($this->instances[$id]);
        return true;
    }

    /**
     * Delete Promo Message List by ID.
     *
     * @param int $promomessagelistId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($promomessagelistId)
    {
        $promomessagelist = $this->getById($promomessagelistId);
        return $this->delete($promomessagelist);
    }

    /**
     * Helper function that adds a FilterGroup to the collection.
     *
     * @param \Magento\Framework\Api\Search\FilterGroup $filterGroup
     * @param \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\Collection $collection
     * @return $this
     * @throws \Magento\Framework\Exception\InputException
     */
    protected function addFilterGroupToCollection(
        \Magento\Framework\Api\Search\FilterGroup $filterGroup,
        \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist\Collection $collection
    ) {
        $fields = [];
        $conditions = [];
        foreach ($filterGroup->getFilters() as $filter) {
            $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
            $fields[] = $filter->getField();
            $conditions[] = [$condition => $filter->getValue()];
        }
        if ($fields) {
            $collection->addFieldToFilter($fields, $conditions);
        }
        return $this;
    }
}
