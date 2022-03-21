<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;

interface CompanyBusinessUnitReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): ?CompanyBusinessUnitTransfer;
}
