<?php

namespace App\Domains;

use Illuminate\Support\Collection;

abstract class Collections
{
    /**
     * @var Collection $domains
     */
    protected $domains;

    public function __construct()
    {
        $this->domains = collect();
    }

    /**
     * @return Collection
     */
    public function collect(): Collection
    {
        return clone $this->domains;
    }
}