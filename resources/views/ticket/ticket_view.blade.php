@extends('layout')
  
@section('content')
<?php 
    use App\Models\User;
    $assign_user_name = User::where('id',$ticket->assign_user_id)->pluck('name')->first();
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-2">
            <ul class="dashboard-navigation">
                <!-- <li>
                    <h3>Navigation</h3>
                </li>-->
                <li> 
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('assign_ticket') }}">Assign Ticket</a>
                </li>
                <li>
                    <a href="{{ route('my_ticket') }}" class="active">My Tickets</a>
                </li>
            </ul>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{ __('View Ticket') }}</h4></div>
  
                <div class="card-body">
                    
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered datatables" id="datatable">
                            <tbody>
                                <tr>
                                    <td><b>Title</b></td>
                                    <td>{{$ticket->title}}</td>
                                </tr>
                                <tr>
                                    <td><b>Description</b></td>
                                    <td>{{$ticket->description}}</td>
                                </tr>
                                <tr>
                                    <td><b>Status</b></td>
                                    <td>{{$ticket->status}}</td>
                                </tr>
                                <tr>
                                    <td><b>Assign User</b></td>
                                    <td>{{$assign_user_name}}</td>
                                </tr>
                                <tr>
                                    <td><b>Created At</b></td>
                                    <td>{{$ticket->created_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $('.alert-success').delay(5000).fadeOut('slow');

    // $('.alert-success').hide();
    $('#datatable').datatable();
</script>
@endsection