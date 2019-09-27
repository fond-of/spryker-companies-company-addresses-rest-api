<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface CompaniesCompanyAddressesRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer
     */
    public function findDefaultCompanyBusinessUnitByCompanyId(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): ?CompanyBusinessUnitTransfer;
}
