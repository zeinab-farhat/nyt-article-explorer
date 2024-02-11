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
                            <!-- General Information Block -->
                            <div class="mb-4">
                                <h5 class="font-weight-bold">General Information</h5>
                                <p><span class="font-weight-bold">Section:</span> {{ $article['section'] }}</p>
                                <p><span class="font-weight-bold">Subsection:</span> {{ $article['subsection'] }}</p>
                                <p><span class="font-weight-bold">Byline:</span> {{ $article['byline'] }}</p>
                                <p><span class="font-weight-bold">Abstract:</span> {{ $article['abstract'] }}</p>
                            </div>

                            <!-- Descriptive Facets Block -->
                            <div class="mb-4">
                                <h5 class="font-weight-bold">Descriptive Facets</h5>
                                <ul class="list-unstyled">
                                    @foreach ($article['des_facet'] as $facet)
                                        <li>{{ $facet }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Descriptive Facets Block -->
                            <div class="mb-4">
                                <h5 class="font-weight-bold">Url</h5>:<p><a href="{{ $article['url'] }}">{{ $article['url'] }}</a></p>

                            </div>

                            <!-- Organizational Facets Block -->
                            <div class="mb-4">
                                <h5 class="font-weight-bold">Organizational Facets</h5>
                                <ul class="list-unstyled">
                                    @foreach ($article['org_facet'] as $facet)
                                        <li>{{ $facet }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Personal Facets Block -->
                            <div class="mb-4">
                                <h5 class="font-weight-bold">Personal Facets</h5>
                                <ul class="list-unstyled">
                                    @foreach ($article['per_facet'] as $facet)
                                        <li>{{ $facet }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Geographical Facets Block -->
                            <div class="mb-4">
                                <h5 class="font-weight-bold">Geographical Facets</h5>
                                <ul class="list-unstyled">
                                    @foreach ($article['geo_facet'] as $facet)
                                        <li>{{ $facet }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Media Block -->
                            <div>
                                <h5 class="font-weight-bold">Media</h5>
                                @foreach ($article['media'] as $media)
                                    <img src="{{ $media['media-metadata'][0]['url'] }}" alt="{{ $media['caption'] }}" class="img-fluid mb-2">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

