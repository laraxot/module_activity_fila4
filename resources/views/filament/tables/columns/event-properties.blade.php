@foreach($getState() as $variable => $value)
    <p>
        {{$variable}}={{$value}}
        @if(!$loop->last),
        @endif
    </p>
<<<<<<< HEAD
@endforeach
=======
@endforeach
>>>>>>> 0a00ff2 (.)
