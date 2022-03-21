<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader;

use Codeception\Test\Unit;
use Exception;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;

class CompanyUnitAddressReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyUnitAddressReader
     */
    protected $companyUnitAddressReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressReader = new CompanyUnitAddressReader(
            $this->repositoryMock,
            $this->companyUnitAddressFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompaniesCompanyAddressesRequest(): void
    {
        $idCompanyUnitAddress = 1;

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findIdCompanyUnitAddressByByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($idCompanyUnitAddress);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    },
                ),
            )->willReturn($this->companyUnitAddressTransferMock);

        static::assertEquals(
            $this->companyUnitAddressTransferMock,
            $this->companyUnitAddressReader->getByRestCompaniesCompanyAddressesRequest(
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompaniesCompanyAddressesRequestWithError(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findIdCompanyUnitAddressByByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn(null);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === null;
                    },
                ),
            )->willThrowException(new Exception());

        static::assertEquals(
            null,
            $this->companyUnitAddressReader->getByRestCompaniesCompanyAddressesRequest(
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            ),
        );
    }
}
