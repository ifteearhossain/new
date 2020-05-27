@extends('layouts.dashboard')

@section('title')
   Category
@endsection

@section('category-active')
  active
@endsection

@section('breadcrumb')

@isset($category)
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="
        @if (Auth::user()->user_role == 0)
          {{ route('home') }}
        @elseif (Auth::user()->user_role == 1)
          {{ route('admin.index') }}
        @elseif (Auth::user()->user_role == 2)
          {{ route('seller.index') }}
        @else
          {{ route('customer.index') }}
        @endif
     ">
     @if (Auth::user()->user_role == 0)
       Master Admin Home
     @elseif (Auth::user()->user_role == 1)
       Admin Dashboard
     @elseif (Auth::user()->user_role == 2)
       Seller Dashboard
     @else
       Customer Dashboard
     @endif
     </a>
    <a class="breadcrumb-item" href="{{ route('category.index') }}">Category</a>
    <span class="breadcrumb-item active">{{ $category->category_name }}</span>
  </nav>
@else
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">
     @if (Auth::user()->user_role == 0)
       Master Admin Home
     @elseif (Auth::user()->user_role == 1)
       Admin Dashboard
     @elseif (Auth::user()->user_role == 2)
       Seller Dashboard
     @else
       Customer Dashboard
     @endif
     </a>
    {{-- <a class="breadcrumb-item" href="{{ route('category.index') }}">Category</a> --}}
    <span class="breadcrumb-item active">Add Category</span>
  </nav>
@endisset

@endsection

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
             {{ isset($category)? 'Edit Category' : 'Add Category' }}
            </div>
            <div class="card-body">
                {{-- @if($errors->all())
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">
                    <li>{{ $error }}</li>
                  </div>
                @endforeach
            @endif --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
               <form action="{{ isset($category)? route('category.update', $category->id) : route('category.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                @if (isset($category))
                    {{ method_field('PUT') }}
                @endif
                   @csrf
                <div class="py-3">
                    <label for="name">Category name</label>
                    <input class="form-control" id="name" type="text" name="category_name" placeholder="Add Category name" value="{{ isset($category)?$category->category_name : '' }}">
                    @error ('category_name')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="py-3">
                    <label for="image">Category Image</label>
                    @isset($category)
                      <div class="text-center">
                        <img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt="Not Found" width="200">
                      </div>
                    @endisset
                    <input class="form-control" id="image" type="file" name="category_image">
                    @error ('category_image')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="py-3">
                    <button class="btn btn-success btn-sm" type="submit">
                        @if(isset($category))
                        Update category
                        @else
                        Add Category
                        @endif
                    </button>


                </div>
               </form>
            </div>
        </div>
    </div>
@endsection
