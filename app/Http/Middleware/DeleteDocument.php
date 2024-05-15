<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DeleteDocument
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $document = $request->route('document');

        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if ($user->id === $document->user_id || $user->is_admin === true) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
