<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence;

use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiPersistenceFactory getFactory()
 */
class CompaniesCompanyAddressesRestApiRepository extends AbstractRepository implements CompaniesCompanyAddressesRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
     *
     * @return int|null
     */
    public function findIdCompanyUnitAddressByByRestCompaniesCompanyAddressesDeleteRequest(
        RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
    ): ?int {
        /** @var int|null $idCompanyUnitAddress */
        $idCompanyUnitAddress = $this->getFactory()
            ->getCompanyUnitAddressesPropelQuery()
            ->clear()
            ->useCompanyQuery()
                ->filterByUuid($restCompaniesCompanyAddressesDeleteRequestTransfer->getCompanyUuid())
                ->useCompanyUserQuery()
                    ->useCustomerQuery()
                        ->filterByIdCustomer($restCompaniesCompanyAddressesDeleteRequestTransfer->getIdCustomer())
                    ->endUse()
                ->endUse()
            ->endUse()
            ->filterByUuid($restCompaniesCompanyAddressesDeleteRequestTransfer->getCompanyUnitAddressUuid())
            ->select([SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS])
            ->findOne();

        return $idCompanyUnitAddress;
    }
}
