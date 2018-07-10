<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class OtherRouteController extends Controller
{
    public function index(Request $request, Response $response)
    {
        if ($request->getMethod() === Request::METHOD_OPTIONS) {
            return $this->options($request, $response);
        }

        return "Path [" . $request->path() . "] not found.";
    }

    /**
     * Before send a original ajax request to server,
     * browser sends a OPTIONS request to server to determine
     * allowed methods, headers and origins.
     * This controller just responses to client with allowed header information
     * For more information please follow the @see section
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS (see Functional overview section)
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    protected function options(Request $request, Response $response)
    {
        $origin = $request->header('origin') ?: $request->url();

        return $response
            ->header('Access-Control-Allow-Origin', $origin)
            ->header('Access-Control-Allow-Headers', 'origin, content-type, accept, authorization')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH');
    }
}
