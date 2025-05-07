<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Topic::select('id','name','description')
        ->orderBy('created_at','desc')
        ->paginate(5);
        return view('backend.topic.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.topic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request)
    {
        $request->validate([
            'name'        => 'required|string|max:1000',
            'slug'        => 'required|string|max:1000|unique:topic,slug',
            'description' => 'nullable|string|max:255',
            'status'      => 'required|boolean',
        ]);
    
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->slug = $request->slug;
        $topic->description = $request->description;
        $topic->status = $request->status;
        $topic->created_by = 1; // hoặc Auth::id()
        $topic->updated_by = 1; // hoặc Auth::id()
        $topic->created_at = now();
        $topic->updated_at = now();
        $topic->save();
    
        return redirect()->route('topic.index')->with('success', 'Thêm chủ đề thành công!');
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
