@extends('layout')
  
@section('content')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<!-- <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->

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
                    <a href="{{ route('assign_ticket') }}" class="active">Assign Ticket</a>
                </li>
                <li>
                    <a href="{{ route('my_ticket') }}">My Tickets</a>
                </li>
            </ul>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{ __('Assign Ticket') }}</h4></div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    <!-- <h3>Assign Ticket</h3> -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered datatables" id="example2">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($assign_user_tickets as $ticket)
                                    <tr>
                                        <td>{{$ticket->title}}</td>
                                        <td>
                                            <!-- <select class="form-control" onchange="changeStatus($ticket->id)"> -->
                                            
                                            {{$ticket->status}}
                                        </td>
                                        <td>
                                            <a href="{{ route('ticket.view',$ticket->id) }}" class="btn btn-primary btn-sm">View</a>
                                            @if($ticket->status != 'Closed')
                                            <a href="{{ route('ticket.close',$ticket->id) }}" class="btn btn-danger btn-sm">Close Ticket</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <h3>{{ __('No data found!') }}</h3>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.alert-success').delay(5000).fadeOut('slow');

    // $('.alert-success').hide();
    // $('#datatable').datatable();
    setTimeout(function() {
    $('#successMessage').fadeOut('slow');
}, 3000); 
    $(function () {
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
</script>
@endsection