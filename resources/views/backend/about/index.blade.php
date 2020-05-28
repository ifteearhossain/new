@extends('layouts.dashboard')

@section('title')
    Ekomalls | About Admin
@endsection

@section('about')
    active
@endsection

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">
     @if (Auth::user()->user_role == 0)
       Master Admin Home
     @elseif (Auth::user()->user_role == 1)
       Admin Dashboard
     @endif
     </a>
    {{-- <a class="breadcrumb-item" href="index.html">Pages</a> --}}
    <span class="breadcrumb-item active">About</span>
  </nav>

@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h1 class="text-center">About Description</h1>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <tr>
                <th>SL</th>
                <th>About Image</th>
                <th>About Short Description</th>
                <th>About Long Description</th>
                <th>Action</th>
              </tr>
              @forelse($abouts as $about)
              <tr>
                 <td>{{ $loop->index + 1 }}</td>
                 <td>
                     <img src="{{ asset('uploads/about') }}/{{ $about->about_banner }}" alt="Not found" width="100">
                 </td>
                 <td>{{ $about->about_short_description }}</td>
                 <td>{{ $about->about_long_description }}</td>
                 <td>
                    <form action="{{ route('about.destroy', $about->id) }}" method="post">
                    @csrf 
                    {{ method_field('DELETE') }}
                     <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                 </td>
              </tr>
            @empty
              <tr>
                <td>No Data Available</td>
              </tr>
            @endforelse


            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif
          <div class="card-header">
            <h1 class="text-center">Add about</h1>
          </div>
          <div class="card-body">
            <form class="form-group" action="{{ route('about.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="py-3">
                  <label for="about">Enter banner (Dimension : 1920x640 for better view)</label>
                <input class="form-control" type="file" name="about_banner" placeholder="About Banner Image">
                @error ('about_banner')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="py-3">
                  <label for="short">About Short Desc</label>
                <textarea id="short" class="form-control" type="text" name="about_short_description" placeholder="About Short Description">{{ old('about_short_description') }}</textarea>
                @error ('about_short_description')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="py-3">
                <label for="long">About Long Desc</label>
             <textarea id="long" class="form-control" type="text" name="about_long_description" placeholder="About Long Description">{{ old('about_long_description') }}</textarea>
                @error ('about_long_description')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary">Add about</button>
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
    </div>
  </div>
@endsection