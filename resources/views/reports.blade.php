@extends('layouts.app')

@section('title','Please Login')

@section('content')

    <form action="/generateReport" method='POST'>
        @csrf
        <table class="table">
            <tr>
                <td>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label" for="date">Date From</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="date" name="dateFrom" autocomplete="off" placeholder="MM/DD/YYY" type="text"/>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label" for="date">Date To</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="date" name="dateTo" autocomplete="off" placeholder="MM/DD/YYY" type="text"/>
                        </div>
                    </div>
                </td>
                <td>
                    <select name="status" class="form-control" id="sel1">
                        <option value="all">All</option>
                        @if(isset($statuses))
                            @foreach($statuses as $status)
                                <option value="{{$status->id}}" >{{$status->status}}</option>
                            @endforeach
                        @endif
                    </select>
                </td>
                <td>
                    <button type="submit" name="action" value="generate" class="btn btn-info">Submit</button>
                    <button type="submit" name="action" value="export" class="btn btn-success">Export Report</button>
                    <button type="submit" class="btn btn-danger btnClear">Clear</button>
                </td>
            </tr>
        </table>
    </form>

    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif


@endsection
