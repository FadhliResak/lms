<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inbox = Message::where('to_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        $sent = Message::where('from_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);

        return view('messages.index', compact('inbox', 'sent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::orderBy('name')->get();

        return view('messages.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'to_id' => ['required', 'exists:users,id'],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);
        $data['from_id'] = Auth::id();
        Message::create($data);

        return redirect()->route('messages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        if ($message->to_id === Auth::id() && ! $message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        if ($message->to_id === Auth::id() || $message->from_id === Auth::id()) {
            $message->delete();
        }

        return redirect()->route('messages.index');
    }
}
