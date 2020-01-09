<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed;

use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompaniesCompanyAddressesRestApiStub implements CompaniesCompanyAddressesRestApiStubInterface
{
    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompaniesCompanyAddressesRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer|null
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

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function deleteCompanyUnitAddress(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer {
        $companyUnitAddressResponseTransfer = $this->zedRequestClient->call(
            '/companies-company-addresses-rest-api/gateway/delete-company-unit-address',
            $companyUnitAddressTransfer
        );

        return $companyUnitAddressResponseTransfer;
    }
}
