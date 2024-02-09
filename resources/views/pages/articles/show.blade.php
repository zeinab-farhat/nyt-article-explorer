@extends('layouts.app', ['activePage' => 'article-management','pageSlug' => 'articles', 'titlePage' => __('Article Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ $article['title'] }}</h4>
                            <p class="card-category">Published Date: {{ $article['published_date'] }}</p>
                        </div>
                        <div class="card-body">
                            <p class="font-weight-bold">Section:</p>
                            <p>{{ $article['section'] }}</p>

                            <p class="font-weight-bold">Subsection:</p>
                            <p>{{ $article['subsection'] }}</p>

                            <p class="font-weight-bold">Byline:</p>
                            <p>{{ $article['byline'] }}</p>

                            <p class="font-weight-bold">Abstract:</p>
                            <p>{{ $article['abstract'] }}</p>

                            <!-- Displaying descriptive facets -->
                            <h5 class="font-weight-bold">Descriptive Facets:</h5>
                            <ul class="list-unstyled">
                                @foreach ($article['des_facet'] as $facet)
                                    <li>{{ $facet }}</li>
                                @endforeach
                            </ul>

                            <!-- Displaying organizational facets -->
                            <h5 class="font-weight-bold">Organizational Facets:</h5>
                            <ul class="list-unstyled">
                                @foreach ($article['org_facet'] as $facet)
                                    <li>{{ $facet }}</li>
                                @endforeach
                            </ul>

                            <!-- Displaying personal facets -->
                            <h5 class="font-weight-bold">Personal Facets:</h5>
                            <ul class="list-unstyled">
                                @foreach ($article['per_facet'] as $facet)
                                    <li>{{ $facet }}</li>
                                @endforeach
                            </ul>

                            <!-- Displaying geographical facets -->
                            <h5 class="font-weight-bold">Geographical Facets:</h5>
                            <ul class="list-unstyled">
                                @foreach ($article['geo_facet'] as $facet)
                                    <li>{{ $facet }}</li>
                                @endforeach
                            </ul>

                            <!-- Displaying media -->
                            <h5 class="font-weight-bold">Media:</h5>
                            @foreach ($article['media'] as $media)
                                <img src="{{ $media['media-metadata'][0]['url'] }}" alt="{{ $media['caption'] }}" class="img-fluid">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
