@extends('layouts.backend')
@section('content')

<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Comment Page</h4>
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
											<th>Name</th>
											<th>Emailt</th>
											<th>Comment</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($comments as $comment)
										<tr>
											<th scope="row">{{ $loop->index + 1 }}</th>
											<td>{{ $comment->name }}</td>
											<td>{{ $comment->email }}</td>
											<td>{{ $comment->comment }}</td>
											<td>
												@if($comment->is_read == null)
												<span class="badge badge-warning">Unread</span>
												@else
												
												<span class="badge badge-primary">Read</span>
												@endif
											</td>
											<td>
												<a href="{{ route('admin.comment.show',$comment->id) }}" class="btn btn-primary">View</a>
												<a href="javascript:void(0)" data-url="{{ route('admin.comment.destroy', $comment->id) }}" class="delete btn btn-danger">Delete</a>

											</td>
											@endforeach
										</tbody>
									</table>
								</div>
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