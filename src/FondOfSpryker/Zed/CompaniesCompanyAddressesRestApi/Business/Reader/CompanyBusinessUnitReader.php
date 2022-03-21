<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Throwable;

class CompanyBusinessUnitReader implements CompanyBusinessUnitReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     */
    public function __construct(
        CompaniesCompanyAddressesRestApiRepositoryInterface $repository,
        CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
    ) {
        $this->repository = $repository;
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): ?CompanyBusinessUnitTransfer {
        $idCompanyBusinessUnit = $this->repository->findIdCompanyBusinessUnitByRestCompaniesCompanyAddressesRequest(
            $restCompaniesCompanyAddressesRequestTransfer,
        );

        if ($idCompanyBusinessUnit === null) {
            return null;
        }

        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
            ->setIdCompanyBusinessUnit($idCompanyBusinessUnit);

        try {
            return $this->companyBusinessUnitFacade->getCompanyBusinessUnitById($companyBusinessUnitTransfer);
        } catch (Throwable $exception) {
            return null;
        }
    }
}
