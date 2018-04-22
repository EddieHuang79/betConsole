@if(!empty($search_tool))

<!--
<div class="no-print search_tool" style="position: fixed; top: 70px; right: 250px; background: rgb(255, 255, 255); border-radius: 5px 0px 0px 5px; padding: 10px 15px; font-size: 16px; z-index: 99999; cursor: pointer; color: rgb(60, 141, 188); box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px;">
	<i class="fa fa-times"></i>
</div>
-->
<form method="get" class="search_tool no-print" style="padding: 10px; position: fixed; top: 70px; right: 0px; background: rgb(255, 255, 255); border: 0px solid rgb(221, 221, 221); width: 250px; z-index: 99999; box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px;">

	<h4 class='text-light-blue' style='margin: 0 0 5px 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;'>{{ $txt['search_tool'] }}</h4>

	<h6>{{ $txt['search_tool_desc'] }}</h6>

	<!-- 日期 -->
	@if(in_array(1, $search_tool))
	<h4 class='text-light-blue' style='margin: 0 0 5px 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;'>{{ $txt['Date'] }}</h4>
	<div class='form-group'>
		<div><input type="text" name="date" class="form-control" placeholder="{{ $txt['Date'] }}" @if(!empty($_GET['date'])) value="{{ $_GET['date'] }}" @endif></div>
	</div>
	@endif
		
	<!-- 帳號 -->
	@if(in_array(2, $search_tool))
	<h4 class='text-light-blue' style='margin: 0 0 5px 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;'>{{ $txt['account'] }}</h4>
	<div class='form-group'>
		<div><input type="text" name="account" class="form-control" placeholder="{{ $txt['account_input'] }}" @if(!empty($_GET['account'])) value="{{ $_GET['account'] }}" @endif></div>
	</div>
	@endif

	<!-- 姓名 -->
	@if(in_array(3, $search_tool))
	<h4 class='text-light-blue' style='margin: 0 0 5px 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;'>{{ $txt['real_name'] }}</h4>
	<div class='form-group'>
		<div><input type="text" name="real_name" class="form-control" placeholder="{{ $txt['real_name'] }}" @if(!empty($_GET['real_name'])) value="{{ $_GET['real_name'] }}" @endif></div>
	</div>
	@endif

	<!-- 角色 -->
	@if(in_array(4, $search_tool))
	<h4 class='text-light-blue' style='margin: 0 0 5px 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;'>{{ $txt['role_name'] }}</h4>
	<div class='form-group'>
		<div>
			<select name="role_id" class="form-control">
				<option value=""> {{ $txt['select_default'] }} </option>
				@foreach($active_role_list as $row)
					<option value="{{ $row->id }}" @if( isset($_GET['role_id']) && $_GET['role_id'] == $row->id ) selected @endif> {{ $row->name }} </option>
				@endforeach
			</select>				
		</div>
	</div>
	@endif

	<!-- 狀態 -->
	@if(in_array(5, $search_tool))
	<h4 class='text-light-blue' style='margin: 0 0 5px 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;'>{{ $txt['status'] }}</h4>
	<div class='form-group'>
		<div>
			<select name="status" class="form-control">
				<option value=""> {{ $txt['select_default'] }} </option>
				<option value="1" @if( isset($_GET['status']) && $_GET['status'] == 1 ) selected @endif> {{ $txt['enable'] }} </option>
				<option value="2" @if( isset($_GET['status']) && $_GET['status'] == 2 ) selected @endif> {{ $txt['disable'] }} </option>
			</select>
		</div>
	</div>
	@endif

	<!-- 角色名稱 -->
	@if(in_array(6, $search_tool))
	<h4 class='text-light-blue' style='margin: 0 0 5px 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;'>{{ $txt['role_name'] }}</h4>
	<div class='form-group'>
		<div><input type="text" name="role_name"  class="form-control" placeholder="{{ $txt['role_name'] }}" @if(!empty($_GET['role_name'])) value="{{ $_GET['role_name'] }}" @endif></div>
	</div>
	@endif

	<!-- 服務名稱 -->
	@if(in_array(7, $search_tool))
	<h4 class='text-light-blue' style='margin: 0 0 5px 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;'>{{ $txt['service_name'] }}</h4>
	<div class='form-group'>
		<div><input type="text" name="service_name"  class="form-control" placeholder="{{ $txt['service_name'] }}" @if(!empty($_GET['service_name'])) value="{{ $_GET['service_name'] }}" @endif></div>
	</div>
	@endif

	<div class='form-group'>
		<input type="hidden" value="{{ $service_id }}" name="service_id">
		<input type="submit" value="{{ $txt['filter'] }}" name="filter" class="btn btn-primary">
	</div>

</form>
@endif