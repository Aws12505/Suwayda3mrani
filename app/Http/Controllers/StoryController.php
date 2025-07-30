<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::where('is_active', true)->latest()->paginate(9);
        $locale = app()->getLocale();
        
        return view('stories.index', compact('stories', 'locale'));
    }
    
    public function show($id)
    {
        $story = Story::where('is_active', true)->findOrFail($id);
        $locale = app()->getLocale();
        
        return view('stories.show', compact('story', 'locale'));
    }
}
