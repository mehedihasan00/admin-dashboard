<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function message() {
        $messages = Message::latest()->get();
        return view('pages.admin.message', compact('messages'));
    }
    public function messageInsert(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|min:4|max:255',
            'subject' => 'required|min:8|max:255',
            'message' => 'required|min:12',      
        ]);
        try {
            DB::beginTransaction();
            $message = new Message;
            $message->name = $request->name;
            $message->email = $request->email;
            $message->subject = $request->subject;
            $message->message = $request->message;
            $message->created_at = Carbon::now();
            $message->save();
            DB::commit();
            return redirect()->back()->with('success', 'Your message is sent!');
        } catch (\Exception $e) {
            DB::rollback();           
		    // return ["error" => $e->getMessage()];
            return redirect()->back()->with('error', 'Your message isn\'t delivered!');
        }
    }
    public function messageDelete($id) {
        $message = Message::find($id);
        $message->delete();
        return Redirect()->back()->with("success", "Message Deleted Successfully");
    }
}
