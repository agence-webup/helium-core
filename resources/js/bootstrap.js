import Alpine from 'alpinejs'
import mask from '@alpinejs/mask'
import toolkit from '@alpine-collective/toolkit'
import Helium from './helium'


window.Alpine = Alpine

window.Helium = new Helium().init()

Alpine.plugin(mask)
Alpine.plugin(toolkit)
Alpine.start()
