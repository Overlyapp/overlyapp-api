require('./bootstrap')

import { createApp } from 'vue'
import Marker from './components/Marker'

const app = createApp({})

app.component('MarkerManager', Marker)

app.mount('#app')
