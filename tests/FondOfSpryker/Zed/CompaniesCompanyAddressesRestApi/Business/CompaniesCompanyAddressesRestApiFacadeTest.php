<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter\CompanyUnitAddressDeleterInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Writer\CompanyUnitAddressWriterInterface;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;

class CompaniesCompanyAddressesRestApiFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiBusinessFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter\CompanyUnitAddressDeleterInterface
     */
    protected $companyUnitAddressDeleterMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Writer\CompanyUnitAddressWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer
     */
    protected $restCompaniesCompanyAddressesDeleteRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
     */
    protected $restCompaniesCompanyAddressesDeleteResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDeleterMock = $this->getMockBuilder(CompanyUnitAddressDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressWriterMock = $this->getMockBuilder(CompanyUnitAddressWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesDeleteRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesDeleteRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesDeleteResponseTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesDeleteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesResponseTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompaniesCompanyAddressesRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressDeleter')
            ->willReturn($this->companyUnitAddressDeleterMock);

        $this->companyUnitAddressDeleterMock->expects(static::atLeastOnce())
            ->method('deleteByRestCompaniesCompanyAddressesDeleteRequest')
            ->with($this->restCompaniesCompanyAddressesDeleteRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesDeleteResponseTransferMock);

        static::assertEquals(
            $this->restCompaniesCompanyAddressesDeleteResponseTransferMock,
            $this->facade->deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(
                $this->restCompaniesCompanyAddressesDeleteRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressWriter')
            ->willReturn($this->companyUnitAddressWriterMock);

        $this->companyUnitAddressWriterMock->expects(static::atLeastOnce())
            ->method('createByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesResponseTransferMock);

        static::assertEquals(
            $this->restCompaniesCompanyAddressesResponseTransferMock,
            $this->facade->createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressWriter')
            ->willReturn($this->companyUnitAddressWriterMock);

        $this->companyUnitAddressWriterMock->expects(static::atLeastOnce())
            ->method('updateByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesResponseTransferMock);

        static::assertEquals(
            $this->restCompaniesCompanyAddressesResponseTransferMock,
            $this->facade->updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            ),
        );
    }
}
