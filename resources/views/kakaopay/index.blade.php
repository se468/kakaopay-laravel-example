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
                <div class="card-header">Kakaopay Dashboard</div>

                <div class="card-body">
                    <div class="mb-4">
                        <a href="{{ url('kakaopay/single/test') }}" class="btn btn-primary">
                            Test Single Charge
                        </a>

                        <a href="{{ url('kakaopay/subscription/test') }}" class="btn btn-primary">
                            Test Subscription Charge
                        </a>
                    </div>

                    @if(count($histories) > 0)
                    <div class="mb-4">
                        <table class="table">
                            <tr>
                                <th>id</th>
                                <th>Item</th>
                                <th>Type</th>
                                <th>Created At</th>
                            </tr>
                            @foreach($histories as $history)
                            <tr>
                                <td>{{ $history->id }}</td>
                                <td>
                                    <a href="{{ route('kakaopay.show',['id' => $history->id]) }}">
                                        {{ $history->getItemName() }}
                                    </a>
                                </td>
                                <td>
                                    @if($history->isSubscription())
                                        Subscription
                                    @else 
                                        Single Pay
                                    @endif
                                </td>
                                
                                <td>
                                    {{ $history->created_at }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    @endif
                    
                    <div>
                        <a href="https://developers.kakao.com/docs/restapi/kakaopay-api">
                            API documentation
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
