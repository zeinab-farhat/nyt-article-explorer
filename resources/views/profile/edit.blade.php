@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Profile') }}</h5>
                </div>

                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success')

                        @if ($name = auth()->user()->name)
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Name') }}" value="{{ old('name', $name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        @endif

                        @if ($email = auth()->user()->email)
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Email address') }}</label>
                                <input type="email" name="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Email address') }}"
                                       value="{{ old('email', $email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                        @endif
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Password') }}</h5>
                </div>

                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Current Password') }}</label>
                            <input type="password" name="old_password"
                                   class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Current Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('New Password') }}</label>
                            <input type="password" name="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('New Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>

                        <div class="form-group">
                            <label>{{ __('Confirm New Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="{{ __('Confirm New Password') }}" value="" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                    <h5 class="title">{{ __('Saved Articles') }}</h5>

                    @if ($savedArticles = auth()->user()->saved_articles)
                        <div class="card-description">
                            @foreach (auth()->user()->saved_articles as $articleTitle)
                                <div class="article-item">
                                    - <span>{{ $articleTitle }}</span>
                                    <form action="{{ route('remove-article', ['articleTitle' => $articleTitle]) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm bg-none"><i
                                                class="fas fa-times text-danger"></i></button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="card-description">
                            {{ 'There is no saved articles yet' }}
                        </div>
                    @endif
                </div>
            </div>
@endsection
