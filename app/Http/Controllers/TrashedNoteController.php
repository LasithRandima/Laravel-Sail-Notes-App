<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashedNoteController extends Controller
{
    public function index(){
        $notes = Note::wherebelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate(5);
        return view('notes.index', compact('notes'));
    }

    public function show(Note $note){
        // dd($note);
        if($note->user != Auth::user()){
            return abort(403);
        }

        return view('notes.show')->with('note', $note);
    }

    public function update(Note $note){

        if($note->user != Auth::user()){
            return abort(403);
        }

        $note->restore();

        return to_route('notes.show' , $note)->with('success', "note restored");
    }

    public function destroy(Note $note){

        if($note->user != Auth::user()){
            return abort(403);
        }

        $note->forceDelete();

        return to_route('notes.index' , $note)->with('success', "Note Deleted Forever");
    }
}
