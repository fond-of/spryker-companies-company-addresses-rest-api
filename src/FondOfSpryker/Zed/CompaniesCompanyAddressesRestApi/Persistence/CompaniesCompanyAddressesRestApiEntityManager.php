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
     * @inheritDoc
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
     * @inheritDoc
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
