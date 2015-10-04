@extends('install.layout')

@section('content')
<div class="container">
    <div class="text-center" style="margin-bottom:30px">
        <h1><i class="fa fa-cubes"></i> 安装3N1WebSite</h1>
        <span class="text-muted">环境检查</span>
    </div>


    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('install.Item') }}</th>
                        <th>{{ trans('install.Value') }}</th>
                        <th>{{ trans('install.Require') }}</th>
                        <th>{{ trans('install.Resule') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ trans('install.PHP version') }}</td>
                        <td><?php echo phpversion(); ?></td>
                        <td>5.5.9</td>
                        <td>
                            @if (strnatcmp(phpversion(), '5.5.9') >= 0)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{ trans('install.Storage writable') }}</td>
                        <td>yes</td>
                        <td>yes</td>
                        <td>
                            <i class="fa fa-check text-success"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>

            <a href="{{ url('install/setup') }}" class="btn btn-primary btn-block">{{ trans('app.Next step') }}</a>
            <a href="" class="btn btn-default btn-block">{{ trans('install.Recheck') }}</a>
            <a href="{{ url('install') }}" class="btn btn-default btn-block">{{ trans('app.Prev step') }}</a>
        </div>
    </div>
</div>
@endsection
