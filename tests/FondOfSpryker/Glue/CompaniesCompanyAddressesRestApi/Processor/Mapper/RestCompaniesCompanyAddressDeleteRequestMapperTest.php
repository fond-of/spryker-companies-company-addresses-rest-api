<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUnitAddressUuidFilterInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUuidFilterInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CustomerIdFilterInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestCompaniesCompanyAddressDeleteRequestMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CustomerIdFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerIdFilterMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUuidFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUuidFilterMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUnitAddressUuidFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressUuidFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressDeleteRequestMapper
     */
    protected $restCompaniesCompanyAddressDeleteRequestMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerIdFilterMock = $this->getMockBuilder(CustomerIdFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUuidFilterMock = $this->getMockBuilder(CompanyUuidFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressUuidFilterMock = $this->getMockBuilder(CompanyUnitAddressUuidFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressDeleteRequestMapper = new RestCompaniesCompanyAddressDeleteRequestMapper(
            $this->customerIdFilterMock,
            $this->companyUuidFilterMock,
            $this->companyUnitAddressUuidFilterMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $idCustomer = 1;
        $companyUuid = 'c1775b88-ea81-4fa2-909d-8855075892b9';
        $companyUnitAddressUuid = '31c0da32-ed76-4c27-8786-741b4fe1339b';

        $this->customerIdFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($idCustomer);

        $this->companyUuidFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($companyUuid);

        $this->companyUnitAddressUuidFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($companyUnitAddressUuid);

        $restCompaniesCompanyAddressDeleteRequestTransfer = $this->restCompaniesCompanyAddressDeleteRequestMapper
            ->fromRestRequest($this->restRequestMock);

        static::assertEquals($idCustomer, $restCompaniesCompanyAddressDeleteRequestTransfer->getIdCustomer());
        static::assertEquals($companyUuid, $restCompaniesCompanyAddressDeleteRequestTransfer->getCompanyUuid());
        static::assertEquals($companyUnitAddressUuid, $restCompaniesCompanyAddressDeleteRequestTransfer->getCompanyUnitAddressUuid());
    }
}
