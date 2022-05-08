@extends('layouts.backend')
@section('content')

<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Add New Blog</h4>
			<form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-md-8">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<div class="card-body">
										<div class="form-group">
											<label for="title">Title</label>
											<input type="text" class="form-control" name="title" id="title" placeholder="Enter blog title" value="{{ old('title') }}">
											@if($errors->has('title'))
											<span style="color: crimson;">{{ $errors->first('title') }}</span>
											@endif
										</div>
										<div class="form-group">
											<label for="blog">Blog</label>
											<textarea name="blog" id="blog">{!! old('blog') !!}</textarea>
											@if($errors->has('blog'))
											<span style="color: crimson;">{{ $errors->first('blog') }}</span>
											@endif
										</div>
										<div class="form-group">
											<label for="meta_description">Meta Description</label>
											<textarea name="meta_description" id="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
											@if($errors->has('meta_description'))
											<span style="color: crimson;">{{ $errors->first('meta_description') }}</span>
											@endif
										</div>
									</div>
									<div class="card-action">
										<button class="btn btn-success">Submit</button>
										<button class="btn btn-danger">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<div class="card-body">
										<div class="form-group">
											<label for="category_id">Category</label>
											<select name="category_id" id="category_id" class="form-control">
												<option value="" disabled selected>(Select Category)</option>
												@foreach($categories as $category)
												<option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
											</select>
											@if($errors->has('category_id'))
											<span style="color: crimson;">{{ $errors->first('category_id') }}</span>
											@endif
										</div>
										<div class="form-group">
											<label for="image">Thumbnail Image</label>
											<input type="file" name="image" id="image">
											@if($errors->has('image'))
											<span style="color: crimson;">{{ $errors->first('image') }}</span>
											@endif
										</div>
										<div class="form-group">
											<label for="Image_alt">Image Alt.</label>
											<input type="text" name="img_alt" id="img_alt" class="form-control" value="{{ old('img_alt')}}">
											@if($errors->has('img_alt'))
											<span style="color: crimson;">{{ $errors->first('img_alt') }}</span>
											@endif
										</div>
										<div class="form-group">
											<label for="tags">Tags/Keywords</label>
											<input type="text" name="tags" id="tags" class="form-control" value="{{ old('tags') }}">
											@if($errors->has('tags'))
											<span style="color: crimson;">{{ $errors->first('tags') }}</span>
											@endif
										</div>
										<div class="form-group">
											<label for="og_image">Facebook Image</label>
											<input type="file" name="og_image" id="og_image">
											@if($errors->has('og_image'))
											<span style="color: crimson;">{{ $errors->first('og_image') }}</span>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')

<script>
	$('#blog').summernote({
		placeholder: 'Write your blog here.............',
		height: 450
	});

	$('#image').dropify({});

	$('#og_image').dropify({});

	$('#tags').tagsinput({
		allowDuplicates: false
	});
</script>

@endsection