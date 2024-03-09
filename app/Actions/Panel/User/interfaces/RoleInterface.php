<?php
namespace App\Actions\Panel\User\interfaces;

interface RoleInterface
{
    public function roles($request);
    public function store($request);
    public function rolesName();
}
