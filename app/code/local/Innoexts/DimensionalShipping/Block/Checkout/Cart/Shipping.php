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

class Innoexts_DimensionalShipping_Block_Checkout_Cart_Shipping
    extends Innoexts_Warehouse_Block_Checkout_Cart_Shipping
{
    /**
     * Check if liftgate is required
     *
     * @return bool
     */
    public function getLiftgateRequired()
    {
        if (Mage::getStoreConfig('shipping/wsafreightcommon/default_liftgate', Mage::app()->getStore())
            && $this->getAddress()->getLiftgateRequired() == '') {
            return true;
        }

        return $this->getAddress()->getLiftgateRequired();
    }

    /**
     * Return shipping to type
     *
     * @return string
     */
    public function getShiptoType()
    {
        return $this->getAddress()->getShiptoType();
    }

    /**
     * Return active city (address)
     *
     * @return bool
     */
    public function getCityActive()
    {
        $active = false;

        if (!$this->dontShowCommonFreight()) {
            (bool) Mage::getStoreConfig('carriers/yrcfreight/active')
            || (bool) Mage::getStoreConfig('carriers/abffreight/active')
            || (bool) Mage::getStoreConfig('carriers/wsafedexfreight/active') ? $active = true : $active;
        }

        if (!$active) {
            if (Mage::helper('wsacommon')->isModuleEnabled(
                'Webshopapps_Upsaccesspoint',
                'carriers/upsaccesspoint/active')) {
                return true;
            }

            return parent::getCityActive();
        }

        return $active;
    }

    /**
     * Return active state (address)
     *
     * @return bool
     */
    public function getStateActive()
    {
        return true;
    }

    /**
     * Check if one of carriers require state/province
     *
     * @return bool
     */
    public function isStateProvinceRequired()
    {
        return true;
    }

    /**
     * Check if one of carriers require city
     *
     * @return bool
     */
    public function isCityRequired()
    {
        $active = false;

        (bool) Mage::getStoreConfig('carriers/yrcfreight/active')
        || (bool) Mage::getStoreConfig('carriers/abffreight/active')
        || (bool) Mage::getStoreConfig('carriers/wsafedexfreight/active') ? $active = true : $active;

        if (!$active) {
            return parent::isCityRequired();
        }

        return $active;
    }

    /**
     * Check if notify is required
     *
     * @return mixed
     */
    public function getNotifyRequired()
    {
        return $this->getAddress()->getNotifyRequired();
    }

    /**
     * Return inside delivery
     *
     * @return string
     */
    public function getInsideDelivery()
    {
        return $this->getAddress()->getInsideDelivery();
    }

    /**
     * Return shipping to options (select)
     *
     * @param null|string $defValue
     * @return string
     */
    public function getShiptoTypeHtmlSelect($defValue = null)
    {
        if (is_null($defValue)) {
            $defValue = $this->getShiptoType();
        }

        $options = Mage::helper('wsafreightcommon')->getOptions();

        $html = $this->getLayout()->createBlock('core/html_select')
            ->setName('shipto_type')
            ->setTitle(Mage::helper('wsafreightcommon')->__('Address Type'))
            ->setId('shipto_type')
            ->setClass('required-entry')
            ->setValue($defValue)
            ->setOptions($options)
            ->getHtml();

        return $html;
    }

    /**
     * Check if show common freight
     *
     * @return bool
     */
    public function dontShowCommonFreight()
    {
        return Mage::helper('wsafreightcommon')->dontShowCommonFreightForQuote(
            $this->getAddress()->getQuote(), $this->getAddress()->getWeight());
    }

    /**
     * Added in for compatibility with AddressValidator
     *
     * @param null|string $defValue
     * @return null|string
     */
    public function getDestTypeHtmlSelect($defValue = null) {

        if (Mage::helper('wsacommon')->isModuleEnabled('Webshopapps_Wsavalidation')) {
            if (is_null($defValue)) {
                $defValue = $this->getAddress()->getDestType();
            }

            return Mage::helper('wsavalidation')->getBasicDestTypeHtmlSelect($this->getLayout(), $defValue);
        }

        return null;
    }
}
