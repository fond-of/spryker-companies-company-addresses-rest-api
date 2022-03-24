<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Writer;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\CompanyUnitAddressMapperInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\RestCompanyUnitAddressAttributesMapperInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyUnitAddressReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;
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
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\CompanyUnitAddressMapperInterface
     */
    protected $companyUnitAddressMapper;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\RestCompanyUnitAddressAttributesMapperInterface
     */
    protected $restCompanyUnitAddressAttributesMapper;

    /**
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\CompanyUnitAddressMapperInterface $companyUnitAddressMapper
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\RestCompanyUnitAddressAttributesMapperInterface $restCompanyUnitAddressAttributesMapper
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        CompanyUnitAddressMapperInterface $companyUnitAddressMapper,
        RestCompanyUnitAddressAttributesMapperInterface $restCompanyUnitAddressAttributesMapper,
        CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->companyUnitAddressMapper = $companyUnitAddressMapper;
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
        $this->restCompanyUnitAddressAttributesMapper = $restCompanyUnitAddressAttributesMapper;
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
            $this->companyUnitAddressMapper->fromRestCompaniesCompanyAddressesRequest(
                $restCompaniesCompanyAddressesRequestTransfer,
            )->modifiedToArray(),
            true,
        );

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->update($companyUnitAddressTransfer);
        $companyUnitAddressTransfer = $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer();

        if ($companyUnitAddressTransfer === null || !$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            return $restCompaniesCompanyAddressesResponseTransfer->setIsSuccessful(false);
        }

        return $restCompaniesCompanyAddressesResponseTransfer->setCompanyUnitAddress(
            $this->restCompanyUnitAddressAttributesMapper->fromCompanyUnitAddress($companyUnitAddressTransfer),
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

        $companyUnitAddressTransfer = $this->companyUnitAddressMapper->fromRestCompaniesCompanyAddressesRequest(
            $restCompaniesCompanyAddressesRequestTransfer,
        );

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->create($companyUnitAddressTransfer);
        $companyUnitAddressTransfer = $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer();

        if ($companyUnitAddressTransfer === null || !$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            return $restCompaniesCompanyAddressesResponseTransfer->setIsSuccessful(false);
        }

        return $restCompaniesCompanyAddressesResponseTransfer->setCompanyUnitAddress(
            $this->restCompanyUnitAddressAttributesMapper->fromCompanyUnitAddress($companyUnitAddressTransfer),
        );
    }
}
