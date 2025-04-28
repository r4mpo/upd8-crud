<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface renderTemplate
{
    public function renderizar(): JsonResponse;
}