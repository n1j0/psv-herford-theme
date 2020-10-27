import documentReady from './documentReady'

documentReady(() => {
  const body = document.querySelector('body')
  const nav = document.querySelector('.nav-container')
  const button = document.querySelector('button.navbar-toggler')
  const toggle = document.querySelector('#navbarToggle')

  button?.addEventListener('click',function () {
    if (!button.classList.contains('collapsed')) {
      body.style.top = `-${window.scrollY}px`

      body.classList.add('noscroll')
      nav.classList.add('overlay')
    } else {
      body.classList.remove('noscroll')
      nav.classList.remove('overlay')

      const scrollY = body.style.top
      body.style.top = '0'
      window.scrollTo(0, parseInt(scrollY || '0') * -1 + +window.getComputedStyle(nav).height)
    }
  })

  window.addEventListener('resize', function () {
    const width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth
    if (width >= 992) {
      body.classList.remove('noscroll')
      nav.classList.remove('overlay')
      button.classList.add('collapsed')
      toggle.classList.remove('show')
    }
  })
})
