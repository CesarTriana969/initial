<?php
namespace App\Actions\Panel\User\interfaces;

interface PermissionInterface
{
    public function permissions($request);
    public function allPermissions();
}
