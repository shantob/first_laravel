@extends('layouts.backend')
@section('content')

<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Category Page</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Blog List</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>Title</th>
											<th>Created At</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($blogs as $blog)
										<tr>
											<th scope="row">{{ $loop->index + 1 }}</th>
											<td>{{ $blog->title }}</td>
											<td>{{ date('d-m-Y h:i A', strtotime($blog->created_at)) }}
												<br>
												{{ $blog->created_at->diffForHumans() }}
											</td>
											<td>
												
												<a href="{{ route('admin.blog.edit',
												$blog->id) }}" class="btn btn-primary">Edit</a>

												<a href="javascript:void(0)" data-url="{{ route('admin.blog.destroy', $blog->id) }}" class="delete btn btn-danger">Delete</a>

											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							{{ $blogs->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete Modal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="delete_form" method="post" action="">
				@csrf
				@method('DELETE')
				<div class="modal-body">
					<h2 class="text-center">Do you want to delete this data?</h2>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Confirm</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')

<script>
	$(".delete").on('click', function(event){
		var url = $(this).attr('data-url');
		$('#delete_form').attr('action', url);
		$('#delete_modal').modal('show');
	});
</script>

@endsection