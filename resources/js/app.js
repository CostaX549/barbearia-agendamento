
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
 import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging.js";







 
// Register any Alpine directives, components, or plugins here...
 
Livewire.start() 




   
 



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




Livewire.on("abrir-modal", (id) => {
  const myModalEl = document.getElementById("exampleModalLg-" + id); // Concatenando o ID ao ID do modal
  const modal = new Modal(myModalEl);
  modal.show();
});
 
 
