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
        'status'=> 'required']);




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
        $data['status']="active";
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
        $data['movie']=Movies::findorfail($id);
        return view('admin.movie.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['movies']=Movies::findorfail($id);
        return view('admin.movie.edit',$data);
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:movies/series,name',
            'dirname' => 'required|string|max:255',
            'rdate' => 'required',
            'pic' => 'nullable|image|max:10240',
            'url' => 'required|url',
            'desc' => 'required|string',
            'category' => 'required|string|in:movies,webseries',
            'status' => 'required|string|in:active,inactive',
        ]);

        $movie = Movies::findOrFail($id);

        $movie->name = $request->name;
        $movie->dirname = $request->dirname;
        $movie->rdate = $request->rdate;
        $movie->desc = $request->desc;
        $movie->url = $request->url;
        $movie->category = $request->category;
        $movie->status = $request->status;

        // Handle pic upload
        if ($request->hasFile('pic')) {
            $folder = $request->category === 'movies' ? 'movies' : 'webseries';
            $filename = $request->file('pic')->getClientOriginalName();
            $path = $request->file('pic')->storeAs('public/' . $folder, $filename);
            $data['pic'] = 'storage/' . $folder . '/' . $filename;
        } else {
            return redirect()->back()->withErrors(['pic' => 'No file uploaded.']);
        }

        $movie->save();


        return redirect()->route('dashboard')->with('success', 'Movie updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
