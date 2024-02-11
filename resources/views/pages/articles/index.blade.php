@extends('layouts.app', ['page' => __('Articles'), 'pageSlug' => 'articles'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="card-title">Articles</h4>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('pages.articles') }}" method="GET">
                                        <div class="input-group">
                                            <div class="col">
                                                <input type="text" name="title" class="form-control"
                                                       placeholder="Search by Title" value="{{ request('title') }}">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="url" class="form-control"
                                                       placeholder="Search by URL" value="{{ request('url') }}">
                                            </div>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                    <th class="text-primary">Title</th>
                                    <th class="text-primary">Section</th>
                                    <th class="text-primary">Url</th>
                                    <th class="text-primary">Published Date</th>
                                    <th class="text-primary">Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($articles as $article)
                                        <tr>
                                            <td>{{ $article["title"] }}</td>
                                            <td>{{ $article["section"] }}</td>
                                            <td>{{ $article["url"] }}</td>
                                            <td>{{ $article["published_date"] }}</td>
                                            <td>
                                                <a href="{{ route('article.view', ['id' => $article["id"]]) }}">
                                                    <i class=" tim-icons icon-alert-circle-exc p-1"></i>
                                                </a>

                                                <form action="{{ route('save-article', ['id' => $article['id']]) }}"
                                                      method="POST">
                                                    @csrf
                                                    <button type="submit" class="heart-button">
                                                        <i class="tim-icons icon-heart-2 p-1"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="row justify-content-center">
                                            <div class="col-md-6">

                                            </div>
                                        </div>
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
