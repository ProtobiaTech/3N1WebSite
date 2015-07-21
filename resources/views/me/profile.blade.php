@extends('layouts.app')

@section('content')
<div id="cy-me" class="page-index">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('me/snippet-userProfile')
            </div>

            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div style="height:300px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
