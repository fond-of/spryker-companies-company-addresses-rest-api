<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter;

use Codeception\Test\Unit;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUnitAddressUuidFilterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUnitAddressUuidFilter
     */
    protected $companyUnitAddressUuidFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressUuidFilter = new CompanyUnitAddressUuidFilter();
    }

    /**
     * @return void
     */
    public function testFilterFromRestRequest(): void
    {
        $id = 'c1775b88-ea81-4fa2-909d-8855075892b9';

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($id);

        static::assertEquals(
            $id,
            $this->companyUnitAddressUuidFilter->filterFromRestRequest($this->restRequestMock),
        );
    }
}
