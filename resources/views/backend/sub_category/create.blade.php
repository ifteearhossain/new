@extends('layouts.dashboard')

@section('title')
   Sub category
@endsection

@section('sub_category-active')
  active
@endsection

@section('breadcrumb')

@isset($subCategory)
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
    <a class="breadcrumb-item" href="{{ route('sub_category.index') }}">Sub Category</a>
    <span class="breadcrumb-item active">{{ $subCategory->sub_category_name }}</span>
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
    <a class="breadcrumb-item" href="{{ route('sub_category.index') }}">Sub Category</a>
    <span class="breadcrumb-item active">Add Sub Category</span>
  </nav>
@endisset

@endsection

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
             {{ isset($category)? 'Edit Sub category' : 'Add Sub category' }}
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
               <form action="{{ isset($subCategory)? route('sub_category.update', $subCategory->id) : route('sub_category.store') }}" class="form-group" method="POST">
                @if (isset($subCategory))
                    {{ method_field('PUT') }}
                @endif
                   @csrf
                <div class="py-3">
                    <label for="name">Sub Category name</label>
                    <input class="form-control" id="name" type="text" name="sub_category_name" placeholder="Add Sub Category name" value="{{ isset($subCategory)?$subCategory->sub_category_name : '' }}">
                    @error ('sub_category_name')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="py-3">
                  <label for="category">Select Category</label>
                  <select class="form-control" name="category_id" id="category">
                    <option value="">Selet Category</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}"
                        @isset($subCategory)
                          @if ($subCategory->category_id === $category->id)
                            selected
                          @endif
                        @endisset
                        >{{ $category->category_name }}</option>
                    @endforeach
                  </select>
                  @error ('category_id')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="py-3">
                    <button class="btn btn-success btn-sm" type="submit">
                        @if(isset($subCategory))
                        Update Sub category
                        @else
                        Add Sub category
                        @endif
                    </button>


                </div>
               </form>
            </div>
        </div>
    </div>
@endsection
