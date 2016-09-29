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

trait Innoexts_DimensionalShipping_Trait
{
    /**
     * Check if modules is enable
     *
     * @param array $moduleNames
     * @return bool
     */
    public function isModulesEnabled(array $moduleNames)
    {
        if (count($moduleNames) === 0) {
            return false;
        }

        foreach ($moduleNames as $moduleName) {
            $isEnabled = $this->helper()->isModuleEnabled($moduleName);

            if (!$isEnabled) {
                return false;
            }
        }

        return true;
    }

    /**
     * Return data helper object
     *
     * @return Innoexts_DimensionalShipping_Helper_Data
     */
    public function helper()
    {
        return Mage::helper('innoexts_dimensionalshipping');
    }
}
