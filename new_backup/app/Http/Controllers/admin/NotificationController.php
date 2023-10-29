<?php

namespace App\Http\Controllers\admin;

use App\Models\EmailNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function manage_notifications()
    {
        $allow_mails = EmailNotification::first();

        return view('admin.notifications.notifications', get_defined_vars());
    }

    public function allow_mail(Request $request)
    {
        // dd($request);
        // EmailNotification::where('id', $request->id)->update(array($request->mail_to => $request->allow_mail));
        $flight = EmailNotification::updateOrCreate(
            ['id' => $request->id],
            [$request->mail_to => $request->allowed_mail]
        );

        return response()->json(['code'=>'200', 'success' => 'success']);
    }
}
