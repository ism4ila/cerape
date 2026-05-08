// Import Bootstrap JS
import './bootstrap';
import 'bootstrap';
import { initDonationForm } from './pages/don';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

initDonationForm();
