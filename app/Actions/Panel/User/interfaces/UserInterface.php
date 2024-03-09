<?php
namespace App\Actions\Panel\User\interfaces;

interface UserInterface
{
    public function users($request);
    public function store($request);
    public function update($request, int $id);
    public function destroy($request);
    public function block($request);
    public function unblock($request);
}
