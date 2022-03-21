<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Throwable;

class CompanyUnitAddressReader implements CompanyUnitAddressReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacade;

    /**
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
     */
    public function __construct(
        CompaniesCompanyAddressesRestApiRepositoryInterface $repository,
        CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
    ) {
        $this->repository = $repository;
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): ?CompanyUnitAddressTransfer {
        $idCompanyUnitAddress = $this->repository
            ->findIdCompanyUnitAddressByByRestCompaniesCompanyAddressesRequest(
                $restCompaniesCompanyAddressesRequestTransfer,
            );

        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->setIdCompanyUnitAddress($idCompanyUnitAddress);

        try {
            return $this->companyUnitAddressFacade->getCompanyUnitAddressById($companyUnitAddressTransfer);
        } catch (Throwable $exception) {
            return null;
        }
    }
}
