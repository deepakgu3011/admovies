<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movies;
use App\Mail\ReplyMail;
use App\Models\MoviesUrl;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'dirname' => 'required|string|max:255',
            'rdate' => 'required|',
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string',
            'desc' => 'required|string',
        ]);

        $movie = new Movies();
        $movie->user_id = $request->user_id;
        $movie->name = $request->name;
        $movie->dirname = $request->dirname;
        $movie->rdate = $request->rdate;
        $movie->category = $request->category;
        $movie->status ='active';
        $movie->desc = $request->desc;

        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $movie->pic = $name;
        }

        $movie->save();

        if ($request->urls) {
            foreach ($request->urls as $index => $url) {
                if (!empty($url)) {
                    $movieUrl = new MoviesUrl();
                    $movieUrl->movie_id = $movie->id;
                    $movieUrl->url = $url;
                    $movieUrl->file_size = $request->size[$index];
                    $movieUrl->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Movie or Webseries Added Successfully!');
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
            'name' => 'required|string|max:255',
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

    // Ensure the directory exists
    $directory = public_path($folder);
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
    }

    // Store the file in the public folder
    $path = $request->file('pic')->move($directory, $filename);
    $data['pic'] = $folder . '/' . $filename; // Adjust the path for saving in the database
} else {
    return redirect()->back()->withErrors(['pic' => 'No file uploaded.']);
}

// Assuming you already have the $movie instance to be updated
$movie->update($data);

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
