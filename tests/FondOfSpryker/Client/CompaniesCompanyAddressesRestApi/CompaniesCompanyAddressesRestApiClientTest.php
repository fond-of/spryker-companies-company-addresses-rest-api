<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed\CompaniesCompanyAddressesRestApiStubInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;

class CompaniesCompanyAddressesRestApiClientTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed\CompaniesCompanyAddressesRestApiStubInterface
     */
    protected $stubMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer
     */
    protected $restCompaniesCompanyAddressesDeleteRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
     */
    protected $restCompaniesCompanyAddressesDeleteResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer
     */
    protected $restCompaniesCompanyAddressesRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    protected $restCompaniesCompanyAddressesResponseTransferMock;

    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stubMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiStubInterface::class)
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

        $this->client = new CompaniesCompanyAddressesRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindDefaultCompanyBusinessUnitByCompanyId(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedCompaniesCompanyAddressesRestApiStub')
            ->willReturn($this->stubMock);

        $this->stubMock->expects(static::atLeastOnce())
            ->method('findDefaultCompanyBusinessUnitByCompanyId')
            ->willReturn($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->client->findDefaultCompanyBusinessUnitByCompanyId(
                $this->companyBusinessUnitTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedCompaniesCompanyAddressesRestApiStub')
            ->willReturn($this->stubMock);

        $this->stubMock->expects(static::atLeastOnce())
            ->method('deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest')
            ->with($this->restCompaniesCompanyAddressesDeleteRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesDeleteResponseTransferMock);

        static::assertEquals(
            $this->restCompaniesCompanyAddressesDeleteResponseTransferMock,
            $this->client->deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(
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
            ->method('createZedCompaniesCompanyAddressesRestApiStub')
            ->willReturn($this->stubMock);

        $this->stubMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesResponseTransferMock);

        static::assertEquals(
            $this->restCompaniesCompanyAddressesResponseTransferMock,
            $this->client->createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
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
            ->method('createZedCompaniesCompanyAddressesRestApiStub')
            ->willReturn($this->stubMock);

        $this->stubMock->expects(static::atLeastOnce())
            ->method('updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesResponseTransferMock);

        static::assertEquals(
            $this->restCompaniesCompanyAddressesResponseTransferMock,
            $this->client->updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            ),
        );
    }
}
