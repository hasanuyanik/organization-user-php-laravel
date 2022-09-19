<?php

namespace App\Http\Repositories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

class OrganizationRepository
{
    /**
     * @param array $data
     * 
     */
    public function create(array $data)
    {
        return Organization::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * 
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return Organization::where('id', $id)->update($data);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return Organization::get();
    }

    /**
     * @param array $datas
     * 
     * @return Collection
     */
    public function byDatas(array $datas): Collection
    {
        return Organization::where($datas)->get();
    }
}