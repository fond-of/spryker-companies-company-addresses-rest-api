<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressesResponseTransfer;
use Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface;

interface CompaniesCompanyAddressesRestApiClientInterface
{
    /**
     * Specification:
     *  - Retrieve a default company business unit address by CompanyBusinessUnitTransfer::fk_company in the transfer
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function findDefaultCompanyBusinessUnitByCompanyId(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyBusinessUnitTransfer;

}