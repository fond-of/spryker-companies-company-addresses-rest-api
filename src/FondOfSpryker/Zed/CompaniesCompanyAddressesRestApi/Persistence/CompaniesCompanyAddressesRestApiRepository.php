<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence;

use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
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
            ->getCompanyUnitAddressQuery()
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

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return int|null
     */
    public function findIdCompanyUnitAddressByByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): ?int {
        /** @var int|null $idCompanyUnitAddress */
        $idCompanyUnitAddress = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->clear()
            ->useCompanyQuery()
                ->filterByUuid($restCompaniesCompanyAddressesRequestTransfer->getCompanyUuid())
                ->useCompanyUserQuery()
                    ->useCustomerQuery()
                        ->filterByIdCustomer($restCompaniesCompanyAddressesRequestTransfer->getIdCustomer())
                    ->endUse()
                ->endUse()
            ->endUse()
            ->filterByUuid($restCompaniesCompanyAddressesRequestTransfer->getCompanyUnitAddressUuid())
            ->select([SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS])
            ->findOne();

        return $idCompanyUnitAddress;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return int|null
     */
    public function findIdCompanyBusinessUnitByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): ?int {
        /** @var int|null $idCompanyBusinessUnit */
        $idCompanyBusinessUnit = $this->getFactory()
            ->getCompanyBusinessUnitQuery()
            ->clear()
            ->useCompanyUserQuery()
                ->filterByFkCustomer($restCompaniesCompanyAddressesRequestTransfer->getIdCustomer())
            ->endUse()
            ->useCompanyQuery()
                ->filterByUuid($restCompaniesCompanyAddressesRequestTransfer->getCompanyUuid())
            ->endUse()
            ->select([SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT])
            ->orderByIdCompanyBusinessUnit()
            ->findOne();

        return $idCompanyBusinessUnit;
    }
}
