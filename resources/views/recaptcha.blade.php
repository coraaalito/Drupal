<script type="text/javascript">

    function callbackThen(response){

    // read HTTP status

    console.log(response.status);

    // read Promise object

    response.json().then(function(data){

    console.log(data);

    });

    }

    function callbackCatch(error){

    console.error('Error:', error)

    }

    </script>

    {!! htmlScriptTagJsApi([

    'callback_then' => 'callbackThen',

    'callback_catch' => 'callbackCatch'

    ]) !!}