require('./bootstrap')

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import { createApp } from 'vue'
import Marker from './components/Marker'

const app = createApp({})

app.component('MarkerManager', Marker)

app.mount('#app')
