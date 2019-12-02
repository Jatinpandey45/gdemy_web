<?php

namespace App\Http\Controllers;

use App\AdminJobPosts;
use App\Category;
use App\MonthTags;
use Illuminate\Http\Request;
use App\Posts;
use App\Tags;
use Symfony\Component\HttpFoundation\Response;

class TrashController extends Controller
{
    public function updateStatusAsTrash(Request $request)
    {

        $table = $request->get('type');
        $data =  decrypt($request->get('id'));

        switch ($table) {

            case 'post':

                $post = Posts::find($data['id']);
                $post->delete();

                break;

            case 'category':

                $category = Category::find($data['id']);

                $category->delete();

                break;


            case "tags":

                $tags = Tags::find($data['id']);
                $tags->delete();

                break;

            case "month":

                $month = MonthTags::find($data['id']);
                $month->delete();

                break;

            case "jobs":

                $jobs = AdminJobPosts::find($data['id']);
                $jobs->delete();

                break;



            default:
                break;
        }


        $http_response_header = [
            'code' => Response::HTTP_OK,
            'message' => "Removed"
        ];

        return response()->json($http_response_header);
    }
}
