<?php
/**
 * User : YuGang Yang
 * Date : 6/10/15
 * Time : 18:49
 * Email: smartydroid@gmail.com
 */

namespace App\Http\Controllers\Forone\Controllers\Carousel;

use App\Carousel;
use App\Http\Controllers\Forone\Controllers\BaseController;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class CarouselController extends BaseController {

    function __construct()
    {
        parent::__construct('permissions', '权限');
    }

    public function index()
    {
        $results = [
            'columns' => [
                ['编号', 'id'],
                ['图片路径', 'img'],
                ['图片描述', 'desc'],
                ['跳转路径', 'url'],
                ['创建时间', 'created_at'],
                ['更新时间', 'updated_at'],
                ['操作', 'buttons', function ($data) {
                    $buttons = [
                        ['编辑'],
                    ];
                    return $buttons;
                }]
            ]
        ];
        $paginate = Carousel::orderBy('id','desc')->paginate();
        $results['items'] = $paginate;

        return $this->view('forone::' . $this->uri.'.index', compact('results'));
    }

    /**
     *
     * @return View
     */
    public function create()
    {
        return $this->view('forone::'.$this->uri.'.create');
    }

    /**
     *
     * @param CreateRoleRequest $request
     * @return View
     */
    public function store(Request $request)
    {
        Carousel::create($request->except('id', '_token'));
        return $this->toIndex('保存成功');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Carousel::find($id);
        if ($data) {
            return view('forone::' . $this->uri."/edit", compact('data'));
        } else {
            return $this->redirectWithError('数据未找到');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {

        $data = $request->except('_token');
        Carousel::findOrFail($id)->update($data);

        return $this->toIndex('编辑成功');
    }

}