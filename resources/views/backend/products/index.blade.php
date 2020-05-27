@extends('layouts.dashboard')

@section('title')
   Products
@endsection

@section('products-active')
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
    <span class="breadcrumb-item active">Products</span>
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
        <div class="d-flex justify-content-end mb-2">
          <a href="{{ route('products.create') }}" class="btn btn-success">Add Products</a>
       </div>
        <div class="card">
            <div class="card-header text-center">
                <h1>Products</h1>
            </div>
            <div class="card-body">
             <div class="table-responsive">
              <table class="table table-striped">
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Brand</th>
                  <th>Image</th>
                  <th>Sub Category</th>
                  <th>Quantity</th>
                  <th>Created at</th>
                  <th>Action</th>
                  <th></th>
                  <th></th>
                </tr>
              @forelse ($products as $index => $product)
                <tr>
                  <td>{{ $products -> firstItem() + $index }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>${{ $product->product_price }}.00</td>
                  <td>{{ $product->product_brand }}</td>
                  <td>
                    <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt="Not Found" width="100">
                  </td>
                  <td>{{ $product->getsubcategory->sub_category_name }}</td>
                  <td>{{ $product->product_quantity }} pcs</td>
                  <td>{{ $product->created_at->diffForHumans() }}</td>
                  @if ($product->updated_at)
                    <td>{{ $product->updated_at->diffForHumans() }}</td>
                  @else
                    <td>---</td>
                  @endif
                  <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                  </td>
                  <td>
                      <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                  </td>
                  <td>
                       <button class="btn btn-danger" onclick="handleDelete({{ $product->id }})">Delete</button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td>No Products Available</td>
                </tr>
              @endforelse
            </table>
            {{ $products->links() }}
              </table>
             </div>

              <!-- Modal -->
            <form action="" method="post" id = "deleteProductForm">
                @csrf
                {{ method_field('DELETE') }}
              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="deleteModalLabel">Delete product</h5>
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
      var form =  document.getElementById('deleteProductForm')
      form.action = '/products/' + id
      $('#deleteModal').modal('show')
    }

  </script>

@endsection
