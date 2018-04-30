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

class Generic
{
    /**
     * Widget Context
     * 
     * @var \Magento\Backend\Block\Widget\Context
     */
    protected $context;

    /**
     * Promo Message List Repository
     * 
     * @var \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface
     */
    protected $promomessagelistRepository;

    /**
     * constructor
     * 
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Devpoonia\PromoMessage\Api\PromomessagelistRepositoryInterface $promomessagelistRepository
    ) {
        $this->context                    = $context;
        $this->promomessagelistRepository = $promomessagelistRepository;
    }

    /**
     * Return Promo Message List ID
     *
     * @return int|null
     */
    public function getPromomessagelistId()
    {
        try {
            return $this->promomessagelistRepository->getById(
                $this->context->getRequest()->getParam('promomessagelist_id')
            )->getId();
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}