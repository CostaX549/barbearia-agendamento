
import {
  Collapse,
  Dropdown,
  Tab,
  Input,
  Clipboard,
  Ripple,
  Carousel,
  Offcanvas,
  Datepicker,
  initTE,
  Alert,
  Stepper,
  Sidenav,
  Select,
  Modal,
  Lightbox,
  Rating
} from "tw-elements";





  const myExample = document.getElementById("copy-button");

  if (myExample) {
    const alertInstance = Alert.getInstance(
      document.getElementById("container-example")
    );
  
    myExample.addEventListener("copy.te.clipboard", () => {
      myExample.innerText = "Copied!";
      alertInstance.show();
  
      setTimeout(() => {
        myExample.innerText = "COPIAR LINK";
      }, 1000);
    });
  } 



    
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
 
// Register any Alpine directives, components, or plugins here...
 
Livewire.start()
    

    // Adicionar evento de clique para o botão "Responder"
    const replyButtons = document.querySelectorAll('.reply-btn');
    replyButtons.forEach(button => {
        button.addEventListener('click', () => {
            const parentComment = button.closest('.comment');
            const replyForm = parentComment.querySelector('.reply-form');
            // Exibir o formulário de resposta quando o botão "Responder" é clicado
            const isReplyFormVisible = window.getComputedStyle(replyForm).display !== 'none';

            // Alternar a visibilidade do formulário de resposta
            if (isReplyFormVisible) {
                // Se estiver visível, ocultar o formulário de resposta
                replyForm.style.display = 'none';
            } else {
                // Se não estiver visível, exibir o formulário de resposta
                replyForm.style.display = 'block';
            }
        });
    });


document.addEventListener('livewire:navigated', () => {
  initTE({ Sidenav, Alert, Clipboard, Tab, Modal, Ripple, Datepicker, Collapse,  Carousel, Dropdown, Offcanvas, Select, Stepper, Lightbox, Rating });


  const rating = document.getElementById('selected-value-example');
const instance = new Rating(rating);

})

/* document.getElementById('agendarButton').addEventListener('click', () => {


  const triggerEl = document.querySelector('#myTab a[href="#pills-contact8"]');
  
 triggerEl.click(); // Select tab by name
}); */

document.addEventListener('livewire:navigated', () => {


 
  
const icons = document.querySelectorAll('#selected-value-example [data-te-rating-icon-ref]');
document.querySelectorAll('.text-primary').forEach((star) => {
  star.addEventListener('click', (e) => {
    // Impede que o evento de clique se propague para o elemento pai (o dropdown)
    e.stopPropagation();
    
    // Insira aqui o código para avaliar a barbearia, se necessário
  });
});
let valorAvaliado = 0; // Inicialize com um valor padrão ou 0

icons.forEach((el) => {
  
    el.addEventListener('onSelect.te.rating', (e) => {
        
        valorAvaliado = e.value;
    });
});

document.getElementById('botaoAvaliar').addEventListener('click', (e) => {
            e.stopPropagation();
  var barbeariaId = document.getElementById('botaoAvaliar').getAttribute('data-barbearia-id');

  
  console.log('Barbearia ID:', barbeariaId);

  Livewire.dispatch('avaliar', {
    valor: valorAvaliado,
    id: barbeariaId,
    
});



});


});


