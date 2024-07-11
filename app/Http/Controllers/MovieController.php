<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movies;
use App\Mail\ReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
    if (!$user) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    $movies = $user->movies()->get(); // Assuming 'movies' is a relationship defined in your User model
    return response()->json($movies);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.movie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'dirname' => 'required|string|max:255',
            'rdate' => 'required',
            'pic' => 'required|max:10240',
            'url' => 'required|url',
            'desc' => 'required|string',
            'category' => 'required|string|in:movies,webseries',
            'user_id' => 'required',
        ]);

        $data = $request->except('pic');

        // Handle the file upload
        if ($request->hasFile('pic')) {
            $folder = $request->category === 'movies' ? 'movies' : 'webseries';
            $filename = $request->file('pic')->getClientOriginalName();
            $path = $request->file('pic')->storeAs('public/' . $folder, $filename);
            $data['pic'] = 'storage/' . $folder . '/' . $filename;
        } else {
            return redirect()->back()->withErrors(['pic' => 'No file uploaded.']);
        }

        $data['user_id'] = auth()->user()->id;

            Movies::create($data);

        return redirect('dashboard')->with('success', 'Movie created successfully!');
    }


    public function sendReply(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'replyMessage' => 'required|string',
        ]);

        $email = $request->input('email');
        $message = $request->input('replyMessage');

        Mail::to($email)->send(new ReplyMail($message));

        return response()->json(['message' => 'Reply sent successfully.']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
