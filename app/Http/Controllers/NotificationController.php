<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function new(Request $request)
    {

        try {
            DB::beginTransaction();
            //create a notification
            $notification = new Notification();
            $notification->notification_title = $request->input('notification_title');
            $notification->notification_content = $request->input('notification_content');
            $notification->created_by = Auth::guard('api')->user()->id;

            $notification->save();
            // insert data to role_user table
            $users = User::where('role', ADMIN_ROLE)->get();

            $notification->users()->attach($users);

            DB::commit();

            return response()->json([
                "notification" => $notification
            ], 200);

        } catch (\Exception $exception) {
            dd($exception->getMessage());
            DB::rollBack();
        }

    }
}
