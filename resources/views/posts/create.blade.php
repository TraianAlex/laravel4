@extends('layouts.main')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Create Post</div>
					<div class="panel-body">
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						<form class="form-horizontal" role="form" method="POST" action="{{ url('/posts') }}">
							{{ csrf_field() }}

							<div class="form-group">
								<label class="col-md-4 control-label">Title</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="title" value="{{ old('title') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Body</label>
								<div class="col-md-6">
									<textarea type="text" class="form-control" name="body"></textarea>
								</div>
							</div>

							<div class="form-group">
								{!! Form::label('tag_list', 'Tags:', ['class' => "col-md-4 control-label"]) !!}
								<div class="col-md-6">
									{!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">Create Post</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection