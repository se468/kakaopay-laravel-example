@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kakaopay Dashboard</div>

                <div class="card-body">
                    Success
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Item name</td>
                                <td>{{ $result->item_name }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>{{ $result->amount->total }}</td>
                            </tr>
                            <tr>
                                <td>Vat</td>
                                <td>{{ $result->amount->vat }}</td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td>{{ $result->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="{{ url('kakaopay') }}">Back to Payments page</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
