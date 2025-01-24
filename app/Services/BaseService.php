<?php
namespace App\Services;

class BaseService
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function search(array $filters)
    {
        return $this->repository->search($filters);
    }
    public function find($id)
    {
        return $this->repository->find($id);  // Usar repositorio para el "find"
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}
