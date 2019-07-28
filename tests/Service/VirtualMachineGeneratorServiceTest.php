<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\VirtualMachineService;
use App\Model\Server;
use App\Model\VirtualMachine;
use App\Service\VirtualMachineServiceInterface;
use InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class VirtualMachineGeneratorServiceTest extends TestCase
{
    /**
     * @var VirtualMachineServiceInterface $virtualMachineService
     */
    private $virtualMachineService;

    protected function setUp(): void
    {
        $this->virtualMachineService = new VirtualMachineService();

        parent::setUp();
    }

    /**
     * Create a mock VirtualMachine Object
     * @return MockObject
     */
    private function getVirtualMachine(int $ramValue): MockObject
    {
        $virtualMachine = $this->getMockBuilder(VirtualMachine::class)->disableOriginalConstructor()->getMock();
        $virtualMachine->method('getRam')->willReturn($ramValue);

        return $virtualMachine;
    }

    /**
     * Create a mock Server Object
     * @return MockObject
     */
    private function getServer(): MockObject
    {
        $server = $this->getMockBuilder(Server::class)->disableOriginalConstructor()->getMock();

        return $server;
    }

    /**
     * Calculate virtual machines created considering first fit strategy
     * @test
     */
    public function calculate(): void
    {
        $server = $this->getServer();
        $server->method('getRam')->willReturn(32);

        $virtualMachines = [
            $this->getVirtualMachine(16),
            $this->getVirtualMachine(16),
            $this->getVirtualMachine(32)
        ];

        $this->assertEquals(2, $this->virtualMachineService->calculate($server, $virtualMachines));
    }

    /**
     * Throw exception when the list of virtual machines is empty
     * @test
     */
    public function throwExceptionCalculate(): void
    {
        $server = $this->getServer();

        $this->virtualMachineService->calculate($server, []);

        $this->expectExceptionCode(100);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Virtual Machines can not be empty');
    }
}
