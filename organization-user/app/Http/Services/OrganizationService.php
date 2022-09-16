<?php

namespace Http\Services;

use Illuminate\Database\Eloquent\Collection;

class OrganizationRepository
{
    
    /**
     * @var OrganizationRepository
     */
    private OrganizationRepository $repository;

    public function __construct(OrganizationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * 
     * @return bool
     */
    public function create(array $data): bool
    {
        return $this->repository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * 
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->repository->list();
    }

    /**
     * @param array $datas
     * 
     * @return Collection
     */
    public function byDatas(array $datas): Collection
    {
        return $this->repository->byDatas($datas);
    }
}