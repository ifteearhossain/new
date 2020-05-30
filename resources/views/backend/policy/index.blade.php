@extends('layouts.dashboard')

@section('title')
 Ekomalls | Policy
@endsection

@section('policy')
  active
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <span class="breadcrumb-item active">Policy</span>
  </nav>
@endsection

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
              @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif
              <div class="card-header">
                <h1 class="text-center">Add Policy</h1>
              </div>
              <div class="card-body">
                <form class="form-group" action="{{ route('policies.store') }}" method="post">
                  @csrf
                  <div class="py-3">
                    <input class="form-control" type="text" name="policy_heading" placeholder="Enter heading?" value="{{ old('policy_heading') }}">
                    @error('policy_heading')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="py-3">
                    <input class="form-control" type="text" name="policy_details" placeholder="Answer" value="{{ old('policy_details') }}">
                    @error ('policy_details')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="py-3">
                    <button type="submit" class="btn btn-primary">Add Policy</button>
                  </div>
                  @if($errors->all())
                    <div class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </div>
                  @endif
                </form>
              </div>
            </div>
          </div>
      <div class="col-lg-12 m-auto py-3">
        <div class="card">
          <div class="card-header">
            <h1 class="text-center">All policy's</h1>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <tr>
                <th>SL</th>
                <th>Policy Heading</th>
                <th>Policy Details</th>
                <th>Created at</th>
                <th>Action</th>
                <th></th>
              </tr>
              @forelse($policies as $index => $policy)
              <tr>
                 <td>{{ $policies->firstItem() + $index }}</td>
                 <td>{{ $policy->policy_heading }}</td>
                 <td>{{ $policy->policy_details }}</td>
                 <td>{{ $policy->created_at->diffForHumans() }}</td>
                 <td>
                   <a href="{{ route('policies.edit', $policy->id) }}" class="btn btn-warning">Edit</a>
                 </td>
                 <td>
                <form action="{{ route('policies.destroy', $policy->id) }}" method="post">
                    @csrf 
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                 </td>
              </tr>
            @empty
              <tr>
                <td>No Data Available</td>
              </tr>
            @endforelse


            </table>
                {{ $policies->links() }}
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
