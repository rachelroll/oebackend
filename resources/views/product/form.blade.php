
{!! Form::group_text('name','产品名称','请输入产品名称') !!}
{!! Form::group_text('attr','产品属性','请输入产品属性') !!}
{!! Form::group_text('intro','产品简介','请输入产品简介') !!}
{!! Form::group_text('price','产品价格','请输入产品价格') !!}
{{--{!! Form::ueditor('desc','产品详情','0.5') !!}--}}
{!! Form::multi_file_upload('imgs','产品细节图') !!}
{{--{!! Form::multi_file_upload('cover','产品封面图') !!}--}}
{!! Form::single_file_upload('cover','商品封面') !!}
