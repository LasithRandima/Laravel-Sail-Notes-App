<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Without Elqouent relations
        // $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        // With Elqouent relation we can done the same thing
        // $notes = Auth::user()->notes()->latest('updated_at')->paginate(5);

        //using inverse relationship
        $notes = Note::wherebelongsTo(Auth::user())->latest('updated_at')->paginate(5);


        // dd($notes);

        // $notes->each(function($note){
        //     dump($note->title);
        // });

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);

        // $note = New Note([
        //     'user_id' => Auth::id(),
        //     'title' => $request->title,
        //     'text' => $request->text,
        // ]);

        // $note->save();

        // Note::create([
        //     'uuid' => Str::uuid(),
        //     'user_id' => Auth::id(),
        //     'title' => $request->title,
        //     'text' => $request->text,
        // ]);

        //we can skip 'user_id' this way using relations
        Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return to_route('notes.index');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $uuid)
    // {
    //     // dd($id);
    //    $note = Note::where('uuid', $uuid)->where('user_id', Auth::id())->firstOrfail();
    //    return view('notes.show')->with('note', $note);
    // }

        /**
     * Show Method by Route Model binding
     */
    public function show(Note $note) //route model binding
    {
        // if($note->user_id != Auth::id()){
        //     return abort(403);
        // }

        //using eloquant relationships
        if($note->user != Auth::user()){
            return abort(403);
        }

       return view('notes.show')->with('note', $note);
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if($note->user_id != Auth::id()){
            return abort(403);
        }

       return view('notes.edit')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        // dd($request);

        if($note->user_id != Auth::id()){
            return abort(403);
        }


        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);


        $note->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);

       return to_route('notes.show', $note)->with('success', "Note Updated succesfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        // dd($note);
        if($note->user_id != Auth::id()){
            return abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('success', 'Note moved to trash');

    }
}
