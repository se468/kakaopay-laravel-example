@extends('layouts.app')

@section('content')

<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Information for {{ $history->getItemName() }}</div>

                <div class="card-body">
                    @if($history->isSubscription())

                        <form method="POST" action="{{ url('kakaopay/subscription/test-recurring') }}">
                            @csrf
                            <input type="hidden" value="{{ $history->getSid() }}" name="sid">
                            <input type="submit" value="Test Recurring Payment" class="btn btn-primary">
                        </form>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
