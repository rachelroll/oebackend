<?php

namespace App\Http\Controllers\Carousel;

use App\Carousel;
use App\Http\Controllers\Forone\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarouselController extends BaseController
{
    function __construct()
    {
        parent::__construct('carousel','轮播图');
    }



    public function index()
    {
        $results = [
            'columns' => [
                ['名称', 'name'],
                ['简介', 'desc'],
                ['跳转地址', 'url'],
                ['创建时间', 'created_at'],
                ['操作', 'buttons', function ($data) {
                    $buttons = [
                        ['编辑'],
                        ['查看'],
                        [
                            'uri' => route('admin.carousel.destroy', ['id' => $data->id]),
                            'method' => 'DELETE',
                            'name' => '删除',
                            'id' => $data->id,
                        ]
                    ];

                    return $buttons;
                }],
                ],
            ];

        $paginate = Carousel::orderBy('created_at', 'desc')->paginate();


        $results['items'] = $paginate;

        return $this->view('carousel.index', compact('results'));
    }

    public function create()
    {
        return $this->view('carousel.create');
    }

    public function store(Request $request)
    {
dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => '图片地址必填',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Carousel::create($request->only(['name', 'desc']));

        return redirect()->route('admin.carousel.index');
    }


    public function edit($id)
    {
        $data = Carousel::findOrFail($id);
        if ($data) {
            return $this->view('carousel.edit', compact('data'));
        }else{
            return $this->redirectWithError('数据未找到');
        }
    }

    public function update(Request $request, $id)
    {
        Carousel::findOrFail($id)->update($request->only(['name', 'url', 'desc']));
        return redirect()->route('admin.carousel.index');
    }

    public function show($id)
    {
        $data = Carousel::findOrFail($id);
        if ($data) {
            return $this->view('carousel.show', compact('data'));
        }else{
            return $this->redirectWithError('数据未找到');
        }
    }

    public function destroy($id)
    {
        $data = Carousel::findOrFail($id);
        if ($data) {
            $data->delete();
            return back();
        }else{
            return $this->redirectWithError('数据未找到');
        }
    }
}