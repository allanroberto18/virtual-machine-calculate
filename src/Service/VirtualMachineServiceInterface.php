<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\ServerType;
use App\Model\VirtualMachine;

interface VirtualMachineServiceInterface
{
    /**
     * @param ServerType $server
     * @param VirtualMachine[] $virtualMachines
     * @return int
     */
    public function calculate(ServerType $server, array $virtualMachines): int;
}
