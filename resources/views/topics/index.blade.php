@extends('layouts.app')

@section('content')
<!-- Topic -->
<div class="container">
    <div class="row">
        <div class="col-sm-8 section-topic">
            <!-- HotNode -->
            <div class="section-hotNode">
                @foreach ($nodeCategorys as $category)
                    <span  class="{{ @$_GET['category'] == $category->id ? 'selected' : '' }} label label-default">
                        <a href="{{ route('topic.index', ['category' => $category->id, 'filter' => isset($_GET['filter']) ? $_GET['filter'] : '']) }}">{{ $category->name }}</a>
                    </span>
                @endforeach
            </div>

            <div class="panel panel-default" id="section-items-topic">
                <div class="panel-heading">
                    {{ i18n('app.Topics') }}

                    <!-- Filter -->
                    <div class="filter">
                        <a class="{{ @$_GET['filter'] === 'recent' ? 'selected' : '' }}" href="{{ route('topic.index', ['category' => isset($_GET['category']) ? $_GET['category'] : '', 'filter' => 'recent']) }}">
                            {{ i18n('app.Recent') }}
                        </a>
                        <a class="{{ @$_GET['filter'] === 'vote' ? 'selected' : '' }}" href="{{ route('topic.index', ['category' => isset($_GET['category']) ? $_GET['category'] : '', 'filter' => 'vote']) }}">
                            {{ i18n('app.Vote') }}
                        </a>
                        <a class="{{ @$_GET['filter'] === 'noreply' ? 'selected' : '' }}" href="{{ route('topic.index', ['category' => isset($_GET['category']) ? $_GET['category'] : '', 'filter' => 'noreply']) }}">
                            {{ i18n('app.NoReply') }}
                        </a>
                    </div>

                    <!-- Shortcut -->
                    <div class="pull-right shortcut">
                        <a href="{{ route('topic.create') }}">{{ i18n('app.Create Topic') }}</a>
                    </div>
                </div>
                <div class="panel-body">
                    @include('snippets.items-topic', ['topics' => $topics, 'colType' => 'col-sm-12'])
                </div>
            </div>
         </div>

        <div class="col-sm-4">
            <div style="height:35px">
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Community</div>
                <div class="panel-body">
                    hello dev4living/Community
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Category  -->
@include('snippets.panel-category')

@endsection
