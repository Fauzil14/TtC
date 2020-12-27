@extends('layouts.app')

@section('content')
{{-- {{ dd([$role]) }} --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Selamat datang {{ auth()->user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Kamu login sebagai seorang {{ $role[0]->role }}
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @can('admin')
                        {{ $roles }} <br>
                    @elsecan('bendahara')
                        {{ $message }} <br>
                    @endcan
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection