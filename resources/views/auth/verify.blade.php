@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        Silahkan verifikasi email anda
                    </div>
                    <div>
                        {{ Auth::user()->email }}
                    </div>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Link verifikasi baru telah di kirim ke email anda.') }}
                        </div>
                    @endif

                    {{ __('Sebelum melanjutkan silahkan periksa email anda untuk verifikasi.') }}
                    {{ __('Jika anda tidak mendapatkan email verifikasi') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik disini untuk mengirim ulang') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
