<<<<<<< HEAD
<?php

declare(strict_types=1);

?>
=======
>>>>>>> 0a00ff2 (.)
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
