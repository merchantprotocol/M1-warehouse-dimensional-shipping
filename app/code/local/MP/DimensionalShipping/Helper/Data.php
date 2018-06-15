<?php
/**
 * Mage Plugins
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mage Plugins Commercial License (MPCL 1.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://mageplugins.net/commercial-license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to mageplugins@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade to newer
 * versions in the future. If you wish to customize the extension for your
 * needs please refer to https://www.mageplugins.net for more information.
 *
 * @category   MP
 * @package    MP_DimensionalShipping
 * @copyright  Copyright (c) 2006-2018 Mage Plugins Inc. and affiliates (https://mageplugins.net/)
 * @license    https://mageplugins.net/commercial-license/  Mage Plugins Commercial License (MPCL 1.0)
 */

class MP_DimensionalShipping_Helper_Data extends Mage_Core_Helper_Abstract
{
    use MP_DimensionalShipping_Trait;

    /**
     * Checkout cart shipping template
     * Based on Warehouse module
     *
     * @const string
     */
    const CHECKOUT_CART_SHIPPING_TEMPLATE = 'dimensionalshipping/checkout/cart/shipping.phtml';

    /**
     * Check if ship USA module is enabled
     *
     * @return bool
     */
    public function hasPackageBreakdown()
    {
        if (!Mage::helper('wsacommon')->isModuleEnabled('Webshopapps_Shipusa', 'shipping/shipusa/active')) {
            return false;
        }

        if (!Mage::helper('wsalogger')->isDebugError() && !Mage::getStoreConfig('shipping/shipusa/is_demo')) {
            return false;
        }

        return true;
    }

    /**
     * Check if common freight module is enabled
     *
     * @return bool
     */
    public function hasCommonFreight()
    {
        return $this->isModulesEnabled(array(
            'Webshopapps_Wsafreightcommon',
            'Webshopapps_Estesfreight',
            'Webshopapps_Wsaupsfreight'
        ));
    }

    /**
     * Return checkout cart shipping template
     *
     * @return string
     */
    public function getShippingTemplate()
    {
        return self::CHECKOUT_CART_SHIPPING_TEMPLATE;
    }
}
