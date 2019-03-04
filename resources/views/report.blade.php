@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Report Definition</div>

                <div>
                    <form action="{{ url('generate') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input name="vessel_imei" id="vessel_imei" type="hidden" value="{{ $vessel_imei }}">
                            </div>
                            <div class="col-md-6">
                                <label for="male">Report name</label>
                                <input name="report_name" id="report_name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="male">Date from:</label>
                                <input name="date_from" id="date_from" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="male">Date to:</label>
                                <input name="date_to" id="date_to" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Generate</button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/home') }}" class="btn btn-xs btn-info pull-right">Back</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
