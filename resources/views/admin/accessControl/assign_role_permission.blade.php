@extends('admin.layouts.app')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


<div class="col-lg-8 col-md-10 col-sm-12 mx-auto py-5">
	<form id="accessControlForm" method="POST" action="javaScript:;">
		<div class="card mx-auto mb-3">
			<div class="card-header h4 text-center">Assign Role Permission </div>
			<div class="card-body">	
				
				<div class="form-group">
					<label for="brand_id">Role Name</label>
					<select id="role_id" class="form-control select-role" name="role_id">
						<option disabled selected>Select Role</option>
						@foreach ($roles as $role)
						<option value="{{ $role->id }}">{{ $role->name }}</option>
						@endforeach
					</select>
					@error('role_id')
					<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>		
				<button type="submit" class="btn btn-primary btn-sm">Save</button>
			</div>
		</div>	
		
	
		@if(!empty($permissions->original))	
			@foreach($permissions->original as $group_key => $group_value)
				<div class="card mx-auto mb-3">
					<div class="card-header">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="{{ $group_key }}">
							<label class="custom-control-label text-capitalize" for="{{ $group_key }}">{{ str_replace("_", " ", $group_key) }}</label>
						</div>
					</div>
					<div class="card-body">
						@foreach($group_value as $key => $value)
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" class="custom-control-input {{ $group_key }}" name="permissions[]" value="{{ $group_key.'.'.$value }}" id="{{ $group_key.'.'.$value }}">
								<label class="custom-control-label text-capitalize" for="{{ $group_key.'.'.$value }}">{{ str_replace("_", " ", $value) }}</label>
							</div>
						@endforeach
					</div>
				</div>
			@endforeach
		@endif
	</form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>




<script type="text/javascript">
      $(document).ready(function() {
        $('.select-role').select2({
            placeholder: "Select Category"
            , allowClear: true
            , width: '100%'
        });
     
    });
$(document).ready(function() {
	$("#accessControlForm" ).validate({
		errorElement: 'span',
		errorPlacement: function (error, element) {
			$(".form-text").html("&nbsp;");
			$("#" + $(element).attr("name") + "_help").html(error);
        },
        submitHandler: function() {
			axios.post('{{ env('APIP_URL') }}/assign_role_module', $('#accessControlForm').serialize())
			.then(function (response) {
				$(".form-text").html("&nbsp;");
				toastr.success('Permission Saved.');
			})
			.catch(function (error) {
				$(".form-text").html("&nbsp;");
				$.each(error.response.data, function(index, value){
					$("#" + index + "_help").html(value[0]);
				});
				toastr.error(error.response.data.error);
			});
        }
	});

	$("#role_id").change(function(){
		var id = $(this).val();
		axios.get('{{ env('APP_URL') }}/permission/role/'+id)
		.then(function (response) {
			// console.log(response.data.permissions)
			$('input[type="checkbox"]').prop("checked", false);
			$.each(response.data.permissions, function(index, value){
				$('input[id="'+value+'"]').prop("checked", true);
				$('input[id="'+value.split('.')[0]+'"]').prop("checked", true);
			});
		})
	});

	$('input[type="checkbox"]').click(function(){

		var id = $(this).attr("id");
		var split = id.split('.');

		if (split.length == 1)
		{
			if ($(this).prop('checked')) {
				$('.'+id+'').prop("checked", true);
			}
			else
			{
				$('.'+id+'').prop("checked", false);
			}
		}
		else
		{
			$('#'+split[0]+'').prop("checked", true);
		}
	})
})
</script>
@endsection
