import documentReady from './documentReady'
import { createSpinner, removeSpinner } from './spinner'

documentReady(() => {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const form = document.getElementById('contactForm')
    // Loop over them and prevent submission
    form?.addEventListener('submit', event => {
        const button = document.querySelector('button#contact-form-submit')

        createSpinner(button)
        button.setAttribute('disabled', 'true')

        if (form.checkValidity() === false) {
            event.preventDefault()
            event.stopPropagation()
            removeSpinner()
            button.removeAttribute('disabled')
        }
        form.classList.add('was-validated')
    }, false)
})
