 
@extends('layouts.app')
 
 @section('title', 'Isla Tucana')
  
 @section('content')
     <div class="row">
        <div class="col-12">
            <h1 class="text-center">Isla Tucana</h1>
        </div>
     </div>
     <div class="row my-3">
         <div class="col-12 text-center">
             <button class="btn btn-primary" id="btn_newGame" name="btn_newGame">¡Nueva Partida!</button>
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
            <ul class="list-group list-group-horizontal justify-content-center">
                <li class="list-group-item historicEvent" id="historic1">1</li>
                <li class="list-group-item historicEvent" id="historic2">2</li>
                <li class="list-group-item historicEvent" id="historic3">3</li>
                <li class="list-group-item historicEvent" id="historic4">4</li>
                <li class="list-group-item historicEvent" id="historic5">5</li>
                <li class="list-group-item historicEvent" id="historic6">6</li>
                <li class="list-group-item historicEvent" id="historic7">7</li>
                <li class="list-group-item historicEvent" id="historic8">8</li>
                <li class="list-group-item historicEvent" id="historic9">9</li>
                <li class="list-group-item historicEvent" id="historic10">10</li>
                <li class="list-group-item historicEvent" id="historic11">11</li>
                <li class="list-group-item historicEvent" id="historic12">12</li>
                <li class="list-group-item historicEvent" id="historic13">13</li>
            </ul>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-6">
            <img src="/storage/toucan.jpg" alt="carta A" name="cardA" id="cardA" width="640" height="426">
            <h4 id="captionCardA" class="text-center mt-2">Taco A</h4>
        </div>
        <div class="col-6">
            <img src="/storage/toucan.jpg" alt="carta B" name="cardB" id="cardB" width="640" height="426">
            <h4 id="captionCardB" class="text-center mt-2">Taco B</h4>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 d-flex justify-content-center">
            <button class="btn btn-success btn-lg" id="btn_nextRound" name="btn_nextRound" disabled>Siguiente ronda</button>
        </div>
    </div>
 @endsection
 @section('js')
<script>
    var contadorRonda;
    var currentDeck = [];
    var historic = new Array();
    document.getElementById('btn_newGame').addEventListener('click', newGame);
    document.getElementById('btn_nextRound').addEventListener('click', nextRound);
    
    var deck = [];
    function newGame(){
        event.preventDefault();
        deck=[];
        currentDeck=[];
        historic = new Array(2);
        var route = $('#newGameRoute').val();
        $.ajax({
            url: route, 
            type: 'GET',
            dataType : 'json',
            success: function(result){
                for(var item of result){
                    deck.push(item);
                }
                currentDeck=deck;
                $('#btn_nextRound').prop('disabled', false);
                contadorRonda = 0;
                resetCardImages();
                resetHistoricColors();
            }});
        }
        function startGame(){
            
        }
        function nextRound(){
            contadorRonda++;
            $('#contadorRonda').text("Ronda "+contadorRonda);
            drawCard("A");
            drawCard("B");
            paintHistoricRounds();
            paintCurrentRound();
            addEventListenerToHistoric();
        }
        function drawCard(area){
            var currentCard = currentDeck.pop();
            type=getType(currentCard);
            concept = getConcept(currentCard);
            $('#card'+area).attr("src","storage/"+type+".jpg");
            $('#captionCard'+area).text(concept);
            if(currentDeck.length<=1){
                endGame();
            }
            pushHistoric(contadorRonda, area, type);
        }
        function endGame(){
            $('#btn_nextRound').prop('disabled', true);
        $('#contadorRonda').text("Ronda Final");
    }
    function pushHistoric(contadorRonda, area, type){
        if(area=="A"){
            historic[contadorRonda]=new Array();
            historic[contadorRonda]['A']=type;
        }
        if(area=="B"){
            historic[contadorRonda]['B']=type;
        }
    }
    function getRound(bruteRound){
        round = bruteRound.replace("historic", "");
        return round;
    }
    function seeHistoric(round){
        let typeA=historic[round]['A'];
        let typeB=historic[round]['B'];
        let conceptA=getConcept(historic[round]['A'])
        let conceptB=getConcept(historic[round]['B'])
        $('#card'+'A').attr("src","storage/"+typeA+".jpg");
        $('#captionCard'+'A').text(conceptA);
        $('#card'+'B').attr("src","storage/"+typeB+".jpg");
        $('#captionCard'+'B').text(conceptB);
        paintLikeFocusedThisRound(round);
    }
    function getType(currentCard){
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
                            return type;
    }
    function getConcept(currentCard){
        switch(currentCard){
            case 'desert':
                concept="Desierto";
                break;
                case 'forest':
                    concept="Bosque";
                    break;
                    case 'water':
                        concept="Agua";
                        break;
                        case 'mountain':
                            concept="Montaña";
                            break;
                            case 'wildcard':
                                concept="Comodín";
                                break;
                            }
                            return concept;
                        }
                        function paintHistoricRounds(){
                            for(let i=1; i<contadorRonda; i++){
                                $('#historic'+i).removeClass('currentRound');
                                $('#historic'+i).removeClass('focusedRound');
                                $('#historic'+i).addClass('historicRound')
                            }
                        }
                        function paintCurrentRound(){
                            $('#historic'+contadorRonda).addClass('currentRound');
                            $('#historic'+contadorRonda).addClass('focusedRound');
                        }
                        function paintLikeFocusedThisRound(round){
                            paintHistoricRounds();
                            $('.historicEvent').removeClass('focusedRound');
                            $('#historic'+round).removeClass('historicRound');
                            $('#historic'+round).addClass('focusedRound');
                        }
                        function addEventListenerToHistoric(){
                            $("#historic"+contadorRonda).click(function(event) {
                                historicRound = getRound(event.target.id);
                                seeHistoric(historicRound);
                            });
                        }
                        function resetCardImages(){
                            $('#card'+'A').attr("src","storage/toucan.jpg");
                            $('#captionCard'+'A').text("Taco A");
                            $('#card'+'B').attr("src","storage/toucan.jpg");
                            $('#captionCard'+'B').text("Taco B");
                        }
                        function resetHistoricColors(){
                            $('.historicEvent').removeClass('historicRound');
                            $('.historicEvent').removeClass('focusedRound');
                            $('.historicEvent').removeClass('currentRound');
                        }
                    </script>
 @endsection