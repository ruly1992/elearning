$(document).ready(function () {
    var STORAGE_KEY = 'vue-kelas-app';

    var store = {
        fetch: function () {
            return JSON.parse(localStorage.getItem(STORAGE_KEY || '[]'))
        },
        save: function (course) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(course));
        }
    }

    new Vue({
        el: '#kelas-app',
        data: {
            chapters: [
                {
                    id: 1,
                    name: 'Belajar Dengan Pensil',
                    description: 'Nantinya akan diajari dengan pensil',
                    quiz: [
                        {

                        }
                    ]
                },
                {
                    id: 2,
                    name: 'Belajar Dengan Bolpoin',
                    description: 'Jangan lupa bawa bolpoin'
                }
            ]
        },
        methods: {
            addChapter: function () {
                this.chapters.push({
                    id: 0,
                    name: '',
                    description: ''
                })
            }
        }
    })
})