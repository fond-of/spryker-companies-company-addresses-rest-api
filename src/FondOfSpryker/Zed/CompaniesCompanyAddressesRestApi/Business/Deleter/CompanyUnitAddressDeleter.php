<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter;

use ArrayObject;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\CompaniesCompanyAddressesRestApiEvents;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CompanyUnitAddressDeleter implements CompanyUnitAddressDeleterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface
     */
    protected $eventFacade;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacade;

    /**
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface|null $eventFacade
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
     */
    public function __construct(
        CompaniesCompanyAddressesRestApiRepositoryInterface $repository,
        ?CompaniesCompanyAddressesRestApiToEventFacadeInterface $eventFacade,
        CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
    ) {
        $this->repository = $repository;
        $this->eventFacade = $eventFacade;
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
     */
    public function deleteByRestCompaniesCompanyAddressesDeleteRequest(
        RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
    ): RestCompaniesCompanyAddressesDeleteResponseTransfer {
        $self = $this;

        return $this->getTransactionHandler()->handleTransaction(
            static function () use ($self, $restCompaniesCompanyAddressesDeleteRequestTransfer) {
                return $self->doDeleteByRestCompaniesCompanyAddressesDeleteRequest(
                    $restCompaniesCompanyAddressesDeleteRequestTransfer,
                );
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
     */
    protected function doDeleteByRestCompaniesCompanyAddressesDeleteRequest(
        RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
    ): RestCompaniesCompanyAddressesDeleteResponseTransfer {
        $restCompaniesCompanyAddressesDeleteResponseTransfer = (new RestCompaniesCompanyAddressesDeleteResponseTransfer())
            ->setIsSuccessful(true);

        $idCompanyUnitAddress = $this->repository
            ->findIdCompanyUnitAddressByByRestCompaniesCompanyAddressesDeleteRequest(
                $restCompaniesCompanyAddressesDeleteRequestTransfer,
            );

        if ($idCompanyUnitAddress === null) {
            $messageTransfer = (new MessageTransfer())
                ->setType('error')
                ->setValue('xxx');

            return $restCompaniesCompanyAddressesDeleteResponseTransfer->setIsSuccessful(false)
                ->setMessages(new ArrayObject([$messageTransfer]));
        }

        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->setIdCompanyUnitAddress($idCompanyUnitAddress);

        $companyUnitAddressTransfer = $this->companyUnitAddressFacade->getCompanyUnitAddressById(
            $companyUnitAddressTransfer,
        );

        $this->companyUnitAddressFacade->delete($companyUnitAddressTransfer);

        $this->triggerEvent(
            CompaniesCompanyAddressesRestApiEvents::COMPANY_UNIT_ADDRESS_AFTER_DELETE,
            $companyUnitAddressTransfer->setIsDeleted(true),
        );

        $messageTransfer = (new MessageTransfer())
            ->setType('success')
            ->setValue('xxx');

        return $restCompaniesCompanyAddressesDeleteResponseTransfer->setMessages(new ArrayObject([$messageTransfer]));
    }

    /**
     * @param string $eventName
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return void
     */
    protected function triggerEvent(string $eventName, CompanyUnitAddressTransfer $companyUnitAddressTransfer): void
    {
        if ($this->eventFacade === null) {
            return;
        }

        $this->eventFacade->trigger($eventName, $companyUnitAddressTransfer);
    }
}
