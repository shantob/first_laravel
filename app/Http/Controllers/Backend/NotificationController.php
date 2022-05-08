<?php

namespace App\Http\Controllers\Backend;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $notifications = Auth::user()->notifications;
        //return $notifications;
        return view('backend.notification.index',compact('notifications'));
    }
    public function show($id)
    {
        $notification = Auth::user()->notifications->where('id',$id)->first();
        $notification->markAsRead();
        return redirect()->route('admin.comment.show',$notification->data['data']['id']);
    }
}
