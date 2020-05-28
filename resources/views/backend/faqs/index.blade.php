@extends('layouts.dashboard')

@section('title')
  Frequently Asked Questions
@endsection

@section('faq')
  active
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <span class="breadcrumb-item active">Frequently Asked Question</span>
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
                <h1 class="text-center">Add Faq</h1>
              </div>
              <div class="card-body">
                <form class="form-group" action="{{ route('faqs.store') }}" method="post">
                  @csrf
                  <div class="py-3">
                    <input class="form-control" type="text" name="faq_question" placeholder="Enter FAQ?" value="{{ old('faq_question') }}">
                    @error('faq_question')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="py-3">
                    <input class="form-control" type="text" name="faq_answer" placeholder="Answer" value="{{ old('faq_answer') }}">
                    @error ('faq_answer')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="py-3">
                    <button type="submit" class="btn btn-primary">Add Faq</button>
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
            <h1 class="text-center">All FAQ's</h1>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <tr>
                <th>SL</th>
                <th>Faq Question</th>
                <th>Faq Answer</th>
                <th>Created at</th>
                <th>Action</th>
                <th></th>
              </tr>
              @forelse($faqs as $index => $faq)
              <tr>
                 <td>{{ $faqs->firstItem() + $index }}</td>
                 <td>{{ $faq->faq_question }}</td>
                 <td>{{ $faq->faq_answer }}</td>
                 <td>{{ $faq->created_at->diffForHumans() }}</td>
                 <td>
                   <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-warning">Edit</a>
                 </td>
                 <td>
                <form action="{{ route('faqs.destroy', $faq->id) }}" method="post">
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
                {{ $faqs->links() }}
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
