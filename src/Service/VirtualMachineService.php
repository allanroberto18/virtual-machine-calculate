<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\ServerType;
use App\Model\VirtualMachine;

class VirtualMachineService implements VirtualMachineServiceInterface
{
    /**
     * Calculate VirtualMachines created considering Server Object
     * @param ServerType $server
     * @param array $virtualMachines
     * @return int
     * @throws \Exception
     */
    public function calculate(ServerType $server, array $virtualMachines): int
    {
        if (sizeof($virtualMachines) === 0) {
            throw new \InvalidArgumentException('Virtual Machines can not be empty', 100);
        }

        $blockSize = $this->getBlockSizeFromServer($server);
        $processSize = $this->getProcessSizeFromVirtualMachines($virtualMachines);

        $countBlockSize = sizeof($blockSize);
        $countProcessSize = sizeof($processSize);

        $result = 0;
        $allocation = [];
        for ($i = 0; $i < $countProcessSize; $i++) {
            $allocation[$i] = -1;
            for ($j = 0; $j < $countBlockSize; $j++) {
                if ($blockSize[$j] >= $processSize[$i]) {
                    $allocation[$i] = $j;
                    $blockSize[$j] -= $processSize[$i];
                }

                if ($allocation[$i] != -1) {
                    $result += $allocation[$i] + 1;
                }
            }
        }

        return $result;
    }

    /**
     * Get $ram value from Server Object
     * @param ServerType $server
     * @return array
     */
    private function getBlockSizeFromServer(ServerType $server): array
    {
        return [
            $server->getRam()
        ];
    }

    /**
     * Get $ram for each VirtualMachine Object and return for processing
     * @param VirtualMachine[] $virtualMachines
     * @return array
     */
    private function getProcessSizeFromVirtualMachines(array $virtualMachines): array
    {
        $result = [];
        foreach ($virtualMachines as $virtualMachine) {
            $result[] = $virtualMachine->getRam();
        }

        return $result;
    }
}
