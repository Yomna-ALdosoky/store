@extends('layouts.dashboard')

@section('title', $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active"> {{$category->name}} </li>

@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th class="p-3"></th>
                <th class="p-3">Name</th>
                <th class="p-3">Store</th>
                <th class="p-3">Status</th>
                <th class="p-3">Create At</th>
            </tr>
        </thead>
        <tbody>
            @php
                $products = $category->products()->with('store')->latest()->paginate(5);
            @endphp
            @forelse ($products as $product)
                <tr>
                    <td class="p-5">
                        <img src="{{asset('storage/' .$product->image)}}" alt="" height="70px">
                    </td>
                    <td class="p-5">{{$product->name}}</td>
                    <td class="p-5">{{$product->store->name}}</td>
                    <td class="p-5">{{$product->status}}</td>
                    <td class="p-5">{{$product->created_at}}</td>
                </tr>
                @empty
                    <tr>
                        <td class="p-5" colspan="5">No products defind.</td>
                    </tr>
            @endforelse
        </tbody>
    </table> 

    {{ $products->links() }}

@endsection
