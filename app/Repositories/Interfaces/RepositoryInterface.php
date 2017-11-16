<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/10/17
 * Time: 5:33 PM
 */

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function getAll();
    public function store(array $attributes);
    public function update($id, array $attributes);
    public function find($column, $attribute);
    public function findById($attribute);
    public function destroy($id);

}