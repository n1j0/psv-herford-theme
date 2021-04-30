import documentReady from './documentReady'

documentReady(() => {
    const form = document.getElementById('coronaForm')
    const user = localStorage.getItem('user')
    const active = localStorage.getItem('active')

    if (active) {
        const oldDate = new Date(localStorage.getItem('time')).getTime()
        const currentDate = new Date().getTime()
        if (currentDate-oldDate >= 6*60*60*1000) {
            logout()
            fillOutForm(user)
            showWarning()
            formListener(form)
            return
        }

        form?.parentNode.replaceChild(showLogout(active), form)
        listenForLogout()
    } else if (form && user) {
        fillOutForm(user)
    }

    formListener(form)
})

const formListener = (form) => {
    form?.addEventListener('submit', event => {
        event.preventDefault()
        event.stopPropagation()
        console.log('test')
        removeError()
        removeWarning()
        if (!form.checkValidity()) {
            return
        }
        const data = [ ...new FormData(form) ]
        const formData = {}
        data.forEach(el => {
            if (el[0].startsWith('psv')) {
                const attr = el[0].replace('psv', '')
                formData[attr] = el[1]
            } else {
                if (el[0] !== 'submitted' && el[1] !== '') {
                    throw new Error('Honeypot is filled. Everybody hates bots...')
                }
            }
        })
        const dataAsString = JSON.stringify(formData)
        localStorage.setItem('user', dataAsString)
        signIn(dataAsString)
            .then(async r => {
                if (!r.ok) {
                    showError((await r.json()).message)
                    return
                }

                const time = new Date().toLocaleTimeString()
                localStorage.setItem('active', getTime(time))
                localStorage.setItem('time', new Date().toISOString())
                form.parentNode.replaceChild(showLogout(time), form)

                listenForLogout()
            })
            .catch(e => {
                showError(e)
            })
    }, false)
}

const fillOutForm = (user) => {
    const userObj = JSON.parse(user)
    for (const [ key, value ] of Object.entries(userObj)) {
        document.getElementById(`psv${key}`).value = value
    }
}

const showLogout = (time) => {
    return htmlToElement(`<div><p>Angemeldet seit <strong>${time}</strong> Uhr.</p><button type="submit" id="coronaSignOut" class="btn btn-primary">Abmelden</button></div>`)
}

const listenForLogout = () => {
    const logoutBtn = document.getElementById('coronaSignOut')
    logoutBtn?.addEventListener('click', () => {
        removeError()
        logout(() => {
            logoutBtn.parentNode.parentNode.replaceChild(showSuccessfulLogout(), logoutBtn.parentNode)
        })
    })
}

const logout = (replaceFunction = null) => {
    signOut(localStorage.getItem('user'))
        .then(async r => {
            if (!r.ok) {
                showError((await r.json()).message)
                return
            }

            localStorage.removeItem('active')
            localStorage.removeItem('time')
            if (replaceFunction) {
                replaceFunction()
            }
        })
        .catch(e => {
            showError(e)
        })
}

const signIn = (data) => {
    return fetch('/wp-json/corona/in', {
        method: 'POST',
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        },
        body: data,
    })
}

const signOut = (data) => {
    return fetch('/wp-json/corona/out', {
        method: 'POST',
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        },
        body: data,
    })
}

const showError = (error = '') => {
    const headline = document.getElementsByTagName('h1')
    headline[0].parentNode.append(htmlToElement(`<div class="alert alert-danger mt-3 mb-4" role="alert"><p class="mb-0">Es ist ein Fehler aufgetreten. ${error} Bitte versuche es erneut.</p></div>`))
}

const showWarning = () => {
    const headline = document.getElementsByTagName('h1')
    headline[0].parentNode.prepend(htmlToElement(`<div class="alert alert-warning mt-3 mb-4" role="alert"><p class="mb-0">Du wurdest automatisch abgemeldet. Bitte denk beim nächsten mal daran dich abzumelden.</p></div>`))
}

const removeError = () => {
    const el = document.querySelector('div.alert.alert-danger')
    el?.parentNode.removeChild(el)
}

const removeWarning = () => {
    const el = document.querySelector('div.alert.alert-warning')
    el?.parentNode.removeChild(el)
}

const showSuccessfulLogout = () => {
    return htmlToElement(`<p>Du hast dich erfolgreich um <strong>${getTime(new Date().toLocaleTimeString())}</strong> Uhr abgemeldet.</p>`)
}

const htmlToElement = (html) => {
    const template = document.createElement('template')
    template.innerHTML = html.trim()
    return template.content.firstChild
}

const getTime = (time) => {
    return time.slice(0, -3)
}
