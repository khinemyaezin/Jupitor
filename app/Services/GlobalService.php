<?php
namespace  App\Services;

interface GlobalService {
    public function getById($id);
    public function create($data);
    public function update($data);
    public function delete($id);
    public function all($pagination,$request=null);
}