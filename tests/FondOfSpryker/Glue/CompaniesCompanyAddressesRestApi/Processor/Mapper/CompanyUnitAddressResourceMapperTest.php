<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;

class CompanyUnitAddressResourceMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapper
     */
    protected $companyUnitAddressResourceMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer
     */
    protected $restCompanyUnitAddressAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUnitAddressAttributesTransferMock = $this->getMockBuilder(RestCompanyUnitAddressAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResourceMapper = new CompanyUnitAddressResourceMapper();
    }

    /**
     * @return void
     */
    public function testMapCompanyUnitAddressTransferToRestCompanyUnitAddressAttributesTransfer(): void
    {
        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->assertInstanceOf(
            RestCompanyUnitAddressAttributesTransfer::class,
            $this->companyUnitAddressResourceMapper->mapCompanyUnitAddressTransferToRestCompanyUnitAddressAddressAttributesTransfer(
                $this->companyUnitAddressTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testMapRestCompanyUnitAddressAttributesTransferToCompanyUnitAddressTransfer(): void
    {
        $this->restCompanyUnitAddressAttributesTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->assertInstanceOf(
            CompanyUnitAddressTransfer::class,
            $this->companyUnitAddressResourceMapper->mapRestCompanyUnitAddressAttributesTransferToCompanyUnitAddressTransfer(
                $this->restCompanyUnitAddressAttributesTransferMock
            )
        );
    }
}
