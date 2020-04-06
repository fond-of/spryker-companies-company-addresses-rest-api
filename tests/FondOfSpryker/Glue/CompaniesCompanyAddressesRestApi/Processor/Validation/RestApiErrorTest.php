<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation;

use Codeception\Test\Unit;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class RestApiErrorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiError
     */
    protected $restApiError;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiError = new RestApiError();
    }

    /**
     * @return void
     */
    public function testProcessCompanyUnitAddressErrorOnCreate(): void
    {
        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->restApiError->processCompanyUnitAddressErrorOnCreate(
                $this->restResponseInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddCompanyUnitAddressUuidMissingError(): void
    {
        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->restApiError->addCompanyUnitAddressUuidMissingError(
                $this->restResponseInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddCompanyUnitAddressNotFoundError(): void
    {
        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->restApiError->addCompanyUnitAddressNotFoundError(
                $this->restResponseInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testProcessCompanyUnitAddressErrorOnUpdate(): void
    {
        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->restApiError->processCompanyUnitAddressErrorOnUpdate(
                $this->restResponseInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddCompanyUnitAddressForCompanyNotFoundError(): void
    {
        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->restApiError->addCompanyUnitAddressForCompanyNotFoundError(
                $this->restResponseInterfaceMock
            )
        );
    }
}
