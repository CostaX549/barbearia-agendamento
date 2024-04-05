
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
  SmoothScroll,
  LazyLoad,
  Stepper,
  Sidenav,
  Select,
  Modal,
  Lightbox,
  Rating
} from "tw-elements";

    
 import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
 
// Register any Alpine directives, components, or plugins here...
 
Livewire.start() 




/*   let valorAvaliado = 0; // Inicialize com um valor padrão ou 0
const icons = document.querySelectorAll('#selected-value-example [data-te-rating-icon-ref]');

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
 */



document.addEventListener('livewire:navigated', () => {
  initTE({ Sidenav, Alert, LazyLoad, Clipboard, Tab, Modal, Ripple, Datepicker, Collapse,  Carousel, Dropdown, Offcanvas, Select, Stepper, Lightbox, Rating, SmoothScroll });

  Livewire.on('agendamento-salvo', () => {
    document.getElementById("fechar").click();
});


  const smoothLinks = document.querySelectorAll('.linkSmooth');

  smoothLinks.forEach(link => {
    new SmoothScroll(link);
  });

  const ratingStars = document.querySelectorAll('.ratingStar');
 ratingStars.forEach(star => {
    new Rating(star);
  });

  


})







 
 






/* document.getElementById('agendarButton').addEventListener('click', () => {


  const triggerEl = document.querySelector('#myTab a[href="#pills-contact8"]');
  
 triggerEl.click(); // Select tab by name
}); */







