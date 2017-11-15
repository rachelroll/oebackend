<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Forone\Controllers\BaseController;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    function __construct()
    {
        parent::__construct('product','产品中心');
    }

    public function index()
    {
        $results = [
            'columns' => [
                ['产品名称', 'name'],
                ['产品详情', 'desc'],
                ['产品细节图', 'imgs'],
                ['产品封面图', 'cover'],
                ['产品简介', 'intro'],
                ['产品价格', 'price'],
                ['产品属性', 'attr'],
                ['创建时间', 'created_at'],
                ['操作', 'buttons', function ($data) {
                    $buttons = [
                        ['编辑'],
                        ['查看'],
                        [
                            'uri' => route('admin.product.destroy', ['id' => $data->id]),
                            'method' => 'DELETE',
                            'name' => '删除',
                            'id' => $data->id,
                        ]
                    ];
                    return $buttons;
                }],
            ],
        ];

        $paginate = Product::orderBy('created_at', 'desc')->paginate();

        $results['items'] = $paginate;

        return $this->view('product.index', compact('results'));
    }

    public function create()
    {
        return $this->view('product.create');
    }

    public function store(Request $request)
    {

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
        Product::create($request->only(['name', 'desc']));

        return redirect()->route('admin.product.index');
    }


    public function edit($id)
    {
        $data = Product::findOrFail($id);
        if ($data) {
            return $this->view('product.edit', compact('data'));
        }else{
            return $this->redirectWithError('数据未找到');
        }
    }

    public function update(Request $request, $id)
    {
        Product::findOrFail($id)->update($request->only(['name', 'url', 'desc']));
        return redirect()->route('admin.product.index');
    }

    public function show($id)
    {
        $data = Product::findOrFail($id);
        if ($data) {
            return $this->view('product.show', compact('data'));
        }else{
            return $this->redirectWithError('数据未找到');
        }
    }

    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        if ($data) {
            $data->delete();
            return back();
        }else{
            return $this->redirectWithError('数据未找到');
        }
    }


}
