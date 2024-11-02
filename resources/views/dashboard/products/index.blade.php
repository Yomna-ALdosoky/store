@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')

<div class="mb-5">
    <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    {{-- <a href="{{ route('dashboard.products.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a> --}}
</div>

<x-alert type="success" /> 
<x-alert type="info" />

<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-5">
    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
    <select name="status" class="form-control mx-2">
        <option value="" >All</option>
        <option value="active" @selected(request('status') == 'active')>Active</option>
        <option value="archived" @selected(request('status') == 'archived')>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>

 <table class="table">
    <thead>
        <tr>
            <th class="p-3"></th>
            <th class="p-3">ID</th>
            <th class="p-3">Name</th>
            <th class="p-3">Category</th>
            <th class="p-3">Store</th>
            <th class="p-3">Status</th>
            <th class="p-3">Create At</th>
            <th class="p-3" colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td class="p-5">
                    <img src="{{asset('storage/' .$product->image)}}" alt="" height="70px">
                </td>
                <td class="p-5">{{$product->id}}</td>
                <td class="p-5">{{$product->name}}</td>
                <td class="p-5">{{$product->category->name}}</td>
                <td class="p-5">{{$product->store->name}}</td>
                <td class="p-5">{{$product->status}}</td>
                <td class="p-5">{{$product->created_at}}</td>
                <td class="p-5">
                    <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td class="p-5">

                    <form action="{{ route('dashboard.products.destroy', $product->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="method" value="delete">
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>

                </td>
                
            </tr>
            @empty
                <tr>
                    <td colspan="9">No products defind.</td>
                </tr>
        @endforelse
    </tbody>

 </table> 
 {{ $products->withQueryString()->appends(['search' => 1 ])->links() }} {{-- paginate --}}


@endsection
    