<?php

namespace App\Http\Middleware;

use App\Exceptions\MissingRoleException;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckForRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param array $roles
     * @return Response|RedirectResponse
     * @throws AuthenticationException
     * @throws MissingRoleException
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! $request->user()) {
            throw new AuthenticationException;
        }

        if ($request->user()->checkForRole($roles)) {
            return $next($request);
        }

        throw new MissingRoleException();
    }
}
