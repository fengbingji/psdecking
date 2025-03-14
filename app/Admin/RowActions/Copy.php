<?php

namespace App\Admin\RowActions;

use Dcat\Admin\Grid\RowAction;
use Illuminate\Http\Request;

class Copy extends RowAction
{
    protected $model;

    public function __construct(?string $model = null)
    {
        $this->model = $model;
    }

    /**
     * 标题
     *
     * @return string
     */
    public function title()
    {
        return '<i class="feather icon-copy"></i> 复制';
    }

    /**
     * 设置确认弹窗信息，如果返回空值，则不会弹出弹窗
     *
     * 允许返回字符串或数组类型
     *
     * @return array|string|void
     */
    public function confirm()
    {
        return [
            // 确认弹窗 title
            '您确定要复制这行数据吗？',
            // 确认弹窗 content
            $this->row->id,
        ];
    }

    /**
     * 处理请求
     *
     *
     * @return \Dcat\Admin\Actions\Response
     */
    public function handle(Request $request)
    {
        // 获取当前行ID
        $id = $this->getKey();

        $model = $request->get('model');
        switch ($model) {
            case 'App\Models\Article':
                $fill = ['publish' => 0];
                break;
            default:
                $fill = ['is_publish' => 0];
                break;
        }

        // 复制数据
        $model::find($id)->replicate()->fill($fill)->save();

        // 返回响应结果并刷新页面
        return $this->response()->success("复制成功: [{$id}]")->refresh();
    }

    /**
     * 设置要POST到接口的数据
     *
     * @return array
     */
    public function parameters()
    {
        return [
            // 把模型类名传递到接口
            'model' => $this->model,
        ];
    }
}
