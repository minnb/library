@if ($errors->any())
<style type="text/css">
	.div-alert{
		margin: 0; padding: 0;
	}
	.ul-alert{
		list-style: none;
	}
</style>
<div class="row" id="flash-message">
	<div class="col-xs-12 div-alert">
		<ul class="alert alert-danger ul-alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
	</div>
	<br>
</div>
@endif

@if(Session::has('flash_message'))
<style type="text/css">
	.div-alert{
		margin: 0; padding: 0;
	}
	.ul-alert{
		list-style: none; margin:0;
	}
</style>
<div class="row" id="flash-message">
	<div class="col-xs-12 div-alert">
		<ul class="alert alert-danger ul-alert">
			<li><?php echo  Session::get('flash_message') ; ?></li>
		</ul>
	</div>
	<br>
</div>
@endif
<div class="clearfix" style="margin-bottom: 10px;"></div>