<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestApiValidatorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiValidator
     */
    protected $restApiValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiErrorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    protected $companyUserCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer[]|\ArrayObject
     */
    protected $companyUsers;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restApiErrorInterfaceMock = $this->getMockBuilder(RestApiErrorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCollectionTransferMock = $this->getMockBuilder(CompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->id = 'id';

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUsers = new ArrayObject([
            $this->companyUserTransferMock,
        ]);

        $this->restApiValidator = new RestApiValidator(
            $this->restApiErrorInterfaceMock,
        );
    }

    /**
     * @return void
     */
    public function testIsCompanyAddress(): void
    {
        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->willReturn($this->restResourceInterfaceMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->id);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->assertTrue(
            $this->restApiValidator->isCompanyAddress(
                $this->restRequestInterfaceMock,
                $this->companyTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testIsCustomerCompanyUser(): void
    {
        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->willReturn($this->restResourceInterfaceMock);

        $this->companyUserCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn($this->companyUsers);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->id);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->assertTrue(
            $this->restApiValidator->isCustomerCompanyUser(
                $this->restRequestInterfaceMock,
                $this->companyUserCollectionTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testIsCustomerCompanyUserEmptyCompanyUsers(): void
    {
        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->willReturn($this->restResourceInterfaceMock);

        $this->companyUserCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn(new ArrayObject());

        $this->assertFalse(
            $this->restApiValidator->isCustomerCompanyUser(
                $this->restRequestInterfaceMock,
                $this->companyUserCollectionTransferMock,
            ),
        );
    }
}
