<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function count()
    {
        return $this->model->count();
    }

    public function query()
    {
        return $this->model->query();
    }

    public function findById($id)
    {
        $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        $record = $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $modelInstance = $this->findById($id);
        $modelInstance->update($data);
    }

    public function delete($id)
    {
        $modelInstance = $this->findById($id);
        $modelInstance->delete();
    }

    public function rollBackFunction($function)
    {
        DB::beginTransaction();
        try {
            $function();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            // throw new Exception($e->getMessage());
            return false;
        }
    }
}

