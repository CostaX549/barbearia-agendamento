
import {
  Collapse,
  Dropdown,
  Tab,
  Input,
  Ripple,
  Carousel,
  Offcanvas,
  Datepicker,
  initTE,
  Stepper,
  Sidenav,
  Select,
  Lightbox
} from "tw-elements";



document.addEventListener('livewire:navigated', () => {
  initTE({ Sidenav, Tab, Ripple, Datepicker, Collapse,  Carousel, Dropdown, Offcanvas, Select, Stepper, Lightbox });
})

    
  import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
 
  // Register any Alpine directives, components, or plugins here...
   
  Livewire.start()
    






