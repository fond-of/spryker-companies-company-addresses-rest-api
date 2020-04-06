<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressWriter;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompaniesCompanyAddressesRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiFacade
     */
    protected $companiesCompanyAddressesRestApiFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiBusinessFactory
     */
    protected $companiesCompanyAddressesRestApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReaderInterface
     */
    protected $companyBusinessUnitReaderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressWriter
     */
    protected $companyUnitAddressWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    protected $companyUnitAddressResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReaderInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companiesCompanyAddressesRestApiBusinessFactoryMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitReaderInterfaceMock = $this->getMockBuilder(CompanyBusinessUnitReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressWriterMock = $this->getMockBuilder(CompanyUnitAddressWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressReaderInterfaceMock = $this->getMockBuilder(CompanyUnitAddressReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiFacade = new CompaniesCompanyAddressesRestApiFacade();
        $this->companiesCompanyAddressesRestApiFacade->setFactory($this->companiesCompanyAddressesRestApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindDefaultCompanyBusinessUnitByCompanyIdAction(): void
    {
        $this->companiesCompanyAddressesRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitReader')
            ->willReturn($this->companyBusinessUnitReaderInterfaceMock);

        $this->companyBusinessUnitReaderInterfaceMock->expects($this->atLeastOnce())
            ->method('findDefaultCompanyBusinessUnitByCompanyId')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->assertInstanceOf(
            CompanyBusinessUnitTransfer::class,
            $this->companiesCompanyAddressesRestApiFacade->findDefaultCompanyBusinessUnitByCompanyIdAction(
                $this->companyBusinessUnitTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUnitAddress(): void
    {
        $this->companiesCompanyAddressesRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUnitAddressWriter')
            ->willReturn($this->companyUnitAddressWriterMock);

        $this->companyUnitAddressWriterMock->expects($this->atLeastOnce())
            ->method('deleteCompanyUnitAddress')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressResponseTransfer::class,
            $this->companiesCompanyAddressesRestApiFacade->deleteCompanyUnitAddress(
                $this->companyUnitAddressTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressById(): void
    {
        $this->companiesCompanyAddressesRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUnitAddressReader')
            ->willReturn($this->companyUnitAddressReaderInterfaceMock);

        $this->companyUnitAddressReaderInterfaceMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressTransfer::class,
            $this->companiesCompanyAddressesRestApiFacade->getCompanyUnitAddressById(
                $this->companyUnitAddressTransferMock
            )
        );
    }
}
