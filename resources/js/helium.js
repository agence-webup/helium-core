
import { Notyf } from 'notyf'
import 'notyf/notyf.min.css'

class Helium {
    constructor() {
        this.dropmics = []
        this.notif = new Notyf({
            duration: 10000,
            dismissible: true,
            types: [
                {
                    type: 'success',
                    background: '#E6F6F4',
                    className: 'text-[#006355] border-[#00A38C] border-l-2',
                    icon: false
                },
                {
                    type: 'error',
                    background: '#FCEAEA',
                    className: 'text-[#891E1E] border-[#E03131] border-l-2',
                    icon: false
                },
                {
                    type: 'warning',
                    background: '#fed7aa',
                    className: 'text-[#5E4702] border-[#FFC107] border-l-2',
                    icon: false
                },
                {
                    type: 'info',
                    background: '#E9F3FD',
                    className: 'text-[#15548C] border-[#228AE6] border-l-2',
                    icon: false
                }
            ]
        })
    }

    init() {
        this._tableLink()
        this._forms()
        this._flash()
        this._notif()
        this._filter()
        return this
    }

    _tableLink() {
        // document.querySelectorAll('.table tr[data-link]').forEach((el) => {
        //   el.addEventListener('click', e => {
        //     window.location.href = el.dataset.link
        //   })
        // })
        document.querySelector('body').addEventListener('click', function (e) {
            const tr = e.target.closest('tr[data-link]')
            if (tr) {
                window.location.href = tr.dataset.link
            }
        })
    }

    _forms() {
        // form helpers
        [].forEach.call(document.querySelectorAll('[data-submit]'), (el) => {
            el.addEventListener('click', (event) => {
                event.preventDefault()
                event.stopPropagation()

                // if no confirmation
                if (el.dataset.confirm && !confirm(el.dataset.confirm)) return

                // let's submit the form
                const form = document.getElementById(el.dataset.submit)
                if (form) {
                    form.submit()
                }
            })
        })
    }

    _flash() {
        // flash helpers
        [].forEach.call(document.querySelectorAll('.notif'), function (el) {
            el.addEventListener('click', (event) => {
                event.target.style.display = 'none'
            })
        })
    }

    _notif() {
        [].forEach.call(document.querySelectorAll('[data-notif]'), (el) => {
            const type = el.dataset.notif
            const content = el.innerHTML
            // type: info, error, warning, success
            this.notif.open({
                type: type,
                message: content
            })

            el.style.display = 'none'
        })
    }

    _filter() {
        const activeClass = 'is-active'
        const showAll = () => {
            [].forEach.call(document.querySelectorAll('[data-helium-filter-target]'), section => {
                section.style.display = null
            });
            [].forEach.call(document.querySelectorAll('[data-helium-filter]'), tab => {
                tab.classList.remove(activeClass)
            })
            document.querySelector('[data-helium-filter="all"]').classList.add(activeClass)
        }
        const showTab = (tabId) => {
            [].forEach.call(document.querySelectorAll('[data-helium-filter-target]'), section => {
                section.style.display = 'none'
            });
            [].forEach.call(document.querySelectorAll('[data-helium-filter]'), tab => {
                tab.classList.remove(activeClass)
            })
            document.querySelector('[data-helium-filter-target="' + tabId + '"]').style.display = null
            document.querySelector('[data-helium-filter="' + tabId + '"]').classList.add(activeClass)
        }
        [].forEach.call(document.querySelectorAll('[data-helium-filter]'), (el) => {
            el.addEventListener('click', () => {
                if (el.getAttribute('data-helium-filter') === 'all') {
                    showAll()
                } else {
                    showTab(el.getAttribute('data-helium-filter'))
                }
            })
        })
    }
}

export default Helium
