@extends('layouts.backend')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Category</h4>
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Category Edit</div>
						</div>
						<form action="{{ route('admin.category.update', $category->id) }}" method="post">
							@csrf
							@method('PUT')
							<div class="card-body">
								<div class="form-group">
									<label for="name">Category</label>
									<input type="text" class="form-control" name="name" id="name" placeholder="Enter Category" value="{{ $category->name }}">
									
								</div>
							</div> 
							<div class="card-action">
								<button class="btn btn-success">Submit</button>
								<button class="btn btn-danger">Cancel</button>
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection
