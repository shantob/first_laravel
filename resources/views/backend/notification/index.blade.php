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
							<div class="card-title">Notification List</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>Notification</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($notifications as $notification)
										<tr>
											<th scope="row">{{ $loop->index + 1 }}</th>
											<td>{{ $notification->data['data']['name'] }} - comment on your blog  !!
												<br> 
												{{$notification->created_at->diffForHumans()}}

											</td>
											<td>
												@if($notification->read_at == null)
												<span class="badge badge-warning">Unread</span>
												@else
												
												<span class="badge badge-primary">Read</span>
												@endif
											</td>
											<td>
												<a href="{{ route('admin.notification.show',$notification->id) }}" class="btn btn-primary">View</a>
											</td>
										</tr>
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