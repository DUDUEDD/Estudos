{{-- apresentação dos erros de validação --}}
<div class="erro">
    @if(count($errors) != 0)
        <div class="alert alert-danger">
            @if(count($errors)==1)
                <p class="titulo_erro">ERRO: </p>
            @else
                <p class="titulo_erro">ERROS: </p>
            @endif
            <ul>
                @foreach($errors->all() as $erro)
                    <li style="color: black;">{{$erro}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>


{{-- apresentação dos erros de comunicação com a bd --}}
@if(isset($erros_bd))
    <div class="alert alert-danger erro">
        @foreach($erros_bd as $erro )
            <p>{{ $erro }}</p>
        @endforeach
    </div>
@endif
