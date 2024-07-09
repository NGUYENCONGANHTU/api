<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Trademark;
use Exception;

class TrademarkRepositories extends BaseRepository
{
     /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Trademark::class;
    }

    /**
     * Get data by multiple fields
     *
     * @param array $params
     * @return mixed
     */
    public function search($params)
    {
        // default limit
        $limit = config('constant.defaultLimit');
        $query = $this->model->query();

        if (isset($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        if (isset($params['status'])) {
            $query = $query->where('status', '=', (int) $params['status']);
        }

        return $query->paginate($limit);
    }

    /**
     * sync list trademark
     *
     * @param array $itemId
     * @return mixed
     */
    public function syncDataTrademark($itemId)
    {
        try {
            if($itemId){
                return $this->model
                            ->where('id', $itemId)
                                    ->get();
            }
        } catch (\Throwable $th) {
           throw new Exception("sync data list trademark fail!!!");
        }
    }
}