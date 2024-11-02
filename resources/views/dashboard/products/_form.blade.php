
<div class="form-group">
    {{-- <label for="">Product Name</label> --}}
    <x-form.input label="Product Name" class="form-control-lg" role="input" name="name" :value="$product->name"/>
</div>

<div class="form-group">
    <label for="">Category</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach (App\Models\category::all() as $category)
            <option value="{{$category->id}}" @selected(old('parent_id', $category->parent_id) == $category->id)>{{$category->name}}</option>
        @endforeach
    </select> 
</div>

<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="discription"  :value="$product->description" />
</div>
<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />
    @if ($category->image)
        <img src="{{asset('storage/'. $product->image)}}" alt="" height="70px">    
    @endif
</div>

<div class="form-group">
    <x-form.input label="Price" class="form-control-lg" role="input" name="Price" :value="$product->price"/>
</div>

<div class="form-group">
    <x-form.input label="Compare Price" class="form-control-lg" role="input" name="compare price" :value="$product->compare_price" />
</div>

    <div class="form-group">
        <x-form.input label="Tags" class="form-control-lg" role="input" name="tags" :value="$tags" />
    </div>

<div class="form-group">
    <label for="">Status</label>
    <div>
        <x-form.radio name="status" :checked="$category->status" :options="['active' =>'Active', 'draft'=>'Draft' ,'archived' =>'Archived']"/>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
</div>

@push('style')
    <link href="{{ asset('css/tagify.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('js/tagify.js') }}"></script>
    <script src="{{ asset('js/tagify.polyfills.min.js') }}"></script>

    <script>
        var inputElm = document.querySelector('[name=tags]'),
        tagify = new Tagify (inputElm);

    </script>
@endpush