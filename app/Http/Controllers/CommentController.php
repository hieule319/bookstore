<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function userComment(Request $request)
    {
        $this->validate($request,[
            'comment' => 'required',
        ],[
            'comment.required' => 'Phải nhập nội dung bình luận',
        ]);
        $params = $request->except('_token','submit');
        
        $query = comment::insertComment($params);
        return back();
    }
}
