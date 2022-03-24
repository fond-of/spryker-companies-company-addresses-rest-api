<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;

interface CompanyUnitAddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function fromRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): CompanyUnitAddressTransfer;
}
