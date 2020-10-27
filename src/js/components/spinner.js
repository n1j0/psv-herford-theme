const spinner = document.createElement('span')
spinner.className = 'spinner-border spinner-border-sm mr-1'
spinner.setAttribute('role', 'status')
spinner.setAttribute('aria-hidden', 'true')

export const createSpinner = element => {
  element.insertBefore(spinner, element.firstChild || null)
}

export const removeSpinner = () => {
  spinner.remove()
}

