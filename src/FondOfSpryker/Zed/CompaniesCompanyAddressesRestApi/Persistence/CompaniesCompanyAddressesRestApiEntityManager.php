<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiPersistenceFactory getFactory()
 */
class CompaniesCompanyAddressesRestApiEntityManager extends AbstractEntityManager implements CompaniesCompanyAddressesRestApiEntityManagerInterface
{
    /**
     * @param int $idCompanyUnitAddress
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function findCompanyUnitAddressByIdCompanyUnitAddress(int $idCompanyUnitAddress): CompanyUnitAddressTransfer
    {
        $companyUnitAddressEntity = $this->getFactory()
            ->getCompanyUnitAddressesPropelQuery()
            ->filterByIdCompanyUnitAddress($idCompanyUnitAddress)
            ->findOne();

        $companyUnitAddressMapper = $this->getFactory()->createCompanyUniAddressMapper();

        return $companyUnitAddressMapper->mapCompanyUnitAddressEntityToCompanyUnitAddressTransfer(
            $companyUnitAddressEntity,
            new CompanyUnitAddressTransfer()
        );
    }

    /**
     * @param int $idCompanyUnitAddress
     *
     * @return void
     */
    public function deleteCompanyUnitAddressById(int $idCompanyUnitAddress): void
    {
        $companyUnitAddressEntity = $this->getFactory()
            ->getCompanyUnitAddressesPropelQuery()
            ->filterByIdCompanyUnitAddress($idCompanyUnitAddress)
            ->findOne();

        $companyUnitAddressEntity->delete();
    }
}
