<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

/**
 * @category   bayer
 * @package    bayer_AustrianLaw
 * @subpackage Module
 * @copyright  Copyright (c) 2017 Daniel Reichhard
 * @author     Florian Sydekum <f.sydekum@techdivision.com>
 * @author     Daniel Reichhard <daniel.reichhard@gmail.com>
 */
namespace bayer\AustrianLaw\Block;

/**
 * Function to mock the Magento __() function for this namespace
 *
 * @param string $text The text to return
 * @return string
 */
function __($text) {
    return $text;
}
