 
@extends('layouts.app')
 
 @section('title', 'Isla Tucana')
  
 @section('content')
     <div class="row">
        <div class="col-12">
            <h1 class="text-center">Isla Tucana</h1>
        </div>
     </div>
     <div class="row">
         <div class="col">
             <button class="btn btn-primary" id="btn_newGame" name="btn_newGame">Nueva Partida!</button>
             <input type="hidden" value="{{route('isla-tucana.newGame')}}" id="newGameRoute">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3 id="contadorRonda" name="contadorRonda" class="text-center">
                Esperando nuevo juego
            </h3>
        </div>
        <div class="col-12">
            <a href="">1</a>
            <a href="">2</a>
            <a href="">3</a>
            <a href="">4</a>
            <a href="">5</a>
        </div>
        <div class="col-6">
            <img src="/storage/toucan.jpg" alt="carta A" name="cardA" id="cardA" width="640" height="426">
            <h4 id="captionCardA" class="text-center">Taco A</h4>
        </div>
        <div class="col-6">
            <img src="/storage/toucan.jpg" alt="carta B" name="cardB" id="cardB" width="640" height="426">
            <h4 id="captionCardB" class="text-center">Taco B</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <button class="btn btn-primary" id="btn_nextRound" name="btn_nextRound" disabled>Siguiente ronda</button>
        </div>
    </div>
 @endsection
 @section('js')
<script>
    var contadorRonda;
    var currentDeck = [];
    document.getElementById('btn_newGame').addEventListener('click', newGame);
    document.getElementById('btn_nextRound').addEventListener('click', nextRound);
    var deck = [];
    function newGame(){
        event.preventDefault();
        deck=[];
        currentDeck=[];
        var route = $('#newGameRoute').val();
        $.ajax({
            url: route, 
            type: 'GET',
            dataType : 'json',
            success: function(result){
                for(var item of result){
                    // deck[item.concept]=item.quantity;
                    deck.push(item);
                }
                console.log(deck);
                currentDeck=deck;
                $('#btn_nextRound').prop('disabled', false);
                contadorRonda = 0;
            }});
    }
    function startGame(){
        
    }
    function nextRound(){
        contadorRonda++;
        $('#contadorRonda').text("Ronda "+contadorRonda);
        drawCard("A");
        drawCard("B");
    }
    function drawCard(area){
        var currentCard = currentDeck.pop();
        switch(currentCard){
            case 'desert':
                type = "desert";
                break;
            case 'forest':
                type='forest';
                break;
            case 'water':
                type="water";
                break;
            case 'mountain':
                type="mountain";
                break;
            case 'wildcard':
                type="wildcard"
                break;
        }
        $('#card'+area).attr("src","storage/"+type+".jpg");
        $('#captionCard'+area).text(type);
        console.log(deck);
        console.log(currentCard);
        if(currentDeck.length<=1){
            endGame();
        }
    }
    function endGame(){
        console.log("FIN DEL JUEGO");
        console.log("La carta sobrante es: "+currentDeck);
        $('#btn_nextRound').prop('disabled', true);
        $('#contadorRonda').text("Ronda Final");

    }
</script>
 @endsection