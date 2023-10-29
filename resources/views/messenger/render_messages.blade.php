@foreach($messages as $item)
@if($item->user_id == Auth::Id())
<div class="media w-50 ml-auto">
	<div class="bg-dark rounded py-1 px-3 ">
		<p class="text-small mb-0 text-white">{{ $item->message ?? '' }}</p>
	</div>
</div>
<div class=" mb-1 w-50 ml-auto">
	    <span class="time_date"> {{$item->created_at->format('H:i')}}    |    {{$item->created_at->format('d M')}}</span>
	</div>
@else
<div class="media w-50">
	<div class="bg-light rounded py-1 px-3">
		<p class="text-small mb-0 text-dark">{{ $item->message ?? '' }}</p>
	</div>
</div>
	<div class=" mb-1">
	    <span class="time_date"> {{$item->created_at->format('H:i')}}    |    {{$item->created_at->format('d M')}}</span>
	</div>
@endif
@endforeach
