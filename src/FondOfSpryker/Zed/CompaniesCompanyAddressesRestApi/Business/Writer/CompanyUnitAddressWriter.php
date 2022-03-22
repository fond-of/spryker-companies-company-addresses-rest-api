<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Writer;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyUnitAddressReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CompanyUnitAddressWriter implements CompanyUnitAddressWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReader;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacade;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReaderInterface
     */
    protected $companyBusinessUnitReader;

    /**
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReaderInterface $companyBusinessUnitReader
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        CompanyBusinessUnitReaderInterface $companyBusinessUnitReader,
        CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->companyBusinessUnitReader = $companyBusinessUnitReader;
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    public function updateByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer {
        $self = $this;

        return $this->getTransactionHandler()->handleTransaction(
            static function () use ($self, $restCompaniesCompanyAddressesRequestTransfer) {
                return $self->doUpdateByRestCompaniesCompanyAddressesRequest(
                    $restCompaniesCompanyAddressesRequestTransfer,
                );
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    protected function doUpdateByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer {
        $restCompaniesCompanyAddressesResponseTransfer = (new RestCompaniesCompanyAddressesResponseTransfer())
            ->setIsSuccessful(true);

        $restCompanyUnitAddressAttributesTransfer = $restCompaniesCompanyAddressesRequestTransfer
            ->getCompanyUnitAddress();

        if ($restCompanyUnitAddressAttributesTransfer === null) {
            return $restCompaniesCompanyAddressesResponseTransfer->setIsSuccessful(false);
        }

        $companyUnitAddressTransfer = $this->companyUnitAddressReader->getByRestCompaniesCompanyAddressesRequest(
            $restCompaniesCompanyAddressesRequestTransfer,
        );

        if ($companyUnitAddressTransfer === null) {
            return $restCompaniesCompanyAddressesResponseTransfer->setIsSuccessful(false);
        }

        $companyUnitAddressTransfer = $companyUnitAddressTransfer->fromArray(
            $restCompanyUnitAddressAttributesTransfer->toArray(),
            true,
        );

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->update($companyUnitAddressTransfer);
        $companyUnitAddressTransfer = $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer();

        if ($companyUnitAddressTransfer === null || !$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            return $restCompaniesCompanyAddressesResponseTransfer->setIsSuccessful(false);
        }

        return $restCompaniesCompanyAddressesResponseTransfer->setCompanyUnitAddress(
            (new RestCompanyUnitAddressAttributesTransfer())->fromArray(
                $companyUnitAddressTransfer->toArray(),
                true,
            ),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    public function createByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer {
        $self = $this;

        return $this->getTransactionHandler()->handleTransaction(
            static function () use ($self, $restCompaniesCompanyAddressesRequestTransfer) {
                return $self->doCreateByRestCompaniesCompanyAddressesRequest(
                    $restCompaniesCompanyAddressesRequestTransfer,
                );
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    protected function doCreateByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer {
        $restCompaniesCompanyAddressesResponseTransfer = (new RestCompaniesCompanyAddressesResponseTransfer())
            ->setIsSuccessful(true);

        $restCompanyUnitAddressAttributesTransfer = $restCompaniesCompanyAddressesRequestTransfer
            ->getCompanyUnitAddress();

        if ($restCompanyUnitAddressAttributesTransfer === null) {
            return $restCompaniesCompanyAddressesResponseTransfer->setIsSuccessful(false);
        }

        $companyBusinessUnit = $this->companyBusinessUnitReader->getByRestCompaniesCompanyAddressesRequest(
            $restCompaniesCompanyAddressesRequestTransfer,
        );

        if ($companyBusinessUnit === null) {
            return $restCompaniesCompanyAddressesResponseTransfer->setIsSuccessful(false);
        }

        $companyBusinessUnitCollectionTransfer = (new CompanyBusinessUnitCollectionTransfer())
            ->addCompanyBusinessUnit($companyBusinessUnit);

        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->fromArray($restCompanyUnitAddressAttributesTransfer->toArray(), true)
            ->setFkCompany($companyBusinessUnit->getFkCompany())
            ->setFkCompanyBusinessUnit($companyBusinessUnit->getIdCompanyBusinessUnit())
            ->setCompanyBusinessUnits($companyBusinessUnitCollectionTransfer);

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->create($companyUnitAddressTransfer);
        $companyUnitAddressTransfer = $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer();

        if ($companyUnitAddressTransfer === null || !$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            return $restCompaniesCompanyAddressesResponseTransfer->setIsSuccessful(false);
        }

        return $restCompaniesCompanyAddressesResponseTransfer->setCompanyUnitAddress(
            (new RestCompanyUnitAddressAttributesTransfer())->fromArray(
                $companyUnitAddressTransfer->toArray(),
                true,
            ),
        );
    }
}
