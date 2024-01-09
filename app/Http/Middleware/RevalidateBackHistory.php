<?php
namespace App\Http\Middleware;
use Closure;

class RevalidateBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(
            stripos($request->getRequestUri(), "/delivery-rate/export-sample-rate") !== false ||
            stripos($request->getRequestUri(), "/delivery-rate/export-table-rate") !== false ||
            stripos($request->getRequestUri(), "/order/sold-items/export") !== false ||
            stripos($request->getRequestUri(), "/data-tool/data-feed/sample-download") !== false ||
            stripos($request->getRequestUri(), "/newsletter/file-export") !== false ||
            stripos($request->getRequestUri(), "/purchased-materials/file-export") !== false

        ){
            return $next($request);
        }
        else{
            $response = $next($request);
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache')
                ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        }

    }
}
