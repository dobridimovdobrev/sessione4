<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\NotificationResource;
use App\Http\Resources\api\v1\NotificationCollection;
use App\Http\Requests\api\v1\NotificationStoreRequest;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Notification::class);

        $notifications = Notification::all();
        return new NotificationCollection($notifications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotificationStoreRequest $request)
    {
        $this->authorize('create', Notification::class);

        $validatedData = $request->validated();
        $notification = Notification::create($validatedData);

        return ResponseMessages::success(
            ['message' => 'Notification created successfully', 'notification' => new NotificationResource($notification)], 
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        $this->authorize('view', $notification);

        return new NotificationResource($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $this->authorize('delete', $notification);
        $notification->delete();
        return ResponseMessages::success('Notification deleted successfully', 204);
    }
}
