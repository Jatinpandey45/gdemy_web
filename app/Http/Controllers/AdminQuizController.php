<?php

namespace App\Http\Controllers;

use App\Category;
use App\GkQuiz;
use App\Http\Requests\AdminQuizRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class AdminQuizController extends Controller
{

    const CORRECT_OPTIONS = [

        'option1' => 'Option1',
        'option2' => 'Option2',
        'option3' => 'Option3',
        'option4' => 'Option4'

    ];



    const SCHEDILE_ARRAY = [
        'morning' => "Morniing Dose",
        'evening' => "Evening Dose"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin/quiz/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $correct_options = self::CORRECT_OPTIONS;
        $scheduleTime = self::SCHEDILE_ARRAY;
        $category = Category::all();

        return view('admin/quiz/create', [
           'scheduleTime' => $scheduleTime,
           'category' => $category,
           'correct_options' => $correct_options
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminQuizRequest $request)
    {

        try
        {

            $category = $request->get('category');
            $firstCategory = array_pop($category);

            $storeQuiz = new GkQuiz;
            $storeQuiz->title = '--';
            $storeQuiz->question  = $request->get('question_text');
            $storeQuiz->question_slug  = $request->get('slug');
            $storeQuiz->schedule_type  = $request->get('schedule_id');
            $storeQuiz->option1  = $request->get('option1');
            $storeQuiz->option2  = $request->get('option2');
            $storeQuiz->option3  = $request->get('option3');
            $storeQuiz->option4  = $request->get('option4');
            $storeQuiz->correct_option  = $request->get('correct');
            $storeQuiz->code_sniff  = $request->get('code_snippet',null);
            $storeQuiz->publish_at  = $request->get('published_at');
            $storeQuiz->target_device  = $request->get('visibility');
            $storeQuiz->explanation  = $request->get('answer_explanation');
            $storeQuiz->category_id  = $firstCategory;

            $storeQuiz->save();

            $response = [
                'code' => Response::HTTP_OK,
                'message' => "You have added new quiz"
            ];
            

        }catch(Exception $e) {
            $response = [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }


        return Redirect::back()->with('success',$response);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }



    /**
     * quizList
     * @param : null
     * @return : application/json
     */

    public function quizList(Request $request)
    {
        $columns = array(
            'question',
            'schedule_type',
            'publish_at'
        );

        $limit = $request->input('length');
        $start = ($request->input('page') - 1) * $limit;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        if (!empty($request->input('search.value'))) {

            $search = $request->input('search.value');
            $category =  GkQuiz::where('question', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {

            $category = GkQuiz::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

       
        $data = array();
        
        if (!empty($category)) {
            foreach ($category as $row) {

                $nestedData['id'] = $row->id;
                $nestedData['question'] = $row->question;
                $nestedData['schedule_type'] = $row->schedule_type;
                $nestedData['publish_at'] = $row->publish_at;
                $nestedData['action'] = encrypt($nestedData);
                $nestedData['edit_route'] = route('posts.edit', encrypt($row->id));
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "data"            => $data
        );

        return response()->json($json_data);
    }









}
