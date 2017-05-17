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
 * @package    Bayer_AustrianLaw
 * @subpackage Module
 * @copyright  Copyright (c) 2017 Daniel Reichhard
 * @author     Florian Sydekum <f.sydekum@techdivision.com>
 * @author     Daniel Reichhard <daniel.reichhard@gmail.com>
 */
namespace bayer\AustrianLaw\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\CheckoutAgreements\Api\Data\AgreementInterface;

/**
 * Class UpgradeData
 * @package bayer\AustrianLaw\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \Magento\CheckoutAgreements\Api\CheckoutAgreementsRepositoryInterface
     */
    private $repositoryInterface;

    /**
     * @var \Magento\CheckoutAgreements\Api\Data\AgreementInterface
     */
    private $agreement;

    /**
     * @var CmsInstaller
     */
    private $cmsInstaller;

    /**
     * @var \Magento\Framework\Setup\SampleData\Executor
     */
    private $executor;

    /**
     * @var \Magento\Framework\App\Config\ConfigResource\ConfigInterface
     */
    protected $configInterface;

    /**
     * Constructor.
     *
     * @param \Magento\CheckoutAgreements\Api\CheckoutAgreementsRepositoryInterface $repositoryInterface
     * @param \Magento\CheckoutAgreements\Api\Data\AgreementInterface $agreement
     * @param \bayer\AustrianLaw\Setup\CmsInstaller $cmsInstaller
     * @param \Magento\Framework\Setup\SampleData\Executor $executor
     */
    public function __construct(
        \Magento\CheckoutAgreements\Api\CheckoutAgreementsRepositoryInterface $repositoryInterface,
        \Magento\CheckoutAgreements\Api\Data\AgreementInterface $agreement,
        \bayer\AustrianLaw\Setup\CmsInstaller $cmsInstaller,
        \Magento\Framework\Setup\SampleData\Executor $executor,
        \Magento\Framework\App\Config\ConfigResource\ConfigInterface $configInterface
    ){
        $this->repositoryInterface = $repositoryInterface;
        $this->agreement = $agreement;
        $this->cmsInstaller = $cmsInstaller;
        $this->executor = $executor;
        $this->configInterface = $configInterface;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.3') < 0) {
            $this->agreement
                ->setName('AGB')
                ->setContent('Hier könnte Ihre AGB stehen')
                ->setCheckboxText('Hier könnte Ihre AGB stehen')
                ->setIsActive(1)
                ->setMode(1);

            $this->repositoryInterface->save($this->agreement, 0);

            $this->executor->exec($this->cmsInstaller);
        }

        if (version_compare($context->getVersion(), '1.0.4') < 0) {
            // Enable Cookie Restriction Mode
            $this->configInterface->saveConfig('web/cookie/cookie_restriction', 1, ScopeConfigInterface::SCOPE_TYPE_DEFAULT, 0);
        }

        $setup->endSetup();
    }
}
