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

/**
 * @method \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist _getResource()
 * @method \Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist getResource()
 */
class Promomessagelist extends \Magento\Framework\Model\AbstractModel implements \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface
{
    /**
     * Cache tag
     * 
     * @var string
     */
    const CACHE_TAG = 'devpoonia_promomessage_promomessagelist';

    /**
     * Cache tag
     * 
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Event prefix
     * 
     * @var string
     */
    protected $_eventPrefix = 'devpoonia_promomessage_promomessagelist';

    /**
     * Event object
     * 
     * @var string
     */
    protected $_eventObject = 'promomessagelist';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Devpoonia\PromoMessage\Model\ResourceModel\Promomessagelist::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get Promo Message List id
     *
     * @return array
     */
    public function getPromomessagelistId()
    {
        return $this->getData(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::PROMOMESSAGELIST_ID);
    }

    /**
     * set Promo Message List id
     *
     * @param int $promomessagelistId
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface
     */
    public function setPromomessagelistId($promomessagelistId)
    {
        return $this->setData(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::PROMOMESSAGELIST_ID, $promomessagelistId);
    }

    /**
     * set Promo Message Name
     *
     * @param mixed $name
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface
     */
    public function setName($name)
    {
        return $this->setData(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::NAME, $name);
    }

    /**
     * get Promo Message Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::NAME);
    }

    /**
     * set Promo Message
     *
     * @param mixed $promomessage
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface
     */
    public function setPromomessage($promomessage)
    {
        return $this->setData(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::PROMOMESSAGE, $promomessage);
    }

    /**
     * get Promo Message
     *
     * @return string
     */
    public function getPromomessage()
    {
        return $this->getData(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::PROMOMESSAGE);
    }

    /**
     * set Date From
     *
     * @param mixed $datefrom
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface
     */
    public function setDatefrom($datefrom)
    {
        return $this->setData(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::DATEFROM, $datefrom);
    }

    /**
     * get Date From
     *
     * @return string
     */
    public function getDatefrom()
    {
        return $this->getData(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::DATEFROM);
    }

    /**
     * set Date To
     *
     * @param mixed $dateto
     * @return \Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface
     */
    public function setDateto($dateto)
    {
        return $this->setData(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::DATETO, $dateto);
    }

    /**
     * get Date To
     *
     * @return string
     */
    public function getDateto()
    {
        return $this->getData(\Devpoonia\PromoMessage\Api\Data\PromomessagelistInterface::DATETO);
    }
}
