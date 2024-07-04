require('./bootstrap');

import Alpine from 'alpinejs';
import { Html5QrcodeScanner } from "html5-qrcode";

window.Html5QrcodeScanner = Html5QrcodeScanner;

window.Alpine = Alpine;

Alpine.start();
