@extends('layouts.main')
@section('content')
<div class="content">

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Comment</div>
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

					{!! Form::model($comment, ['method' => 'PATCH', 'url' => url('comments/'.$comment->id), "class" => 'form-horizontal', "role" => 'form']) !!}

						<div class="form-group">
							<label class="col-md-4 control-label">Comment</label>
							<div class="col-md-6">
								{!! Form::textarea('comment', null, ['class' => 'form-control'])!!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Save</button>
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