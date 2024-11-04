import axios from 'axios';

import * as Popper from '@popperjs/core'
window.Popper = Popper

import 'bootstrap'

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';