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
interface PromomessagelistInterface
{
    /**
     * ID
     * 
     * @var string
     */
    const PROMOMESSAGELIST_ID = 'promomessagelist_id';

    /**
     * Promo Message Name attribute constant
     * 
     * @var string
     */
    const NAME = 'name';

    /**
     * Promo Message attribute constant
     * 
     * @var string
     */
    const PROMOMESSAGE = 'promomessage';

    /**
     * Date From attribute constant
     * 
     * @var string
     */
    const DATEFROM = 'datefrom';

    /**
     * Date To attribute constant
     * 
     * @var string
     */
    const DATETO = 'dateto';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getPromomessagelistId();

    /**
     * Set ID
     *
     * @param int $promomessagelistId
     * @return PromomessagelistInterface
     */
    public function setPromomessagelistId($promomessagelistId);

    /**
     * Get Promo Message Name
     *
     * @return mixed
     */
    public function getName();

    /**
     * Set Promo Message Name
     *
     * @param mixed $name
     * @return PromomessagelistInterface
     */
    public function setName($name);

    /**
     * Get Promo Message
     *
     * @return mixed
     */
    public function getPromomessage();

    /**
     * Set Promo Message
     *
     * @param mixed $promomessage
     * @return PromomessagelistInterface
     */
    public function setPromomessage($promomessage);

    /**
     * Get Date From
     *
     * @return mixed
     */
    public function getDatefrom();

    /**
     * Set Date From
     *
     * @param mixed $datefrom
     * @return PromomessagelistInterface
     */
    public function setDatefrom($datefrom);

    /**
     * Get Date To
     *
     * @return mixed
     */
    public function getDateto();

    /**
     * Set Date To
     *
     * @param mixed $dateto
     * @return PromomessagelistInterface
     */
    public function setDateto($dateto);
}