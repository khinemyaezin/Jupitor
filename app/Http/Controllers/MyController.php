<?php
namespace App\Http\Controllers;
interface MyController {
    public function index();
    public function all();
    public function getById($id);
    public function create();
    public function update($id);
    public function delete($id);
}