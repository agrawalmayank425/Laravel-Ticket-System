@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-2">
            <ul class="dashboard-navigation">
                <!-- <li>
                    <h3>Navigation</h3>
                </li>-->
                <li> 
                    <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('assign_ticket') }}">Assign Ticket</a>
                </li>
                <li>
                    <a href="{{ route('my_ticket') }}">My Tickets</a>
                </li>
            </ul>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    You are Logged In
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.alert-success').delay(5000).fadeOut('slow');

    // $('.alert-success').hide();
</script>
@endsection