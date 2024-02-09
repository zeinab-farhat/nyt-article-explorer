
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

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                    <th class="text-primary">ID</th>
                                    <th class="text-primary">Title</th>
                                    <th class="text-primary">Section</th>
                                    <th class="text-primary">Url</th>
                                    <th class="text-primary">Published Date</th>
                                    <th class="text-primary">Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($articles as $article)
                                        <tr>
                                            <td>{{ $article["id"] }}</td>
                                            <td>{{ $article["title"] }}</td>
                                            <td>{{ $article["section"] }}</td>
                                            <td>{{ $article["url"] }}</td>
                                            <td>{{ $article["published_date"] }}</td>
                                            <td>
                                                <a href="{{ route('article.view', ['id' => $article["id"]]) }}">
                                                    <i class=" tim-icons icon-alert-circle-exc"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
{{--                            {{ $articles->setPath('/articles')->links() }} <!-- Render pagination links with custom base path -->--}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Pagination Navigation */
    nav[role="navigation"].flex.items-center.justify-between {
        margin-top: 20px; /* Adjust spacing as needed */
    }

    /* Previous and Next Buttons */
    .relative.inline-flex.items-center.px-4.py-2.text-sm.font-medium.text-gray-700.bg-white.border.border-gray-300.leading-5.rounded-md {
        color: #5e72e4; /* Text color */
        border-color: #5e72e4; /* Border color */
    }

    .relative.inline-flex.items-center.px-4.py-2.text-sm.font-medium.text-gray-700.bg-white.border.border-gray-300.leading-5.rounded-md:hover {
        color: #2e64e7; /* Text color on hover */
        border-color: #2e64e7; /* Border color on hover */
    }

    /* Disabled Next Button */
    .relative.inline-flex.items-center.px-2.py-2.-ml-px.text-sm.font-medium.text-gray-500.bg-white.border.border-gray-300.cursor-default.rounded-r-md.leading-5[aria-disabled="true"] {
        color: #8898aa; /* Text color */
        border-color: #cad1d7; /* Border color */
    }

    /* Active Page Number */
    .relative.inline-flex.items-center.px-4.py-2.-ml-px.text-sm.font-medium.text-gray-500.bg-white.border.border-gray-300.cursor-default.leading-5[aria-current="page"] {
        color: #fff; /* Text color */
        background-color: #5e72e4; /* Background color */
        border-color: #5e72e4; /* Border color */
    }

</style>
