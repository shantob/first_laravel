@extends('layouts.backend')
@section('content')

<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Comment</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">{{$comment->blog['title']}}</div>
							<div class="card-body">
								{!! $comment->blog['blog']!!}
							</div>
						</div>

					</div>
					<div class="col-lg-12">
						<h4 class="page-title">Comment</h4>
						<div class="card">
							<div class="card-body">
								<p>{{ $comment->comment}}</p>
								<p>By : {{ $comment->name}} | Email: {{ $comment->email }} | Date-Time: {{ date('d-F-Y', strtotime($comment->created_at)) }}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<h4 class="page-title">Reply</h4>
				</div>
				@if($comment->child->count() > 0)
				@foreach($comment->child as $reply)
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<p>{{ $reply->comment}}</p>
							<p>By : {{ $reply->user['name']}} | Email: {{ $reply->user['email'] }} | Date-Time: {{ date('d-F-Y h:i A', strtotime($comment->created_at)) }}</p>
							<a href="javascript:void(0)" data-url="{{ route('admin.comment.destroy', $reply->id) }}" class="delete btn btn-danger">Delete</a>
						</div>
					</div>
				</div>
				@endforeach
				@else
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">No Reply</div>
					</div>
				</div>

				@endif
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4 class="page-title">Add Reply</h4>
					<div class="card">
						<div class="card-body">
							<form action="{{ route('admin.comment.store') }}" method="post">
								@csrf
								<input type="hidden" name="p_id" value="{{ $comment->id }}">
								<input type="hidden" name="blog_id" value="{{ $comment->blog_id }}">
								<div class="form-group">
									<label>Reply</label>
									<textarea name="comment" id="comment" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<button class="btn btn-primary" type="submit">Reply</button>
								</div>
							</form>
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