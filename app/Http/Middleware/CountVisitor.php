<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor;

class CountVisitor
{
    public function handle(Request $request, Closure $next)
    {
        Visitor::updateOrCreate(
            ['page' => 'site'],
            ['count' => DB::raw('count + 1')]
        );

        return $next($request);
    }
}
