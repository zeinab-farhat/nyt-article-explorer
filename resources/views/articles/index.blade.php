@extends('layouts.app', ['page' => __('Articles'), 'pageSlug' => 'articles'])

@section('content')
    @include('alerts.success')

    @if (isset($message))
        <div id="notification" class="alert alert-success alert-dismissible fade show" role="alert" v-if="show">

            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="dismissAlert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-2">
                                    <h4 class="card-title">Articles</h4>
                                </div>
                                <div class="col-md-10">

                                    <div class="dropdown nav-item">
                                        <a href="#" class="dropdown-toggle nav-link text-right" data-toggle="dropdown">
                                            <div class="notification d-none d-lg-block d-xl-block"></div>
                                            <i class="tim-icons icon-settings-gear-63"></i>
                                            <p class="d-lg-none"> {{ __('Notifications') }} </p>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-navbar" style="background-color: #1e1e2f;
    padding: 19px;">
                                            <form action="{{ route('articles') }}" method="GET">
                                                <div class="row">
                                                    <div class="col-sm-4 mb-2">
                                                        <input type="text" name="title" class="form-control"
                                                               placeholder="Filter by Title"
                                                               value="{{ request('title') }}">
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <input type="text" name="url" class="form-control"
                                                               placeholder="Filter by URL" value="{{ request('url') }}">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="submit" class="btn btn-primary btn-block">Filter
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-8 mb-2">
                                                        <input type="text" name="search" class="form-control"
                                                               placeholder="Search by Title or URL"
                                                               value="{{ request('search') }}">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="submit" class="btn btn-primary btn-block">Search
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                    <th class="text-primary">Title</th>
                                    <th class="text-primary">URL</th>
                                    <th class="text-primary">Section</th>
                                    <th class="text-primary">Published Date</th>
                                    <th class="text-primary">Actions</th>
                                    </thead>
                                    <tbody>

                                    @foreach($articles as $article)
                                        <tr>
                                            <td>{{ $article["title"] }}</td>
                                            <td>{{ $article["url"] }}</td>
                                            <td>{{ $article["section"] }}</td>
                                            <td>{{ $article["published_date"] }}</td>
                                            <td>
                                                <a href="{{ route('article.view', ['id' => $article["id"]]) }}">
                                                    <i class=" tim-icons icon-alert-circle-exc p-1"></i>
                                                </a>

                                                <form action="{{ route('save-article') }}"
                                                      method="POST">
                                                    @csrf
                                                    <input type="hidden" name="uri" value="{{ $article['uri'] }}">

                                                    <button type="submit" class="heart-button">
                                                        <i class="tim-icons icon-heart-2 p-1"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="pagination justify-content-center">
                                    {{ $articles->setPath('/articles')->links('vendor.pagination.bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
