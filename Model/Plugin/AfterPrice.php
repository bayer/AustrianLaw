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
namespace bayer\AustrianLaw\Model\Plugin;

/**
 * Class AfterPrice
 * @package bayer\AustrianLaw\Model\Plugin
 */
class AfterPrice
{
    /**
     * @var \Magento\Framework\View\LayoutInterface
     */
    protected $_layout;

    /**
     * @var null|string
     */
    protected $_afterPriceHtml = null;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\LayoutInterface $layout
     */
    public function __construct(
        \Magento\Framework\View\LayoutInterface $layout
    ){
        $this->_layout = $layout;
    }

    /**
     * Plugin for price rendering in order to display after price information
     *
     * @param \Magento\Framework\Pricing\Render $subject
     * @param $renderHtml
     * @return string
     */
    public function afterRender(\Magento\Framework\Pricing\Render $subject, $renderHtml)
    {
        // check if html is empty
        if ($renderHtml == '' || str_replace("\n", "", $renderHtml) == '') {
            return $renderHtml;
        }

        return $renderHtml . $this->_getAfterPriceHtml();
    }

    /**
     * Renders and caches the after price html
     *
     * @return null|string
     */
    protected function _getAfterPriceHtml()
    {
        if (is_null($this->_afterPriceHtml)) {
            $afterPriceBlock = $this->_layout->createBlock('bayer\AustrianLaw\Block\AfterPrice', 'after_price');
            $afterPriceBlock->setTemplate('bayer_AustrianLaw::price/after.phtml');
            $this->_afterPriceHtml = $afterPriceBlock->toHtml();
        }

        return $this->_afterPriceHtml;
    }
}
