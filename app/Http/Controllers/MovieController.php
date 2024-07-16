<?php

namespace App\Http\Controllers;

use App\Mail\ReplyMail;
use App\Models\Movies;
use App\Models\MoviesUrl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MovieController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (! $user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $movies = $user->movies()->get();

        return response()->json($movies);
    }

    public function create()
    {
        return view('admin.movie.create');
    }

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
            $folder = $request->category === 'movies' ? 'movies' : 'webseries';
            $filename = $request->file('pic')->getClientOriginalName();
            $directory = public_path($folder);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            $path = $request->file('pic')->move($directory, $filename);
            $movie->pic = $folder.'/'.$filename;
        }

        $movie->save();

        if ($request->urls) {
            foreach ($request->urls as $index => $url) {
                if (!empty($url)) {
                    $movieUrl = new MoviesUrl();
                    $movieUrl->movies_id = $movie->id;
                    $movieUrl->url = $url;
                    $movieUrl->file_size = $request->size[$index];
                    $movieUrl->save();
                }
            }
        }

        return redirect('/dashboard')->with('success', 'Movie or Webseries Added Successfully!');
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

    public function show(string $id)
    {
        $data['movie'] = Movies::with('movieurl')->findOrFail($id);

        return view('admin.movie.show', $data);
    }

    public function ushow(string $id)
    {
        $data['movie'] = Movies::with('movieurl')->findOrFail($id);

        return view('admin.movie.show', $data);
    }

    public function edit(string $id)
    {
        $data['movies'] = Movies::with('movieurl')->findOrFail($id);

        return view('admin.movie.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dirname' => 'required|string|max:255',
            'rdate' => 'required',
            'pic' => 'nullable|image|max:10240',
            'desc' => 'required|string',
            'category' => 'required|string|in:movies,webseries',
            'status' => 'required|string|in:active,inactive',
        ]);

        $movie = Movies::findOrFail($id);

        $movie->name = $request->name;
        $movie->dirname = $request->dirname;
        $movie->rdate = $request->rdate;
        $movie->desc = $request->desc;
        $movie->category = $request->category;
        $movie->status = $request->status;

        $existingUrls = MoviesUrl::where('movies_id', $movie->id)->get()->keyBy('url');

        if ($request->urls) {
            foreach ($request->urls as $index => $url) {
                if (!empty($url)) {
                    if (isset($existingUrls[$url])) {
                        $movieUrl = $existingUrls[$url];
                        if ($movieUrl->file_size != $request->size[$index]) {
                            $movieUrl->file_size = $request->size[$index];
                            $movieUrl->save();
                        }
                    } else {
                        $movieUrl = new MoviesUrl();
                        $movieUrl->movies_id = $movie->id;
                        $movieUrl->url = $url;
                        $movieUrl->file_size = $request->size[$index];
                        $movieUrl->save();
                    }
                }
            }
        }

        if ($request->hasFile('pic')) {
            $folder = $request->category === 'movies' ? 'movies' : 'webseries';
            $filename = $request->file('pic')->getClientOriginalName();
            $directory = public_path($folder);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            $path = $request->file('pic')->move($directory, $filename);
            $movie->pic = $folder.'/'.$filename;
        }

        $movie->save();

        return redirect()->route('dashboard')->with('success', 'Movie updated successfully');
    }



    public function destroy(string $id)
    {
        //
    }
}
