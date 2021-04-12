import documentReady from './documentReady'

documentReady(() => {
    const form = document.getElementById('coronaForm')
    const user = localStorage.getItem('user')
    const active = localStorage.getItem('active')

    if (active) {
        form?.parentNode.replaceChild(showLogout(active), form)

        const logoutBtn = document.getElementById('coronaSignOut')
        logoutBtn?.addEventListener('click', () => {
            localStorage.removeItem('active')
            logoutBtn.parentNode.parentNode.replaceChild(showSuccessfulLogout(), logoutBtn.parentNode)
        })
    } else if (form && user) {
        const userObj = JSON.parse(user)
        for (const [ key, value ] of Object.entries(userObj)) {
            document.getElementById(`psv${key}`).value = value
        }
    }

    form?.addEventListener('submit', event => {
        event.preventDefault()
        event.stopPropagation()
        if (!form.checkValidity()) {
            return
        }
        const data = [ ...new FormData(form) ]
        const formData = {}
        data.forEach(el => {
            if (el[0].startsWith('psv')) {
                const attr = el[0].replace('psv', '')
                formData[attr] = el[1]
            }
        })
        localStorage.setItem('user', JSON.stringify(formData))
        const time = new Date().toLocaleTimeString()
        localStorage.setItem('active', time)
        form.parentNode.replaceChild(showLogout(time), form)

        const logoutBtnNew = document.getElementById('coronaSignOut')
        logoutBtnNew?.addEventListener('click', () => {
            localStorage.removeItem('active')
            logoutBtnNew.parentNode.parentNode.replaceChild(showSuccessfulLogout(), logoutBtnNew.parentNode)
        })
    }, false)
})

const showLogout = (time) => {
    return htmlToElement(`<div><p>Angemeldet seit <strong>${time}</strong></p><button type="submit" id="coronaSignOut" class="btn btn-primary">Abmelden</button></div>`)
}

const showSuccessfulLogout = () => {
    return htmlToElement(`<p>Du hast dich erfolgreich um ${new Date().toLocaleTimeString()} abgemeldet.</p>`)
}

const htmlToElement = (html) => {
    const template = document.createElement('template')
    template.innerHTML = html.trim()
    return template.content.firstChild
}
