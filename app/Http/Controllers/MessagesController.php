<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $messages = Message::with('userFrom')->where('user_id_to', Auth::user()->id)->notDeleted()->get();
        // dd($messages);
        return view('home',[
            'messages' => $messages,
        ]);
    }
    public function create(Request $request, int $id = 0, String $subject = ''){
        if ($id === 0) {
            $users = User::where('id', '!=', Auth::id())->get();
        } else {
            $users = User::where('id', $id)->get();
        }
        if ($subject !== '') $subject = 'Re: ' . $subject;
        return view('create',[
            'users' => $users,
            'subject' => $subject
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'user' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $message = new Message();
        $message->user_id_to = $request->input('user');
        $message->user_id_from = Auth::user()->id;
        $message->subject = $request->input('subject');
        $message->body = $request->input('message');
        $message->save();

        return redirect('/create')->with('success', 'message sent successfully');

    }
    public function sentMessages(Request $request){

        $messages = Message::with('userTo')->where('user_id_from', Auth::user()->id)->get();

        return view('sentmessages',[
            'messages' => $messages,
        ]);
    }

    public function ReadMessages(int $id) {
        $message = Message::with('userFrom')->find($id);
        $message->read = true;
        $message->save();

        return view('read')->with('message', $message);
    }
    public function delete(int $id) {
        $message = Message::find($id);
        $message->deleted = true;
        $message->save();

        return redirect()->to('/home')->with('status', 'Message deleted successfully!');
    }

    public function deleted() {
        $messages = Message::with('userFrom')->where('user_id_to', Auth::id())->deleted()->get();

        return view('deleted')->with('messages', $messages);
    }

    public function return(int $id) {
        $message = Message::find($id);
        $message->deleted = false;
        $message->save();

        return redirect()->to('/home');
    }
}
