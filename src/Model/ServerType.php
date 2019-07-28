<?php
declare(strict_types=1);

namespace App\Model;

abstract class ServerType
{
    /** @var int $cpu */
    protected $cpu;

    /** @var int $ram  */
    protected $ram;

    /** @var int $hdd */
    protected $hdd;

    /**
     * ServerType constructor.
     * @param int $cpu
     * @param int $ram
     * @param int $hdd
     */
    public function __construct(int $cpu, int $ram, int $hdd)
    {
        $this->cpu = $cpu;
        $this->ram = $ram;
        $this->hdd = $hdd;
    }

    /**
     * @return int
     */
    public function getCpu(): int
    {
        return $this->cpu;
    }

    /**
     * @return int
     */
    public function getRam(): int
    {
        return $this->ram;
    }

    /**
     * @return int
     */
    public function getHdd(): int
    {
        return $this->hdd;
    }
}
