<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi;

use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiFactory getFactory()
 */
class CompaniesCompanyAddressesRestApiClient extends AbstractClient implements CompaniesCompanyAddressesRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function findDefaultCompanyBusinessUnitByCompanyId(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyBusinessUnitTransfer
    {
        return $this->getFactory()
            ->createZedCompaniesCompanyAddressesRestApiStub()
            ->findDefaultCompanyBusinessUnitByCompanyId($companyBusinessUnitTransfer);
    }
}
