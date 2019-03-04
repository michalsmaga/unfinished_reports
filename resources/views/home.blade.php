@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vessels list</div>

                <div>

                    @if (count($vessels) > 0)

                        <h3>List of vessels</h3>

                        <table>
                            @foreach($vessels as $vessel)
                                <tr>
                                    <td>{{ $vessel->name }}</td>
                                    <td><a href="{{ url('/vessel/' . $vessel->imei . '/add_image') }}" class="btn btn-xs btn-info pull-right">ADD IMAGE</a></td>
                                    <td><a href="{{ url('/vessel/' . $vessel->imei . '/report') }}" class="btn btn-xs btn-info pull-right">REPORT</a></td>
                                </tr>
                            @endforeach
                        </table>

                    @else

                        <h3>List of vessels is empty</h3>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
