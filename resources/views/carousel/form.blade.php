
{!! Form::multi_file_upload('name','图片地址',0.5) !!}
{!! Form::group_text('desc','简介','请输入图片描述') !!}
{!! Form::group_text('url','跳转地址','请输入跳转地址') !!}


@section('js')
    @parent
@stop