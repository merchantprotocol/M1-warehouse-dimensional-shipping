<?php
/**
 * Merchant Protocol
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Merchant Protocol Commercial License (MPCL 1.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://merchantprotocol.com/commercial-license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@merchantprotocol.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade to newer
 * versions in the future. If you wish to customize the extension for your
 * needs please refer to http://www.merchantprotocol.com for more information.
 *
 * @category   MP
 * @package    MP_DimensionalShipping
 * @copyright  Copyright (c) 2006-2016 Merchant Protocol LLC. and affiliates (https://merchantprotocol.com/)
 * @license    https://merchantprotocol.com/commercial-license/  Merchant Protocol Commercial License (MPCL 1.0)
 */

class Innoexts_DimensionalShipping_Helper_Template extends Webshopapps_Wsacommon_Helper_Template
{
    /**
     * Checkout cart shipping template
     * Based on Warehouse module
     *
     * @const string
     */
    const CHECKOUT_CART_SHIPPING_TEMPLATE = 'dimensionalshipping/checkout/cart/shipping.phtml';

    /**
     * Return shipping estimate template
     * When the debug mode is active does not display the shipping methods by warehouse
     *
     * @return string
     */
    public function cartShippingEstimate()
    {
        /** @var string $template */
        $template = parent::cartShippingEstimate();

        if (Mage::helper('wsacommon')->isModuleEnabled('Webshopapps_Startrack', 'carriers/startrack/active')) {
            return $template;
        }

        return self::CHECKOUT_CART_SHIPPING_TEMPLATE;
    }
}
