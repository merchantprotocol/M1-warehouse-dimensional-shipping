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

trait MP_DimensionalShipping_Trait
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
     * @return MP_DimensionalShipping_Helper_Data
     */
    public function helper()
    {
        return Mage::helper('mp_dimensionalshipping');
    }
}
