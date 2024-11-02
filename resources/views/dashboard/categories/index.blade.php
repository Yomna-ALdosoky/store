@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

<div class="mb-5">
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a>
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
            <th class="p-3">Parent</th>
            <th class="p-3">Products #</th>
            <th class="p-3">Status</th>
            <th class="p-3">Create At</th>
            <th class="p-3" colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td class="p-4">
                    <img src="{{asset('storage/' .$category->image)}}" alt="" height="70px">
                </td>
                <td class="p-4">{{$category->id}}</td>
                <td class="p-4"><a href="{{ route('dashboard.categories.show', $category->id)}}">{{$category->name}}</a></td>
                <td class="p-4">{{$category->parent->name}}</td>
                <td class="p-4">{{$category->products_number}}</td>
                <td class="p-4">{{$category->status}}</td>
                <td class="p-4">{{$category->created_at}}</td>
                <td class="p-4">
                    <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td class="p-4">

                    <form action="{{ route('dashboard.categories.destroy', $category->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="method" value="delete">
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>

                </td>
                
            </tr>
            @empty
                <tr>
                    <td colspan="9">No categories defind.</td>
                </tr>
        @endforelse
    </tbody>

 </table> 
 {{ $categories->withQueryString()->appends(['search' => 1 ])->links() }} {{-- paginate --}}


@endsection
    