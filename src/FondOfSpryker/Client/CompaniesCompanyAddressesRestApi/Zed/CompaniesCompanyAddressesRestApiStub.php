<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed;

use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;

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
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function findDefaultCompanyBusinessUnitByCompanyId(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): ?CompanyBusinessUnitTransfer {
        /** @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null $companyBusinessUnitTransfer */
        $companyBusinessUnitTransfer = $this->zedRequestClient->call(
            '/companies-company-addresses-rest-api/gateway/find-default-company-business-unit-by-company-id',
            $companyBusinessUnitTransfer,
        );

        return $companyBusinessUnitTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
     */
    public function deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(
        RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
    ): RestCompaniesCompanyAddressesDeleteResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer $restCompaniesCompanyAddressesDeleteResponseTransfer */
        $restCompaniesCompanyAddressesDeleteResponseTransfer = $this->zedRequestClient->call(
            '/companies-company-addresses-rest-api/gateway/delete-company-unit-address-by-rest-companies-company-addresses-delete-request',
            $restCompaniesCompanyAddressesDeleteRequestTransfer,
        );

        return $restCompaniesCompanyAddressesDeleteResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    public function createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer $restCompaniesCompanyAddressesResponseTransfer */
        $restCompaniesCompanyAddressesResponseTransfer = $this->zedRequestClient->call(
            '/companies-company-addresses-rest-api/gateway/create-company-unit-address-by-rest-companies-company-addresses-request',
            $restCompaniesCompanyAddressesRequestTransfer,
        );

        return $restCompaniesCompanyAddressesResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    public function updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer $restCompaniesCompanyAddressesResponseTransfer */
        $restCompaniesCompanyAddressesResponseTransfer = $this->zedRequestClient->call(
            '/companies-company-addresses-rest-api/gateway/update-company-unit-address-by-rest-companies-company-addresses-request',
            $restCompaniesCompanyAddressesRequestTransfer,
        );

        return $restCompaniesCompanyAddressesResponseTransfer;
    }
}
