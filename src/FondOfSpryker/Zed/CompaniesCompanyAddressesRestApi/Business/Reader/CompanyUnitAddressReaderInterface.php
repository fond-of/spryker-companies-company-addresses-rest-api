<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;

interface CompanyUnitAddressReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): ?CompanyUnitAddressTransfer;
}
