<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed;

use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class CompaniesCompanyAddressesRestApiStub implements CompaniesCompanyAddressesRestApiStubInterface
{
    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * CompaniesCompanyAddressesRestApiStub constructor.
     *
     * @param \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompaniesCompanyAddressesRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function findDefaultCompanyBusinessUnitByCompanyId(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): ?CompanyBusinessUnitTransfer {
        $companyBusinessUnitTransfer = $this->zedRequestClient->call(
            '/companies-company-addresses-rest-api/gateway/find-default-company-business-unit-by-company-id',
            $companyBusinessUnitTransfer
        );

        return $companyBusinessUnitTransfer;
    }
}
