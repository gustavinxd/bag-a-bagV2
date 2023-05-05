const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


let assentos = [];
let nmrAssento;
let passageiro = 0;

function envia(valor){
    // passageiro = passageiro + 1;
    // document.getElementById('passageiro').innerHTML = 'Passageiro' + passageiro;
    
    //Gerador de Divs dentro do Selecionador de Assentos
    document.getElementById('ListaAssentos').innerHTML = 
    document.getElementById('ListaAssentos').innerHTML + 
    '<div class="m-2 pt-2 rounded-1" style="border: solid 1px black">' +
    '<h6 class="text-start mx-1" id="passageiro">Passageiro</h6>'+
    '<img src="../assets/img/poltrona_verde-sembg.png"  style="height: 50px; width: 50px;" alt=""></img>'+
    '<h6 id="assento'+valor+'" name="ast">Assento '+valor+'</h6>'+
    '<p>Valor: R$49,00</p>'+
    '</div>'
    //Fim do Gerador de Divs dentro do Selecionador de Assentos
    
    

    //Recebendo a Posição de Cada Poltrona                                                              
    nmrAssento = document.getElementById('poltrona' + valor).value;

    //Desabilitando o botão, para quê não seja selecionado consecutivamente
    document.getElementById('poltrona' + valor).disabled = true;
    
    //Acumulador dos Assentos Selecionados
    assentos.push(nmrAssento);

    console.log(assentos);

              

    
}


function remove(){
    assentos.pop;
    console.log(assentos);
    document.getElementById('assento').innerHTML= assentos;
}  