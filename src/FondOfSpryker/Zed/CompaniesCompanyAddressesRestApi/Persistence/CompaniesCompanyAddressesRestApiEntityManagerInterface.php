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
     * @param int $idCompanyUnitAddress
     *
     * @return void
     */
    public function deleteCompanyUnitAddressById(int $idCompanyUnitAddress): void;
}
