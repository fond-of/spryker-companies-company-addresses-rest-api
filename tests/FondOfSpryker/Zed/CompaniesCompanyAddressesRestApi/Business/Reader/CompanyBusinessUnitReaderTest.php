<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader;

use Codeception\Test\Unit;
use Exception;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;

class CompanyBusinessUnitReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReader
     */
    protected $companyBusinessUnitReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitReader = new CompanyBusinessUnitReader(
            $this->repositoryMock,
            $this->companyBusinessUnitFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompaniesCompanyAddressesRequest(): void
    {
        $idCompanyBusinessUnit = 1;

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findIdCompanyBusinessUnitByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($idCompanyBusinessUnit);

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->with(
                static::callback(
                    static function (CompanyBusinessUnitTransfer $companyBusinessUnitTransfer) use ($idCompanyBusinessUnit) {
                        return $companyBusinessUnitTransfer->getIdCompanyBusinessUnit() === $idCompanyBusinessUnit;
                    },
                ),
            )->willReturn($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->companyBusinessUnitReader->getByRestCompaniesCompanyAddressesRequest(
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompaniesCompanyAddressesRequestWithNonExistingCompanyBusinessUnit(): void
    {
        $idCompanyBusinessUnit = null;

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findIdCompanyBusinessUnitByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($idCompanyBusinessUnit);

        $this->companyBusinessUnitFacadeMock->expects(static::never())
            ->method('getCompanyBusinessUnitById');

        static::assertEquals(
            null,
            $this->companyBusinessUnitReader->getByRestCompaniesCompanyAddressesRequest(
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompaniesCompanyAddressesRequestWithError(): void
    {
        $idCompanyBusinessUnit = 1;

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findIdCompanyBusinessUnitByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($idCompanyBusinessUnit);

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->with(
                static::callback(
                    static function (CompanyBusinessUnitTransfer $companyBusinessUnitTransfer) use ($idCompanyBusinessUnit) {
                        return $companyBusinessUnitTransfer->getIdCompanyBusinessUnit() === $idCompanyBusinessUnit;
                    },
                ),
            )->willThrowException(new Exception());

        static::assertEquals(
            null,
            $this->companyBusinessUnitReader->getByRestCompaniesCompanyAddressesRequest(
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            ),
        );
    }
}
