<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use DB;

class CommentController extends Controller
{
    // Display a listing of comments
   public function index(Request $request)
{
    $query = Comment::query();

    if ($request->has('blog_id') && $request->blog_id != '') {
        $query->where('blog_id', $request->blog_id);
    }

    if ($request->has('name') && $request->name != '') {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->has('email') && $request->email != '') {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    if ($request->has('approve') && $request->approve != '') {
        $query->where('approve', $request->approve);
    }

    $comments = $query->latest()->paginate(10);

    $blogs = DB::table('blogs')->select('id', 'title')->get(); // for filter dropdown

    return view('admin.Comments.index', compact('comments', 'blogs'));
}

    // Store a newly created comment
    public function store(Request $request, $blogId)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'comment' => 'required|string',
    ]);

    Comment::create([
        'blog_id' => $blogId,
        'name' => $request->name,
        'email' => $request->email,
        'comment' => $request->comment,
        'approve' => 0,
    ]);

    return back()->with('success', 'Comment submitted successfully!');
}

    // Approve a comment
public function approve($id)
{
    $comment = Comment::findOrFail($id);
    
    // Toggle the approval status
    $comment->update(['approve' => !$comment->approve]);

    $message = $comment->approve ? 'Comment approved successfully!' : 'Comment rejected successfully!';

    return back()->with('success', $message);
}

    // Delete a comment
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
