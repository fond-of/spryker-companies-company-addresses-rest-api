<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface CompaniesCompanyAddressesRestApiEntityManagerInterface
{
    /**
     * @param int $idCompanyUnitAddress
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function findCompanyUnitAddressByIdCompanyUnitAddress(int $idCompanyUnitAddress): CompanyUnitAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer|int $companyUnitAddressTransfer
     */
    public function deleteCompanyUnitAddressById(int $idCompanyUnitAddress): void;
}
