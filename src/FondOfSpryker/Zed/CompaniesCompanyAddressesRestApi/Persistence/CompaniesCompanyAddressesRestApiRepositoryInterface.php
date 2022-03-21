<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence;

use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;

interface CompaniesCompanyAddressesRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
     *
     * @return int|null
     */
    public function findIdCompanyUnitAddressByByRestCompaniesCompanyAddressesDeleteRequest(
        RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
    ): ?int;

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return int|null
     */
    public function findIdCompanyUnitAddressByByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): ?int;

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return int|null
     */
    public function findIdCompanyBusinessUnitByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): ?int;
}
