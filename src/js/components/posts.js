import documentReady from './documentReady'
import { createSpinner } from './spinner'

documentReady(() => {
  const buttons = document.querySelectorAll('.post-read-more')

  Array.prototype.filter.call(buttons, button => {
    button.addEventListener('click', function () {
      createSpinner(button)
    })
  })
})

