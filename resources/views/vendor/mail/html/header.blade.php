<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'To-Do App')
<img src="http://localhost:8000/img/logo.png" class="logo" alt="To-Do App">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
