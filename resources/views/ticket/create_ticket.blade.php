@extends('layout')
  
@section('content')
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
                <div class="card-header"><h4>{{ __('Create Ticket') }}</h4></div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    <!-- <h3>My Ticket</h3> -->
                    <!-- <div style="text-align:right;" class="mb-2">
                        <a href="{{ route('create_ticket') }}" class="btn btn-primary btn-sm">Create New Ticket</a>
                    </div> -->
                    <form action="{{ route('ticket.store') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Title</label>
                              <div class="col-md-6">
                                  <input type="text" id="title" class="form-control" name="title" required autofocus>
                                  @if ($errors->has('title'))
                                      <span class="text-danger">{{ $errors->first('title') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">Description</label>
                              <div class="col-md-6">
                                <textarea name="description" class="form-control" required autofocus></textarea>
                                  @if ($errors->has('description'))
                                      <span class="text-danger">{{ $errors->first('description') }}</span>
                                  @endif
                              </div>
                          </div>
  
                            <!-- <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Status</label>
                                <div class="col-md-6">
                                    <select name="status" class="form-control" required autofocus>
                                        <option value="Pending">Pending</option>    
                                        <option vallue="Closed">Closed</option>    
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div> -->
  
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Assigned User</label>
                                <div class="col-md-6">
                                    <select name="assign_user_id" class="form-control" required autofocus>
                                        @foreach($assign_user as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>    
                                        @endforeach
                                    </select>
                                    @if ($errors->has('assign_user_id'))
                                        <span class="text-danger">{{ $errors->first('assign_user_id') }}</span>
                                    @endif
                                </div>
                            </div>
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Create
                              </button>
                          </div>
                    </form>


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