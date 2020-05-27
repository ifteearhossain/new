@extends('layouts.dashboard')

@section('title')
   Shops
@endsection

@section('shops-active')
  active
@endsection

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">
     @if (user_role() == 0)
       Master Admin Home
     @elseif (user_role() == 1)
       Admin Dashboard
     @elseif (user_role() == 2)
       Seller Dashboard
     @else
       Customer Dashboard
     @endif
     </a>
    {{-- <a class="breadcrumb-item" href="index.html">Pages</a> --}}
    <span class="breadcrumb-item active">{{ (user_role() == 2 || user_role() == 3) ? 'Shop' : 'Shops' }}</span>
  </nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-12 m-auto col-md-12 col-sm-12">
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
        @if (user_role() == 0)    
        <div class="d-flex justify-content-end mb-2">
          <a href="{{ route('shops.create') }}" class="btn btn-success">Add Shops</a>
       </div>
       @elseif(user_role()== 2)
       <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('products.create') }}" class="btn btn-success">Add Products</a>
       </div>
        @endif

        <div class="card">
            <div class="card-header text-center">
                <h1>{{ (user_role() == 0 || user_role() == 1) ? 'Shops' : 'Shop' }}</h1>
            </div>
            <div class="card-body">
           <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Logo</th>
                <th>Total Products</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th></th>
                <th>Action</th>
                <th></th>
                <th></th>
              </tr>
            @forelse ($shops as $index => $shop)
              <tr>
                <td>{{ $shops -> firstItem() + $index }}</td>
                <td>{{ $shop->shop_name }}</td>
                <td>
                  <img src="{{ asset('uploads/shops/logo') }}/{{ $shop->shop_logo }}" alt="Not Found" width="150">
                </td>
                <td>{{ $shop->getproduct()->count() }}</td>
                <td>{{ $shop->created_at->diffForHumans() }}</td>
                @if ($shop->updated_at)
                  <td>{{ $shop->updated_at->diffForHumans() }}</td>
                @else
                  <td>---</td>
                @endif
                <td>
                  <a href="{{ route('shops.show', $shop->id) }}" class="btn btn-info">View</a>
                </td>
                <td>
                    <a href="{{ route('shops.edit', $shop->id) }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                  @if ($shop->is_active == 'pending')
                  <a href="{{ route('shops.approve', $shop->id) }}" class="btn btn-success">Approve</a>
                  @else 
                   <span class="badge badge-success">Active</span>                       
                  @endif
                </td>
                <td>
                     <button class="btn btn-danger" onclick="handleDelete({{ $shop->id }})">Delete</button>
                </td>
              </tr>
            @empty
              <tr>
                <td>No Shops Available</td>
              </tr>
            @endforelse
          </table>
           </div>
            {{ $shops->links() }}

              <!-- Modal -->
            <form action="" method="post" id = "deleteShopForm">
                @csrf
                {{ method_field('DELETE') }}
              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="deleteModalLabel">Delete shop</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <div class="modal-body">
                      Are you sure you want to delete the product from the application?
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
      var form =  document.getElementById('deleteShopForm')
      form.action = '/shops/' + id
      $('#deleteModal').modal('show')
    }

  </script>

@endsection