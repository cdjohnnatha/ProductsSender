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
    public function store($request);
    public function update($id, $request);
    public function findById($attribute);
    public function destroy($id);

}