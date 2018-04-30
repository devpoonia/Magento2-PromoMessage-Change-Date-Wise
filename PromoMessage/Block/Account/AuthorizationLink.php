<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Devpoonia\PromoMessage\Block\Account;

class AuthorizationLink extends \Magento\Customer\Block\Account\AuthorizationLink
{
    
    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->isLoggedIn() ? __('Logout') : __('Login');
    }
}