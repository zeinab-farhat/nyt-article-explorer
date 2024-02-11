@extends('layouts.app', ['activePage' => 'article-management', 'pageSlug' => 'articles', 'titlePage' => __('Article Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card article-card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ $article['title'] }}</h4>

                            @if (!empty($article['published_date']))
                                <p class="card-category">Published Date: {{ $article['published_date'] }}</p>
                            @endif

                        </div>
                        <div class="card-body">
                            <div class="article-section">
                                <h5 class="article-section-title">General Information</h5>

                                @if (!empty($article['section']))
                                    <p class="article-info"><span
                                            class="info-label">Section:</span> {{ $article['section'] }}</p>
                                @endif

                                @if (!empty($article['subsection']))
                                    <p class="article-info"><span
                                            class="info-label">Subsection:</span> {{ $article['subsection'] }}</p>
                                @endif

                                @if (!empty($article['byline']))
                                    <p class="article-info"><span
                                            class="info-label">Byline:</span> {{ $article['byline'] }}</p>
                                @endif

                                @if (!empty($article['abstract']))
                                    <p class="article-info"><span
                                            class="info-label">Abstract:</span> {{ $article['abstract'] }}</p>
                                @endif
                            </div>

                            <p class="article-info"><span
                                    class="info-label">Url:</span> <a
                                    href="{{ $article['url'] }}">{{ $article['url'] }}</a></p><br>

                            @if (!empty($article['org_facet']))
                                <div class="article-section">
                                    <h5 class="article-section-title">Organizational Facets</h5>
                                    <ul class="article-list">
                                        @foreach ($article['org_facet'] as $facet)
                                            <p class="article-info">{{ $facet }}</p>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (!empty($article['per_facet']))
                                <div class="article-section">
                                    <h5 class="article-section-title">Personal Facets</h5>
                                    <ul class="article-list">
                                        @foreach ($article['per_facet'] as $facet)
                                            <p class="article-info">{{ $facet }}</p>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (!empty($article['geo_facet']))

                                <div class="article-section">
                                    <h5 class="article-section-title">Geographical Facets</h5>
                                    <ul class="article-list">
                                        @foreach ($article['geo_facet'] as $facet)
                                            <p class="article-info">{{ $facet }}</p>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="article-section">
                                <h5 class="article-section-title">Media</h5>
                                <div class="row">
                                    @foreach ($article['media'] as $media)
                                        <div class="col-md-4">
                                            <!-- HTML -->
                                            <div class="media-card">
                                                <img src="{{ $media['media-metadata'][0]['url'] }}"
                                                     alt="{{ $media['caption'] }}" class="card-img-top">
                                                @if (!empty($media['caption']))
                                                    <div class="card-body">
                                                        <p class="card-text">{{ $media['caption'] }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
