<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Posts;
use Symfony\Component\HttpFoundation\Response;

class TrashController extends Controller
{
    public function updateStatusAsTrash(Request $request)
    {

        $table = $request->get('type');
        $data=  decrypt($request->get('id'));
      
        switch($table)
        {

            case 'post' :

            $post = Posts::find($data['id']);
            $post->delete();

            break;

            case 'category':

            $category = Category::find($data['id']);

            $category->delete();

            break;

            default : 
            break;

        }


        $http_response_header = [
            'code' => Response::HTTP_OK,
            'message' => "Removed"
        ];

        return response()->json($http_response_header);

    }
}
