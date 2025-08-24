@csrf
<input name="name" value="{{old('name',$product->name??'')}}" class="form-control mb-2" placeholder="Name">
<input name="category_name" value="{{old('category_name',$product->category_name??'')}}" class="form-control mb-2" placeholder="Category">
<input type="number" step="0.01" name="price" value="{{old('price',$product->price??'')}}" class="form-control mb-2" placeholder="Price">
<textarea name="description" class="form-control mb-2">{{old('description',$product->description??'')}}</textarea>
<button class="btn btn-primary">{{$btnText}}</button>