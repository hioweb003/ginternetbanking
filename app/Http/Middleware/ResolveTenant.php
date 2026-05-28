<?php

namespace App\Http\Middleware;

use App\Models\Institution;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

     $institution = $request->route('institution');

        $tenant = Institution::where('name',$institution)->first();

        if (!$tenant) {
            abort(404);
        }
        //dd($tenant);

        // Share tenant globally
        app()->instance('tenant', $tenant);
        
        View::share('tenant', $tenant);

         config([
            'pwa.manifest.name' => $tenant->name,
            'pwa.manifest.short_name' => Str::initials($tenant->name,capitalize: true),
            'pwa.manifest.background_color' => $tenant->color_one,
            'pwa.manifest.theme_color' => $tenant->color_one,
            'pwa.manifest.icons' => [
                [
                    'src' => app()->environment('production')
                        ? url(env('STORAGE_PATH') . $tenant->logo)
                        : asset('storage/' . $tenant->logo),
                    'sizes' => '512x512',
                    'type' => 'image/png',
                ],
            ],
        ]);


        return $next($request);
    }
}
