@extends('layouts.admin')

@section('title', 'Products')

@section('header', 'Products')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-dark table-sm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        @foreach($product->categories as $category)
                            <span class="badge bg-secondary">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No products found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
