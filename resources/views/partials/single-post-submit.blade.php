<a class="{{ $a_class ?? 'btn btn-primary' }}" href="#"
   onclick="
           event.preventDefault();
   @if(isset($confirm))
           if(confirm('{{ $confirm }}')){
           document.getElementById('{{ str_slug($route) }}-{{ implode('-', $params ?? []) }}-form').submit();
           }
   @else
           document.getElementById('{{ str_slug($route) }}-{{ implode('-', $params ?? []) }}-form').submit();
   @endif
           ">
    {!! $name !!}
</a>
<form id="{{ str_slug($route) }}-{{ implode('-', $params ?? []) }}-form" action="{{ route($route, $params ?? []) }}" method="POST"
      style="display: none;">
    @csrf
    @if(isset($method))
        @method($method)
    @endif
</form>