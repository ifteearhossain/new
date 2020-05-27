@extends('layouts.dashboard')

@section('title')
   Category
@endsection

@section('category-active')
  active
@endsection

@section('breadcrumb')

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
    {{-- <a class="breadcrumb-item" href="index.html">Pages</a> --}}
    <span class="breadcrumb-item active">Category</span>
  </nav>

@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-9 m-auto">
        @if (session('success'))
          <div class="alert alert-success" role="alert">
              {{ session('success') }}
          </div>
        @endif
        @if (session('failed'))
          <div class="alert alert-danger" role="alert">
              {{ session('failed') }}
          </div>
        @endif
        <div class="d-flex justify-content-end mb-2">
          <a href="{{ route('category.create') }}" class="btn btn-success">Add Category</a>
       </div>
        <div class="card">
            <div class="card-header text-center">
                <h1>Categories</h1>
            </div>
            <div class="card-body">
             <div class="table-responsive">
              <table class="table table-striped">
                <tr>
                  <th>SL</th>
                  <th>Category Name</th>
                  <th>Category Image</th>
                  <th>Added By</th>
                  <th>Sub Categories</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th>Action</th>
                  <th></th>
                </tr>
              @forelse ($categories as $index => $category)
                <tr>
                  <td>{{ $categories -> firstItem() + $index }}</td>
                  <td>{{ $category->category_name }}</td>
                  <td>
                    <img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt="Not Found" width="100">
                  </td>
                  <td>{{ $category->relationBetweenUser->name }}</td>
                  <td>{{ $category->getSubCategory->count() }}</td>
                  <td>{{ $category->created_at->diffForHumans() }}</td>
                  @if ($category->updated_at)
                    <td>{{ $category->updated_at->diffForHumans() }}</td>
                  @else
                    <td>---</td>
                  @endif
                  <td>
                      <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                  </td>
                  <td>
                       <button class="btn btn-danger" onclick="handleDelete({{ $category->id }})">Delete</button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td>No Categories Available</td>
                </tr>
              @endforelse
            </table>
             </div>
            {{ $categories->links() }}
              </table>

              <!-- Modal -->
            <form action="" method="post" id = "deleteCategoryForm">
                @csrf
                {{ method_field('DELETE') }}
              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <div class="modal-body">
                      Are you sure you want to delete the category from the application?
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                      <button type="submit" class="btn btn-danger">Yes Delete</button>
                      </div>
                  </div>
                  </div>
              </div>
            </form>

            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')

  <script>
    function handleDelete(id)
    {
      var form =  document.getElementById('deleteCategoryForm')
      form.action = '/category/' + id
      $('#deleteModal').modal('show')
    }

  </script>

@endsection
