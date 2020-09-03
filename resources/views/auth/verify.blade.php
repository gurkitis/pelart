@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('verifi_messages.verifiYourEmailAdress') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('verifi_messages.aFreshVerification') }}
                        </div>
                    @endif

                    {{ __('verifi_messages.beforeProceeding') }}
                    {{ __('ifYouDidNot.verifiYourEmailAdress') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('verifi_messages.clickHere') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
