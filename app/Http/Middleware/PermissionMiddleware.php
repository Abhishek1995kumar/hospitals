<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\PermissionHelper;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware {
    public function handle($request, Closure $next, $permission) {
        // Helper ko permission ka action code pass kiya (jaise: 'dashboard.view')
        if (!PermissionHelper::hasPermission($permission)) {
            // Agar request AJAX hai to JSON response do, nahi to 403 Page aborter chalao
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Aapko is action ki permission nahi hai.'
                ], 403);
            }
            abort(403, 'Unauthorized Access.');
        }
        return $next($request);
    }
}
