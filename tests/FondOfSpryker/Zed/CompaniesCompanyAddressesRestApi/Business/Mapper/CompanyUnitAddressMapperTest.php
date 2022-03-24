<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReaderInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;

class CompanyUnitAddressMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitReaderMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyUnitAddressAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\CompanyUnitAddressMapper
     */
    protected $companyUnitAddressMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitReaderMock = $this->getMockBuilder(CompanyBusinessUnitReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUnitAddressAttributesTransferMock = $this->getMockBuilder(RestCompanyUnitAddressAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressMapper = new CompanyUnitAddressMapper(
            $this->companyBusinessUnitReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestCompanyUnitAddressAttributes(): void
    {
        $iso2Code = 'DE';

        $this->restCompanyUnitAddressAttributesTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->restCompanyUnitAddressAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn($iso2Code);

        $companyUnitAddressTransfer = $this->companyUnitAddressMapper->fromRestCompanyUnitAddressAttributes(
            $this->restCompanyUnitAddressAttributesTransferMock,
        );

        static::assertEquals(
            $iso2Code,
            $companyUnitAddressTransfer->getIso2Code(),
        );
    }

    /**
     * @return void
     */
    public function testFromRestCompaniesCompanyAddressesRequest(): void
    {
        $iso2Code = 'DE';
        $idCompany = 1;
        $idCompanyBusinessUnit = 1;

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddress')
            ->willReturn($this->restCompanyUnitAddressAttributesTransferMock);

        $this->restCompanyUnitAddressAttributesTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->restCompanyUnitAddressAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn($iso2Code);

        $this->companyBusinessUnitReaderMock->expects(static::atLeastOnce())
            ->method('getByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn($idCompany);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($idCompanyBusinessUnit);

        $companyUnitAddressTransfer = $this->companyUnitAddressMapper->fromRestCompaniesCompanyAddressesRequest(
            $this->restCompaniesCompanyAddressesRequestTransferMock,
        );

        static::assertEquals(
            $iso2Code,
            $companyUnitAddressTransfer->getIso2Code(),
        );

        static::assertEquals(
            $idCompany,
            $companyUnitAddressTransfer->getFkCompany(),
        );

        static::assertEquals(
            $idCompanyBusinessUnit,
            $companyUnitAddressTransfer->getFkCompanyBusinessUnit(),
        );

        static::assertCount(
            1,
            $companyUnitAddressTransfer->getCompanyBusinessUnits()->getCompanyBusinessUnits(),
        );

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $companyUnitAddressTransfer->getCompanyBusinessUnits()->getCompanyBusinessUnits()->offsetGet(0),
        );
    }

    /**
     * @return void
     */
    public function testFromRestCompaniesCompanyAddressesRequestWithoutRestCompanyUnitAddressAttributesTransfer(): void
    {
        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddress')
            ->willReturn(null);

        $this->companyBusinessUnitReaderMock->expects(static::never())
            ->method('getByRestCompaniesCompanyAddressesRequest');

        $companyUnitAddressTransfer = $this->companyUnitAddressMapper->fromRestCompaniesCompanyAddressesRequest(
            $this->restCompaniesCompanyAddressesRequestTransferMock,
        );

        static::assertEquals(
            null,
            $companyUnitAddressTransfer->getIso2Code(),
        );

        static::assertEquals(
            null,
            $companyUnitAddressTransfer->getFkCompany(),
        );

        static::assertEquals(
            null,
            $companyUnitAddressTransfer->getFkCompanyBusinessUnit(),
        );

        static::assertEquals(
            null,
            $companyUnitAddressTransfer->getCompanyBusinessUnits(),
        );
    }

    /**
     * @return void
     */
    public function testFromRestCompaniesCompanyAddressesRequestWithNonExistingCompanyBusinessUnit(): void
    {
        $iso2Code = 'DE';
        $idCompany = 1;
        $idCompanyBusinessUnit = 1;

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddress')
            ->willReturn($this->restCompanyUnitAddressAttributesTransferMock);

        $this->restCompanyUnitAddressAttributesTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->restCompanyUnitAddressAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn($iso2Code);

        $this->companyBusinessUnitReaderMock->expects(static::atLeastOnce())
            ->method('getByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn(null);

        $companyUnitAddressTransfer = $this->companyUnitAddressMapper->fromRestCompaniesCompanyAddressesRequest(
            $this->restCompaniesCompanyAddressesRequestTransferMock,
        );

        static::assertEquals(
            $iso2Code,
            $companyUnitAddressTransfer->getIso2Code(),
        );

        static::assertEquals(
            null,
            $companyUnitAddressTransfer->getFkCompany(),
        );

        static::assertEquals(
            null,
            $companyUnitAddressTransfer->getFkCompanyBusinessUnit(),
        );

        static::assertEquals(
            null,
            $companyUnitAddressTransfer->getCompanyBusinessUnits(),
        );
    }
}
