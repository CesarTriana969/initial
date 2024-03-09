<?php

namespace App\Actions\Panel\Role\Interfaces;

interface RoleInterface
{
    public function roles($request);
    public function store($request);
    public function update($request, int $id);
    public function rolesName();
    public function permissions();
}
