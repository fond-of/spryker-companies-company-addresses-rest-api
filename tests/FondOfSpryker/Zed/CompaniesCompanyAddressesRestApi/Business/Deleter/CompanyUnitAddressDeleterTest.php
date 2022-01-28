<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\CompaniesCompanyAddressesRestApiEvents;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class CompanyUnitAddressDeleterTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $eventFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesDeleteRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter\CompanyUnitAddressDeleter
     */
    protected $companyUnitAddressDeleter;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventFacadeMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiToEventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesDeleteRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesDeleteRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDeleter = new class (
            $this->repositoryMock,
            $this->eventFacadeMock,
            $this->companyUnitAddressFacadeMock,
            $this->transactionHandlerMock
        ) extends CompanyUnitAddressDeleter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface $repository
             * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface|null $eventFacade
             * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                CompaniesCompanyAddressesRestApiRepositoryInterface $repository,
                ?CompaniesCompanyAddressesRestApiToEventFacadeInterface $eventFacade,
                CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct($repository, $eventFacade, $companyUnitAddressFacade);
                $this->transactionHandler = $transactionHandler;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            public function getTransactionHandler(): TransactionHandlerInterface
            {
                return $this->transactionHandler;
            }
        };
    }

    /**
     * @return void
     */
    public function testDeleteByRestCompaniesCompanyAddressesDeleteRequest(): void
    {
        $idCompanyUnitAddress = 1;

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    return $callable();
                }
            );

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findIdCompanyUnitAddressByByRestCompaniesCompanyAddressesDeleteRequest')
            ->with($this->restCompaniesCompanyAddressesDeleteRequestTransferMock)
            ->willReturn($idCompanyUnitAddress);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) use ($idCompanyUnitAddress) {
                        return $idCompanyUnitAddress === $companyUnitAddressTransfer->getIdCompanyUnitAddress();
                    }
                )
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('setIsDeleted')
            ->with(true)
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->eventFacadeMock->expects(static::atLeastOnce())
            ->method('trigger')
            ->with(
                CompaniesCompanyAddressesRestApiEvents::COMPANY_UNIT_ADDRESS_AFTER_DELETE,
                $this->companyUnitAddressTransferMock
            );

        $restCompaniesCompanyAddressesDeleteResponseTransfer = $this->companyUnitAddressDeleter
            ->deleteByRestCompaniesCompanyAddressesDeleteRequest(
                $this->restCompaniesCompanyAddressesDeleteRequestTransferMock
            );

        static::assertCount(1, $restCompaniesCompanyAddressesDeleteResponseTransfer->getMessages());
        static::assertTrue($restCompaniesCompanyAddressesDeleteResponseTransfer->getIsSuccessful());
    }
}
