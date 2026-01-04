<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $instance = $this->find($id);
        if ($instance) {
            $instance->update($data);
        }
        return $instance;
    }

    public function delete($id)
    {
        $instance = $this->find($id);
        if ($instance) {
            $instance->delete();
            return true;
        }
        return false;
    }
}
