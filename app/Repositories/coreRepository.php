<?php

namespace App\Repositories;

abstract class coreRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract public function getModelClass();

    public function startConditions()
    {
        return clone $this->model;
    }
}
