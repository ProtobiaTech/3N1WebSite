@extends('layouts.app')

@section('content')

<script src="{{ asset('bowerAssets/cropbox/jquery/cropbox-min.js') }}"></script>

<div id="cy-me" class="page-index">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('uc/snippet-myProfile')
            </div>

            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="caption">{{ trans('user.Update Avatar') }}</div>
                        <div class="wrapper-cropbox">
                            <div class="imageBox">
                                <div class="thumbBox"></div>
                                <div class="spinner" style="display: none">{{ trans('user.Please select an image') }}</div>
                            </div>
                            <div class="action" style="margin-top:5px;">
                                <input type="file" id="file" style="float:left; max-width:220px">
                                <input type="button" id="btnUpload" value="{{ trans('user.Update') }}" style="float: right">
                                <input type="button" id="btnZoomIn" value="+" style="float: right">
                                <input type="button" id="btnZoomOut" value="-" style="float: right">
                                <div class="clearfix"></div>
                            </div>
                            <div class="cropped">
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(window).load(function() {
                                var options =
                                {
                                    thumbBox: '.thumbBox',
                                    spinner: '.spinner',
                                    imgSrc: ''
                                }
                                var cropper = $('.imageBox').cropbox(options);
                                $('#file').on('change', function(){
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        options.imgSrc = e.target.result;
                                        cropper = $('.imageBox').cropbox(options);
                                    }
                                    reader.readAsDataURL(this.files[0]);
                                    this.files = [];
                                })
                                $('#btnCrop').on('click', function(){
                                    var img = cropper.getAvatar()
                                    $('.cropped').append('<img src="'+img+'">');
                                })
                                $('#btnZoomIn').on('click', function(){
                                    cropper.zoomIn();
                                })
                                $('#btnZoomOut').on('click', function(){
                                    cropper.zoomOut();
                                })

                                // Upload
                                $('#btnUpload').on('click', function(){
                                    var img = cropper.getAvatar()
                                    $.post('{{ route("uc.update-avatar") }}', {avatar:img, _token:'{{ csrf_token() }}'}, function() {
                                        alert("{{ trans('user.avatar updated successfully') }}");
                                        location.reload();
                                    }).fail(function() {
                                        alert("{{ trans('user.avatar update failed') }}");
                                    });
                                })
                            });
                        </script>

                        <style>
                        .wrapper-cropbox {
                            width: 320px;
                            margin: 10px auto 10px;
                        }
                        .imageBox
                        {
                            position: relative;
                            height: 320px;
                            width: 320px;
                            border:1px solid #aaa;
                            background: #fff;
                            overflow: hidden;
                            background-repeat: no-repeat;
                            cursor:move;
                        }

                        .imageBox .thumbBox
                        {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            width: 200px;
                            height: 200px;
                            margin-top: -100px;
                            margin-left: -100px;
                            box-sizing: border-box;
                            border: 1px solid rgb(102, 102, 102);
                            box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.5);
                            background: none repeat scroll 0% 0% transparent;
                        }

                        .imageBox .spinner
                        {
                            position: absolute;
                            top: 0;
                            left: 0;
                            bottom: 0;
                            right: 0;
                            text-align: center;
                            line-height: 400px;
                            background: rgba(0,0,0,0.7);
                        }
                        </style>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
