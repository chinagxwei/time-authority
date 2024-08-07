<?php

namespace App\Http\Controllers;

use App\Events\SystemLogEvent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Event;

abstract class SystemController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $controller_event_text = self::class;

    /**
     * @param $code
     * @param $message
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function toJsonResponse($code, $message, $data)
    {
        $result = [
            'code' => $code,
            'message' => $message
        ];

        if (!empty($data)) {
            $result['data'] = $data;
        }

        return response()->json($result);
    }

    /**
     * @param $data
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data = null, $message = 'success')
    {
        return self::toJsonResponse(200, $message, $data);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function failResponse($message = 'fail')
    {
        return self::toJsonResponse(500, $message, null);
    }

    /**
     * @param $description
     * @return void
     */
    public function saveEvent($description)
    {
        Event::dispatch(SystemLogEvent::saveEvent($this->controller_event_text, $description));
    }

    /**
     * @param $description
     * @return void
     */
    public function deleteEvent($description)
    {
        Event::dispatch(SystemLogEvent::deleteEvent($this->controller_event_text, $description));
    }
}
