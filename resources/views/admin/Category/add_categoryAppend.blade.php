<div class="form-group">
    <label>Select Category level</label>
    <select name="parent_id"  id="parent_id" class="form-control select2" style="width: 100%;">
        <option value="0" @if(isset($catData['parent_id']) && $catData['parent_id']==0) selected @endif >Main Category</option>
@if(!empty($getCats))

    @foreach($getCats as $cats)
                <option value="{{$cats['id']}}" @if(isset($catData['parent_id']) && $catData['parent_id']==$cats['id']) selected @endif >{{$cats['category_name']}}</option>
                    @if(!empty($cats['subcategories']))
                    @foreach($cats['subcategories'] as $subcategory)
                        <option {{$subcategory['id']}}>&nbsp;&raquo;&nbsp; {{$subcategory['category_name']}}</option>
                    @endforeach
                @endif
            @endforeach
    @endif
    </select>
</div>
