@php
    error_reporting(0);
@endphp
@extends('layouts.dashboard')

@section('title')
 Ekomalls | Terms and Conditions
@endsection

@section('toc')
  active
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <span class="breadcrumb-item active">Terms and Conditions</span>
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
                <h1 class="text-center">Add T&C</h1>
              </div>
              <div class="card-body">
                <form class="form-group" action="{{ route('toc.store') }}" method="post">
                  @csrf
                  <div class="py-3">
                    <input class="form-control" type="text" name="toc_heading" placeholder="Enter heading?" value="{{ old('toc_heading') }}">
                    @error('toc_heading')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="py-3">
                    <input class="form-control" type="text" name="toc_details" placeholder="Answer" value="{{ old('toc_details') }}">
                    @error ('toc_details')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="py-3">
                    <button type="submit" class="btn btn-primary">Add Terms & Conditions</button>
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
            <h1 class="text-center">All Terms & Conditions</h1>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <tr>
                <th>SL</th>
                <th>toc Heading</th>
                <th>toc Details</th>
                <th>Created at</th>
                <th>Action</th>
                <th></th>
              </tr>
              @forelse($tocs as $index => $toc)
              <tr>
                 <td>{{ $tocs->firstItem() + $index }}</td>
                 <td>{{ $toc->toc_heading }}</td>
                 <td>{{ $toc->toc_details }}</td>
                 <td>{{ $toc->created_at->diffForHumans() }}</td>
                 <td>
                   <a href="{{ route('toc.edit', $toc->id) }}" class="btn btn-warning">Edit</a>
                 </td>
                 <td>
                <form action="{{ route('toc.destroy', $toc->id) }}" method="post">
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
                {{ $tocs->links() }}
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
