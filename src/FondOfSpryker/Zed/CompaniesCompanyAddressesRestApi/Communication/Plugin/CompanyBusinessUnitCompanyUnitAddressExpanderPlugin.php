<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Communication\Plugin;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Plugin\CompanyUnitAddressExpanderPluginInterface;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiFacadeInterface getFacade()
 */
class CompanyBusinessUnitCompanyUnitAddressExpanderPlugin extends AbstractPlugin implements CompanyUnitAddressExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function expand(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressTransfer {
        $companyUnitAddressTransfer = $this->getFacade()
            ->getCompanyUnitAddressById($companyUnitAddressTransfer);

        return $companyUnitAddressTransfer;
    }
}
